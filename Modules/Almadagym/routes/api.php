<?php

use Illuminate\Support\Facades\Route;
use Modules\Almadagym\Http\Controllers\AlmadagymController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('almadagyms', AlmadagymController::class)->names('almadagym');
});
