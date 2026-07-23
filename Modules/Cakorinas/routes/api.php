<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Modules\Cakorinas\app\Http\Controllers\Front\SubscriptionFrontController;

// Paymob Intention API ("Flash" / Unified Checkout) — server-to-server webhook
Route::name('paymob-intention-notify')->any('/paymob-intention/notify', [SubscriptionFrontController::class, 'paymobIntentionNotify']);

