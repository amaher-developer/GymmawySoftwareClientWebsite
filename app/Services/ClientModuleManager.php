<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Nwidart\Modules\Facades\Module;

class ClientModuleManager
{
    protected string $envKey;
    protected string $moduleSeparator;
    protected ?string $defaultModule;
    /**
     * @var array<int,string>
     */
    protected array $defaultModules;

    public function __construct()
    {
        $this->envKey = config('client-modules.env_key', 'CLIENT_ACTIVE_MODULE');
        $this->moduleSeparator = (string) config('client-modules.module_separator', ',');
        $this->defaultModule = config('client-modules.default_module');
        $this->defaultModules = $this->normalizeModules(
            config('client-modules.default_modules', $this->defaultModule ? [$this->defaultModule] : [])
        );

        if (empty($this->defaultModules) && $this->defaultModule) {
            $this->defaultModules = [$this->defaultModule];
        }

        if (empty($this->defaultModules)) {
            $this->defaultModules = ['Generic'];
        }

        $this->defaultModule = $this->defaultModules[0] ?? null;
    }

    /**
     * Get the module configured for the current domain (runtime env already loaded).
     */
    public function getActiveModuleForCurrentDomain(): ?string
    {
        $modules = $this->getActiveModulesForCurrentDomain();

        return $modules[0] ?? null;
    }

    /**
     * Return the configured modules for the current domain.
     *
     * @return array<int,string>
     */
    public function getActiveModulesForCurrentDomain(): array
    {
        $currentDomain = $this->currentDomainName();
        $mapping = $this->domainMapping();

        if (!$currentDomain || !array_key_exists($currentDomain, $mapping)) {
            return $this->getRuntimeModules();
        }

        return $this->readModulesFromEnv($this->envFilePath($mapping[$currentDomain]));
    }

    /**
     * Return the configured module for a specific domain.
     */
    public function getActiveModuleForDomain(string $domain): ?string
    {
        $modules = $this->getActiveModulesForDomain($domain);

        return $modules[0] ?? null;
    }

    /**
     * Return the configured modules for a specific domain.
     *
     * @return array<int,string>
     */
    public function getActiveModulesForDomain(string $domain): array
    {
        $mapping = $this->domainMapping();

        if (!array_key_exists($domain, $mapping)) {
            throw new InvalidArgumentException("Domain [$domain] is not registered in config/domain.php.");
        }

        return $this->readModulesFromEnv($this->envFilePath($mapping[$domain]));
    }

    /**
     * Persist the module for a given domain into its .env.<domain> file.
     */
    public function setActiveModuleForDomain(string $domain, string $module): string
    {
        $modules = $this->setActiveModulesForDomain($domain, [$module]);

        return $modules[0];
    }

    /**
     * Persist modules for a given domain into its .env.<domain> file.
     *
     * @param  array<int,string>  $modules
     * @return array<int,string>
     */
    public function setActiveModulesForDomain(string $domain, array $modules): array
    {
        $normalizedModules = $this->normalizeModules($modules);

        $mapping = $this->domainMapping();

        if (!array_key_exists($domain, $mapping)) {
            throw new InvalidArgumentException("Domain [$domain] is not registered in config/domain.php.");
        }

        if (empty($normalizedModules)) {
            throw new InvalidArgumentException('At least one module must be provided.');
        }

        foreach ($normalizedModules as $moduleName) {
            if (!Module::has($moduleName)) {
                throw new InvalidArgumentException("Module [$moduleName] does not exist.");
            }
        }

        $envPath = $this->envFilePath($mapping[$domain]);

        $this->ensureEnvFileExists($envPath, $domain);
        $this->writeModulesToEnv($envPath, $normalizedModules);

        return $normalizedModules;
    }

    /**
     * List current module assignment for every configured domain.
     *
     * @return array<int,array<string,mixed>>
     */
    public function listAssignments(): array
    {
        return collect($this->domainMapping())
            ->map(function (string $envSuffix, string $domain): array {
                $envPath = $this->envFilePath($envSuffix);
                $modules = $this->readModulesFromEnv($envPath);

                return [
                    'domain' => $domain,
                    'env_file' => $envPath,
                    'module' => $modules[0] ?? null,
                    'modules' => $modules,
                ];
            })
            ->values()
            ->all();
    }

    /**
     * Get the name of the module actually loaded for the current request.
     */
    public function getRuntimeModule(): ?string
    {
        $modules = $this->getRuntimeModules();

        return $modules[0] ?? null;
    }

