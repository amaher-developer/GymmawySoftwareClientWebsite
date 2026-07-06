<?php

namespace Modules\Common\Services;

use Modules\Common\Contracts\PaymentInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Paymob Payment Service Implementation
 *
 * Handles payment processing through Paymob gateway
 * Used by: Redbone, Cakorinas modules
 */
class PaymobPaymentService implements PaymentInterface
{
    protected string $endpoint;
    protected string $apiKey;
    protected string $secretKey;
    protected string $publicKey;
    protected string $hmacSecret;
    protected int $integrationId;

    public function __construct()
    {
        // Try multiple config paths and fallback to env variables
        $cfg = config('common.paymob') ?? config('paymob') ?? [];

        $this->endpoint = rtrim(
            $cfg['endpoint'] ?? env('PAYMOB_ENDPOINT', 'https://accept.paymob.com'),
            '/'
        );
        $this->apiKey = $cfg['api_key'] ?? env('PAYMOB_API_KEY', '');
        $this->secretKey = $cfg['secret_key'] ?? env('PAYMOB_SECRET_KEY', '');
        $this->publicKey = $cfg['public_key'] ?? env('PAYMOB_PUBLIC_KEY', '');
        $this->hmacSecret = $cfg['hmac_secret'] ?? env('PAYMOB_HMAC_SECRET', '');
        $this->integrationId = (int) ($cfg['integration_id'] ?? env('PAYMOB_INTEGRATION_ID', 0));
    }

