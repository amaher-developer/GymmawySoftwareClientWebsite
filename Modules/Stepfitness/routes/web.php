<?php

use Illuminate\Support\Facades\Route;
use Modules\Stepfitness\Http\Controllers\StepfitnessController;


Route::get('/', function () {
    return 'Stepfitness';
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('stepfitnesses', StepfitnessController::class)->names('stepfitness');
});
