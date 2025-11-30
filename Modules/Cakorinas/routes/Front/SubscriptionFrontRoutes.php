<?php

use Illuminate\Support\Facades\Route;

Route::name('subscription')->get('/subscription/{id}', [Modules\Cakorinas\app\Http\Controllers\Front\SubscriptionFrontController::class, 'show']);
Route::name('subscription-test')->get('/subscription-test/{id}', [Modules\Cakorinas\app\Http\Controllers\Front\SubscriptionFrontController::class, 'showTest']);
Route::name('invoice')->get('/invoice/{id}', [Modules\Cakorinas\app\Http\Controllers\Front\SubscriptionFrontController::class, 'invoice']);
Route::name('invoice')->post('/invoice/{id}', [Modules\Cakorinas\app\Http\Controllers\Front\SubscriptionFrontController::class, 'invoiceSubmit']);
Route::name('reservation')->post('/reservation/{id}', [Modules\Cakorinas\app\Http\Controllers\Front\SubscriptionFrontController::class, 'reservationSubmit']);

//Route::name('invoiceStore')->any('/invoice-store', 'Front\SubscriptionFrontController@invoiceStore');
Route::name('invoiceReturn')->any('/invoice-return', [Modules\Cakorinas\app\Http\Controllers\Front\SubscriptionFrontController::class, 'invoiceReturn']);
Route::name('tabby-error-cancel')->get('/tabby/error/cancel/{payment?}', [Modules\Cakorinas\app\Http\Controllers\Front\SubscriptionFrontController::class, 'tabbyCancel']);
Route::name('tabby-error-failure')->get('/tabby/error/failure/{payment?}', [Modules\Cakorinas\app\Http\Controllers\Front\SubscriptionFrontController::class, 'tabbyFailure']);

Route::name('pt-class')->get('/pt/{id}', [Modules\Cakorinas\app\Http\Controllers\Front\SubscriptionFrontController::class, 'showPTClass']);






