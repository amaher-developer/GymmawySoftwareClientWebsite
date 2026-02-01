<?php

use Modules\Stepfitness\app\Http\Controllers\Front\AuthFrontController;
use Modules\Stepfitness\app\Http\Controllers\Front\GenericFrontController;
use Modules\Stepfitness\app\Http\Controllers\Front\MainFrontController;
use Illuminate\Support\Facades\Route;

Route::name('home')->get('/', [MainFrontController::class, 'index']);
Route::name('about')->get('/about', [MainFrontController::class, 'about']);
Route::name('favorites')->get('/favorites', [MainFrontController::class, 'favorites'])->middleware(['auth']);
Route::name('searchRedirect')->get('/search-redirect', [MainFrontController::class, 'searchRedirect']);
Route::name('setCurrentArea')->post('/set-area', [MainFrontController::class, 'setCurrentArea']);

Route::name('clearWebsiteCache')->get('/clear-website-cache', [GenericFrontController::class, 'clearWebsiteCache']);


Route::name('contact')->get('/contact', [MainFrontController::class, 'contactCreate']);
Route::name('contact')->post('/contact', [MainFrontController::class, 'contactStore']);
Route::name('feedback')->post('/feedback', [MainFrontController::class, 'feedbackStore']);
Route::name('newsletter')->post('/newsletter', [MainFrontController::class, 'newsletter']);

Route::name('thanks')->get('/thanks', [MainFrontController::class, 'thanks']);
Route::name('terms')->get('/terms', [MainFrontController::class, 'terms']);
Route::name('policy')->get('/policy', [MainFrontController::class, 'policy']);

//Route::name('rss')->get('/rss', [MainFrontController::class, 'rss']);
Route::name('sitemap')->get('/sitemap', [MainFrontController::class, 'sitemap']);


Route::post('add-favorite-by-ajax', [MainFrontController::class, 'addFavoriteByAjax'])->name('addFavoriteByAjax');
Route::post('remove-favorite-by-ajax', [MainFrontController::class, 'removeFavoriteByAjax'])->name('removeFavoriteByAjax');

Route::prefix('user')
    ->middleware(['auth'])
    ->group(function () {

        Route::name('dashboard')
            ->get('', [MainFrontController::class, 'home']);


});


Route::get('/payment-success', [\App\Modules\Generic\Http\Controllers\Front\SubscriptionFrontController::class, 'success'])->name('payment.success');
Route::get('/payment-failed', [\App\Modules\Generic\Http\Controllers\Front\SubscriptionFrontController::class, 'failed'])->name('payment.failed');

// Login routes
Route::get('login', [AuthFrontController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthFrontController::class, 'login'])->name('loginSubmit');
Route::get('logout', [AuthFrontController::class, 'logout'])->name('logout');

// Profile routes
Route::get('profile/show', [AuthFrontController::class, 'showProfile'])->name('showProfile');
Route::get('profile/edit', [AuthFrontController::class, 'editProfile'])->name('editProfile')->middleware('auth');
Route::post('profile/edit', [AuthFrontController::class, 'updateProfile'])->name('updateProfile')->middleware('auth');




