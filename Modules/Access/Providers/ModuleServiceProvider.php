<?php

namespace App\Modules\Access\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'access');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'access');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'access');
        
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

        $webRoutes = module_path('access', 'Routes/web.php');
        $apiRoutes = module_path('access', 'Routes/api.php');

        if (file_exists($webRoutes)) {
            Route::middleware('web')
                ->group(function () use ($webRoutes) {
                    require $webRoutes;
                });
        }
        
        if (file_exists($apiRoutes)) {
            Route::middleware('api')
                ->prefix('api')
                ->group(function () use ($apiRoutes) {
                    require $apiRoutes;
                });
        }
    }
}
