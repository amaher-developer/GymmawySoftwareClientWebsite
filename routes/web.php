<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/env-check', function () {

Artisan::call('migrate');

      return [
          'APP_NAME' => env('APP_NAME'),
          'DB_DATABASE' => env('DB_DATABASE'),
          'current_host' => $_SERVER['HTTP_HOST'] ?? 'N/A',
          'APP_NAME_AR' => env('APP_NAME_AR') ?? 'N/A',
          'CLIENT_ACTIVE_MODULE' => env('CLIENT_ACTIVE_MODULE') ?? 'N/A'      ];
  });