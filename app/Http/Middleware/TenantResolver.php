<?php

namespace App\Http\Middleware;

use App\Services\ClientModuleManager;
use Closure;
use Illuminate\Http\Request;

class TenantResolver
{
    public function __construct(
        protected ClientModuleManager $clientModuleManager,
    ) {
    }

    public function handle(Request $request, Closure $next)
    {
        $modules = $this->clientModuleManager->getRuntimeModules();

        config([
            'client-modules.active_modules' => $modules,
            'client-modules.active_module' => $modules[0] ?? null,
        ]);

        return $next($request);
    }
}


