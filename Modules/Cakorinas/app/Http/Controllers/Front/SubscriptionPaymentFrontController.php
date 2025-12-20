<?php

namespace App\Modules\Cakorinas\app\Http\Controllers\Front;

use App\Http\Classes\Constants;
use App\Modules\Access\Http\Controllers\Front\AuthFrontController;

use App\Modules\Cakorinas\app\Http\Classes\TabbyService;
use Modules\Cakorinas\Requests\SubscriptionRequest;
use App\Modules\Cakorinas\app\Models\Member;

use App\Modules\Cakorinas\app\Models\MemberSubscription;
use App\Modules\Cakorinas\app\Models\MoneyBox;
use App\Modules\Cakorinas\app\Models\PaymentOnlineInvoice;
use App\Modules\Cakorinas\app\Models\PTClass;
use App\Modules\Cakorinas\app\Models\ReservationMember;
use App\Modules\Cakorinas\app\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nafezly\Payments\Classes\PaytabsPayment;
use App\Modules\Cakorinas\app\Interfaces\PaymentGatewayInterface;
use App\Modules\Cakorinas\app\Http\Controllers\Front\SubscriptionFrontController;
use Illuminate\Support\Facades\View;

class SubscriptionPaymentFrontController extends GenericFrontController
{

    public function success()
    {

        return view('payment-success');
    }
    public function failed()
    {

        return view('payment-failed');
    }


    public function show($id)
    {
        if (request()->hasSession()) {
            $sessionUser = request()->session()->get('user');
            if ($sessionUser) {
                // Ensure it's an object (in case it was stored as array)
                $this->current_user = is_array($sessionUser) ? (object) $sessionUser : $sessionUser;
                View::share('currentUser', $this->current_user);
            } else {
                $this->current_user = null;
            }
        } else {
            $this->current_user = null;
        }

//        $record = (array)$this->getSubscription($id, @$this->mainSettings['subscription']);
        $record = Subscription::where('id', $id)->first();
        $subscriptions = @Subscription::where('is_web', true)->get();
        $title = $record['name'];
        return view('cakorinas::Front.subscription_payment', compact('title', 'record', 'subscriptions'));
    }

    public function invoice($invoice_id)
    {
        $record = (array)$this->getInvoiceDetails((int)$invoice_id, @$this->current_user->id);
        $invoice = $record['invoice'];
        $qr_img_invoice = @$record['invoice']->qr_code;
        $title = trans('front.invoice');
        // if($record['success'] == false)
        //     return redirect()->route('home');
        return view('cakorinas::Front.invoice', compact('title', 'invoice', 'qr_img_invoice'));
    }

