<?php

use Modules\Demo\Http\Controllers\Front\MainFrontController;
use Illuminate\Support\Facades\Route;

Route::name('home')->get('/', [MainFrontController::class, 'index']);
Route::name('about')->get('/about', [MainFrontController::class, 'about']);
Route::name('favorites')->get('/favorites', [MainFrontController::class, 'favorites'])->middleware(['auth']);
Route::name('searchRedirect')->get('search-redirect', [MainFrontController::class, 'searchRedirect']);
Route::name('setCurrentArea')->post('set-area', [MainFrontController::class, 'setCurrentArea']);


Route::name('contact')->get('/contact', [MainFrontController::class, 'contactCreate']);
Route::name('contact')->post('/', [MainFrontController::class, 'contactStore']);
Route::name('feedback')->post('/feedback', [MainFrontController::class, 'feedbackStore']);
Route::name('newsletter')->post('/newsletter', [MainFrontController::class, 'newsletter']);

Route::name('thanks')->get('/thanks', [MainFrontController::class, 'thanks']);
Route::name('terms')->get('/terms', [MainFrontController::class, 'terms']);
Route::name('policy')->get('/policy', [MainFrontController::class, 'policy']);

//Route::name('rss')->get('/rss', [MainFrontController::class, 'rss']);
Route::name('sitemap')->get('/sitemap', [MainFrontController::class, 'sitemap']);


Route::post('add-favorite-by-ajax', [MainFrontController::class, 'addFavoriteByAjax'])->name('addFavoriteByAjax');
Route::post('remove-favorite-by-ajax', [MainFrontController::class, 'removeFavoriteByAjax'])->name('removeFavoriteByAjax');

