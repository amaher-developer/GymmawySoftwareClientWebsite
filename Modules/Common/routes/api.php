<?php

use Illuminate\Support\Facades\Route;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Common\Http\Controllers\PaymentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('commons', CommonController::class)->names('common');
    Route::post('paymob/create', [PaymentController::class, 'create'])->name('paymob.create');
});

// Public callback from Paymob
Route::post('paymob/callback', [PaymentController::class, 'callback'])->name('paymob.callback');

// Public PayTab verification endpoint (called by PayTab gateway)
Route::match(['get', 'post'], 'paytab/verify', [PaymentController::class, 'paytabVerify'])->name('paytab.verify');
