<?php
Route::name('subscription')->get('/subscription/{id}', 'Front\SubscriptionFrontController@show');
Route::name('subscription-test')->get('/subscription-test/{id}', 'Front\SubscriptionFrontController@showTest');
Route::name('invoice')->get('/invoice/{id}', 'Front\SubscriptionFrontController@invoice');
Route::name('invoice')->post('/invoice/{id}', 'Front\SubscriptionFrontController@invoiceSubmit');
//Route::name('invoiceStore')->any('/invoice-store', 'Front\SubscriptionFrontController@invoiceStore');
Route::name('invoiceReturn')->any('/invoice-return', 'Front\SubscriptionFrontController@invoiceReturn');
Route::name('tabby-error-cancel')->get('/tabby/error/cancel/{payment?}','Front\SubscriptionFrontController@tabbyCancel');
Route::name('tabby-error-failure')->get('/tabby/error/failure/{payment?}','Front\SubscriptionFrontController@tabbyFailure');


