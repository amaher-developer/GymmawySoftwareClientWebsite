<?php

namespace App\Modules\Cakorinas\app\Http\Controllers\Front;

use App\Http\Classes\Constants;
use App\Modules\Cakorinas\app\Http\Controllers\Front\AuthFrontController as FrontAuthFrontController;
// Use new payment architecture
use Modules\Common\Factories\PaymentServiceFactory;
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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Nafezly\Payments\Classes\PaytabsPayment;
class SubscriptionFrontController extends GenericFrontController
{
    public function __construct()
    {
        return parent::__construct();
    }
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
        return view('cakorinas::Front.subscription', compact('title', 'record', 'subscriptions'));
    }

    public function showPTClass($id)
    {
//        $record = (array)$this->getSubscription($id, @$this->mainSettings['subscription']);
        $record = PTClass::where('id', $id)->first();
        $pt_classes = @PTClass::where('id', '!=', $id)->where('is_web', true)->get();
        $title = $record['title'];
        return view('cakorinas::Front.pt_class', compact('title', 'record','pt_classes'));
    }

    public function showTest($id)
    {
//        $record = (array)$this->getSubscription($id, @$this->mainSettings['subscription']);
        $record = Subscription::where('id', $id)->first();
        $subscriptions = @Subscription::where('is_web', true)->get();
        $title = $record['name'];
        return view('cakorinas::Front.subscription_test', compact('title', 'record', 'subscriptions'));
    }

    public function invoice($invoice_id)
    {
        $member_id = @request()->session()->get('user')->id;
        $record = $this->getInvoiceDetails((int)$invoice_id, (int)$member_id);
        $invoice = $record;
        $qr_img_invoice = null;
        $title = trans('front.invoice');
        if($record == null)
            return redirect()->route('home');

        View::share('currentUser', @request()->session()->get('user'));
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
    

    //paymob Step 3
    // Paymob payment using new payment architecture
    public function paymob_payment($subscription = [], $member = []){

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
            'start_date' => @$member['start_date'],
        ]);

        // Prepare order data for Paymob
        $orderData = [
            'amount' => @$subscription['price'],
            'currency' => 'EGP', // Cakorinas uses EGP (Egypt)
            'description' => @$subscription['content'] ?? 'Gym Subscription Payment',
            'order_id' => (string)$paymentOnlineInvoice->id,
            'customer' => [
                'name' => $member['name'],
                'email' => $member['email'] ?? 'guest@example.com',
                'phone' => $member['phone'],
            ],
            'items' => [
                [
                    'name' => $subscription['name'],
                    'description' => @$subscription['content'],
                    'amount_cents' => (int)(@$subscription['price'] * 100), // Paymob uses cents
                    'quantity' => 1,
                ]
            ],
            'return_url' => route('paymob-verify-payment', ['payment_id' => $unique_id]),
        ];
        // Use PaymentServiceFactory to get Paymob service
        $paymentService = PaymentServiceFactory::make('Cakorinas');
        $result = $paymentService->createPayment($orderData);

        if (!$result['success']) {
            \Session::flash('error', trans('front.error_in_data'));
            return route('subscription-payment', ['id' => $subscription['id']]);
        }

        // Update invoice with transaction ID
        $paymentOnlineInvoice->transaction_id = $result['transaction_id'];
        $paymentOnlineInvoice->save();

        return $result['payment_url'];
    }

  

    //paymob Step 4 : return callback
    // Paymob payment verification using new payment architecture
    public function paymob_payment_verify(Request $request)
    {
        // Log what Paymob sends for debugging
        //\Log::info('Paymob callback received', ['data' => $request->all()]);

        // Extract IDs from Paymob callback
        // Paymob sends: "id" (transaction_id) and "order" (order_id as string)
        $transaction_id = $request->input('id'); // Paymob transaction ID
        $order_id = $request->input('order'); // Paymob order ID (string, not array!)

        // Try to find payment invoice by transaction_id (Paymob transaction ID)
        $payment_invoice = PaymentOnlineInvoice::with(['subscription' => function($q){
            $q->withTrashed();
        }])->where('transaction_id', $transaction_id)->first();
        // Fallback: try by order_id if we stored it as transaction_id during payment creation
        if (!$payment_invoice && $order_id) {
            $payment_invoice = PaymentOnlineInvoice::with(['subscription' => function($q){
                $q->withTrashed();
            }])->where('transaction_id', $order_id)->first();
        }

        // Log what we found
        // \Log::info('Paymob - Payment invoice lookup', [
        //     'transaction_id' => $transaction_id,
        //     'order_id' => $order_id,
        //     'invoice_found' => $payment_invoice ? 'yes' : 'no',
        //     'invoice_id' => $payment_invoice ? $payment_invoice->id : null
        // ]);

        if($payment_invoice){
            // Use PaymentServiceFactory to get Paymob service
            $paymentService = PaymentServiceFactory::make('Cakorinas');

            // Verify payment with Paymob - pass all request data
            $verificationResult = $paymentService->verifyPayment($request->all());

            // Log verification result for debugging
            // \Log::info('Paymob verification result', [
            //     'success' => $verificationResult['success'] ?? false,
            //     'verified' => $verificationResult['verified'] ?? false,
            //     'transaction_id' => $verificationResult['transaction_id'] ?? null,
            //     'message' => $verificationResult['message'] ?? null,
            //     'error_occurred' => $verificationResult['error_occurred'] ?? false
            // ]);
            
            if(@$verificationResult['raw_data']  &&  (@$verificationResult['raw_data']['success'] == "true")){
                // Payment was successful
                $payment_invoice->status = Constants::SUCCESS;
                $payment_invoice->response_code = $verificationResult;
                $payment_invoice->save();

                // Add member and subscription to database
                $member = @request()->session()->get('user');
                $type_of_payment = Constants::RenewMember;
                if(!@request()->session()->get('user') && !@request()->session()->get('user')->id){
                    // Create new member
                    $maxId = str_pad((Member::withTrashed()->max('code')+1), 14, 0, STR_PAD_LEFT);
                    $member = Member::create([
                        'code' => $maxId,
                        'name' => $payment_invoice['name'],
                        'gender' => $payment_invoice['gender'],
                        'phone' => $payment_invoice['phone'],
                        'address' => $payment_invoice['address'],
                        'dob' => $payment_invoice['dob']
                    ]);
                    //$member = $member->toArray();
                    $type_of_payment = Constants::CreateMember;
                }
                if($member){
                    // Create member subscription
                    $start_date = @$payment_invoice['start_date'] ? Carbon::parse($payment_invoice['start_date']) : Carbon::now();
                    $member_subscription = MemberSubscription::create([
                        'subscription_id' => $payment_invoice['subscription_id'],
                        'member_id' => @$member->id,
                        'workouts' => @$payment_invoice['subscription']['workouts'],
                        'amount_paid' => @$payment_invoice['amount'],
                        'vat' => @$payment_invoice['vat'],
                        'vat_percentage' => @$payment_invoice['vat_percentage'],
                        'joining_date' => $start_date->toDateTimeString(),
                        'expire_date' => $start_date->copy()->addDays($payment_invoice['subscription']['period']),
                        'status' => Constants::Active,
                        'freeze_limit' => @$payment_invoice['subscription']['freeze_limit'],
                        'number_times_freeze' => @$payment_invoice['subscription']['number_times_freeze'],
                        'amount_before_discount' => @$payment_invoice['subscription']['price'],
                        'payment_type' => Constants::ONLINE_PAYMENT
                    ]);

                    $payment_invoice->member_subscription_id = @$member_subscription->id;
                    $payment_invoice->save();

                    // Update money box
                    $amount_box = MoneyBox::orderBy('id', 'desc')->first();
                    $amount_after = SubscriptionFrontController::amountAfter(@$amount_box->amount, @$amount_box->amount_before, (int)@$amount_box->operation);
                    $notes = trans('sw.member_moneybox_add_msg', [
                        'subscription' => @$payment_invoice->subscription->name,
                        'member' => @$member->name,
                        'amount_paid' => @$payment_invoice->amount,
                        'amount_remaining' => 0,
                    ]);

                    if(@$payment_invoice->vat_percentage){
                        $notes = $notes.' - '.trans('sw.vat_added');
                    }

                    MoneyBox::create([
                        'operation' => Constants::Add,
                        'amount' => @$payment_invoice->amount,
                        'vat' => @$payment_invoice['vat'],
                        'amount_before' => $amount_after,
                        'notes' => $notes,
                        'member_id' => @$member->id,
                        'type' => $type_of_payment,
                        'payment_type' => Constants::ONLINE_PAYMENT,
                        'member_subscription_id' => $payment_invoice['subscription_id'],
                        'online_subscription_id' => @$payment_invoice->id
                    ]);

                    if(!@request()->session()->get('user')->id){
                        $auth = new FrontAuthFrontController();
                        $user = $auth->getSubscriptionInfo($maxId, $member->phone);
                        request()->session()->put('user', $user->member);
                    }

                    return \redirect()->route('invoice', ['id' => @$member_subscription->id]);
                }
            } else {
                // Payment failed
                $payment_invoice->status = Constants::FAILED;
                $payment_invoice->response_code = $verificationResult;
                $payment_invoice->save();
            }
        }

        return \redirect()->route('error-payment', ['payment_id' => @$request['payment_id']]);
    }

    public function error_payment(){
        View::share('currentUser', @request()->session()->get('user'));

        $title = trans('front.invoice');
        return view('cakorinas::Front.error', compact('title'));
    }
    public function tabbyFailure(){
        $title = trans('front.invoice');
        return view('cakorinas::Front.tabby_error_failure', compact('title'));
    }
    public function tabbyCancel(){
        $title = trans('front.invoice');
        return view('cakorinas::Front.tabby_error_cancel', compact('title'));
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


