<?php
/**
 * Created by PhpStorm.
 * User: AMiR
 * Date: 5/3/2017
 * Time: 2:40 PM
 */

use Illuminate\Support\Facades\Route;

// Logout moved to Generic module
// Route::get('logout', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'logout'])->name('logout');

Route::get('register', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'register']);
Route::post('social_register', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'socialRegister'])->name('socialRegister');

// Login moved to Generic module
// Route::get('login', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'showLoginForm'])->name('login');
Route::get('social_login', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'redirectToProvider'])->name('socialLogin');
Route::get('provider_callback', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'handleProviderCallback']);


Route::get('broker', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'showBrokerForm'])->name('broker');

Route::get('google_login', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'redirectToGoogle'])->name('loginByGoogle');
Route::get('google_callback', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'handleGoogleCallback']);

// Login moved to Generic module
// Route::post('login', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'login'])->name('loginSubmit');
Route::post('broker', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'broker']);
Route::post('broker/edit', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'brokerEdit'])->name('brokerEdit');

// Profile routes moved to Generic module
// Route::get('profile/show', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'showProfile'])->name('showProfile');
// Route::get('profile/edit', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'editProfile'])->name('editProfile')->middleware('auth');
// Route::post('profile/edit', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'updateProfile'])->middleware('auth');

Route::get('newsletter-subscribe', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'newsletterSubscribe'])->name('newsletterSubscribe');

Route::get('verification', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'showVerificationPage'])->name('showVerificationPage');
Route::get('send-phone-activate-code', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'sendPhoneVerificationCode'])->name('sendPhoneVerificationCode');
Route::any('activate-phone-user', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'verifyPhone'])->name('verifyPhone');

//Route::get('update_password/{user}', 'Front\AuthFrontController@showUpdatePasswordForm');
//Route::patch('update_password/{user}', 'Front\AuthFrontController@updatePassword');
//
//Route::get('password/reset', 'Front\AuthFrontController@sendResetPassword')->name('sendResetPassword');
//Route::post('password/reset', 'Front\AuthFrontController@resetPassword');


Route::post('password/email', [\App\Modules\Access\Http\Controllers\Front\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset', [\App\Modules\Access\Http\Controllers\Front\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/reset', [\App\Modules\Access\Http\Controllers\Front\ResetPasswordController::class, 'reset']);
Route::get('password/reset/{token}', [\App\Modules\Access\Http\Controllers\Front\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::name('thanksRegister')->get('/thanks-register', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'thanksRegister']);
Route::name('emailActivate')->get('/user-activation', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'emailActivate']);



Route::prefix('user')
    ->middleware(['auth'])
    ->group(function () {

        Route::name('showUserFront')
            ->get('show', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'showUser']);
        Route::name('editUserFront')
            ->get('edit', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'editUser']);
        Route::name('editUserFront')
            ->post('edit', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'updateUser']);

        Route::get('update_password', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'editUserUpdatePassword'])->name('editUserUpdatePassword');
        Route::post('update_password', [\App\Modules\Access\Http\Controllers\Front\AuthFrontController::class, 'updateUserUpdatePassword'])->name('updateUserUpdatePassword');


    });

