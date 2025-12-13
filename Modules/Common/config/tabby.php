<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Tabby Payment Gateway Configuration
    |--------------------------------------------------------------------------
    |
    | Used by: Sixtyminutes, Almadagym, Zonegym modules
    | Tabby is a Buy Now Pay Later (BNPL) service
    |
    */

    // Tabby public key (for client-side integration)
    'public_key' => env('TABBY_PUBLIC_KEY', ''),

    // Tabby secret key (for server-side API calls)
    'secret_key' => env('TABBY_SECRET_KEY', ''),

    // Tabby merchant code
    'merchant_code' => env('TABBY_MERCHANT_CODE', ''),

    // Base URL for Tabby API
    'base_url' => env('TABBY_BASE_URL', 'https://api.tabby.ai'),

    // Default currency
    'currency' => env('TABBY_CURRENCY', 'SAR'),

    // Disable SSL verification (only for local development with SSL certificate issues)
    // WARNING: Set this to false in production for security!
    'disable_ssl_verify' => env('TABBY_DISABLE_SSL_VERIFY', false),
];
