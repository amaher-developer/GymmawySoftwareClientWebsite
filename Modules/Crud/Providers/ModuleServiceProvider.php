<?php

namespace App\Modules\Crud\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'crud');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'crud');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'crud');
        
        $this->mapRoutes();
    }

    /**
     * Define the routes for the module.
     *
     * @return void
     */
    protected function mapRoutes()
    {
        if (app()->routesAreCached()) {
            return;
        }

        $webRoutes = module_path('crud', 'Routes/web.php');
        $apiRoutes = module_path('crud', 'Routes/api.php');

        if (file_exists($webRoutes)) {
            Route::middleware('web')
                ->namespace('App\Modules\Crud\Http\Controllers')
                ->group(function () use ($webRoutes) {
                    require $webRoutes;
                });
        }
        
        if (file_exists($apiRoutes)) {
            Route::middleware('api')
                ->prefix('api')
                ->namespace('App\Modules\Crud\Http\Controllers')
                ->group(function () use ($apiRoutes) {
                    require $apiRoutes;
                });
        }
    }
}
