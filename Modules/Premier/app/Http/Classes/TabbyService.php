<?php

namespace Modules\Premier\app\Http\Classes;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TabbyService
{
    public $base_url;
    public $pk_test;
    public $sk_test;
    public function __construct()
    {
        $this->base_url = @env('TABBY_BASE_URL');
        $this->pk_test = @env('TABBY_PK');
        $this->sk_test = @env('TABBY_SK');
    }

    public function createSession($data)
    {
        $body = $this->getConfig($data);
        $http = Http::withToken($this->sk_test)->baseUrl($this->base_url.'v2/');
        if(@env('TABBY_IS_TEST'))
            $http = $http->withoutVerifying();
        $response = $http->post('checkout',$body);
        return $response->object();
    }

    public function getSession($payment_id)
    {
        $http = Http::withToken($this->sk_test)->baseUrl($this->base_url.'v2/');
        if(@env('TABBY_IS_TEST'))
            $http = $http->withoutVerifying();
        $url = 'checkout/'.$payment_id;
        $response = $http->get($url);
        return $response->object();
    }

    public function getPayment($payment_id){
        $http = Http::withToken($this->sk_test)->baseUrl($this->base_url.'v2/');
        if(@env('TABBY_IS_TEST'))
            $http = $http->withoutVerifying();
        $url = 'payments/'.$payment_id;
        $response = $http->get($url);

        Log::info('TABBY PAYMENT STATUS', $response->json());
        return $response->object();
    }

    public function createWebHooks(){
        $body = ['url' => route('tabby-notify'), 'is_test' => @env('TABBY_IS_TEST', false)];
        $http = Http::withToken($this->sk_test)->withHeaders(['X-Merchant-Code' => @env('TABBY_MERCHANT_CODE', 'مركز اللياقة الرائدة للرياضة النسائيةsau')])->baseUrl($this->base_url.'v1/');
        if(@env('TABBY_IS_TEST'))
            $http = $http->withoutVerifying();
        $response = $http->post('webhooks',$body);
        return $response->object();
    }

    public function getWebHooks(){
//        $create = $this->createWebHooks();
//        if(@$create->id) {
        $http = Http::withToken($this->sk_test)->withHeaders(['X-Merchant-Code' => env('TABBY_MERCHANT_CODE', 'مركز اللياقة الرائدة للرياضة النسائيةsau')])->baseUrl($this->base_url.'v1/');
        if(@env('TABBY_IS_TEST'))
            $http = $http->withoutVerifying();
        $url = 'webhooks' ;
        $response = $http->get($url);
        return $response->object();
//        }
//        return false;
    }

    public function capturePayment($paymentId, $amount, $items = [])
    {
        $http = Http::withToken($this->sk_test)
            ->baseUrl($this->base_url . 'v2/');

        if (env('TABBY_IS_TEST')) {
            $http = $http->withoutVerifying();
        }

        $response = $http->post("payments/{$paymentId}/captures", [
            'amount'   => (string) $amount,
            'currency' => 'SAR',
        ]);

        return $response->object();
    }

    public function getConfig($data)
    {
        $body = [
            "payment" => [
                "amount" => (string) $data['amount'],
                "currency" => $data['currency'],
                "description" =>  $data['description'],
                "buyer" => array_filter([
                    "phone" => $data['buyer_phone'],
                    "email" => $data['buyer_email'] ?? '',
                    "name" => $data['full_name'],
                    "dob" => $data['buyer_dob'] ?? null,
                ]),
                "shipping_address" => [
                    "city" => $data['city'],
                    "address" =>  $data['address'],
                    "zip" => $data['zip'],
                    "country" => $data['country'] ?? env('TABBY_COUNTRY', 'SA'),
                ],
                "order" => [
                    "tax_amount" =>  "0.00",
                    "shipping_amount" =>  "0.00",
                    "discount_amount" => "0.00",
                    "updated_at" => $data['updated_at'],
                    "reference_id" => (string) $data['order_id'],
                    "items" => $data['items'],
                ],
                "buyer_history" => [
                    "registered_since"=> $data['registered_since'],
                    "loyalty_level"=> $data['loyalty_level'],
                ],
                "order_history" => $data['order_history'] ?? [],
            ],
            "lang" => app()->getLocale(),
            "merchant_code" => @env('TABBY_MERCHANT_CODE'),
            "merchant_urls" => [
                "success" => $data['success-url'],
                "cancel" => @$data['cancel-url'],
                "failure" => @$data['failure-url'],
            ]
        ];
        return $body;
    }
}
