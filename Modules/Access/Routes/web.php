<?php

use Illuminate\Support\Facades\File;

Route::group(['middleware' => 'front','prefix' => (request()->segment(1) == 'ar' || request()->segment(1) == 'en') ? request()->segment(1) : ''], function () {
    foreach (File::allFiles(__DIR__ . '/Front') as $route) {
        require_once $route->getPathname();
    }
});


foreach (File::allFiles(__DIR__ . '/Admin') as $route) {
    require_once $route->getPathname();
}
//
//foreach (File::allFiles(__DIR__ . '/Front') as $route) {
//    require_once $route->getPathname();
//}
Route::prefix('operate/role')->group(function () {
    Route::name('listRoles')->get('', [\App\Modules\Access\Http\Controllers\RoleController::class, 'index'])->middleware(['permission:super']);
    Route::name('createRole')->get('create', [\App\Modules\Access\Http\Controllers\RoleController::class, 'create'])->middleware(['permission:super']);
    Route::name('storeRole')->post('', [\App\Modules\Access\Http\Controllers\RoleController::class, 'store'])->middleware(['permission:super']);
    Route::name('editRole')->get('{role}/edit', [\App\Modules\Access\Http\Controllers\RoleController::class, 'edit'])->middleware(['permission:super']);
    Route::name('editRole')->post('{role}/edit', [\App\Modules\Access\Http\Controllers\RoleController::class, 'update'])->middleware(['permission:super']);
    Route::name('deleteRole')->get('{role}/delete', [\App\Modules\Access\Http\Controllers\RoleController::class, 'destroy'])->middleware(['permission:super']);
});
