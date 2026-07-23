<?php

namespace Modules\Common\Services;

use Modules\Common\Contracts\PaymentInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Paymob Intention API ("Flash" / Unified Checkout) Payment Service
 *
 * Implements the modern Intention integration path documented at
 * https://developers.paymob.com/paymob-docs/integration-paths/apis
 * (POST /v1/intention/ -> client_secret -> Unified Checkout redirect).
 *
 * This is a separate integration from the legacy order/payment-key flow in
 * PaymobPaymentService/PaymobService — it does not replace or modify them.
 */
class PaymobIntentionService implements PaymentInterface
{
    protected string $endpoint;
    protected string $secretKey;
    protected string $publicKey;
    protected string $hmacSecret;
    protected string $apiKey;
    protected array $paymentMethods;

    public function __construct()
    {
        $cfg = config('common.paymob') ?? config('paymob') ?? [];

        $this->endpoint = rtrim(
            $cfg['endpoint'] ?? env('PAYMOB_ENDPOINT', 'https://accept.paymob.com'),
            '/'
        );
        $this->secretKey = $cfg['secret_key'] ?? env('PAYMOB_SECRET_KEY', '');
        $this->publicKey = $cfg['public_key'] ?? env('PAYMOB_PUBLIC_KEY', '');
        $this->hmacSecret = $cfg['hmac_secret'] ?? env('PAYMOB_HMAC_SECRET', '');
        $this->apiKey = $cfg['api_key'] ?? env('PAYMOB_API_KEY', '');

        $configuredMethods = $cfg['intention_payment_methods'] ?? [];
        if (empty($configuredMethods)) {
            $integrationId = (int) ($cfg['integration_id'] ?? env('PAYMOB_INTEGRATION_ID', 0));
            $configuredMethods = $integrationId ? [$integrationId] : [];
        }
        $this->paymentMethods = $configuredMethods;
    }

