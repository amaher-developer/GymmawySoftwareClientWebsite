<?php

namespace App\Modules\Sixtyminutes\app\Http\Controllers\Front;

use App\Http\Classes\Constants;
use App\Modules\Access\Http\Controllers\Front\AuthFrontController;

// Use new payment architecture
use Modules\Common\Factories\PaymentServiceFactory;
use Modules\Sixtyminutes\Requests\SubscriptionRequest;
use App\Modules\Sixtyminutes\app\Models\Member;

use App\Modules\Sixtyminutes\app\Models\MemberSubscription;
use App\Modules\Sixtyminutes\app\Models\MoneyBox;
use App\Modules\Sixtyminutes\app\Models\PaymentOnlineInvoice;
use App\Modules\Sixtyminutes\app\Models\PTClass;
use App\Modules\Sixtyminutes\app\Models\ReservationMember;
use App\Modules\Sixtyminutes\app\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nafezly\Payments\Classes\PaytabsPayment;
class SubscriptionFrontController extends GenericFrontController
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
        return view('sixtyminutes::Front.subscription', compact('title', 'record', 'subscriptions'));
    }

    public function showPTClass($id)
    {
//        $record = (array)$this->getSubscription($id, @$this->mainSettings['subscription']);
        $record = PTClass::where('id', $id)->first();
        $pt_classes = @PTClass::where('id', '!=', $id)->where('is_web', true)->get();
        $title = $record['title'];
        return view('sixtyminutes::Front.pt_class', compact('title', 'record','pt_classes'));
    }

    public function showTest($id)
    {
//        $record = (array)$this->getSubscription($id, @$this->mainSettings['subscription']);
        $record = Subscription::where('id', $id)->first();
        $subscriptions = @Subscription::where('is_web', true)->get();
        $title = $record['name'];
        return view('sixtyminutes::Front.subscription_test', compact('title', 'record', 'subscriptions'));
    }

    public function invoice($invoice_id)
    {
        $record = (array)$this->getInvoiceDetails((int)$invoice_id, @$this->current_user->id);
        $invoice = $record['invoice'];
        $qr_img_invoice = @$record['invoice']->qr_code;
        $title = trans('front.invoice');
        if($record['success'] == false)
            return redirect()->route('home');
        return view('sixtyminutes::Front.invoice', compact('title', 'invoice', 'qr_img_invoice'));
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
                $payment_url = $this->paytabs_payment($subscription->toArray(), $member_data);
            }else if(@$request->payment_method == Constants::TABBY){
                // tabby
                $payment_url = $this->tabby_payment($subscription->toArray(), $member_data);
            }
            return redirect($payment_url);
        }
        \Session::flash('error', trans('front.error_in_data'));
        return redirect()->back();
    }

    // paytabs
    public function paytabs_payment($subscription = [], $member = []){

        $payment = new PaytabsPayment();
        $payment = $payment->pay(@$subscription['price'],
            2,
            @$member['name'],
            "",
            @$member['email'],
            @$member['phone'],
            $source = null);

        PaymentOnlineInvoice::create([
            'payment_id' => $payment['payment_id'],
            'transaction_id' => $payment['tran_ref'],
            'member_id' => @$this->current_user->id,
            'status' => @Constants::PEND,
            'subscription_id' => @$member['subscription_id'],
            'name' => $member['name'],
            'email' => $member['email'],
            'phone' => $member['phone'],
            'dob' => $member['dob'],
            'address' => $member['address'],
            'gender' => $member['gender'],
            'amount' => $member['amount'],
            'vat' => $member['vat'],
            'vat_percentage' => $member['vat_percentage'],
            'payment_method' => $member['payment_method'],
        ]);

        return $payment['redirect_url'];
    }

    public function payment_verify(Request $request)
    {
        $payment = new PaytabsPayment();
        $payment_invoice = PaymentOnlineInvoice::with(['subscription' => function($q){
            $q->withTrashed();
        }])->where('payment_id', $request['payment_id'])->first();

        if($payment_invoice){
            $request['tran_ref'] = $payment_invoice->transaction_id;
            $payment = $payment->verify($request);
            if($payment['success']) $payment_invoice->status = Constants::SUCCESS; else $payment_invoice->status = Constants::FAILED;
            $payment_invoice->response_code = $payment['process_data'];
            $payment_invoice->save();

            if($payment['success']){
                // add member and subscription to database and active it
                $member = @(array)$this->current_user;
                $type_of_payment = Constants::RenewMember;
                if(!@$this->current_user->id){
                    // must generate code and make user id nullable
                    $maxId = str_pad((Member::withTrashed()->max('code')+1), 14, 0, STR_PAD_LEFT);
                    $member = Member::create(['code' => $maxId, 'name' => $payment_invoice['name'], 'gender' => $payment_invoice['gender'], 'phone' =>  $payment_invoice['phone'], 'address' =>  $payment_invoice['address'] ,'dob' =>  $payment_invoice['dob']]);
                    $type_of_payment = Constants::CreateMember;
                }

                if($member){
                    $member_subscription =  MemberSubscription::create(['subscription_id' => $payment_invoice['subscription_id'], 'member_id' => $member['id'], 'workouts' => @$payment_invoice['subscription']['workouts'],
                        'amount_paid' => @$payment_invoice['amount'], 'vat' => @$payment_invoice['vat'], 'vat_percentage' => @$payment_invoice['vat_percentage'],
                        'joining_date' => Carbon::now()->toDateTimeString(), 'expire_date' => Carbon::now()->addDays($payment_invoice['subscription']['period']), 'status' => Constants::Active, 'freeze_limit' =>  @$payment_invoice['subscription']['freeze_limit'], 'number_times_freeze' => @$payment_invoice['subscription']['number_times_freeze'], 'amount_before_discount' => @$payment_invoice['subscription']['price'], 'payment_type' => Constants::ONLINE_PAYMENT]);

                    $payment_invoice->member_subscription_id = @$member_subscription->id;
                    $payment_invoice->save();

                    $amount_box = MoneyBox::first();
                    $amount_after = SubscriptionFrontController::amountAfter( @$amount_box->amount, @$amount_box->amount_before, (int)@$amount_box->operation);
                    $notes = trans('sw.member_moneybox_add_msg',
                        [
                            'subscription' => @$payment_invoice->subscription->name,
                            'member' => @$member['name'],
                            'amount_paid' => @$payment_invoice->amount,
                            'amount_remaining' => 0,
                        ]);

                    if(@$payment_invoice->vat_percentage){
                        $notes = $notes.' - '.trans('sw.vat_added');
                    }

                    MoneyBox::create(['operation' => Constants::Add, 'amount' => @$payment_invoice->amount, 'vat' => @$payment_invoice['vat'], 'amount_before' => $amount_after, 'notes' => $notes, 'member_id' => $member['id'], 'type' => $type_of_payment, 'payment_type' => Constants::ONLINE_PAYMENT, 'member_subscription_id' => $payment_invoice['subscription_id'], 'online_subscription_id' => @$payment_invoice->id]);

                    if(!@$this->current_user->id){
                        $auth = new AuthFrontController();
                        $user = $auth->getSubscriptionInfo($maxId, $member['phone']);
                        request()->session()->put('user', $user->member);
                    }
                    return \redirect()->route('invoice', ['id' => @$member_subscription->id]);
                }
            }
        }

        // :this process after payment successfully
        // send member info. to system
        // send membership info. to system

        // redirect to infocie
        return \redirect()->route('error-payment', ['payment_id' => @$request['payment_id']]);
    }

    // tabby - Updated to use new payment architecture
    public function tabby_payment($subscription = [], $member = []){

        $unique_id = uniqid();

        // Create payment invoice record
        $paymentOnlineInvoice = PaymentOnlineInvoice::create([
            'payment_id' => $unique_id,
            'member_id' => @$this->current_user->id,
            'status' => @Constants::PEND,
            'subscription_id' => @$member['subscription_id'],
            'name' => $member['name'],
            'email' => $member['email'],
            'phone' => $member['phone'],
            'dob' => $member['dob'],
            'address' => $member['address'],
            'gender' => $member['gender'],
            'amount' => $member['amount'],
            'vat' => $member['vat'],
            'vat_percentage' => $member['vat_percentage'],
            'payment_method' => $member['payment_method'],
        ]);

        // Prepare order data for new payment service
        $orderData = [
            'amount' => (float) $subscription['price'],
            'currency' => env('TABBY_CURRENCY', 'SAR'),
            'order_id' => 'SIXTYMIN_' . $paymentOnlineInvoice->id . '_' . time(),
            'description' => $subscription['content'] ?? 'Gym Subscription',
            'customer' => [
                'name' => $member['name'],
                'email' => $member['email'] ?? 'member@sixtyminutes.com',
                'phone' => $member['phone'],
                'registered_since' => Carbon::now()->subMonths(1)->toIso8601String(),
                'loyalty_level' => 0,
            ],
            'return_url' => route('tabby-verify-payment', ['payment_id' => $unique_id]),
            'cancel_url' => route('tabby-error-cancel', ['payment_id' => $unique_id]),
            'failure_url' => route('tabby-error-failure', ['payment_id' => $unique_id]),
            'lang' => $this->lang ?? 'en',
            'items' => [
                [
                    'title' => $subscription['name'],
                    'description' => $subscription['content'] ?? '',
                    'quantity' => 1,
                    'unit_price' => (string) $subscription['price'],
                    'category' => 'Membership',
                ]
            ],
            'metadata' => [
                'payment_invoice_id' => $paymentOnlineInvoice->id,
                'subscription_id' => $member['subscription_id'],
                'member_id' => @$this->current_user->id,
            ],
        ];

        // Use new payment service
        try {
            $paymentService = PaymentServiceFactory::make('Sixtyminutes');
            $result = $paymentService->createPayment($orderData);

            if (!$result['success'] || empty($result['payment_url'])) {
                \Session::flash('error', $result['message'] ?? trans('front.error_in_data'));
                return route('subscription', ['id' => $subscription['id']]);
            }

            // Store transaction ID
            $paymentOnlineInvoice->transaction_id = $result['transaction_id'];
            $paymentOnlineInvoice->response_code = json_encode($result);
            $paymentOnlineInvoice->save();

            return $result['payment_url'];

        } catch (\Exception $e) {
            \Log::error('Tabby payment creation failed', [
                'error' => $e->getMessage(),
                'subscription' => $subscription,
            ]);
            \Session::flash('error', trans('front.error_in_data'));
            return route('subscription', ['id' => $subscription['id']]);
        }
    }

    public function tabbyNotify(Request $request){

        // Use new payment service to verify payment
        try {
            $paymentService = PaymentServiceFactory::make('Sixtyminutes');
            $verifyResult = $paymentService->verifyPayment($request->all());

            if (!$verifyResult['verified']) {
                \Log::warning('Tabby payment verification failed', $verifyResult);
                return response()->json(['success' => false], 400);
            }

            $payment_invoice = PaymentOnlineInvoice::with(['subscription' => function($q){
                $q->withTrashed();
            }])->where('transaction_id', $verifyResult['transaction_id'])->first();

            if (!$payment_invoice) {
                \Log::error('Payment invoice not found', ['transaction_id' => $verifyResult['transaction_id']]);
                return response()->json(['success' => false], 404);
            }

            $member = [];
            // Check if payment is successful (AUTHORIZED or CLOSED status)
            if($verifyResult['success'] && in_array($verifyResult['status'], ['success', 'authorized', 'closed'])){

            // add member and subscription to database and active it
            if(@$payment_invoice['member_id']){
                $member = Member::where('id', $payment_invoice['member_id'])->first();
            }

            $type_of_payment = Constants::RenewMember;
            $maxId = str_pad((Member::withTrashed()->max('code')+1), 14, 0, STR_PAD_LEFT);

            if(!@$member && !@$member['id']){
                // must generate code and make user id nullable
                $member = Member::create(['code' => $maxId, 'name' => $payment_invoice['name'], 'gender' => $payment_invoice['gender'], 'phone' =>  $payment_invoice['phone'], 'address' =>  $payment_invoice['address'] ,'dob' =>  $payment_invoice['dob']]);
                $member = $member->toArray();
                $type_of_payment = Constants::CreateMember;
            }


            // Payment already verified by the new service
            // Tabby payments are automatically captured when authorized

            if($member){

                $member_subscription =  MemberSubscription::create(['subscription_id' => $payment_invoice['subscription_id'], 'member_id' => $member['id'], 'workouts' => @$payment_invoice['subscription']['workouts'],
                    'amount_paid' => @$payment_invoice['amount'], 'vat' => @$payment_invoice['vat'], 'vat_percentage' => @$payment_invoice['vat_percentage'],
                    'joining_date' => Carbon::now()->toDateTimeString(), 'expire_date' => Carbon::now()->addDays($payment_invoice['subscription']['period']), 'status' => Constants::Active, 'freeze_limit' =>  @$payment_invoice['subscription']['freeze_limit'], 'number_times_freeze' => @$payment_invoice['subscription']['number_times_freeze'], 'amount_before_discount' => @$payment_invoice['subscription']['price'], 'payment_type' => Constants::ONLINE_PAYMENT]);

                $payment_invoice->member_subscription_id = @$member_subscription->id;
                $payment_invoice->save();

                $amount_box = MoneyBox::orderBy('id', 'desc')->first();
                $amount_after = SubscriptionFrontController::amountAfter( @$amount_box->amount, @$amount_box->amount_before, (int)@$amount_box->operation);
                $notes = trans('sw.member_moneybox_add_msg',
                    [
                        'subscription' => @$payment_invoice['subscription']->name,
                        'member' => @$member['name'],
                        'amount_paid' => @$payment_invoice['amount'],
                        'amount_remaining' => 0,
                    ]);
                if(@$payment_invoice['vat_percentage']){
                    $notes = $notes.' - '.trans('sw.vat_added');
                }

                MoneyBox::create(['operation' => Constants::Add, 'amount' => @$payment_invoice['amount'], 'vat' => @$payment_invoice['vat'], 'amount_before' => $amount_after, 'notes' => $notes, 'member_id' => $member['id'], 'type' => $type_of_payment, 'payment_type' => Constants::ONLINE_PAYMENT, 'member_subscription_id' => $payment_invoice['subscription_id'], 'online_subscription_id' => @$payment_invoice['id']]);


                mail('eng.a7med.ma7er@gmail.com', 'fitnessstep', 'test successfull member: '. $member['name']);

                // Update payment invoice status
                $payment_invoice->status = Constants::SUCCESS;
                $payment_invoice->save();

                return response()->json(['success' => true], 200);
            }

            return response()->json(['success' => false, 'message' => 'Member creation failed'], 400);
        }

        return response()->json(['success' => false, 'message' => 'Payment not authorized'], 400);

        } catch (\Exception $e) {
            \Log::error('Tabby payment notification failed', [
                'error' => $e->getMessage(),
                'request' => $request->all(),
            ]);
            return response()->json(['success' => false, 'message' => 'Processing failed'], 500);
        }
    }

    public function tabby_payment_verify(Request $request)
    {
        // Use new payment service
        $payment_invoice = PaymentOnlineInvoice::with(['subscription' => function($q){
            $q->withTrashed();
        }])->where('payment_id', $request['payment_id'])->first();

        if($payment_invoice){
            try {
                // Use new payment service to get payment status
                $paymentService = PaymentServiceFactory::make('Sixtyminutes');
                $statusResult = $paymentService->getPaymentStatus($payment_invoice->transaction_id);

                $payment_invoice->response_code = json_encode($statusResult);
                $payment_invoice->save();

                // Check if payment is successful
                if($statusResult['success'] && in_array($statusResult['status'], ['success', 'authorized', 'closed'])){
                // add member and subscription to database and active it
                $member = @(array)$this->current_user;
                $type_of_payment = Constants::RenewMember;
                if(!@$member->id){
                    // must generate code and make user id nullable
                    $maxId = str_pad((Member::withTrashed()->max('code')+1), 14, 0, STR_PAD_LEFT);
                    $member = Member::create(['code' => $maxId, 'name' => $payment_invoice['name'], 'gender' => $payment_invoice['gender'], 'phone' =>  $payment_invoice['phone'], 'address' =>  $payment_invoice['address'] ,'dob' =>  $payment_invoice['dob']]);
                    $member = $member->toArray();
                    $type_of_payment = Constants::CreateMember;
                }


                // Payment is already authorized/captured via the new service

                if($member){

                    $payment_invoice->status = Constants::SUCCESS;
                    $payment_invoice->save();

                    $member_subscription =  MemberSubscription::create(['subscription_id' => $payment_invoice['subscription_id'], 'member_id' => $member['id'], 'workouts' => @$payment_invoice['subscription']['workouts'],
                        'amount_paid' => @$payment_invoice['amount'], 'vat' => @$payment_invoice['vat'], 'vat_percentage' => @$payment_invoice['vat_percentage'],
                        'joining_date' => Carbon::now()->toDateTimeString(), 'expire_date' => Carbon::now()->addDays($payment_invoice['subscription']['period']), 'status' => Constants::Active, 'freeze_limit' =>  @$payment_invoice['subscription']['freeze_limit'], 'number_times_freeze' => @$payment_invoice['subscription']['number_times_freeze'], 'amount_before_discount' => @$payment_invoice['subscription']['price'], 'payment_type' => Constants::ONLINE_PAYMENT]);

                    $payment_invoice->member_subscription_id = @$member_subscription->id;
                    $payment_invoice->save();

                    $amount_box = MoneyBox::orderBy('id', 'desc')->first();
                    $amount_after = SubscriptionFrontController::amountAfter( @$amount_box->amount, @$amount_box->amount_before, (int)@$amount_box->operation);
                    $notes = trans('sw.member_moneybox_add_msg',
                        [
                            'subscription' => @$payment_invoice->subscription->name,
                            'member' => @$member['name'],
                            'amount_paid' => @$payment_invoice->amount,
                            'amount_remaining' => 0,
                        ]);
                    if(@$payment_invoice->vat_percentage){
                        $notes = $notes.' - '.trans('sw.vat_added');
                    }

                    MoneyBox::create(['operation' => Constants::Add, 'amount' => @$payment_invoice->amount, 'vat' => @$payment_invoice['vat'], 'amount_before' => $amount_after, 'notes' => $notes, 'member_id' => $member['id'], 'type' => $type_of_payment, 'payment_type' => Constants::ONLINE_PAYMENT, 'member_subscription_id' => $payment_invoice['subscription_id'], 'online_subscription_id' => @$payment_invoice->id]);

                    if(!@$this->current_user->id){
                        $auth = new AuthFrontController();
                        $user = $auth->getSubscriptionInfo($maxId, $member['phone']);
                        request()->session()->put('user', $user->member);
                    }
                    return \redirect()->route('invoice', ['id' => @$member_subscription->id]);
                }
            }

            } catch (\Exception $e) {
                \Log::error('Tabby payment verification failed', [
                    'error' => $e->getMessage(),
                    'payment_id' => $request['payment_id'],
                ]);
            }
        }

        // :this process after payment successfully
        // send member info. to system
        // send membership info. to system

        // redirect to invoice
        return \redirect()->route('error-payment', ['payment_id' => @$request['payment_id']]);
    }

    public function error_payment(){
        $title = trans('front.invoice');
        return view('sixtyminutes::Front.error', compact('title'));
    }
    public function tabbyFailure(){
        $title = trans('front.invoice');
        return view('sixtyminutes::Front.tabby_error_failure', compact('title'));
    }
    public function tabbyCancel(){
        $title = trans('front.invoice');
        return view('sixtyminutes::Front.tabby_error_cancel', compact('title'));
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
