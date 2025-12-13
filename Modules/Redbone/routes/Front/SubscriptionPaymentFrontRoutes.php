<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Redbone\app\Http\Controllers\Front\SubscriptionPaymentFrontController;

Route::name('subscription-payment')->get('/subscription-payment/{id}', [SubscriptionPaymentFrontController::class, 'show']);
Route::name('invoice-payment')->get('/invoice-payment/{id}', [SubscriptionPaymentFrontController::class, 'invoice']);
Route::name('invoice-payment')->post('/invoice-payment/{id}', [SubscriptionPaymentFrontController::class, 'invoiceSubmit']);

//Route::name('invoiceStore')->any('/invoice-store', [SubscriptionPaymentFrontController::class, 'invoiceStore']);
Route::name('invoice-return')->any('/invoice-return-payment', [SubscriptionPaymentFrontController::class, 'invoiceReturn']);




