<?php

namespace App\Modules\Sixtyminutes\app\Http\Controllers\Front;

use App\Modules\Sixtyminutes\app\Http\Controllers\Front\GenericFrontController;
use App\Modules\Sixtyminutes\app\Services\SubscriptionPaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Payment Controller for Sixtyminutes Module
 *
 * Handles payment operations for gym subscriptions
 * Automatically uses Tabby payment provider via PaymentServiceFactory
 */
class PaymentFrontController extends GenericFrontController
{
    protected SubscriptionPaymentService $paymentService;

    public function __construct(SubscriptionPaymentService $paymentService)
    {
        parent::__construct();
        $this->paymentService = $paymentService;
    }

    /**
     * Initiate subscription payment
     *
     * POST /api/subscription/payment/create
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPayment(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'member_id' => 'required|integer',
                'subscription_id' => 'required|integer',
                'amount' => 'required|numeric|min:0.01',
                'currency' => 'sometimes|string|in:SAR,USD,AED',
                'member_name' => 'required|string',
                'member_email' => 'sometimes|email',
                'member_phone' => 'required|string',
                'subscription_name' => 'sometimes|string',
            ]);

            // Add default currency if not provided
            $validated['currency'] = $validated['currency'] ?? 'SAR';

            // Add return URLs
            $validated['return_url'] = route('subscription.payment.success');
            $validated['cancel_url'] = route('subscription.payment.cancel');
            $validated['failure_url'] = route('subscription.payment.failure');

            // Create payment
            $result = $this->paymentService->createSubscriptionPayment($validated);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Payment session created successfully',
                    'payment_url' => $result['payment_url'],
                    'transaction_id' => $result['transaction_id'],
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $result['message'],
                ], 400);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            Log::error('Payment creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating payment',
            ], 500);
        }
    }

    /**
     * Payment callback handler (webhook from payment gateway)
     *
     * POST /api/subscription/payment/callback
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function paymentCallback(Request $request)
    {
        try {
            $callbackData = $request->all();

            Log::info('Payment callback received', ['data' => $callbackData]);

            // Verify payment
            $result = $this->paymentService->verifySubscriptionPayment($callbackData);

            if ($result['success'] && $result['verified']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Payment verified successfully',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $result['message'],
                ], 400);
            }

        } catch (\Exception $e) {
            Log::error('Payment callback processing failed', [
                'error' => $e->getMessage(),
                'data' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Callback processing failed',
            ], 500);
        }
    }

    /**
     * Payment success page
     *
     * GET /subscription/payment/success
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function paymentSuccess(Request $request)
    {
        $transactionId = $request->query('transaction_id');
        $paymentId = $request->query('payment_id');

        $record = $this->mainSettings;
        $title = 'Payment Successful';
        $lang = $this->lang;

        return view('sixtyminutes::Front.payment_success', compact(
            'title',
            'record',
            'lang',
            'transactionId',
            'paymentId'
        ));
    }

    /**
     * Payment cancel page
     *
     * GET /subscription/payment/cancel
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function paymentCancel(Request $request)
    {
        $record = $this->mainSettings;
        $title = 'Payment Cancelled';
        $lang = $this->lang;

        return view('sixtyminutes::Front.payment_cancel', compact('title', 'record', 'lang'));
    }

    /**
     * Payment failure page
     *
     * GET /subscription/payment/failure
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function paymentFailure(Request $request)
    {
        $error = $request->query('error', 'Payment failed');

        $record = $this->mainSettings;
        $title = 'Payment Failed';
        $lang = $this->lang;

        return view('sixtyminutes::Front.payment_failure', compact('title', 'record', 'lang', 'error'));
    }

    /**
     * Get payment status
     *
     * GET /api/subscription/payment/status/{transactionId}
     *
     * @param string $transactionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPaymentStatus(string $transactionId)
    {
        try {
            $result = $this->paymentService->getPaymentStatus($transactionId);

            return response()->json($result, $result['success'] ? 200 : 400);

        } catch (\Exception $e) {
            Log::error('Failed to get payment status', [
                'transaction_id' => $transactionId,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to get payment status',
            ], 500);
        }
    }

    /**
     * Refund payment
     *
     * POST /api/subscription/payment/refund
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refundPayment(Request $request)
    {
        try {
            $validated = $request->validate([
                'transaction_id' => 'required|string',
                'amount' => 'sometimes|numeric|min:0.01',
            ]);

            $result = $this->paymentService->refundSubscriptionPayment(
                $validated['transaction_id'],
                $validated['amount'] ?? null
            );

            return response()->json($result, $result['success'] ? 200 : 400);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            Log::error('Refund failed', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Refund processing failed',
            ], 500);
        }
    }
}
