<?php

namespace Modules\Common\Services;

use Modules\Common\Contracts\PaymentInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
    protected int $integrationId;
    protected ?string $iframeId;

    public function __construct()
    {
        // Try multiple config paths and fallback to env variables
        $cfg = config('common.paymob') ?? config('paymob') ?? [];

        $this->endpoint = rtrim(
            $cfg['endpoint'] ?? env('PAYMOB_ENDPOINT', 'https://accept.paymob.com'),
            '/'
        );
        $this->apiKey = $cfg['api_key'] ?? env('PAYMOB_API_KEY', '');
        $this->integrationId = (int) ($cfg['integration_id'] ?? env('PAYMOB_INTEGRATION_ID', 0));
        $this->iframeId = $cfg['iframe_id'] ?? env('PAYMOB_IFRAME_ID', null);
    }

    /**
     * {@inheritDoc}
     */
    public function createPayment(array $orderData): array
    {
        try {
            // Validate required fields
            if (empty($orderData['amount']) || empty($orderData['currency'])) {
                return [
                    'success' => false,
                    'payment_url' => null,
                    'transaction_id' => null,
                    'message' => 'Amount and currency are required'
                ];
            }

            // Convert amount to cents
            $amountCents = (int) ($orderData['amount'] * 100);

            // Step 1: Authenticate
            $authToken = $this->auth();
            if (!$authToken) {
                return [
                    'success' => false,
                    'payment_url' => null,
                    'transaction_id' => null,
                    'message' => 'Paymob authentication failed'
                ];
            }

            // Step 2: Create order
            $order = $this->createOrder($amountCents, $orderData['currency'] ?? 'EGP');
            if (!$order) {
                return [
                    'success' => false,
                    'payment_url' => null,
                    'transaction_id' => null,
                    'message' => 'Failed to create Paymob order'
                ];
            }

            // Step 3: Get payment key
            $billingData = $this->prepareBillingData($orderData);
            $paymentKeyResponse = $this->requestPaymentKey(
                $order['id'],
                $amountCents,
                $billingData
            );
            
            if (!$paymentKeyResponse || empty($paymentKeyResponse['token'])) {
                return [
                    'success' => false,
                    'payment_url' => null,
                    'transaction_id' => null,
                    'message' => 'Failed to generate payment key'
                ];
            }

            // Step 4: Generate iframe URL
            $paymentUrl = $this->iframeUrl($paymentKeyResponse['token']);
            if (!$paymentUrl) {
                return [
                    'success' => false,
                    'payment_url' => null,
                    'transaction_id' => null,
                    'message' => 'Failed to generate payment URL'
                ];
            }

            return [
                'success' => true,
                'payment_url' => $paymentUrl,
                'transaction_id' => (string) $order['id'],
                'message' => 'Payment session created successfully'
            ];

        } catch (\Exception $e) {
            Log::error('Paymob createPayment exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'payment_url' => null,
                'transaction_id' => null,
                'message' => 'Payment creation failed: ' . $e->getMessage()
            ];
        }
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
            $isValid = $this->validateCallback($callbackData);

            if (!$isValid) {
                Log::warning('Paymob callback validation failed', ['data' => $callbackData]);
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
                'verified' => true, // Always true since we got a callback
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
dd('false');
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
     * Create an order on Paymob
     */
    protected function createOrder(int $amount_cents, string $currency = 'EGP'): ?array
    {
        $token = $this->auth();
        if (!$token) {
            return null;
        }

        $payload = [
            'auth_token' => $token,
            'delivery_needed' => false,
            'amount_cents' => $amount_cents,
            'currency' => $currency,
            'items' => [],
        ];

        $res = Http::withOptions([
            'verify' => false,
        ])->asJson()->post($this->endpoint . '/api/ecommerce/orders', $payload);

        if ($res->successful() && $res->json('token')) {
            return $res->json();
        }

        Log::error('Paymob createOrder failed', ['resp' => $res->body()]);
        return null;
    }

    /**
     * Request a payment key for an order
     */
    protected function requestPaymentKey(int $orderId, int $amount_cents, array $billingData = []): ?array
    {
        $token = $this->auth();
        if (!$token) {
            return null;
        }

        $res = Http::withOptions([
            'verify' => false,
        ])->asJson()->post($this->endpoint . '/api/acceptance/payment_keys', [
            'auth_token' => $token,
            'amount_cents' => $amount_cents,
            'expiration' => 3600,
            'order_id' => $orderId,
            'billing_data' => $billingData,
            'currency' => 'EGP',
            'integration_id' => $this->integrationId,
        ]);

        
        if ($res->successful() && $res->json('token')) {
            return $res->json();
        }

        Log::error('Paymob requestPaymentKey failed', ['resp' => $res->body()]);
        return null;
    }

    /**
     * Build an iframe redirect URL for the given payment token
     */
    protected function iframeUrl(string $paymentToken): ?string
    {
        if (empty($this->iframeId)) {
            Log::warning('Paymob iframe id not configured');
            return null;
        }

        return $this->endpoint . '/api/acceptance/iframes/' . $this->iframeId . '?payment_token=' . urlencode($paymentToken);
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
     * Validate Paymob callback signature
     */
    protected function validateCallback(array $data): bool
    {
        // Paymob uses HMAC for callback validation
        // You should implement signature validation based on Paymob docs
        // For now, returning true - IMPLEMENT PROPER VALIDATION IN PRODUCTION

        // Example validation (adjust based on Paymob's actual requirements):
        // $hmac = $data['hmac'] ?? '';
        // $calculatedHmac = hash_hmac('sha256', json_encode($data), $this->apiKey);
        // return hash_equals($calculatedHmac, $hmac);

        return true; // TODO: Implement proper HMAC validation
    }
}
