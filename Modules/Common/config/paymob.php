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

    // Legacy Paymob API key (used only for /api/auth/tokens - order lookup & refunds)
    'api_key' => env('PAYMOB_API_KEY', ''),

    // Paymob Secret Key - authorizes the Unified Intention API (v1/intention/) requests
    'secret_key' => env('PAYMOB_SECRET_KEY', ''),

    // Paymob Public Key - used to build the Unified Checkout redirect URL
    'public_key' => env('PAYMOB_PUBLIC_KEY', ''),

    // HMAC secret used to verify the authenticity of Paymob payment callbacks
    'hmac_secret' => env('PAYMOB_HMAC_SECRET', ''),

    // Paymob integration ID (provided by Paymob dashboard)
    'integration_id' => env('PAYMOB_INTEGRATION_ID', ''),

    // Paymob iframe ID (legacy embedded payment form, unused by the Unified Checkout flow)
    'iframe_id' => env('PAYMOB_IFRAME_ID', ''),

    // Base endpoint for Paymob API
    'endpoint' => env('PAYMOB_ENDPOINT', 'https://accept.paymob.com'),

    // Default currency
    'currency' => env('PAYMOB_CURRENCY', 'EGP'),

    /*
    |--------------------------------------------------------------------------
    | Paymob Intention API ("Flash" / Unified Checkout) — additive settings
    |--------------------------------------------------------------------------
    |
    | Used only by PaymobIntentionService. Does not affect the legacy
    | order/payment-key flow above (PaymobPaymentService / PaymobService).
    |
    */

    // Comma-separated integration IDs/slugs offered on the Unified Checkout page.
    // Falls back to `integration_id` above when left empty.
    'intention_payment_methods' => array_values(array_filter(array_map(
        'trim',
        explode(',', (string) env('PAYMOB_INTENTION_PAYMENT_METHODS', ''))
    ))),
];
