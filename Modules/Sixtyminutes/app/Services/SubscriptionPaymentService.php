<?php

namespace App\Modules\Sixtyminutes\app\Services;

use Modules\Common\Contracts\PaymentInterface;
use Modules\Common\Factories\PaymentServiceFactory;
use Illuminate\Support\Facades\Log;

/**
 * Subscription Payment Service
 *
 * Business logic layer for handling subscription payments in Sixtyminutes module
 * This service uses the PaymentServiceFactory to automatically get the correct payment provider (Tabby)
 */
class SubscriptionPaymentService
{
    protected PaymentInterface $paymentService;

    public function __construct()
    {
        // Automatically get the correct payment provider for this module
        // For Sixtyminutes, this will return TabbyPaymentService
        $this->paymentService = PaymentServiceFactory::make('Sixtyminutes');
    }

    /**
     * Create a payment for a subscription
     *
     * @param array $subscriptionData
     * @return array
     */
    public function createSubscriptionPayment(array $subscriptionData): array
    {
        try {
            // Validate subscription data
            if (!$this->validateSubscriptionData($subscriptionData)) {
                return [
                    'success' => false,
                    'message' => 'Invalid subscription data',
                    'payment_url' => null,
                ];
            }

            // Prepare order data for payment gateway
            $orderData = $this->prepareOrderData($subscriptionData);

            // Create payment through payment service
            $result = $this->paymentService->createPayment($orderData);

            // Log payment creation
            if ($result['success']) {
                Log::info('Subscription payment created', [
                    'transaction_id' => $result['transaction_id'],
                    'member_id' => $subscriptionData['member_id'] ?? null,
                    'subscription_id' => $subscriptionData['subscription_id'] ?? null,
                    'provider' => $this->paymentService->getProviderName(),
                ]);

                // TODO: Store payment record in database
                $this->storePaymentRecord($subscriptionData, $result);
            } else {
                Log::error('Failed to create subscription payment', [
                    'error' => $result['message'],
                    'data' => $subscriptionData,
                ]);
            }

            return $result;

        } catch (\Exception $e) {
            Log::error('Subscription payment creation exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'message' => 'Payment creation failed: ' . $e->getMessage(),
                'payment_url' => null,
            ];
        }
    }

