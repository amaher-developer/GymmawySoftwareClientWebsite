<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Sixtyminutes\app\Http\Controllers\Front\PaymentFrontController;

/*
|--------------------------------------------------------------------------
| Payment Routes for Sixtyminutes Module
|--------------------------------------------------------------------------
|
| Add these routes to your module's routes file
|
*/

Route::prefix('subscription/payment')->name('subscription.payment.')->group(function () {

    // API routes for payment operations
    Route::prefix('api')->middleware('api')->group(function () {
        // Create payment session
        Route::post('/create', [PaymentFrontController::class, 'createPayment'])
            ->name('create');

        // Payment callback (webhook from Tabby)
        Route::post('/callback', [PaymentFrontController::class, 'paymentCallback'])
            ->name('callback');

        // Get payment status
        Route::get('/status/{transactionId}', [PaymentFrontController::class, 'getPaymentStatus'])
            ->name('status');

        // Refund payment
        Route::post('/refund', [PaymentFrontController::class, 'refundPayment'])
            ->name('refund')
            ->middleware('auth:admin'); // Only admins can refund
    });

    // Web routes for payment result pages
    Route::middleware('web')->group(function () {
        // Payment success page
        Route::get('/success', [PaymentFrontController::class, 'paymentSuccess'])
            ->name('success');

        // Payment cancel page
        Route::get('/cancel', [PaymentFrontController::class, 'paymentCancel'])
            ->name('cancel');

        // Payment failure page
        Route::get('/failure', [PaymentFrontController::class, 'paymentFailure'])
            ->name('failure');
    });
});
