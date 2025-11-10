<?php

$envKey = env('CLIENT_MODULE_ENV_KEY', 'CLIENT_ACTIVE_MODULE');
$separator = env('CLIENT_MODULE_SEPARATOR', ',');

$rawDefault = env('CLIENT_DEFAULT_MODULES');
$defaultModules = $rawDefault !== null
    ? array_values(array_filter(array_map('trim', explode($separator, $rawDefault))))
    : [env('CLIENT_DEFAULT_MODULE', 'Common')];

$defaultModules = array_values(array_filter(array_map(
    fn ($module) => $module !== '' ? $module : null,
    $defaultModules
)));

if (empty($defaultModules)) {
    $defaultModules = ['Common'];
}

$rawActive = env($envKey);
$activeModules = $rawActive !== null
    ? array_values(array_filter(array_map('trim', explode($separator, $rawActive))))
    : $defaultModules;

return [
    /*
    |--------------------------------------------------------------------------
    | Environment variable storing the active module(s) for a domain
    |--------------------------------------------------------------------------
    */
    'env_key' => $envKey,

    /*
    |--------------------------------------------------------------------------
    | Separator used when multiple modules are stored in the env value
    |--------------------------------------------------------------------------
    */
    'module_separator' => $separator,

    /*
    |--------------------------------------------------------------------------
    | Default module(s) fallback
    |--------------------------------------------------------------------------
    */
    'default_module' => $defaultModules[0] ?? null,
    'default_modules' => $defaultModules,

    /*
    |--------------------------------------------------------------------------
    | Resolved module(s) for the current request
    |--------------------------------------------------------------------------
    */
    'active_module' => $activeModules[0] ?? null,
    'active_modules' => $activeModules,
];


