<?php

use Illuminate\Support\Facades\Route;
use Modules\Almadagym\Http\Controllers\AlmadagymController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('almadagyms', AlmadagymController::class)->names('almadagym');
});
