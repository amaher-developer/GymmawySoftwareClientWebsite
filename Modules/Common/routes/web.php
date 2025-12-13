<?php

use Illuminate\Support\Facades\Route;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Common\Http\Controllers\PaymentController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('commons', CommonController::class)->names('common');
});

// Simple web route for creating a payment (for testing)
Route::post('/paymob/create', [PaymentController::class, 'create'])->name('paymob.create.web');
// Paymob callback (public)
Route::post('/paymob/callback', [PaymentController::class, 'callback'])->name('paymob.callback.web');

// PayTab verification (public - called by PayTab gateway)
Route::match(['get', 'post'], '/paytab/verify', [PaymentController::class, 'paytabVerify'])->name('paytab.verify.web');
