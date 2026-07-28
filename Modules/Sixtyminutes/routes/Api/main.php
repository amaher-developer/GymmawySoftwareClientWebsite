<?php

Route::any('home', 'Api\MainApiController@main')->middleware('api');
// splash / log_errors / update_push_token disabled: they pointed at Api\PremierApiController,
// which was never ported to this module (no Sixtyminutes equivalent exists) — was a hard
// "class not found" if hit. Re-enable once a real Sixtyminutes API controller backs these.
Route::name('tabby-notify')->any('/tabby/notify','Front\SubscriptionFrontController@tabbyNotify')->middleware('api');
Route::name('tamara-notify')->any('/tamara/notify','Front\SubscriptionFrontController@tamaraNotify')->middleware('api');
Route::name('paytabs-notify')->any('/paytabs/notify','Front\SubscriptionFrontController@paytabsNotify')->middleware('api');


Route::group(['middleware' => 'auth:api'], function(){
//    Route::get('/settings', function () {
//        return \Modules\Sixtyminutes\Models\Setting::all();
//    });

});
