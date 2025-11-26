<?php

use Modules\Stepfitness\app\Http\Controllers\Admin\GenericAdminController;
use Modules\Stepfitness\app\Http\Controllers\Admin\SettingAdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('operate/setting')
    ->middleware(['auth'])
    ->group(function () {
    Route::name('editSetting')
        ->get('{setting}/edit', [SettingAdminController::class, 'edit'])
        ->middleware(['permission:super|setting-edit']);
    Route::name('editSetting')
        ->post('{setting}/edit', [SettingAdminController::class, 'update'])
        ->middleware(['permission:super|setting-edit']);

        Route::get('test', [GenericAdminController::class, 'test'])
            ->middleware(['permission:super']);

});
