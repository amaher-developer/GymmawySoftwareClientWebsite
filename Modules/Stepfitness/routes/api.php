<?php

use Illuminate\Support\Facades\Route;
use Modules\Stepfitness\Http\Controllers\StepfitnessController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('stepfitnesses', StepfitnessController::class)->names('stepfitness');
});
