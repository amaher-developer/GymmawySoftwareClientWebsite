<?php

use Illuminate\Support\Facades\Route;

Route::name('subscription')->get('/subscription/{id}', [\App\Modules\Sixtyminutes\app\Http\Controllers\Front\SubscriptionFrontController::class, 'show']);
Route::name('subscription-test')->get('/subscription-test/{id}', [\App\Modules\Sixtyminutes\app\Http\Controllers\Front\SubscriptionFrontController::class, 'showTest']);
Route::name('invoice')->get('/invoice/{id}', [\App\Modules\Sixtyminutes\app\Http\Controllers\Front\SubscriptionFrontController::class, 'invoice']);
Route::name('invoice')->post('/invoice/{id}', [\App\Modules\Sixtyminutes\app\Http\Controllers\Front\SubscriptionFrontController::class, 'invoiceSubmit']);
Route::name('reservation')->post('/reservation/{id}', [\App\Modules\Sixtyminutes\app\Http\Controllers\Front\SubscriptionFrontController::class, 'reservationSubmit']);

//Route::name('invoiceStore')->any('/invoice-store', 'Front\SubscriptionFrontController@invoiceStore');
Route::name('invoiceReturn')->any('/invoice-return', [\App\Modules\Sixtyminutes\app\Http\Controllers\Front\SubscriptionFrontController::class, 'invoiceReturn']);
// PayTab payment verification routes
Route::get('/payments/verify/{payment?}', [\App\Modules\Sixtyminutes\app\Http\Controllers\Front\SubscriptionFrontController::class, 'payment_verify'])->name('verify-payment');
Route::post('/payments/verify/{payment?}', [\App\Modules\Sixtyminutes\app\Http\Controllers\Front\SubscriptionFrontController::class, 'payment_verify'])->name('verify-payment');
Route::get('/payments/error/{payment?}', [\App\Modules\Sixtyminutes\app\Http\Controllers\Front\SubscriptionFrontController::class, 'error_payment'])->name('error-payment');

// Tabby payment verification and error routes
Route::get('/payments/tabby-verify/{payment?}', [\App\Modules\Sixtyminutes\app\Http\Controllers\Front\SubscriptionFrontController::class, 'tabby_payment_verify'])->name('tabby-verify-payment');
Route::get('/tabby/error/cancel/{payment?}', [\App\Modules\Sixtyminutes\app\Http\Controllers\Front\SubscriptionFrontController::class, 'tabbyCancel'])->name('tabby-error-cancel');
Route::get('/tabby/error/failure/{payment?}', [\App\Modules\Sixtyminutes\app\Http\Controllers\Front\SubscriptionFrontController::class, 'tabbyFailure'])->name('tabby-error-failure');

Route::name('pt-class')->get('/pt/{id}', [\App\Modules\Sixtyminutes\app\Http\Controllers\Front\SubscriptionFrontController::class, 'showPTClass']);



