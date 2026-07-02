<?php

use Modules\Dietplate\app\Http\Controllers\Front\SubscriptionFrontController;
use Modules\Dietplate\app\Http\Controllers\Front\DietPlanFrontController;
use Illuminate\Support\Facades\Route;

// ── Diet Plan multi-step flow ─────────────────────────────────────────────
// More specific routes MUST come before wildcard {categoryId} route
Route::name('diet-plan.subscribe')->get('/diet-plan/subscribe/{subscriptionId}', [DietPlanFrontController::class, 'subscribe']);
Route::name('diet-plan.subscribe.store')->post('/diet-plan/subscribe/{subscriptionId}', [DietPlanFrontController::class, 'storeSubscribe']);
Route::name('diet-plan.meals')->get('/diet-plan/meals/{subscriptionId}', [DietPlanFrontController::class, 'meals']);
Route::name('diet-plan.checkout')->post('/diet-plan/checkout/{subscriptionId}', [DietPlanFrontController::class, 'checkout']);
Route::name('diet-plan.payment')->get('/diet-plan/payment/{subscriptionId}', [DietPlanFrontController::class, 'payment']);
Route::name('diet-plan.payment.submit')->post('/diet-plan/payment/{subscriptionId}', [DietPlanFrontController::class, 'paymentSubmit']);
Route::name('diet-plan.thanks')->get('/diet-plan/thanks', [DietPlanFrontController::class, 'thanks']);
Route::name('diet-plan.product')->get('/diet-plan/product/{productId}', [DietPlanFrontController::class, 'productDetail']);
Route::name('diet-plan.plans')->get('/diet-plan/{categoryId}', [DietPlanFrontController::class, 'plans']);

Route::name('subscription')->get('/subscription/{id}', [SubscriptionFrontController::class, 'show']);
Route::name('subscription-mobile')->get('/subscription-mobile/{id}', [SubscriptionFrontController::class, 'showMobile']);
Route::name('invoice')->get('/invoice/{id}', [SubscriptionFrontController::class, 'invoice']);
Route::name('invoice')->post('/invoice/{id}', [SubscriptionFrontController::class, 'invoiceSubmit']);
Route::name('invoice-mobile')->get('/invoice-mobile/{id}', [SubscriptionFrontController::class, 'invoiceMobile']);
Route::name('tabby-error-cancel')->get('/tabby/error/cancel/{payment?}', [SubscriptionFrontController::class, 'tabbyCancel']);
Route::name('tabby-error-failure')->get('/tabby/error/failure/{payment?}', [SubscriptionFrontController::class, 'tabbyFailure']);
Route::name('tamara-error-cancel')->get('/tamara/error/cancel/{payment?}', [SubscriptionFrontController::class, 'tamaraCancel']);
Route::name('tamara-error-failure')->get('/tamara/error/failure/{payment?}', [SubscriptionFrontController::class, 'tamaraFailure']);
Route::name('paytabs-error-cancel')->get('/paytabs/error/cancel/{payment?}', [SubscriptionFrontController::class, 'paytabsCancel']);
Route::name('paytabs-error-failure')->get('/paytabs/error/failure/{payment?}', [SubscriptionFrontController::class, 'paytabsFailure']);



Route::get('tabby-register-webhook', [SubscriptionFrontController::class, 'tabbyRegisterWebhook'])
->name('tabby-register-webhook')
->middleware(['permission:super']);

Route::get('tabby-check-webhooks', [SubscriptionFrontController::class, 'tabbyCheckWebhooks'])
->name('tabby-check-webhooks')
->middleware(['permission:super']);