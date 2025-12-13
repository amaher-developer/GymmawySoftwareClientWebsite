<?php

namespace Modules\Common\Factories;

use Modules\Common\Contracts\PaymentInterface;
use Modules\Common\Services\PaymobPaymentService;
use Modules\Common\Services\TabbyPaymentService;
use Illuminate\Support\Facades\Log;

/**
 * Payment Service Factory
 *
 * Responsible for creating the appropriate payment service based on the module name
 *
 * Module-to-Provider Mapping:
 * - Redbone, Cakorinas → Paymob
 * - Sixtyminutes, Almadagym, Zonegym → Tabby
 */
class PaymentServiceFactory
{
    /**
     * Module to provider mapping
     */
    protected const MODULE_PROVIDER_MAP = [
        'redbone' => 'paymob',
        'cakorinas' => 'paymob',
        'sixtyminutes' => 'tabby',
        'almadagym' => 'tabby',
        'zonegym' => 'tabby',
    ];

    /**
     * Provider class mapping
     */
    protected const PROVIDER_CLASS_MAP = [
        'paymob' => PaymobPaymentService::class,
        'tabby' => TabbyPaymentService::class,
    ];

    /**
     * Create payment service for the given module
     *
     * @param string|null $moduleName Module name (e.g., 'Sixtyminutes', 'Redbone')
     * @return PaymentInterface
     * @throws \Exception
     */
    public static function make(?string $moduleName = null): PaymentInterface
    {
        // Auto-detect module name if not provided
        if ($moduleName === null) {
            $moduleName = self::detectModuleName();
        }

        // Normalize module name to lowercase
        $moduleKey = strtolower($moduleName);

        // Get provider for this module
        $provider = self::MODULE_PROVIDER_MAP[$moduleKey] ?? null;

        if (!$provider) {
            Log::error('PaymentServiceFactory: Unknown module', ['module' => $moduleName]);
            throw new \Exception("Payment provider not configured for module: {$moduleName}");
        }

        // Get provider class
        $providerClass = self::PROVIDER_CLASS_MAP[$provider] ?? null;

        if (!$providerClass || !class_exists($providerClass)) {
            Log::error('PaymentServiceFactory: Provider class not found', ['provider' => $provider]);
            throw new \Exception("Payment provider class not found: {$provider}");
        }

        // Create and return provider instance
        return app($providerClass);
    }

    /**
     * Create payment service for a specific provider (bypass module detection)
     *
     * @param string $provider Provider name ('paymob' or 'tabby')
     * @return PaymentInterface
     * @throws \Exception
     */
    public static function makeProvider(string $provider): PaymentInterface
    {
        $providerKey = strtolower($provider);
        $providerClass = self::PROVIDER_CLASS_MAP[$providerKey] ?? null;

        if (!$providerClass || !class_exists($providerClass)) {
            throw new \Exception("Unknown payment provider: {$provider}");
        }

        return app($providerClass);
    }

    /**
     * Detect current module name from various sources
     *
     * @return string
     */
    protected static function detectModuleName(): string
    {
        // Method 1: Check if module is set in config
        $configModule = config('app.current_module');
        if ($configModule) {
            return $configModule;
        }

        // Method 2: Check environment variable
        $envModule = env('APP_MODULE');
        if ($envModule) {
            return $envModule;
        }

        // Method 3: Detect from current domain (for multi-domain setup)
        $domain = request()->getHost();
        $moduleName = self::detectModuleFromDomain($domain);
        if ($moduleName) {
            return $moduleName;
        }

        // Method 4: Check request header (useful for API calls)
        $headerModule = request()->header('X-Module');
        if ($headerModule) {
            return $headerModule;
        }

        // Method 5: Extract from namespace (fallback)
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10);
        foreach ($backtrace as $trace) {
            if (isset($trace['class'])) {
                if (preg_match('/\\\\Modules\\\\([^\\\\]+)\\\\/', $trace['class'], $matches)) {
                    return $matches[1];
                }
            }
        }

        // Default fallback
        Log::warning('PaymentServiceFactory: Could not auto-detect module name, using default');
        return 'Sixtyminutes'; // Default module
    }

    /**
     * Detect module from domain name
     *
     * @param string $domain
     * @return string|null
     */
    protected static function detectModuleFromDomain(string $domain): ?string
    {
        // Define domain to module mapping
        $domainMap = [
            'redbone.com' => 'Redbone',
            'cakorinas.com' => 'Cakorinas',
            'sixtyminutes.com' => 'Sixtyminutes',
            'almadagym.com' => 'Almadagym',
            'zonegym.com' => 'Zonegym',
        ];

        foreach ($domainMap as $domainPattern => $moduleName) {
            if (str_contains($domain, $domainPattern)) {
                return $moduleName;
            }
        }

        return null;
    }

    /**
     * Get the provider name for a given module
     *
     * @param string $moduleName
     * @return string
     */
    public static function getProviderForModule(string $moduleName): string
    {
        $moduleKey = strtolower($moduleName);
        return self::MODULE_PROVIDER_MAP[$moduleKey] ?? 'unknown';
    }

    /**
     * Get all available providers
     *
     * @return array
     */
    public static function getAvailableProviders(): array
    {
        return array_keys(self::PROVIDER_CLASS_MAP);
    }

    /**
     * Get all module to provider mappings
     *
     * @return array
     */
    public static function getModuleProviderMap(): array
    {
        return self::MODULE_PROVIDER_MAP;
    }
}