    /**
     * Get the modules configured in the currently loaded environment.
     *
     * @return array<int,string>
     */
    public function getRuntimeModules(): array
    {
        $raw = env($this->envKey);

        if ($raw === null) {
            return $this->defaultModules;
        }

        return $this->parseModules($this->sanitizeEnvValue($raw));
    }

    /**
     * List the modules available in the application.
     *
     * @return array<int,string>
     */
    public function availableModules(): array
    {
        return collect(Module::all())
            ->map(fn ($moduleInstance) => $moduleInstance->getName())
            ->sort()
            ->values()
            ->all();
    }

    /**
     * Build a normalized domain => envSuffix mapping based on config/domain.php.
     *
     * @return array<string,string>
     */
    protected function domainMapping(): array
    {
        $domains = config('domain.domains', []);

        if (empty($domains)) {
            return [];
        }

        if (!Arr::isAssoc($domains)) {
            return array_combine($domains, $domains);
        }

        return $domains;
    }

    protected function envFilePath(string $envSuffix): string
    {
        return base_path('.env.' . $envSuffix);
    }

    /**
     * @return array<int,string>
     */
    protected function readModulesFromEnv(string $envPath): array
    {
        if (!File::exists($envPath)) {
            return $this->defaultModules;
        }

        $contents = File::get($envPath);
        $pattern = '/^' . preg_quote($this->envKey, '/') . '\s*=.*$/m';

        if (preg_match($pattern, $contents)) {
            preg_match($pattern, $contents, $match);
            $line = $match[0] ?? null;

            if ($line !== null) {
                $value = trim(substr($line, strlen($this->envKey) + 1));

                return $this->parseModules($this->sanitizeEnvValue($value));
            }
        }

        return $this->defaultModules;
    }

    /**
     * @param  array<int,string>  $modules
     */
    protected function writeModulesToEnv(string $envPath, array $modules): void
    {
        $line = $this->envKey . '=' . $this->formatModules($modules);

        if (!File::exists($envPath)) {
            File::put($envPath, $line . PHP_EOL);

            return;
        }

        $contents = File::get($envPath);
        $pattern = '/^' . preg_quote($this->envKey, '/') . '\s*=.*$/m';

        if (preg_match($pattern, $contents)) {
            $updated = preg_replace($pattern, $line, $contents);
        } else {
            $updated = rtrim($contents) . PHP_EOL . $line . PHP_EOL;
        }

        File::put($envPath, $updated);
    }

    protected function ensureEnvFileExists(string $envPath, string $domain): void
    {
        if (File::exists($envPath)) {
            return;
        }

        $defaultModules = $this->formatModules($this->defaultModules);

        $header = [
            '# Environment settings for domain: ' . $domain,
            '# Generated on ' . now()->toDateTimeString(),
            $this->envKey . '=' . $defaultModules,
            '',
        ];

        File::put($envPath, implode(PHP_EOL, $header));
    }

    protected function sanitizeEnvValue(string $value): string
    {
        $trimmed = trim($value);

        if ($trimmed !== '' && Str::startsWith($trimmed, ['"', "'"]) && Str::endsWith($trimmed, ['"', "'"])) {
            $trimmed = substr($trimmed, 1, -1);
        }

        return trim($trimmed);
    }

    public function currentDomainName(): ?string
    {
        if (!method_exists(app(), 'domain')) {
            return request()->getHost();
        }

        return app()->domain();
    }

    /**
     * @param  array<int,string>|string|null  $modules
     * @return array<int,string>
     */
    protected function normalizeModules(array|string|null $modules): array
    {
        if (is_string($modules) || $modules === null) {
            return $this->parseModules($modules);
        }

        return $this->parseModules(
            implode($this->moduleSeparator, array_map(fn ($module) => (string) $module, $modules))
        );
    }

    /**
     * @return array<int,string>
     */
    protected function parseModules(?string $modules): array
    {
        if ($modules === null) {
            return $this->defaultModules;
        }

        $normalizedString = str_replace(["\n", "\r"], $this->moduleSeparator, $modules);

        $items = collect(explode($this->moduleSeparator, $normalizedString))
            ->map(fn ($module) => Str::studly(trim($module)))
            ->filter()
            ->unique()
            ->values()
            ->all();

        return !empty($items) ? $items : $this->defaultModules;
    }

    /**
     * @param  array<int,string>  $modules
     */
    protected function formatModules(array $modules): string
    {
        $normalized = $this->normalizeModules($modules);

        return implode($this->moduleSeparator, $normalized);
    }
}


