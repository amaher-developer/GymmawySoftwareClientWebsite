<?php

Route::any('home', 'Api\MainApiController@main')->middleware('api');
Route::any('splash', 'Api\PremierApiController@splash')->middleware('api');
Route::any('log_errors', 'Api\PremierApiController@logErrors')->middleware('api');
Route::any('update_push_token', 'Api\PremierApiController@updatePushToken')->middleware('api');
Route::name('tabby-notify')->any('/tabby/notify','Front\SubscriptionFrontController@tabbyNotify')->middleware('api');


Route::group(['middleware' => 'auth:api'], function(){
//    Route::get('/settings', function () {
//        return \Modules\Premier\Models\Setting::all();
//    });

});
