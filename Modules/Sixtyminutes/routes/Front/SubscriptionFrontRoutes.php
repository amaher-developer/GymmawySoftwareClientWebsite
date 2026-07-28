<?php

use Modules\Sixtyminutes\app\Http\Controllers\Front\SubscriptionFrontController;
use Illuminate\Support\Facades\Route;

Route::name('subscription')->get('/subscription/{id}', [SubscriptionFrontController::class, 'show']);
Route::name('subscription-mobile')->get('/subscription-mobile/{id}', [SubscriptionFrontController::class, 'showMobile']);
Route::name('pt-class')->get('/pt/{id}', [SubscriptionFrontController::class, 'showPTClass']);
Route::name('invoice')->get('/invoice/{id}', [SubscriptionFrontController::class, 'invoice']);
Route::name('invoice')->post('/invoice/{id}', [SubscriptionFrontController::class, 'invoiceSubmit']);
Route::name('invoice-mobile')->get('/invoice-mobile/{id}', [SubscriptionFrontController::class, 'invoiceMobile']);

Route::get('/payments/verify/{payment?}', [SubscriptionFrontController::class, 'payment_verify'])->name('verify-payment');
Route::post('/payments/verify/{payment?}', [SubscriptionFrontController::class, 'payment_verify'])->name('verify-payment');
Route::get('/payments/error/{payment?}', [SubscriptionFrontController::class, 'error_payment'])->name('error-payment');

Route::name('tabby-verify-payment')->get('/payments/tabby-verify/{payment?}', [SubscriptionFrontController::class, 'tabby_payment_verify']);
Route::name('tabby-error-cancel')->get('/tabby/error/cancel/{payment?}', [SubscriptionFrontController::class, 'tabbyCancel']);
Route::name('tabby-error-failure')->get('/tabby/error/failure/{payment?}', [SubscriptionFrontController::class, 'tabbyFailure']);

Route::name('tamara-verify-payment')->get('/payments/tamara-verify/{payment?}', [SubscriptionFrontController::class, 'tamara_payment_verify']);
Route::name('tamara-error-cancel')->get('/tamara/error/cancel/{payment?}', [SubscriptionFrontController::class, 'tamaraCancel']);
Route::name('tamara-error-failure')->get('/tamara/error/failure/{payment?}', [SubscriptionFrontController::class, 'tamaraFailure']);
Route::post('/payments/tamara-refund/{invoice}', [SubscriptionFrontController::class, 'tamaraRefund'])
    ->name('tamara-refund')
    ->middleware(['permission:super']);

Route::match(['get', 'post'], '/payments/paytabs-verify/{payment?}', [SubscriptionFrontController::class, 'paytabs_payment_verify'])->name('paytabs-verify-payment');
Route::name('paytabs-error-cancel')->get('/paytabs/error/cancel/{payment?}', [SubscriptionFrontController::class, 'paytabsCancel']);
Route::name('paytabs-error-failure')->get('/paytabs/error/failure/{payment?}', [SubscriptionFrontController::class, 'paytabsFailure']);

Route::get('tabby-register-webhook', [SubscriptionFrontController::class, 'tabbyRegisterWebhook'])
    ->name('tabby-register-webhook')
    ->middleware(['permission:super']);

Route::get('tabby-check-webhooks', [SubscriptionFrontController::class, 'tabbyCheckWebhooks'])
    ->name('tabby-check-webhooks')
    ->middleware(['permission:super']);
