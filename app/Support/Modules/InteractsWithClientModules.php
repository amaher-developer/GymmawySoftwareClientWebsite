<?php

namespace App\Support\Modules;

use Illuminate\Support\Str;

trait InteractsWithClientModules
{
    /**
     * Determine if the given module is active for the current client.
     */
    protected function clientModuleIsActive(string $module): bool
    {
        return in_array(Str::studly($module), $this->clientActiveModules(), true);
    }

    /**
     * Resolve the list of modules active for the current client.
     *
     * @return array<int,string>
     */
    protected function clientActiveModules(): array
    {
        $modules = [];

        if (app()->bound('client.active_modules')) {
            $modules = (array) app('client.active_modules');
        } else {
            $modules = (array) config('client-modules.active_modules', []);
        }
        return collect($modules)
            ->map(fn ($module) => Str::studly((string) $module))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }
}