    /**
     * {@inheritDoc}
     */
    public function createPayment(array $orderData): array
    {
        try {
            if (empty($orderData['amount']) || empty($orderData['currency'])) {
                return $this->failure('Amount and currency are required');
            }

            if (empty($this->secretKey) || empty($this->publicKey)) {
                return $this->failure('Paymob Intention API is not configured (secret/public key missing)');
            }

            $amountCents = (int) round($orderData['amount'] * 100);

            $payload = array_filter([
                'amount' => $amountCents,
                'currency' => $orderData['currency'],
                'payment_methods' => $this->paymentMethods,
                'items' => $orderData['items'] ?? [],
                'billing_data' => $this->prepareBillingData($orderData),
                'special_reference' => $orderData['order_id'] ?? null,
                'notification_url' => $orderData['notification_url'] ?? null,
                'redirection_url' => $orderData['return_url'] ?? null,
                'expiration' => $orderData['expiration'] ?? 3600,
            ], fn ($value) => $value !== null);

            $response = Http::withOptions(['verify' => false])
                ->withToken($this->secretKey, 'Token')
                ->asJson()
                ->post($this->endpoint . '/v1/intention/', $payload);

            if (!$response->successful() || empty($response->json('client_secret'))) {
                Log::error('Paymob Intention createPayment failed', ['resp' => $response->body()]);
                return $this->failure('Failed to create Paymob payment intention');
            }

            $data = $response->json();

            return [
                'success' => true,
                'payment_url' => $this->checkoutUrl($data['client_secret']),
                'transaction_id' => (string) ($data['id'] ?? $data['intention_order_id'] ?? ''),
                'message' => 'Payment intention created successfully',
            ];
        } catch (\Exception $e) {
            Log::error('Paymob Intention createPayment exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return $this->failure('Payment creation failed: ' . $e->getMessage());
        }
    }

    /**
     * {@inheritDoc}
     */
    public function verifyPayment(array $callbackData): array
    {
        try {
            Log::info('Paymob Intention callback received', ['data' => $callbackData]);

            $txnData = $callbackData['obj'] ?? $callbackData;
            $isValid = $this->validateCallback($callbackData);

            if (!$isValid) {
                Log::warning('Paymob Intention callback HMAC validation failed', ['data' => $callbackData]);
            }

            $errorOccurred = $this->toBool($txnData['error_occured'] ?? false);
            $isSuccessFlag = $this->toBool($txnData['success'] ?? false);
            $isPaid = $isValid && $isSuccessFlag && !$errorOccurred;

            $transactionId = $txnData['id'] ?? null;
            $order = $txnData['order'] ?? null;
            $orderId = is_array($order) ? ($order['id'] ?? null) : $order;
            $merchantOrderId = is_array($order) ? ($order['merchant_order_id'] ?? null) : null;
            $amountCents = $txnData['amount_cents'] ?? 0;

            return [
                'success' => $isPaid,
                'verified' => $isValid,
                'transaction_id' => (string) $transactionId,
                'order_id' => (string) ($merchantOrderId ?? $orderId ?? ($callbackData['special_reference'] ?? '')),
                'amount' => (float) ($amountCents / 100),
                'status' => $isPaid ? 'success' : 'failed',
                'message' => $isPaid ? 'Payment verified successfully' : ($txnData['data_message'] ?? 'Payment failed or pending'),
                'error_occurred' => $errorOccurred,
                'raw_data' => $txnData,
            ];
        } catch (\Exception $e) {
            Log::error('Paymob Intention verifyPayment exception', [
                'error' => $e->getMessage(),
                'callback_data' => $callbackData,
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'verified' => false,
                'transaction_id' => null,
                'order_id' => null,
                'amount' => 0,
                'status' => 'failed',
                'message' => 'Verification failed: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getPaymentStatus(string $transactionId): array
    {
        try {
            if (empty($this->secretKey)) {
                return [
                    'success' => false,
                    'status' => 'unknown',
                    'amount' => 0,
                    'transaction_id' => $transactionId,
                    'order_id' => null,
                    'paid_at' => null,
                    'message' => 'Paymob Intention API is not configured',
                ];
            }

            $response = Http::withOptions(['verify' => false])
                ->withToken($this->secretKey, 'Token')
                ->get($this->endpoint . '/v1/intention/' . $transactionId . '/');

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'status' => 'unknown',
                    'amount' => 0,
                    'transaction_id' => $transactionId,
                    'order_id' => null,
                    'paid_at' => null,
                    'message' => 'Failed to fetch payment intention status',
                ];
            }

            $data = $response->json();
            $isPaid = ($data['status'] ?? null) === 'paid';

            return [
                'success' => $isPaid,
                'status' => $isPaid ? 'success' : 'pending',
                'amount' => ($data['amount'] ?? 0) / 100,
                'transaction_id' => (string) ($data['id'] ?? $transactionId),
                'order_id' => (string) ($data['special_reference'] ?? ''),
                'paid_at' => $data['updated_at'] ?? null,
                'message' => $isPaid ? 'Payment successful' : 'Payment pending',
            ];
        } catch (\Exception $e) {
            Log::error('Paymob Intention getPaymentStatus exception', [
                'transaction_id' => $transactionId,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'status' => 'unknown',
                'amount' => 0,
                'transaction_id' => $transactionId,
                'order_id' => null,
                'paid_at' => null,
                'message' => 'Status check failed: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function refundPayment(string $transactionId, ?float $amount = null): array
    {
        try {
            $authToken = $this->legacyAuth();
            if (!$authToken) {
                return [
                    'success' => false,
                    'refund_id' => null,
                    'refunded_amount' => 0,
                    'message' => 'Authentication failed',
                ];
            }

            $payload = [
                'auth_token' => $authToken,
                'transaction_id' => $transactionId,
            ];

            if ($amount !== null) {
                $payload['amount_cents'] = (int) round($amount * 100);
            }

            $response = Http::withOptions(['verify' => false])
                ->asJson()
                ->post($this->endpoint . '/api/acceptance/void_refund/refund', $payload);

            if (!$response->successful()) {
                Log::error('Paymob Intention refundPayment failed', ['resp' => $response->body()]);
                return [
                    'success' => false,
                    'refund_id' => null,
                    'refunded_amount' => 0,
                    'message' => 'Refund request failed',
                ];
            }

            $data = $response->json();

            return [
                'success' => true,
                'refund_id' => (string) ($data['id'] ?? ''),
                'refunded_amount' => ($data['amount_cents'] ?? 0) / 100,
                'message' => 'Refund processed successfully',
            ];
        } catch (\Exception $e) {
            Log::error('Paymob Intention refundPayment exception', [
                'transaction_id' => $transactionId,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'refund_id' => null,
                'refunded_amount' => 0,
                'message' => 'Refund failed: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getProviderName(): string
    {
        return 'paymob_intention';
    }

    /**
     * Override the config/env-sourced credentials with values loaded at runtime
     * (e.g. from a module's `settings` table). Only non-empty keys are applied,
     * so a partially-filled settings row still falls back to config/env for the rest.
     */
    public function applyOverrides(array $overrides): static
    {
        if (!empty($overrides['api_key'])) {
            $this->apiKey = $overrides['api_key'];
        }
        if (!empty($overrides['hmac_secret'])) {
            $this->hmacSecret = $overrides['hmac_secret'];
        }
        if (!empty($overrides['integration_id'])) {
            $this->paymentMethods = [(int) $overrides['integration_id']];
        }
        if (!empty($overrides['secret_key'])) {
            $this->secretKey = $overrides['secret_key'];
        }
        if (!empty($overrides['public_key'])) {
            $this->publicKey = $overrides['public_key'];
        }
        if (!empty($overrides['endpoint'])) {
            $this->endpoint = rtrim($overrides['endpoint'], '/');
        }

        return $this;
    }

    /**
     * Standard failure response shape for createPayment.
     */
    protected function failure(string $message): array
    {
        return [
            'success' => false,
            'payment_url' => null,
            'transaction_id' => null,
            'message' => $message,
        ];
    }

    /**
     * Build the Unified Checkout redirect URL for a given client secret.
     */
    protected function checkoutUrl(string $clientSecret): string
    {
        return $this->endpoint . '/unifiedcheckout/?publicKey=' . urlencode($this->publicKey)
            . '&clientSecret=' . urlencode($clientSecret);
    }

    /**
     * Prepare billing data required by the Intention API.
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
     * Authenticate against the legacy token endpoint using the API key.
     * Only used for the void/refund endpoint, which still requires an auth_token.
     */
    protected function legacyAuth(): ?string
    {
        if (empty($this->apiKey)) {
            Log::warning('PaymobIntentionService: API key not configured for refund');
            return null;
        }

        $res = Http::withOptions(['verify' => false])
            ->asJson()
            ->post($this->endpoint . '/api/auth/tokens', ['api_key' => $this->apiKey]);

        return $res->json('token');
    }

    /**
     * Validate the HMAC signature of a Paymob transaction callback.
     *
     * Field order per https://developers.paymob.com/paymob-docs/developers/webhook-callbacks-and-hmac/hmac
     */
    protected function validateCallback(array $callbackData): bool
    {
        if (empty($this->hmacSecret)) {
            Log::warning('PaymobIntentionService: HMAC secret not configured, cannot validate callback');
            return false;
        }

        $providedHmac = $callbackData['hmac'] ?? null;
        if (empty($providedHmac)) {
            return false;
        }

        $txn = $callbackData['obj'] ?? $callbackData;

        $fields = [
            'amount_cents', 'created_at', 'currency', 'error_occured', 'has_parent_transaction',
            'id', 'integration_id', 'is_3d_secure', 'is_auth', 'is_capture', 'is_refunded',
            'is_standalone_payment', 'is_voided', 'order.id', 'owner', 'pending',
            'source_data.pan', 'source_data.sub_type', 'source_data.type', 'success',
        ];

        $concatenated = '';
        foreach ($fields as $field) {
            $concatenated .= $this->hmacStringValue($this->extractHmacField($txn, $field));
        }

        $calculated = hash_hmac('sha512', $concatenated, $this->hmacSecret);

        return hash_equals($calculated, (string) $providedHmac);
    }

    protected function extractHmacField(array $txn, string $field)
    {
        if (str_contains($field, '.')) {
            [$parent, $child] = explode('.', $field, 2);
            return $txn[$parent][$child] ?? null;
        }

        return $txn[$field] ?? null;
    }

    protected function hmacStringValue($value): string
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        return (string) $value;
    }

    protected function toBool($value): bool
    {
        return $value === true || $value === 'true' || $value === '1' || $value === 1;
    }
}
