<?php

use Modules\Premier\app\Http\Controllers\Admin\DashboardAdminController;
use Modules\Premier\app\Http\Controllers\Admin\GenericAdminController;
use Modules\Premier\app\Http\Controllers\Front\MainFrontController;
use Modules\Premier\app\Http\Controllers\Front\SubscriptionFrontController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::get('/payments/verify/{payment?}', [SubscriptionFrontController::class, 'payment_verify'])->name('verify-payment');
Route::post('/payments/verify/{payment?}', [SubscriptionFrontController::class, 'payment_verify'])->name('verify-payment');
Route::get('/payments/tabby-verify/{payment?}', [SubscriptionFrontController::class, 'tabby_payment_verify'])->name('tabby-verify-payment');
Route::get('/payments/error/{payment?}', [SubscriptionFrontController::class, 'error_payment'])->name('error-payment');

Route::name('test')->get('test', [MainFrontController::class, 'test']);

Route::get('operate', [DashboardAdminController::class, 'showHome'])
    ->middleware(['permission:super|dashboard-show']);

Route::name('noJs')->get('noJs', [DashboardAdminController::class, 'noJs']);

Route::name('backupDB')->get('operate/db-backup', [DashboardAdminController::class, 'backupDb'])->middleware(['permission:super|dashboard']);

Route::name('uploadImageForCKEditorAjax')->post('upload-ckeditor-ajax', [GenericAdminController::class, 'uploadImageForCKEditorAjax'])->middleware(['auth']);

Route::name('siteOff')
    ->get('site-off', [MainFrontController::class, 'site_off'])->middleware(['auth:sw', 'auth']);
Route::name('siteOn')
    ->get('site-on', [MainFrontController::class, 'site_on'])->middleware(['auth:sw', 'auth']);

//$router->get(config('l5-swagger.routes.api'), [
//    'as' => 'l5-swagger.api',
//    'middleware' => config('l5-swagger.routes.middleware.api', []),
//    'uses' => 'SwaggerController@api',
//]);
//
//$router->any(config('l5-swagger.routes.docs').'/{jsonFile?}', [
//    'as' => 'l5-swagger.docs',
//    'middleware' => config('l5-swagger.routes.middleware.docs', []),
//    'uses' => 'SwaggerController@docs',
//]);
//
//$router->get(config('l5-swagger.routes.docs').'/asset/{asset}', [
//    'as' => 'l5-swagger.asset',
//    'middleware' => config('l5-swagger.routes.middleware.asset', []),
//    'uses' => 'SwaggerAssetController@index',
//]);
//
//$router->get(config('l5-swagger.routes.oauth2_callback'), [
//    'as' => 'l5-swagger.oauth2_callback',
//    'middleware' => config('l5-swagger.routes.middleware.oauth2_callback', []),
//    'uses' => 'SwaggerController@oauth2Callback',
//]);


//Route::name('rss')->get('/rss', 'Front\MainFrontController@rss');

Route::group(array('middleware' => 'front','prefix' => (request()->segment(1) == 'ar' || request()->segment(1) == 'en') ? request()->segment(1) : ''), function () {
    foreach (File::allFiles(__DIR__ . '/Front') as $route) {
        require_once $route->getPathname();
    }
});
//Route::name('home')->get('/', 'Front\MainFrontController@index');

foreach (File::allFiles(__DIR__ . '/Admin') as $route) {
require_once $route->getPathname();
}
