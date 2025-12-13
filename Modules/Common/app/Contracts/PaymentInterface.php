<?php

namespace Modules\Common\Contracts;

/**
 * Payment Service Interface
 *
 * All payment providers must implement this interface to ensure consistency
 * across different payment gateways (Paymob, Tabby, etc.)
 */
interface PaymentInterface
{
    /**
     * Create a payment session and return the payment URL/link
     *
     * @param array $orderData Order details including:
     *                         - amount: Total amount (in main currency units, e.g., SAR, EGP)
     *                         - currency: Currency code (SAR, EGP, USD, etc.)
     *                         - order_id: Unique order identifier
     *                         - customer: Array with customer details (name, email, phone)
     *                         - callback_url: URL for payment success callback
     *                         - return_url: URL to redirect after payment
     *                         - metadata: Additional data to store with the payment
     * @return array Response containing:
     *               - success: boolean
     *               - payment_url: string (URL to redirect customer)
     *               - transaction_id: string (Payment gateway transaction reference)
     *               - message: string (Error message if success is false)
     */
    public function createPayment(array $orderData): array;

    /**
     * Verify payment callback/webhook from payment gateway
     *
     * @param array $callbackData Raw callback data from payment gateway
     * @return array Response containing:
     *               - success: boolean
     *               - verified: boolean (signature/authenticity check)
     *               - transaction_id: string
     *               - order_id: string
     *               - amount: float
     *               - status: string (success, failed, pending)
     *               - message: string
     */
    public function verifyPayment(array $callbackData): array;

    /**
     * Get payment status by transaction ID
     *
     * @param string $transactionId Payment gateway transaction reference
     * @return array Response containing:
     *               - success: boolean
     *               - status: string (success, failed, pending, refunded)
     *               - amount: float
     *               - transaction_id: string
     *               - order_id: string
     *               - paid_at: string|null (datetime)
     *               - message: string
     */
    public function getPaymentStatus(string $transactionId): array;

    /**
     * Refund a payment
     *
     * @param string $transactionId Payment gateway transaction reference
     * @param float|null $amount Amount to refund (null for full refund)
     * @return array Response containing:
     *               - success: boolean
     *               - refund_id: string
     *               - refunded_amount: float
     *               - message: string
     */
    public function refundPayment(string $transactionId, ?float $amount = null): array;

    /**
     * Get the payment provider name
     *
     * @return string Provider name (e.g., 'paymob', 'tabby')
     */
    public function getProviderName(): string;
}
