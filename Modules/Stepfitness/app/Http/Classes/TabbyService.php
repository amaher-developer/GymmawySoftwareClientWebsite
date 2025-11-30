<?php

namespace Modules\Stepfitness\app\Http\Classes;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

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
        $http = Http::withToken($this->pk_test)->baseUrl($this->base_url.'v2/');
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
        return $response->object();
    }

    public function createWebHooks(){
        $body = ['url' => route('tabby-notify'), 'is_test' => @env('TABBY_IS_TEST', false)];
        $http = Http::withToken($this->sk_test)->withHeaders(['X-Merchant-Code' => @env('TABBY_MERCHANT_CODE')])->baseUrl($this->base_url.'v1/');
        if(@env('TABBY_IS_TEST'))
            $http = $http->withoutVerifying();
        $response = $http->post('webhooks',$body);
        return $response->object();
    }

    public function getWebHooks(){
//        $create = $this->createWebHooks();
//        if(@$create->id) {
        $http = Http::withToken($this->sk_test)->withHeaders(['X-Merchant-Code' => env('TABBY_MERCHANT_CODE')])->baseUrl($this->base_url.'v1/');
        if(@env('TABBY_IS_TEST'))
            $http = $http->withoutVerifying();
        $url = 'webhooks' ;
        $response = $http->get($url);
        return $response->object();
//        }
//        return false;
    }

    public function capturePayment($payment_id, $amount){
        $body = ['amount' => $amount];
        $http = Http::withToken($this->sk_test)->baseUrl($this->base_url.'v2/');
        if(@env('TABBY_IS_TEST'))
            $http = $http->withoutVerifying();
        $response = $http->post('payments/'.$payment_id.'/captures',$body);
        return $response->object();
    }

    public function getConfig($data)
    {
        $body= [];
        $body = [
            "payment" => [
                "amount" => $data['amount'],
                "currency" => $data['currency'],
                "description" =>  $data['description'],
                "buyer" => [
                    "phone" => $data['buyer_phone'],
                    "email" => $data['buyer_email'],
                    "name" => $data['full_name'],
//                    "dob" => $data['dob'],
                ],
                "shipping_address" => [
                    "city" => $data['city'],
                    "address" =>  $data['address'],
                    "zip" => $data['zip'],
                ],
                "order" => [
                    "tax_amount" =>  "0.00",
                    "shipping_amount" =>  "0.00",
                    "discount_amount" => "0.00",
                    "updated_at" => $data['updated_at'],//"2019-08-24T14:15:22Z",
                    "reference_id" => $data['order_id'],
                    "items" => $data['items'],
                ],
                "buyer_history" => [
                    "registered_since"=> $data['registered_since'],
                    "loyalty_level"=> $data['loyalty_level'],
                ],
                "order_history" => [
                    collect([
                        "purchased_at"=> $data['purchased_at'],
                        "amount"=> $data['amount'],
                        "status"=> $data['status']
                    ])
                ],
            ],
            "lang" => app()->getLocale(),
            "merchant_code" => @env('TABBY_MERCHANT_CODE'),
            "merchant_urls" => [
                "success" => $data['success-url'],
                "cancel" => @$data['cancel-url'],
                "failure" => @$data['failure-url'],
            ]
        ];
//dd($body);
        return $body;
    }
}
