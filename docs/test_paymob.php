<?php

/**
 * Quick Test Script for Paymob Payment Integration
 *
 * This script tests if:
 * 1. Common module is loaded
 * 2. PaymentServiceFactory can be instantiated
 * 3. Paymob service can be created for Cakorinas
 *
 * Run from command line: php test_paymob.php
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Paymob Integration Test ===\n\n";

// Test 1: Check if PaymentServiceFactory exists
echo "1. Checking if PaymentServiceFactory class exists...\n";
if (class_exists('Modules\Common\Factories\PaymentServiceFactory')) {
    echo "   ✓ PaymentServiceFactory class found\n\n";
} else {
    echo "   ✗ PaymentServiceFactory class NOT found\n";
    echo "   Make sure Common module is enabled\n\n";
    exit(1);
}

// Test 2: Check if PaymobPaymentService exists
echo "2. Checking if PaymobPaymentService class exists...\n";
if (class_exists('Modules\Common\Services\PaymobPaymentService')) {
    echo "   ✓ PaymobPaymentService class found\n\n";
} else {
    echo "   ✗ PaymobPaymentService class NOT found\n\n";
    exit(1);
}

// Test 3: Try to create Paymob service for Cakorinas
echo "3. Creating Paymob payment service for Cakorinas...\n";
try {
    $paymentService = \Modules\Common\Factories\PaymentServiceFactory::make('Cakorinas');
    echo "   ✓ Payment service created successfully\n";
    echo "   Provider: " . $paymentService->getProviderName() . "\n\n";
} catch (Exception $e) {
    echo "   ✗ Failed to create payment service\n";
    echo "   Error: " . $e->getMessage() . "\n\n";
    exit(1);
}

// Test 4: Check configuration
echo "4. Checking Paymob configuration...\n";
$apiKey = config('common.paymob.api_key');
$integrationId = config('common.paymob.integration_id');
$iframeId = config('common.paymob.iframe_id');

if (empty($apiKey)) {
    echo "   ⚠ PAYMOB_API_KEY is not set in .env\n";
} else {
    echo "   ✓ PAYMOB_API_KEY is configured (" . substr($apiKey, 0, 20) . "...)\n";
}

if (empty($integrationId)) {
    echo "   ⚠ PAYMOB_INTEGRATION_ID is not set in .env\n";
} else {
    echo "   ✓ PAYMOB_INTEGRATION_ID is configured: " . $integrationId . "\n";
}

if (empty($iframeId)) {
    echo "   ⚠ PAYMOB_IFRAME_ID is not set in .env\n";
} else {
    echo "   ✓ PAYMOB_IFRAME_ID is configured: " . $iframeId . "\n";
}

echo "\n";

// Test 5: Check module detection
echo "5. Testing module auto-detection...\n";
$detectedModule = env('APP_MODULE');
if ($detectedModule) {
    echo "   ✓ APP_MODULE is set to: " . $detectedModule . "\n";
} else {
    echo "   ⚠ APP_MODULE is not set in .env\n";
    echo "   Module will be auto-detected from namespace\n";
}

echo "\n=== Test Complete ===\n\n";

if (empty($apiKey) || empty($integrationId) || empty($iframeId)) {
    echo "⚠ Warning: Paymob credentials are not fully configured.\n";
    echo "Add these to your .env file:\n\n";
    echo "PAYMOB_API_KEY=your_test_api_key\n";
    echo "PAYMOB_INTEGRATION_ID=your_test_integration_id\n";
    echo "PAYMOB_IFRAME_ID=your_test_iframe_id\n";
    echo "APP_MODULE=Cakorinas\n\n";
} else {
    echo "✓ All tests passed! Paymob integration is ready.\n\n";
    echo "Next steps:\n";
    echo "1. Navigate to: http://your-domain.com/subscription-payment/1\n";
    echo "2. Fill in the payment form\n";
    echo "3. Select payment method: Paymob (value = 3)\n";
    echo "4. Test with card: 5123450000000008, CVV: 123, Expiry: 12/25\n\n";
}
