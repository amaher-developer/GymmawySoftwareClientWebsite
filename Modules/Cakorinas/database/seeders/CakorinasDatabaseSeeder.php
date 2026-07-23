<?php

namespace Modules\Cakorinas\Database\Seeders;

use Illuminate\Database\Seeder;

class CakorinasDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymobIntention = [
            'merchant_id'    => '161280',
            'secret_key'     => 'ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2libUZ0WlNJNkltbHVhWFJwWVd3aUxDSndjbTltYVd4bFgzQnJJam94TmpFeU9EQjkuU2xyZEdOUVFwVzJLc1Jmd18zUjZSTUtNNXlSN2RqZ1BUQzN1NlNkeU5JOU1xX3l4aFJQaWV1bC03NzV2NUVxdzhUVFhXODA0SmtCeVJWemhSSGlmUGc=', // TODO: fill in from Paymob dashboard -> Payment Integrations -> API keys
            'public_key'     => 'ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2libUZ0WlNJNkltbHVhWFJwWVd3aUxDSndjbTltYVd4bFgzQnJJam94TmpFeU9EQjkuU2xyZEdOUVFwVzJLc1Jmd18zUjZSTUtNNXlSN2RqZ1BUQzN1NlNkeU5JOU1xX3l4aFJQaWV1bC03NzV2NUVxdzhUVFhXODA0SmtCeVJWemhSSGlmUGc=', // TODO: fill in from Paymob dashboard -> Payment Integrations -> API keys
            'integration_id' => '1863480',
            'hmac_secret'    => 'C33E922A393B1FC79CA2F20AEB4B9FFB',
            'currency'       => 'SAR',
        ];

        Setting::all()->each(function (Setting $setting) use ($paymobIntention) {
            $payments = $setting->payments ?? [];
            $payments['paymob_intention'] = array_merge($payments['paymob_intention'] ?? [], $paymobIntention);

            $setting->payments = $payments;
            $setting->save();
        });
    }
}

