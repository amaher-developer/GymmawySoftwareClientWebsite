<?php

namespace Modules\Fitdose\app\Http\Classes;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaytabsService
{
    public $profileId;
    public $serverKey;
    public $clientKey;
    public $baseUrl;
    public $currency;
    public $country;
    public $city;
    public $address;
    public $isTest;

    public function __construct($settings = null)
    {
        $config = $settings->payments['paytabs'] ?? [];

        $this->profileId  = $config['profile_id'] ?? env('PAYTABS_PROFILE_ID');
        $this->serverKey  = $config['server_key'] ?? env('PAYTABS_SERVER_KEY', '');
        $this->clientKey  = $config['client_key'] ?? env('PAYTABS_CLIENT_KEY', '');
        $this->baseUrl    = rtrim($config['base_url'] ?? env('PAYTABS_BASE_URL', 'https://secure.paytabs.sa'), '/') . '/';
        $this->currency   = $config['currency'] ?? env('PAYTABS_CURRENCY', 'SAR');
        $this->country    = $config['country'] ?? env('PAYTABS_COUNTRY', 'SA');
        $this->city       = $config['city'] ?? env('PAYTABS_CITY');
        $this->address    = $config['address'] ?? env('PAYTABS_ADDRESS');
        $this->isTest     = filter_var($config['is_test'] ?? env('PAYTABS_IS_TEST', false), FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Create a hosted payment page (Standard integration).
     *
     * @param  array  $data  {cart_id, description, amount, callback_url, return_url, name, email, phone, address, city}
     * @return array  Paytabs response (contains redirect_url and tran_ref on success)
     */
    public function createPaymentPage(array $data): array
    {
        $body = [
            'profile_id'       => $this->profileId,
            'tran_type'        => 'sale',
            'tran_class'       => 'ecom',
            'cart_id'          => (string) $data['cart_id'],
            'cart_description' => $data['description'],
            'cart_currency'    => $this->currency,
            'cart_amount'      => (float) $data['amount'],
            'callback'         => $data['callback_url'],
            'return'           => $data['return_url'],
            'customer_details' => [
                'name'    => $data['name'],
                'email'   => $data['email'] ?? '',
                'phone'   => $data['phone'],
                'street1' => $data['address'] ?? 'Riyadh',
                'city'    => $data['city'] ?? 'Riyadh',
                'country' => $this->country,
            ],
        ];

        $http = Http::withHeaders([
            'authorization' => $this->serverKey,
            'Content-Type'  => 'application/json',
        ]);
        
        if ($this->isTest)
            $http = $http->withoutVerifying();

        $response = $http->post($this->baseUrl . 'payment/request', $body);

        Log::info('PAYTABS CREATE PAYMENT PAGE', $response->json() ?? []);

        return $response->json() ?? [];
    }

    /**
     * Query the transaction status from Paytabs.
     *
     * @param  string  $tranRef  The transaction reference returned when creating the page.
     * @return array
     */
    public function verifyPayment(string $tranRef): array
    {
        $body = [
            'profile_id' => $this->profileId,
            'tran_ref'   => $tranRef,
        ];

        $http = Http::withHeaders([
            'authorization' => $this->serverKey,
            'Content-Type'  => 'application/json',
        ]);
        if ($this->isTest)
            $http = $http->withoutVerifying();

        $response = $http->post($this->baseUrl . 'payment/query', $body);

        Log::info('PAYTABS VERIFY PAYMENT', $response->json() ?? []);

        return $response->json() ?? [];
    }

    /**
     * Validate the IPN / redirect signature sent by Paytabs.
     * Paytabs computes: HMAC-SHA256 of URL-encoded query string (sorted, no empty values)
     * using the server key as the secret.
     *
     * @param  array  $postValues  All POST values received from Paytabs.
     * @return bool
     */
    public function isValidSignature(array $postValues): bool
    {
        if (!isset($postValues['signature'])) {
            return false;
        }

        $requestSignature = $postValues['signature'];
        unset($postValues['signature']);

        $fields = array_filter($postValues, function ($v) {
            return $v !== null && $v !== '';
        });

        ksort($fields);

        $query     = http_build_query($fields);
        $signature = hash_hmac('sha256', $query, $this->serverKey);

        return hash_equals($signature, $requestSignature);
    }

    /**
     * Extract payment_result.response_status from a Paytabs response array.
     * Returns 'A' for Authorised/Success; any other value means failure.
     */
    public function getResponseStatus(array $response): ?string
    {
        return @$response['payment_result']['response_status'] ?? null;
    }
}
