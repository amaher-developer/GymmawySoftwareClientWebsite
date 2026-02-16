<?php

use Modules\Premier\app\Http\Controllers\Front\SubscriptionFrontController;
use Illuminate\Support\Facades\Route;

Route::name('subscription')->get('/subscription/{id}', [SubscriptionFrontController::class, 'show']);
Route::name('subscription-mobile')->get('/subscription-mobile/{id}', [SubscriptionFrontController::class, 'showMobile']);
Route::name('invoice')->get('/invoice/{id}', [SubscriptionFrontController::class, 'invoice']);
Route::name('invoice')->post('/invoice/{id}', [SubscriptionFrontController::class, 'invoiceSubmit']);
Route::name('tabby-error-cancel')->get('/tabby/error/cancel/{payment?}', [SubscriptionFrontController::class, 'tabbyCancel']);
Route::name('tabby-error-failure')->get('/tabby/error/failure/{payment?}', [SubscriptionFrontController::class, 'tabbyFailure']);
Route::name('tamara-error-cancel')->get('/tamara/error/cancel/{payment?}', [SubscriptionFrontController::class, 'tamaraCancel']);
Route::name('tamara-error-failure')->get('/tamara/error/failure/{payment?}', [SubscriptionFrontController::class, 'tamaraFailure']);



Route::get('tabby-register-webhook', [SubscriptionFrontController::class, 'tabbyRegisterWebhook'])
->name('tabby-register-webhook')
->middleware(['permission:super']);

Route::get('tabby-check-webhooks', [SubscriptionFrontController::class, 'tabbyCheckWebhooks'])
->name('tabby-check-webhooks')
->middleware(['permission:super']);