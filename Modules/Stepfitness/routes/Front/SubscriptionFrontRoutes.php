<?php

use Modules\Stepfitness\app\Http\Controllers\Front\SubscriptionFrontController;
use Illuminate\Support\Facades\Route;

Route::name('subscription')->get('/subscription/{id}', [SubscriptionFrontController::class, 'show']);
Route::name('subscription-test')->get('/subscription-test/{id}', [SubscriptionFrontController::class, 'showTest']);
Route::name('invoice')->get('/invoice/{id}', [SubscriptionFrontController::class, 'invoice']);
Route::name('invoice')->post('/invoice/{id}', [SubscriptionFrontController::class, 'invoiceSubmit']);
//Route::name('invoiceStore')->any('/invoice-store', [SubscriptionFrontController::class, 'invoiceStore']);
Route::name('invoiceReturn')->any('/invoice-return', [SubscriptionFrontController::class, 'invoiceReturn']);
Route::name('tabby-error-cancel')->get('/tabby/error/cancel/{payment?}', [SubscriptionFrontController::class, 'tabbyCancel']);
Route::name('tabby-error-failure')->get('/tabby/error/failure/{payment?}', [SubscriptionFrontController::class, 'tabbyFailure']);


