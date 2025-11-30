<?php

use Illuminate\Support\Facades\Route;
use Modules\Cakorinas\app\Http\Controllers\Front\AuthFrontController;

Route::name('home')->get('/', [Modules\Cakorinas\app\Http\Controllers\Front\MainFrontController::class, 'index']);

Route::name('thanks')->get('/thanks', [Modules\Cakorinas\app\Http\Controllers\Front\MainFrontController::class, 'thanks']);
Route::name('contact')->get('/contact', [Modules\Cakorinas\app\Http\Controllers\Front\MainFrontController::class, 'contactCreate']);
Route::name('contact')->post('/contact', [Modules\Cakorinas\app\Http\Controllers\Front\MainFrontController::class, 'contactStore']);
Route::name('banner')->get('/banner', [Modules\Cakorinas\app\Http\Controllers\Front\MainFrontController::class, 'banner']);
Route::name('terms')->get('/terms', [Modules\Cakorinas\app\Http\Controllers\Front\MainFrontController::class, 'terms']);

Route::prefix('user')
    ->middleware(['auth'])
    ->group(function () {

        Route::name('dashboard')
            ->get('', [\Modules\Cakorinas\app\Http\Controllers\Front\MainFrontController::class, 'home']);


});


Route::get('/payment-success', [Modules\Cakorinas\app\Http\Controllers\Front\SubscriptionFrontController::class, 'success'])->name('payment.success');
Route::get('/payment-failed', [Modules\Cakorinas\app\Http\Controllers\Front\SubscriptionFrontController::class, 'failed'])->name('payment.failed');

// Login routes
Route::get('login', [AuthFrontController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthFrontController::class, 'login'])->name('loginSubmit');
Route::get('logout', [AuthFrontController::class, 'logout'])->name('logout');

// Profile routes
Route::get('profile/show', [AuthFrontController::class, 'showProfile'])->name('showProfile');
Route::get('profile/edit', [AuthFrontController::class, 'editProfile'])->name('editProfile')->middleware('auth');
Route::post('profile/edit', [AuthFrontController::class, 'updateProfile'])->name('updateProfile')->middleware('auth');




