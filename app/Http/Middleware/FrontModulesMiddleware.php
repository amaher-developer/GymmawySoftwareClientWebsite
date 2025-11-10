<?php

namespace App\Http\Middleware;

use App\Services\ClientModuleManager;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Str;
use Nwidart\Modules\Facades\Module;

class FrontModulesMiddleware
{
    public function __construct(
        protected ClientModuleManager $moduleManager
    ) {}

    public function handle(Request $request, Closure $next)
    {
        $middlewares = $this->resolveModuleMiddlewares();

        if (empty($middlewares)) {
            return $next($request);
        }

        return app(Pipeline::class)
            ->send($request)
            ->through($middlewares)
            ->then(static fn ($request) => $next($request));
    }

    /**
     * @return array<int, class-string>
     */
    protected function resolveModuleMiddlewares(): array
    {
        $middlewares = [];

        foreach ($this->moduleManager->getRuntimeModules() as $module) {
            $moduleName = Str::studly($module);

            if (!Module::has($moduleName)) {
                continue;
            }

            if (!Module::isEnabled($moduleName)) {
                Module::enable($moduleName);
            }

            $this->ensureModuleBootstrapped($moduleName);

            $fullyQualifiedMiddleware = sprintf(
                'App\\Modules\\%s\\app\\Http\\Middleware\\Front',
                $moduleName
            );

            if (class_exists($fullyQualifiedMiddleware)) {
                $middlewares[] = $fullyQualifiedMiddleware;
            }
        }

        return $middlewares;
    }

    protected function ensureModuleBootstrapped(string $module): void
    {
        $provider = sprintf('Modules\\%s\\Providers\\%sServiceProvider', $module, $module);

        if (class_exists($provider) && app()->getProvider($provider) === null) {
            app()->register($provider);
        }
    }
}

