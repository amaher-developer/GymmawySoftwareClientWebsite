<?php

use Illuminate\Support\Facades\Route;

Route::name('subscription-payment')->get('/subscription-payment/{id}', 'Front\SubscriptionPaymentFrontController@show');
Route::name('invoice-payment')->get('/invoice-payment/{id}', 'Front\SubscriptionPaymentFrontController@invoice');
Route::name('invoice-payment')->post('/invoice-payment/{id}', 'Front\SubscriptionPaymentFrontController@invoiceSubmit');

//Route::name('invoiceStore')->any('/invoice-store', 'Front\SubscriptionPaymentFrontController@invoiceStore');
Route::name('invoice-return')->any('/invoice-return-payment', 'Front\SubscriptionPaymentFrontController@invoiceReturn');




