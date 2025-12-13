<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Payment Provider
    |--------------------------------------------------------------------------
    |
    | This option controls the default payment provider that will be used
    | if module auto-detection fails. Options: 'paymob', 'tabby'
    |
    */
    'default_provider' => env('PAYMENT_DEFAULT_PROVIDER', 'tabby'),

    /*
    |--------------------------------------------------------------------------
    | Module to Provider Mapping
    |--------------------------------------------------------------------------
    |
    | Define which payment provider each module should use
    |
    */
    'module_mapping' => [
        'redbone' => 'paymob',
        'cakorinas' => 'paymob',
        'sixtyminutes' => 'tabby',
        'almadagym' => 'tabby',
        'zonegym' => 'tabby',
    ],

    /*
    |--------------------------------------------------------------------------
    | Domain to Module Mapping (for multi-domain setup)
    |--------------------------------------------------------------------------
    |
    | Map domains to modules for automatic module detection
    |
    */
    'domain_mapping' => [
        'redbone.com' => 'redbone',
        'cakorinas.com' => 'cakorinas',
        'sixtyminutes.com' => 'sixtyminutes',
        'almadagym.com' => 'almadagym',
        'zonegym.com' => 'zonegym',
    ],
];
