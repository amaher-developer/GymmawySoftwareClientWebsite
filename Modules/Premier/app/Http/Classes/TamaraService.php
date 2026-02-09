<?php

namespace Modules\Premier\app\Http\Classes;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TamaraService
{
    public $base_url;
    public $api_token;

    public function __construct()
    {
        $this->base_url = rtrim(@env('TAMARA_API_URL', 'https://api.tamara.co'), '/') . '/';
        $this->api_token = @env('TAMARA_API_TOKEN');
    }

    public function createCheckout($data)
    {
        $body = $this->getConfig($data);
        $http = Http::withToken($this->api_token)->baseUrl($this->base_url);
        if (@env('TAMARA_IS_TEST'))
            $http = $http->withoutVerifying();
        $response = $http->post('checkout', $body);
        Log::info('TAMARA CREATE CHECKOUT', $response->json() ?? []);
        return $response->object();
    }

    public function getOrder($orderId)
    {
        $http = Http::withToken($this->api_token)->baseUrl($this->base_url);
        if (@env('TAMARA_IS_TEST'))
            $http = $http->withoutVerifying();
        $url = 'merchants/orders/' . $orderId;
        $response = $http->get($url);

        Log::info('TAMARA ORDER STATUS', $response->json() ?? []);
        return $response->object();
    }

    public function authoriseOrder($orderId)
    {
        $http = Http::withToken($this->api_token)->baseUrl($this->base_url);
        if (@env('TAMARA_IS_TEST'))
            $http = $http->withoutVerifying();
        $response = $http->post("orders/{$orderId}/authorise");

        Log::info('TAMARA AUTHORISE ORDER', $response->json() ?? []);
        return $response->object();
    }

    public function capturePayment($orderId, $amount, $items = [])
    {
        $currency = @env('TAMARA_CURRENCY', 'SAR');
        $http = Http::withToken($this->api_token)->baseUrl($this->base_url);
        if (@env('TAMARA_IS_TEST'))
            $http = $http->withoutVerifying();

        $captureItems = [];
        foreach ($items as $item) {
            $captureItems[] = [
                'reference_id' => (string)(@$item['reference_id'] ?? @$item['title'] ?? ''),
                'type' => 'Digital',
                'name' => @$item['title'] ?? @$item['name'] ?? '',
                'sku' => (string)(@$item['reference_id'] ?? ''),
                'quantity' => (int)(@$item['quantity'] ?? 1),
                'unit_price' => [
                    'amount' => (float)(@$item['unit_price'] ?? $amount),
                    'currency' => $currency,
                ],
                'total_amount' => [
                    'amount' => (float)(@$item['total_amount'] ?? $amount),
                    'currency' => $currency,
                ],
            ];
        }

        $response = $http->post('payments/capture', [
            'order_id' => $orderId,
            'total_amount' => [
                'amount' => (float) $amount,
                'currency' => $currency,
            ],
            'shipping_info' => [
                'shipped_at' => now()->toISOString(),
                'shipping_company' => 'Digital',
            ],
            'items' => $captureItems,
            'shipping_amount' => ['amount' => 0, 'currency' => $currency],
            'tax_amount' => ['amount' => 0, 'currency' => $currency],
        ]);

        Log::info('TAMARA CAPTURE PAYMENT', $response->json() ?? []);
        return $response->object();
    }

    public function getConfig($data)
    {
        $currency = @env('TAMARA_CURRENCY', 'SAR');
        $countryCode = @env('TAMARA_COUNTRY_CODE', 'SA');

        $items = [];
        if (!empty($data['items'])) {
            foreach ($data['items'] as $item) {
                $items[] = [
                    'reference_id' => (string)(@$item['reference_id'] ?? @$item['title'] ?? ''),
                    'type' => 'Digital',
                    'name' => @$item['title'] ?? @$item['name'] ?? '',
                    'sku' => (string)(@$item['reference_id'] ?? ''),
                    'quantity' => (int)(@$item['quantity'] ?? 1),
                    'discount_amount' => [
                        'amount' => (float)(@$item['discount_amount'] ?? 0),
                        'currency' => $currency,
                    ],
                    'tax_amount' => [
                        'amount' => (float)(@$item['tax_amount'] ?? 0),
                        'currency' => $currency,
                    ],
                    'unit_price' => [
                        'amount' => (float)(@$item['unit_price'] ?? 0),
                        'currency' => $currency,
                    ],
                    'total_amount' => [
                        'amount' => (float)(@$item['total_amount'] ?? @$item['unit_price'] ?? 0),
                        'currency' => $currency,
                    ],
                ];
            }
        }

        $nameParts = explode(' ', $data['full_name'] ?? '', 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? $firstName;

        $body = [
            'total_amount' => [
                'amount' => (float) $data['amount'],
                'currency' => $currency,
            ],
            'order_reference_id' => (string) $data['order_id'],
            'order_number' => (string) $data['order_id'],
            'description' => $data['description'] ?? 'Order #5',
            'country_code' => $countryCode,
            'payment_type' => 'PAY_BY_INSTALMENTS',
            'instalments' => 3,
            'consumer' => [
                'email' => $data['buyer_email'] ?? $data['email'] ?? '',
                'first_name' => $firstName,
                'last_name' => $lastName,
                'phone_number' => ($data['buyer_phone'] ?? ''),
            ],
            'items' => $items,
            'billing_address' => [
                'city' => $data['city'] ?? @env('TAMARA_CITY', 'Riyadh'),
                'country_code' => $countryCode,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'line1' => $data['address'] ?? 'Riyadh',
                'phone_number' => ($data['buyer_phone'] ?? ''),
            ],
            'shipping_address' => [
                'city' => $data['city'] ?? @env('TAMARA_CITY', 'Riyadh'),
                'country_code' => $countryCode,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'line1' => $data['address'] ?? 'Riyadh',
                'phone_number' => ($data['buyer_phone'] ?? ''),
            ],
            'tax_amount' => [
                'amount' => 0,
                'currency' => $currency,
            ],
            'shipping_amount' => [
                'amount' => 0,
                'currency' => $currency,
            ],
            'merchant_url' => [
                'success' => $data['success-url'] ?? '',
                'failure' => $data['failure-url'] ?? '',
                'cancel' => $data['cancel-url'] ?? '',
                'notification' => $data['notification-url'] ?? '',
            ],
        ];

        return $body;
    }
}
