<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Cakorinas\app\Http\Controllers\Front\SubscriptionPaymentFrontController;

Route::name('subscription-payment')->get('/subscription-payment/{id}', [SubscriptionPaymentFrontController::class, 'show']);
Route::name('invoice-payment')->get('/invoice-payment/{id}', [SubscriptionPaymentFrontController::class, 'invoice']);
Route::name('invoice-payment')->post('/invoice-payment/{id}', [SubscriptionPaymentFrontController::class, 'invoiceSubmit']);

//Route::name('invoiceStore')->any('/invoice-store', [SubscriptionPaymentFrontController::class, 'invoiceStore']);
Route::name('invoice-return')->any('/invoice-return-payment', [SubscriptionPaymentFrontController::class, 'invoiceReturn']);

// Paymob payment routes
Route::name('paymob-verify-payment')->any('/paymob/verify-payment', [SubscriptionPaymentFrontController::class, 'paymobVerifyPayment']);
Route::name('error-payment')->get('/error-payment', [SubscriptionPaymentFrontController::class, 'error_payment']);




