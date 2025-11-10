<?php

namespace App\Providers;

use App\Services\ClientModuleManager;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ClientModuleServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register(): void
    {
        $manager = $this->app->make(ClientModuleManager::class);
        $this->synchroniseActiveModuleState($manager);
    }

    /**
     * Bootstrap the application services.
     */
    public function boot(ClientModuleManager $clientModuleManager): void
    {
        $modules = $this->synchroniseActiveModuleState($clientModuleManager);

        View::share('clientActiveModule', $modules[0] ?? null);
        View::share('clientActiveModules', $modules);
    }

    /**
     * Store the active module information in config and container.
     *
     * @return array<int,string>
     */
    protected function synchroniseActiveModuleState(ClientModuleManager $clientModuleManager): array
    {
        $modules = $clientModuleManager->getRuntimeModules();

        config([
            'client-modules.active_modules' => $modules,
            'client-modules.active_module' => $modules[0] ?? null,
        ]);

        $this->app->instance('client.active_modules', $modules);
        $this->app->instance('client.active_module', $modules[0] ?? null);

        return $modules;
    }
}