    public function getInvoiceDetails($invoice_id, $member_id){
        $invoice =  MemberSubscription::with(['subscription', 'member'])->where(['id' => $invoice_id, 'member_id' => $member_id])->first();
        return $invoice;
        /*
        $ch = curl_init();
        $certificate_location = "";
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $certificate_location);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $certificate_location);
        $options = array(
            CURLOPT_URL            => @env('APP_URL_MASTER')."api/member-subscription-invoice-info",
            CURLOPT_HTTPHEADER     => array(
                'Content-Type: application/json'
            ),
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode(array(
                'lang' => $this->lang,
                'invoice_id' => $invoice_id,
                'member_id' => $member_id,
            )),
            CURLOPT_RETURNTRANSFER => true
        );

        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return (@$result);
        */
    }
    public function reservationSubmit(SubscriptionRequest $request)
    {
        // :this process before payment
        // check on member info.
        // check on member ships
        // check on all complete data
        // redirect to payment gateway
        $member_data = [];
        $subscription_id = $request->subscription_id;
        $subscription = Subscription::where('id', $subscription_id)->first();
        if($subscription) {

            $member_data['name'] = @$request->name;
            $member_data['phone'] = @$request->phone;
            $member_data['subscription_id'] = @$request->subscription_id;
            $member_data['type'] = 0;
//            $member_data['amount'] = @$request->amount;
//            $member_data['vat_percentage'] = @$request->vat_percentage;
//            $member_data['vat'] = (@$request->vat_percentage / @$request->amount) * 100 ;
            ReservationMember::create($member_data);

        }
        return redirect()->back()->with('message', trans('front.success_msg'));
    }
    public function invoiceSubmit(SubscriptionRequest $request)
    {
        // :this process before payment
        // check on member info.
        // check on member ships
        // check on all complete data
        // redirect to payment gateway
        $member_data = [];
        $subscription_id = $request->subscription_id;
        $subscription = Subscription::where('id', $subscription_id)->first();

        if($subscription) {
            if (!@request()->session()->get('user')) {
                $member = Member::where('phone', @$request->phone)->first();
                if (@$member) {
                    \Session::flash('error', trans('front.error_member_exist'));
                    return redirect()->back();
                }

                $member_data['name'] = @$request->name;
                $member_data['phone'] = @$request->phone;
                $member_data['email'] = @$request->email;
                $member_data['address'] = @$request->address;
                $member_data['dob'] = @Carbon::parse($request->dob);
                $member_data['gender'] = @$request->gender;
            }else{
                $member_subscription = MemberSubscription::where('member_id', @request()->session()->get('user')->id)->orderBy('id', 'desc')->first();
                // if (@$member_subscription && (Carbon::parse($member_subscription->expire_date)->toDateString() > Carbon::now()->toDateString() )) {
                //     \Session::flash('error', trans('front.error_member_subscription_active'));
                //     return redirect()->back();
                // }

                $member_data['name'] = @request()->session()->get('user')->name;
                $member_data['phone'] = @request()->session()->get('user')->phone;
                $member_data['email'] = @request()->session()->get('user')->email;
                $member_data['address'] = @request()->session()->get('user')->address;
                $member_data['dob'] = @request()->session()->get('user')->dob;
                $member_data['gender'] = @request()->session()->get('user')->gender;
            }

            $member_data['subscription_id'] = @$request->subscription_id;
            $member_data['payment_method'] = @(int)$request->payment_method;
            $member_data['amount'] = @$request->amount;
            $member_data['vat_percentage'] = @$request->vat_percentage;
            $member_data['vat'] = (@$request->vat_percentage / 100) * @$request->amount;
            $member_data['start_date'] = @$request->start_date ? Carbon::parse($request->start_date) : Carbon::now();

            // Check if the selected start_date conflicts with existing subscriptions
            if (@request()->session()->get('user')) {
                $requested_start_date = $member_data['start_date'];
                $requested_end_date = $requested_start_date->copy()->addDays($subscription->period);

                // Check for overlapping subscriptions
                $overlapping_subscription = MemberSubscription::where('member_id', @request()->session()->get('user')->id)
                    ->where('status', Constants::Active)
                    ->where(function($query) use ($requested_start_date, $requested_end_date) {
                        // Check if new subscription overlaps with existing ones
                        $query->where(function($q) use ($requested_start_date, $requested_end_date) {
                            // New subscription starts during an existing subscription
                            $q->where('joining_date', '<=', $requested_start_date)
                              ->where('expire_date', '>=', $requested_start_date);
                        })->orWhere(function($q) use ($requested_start_date, $requested_end_date) {
                            // New subscription ends during an existing subscription
                            $q->where('joining_date', '<=', $requested_end_date)
                              ->where('expire_date', '>=', $requested_end_date);
                        })->orWhere(function($q) use ($requested_start_date, $requested_end_date) {
                            // New subscription completely contains an existing subscription
                            $q->where('joining_date', '>=', $requested_start_date)
                              ->where('expire_date', '<=', $requested_end_date);
                        });
                    })
                    ->first();

                if ($overlapping_subscription) {
                    \Session::flash('error', trans('front.error_subscription_date_overlap'));
                    return redirect()->back();
                }
            }

            // Use SubscriptionFrontController methods for payment processing
            $subscriptionController = new SubscriptionFrontController();

            // Cakorinas uses Paymob (Egypt - EGP currency)
            if(@(int)$request->payment_method == Constants::PAYMOB){
                // Use Paymob payment
                $payment_url = $subscriptionController->paymob_payment($subscription->toArray(), $member_data);
                return redirect($payment_url);
            } else {
                \Session::flash('error', trans('front.error_in_data'));
                return redirect()->back();
            }

            return redirect()->back();
        }
        \Session::flash('error', trans('front.error_in_data'));
        return redirect()->back();
    }



    /**
     * Generic payment return handler
     * This can be used as a return URL for various payment gateways
     */
    public function invoiceReturn(Request $request)
    {
        // Check if this is a Paymob callback
        if ($request->has('payment_id') || $request->has('id')) {
            return $this->paymobVerifyPayment($request);
        }

        // Default: redirect to error page
        return redirect()->route('error-payment');
    }

    /**
     * Paymob payment verification callback
     * This method is called by Paymob after payment processing
     */
    public function paymobVerifyPayment(Request $request)
    {
        // Use SubscriptionFrontController's paymob_payment_verify method
        $subscriptionController = new SubscriptionFrontController();
        return $subscriptionController->paymob_payment_verify($request);
    }

    public function error_payment(){
        $title = trans('front.invoice');
        return view('cakorinas::Front.error', compact('title'));
    }



    public static function amountAfter($amount, $amountBefore, $operation)
    {
        if ($operation == 0) {
            return ($amountBefore + $amount);
        } elseif ($operation == 1) {
            return ($amountBefore - $amount);
        } elseif ($operation == 2) {
            return ($amountBefore - $amount);
        }

        return $amount;
    }


}


