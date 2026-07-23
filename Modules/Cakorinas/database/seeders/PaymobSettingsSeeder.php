<?php

namespace Modules\Cakorinas\Database\Seeders;

use App\Modules\Cakorinas\app\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeds the Paymob merchant credentials into settings.payments['paymob'],
 * read by both the legacy Paymob flow (PaymobPaymentService) and the
 * Intention/Flash flow (PaymobIntentionService) via
 * PaymentServiceFactory::makeWithSettings(). Other gateway keys already
 * present under `payments` (tabby, tamara, paytabs, ...) are preserved.
 *
 * Run with: php artisan db:seed --class="Modules\Cakorinas\Database\Seeders\PaymobSettingsSeeder"
 */
class PaymobSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $paymobConfig = [
            'merchant_id' => env('PAYMOB_DB_MERCHANT_ID', '161280'),
            'api_key' => env('PAYMOB_DB_API_KEY', 'ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2libUZ0WlNJNkltbHVhWFJwWVd3aUxDSndjbTltYVd4bFgzQnJJam94TmpFeU9EQjkuU2xyZEdOUVFwVzJLc1Jmd18zUjZSTUtNNXlSN2RqZ1BUQzN1NlNkeU5JOU1xX3l4aFJQaWV1bC03NzV2NUVxdzhUVFhXODA0SmtCeVJWemhSSGlmUGc='),
            'hmac_secret' => env('PAYMOB_DB_HMAC_SECRET', 'C33E922A393B1FC79CA2F20AEB4B9FFB'),
            'integration_id' => env('PAYMOB_DB_INTEGRATION_ID', '1863480'),
            'iframe_id' => env('PAYMOB_DB_IFRAME_ID', '357573'),
            'currency' => env('PAYMOB_DB_CURRENCY', 'EGP'),
        ];

        // Written via the query builder (not Setting::save()) to avoid the model's
        // 'updated' event, whose listener class reference is broken in this codebase.
        Setting::query()->get()->each(function (Setting $setting) use ($paymobConfig) {
            $payments = (array) ($setting->payments ?? []);
            $payments['paymob'] = array_merge($payments['paymob'] ?? [], $paymobConfig);

            DB::table('settings')->where('id', $setting->id)->update([
                'payments' => json_encode($payments),
            ]);
        });
    }
}
