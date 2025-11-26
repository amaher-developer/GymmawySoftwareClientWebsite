<?php

use Modules\Stepfitness\app\Http\Controllers\Admin\GenericAdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('operate/admin_notifications')
    ->middleware(['auth'])
    ->group(function () {
        Route::name('getNewAdminNotifications')
            ->get('', [GenericAdminController::class, 'checkForNewNotifications'])
            ->middleware(['permission:super|stepfitness-notification-check']);

    });
