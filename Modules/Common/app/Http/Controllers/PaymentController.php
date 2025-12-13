<?php

namespace Modules\Common\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Services\PaymobService;
use Modules\Common\Services\PayTabService;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected PaymobService $paymob;
    protected PayTabService $paytab;

    public function __construct(PaymobService $paymob, PayTabService $paytab)
    {
        $this->paymob = $paymob;
        $this->paytab = $paytab;
    }

    /**
     * Create a Paymob payment and return iframe URL or token.
     */
    public function create(Request $request)
    {
        $amount = (int) $request->input('amount_cents', 0);
        if ($amount <= 0) {
            return response()->json(['error' => 'Invalid amount'], 400);
        }

        $order = $this->paymob->createOrder($amount);
        if (empty($order) || empty($order['id'])) {
            return response()->json(['error' => 'Failed to create order with Paymob'], 500);
        }

        $paymentKey = $this->paymob->requestPaymentKey((int) $order['id'], $amount, [
            'email' => $request->input('email', 'guest@example.com'),
            'first_name' => $request->input('first_name', ''),
            'last_name' => $request->input('last_name', ''),
            'phone_number' => $request->input('phone', ''),
        ]);

        if (empty($paymentKey) || empty($paymentKey['token'])) {
            return response()->json(['error' => 'Failed to obtain payment key'], 500);
        }

        $iframe = $this->paymob->iframeUrl($paymentKey['token']);

        return response()->json([
            'order' => $order,
            'payment_key' => $paymentKey,
            'iframe_url' => $iframe,
        ]);
    }

    /**
     * Paymob callback endpoint.
     */
    public function callback(Request $request)
    {
        // Paymob will POST payment result here.
        // For now, just log and return 200. Implement verification/processing as needed.
        Log::info('Paymob callback', $request->all());

        return response('OK', 200);
    }

    /**
     * PayTab verification endpoint - validates the payment response signature
     */
    public function paytabVerify(Request $request)
    {
        // Get all POST data from PayTab
        $postValues = $request->all();

        // Validate the signature
        if (!$this->paytab->isValidRedirect($postValues)) {
            Log::warning('PayTab invalid signature', ['data' => $postValues]);
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Log successful verification
        Log::info('PayTab payment verified', ['data' => $postValues]);

        // Return the payment data for processing by the calling module
        return response()->json([
            'success' => true,
            'payment_data' => $postValues
        ]);
    }
}
