<?php

use Modules\Premier\app\Http\Controllers\Admin\CityAdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('operate/city')
    ->middleware(['auth'])
    ->group(function () {
    Route::name('listCity')
        ->get('/', [CityAdminController::class, 'index'])
        ->middleware(['permission:super|city-index']);
    Route::name('createCity')
        ->get('create', [CityAdminController::class, 'create'])
        ->middleware(['permission:super|city-create']);
    Route::name('storeCity')
        ->post('create', [CityAdminController::class, 'store'])
        ->middleware(['permission:super|city-create']);
    Route::name('editCity')
        ->get('{city}/edit', [CityAdminController::class, 'edit'])
        ->middleware(['permission:super|city-edit']);
    Route::name('editCity')
        ->post('{city}/edit', [CityAdminController::class, 'update'])
        ->middleware(['permission:super|city-edit']);
    Route::name('deleteCity')
        ->get('{city}/delete', [CityAdminController::class, 'destroy'])
        ->middleware(['permission:super|city-destroy']);
});
