<?php

use Illuminate\Support\Facades\Route;

Route::name('tabby-notify')->any('/tabby/notify', [\App\Modules\Sixtyminutes\app\Http\Controllers\Front\SubscriptionFrontController::class, 'tabbyNotify']);
Route::name('tamara-notify')->any('/tamara/notify', [\App\Modules\Sixtyminutes\app\Http\Controllers\Front\SubscriptionFrontController::class, 'tamaraNotify']);
Route::name('paytabs-notify')->any('/paytabs/notify', [\App\Modules\Sixtyminutes\app\Http\Controllers\Front\SubscriptionFrontController::class, 'paytabsNotify']);
