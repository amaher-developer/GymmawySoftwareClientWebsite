<?php

namespace Modules\Premier\app\Http\Classes;

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

    public function __construct()
    {
        $this->profileId  = env('PAYTABS_PROFILE_ID');
        $this->serverKey  = env('PAYTABS_SERVER_KEY', 'S6J9TLHLKM-JMKZHRDBD6-NBKNZJDHWN');
        $this->clientKey  = env('PAYTABS_CLIENT_KEY', 'C6K2KM-VQN26N-K9HRD2-7DKPN9');
        $this->baseUrl    = rtrim(env('PAYTABS_BASE_URL', 'https://secure.paytabs.sa'), '/') . '/';
        $this->currency   = env('PAYTABS_CURRENCY', 'SAR');
        $this->country    = env('PAYTABS_COUNTRY', 'SA');
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
        
        if (@env('PAYTABS_IS_TEST'))
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
        if (@env('PAYTABS_IS_TEST'))
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
