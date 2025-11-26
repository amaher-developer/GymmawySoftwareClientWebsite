<?php

use Modules\Stepfitness\app\Http\Controllers\Admin\DistrictAdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('operate/district')
    ->middleware(['auth'])
    ->group(function () {
    Route::name('listDistrict')
        ->get('/', [DistrictAdminController::class, 'index'])
        ->middleware(['permission:super|district-index']);
    Route::name('createDistrict')
        ->get('create', [DistrictAdminController::class, 'create'])
        ->middleware(['permission:super|district-create']);
    Route::name('storeDistrict')
        ->post('create', [DistrictAdminController::class, 'store'])
        ->middleware(['permission:super|district-create']);
    Route::name('editDistrict')
        ->get('{district}/edit', [DistrictAdminController::class, 'edit'])
        ->middleware(['permission:super|district-edit']);
    Route::name('editDistrict')
        ->post('{district}/edit', [DistrictAdminController::class, 'update'])
        ->middleware(['permission:super|district-edit']);
    Route::name('deleteDistrict')
        ->get('{district}/delete', [DistrictAdminController::class, 'destroy'])
        ->middleware(['permission:super|district-destroy']);
});
