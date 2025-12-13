<?php

namespace Modules\Common\Services;

use Illuminate\Support\Facades\Log;

class PayTabService
{
    protected int $profileId;
    protected string $serverKey;
    protected string $baseUrl;

    public function __construct()
    {
        $cfg = config('common.paytab', []);

        $this->profileId = (int) ($cfg['profile_id'] ?? 0);
        $this->serverKey = $cfg['server_key'] ?? '';
        $this->baseUrl = rtrim($cfg['base_url'] ?? 'https://secure.paytabs.sa/', '/');
    }

    /**
     * Send API request to PayTab
     *
     * @param string $requestUrl
     * @param array $data
     * @param string|null $requestMethod
     * @return array|null
     */
    public function sendApiRequest(string $requestUrl, array $data, ?string $requestMethod = null): ?array
    {
        $data['profile_id'] = $this->profileId;

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->baseUrl . '/' . $requestUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_CUSTOMREQUEST => $requestMethod ?? 'POST',
            CURLOPT_POSTFIELDS => json_encode($data, true),
            CURLOPT_HTTPHEADER => [
                'authorization:' . $this->serverKey,
                'Content-Type:application/json'
            ],
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $result = json_decode($response, true);

        if ($httpCode >= 400 || !$result) {
            Log::error('PayTab API request failed', [
                'url' => $requestUrl,
                'http_code' => $httpCode,
                'response' => $response
            ]);
            return null;
        }

        return $result;
    }

    /**
     * Validate redirect signature from PayTab
     *
     * @param array $postValues
     * @return bool
     */
    public function isValidRedirect(array $postValues): bool
    {
        // Request body includes a signature post Form URL encoded field
        // 'signature' (hexadecimal encoding for hmac of sorted post form fields)
        $requestSignature = $postValues["signature"] ?? '';

        if (empty($requestSignature)) {
            return false;
        }

        unset($postValues["signature"]);
        $fields = array_filter($postValues);

        // Sort form fields
        ksort($fields);

        // Generate URL-encoded query string of Post fields except signature field.
        $query = http_build_query($fields);

        $signature = hash_hmac('sha256', $query, $this->serverKey);

        return hash_equals($signature, $requestSignature);
    }

    /**
     * Get base URL of the application
     *
     * @return string
     */
    public function getBaseUrl(): string
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
                    ($_SERVER['SERVER_PORT'] ?? 80) == 443 ? 'https://' : 'https://';
        $hostName = $_SERVER['HTTP_HOST'] ?? 'localhost';

        return $protocol . $hostName . '/';
    }
}
