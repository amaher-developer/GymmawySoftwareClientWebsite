<?php

namespace App\Modules\Almadagym\app\Http\Controllers\Front;

use App\Http\Classes\Constants;
use App\Modules\Access\Http\Controllers\Front\AuthFrontController;

use App\Modules\Almadagym\app\Http\Classes\TabbyService;
use Modules\Almadagym\Requests\SubscriptionRequest;
use App\Modules\Almadagym\app\Models\Member;

use App\Modules\Almadagym\app\Models\MemberSubscription;
use App\Modules\Almadagym\app\Models\MoneyBox;
use App\Modules\Almadagym\app\Models\PaymentOnlineInvoice;
use App\Modules\Almadagym\app\Models\PTClass;
use App\Modules\Almadagym\app\Models\ReservationMember;
use App\Modules\Almadagym\app\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nafezly\Payments\Classes\PaytabsPayment;
use App\Modules\Almadagym\app\Interfaces\PaymentGatewayInterface;
use App\Modules\Almadagym\app\Http\Controllers\Front\SubscriptionFrontController;
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
//        $record = (array)$this->getSubscription($id, @$this->mainSettings['subscription']);
        $record = Subscription::where('id', $id)->first();
        $subscriptions = @Subscription::where('is_web', true)->get();
        $title = $record['name'];
        return view('almadagym::Front.subscription_payment', compact('title', 'record', 'subscriptions'));
    }

    public function invoice($invoice_id)
    {
        $record = (array)$this->getInvoiceDetails((int)$invoice_id, @$this->current_user->id);
        $invoice = $record['invoice'];
        $qr_img_invoice = @$record['invoice']->qr_code;
        $title = trans('front.invoice');
        if($record['success'] == false)
            return redirect()->route('home');
        return view('almadagym::Front.invoice', compact('title', 'invoice', 'qr_img_invoice'));
    }

    public function getInvoiceDetails($invoice_id, $member_id){
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
        $payment = new SubscriptionFrontController();
        $payment_data = [
            "amount_cents" => "4000",
            "currency" => "EGP",
            "shipping_data" => [
                "first_name" => "Test",
                "last_name"=> "Account",
                "phone_number"=> "0101010101010",
                "email"=> "test@account.com"
            ]
        ];
        $payment_url = $payment->paymentProcess($payment_data);
        dd($payment_url);
        // :this process before payment
        // check on member info.
        // check on member ships
        // check on all complete data
        // redirect to payment gateway
        $member_data = [];
        $subscription_id = $request->subscription_id;
        $subscription = Subscription::where('id', $subscription_id)->first();
        if($subscription) {
            if (!$this->current_user) {
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
                $member_subscription = MemberSubscription::where('member_id', @$this->current_user->id)->orderBy('id', 'desc')->first();
                if (@$member_subscription && (Carbon::parse($member_subscription->expire_date)->toDateString() > Carbon::now()->toDateString() )) {
                    \Session::flash('error', trans('front.error_member_subscription_active'));
                    return redirect()->back();
                }

                $member_data['name'] = @$this->current_user->name;
                $member_data['phone'] = @$this->current_user->phone;
                $member_data['email'] = @$this->current_user->email;
                $member_data['address'] = @$this->current_user->address;
                $member_data['dob'] = @$this->current_user->dob;
                $member_data['gender'] = @$this->current_user->gender;
            }

            $member_data['subscription_id'] = @$request->subscription_id;
            $member_data['payment_method'] = @$request->payment_method;
            $member_data['amount'] = @$request->amount;
            $member_data['vat_percentage'] = @$request->vat_percentage;
            $member_data['vat'] = (@$request->vat_percentage / @$request->amount) * 100 ;

            if(@$request->payment_method == Constants::MADA){
                // paytabs
                $payment = new SubscriptionFrontController();
                $payment_data = [
                    "amount_cents" => "4000",
                    "currency" => "EGP",
                    "shipping_data" => [
                                        "first_name" => "Test",
                                        "last_name"=> "Account",
                                        "phone_number"=> "0101010101010",
                                        "email"=> "test@account.com"
                                    ]
                    ];
                $payment_url = $payment->paymentProcess($payment_data);
            }
            return redirect($payment_url);
        }
        \Session::flash('error', trans('front.error_in_data'));
        return redirect()->back();
    }



    public function error_payment(){
        $title = trans('front.invoice');
        return view('almadagym::Front.error', compact('title'));
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


