<?php

namespace Modules\Common\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymobService
{
    protected string $endpoint;
    protected string $apiKey;
    protected int $integrationId;
    protected ?string $iframeId;

    public function __construct()
    {
        $cfg = config('common.paymob', []);

        $this->endpoint = rtrim($cfg['endpoint'] ?? 'https://accept.paymob.com', '/');
        $this->apiKey = $cfg['api_key'] ?? '';
        $this->integrationId = (int) ($cfg['integration_id'] ?? 0);
        $this->iframeId = $cfg['iframe_id'] ?? null;
    }

    /**
     * Authenticate with Paymob and return the auth token.
     *
     * @return string|null
     */
    public function auth(): ?string
    {
        if (empty($this->apiKey)) {
            Log::warning('PaymobService: API key not configured');
            return null;
        }

        $res = Http::asJson()->post($this->endpoint . '/api/auth/tokens', [
            'api_key' => $this->apiKey,
        ]);

        if ($res->ok()) {
            return $res->json('token');
        }

        Log::error('Paymob auth failed', ['resp' => $res->body()]);
        return null;
    }

    /**
     * Create an order on Paymob.
     *
     * @param int $amount_cents
     * @param string $currency
     * @return array|null
     */
    public function createOrder(int $amount_cents, string $currency = 'EGP'): ?array
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

        $res = Http::asJson()->post($this->endpoint . '/api/ecommerce/orders', $payload);

        if ($res->ok()) {
            return $res->json();
        }

        Log::error('Paymob createOrder failed', ['resp' => $res->body()]);
        return null;
    }

    /**
     * Request a payment key for an order.
     *
     * @param int $orderId
     * @param int $amount_cents
     * @param array $billingData
     * @return array|null
     */
    public function requestPaymentKey(int $orderId, int $amount_cents, array $billingData = []): ?array
    {
        $token = $this->auth();
        if (!$token) {
            return null;
        }

        $res = Http::asJson()->post($this->endpoint . '/api/acceptance/payment_keys', [
            'auth_token' => $token,
            'amount_cents' => $amount_cents,
            'expiration' => 3600,
            'order_id' => $orderId,
            'billing_data' => $billingData,
            'currency' => 'EGP',
            'integration_id' => $this->integrationId,
        ]);

        if ($res->ok()) {
            return $res->json();
        }

        Log::error('Paymob requestPaymentKey failed', ['resp' => $res->body()]);
        return null;
    }

    /**
     * Build an iframe redirect URL for the given payment token.
     *
     * @param string $paymentToken
     * @return string|null
     */
    public function iframeUrl(string $paymentToken): ?string
    {
        if (empty($this->iframeId)) {
            Log::warning('Paymob iframe id not configured');
            return null;
        }

        return $this->endpoint . '/api/acceptance/iframes/' . $this->iframeId . '?payment_token=' . urlencode($paymentToken);
    }
}
