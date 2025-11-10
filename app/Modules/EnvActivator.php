<?php

namespace App\Modules;

use App\Services\ClientModuleManager;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Str;
use Nwidart\Modules\Contracts\ActivatorInterface;
use Nwidart\Modules\Module;

class EnvActivator implements ActivatorInterface
{
    protected ClientModuleManager $moduleManager;

    public function __construct(Application $app)
    {
        $this->moduleManager = $app->make(ClientModuleManager::class);
    }

    /**
     * @return array<string, true>
     */
    protected function activeModuleLookup(): array
    {
        return array_fill_keys(
            array_map(
                fn ($module) => Str::lower($module),
                $this->moduleManager->getRuntimeModules()
            ),
            true
        );
    }

    protected function resolveModuleName(Module|string $module): string
    {
        return $module instanceof Module ? $module->getName() : $module;
    }

    protected function isNameActive(string $name): bool
    {
        return array_key_exists(Str::lower($name), $this->activeModuleLookup());
    }

    public function isActive(Module $module): bool
    {
        return $this->isNameActive($module->getName());
    }

    public function hasStatus(Module|string $module, bool $status): bool
    {
        return $status === $this->isNameActive($this->resolveModuleName($module));
    }

    public function setActive(Module $module, bool $active): void
    {
        // No persistence – activation derived from env at runtime.
    }

    public function setActiveForAll(bool $status): void
    {
        // No persistence – activation derived from env at runtime.
    }

    public function enable(Module $module): void {}

    public function disable(Module $module): void {}

    public function setActiveByName(string $name, bool $active): void {}

    public function delete(Module $module): void {}

    public function reset(): void {}
}

