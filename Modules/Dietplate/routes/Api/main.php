<?php

Route::any('home', 'Api\MainApiController@main')->middleware('api');
Route::any('splash', 'Api\DietplateApiController@splash')->middleware('api');
Route::any('log_errors', 'Api\DietplateApiController@logErrors')->middleware('api');
Route::any('update_push_token', 'Api\DietplateApiController@updatePushToken')->middleware('api');
Route::name('tabby-notify')->any('/tabby/notify','Front\SubscriptionFrontController@tabbyNotify')->middleware('api');
Route::name('tamara-notify')->any('/tamara/notify','Front\SubscriptionFrontController@tamaraNotify')->middleware('api');
Route::name('paytabs-notify')->any('/paytabs/notify','Front\SubscriptionFrontController@paytabsNotify')->middleware('api');


Route::group(['middleware' => 'auth:api'], function(){
//    Route::get('/settings', function () {
//        return \Modules\Dietplate\Models\Setting::all();
//    });

});
