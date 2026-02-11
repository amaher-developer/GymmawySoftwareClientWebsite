<?php

use Illuminate\Support\Facades\Route;
use Modules\Demo\Http\Controllers\DemoController;
use Modules\Demo\Http\Controllers\Front\MainFrontController;

Route::get('/go', [MainFrontController::class, 'smartLink'])->name('smart-link');


Route::group(['middleware' => 'front','prefix' => (request()->segment(1) == 'ar' || request()->segment(1) == 'en') ? request()->segment(1) : ''], function () {
    foreach (File::allFiles(__DIR__ . '/Front') as $route) {
        require_once $route->getPathname();
    }
});