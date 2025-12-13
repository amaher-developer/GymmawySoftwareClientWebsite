<?php

namespace Modules\Common\Services;

use Modules\Common\Contracts\PaymentInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Tabby Payment Service Implementation
 *
 * Handles payment processing through Tabby gateway (Buy Now Pay Later)
 * Used by: Sixtyminutes, Almadagym, Zonegym modules
 */
class TabbyPaymentService implements PaymentInterface
{
    protected string $publicKey;
    protected string $secretKey;
    protected string $baseUrl;
    protected string $merchantCode;

    public function __construct()
    {
        $cfg = config('common.tabby', []);

        $this->publicKey = $cfg['public_key'] ?? '';
        $this->secretKey = $cfg['secret_key'] ?? '';
        $this->baseUrl = rtrim($cfg['base_url'] ?? 'https://api.tabby.ai', '/');
        $this->merchantCode = $cfg['merchant_code'] ?? '';
    }

    /**
     * Get HTTP client options with SSL handling
     *
     * @return array
     */
    protected function getHttpOptions(): array
    {
        $options = [];

        // For development/local environments with SSL issues
        //if (config('common.tabby.disable_ssl_verify', false)) {
            $options['verify'] = false;
        //}

        return $options;
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

            // Prepare Tabby payment payload
            $payload = $this->prepareTabbyPayload($orderData);

            // Create payment session with SSL options
            $response = Http::withOptions($this->getHttpOptions())
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->secretKey,
                    'Content-Type' => 'application/json',
                ])->post($this->baseUrl . '/api/v2/checkout', $payload);

            if (!$response->ok()) {
                Log::error('Tabby createPayment failed', [
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);

                return [
                    'success' => false,
                    'payment_url' => null,
                    'transaction_id' => null,
                    'message' => 'Failed to create Tabby payment session'
                ];
            }

            $data = $response->json();

            return [
                'success' => true,
                'payment_url' => $data['configuration']['available_products']['installments'][0]['web_url'] ?? null,
                'transaction_id' => $data['id'] ?? null,
                'message' => 'Payment session created successfully'
            ];

        } catch (\Exception $e) {
            Log::error('Tabby createPayment exception', [
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
            // Get payment ID from callback
            $paymentId = $callbackData['payment_id'] ?? $callbackData['id'] ?? null;

            if (!$paymentId) {
                return [
                    'success' => false,
                    'verified' => false,
                    'transaction_id' => null,
                    'order_id' => null,
                    'amount' => 0,
                    'status' => 'failed',
                    'message' => 'Payment ID not found in callback'
                ];
            }

            // Fetch payment details from Tabby API to verify
            $response = Http::withOptions($this->getHttpOptions())
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->secretKey,
                ])->get($this->baseUrl . '/api/v2/payments/' . $paymentId);

            if (!$response->ok()) {
                return [
                    'success' => false,
                    'verified' => false,
                    'transaction_id' => $paymentId,
                    'order_id' => null,
                    'amount' => 0,
                    'status' => 'failed',
                    'message' => 'Failed to verify payment with Tabby'
                ];
            }

            $data = $response->json();
            $status = strtolower($data['status'] ?? 'unknown');
            $isPaid = in_array($status, ['authorized', 'closed']);

            return [
                'success' => $isPaid,
                'verified' => true,
                'transaction_id' => $data['id'] ?? $paymentId,
                'order_id' => $data['order']['reference_id'] ?? null,
                'amount' => (float) ($data['amount'] ?? 0),
                'status' => $isPaid ? 'success' : $status,
                'message' => $isPaid ? 'Payment verified successfully' : 'Payment status: ' . $status
            ];

        } catch (\Exception $e) {
            Log::error('Tabby verifyPayment exception', [
                'error' => $e->getMessage(),
                'callback_data' => $callbackData
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
            $response = Http::withOptions($this->getHttpOptions())
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->secretKey,
                ])->get($this->baseUrl . '/api/v2/payments/' . $transactionId);

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
            $status = strtolower($data['status'] ?? 'unknown');
            $isPaid = in_array($status, ['authorized', 'closed']);

            return [
                'success' => $isPaid,
                'status' => $isPaid ? 'success' : $status,
                'amount' => (float) ($data['amount'] ?? 0),
                'transaction_id' => $data['id'] ?? $transactionId,
                'order_id' => $data['order']['reference_id'] ?? null,
                'paid_at' => $data['created_at'] ?? null,
                'message' => $isPaid ? 'Payment successful' : 'Payment status: ' . $status
            ];

        } catch (\Exception $e) {
            Log::error('Tabby getPaymentStatus exception', [
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
            // First, capture the payment if it's only authorized
            $captureResponse = Http::withOptions($this->getHttpOptions())
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->secretKey,
                    'Content-Type' => 'application/json',
                ])->post($this->baseUrl . '/api/v2/payments/' . $transactionId . '/captures', [
                    'amount' => $amount ?? 0
                ]);

            // Then process refund
            $refundPayload = [];
            if ($amount !== null) {
                $refundPayload['amount'] = $amount;
            }

            $response = Http::withOptions($this->getHttpOptions())
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->secretKey,
                    'Content-Type' => 'application/json',
                ])->post($this->baseUrl . '/api/v2/payments/' . $transactionId . '/refunds', $refundPayload);

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
                'refund_id' => $data['id'] ?? '',
                'refunded_amount' => (float) ($data['amount'] ?? 0),
                'message' => 'Refund processed successfully'
            ];

        } catch (\Exception $e) {
            Log::error('Tabby refundPayment exception', [
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
        return 'tabby';
    }

    // =====================================================================
    // PRIVATE HELPER METHODS
    // =====================================================================

    /**
     * Prepare Tabby payment payload from order data
     */
    protected function prepareTabbyPayload(array $orderData): array
    {
        $customer = $orderData['customer'] ?? [];
        $amount = (string) number_format((float) $orderData['amount'], 2, '.', '');
        $currency = strtoupper($orderData['currency'] ?? 'SAR');

        return [
            'payment' => [
                'amount' => $amount,
                'currency' => $currency,
                'description' => $orderData['description'] ?? 'Gym Subscription Payment',
                'buyer' => [
                    'phone' => $customer['phone'] ?? '',
                    'email' => $customer['email'] ?? 'guest@example.com',
                    'name' => $customer['name'] ?? 'Guest User',
                ],
                'order' => [
                    'reference_id' => $orderData['order_id'] ?? uniqid('ORDER_'),
                    'items' => $orderData['items'] ?? [
                        [
                            'title' => $orderData['description'] ?? 'Gym Subscription',
                            'quantity' => 1,
                            'unit_price' => $amount,
                            'category' => 'Subscription',
                        ]
                    ],
                ],
                'buyer_history' => [
                    'registered_since' => $customer['registered_since'] ?? now()->subMonths(6)->toIso8601String(),
                    'loyalty_level' => $customer['loyalty_level'] ?? 0,
                ],
            ],
            'lang' => $orderData['lang'] ?? 'en',
            'merchant_code' => $this->merchantCode,
            'merchant_urls' => [
                'success' => $orderData['return_url'] ?? url('/payment/success'),
                'cancel' => $orderData['cancel_url'] ?? url('/payment/cancel'),
                'failure' => $orderData['failure_url'] ?? url('/payment/failure'),
            ],
        ];
    }
}
