<?php

namespace Modules\Common\Services;

class GymmawyNotificationService
{
    /**
     * Fire-and-forget: notify SaaS system of a successful payment.
     */
    public static function notifyPayment(): void
    {
        static::fireAndForget('notification/test-app-payment');
    }

    /**
     * Fire-and-forget: notify SaaS system of a successful reservation.
     */
    public static function notifyReservation(): void
    {
        static::fireAndForget('notification/test-app-reservation');
    }

    /**
     * Send a POST request to the SaaS master URL without waiting for the response.
     */
    private static function fireAndForget(string $path): void
    {
        try {
            $url = rtrim((string) env('APP_URL_MASTER'), '/') . '/' . ltrim($path, '/');

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL            => $url,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => '',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT        => 1,
                CURLOPT_CONNECTTIMEOUT => 1,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
            ]);
            curl_exec($ch);
            curl_close($ch);
        } catch (\Throwable $e) {
            // Intentionally silent — notification is best-effort only.
        }
    }
}
