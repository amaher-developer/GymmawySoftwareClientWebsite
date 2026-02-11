<?php

// Route::name('home')->get('/', 'Front\MainFrontController@index');
// Route::name('about')->get('/about', 'Front\MainFrontController@about');
// Route::name('favorites')->get('/favorites', 'Front\MainFrontController@favorites')->middleware(['auth']);
// Route::name('searchRedirect')->get('/search-redirect', 'Front\MainFrontController@searchRedirect');
// Route::name('setCurrentArea')->post('/set-area', 'Front\MainFrontController@setCurrentArea');

// Route::name('clearWebsiteCache')->get('/clear-website-cache', 'Front\GenericFrontController@clearWebsiteCache');


// Route::name('contact')->get('/contact', 'Front\MainFrontController@contactCreate');
// Route::name('contact')->post('/', 'Front\MainFrontController@contactStore');
// Route::name('feedback')->post('/feedback', 'Front\MainFrontController@feedbackStore');
// Route::name('newsletter')->post('/newsletter', 'Front\MainFrontController@newsletter');

// Route::name('thanks')->get('/thanks', 'Front\MainFrontController@thanks');

// //Route::name('rss')->get('/rss', 'Front\MainFrontController@rss');
// Route::name('sitemap')->get('/sitemap', 'Front\MainFrontController@sitemap');


// Route::post('add-favorite-by-ajax', 'Front\MainFrontController@addFavoriteByAjax')->name('addFavoriteByAjax');
// Route::post('remove-favorite-by-ajax', 'Front\MainFrontController@removeFavoriteByAjax')->name('removeFavoriteByAjax');

// Route::prefix('user')
//     ->middleware(['auth'])
//     ->group(function () {

//         Route::name('dashboard')
//             ->get('', 'Front\MainFrontController@home');


// });


use Modules\Zonegym\Http\Controllers\Front\AuthFrontController;
use Modules\Zonegym\Http\Controllers\Front\MainFrontController;
use Modules\Zonegym\Http\Controllers\Front\SubscriptionFrontController;

Route::name('home')->get('/', [MainFrontController::class, 'index']);

Route::name('thanks')->get('/thanks', [MainFrontController::class, 'thanks']);
Route::name('contact')->get('/contact', [MainFrontController::class, 'contactCreate']);
Route::name('contact')->post('/contact', [MainFrontController::class, 'contactStore']);
Route::name('banner')->get('/banner', [MainFrontController::class, 'banner']);
Route::name('terms')->get('/terms', [MainFrontController::class, 'terms']);
Route::name('policy')->get('/policy', [MainFrontController::class, 'policy']);

Route::name('downloadApp')->get('/download-app', [MainFrontController::class, 'downloadApp']);

Route::prefix('user')
    ->middleware(['auth'])
    ->group(function () {

        Route::name('dashboard')
            ->get('', [MainFrontController::class, 'home']);


});


Route::get('/payment-success', [SubscriptionFrontController::class, 'success'])->name('payment.success');
Route::get('/payment-failed', [SubscriptionFrontController::class, 'failed'])->name('payment.failed');

// Login routes
Route::get('login', [AuthFrontController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthFrontController::class, 'login'])->name('loginSubmit');
Route::get('logout', [AuthFrontController::class, 'logout'])->name('logout');

// Profile routes
Route::get('profile/show', [AuthFrontController::class, 'showProfile'])->name('showProfile');
Route::get('profile/edit', [AuthFrontController::class, 'editProfile'])->name('editProfile')->middleware('auth');
Route::post('profile/edit', [AuthFrontController::class, 'updateProfile'])->name('updateProfile')->middleware('auth');