    /**
     * {@inheritDoc}
     */
    public function createPayment(array $orderData): array
    {
        try {
            // Validate required fields
            if (empty($orderData['amount']) || empty($orderData['currency'])) {
                return $this->failedPayment('Amount and currency are required');
            }

            if (empty($this->secretKey) || empty($this->publicKey)) {
                Log::error('PaymobPaymentService: secret_key/public_key not configured');
                return $this->failedPayment('Paymob is not configured correctly');
            }

            // Convert amount to cents
            $amountCents = (int) round($orderData['amount'] * 100);
            $billingData = $this->prepareBillingData($orderData);

            $payload = [
                'amount' => $amountCents,
                'currency' => $orderData['currency'] ?? 'EGP',
                'payment_methods' => [$this->integrationId],
                'items' => $orderData['items'] ?? [],
                'billing_data' => $billingData,
                'customer' => [
                    'first_name' => $billingData['first_name'],
                    'last_name' => $billingData['last_name'],
                    'email' => $billingData['email'],
                    'extras' => [],
                ],
                'extras' => [],
                'special_reference' => (string) ($orderData['order_id'] ?? Str::uuid()),
            ];

            if (!empty($orderData['return_url'])) {
                $payload['redirection_url'] = $orderData['return_url'];
            }

            $response = Http::withOptions([
                'verify' => false,
            ])->withToken($this->secretKey, 'Token')
              ->asJson()
              ->post($this->endpoint . '/v1/intention/', $payload);

            if (!$response->successful()) {
                Log::error('Paymob createIntention failed', ['resp' => $response->body()]);
                return $this->failedPayment('Failed to create Paymob payment intention');
            }

            $data = $response->json();
            $clientSecret = $data['client_secret'] ?? null;

            if (!$clientSecret) {
                Log::error('Paymob createIntention missing client_secret', ['resp' => $data]);
                return $this->failedPayment('Failed to generate payment session');
            }

            // Paymob auto-creates an order for the intention; its id (intention_order_id)
            // is what the transaction callback later echoes back in the "order" field.
            $transactionId = $data['intention_order_id'] ?? ($data['id'] ?? null);

            $paymentUrl = $this->endpoint . '/unifiedcheckout/?publicKey=' . $this->publicKey . '&clientSecret=' . $clientSecret;

            return [
                'success' => true,
                'payment_url' => $paymentUrl,
                'transaction_id' => (string) $transactionId,
                'message' => 'Payment session created successfully'
            ];

        } catch (\Exception $e) {
            Log::error('Paymob createPayment exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return $this->failedPayment('Payment creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Build a standard failure response for createPayment
     */
    protected function failedPayment(string $message): array
    {
        return [
            'success' => false,
            'payment_url' => null,
            'transaction_id' => null,
            'message' => $message
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function verifyPayment(array $callbackData): array
    {
        try {
            // Log callback data for debugging
            Log::info('Paymob callback received', ['data' => $callbackData]);

            // Paymob sends data in 'obj' key when using transaction callback
            // OR directly in root for iframe callback
            $txnData = $callbackData['obj'] ?? $callbackData;

            // Paymob sends HMAC signature for verification
            $isValid = $this->validateCallback($txnData);

            if (!$isValid) {
                Log::warning('Paymob callback HMAC validation failed - treating as untrusted', ['data' => $callbackData]);
                // Force downstream success checks to fail so a forged/tampered
                // callback can never be treated as a paid transaction.
                $txnData['success'] = 'false';
            }

            // Check for errors first
            $errorOccurred = ($txnData['error_occured'] ?? 'false') === 'true';
            $errorMessage = $txnData['data_message'] ?? $txnData['message'] ?? null;

            // Check payment success - Paymob uses 'success' field (string "true"/"false")
            $isPaid = false;

            // Method 1: Check 'success' field AND ensure no errors
            if (isset($txnData['success'])) {
                $isPaid = ($txnData['success'] === true ||
                          $txnData['success'] === 'true' ||
                          $txnData['success'] === '1') &&
                          !$errorOccurred; // Must not have errors     
            }

            // Method 2: Check if payment is not pending AND no errors
            if (!$isPaid && isset($txnData['pending'])) {
                $isPending = $txnData['pending'] === true ||
                            $txnData['pending'] === 'true';
                $isPaid = !$isPending && !$errorOccurred;
                
            }

            // Method 3: If order is array, check paid_amount_cents
            if (!$isPaid && isset($txnData['order']) && is_array($txnData['order'])) {
                $isPaid = (int)($txnData['amount_cents'] ?? 0) > 0;
            }

            // Extract transaction details
            $transactionId = $txnData['id'] ?? $txnData['transaction_id'] ?? null;

            // Order can be string (order ID) or array (order object)
            if (isset($txnData['order']) && is_array($txnData['order'])) {
                $orderId = $txnData['order'] ?? null;
                $merchantOrderId = $txnData['order']['merchant_order_id'] ?? null;
                $amountCents = $txnData['amount_cents'] ?? $txnData['order']['amount_cents'] ?? 0;
            } else {
                // Order is just the order ID as a string
                $orderId = $txnData['order'] ?? $txnData['order_id'] ?? null;
                $merchantOrderId = null;
                $amountCents = $txnData['amount_cents'] ?? 0;
            }
            return [
                'success' => $isPaid,
                'verified' => $isValid,
                'transaction_id' => (string) $transactionId,
                'order_id' => (string) ($merchantOrderId ?? $orderId),
                'amount' => (float) ($amountCents / 100),
                'status' => $isPaid ? 'success' : 'failed',
                'message' => $isPaid ? 'Payment verified successfully' : ($errorMessage ?? 'Payment failed or pending'),
                'error_occurred' => $errorOccurred,
                'raw_data' => $txnData // Include raw data for debugging
            ];

        } catch (\Exception $e) {
            Log::error('Paymob verifyPayment exception', [
                'error' => $e->getMessage(),
                'callback_data' => $callbackData,
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'verified' => false,
                'transaction_id' => null,
                'order_id' => null,
                'amount' => 0,
                'status' => 'failed',
                'message' => 'Verification failed: ' . $e->getMessage()
            ];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getPaymentStatus(string $transactionId): array
    {
        try {
            $authToken = $this->auth();
            if (!$authToken) {
                return [
                    'success' => false,
                    'status' => 'unknown',
                    'amount' => 0,
                    'transaction_id' => $transactionId,
                    'order_id' => null,
                    'paid_at' => null,
                    'message' => 'Authentication failed'
                ];
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $authToken
            ])->get($this->endpoint . '/api/ecommerce/orders/' . $transactionId);

            if (!$response->ok()) {
                return [
                    'success' => false,
                    'status' => 'unknown',
                    'amount' => 0,
                    'transaction_id' => $transactionId,
                    'order_id' => null,
                    'paid_at' => null,
                    'message' => 'Failed to fetch payment status'
                ];
            }

            $data = $response->json();
            $isPaid = ($data['paid_amount_cents'] ?? 0) > 0;

            return [
                'success' => $isPaid,
                'status' => $isPaid ? 'success' : 'pending',
                'amount' => ($data['amount_cents'] ?? 0) / 100,
                'transaction_id' => (string) ($data['id'] ?? $transactionId),
                'order_id' => (string) ($data['merchant_order_id'] ?? ''),
                'paid_at' => $data['paid_at'] ?? null,
                'message' => $isPaid ? 'Payment successful' : 'Payment pending'
            ];

        } catch (\Exception $e) {
            Log::error('Paymob getPaymentStatus exception', [
                'transaction_id' => $transactionId,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'status' => 'unknown',
                'amount' => 0,
                'transaction_id' => $transactionId,
                'order_id' => null,
                'paid_at' => null,
                'message' => 'Status check failed: ' . $e->getMessage()
            ];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function refundPayment(string $transactionId, ?float $amount = null): array
    {
        try {
            $authToken = $this->auth();
            if (!$authToken) {
                return [
                    'success' => false,
                    'refund_id' => null,
                    'refunded_amount' => 0,
                    'message' => 'Authentication failed'
                ];
            }

            $payload = [
                'auth_token' => $authToken,
                'transaction_id' => $transactionId,
            ];

            if ($amount !== null) {
                $payload['amount_cents'] = (int) ($amount * 100);
            }

            $response = Http::withOptions([
            'verify' => false,
        ])->asJson()->post(
                $this->endpoint . '/api/acceptance/void_refund/refund',
                $payload
            );

            if (!$response->ok()) {
                return [
                    'success' => false,
                    'refund_id' => null,
                    'refunded_amount' => 0,
                    'message' => 'Refund request failed'
                ];
            }

            $data = $response->json();

            return [
                'success' => true,
                'refund_id' => (string) ($data['id'] ?? ''),
                'refunded_amount' => ($data['amount_cents'] ?? 0) / 100,
                'message' => 'Refund processed successfully'
            ];

        } catch (\Exception $e) {
            Log::error('Paymob refundPayment exception', [
                'transaction_id' => $transactionId,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'refund_id' => null,
                'refunded_amount' => 0,
                'message' => 'Refund failed: ' . $e->getMessage()
            ];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getProviderName(): string
    {
        return 'paymob';
    }

    // =====================================================================
    // PRIVATE HELPER METHODS (from original PaymobService)
    // =====================================================================

    /**
     * Authenticate with Paymob and return the auth token
     */
    protected function auth(): ?string
    {
        if (empty($this->apiKey)) {
            Log::warning('PaymobService: API key not configured');
            return null;
        }

        $res = Http::withOptions([
            'verify' => false,
        ])->asJson()->post($this->endpoint . '/api/auth/tokens', [
            'api_key' => $this->apiKey,
        ]);

        // Check if response contains a token (Paymob may return 201 or 200)
        if ($res->successful() && $res->json('token')) {
            return $res->json('token');
        }

        // Even if not successful, check if token exists in response
        $token = $res->json('token');
        if ($token) {
            return $token;
        }

        Log::error('Paymob auth failed', [
            'status' => $res->status(),
            'resp' => $res->body()
        ]);
        return null;
    }

    /**
     * Prepare billing data from order data
     */
    protected function prepareBillingData(array $orderData): array
    {
        $customer = $orderData['customer'] ?? [];

        return [
            'first_name' => $customer['name'] ?? 'Guest',
            'last_name' => $customer['name'] ?? 'User',
            'email' => $customer['email'] ?? 'guest@example.com',
            'phone_number' => $customer['phone'] ?? '+201000000000',
            'apartment' => 'NA',
            'floor' => 'NA',
            'street' => 'NA',
            'building' => 'NA',
            'shipping_method' => 'NA',
            'postal_code' => 'NA',
            'city' => 'NA',
            'country' => 'EG',
            'state' => 'NA',
        ];
    }

    /**
     * Validate Paymob's Transaction Processed Callback HMAC signature.
     *
     * Paymob computes the HMAC over a fixed, ordered set of fields (see their
     * "Transaction Callback" docs) concatenated as strings, hashed with SHA-512
     * using the dashboard HMAC secret.
     */
    protected function validateCallback(array $data): bool
    {
        if (empty($this->hmacSecret)) {
            Log::warning('PaymobPaymentService: HMAC secret not configured, cannot validate callback');
            return false;
        }

        $receivedHmac = $data['hmac'] ?? null;
        if (empty($receivedHmac)) {
            Log::warning('Paymob callback missing hmac parameter');
            return false;
        }

        $orderedKeys = [
            'amount_cents', 'created_at', 'currency', 'error_occured', 'has_parent_transaction',
            'id', 'integration_id', 'is_3d_secure', 'is_auth', 'is_capture', 'is_refunded',
            'is_standalone_payment', 'is_voided', 'order', 'owner', 'pending',
            'source_data.pan', 'source_data.sub_type', 'source_data.type', 'success',
        ];

        $concatenated = '';
        foreach ($orderedKeys as $key) {
            $concatenated .= $data[$key] ?? '';
        }

        $calculatedHmac = hash_hmac('sha512', $concatenated, $this->hmacSecret);

        return hash_equals(strtolower($calculatedHmac), strtolower((string) $receivedHmac));
    }
}
