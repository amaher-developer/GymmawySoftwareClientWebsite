<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Paymob Payment Gateway Configuration
    |--------------------------------------------------------------------------
    |
    | Used by: Redbone, Cakorinas modules
    |
    */

    // Paymob API credentials
    'api_key' => env('PAYMOB_API_KEY', ''),

    // Paymob integration ID (provided by Paymob dashboard)
    'integration_id' => env('PAYMOB_INTEGRATION_ID', ''),

    // Paymob iframe ID (for embedded payment form)
    'iframe_id' => env('PAYMOB_IFRAME_ID', ''),

    // Base endpoint for Paymob API
    'endpoint' => env('PAYMOB_ENDPOINT', 'https://accept.paymob.com'),

    // Default currency
    'currency' => env('PAYMOB_CURRENCY', 'EGP'),
];