    /**
     * Verify payment callback
     *
     * @param array $callbackData
     * @return array
     */
    public function verifySubscriptionPayment(array $callbackData): array
    {
        try {
            // Verify payment through payment service
            $result = $this->paymentService->verifyPayment($callbackData);

            if ($result['success'] && $result['verified']) {
                Log::info('Subscription payment verified', [
                    'transaction_id' => $result['transaction_id'],
                    'order_id' => $result['order_id'],
                    'amount' => $result['amount'],
                ]);

                // TODO: Update subscription status in database
                $this->updateSubscriptionStatus($result);
            } else {
                Log::warning('Subscription payment verification failed', [
                    'result' => $result,
                ]);
            }

            return $result;

        } catch (\Exception $e) {
            Log::error('Subscription payment verification exception', [
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'verified' => false,
                'message' => 'Verification failed: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Get payment status
     *
     * @param string $transactionId
     * @return array
     */
    public function getPaymentStatus(string $transactionId): array
    {
        return $this->paymentService->getPaymentStatus($transactionId);
    }

    /**
     * Refund subscription payment
     *
     * @param string $transactionId
     * @param float|null $amount
     * @return array
     */
    public function refundSubscriptionPayment(string $transactionId, ?float $amount = null): array
    {
        try {
            $result = $this->paymentService->refundPayment($transactionId, $amount);

            if ($result['success']) {
                Log::info('Subscription payment refunded', [
                    'transaction_id' => $transactionId,
                    'refund_id' => $result['refund_id'],
                    'amount' => $result['refunded_amount'],
                ]);

                // TODO: Update subscription and payment records
                $this->updateRefundStatus($transactionId, $result);
            }

            return $result;

        } catch (\Exception $e) {
            Log::error('Subscription payment refund exception', [
                'transaction_id' => $transactionId,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => 'Refund failed: ' . $e->getMessage(),
            ];
        }
    }

    // =====================================================================
    // PRIVATE HELPER METHODS
    // =====================================================================

    /**
     * Validate subscription data
     *
     * @param array $data
     * @return bool
     */
    protected function validateSubscriptionData(array $data): bool
    {
        $required = ['amount', 'currency', 'member_id', 'subscription_id'];

        foreach ($required as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                return false;
            }
        }

        return true;
    }

    /**
     * Prepare order data for payment gateway
     *
     * @param array $subscriptionData
     * @return array
     */
    protected function prepareOrderData(array $subscriptionData): array
    {
        return [
            'amount' => $subscriptionData['amount'],
            'currency' => $subscriptionData['currency'] ?? 'SAR',
            'order_id' => $this->generateOrderId($subscriptionData),
            'description' => $subscriptionData['description'] ?? 'Gym Subscription Payment',
            'customer' => [
                'name' => $subscriptionData['member_name'] ?? 'Member',
                'email' => $subscriptionData['member_email'] ?? 'member@example.com',
                'phone' => $subscriptionData['member_phone'] ?? '',
                'registered_since' => $subscriptionData['member_registered_at'] ?? now()->subMonths(1)->toIso8601String(),
                'loyalty_level' => 0,
            ],
            'callback_url' => route('subscription.payment.callback'),
            'return_url' => $subscriptionData['return_url'] ?? route('subscription.payment.success'),
            'cancel_url' => $subscriptionData['cancel_url'] ?? route('subscription.payment.cancel'),
            'failure_url' => $subscriptionData['failure_url'] ?? route('subscription.payment.failure'),
            'metadata' => [
                'member_id' => $subscriptionData['member_id'],
                'subscription_id' => $subscriptionData['subscription_id'],
                'module' => 'Sixtyminutes',
            ],
            'lang' => $subscriptionData['lang'] ?? 'en',
            'items' => [
                [
                    'title' => $subscriptionData['subscription_name'] ?? 'Gym Subscription',
                    'quantity' => 1,
                    'unit_price' => (string) $subscriptionData['amount'],
                    'category' => 'Subscription',
                ]
            ],
        ];
    }

    /**
     * Generate unique order ID
     *
     * @param array $subscriptionData
     * @return string
     */
    protected function generateOrderId(array $subscriptionData): string
    {
        return 'SUB_' . $subscriptionData['subscription_id'] . '_' . time();
    }

    /**
     * Store payment record in database
     *
     * @param array $subscriptionData
     * @param array $paymentResult
     * @return void
     */
    protected function storePaymentRecord(array $subscriptionData, array $paymentResult): void
    {
        // TODO: Implement database storage
        // Example:
        // Payment::create([
        //     'transaction_id' => $paymentResult['transaction_id'],
        //     'member_id' => $subscriptionData['member_id'],
        //     'subscription_id' => $subscriptionData['subscription_id'],
        //     'amount' => $subscriptionData['amount'],
        //     'currency' => $subscriptionData['currency'],
        //     'status' => 'pending',
        //     'provider' => $this->paymentService->getProviderName(),
        //     'payment_url' => $paymentResult['payment_url'],
        // ]);
    }

    /**
     * Update subscription status after payment verification
     *
     * @param array $verificationResult
     * @return void
     */
    protected function updateSubscriptionStatus(array $verificationResult): void
    {
        // TODO: Implement subscription activation logic
        // Example:
        // $payment = Payment::where('transaction_id', $verificationResult['transaction_id'])->first();
        // if ($payment) {
        //     $payment->update(['status' => 'completed']);
        //
        //     $subscription = MemberSubscription::find($payment->subscription_id);
        //     $subscription->activate();
        // }
    }

    /**
     * Update refund status
     *
     * @param string $transactionId
     * @param array $refundResult
     * @return void
     */
    protected function updateRefundStatus(string $transactionId, array $refundResult): void
    {
        // TODO: Implement refund status update
        // Example:
        // Payment::where('transaction_id', $transactionId)->update([
        //     'status' => 'refunded',
        //     'refund_id' => $refundResult['refund_id'],
        //     'refunded_amount' => $refundResult['refunded_amount'],
        //     'refunded_at' => now(),
        // ]);
    }
}
