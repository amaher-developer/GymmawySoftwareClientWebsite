<?php
namespace Modules\Premier\app\Http\Controllers\Front;

use App\Http\Classes\Constants;
use Modules\Premier\app\Http\Controllers\Front\AuthFrontController;
use Modules\Premier\app\Http\Controllers\Front\GenericFrontController;
use Modules\Premier\app\Http\Classes\TabbyService;
use Modules\Premier\app\Http\Classes\TamaraService;
use Modules\Premier\app\Http\Requests\SubscriptionRequest;
use Modules\Premier\Models\Member;

use Modules\Premier\Models\MemberSubscription;
use Modules\Premier\Models\MoneyBox;
use Modules\Premier\Models\PaymentOnlineInvoice;
use Modules\Premier\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Nafezly\Payments\Classes\PaytabsPayment;
use Illuminate\Support\Facades\View;


class SubscriptionFrontController extends GenericFrontController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function show($id)
    {
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        View::share('currentUser',$this->current_user);
//        $record = (array)$this->getSubscription($id, @$this->mainSettings['subscription']);
        $record = Subscription::where('id', $id)->first();

        if (!$record) {
            \Session::flash('error', trans('front.error_in_data'));
            return redirect()->route('home');
        }

        $subscriptions = @Subscription::where('is_web', true)->get();
        $title = $record['name'];
        return view('premier::Front.subscription', compact('title', 'record', 'subscriptions'));
    }

    public function showMobile($id)
    {
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        View::share('currentUser', $this->current_user);

        $record = Subscription::where('id', $id)->first();

        if (!$record) {
            return abort(404);
        }

        $title = $record['name'];
        return view('premier::Front.subscription_mobile', compact('title', 'record'));
    }

    public function invoice($invoice_id)
    {
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        View::share('currentUser',$this->current_user);

        $invoice = $this->getInvoiceDetails((int)$invoice_id, @$this->current_user->id);
        $title = trans('front.invoice');

        if(!$invoice) {
            return redirect()->route('home');
        }

        $qr_img_invoice = @$invoice->qr_code;
        return view('premier::Front.invoice', compact('title', 'invoice', 'qr_img_invoice'));
    }

    public function getInvoiceDetails($invoice_id, $member_id){
        $invoice =  MemberSubscription::with(['subscription', 'member'])->where(['id' => $invoice_id])->first();
        return $invoice;
    }

    public function invoiceSubmit(SubscriptionRequest $request)
    {
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        View::share('currentUser',$this->current_user);
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
//                $member_subscription = MemberSubscription::where('member_id', @$this->current_user->id)->orderBy('id', 'desc')->first();
//                if (@$member_subscription && (Carbon::parse($member_subscription->expire_date)->toDateString() > Carbon::now()->toDateString() )) {
//                    \Session::flash('error', trans('front.error_member_subscription_active'));
//                    return redirect()->back();
//                }
                $check_subscription = MemberSubscription::where('member_id', @$this->current_user->id)->where('joining_date', '<=',@$request->joining_date)
                    ->where('expire_date', '>=', @$request->joining_date)->first();
                if (@$check_subscription) {
                    \Session::flash('error', trans('front.error_member_subscription_joining_date'));
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
            $member_data['joining_date'] = @$request->joining_date;
            $member_data['payment_method'] = @$request->payment_method;
            $member_data['payment_channel'] = @$request->payment_channel;
            $member_data['amount'] = (float)(@$request->amount ?? 0);
            $member_data['vat_percentage'] = (float)(@$request->vat_percentage ?? 0);
            // Calculate VAT on the base price (amount is already VAT-inclusive from the form)
            $vatPct = (float)(@$request->vat_percentage ?? 0);
            if ($vatPct > 0) {
                $basePrice = (float)(@$request->amount ?? 0) / (1 + $vatPct / 100);
                $member_data['vat'] = round((float)(@$request->amount ?? 0) - $basePrice, 2);
            } else {
                $member_data['vat'] = 0;
            }

            if(@$request->payment_method == Constants::MADA){
                // paytabs
                $payment_url = $this->paytabs_payment($subscription->toArray(), $member_data);
            }else if(@$request->payment_method == Constants::TABBY){
                // tabby
                $payment_url = $this->tabby_payment($subscription->toArray(), $member_data);
            }else if(@$request->payment_method == Constants::TAMARA){
                // tamara
                $payment_url = $this->tamara_payment($subscription->toArray(), $member_data);
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
            'payment_method' => 7, // PAYTABS_TRANSACTION
            'payment_channel' => $member['payment_channel'],
            'payment_gateway' => Constants::MADA,
            'response_code' => ['joining_date' => $member['joining_date']],
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

    // tabby
    public function tabby_payment($subscription = [], $member = []){
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        
        $vatPercentage = @$this->mainSettings['vat_details']['vat_percentage'] ?? 0;
        $priceBeforeVat = $subscription['price'];
        $vatAmount = ($vatPercentage / 100) * $priceBeforeVat;

        // Use actual member dates for registered users, fallback to now for guests
        if (@$this->current_user && @$this->current_user->id) {
            $memberRecord = Member::find($this->current_user->id);
            $registered_since = $memberRecord && $memberRecord->created_at
                ? Carbon::parse($memberRecord->created_at)->toISOString()
                : Carbon::now()->toISOString();
            $updated_at = $memberRecord && $memberRecord->updated_at
                ? Carbon::parse($memberRecord->updated_at)->toISOString()
                : Carbon::now()->toISOString();
        } else {
            $registered_since = Carbon::now()->toISOString();
            $updated_at = Carbon::now()->toISOString();
        }
        $purchased_at = Carbon::now()->toISOString();
        $unique_id = uniqid();

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
            'amount' => round($member['amount'], 2),
            'vat' => $member['vat'],
            'vat_percentage' => $member['vat_percentage'],
            'payment_method' => 4, // TABBY_TRANSACTION
            'payment_channel' => $member['payment_channel'],
            'payment_gateway' => Constants::TABBY,
            'response_code' => ['joining_date' => $member['joining_date']],
        ]);



        // add first product
        $items = collect([]); // array to save your products
        $items->push([
            'title' => $subscription['name'],
            "description" => @$subscription['content'],
            'quantity' => 1,
            'unit_price' => $subscription['price'],
            'category' => 'Gym Membership',
        ]);

        // Build order_history from MemberSubscription (covers all payment methods)
        $orderHistory = [];
        $loyaltyLevel = 0;
        if (@$this->current_user && @$this->current_user->id) {
            // loyalty_level = number of successfully placed orders with any payment method
            $loyaltyLevel = MemberSubscription::where('member_id', $this->current_user->id)->count();

            // 5-10 previous orders from any payment method, current order excluded
            $previousSubscriptions = MemberSubscription::with(['member'])
                ->where('member_id', $this->current_user->id)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            $statusMap = [
                Constants::Active  => 'complete',
                Constants::Freeze  => 'processing',
                Constants::Expired => 'complete',
            ];

            foreach ($previousSubscriptions as $sub) {
                $orderHistory[] = [
                    'purchased_at' => Carbon::parse($sub->joining_date ?? $sub->created_at)->toISOString(),
                    'amount' => (string) round($sub->amount_paid, 2),
                    'status' => $statusMap[$sub->status] ?? 'unknown',
                    'buyer' => [
                        'phone' => $sub->member->phone ?? $member['phone'],
                        'email' => $sub->member->email ?? $member['email'],
                        'name' => $sub->member->name ?? $member['name'],
                    ],
                    'shipping_address' => [
                        'city' => env('TABBY_CITY', ''),
                        'address' => env('TABBY_ADDRESS', ''),
                        'zip' => env('TABBY_ZIP', ''),
                        'country' => env('TABBY_COUNTRY', 'SA'),
                    ],
                    'payment_method' => $sub->payment_type == Constants::ONLINE_PAYMENT ? 'card' : 'cod',
                ];
            }
        }

        $order_data = [
            'amount'=> round((@$subscription['price'] + $vatAmount), 2),
            'currency' => @env('TABBY_CURRENCY', 'SAR'),
            'description'=> @$subscription['content'],
            'full_name'=> $member['name'],
            'buyer_phone'=> $member['phone'],
            'buyer_email' => $member['email'] ?? '',
            'buyer_dob' => $member['dob'] ? Carbon::parse($member['dob'])->format('Y-m-d') : null,
            'status' => Constants::NEW, //"new" "processing" "complete" "refunded" "canceled" "unknown"
            'address'=> env('TABBY_ADDRESS', ''),
            'city' => env('TABBY_CITY', ''),
            'zip'=> env('TABBY_ZIP', ''),
            'country' => env('TABBY_COUNTRY', 'SA'),
            'order_id'=> (string) $paymentOnlineInvoice->id,
            'registered_since' => $registered_since,
            'updated_at' => $updated_at,
            'purchased_at' => $purchased_at,
            'loyalty_level'=> $loyaltyLevel,
            'success-url'=>  route('tabby-verify-payment', ['invoice_id' => $unique_id]),
            'cancel-url' => route('tabby-error-cancel', ['invoice_id' => $unique_id]),
            'failure-url' => route('tabby-error-failure', ['invoice_id' => $unique_id]),
            'items' => $items,
            'order_history' => $orderHistory,
        ];
        // step 1: create session
        $payment = new TabbyService();
        $payment = $payment->createSession($order_data);
        $status = @$payment->status;

        $errorRoute = @$member['payment_channel'] == 3
            ? route('subscription-mobile', ['id' => $subscription['id']])
            : route('subscription', ['id' => $subscription['id']]);

        if($status == Constants::REJECTED){
            \Session::flash('error', trans('front.'.@$payment->configuration->products->installments->rejection_reason));
            return $errorRoute;
        }

//        $id = $payment->payment->id;
        $redirect_url = @$payment->configuration->available_products->installments[0]->web_url;

        if(!$redirect_url){
            \Session::flash('error', trans('front.error_in_data'));
            return $errorRoute;
        }

        $paymentOnlineInvoice->transaction_id = @$payment->payment->id;
        $payment = @(array)$payment;
        $payment['joining_date'] = $member['joining_date'];
        $paymentOnlineInvoice->response_code = $payment;
        $paymentOnlineInvoice->save();


        return $redirect_url;
    }

    public function tabbyNotify(Request $request)
    {
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        
        Log::info('Tabby webhook received', $request->all());

        $tabbyPaymentId = $request->id ?? null;
        $paymentStatus  = $request->status ?? null;

        if (empty($tabbyPaymentId) || empty($paymentStatus)) {
            Log::error('Invalid Tabby webhook payload');
            return response()->json(['status' => 'invalid_payload'], 400);
        }

        // 1️⃣ Find invoice using Tabby payment.id
        $paymentInvoice = PaymentOnlineInvoice::with(['subscription' => function ($q) {
            $q->withTrashed();
        }])->where('transaction_id', $tabbyPaymentId)->first();

        if (!$paymentInvoice) {
            Log::error('Invoice not found for Tabby payment', [
                'tabby_payment_id' => $tabbyPaymentId
            ]);
            return response()->json(['status' => 'invoice_not_found'], 404);
        }

        // 2️⃣ Idempotency — already processed
        if ($paymentInvoice->status === Constants::SUCCESS) {
            Log::info('Webhook ignored — already processed', [
                'invoice_id' => $paymentInvoice->id
            ]);
            return response()->json(['status' => 'already_processed'], 200);
        }

        /**
         * ─────────────────────────────
         * HANDLE EVENTS
         * ─────────────────────────────
         */

        // ❌ Failed / Cancelled
        if (in_array(strtolower($paymentStatus), ['rejected', 'expired'])) {

            $paymentInvoice->status = Constants::FAILED;
            $paymentInvoice->response_code = array_merge(
                (array) $paymentInvoice->response_code,
                ['tabby_webhook' => $request->all()]
            );
            $paymentInvoice->save();

            return response()->json(['status' => 'payment_failed'], 200);
        }

        // 🟡 Ignore anything not AUTHORIZED
        // Note: Tabby webhook sends status in lowercase ("authorized")
        if (strtoupper($paymentStatus) !== Constants::AUTHORIZED) {
            return response()->json(['status' => 'ignored'], 200);
        }

        /**
         * ─────────────────────────────
         * AUTHORIZED → RETRIEVE → VERIFY → CAPTURE → FINALIZE
         * ─────────────────────────────
         */

        // Acquire application-level advisory lock so that a concurrent browser-redirect
        // (tabby_payment_verify → finalizeTabbyCheckout) cannot create a duplicate
        // member/subscription while this webhook is processing the same invoice.
        // Works regardless of DB storage engine (InnoDB or MyISAM).
        $lockKey = 'tabby_finalize_' . $paymentInvoice->id;
        DB::selectOne("SELECT GET_LOCK(?, 30) as locked", [$lockKey]);

        DB::beginTransaction();

        try {
            // Re-fetch invoice with exclusive row lock — prevents concurrent webhooks from
            // all passing the idempotency check and creating duplicate records.
            $paymentInvoice = PaymentOnlineInvoice::with(['subscription' => function ($q) {
                $q->withTrashed();
            }])->where('transaction_id', $tabbyPaymentId)->lockForUpdate()->first();

            // Re-check inside the lock — a concurrent webhook may have committed already.
            if ($paymentInvoice->status === Constants::SUCCESS) {
                DB::commit();
                Log::info('Webhook ignored — already processed (concurrent)', [
                    'invoice_id' => $paymentInvoice->id
                ]);
                return response()->json(['status' => 'already_processed'], 200);
            }

            $tabbyService = new TabbyService();
            $capture = null;

            // 3️⃣ Retrieve payment to verify status
            $retrievedPayment = $tabbyService->getPayment($tabbyPaymentId);

            if (!$retrievedPayment || !in_array($retrievedPayment->status, [Constants::AUTHORIZED, Constants::CLOSED])) {
                Log::error('Tabby payment status verification failed', [
                    'tabby_payment_id' => $tabbyPaymentId,
                    'expected_status' => 'AUTHORIZED or CLOSED',
                    'actual_status' => $retrievedPayment->status ?? 'unknown',
                ]);
                throw new \Exception('Tabby payment not in AUTHORIZED or CLOSED status after retrieval');
            }

            // 4️⃣ Capture (only if not already closed by a previous attempt)
            if ($retrievedPayment->status === Constants::AUTHORIZED) {
                $capture = $tabbyService->capturePayment(
                    $tabbyPaymentId,
                    (string) $paymentInvoice->amount
                );

                if (!$capture || $capture->status !== Constants::CLOSED) {
                    throw new \Exception('Tabby capture failed');
                }
            }

            // 5️⃣ Resolve Member
            $member = null;
            $typeOfPayment = Constants::RenewMember;

            if ($paymentInvoice->member_id) {
                $member = Member::find($paymentInvoice->member_id);
            }

            // Fallback: look up by phone to avoid creating a duplicate member.
            if (!$member && $paymentInvoice->phone) {
                $member = Member::where('phone', $paymentInvoice->phone)->first();
            }

            if (!$member) {
                $maxId = str_pad((Member::withTrashed()->max('code') + 1), 14, 0, STR_PAD_LEFT);
                $member = Member::create([
                    'code'    => $maxId,
                    'name'    => $paymentInvoice->name,
                    'gender'  => $paymentInvoice->gender,
                    'phone'   => $paymentInvoice->phone,
                    'address' => $paymentInvoice->address,
                    'dob'     => $paymentInvoice->dob,
                ]);
                $typeOfPayment = Constants::CreateMember;
            }

            // 5️⃣ Create Member Subscription
            $joiningDate = Carbon::parse(
                $paymentInvoice->response_code['joining_date'] ?? now()
            );

            $memberSubscription = MemberSubscription::create([
                'subscription_id' => $paymentInvoice->subscription_id,
                'member_id'       => $member->id,
                'workouts'        => $paymentInvoice->subscription->workouts,
                'amount_paid'     => $paymentInvoice->amount,
                'vat'             => $paymentInvoice->vat,
                'vat_percentage'  => $paymentInvoice->vat_percentage,
                'joining_date'    => $joiningDate,
                'expire_date'     => $joiningDate->copy()->addDays(
                    (int) $paymentInvoice->subscription->period
                ),
                'status'          => Constants::Active,
                'freeze_limit'    => $paymentInvoice->subscription->freeze_limit,
                'number_times_freeze' => $paymentInvoice->subscription->number_times_freeze,
                'amount_before_discount' => $paymentInvoice->subscription->price,
                'payment_type'    => Constants::ONLINE_PAYMENT,
            ]);

            // 6️⃣ Update invoice
            $paymentInvoice->status = Constants::SUCCESS;
            $paymentInvoice->member_subscription_id = $memberSubscription->id;
            $paymentInvoice->response_code = array_merge(
                (array) $paymentInvoice->response_code,
                [
                    'tabby_webhook' => $request->all(),
                    'tabby_capture' => (array) $capture,
                ]
            );
            $paymentInvoice->save();

            // 7️⃣ MoneyBox
            $amountBox = MoneyBox::latest()->first();
            $amountAfter = SubscriptionFrontController::amountAfter(
                $amountBox->amount,
                $amountBox->amount_before,
                (int) $amountBox->operation
            );

            $notes = trans('sw.member_moneybox_add_msg', [
                'subscription' => $paymentInvoice->subscription->name,
                'member'       => $member->name,
                'amount_paid'  => $paymentInvoice->amount,
                'amount_remaining' => 0,
            ]);

            if ($paymentInvoice->vat_percentage) {
                $notes .= ' - ' . trans('sw.vat_added');
            }

            MoneyBox::create([
                'operation' => Constants::Add,
                'amount' => $paymentInvoice->amount,
                'vat' => $paymentInvoice->vat,
                'amount_before' => $amountAfter,
                'notes' => $notes,
                'member_id' => $member->id,
                'type' => $typeOfPayment,
                'payment_type' => Constants::ONLINE_PAYMENT,
                'member_subscription_id' => $memberSubscription->id,
                'online_subscription_id' => $paymentInvoice->id,
            ]);

            DB::commit();

            return response()->json(['status' => 'success'], 200);

        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Tabby webhook failed', [
                'error' => $e->getMessage(),
                'tabby_payment_id' => $tabbyPaymentId
            ]);

            return response()->json(['status' => 'error'], 500);
        } finally {
            DB::selectOne("SELECT RELEASE_LOCK(?)", [$lockKey]);
        }
    }


    public function tabby_payment_verify(Request $request)
    {
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        
        $invoiceId = $request->invoice_id;      // internal id
        $tabbyPaymentId = $request->payment_id; // Tabby payment.id

        // 1️⃣ Get invoice
        $paymentInvoice = PaymentOnlineInvoice::with(['subscription' => function ($q) {
            $q->withTrashed();
        }])->where('payment_id', $invoiceId)->first();

        if (!$paymentInvoice) {
            Log::error('Invoice not found', compact('invoiceId'));
            return redirect()->route('error-payment', ['payment_id' => $invoiceId]);
        }

        // Already processed
        if ($paymentInvoice->member_subscription_id) {
            return redirect()->route('invoice', [
                'id' => $paymentInvoice->member_subscription_id
            ]);
        }

        // 2️⃣ Validate Tabby payment id consistency
        if ($paymentInvoice->transaction_id !== $tabbyPaymentId) {
            Log::warning('Tabby payment id mismatch', [
                'invoice_id' => $invoiceId,
                'db_payment_id' => $paymentInvoice->transaction_id,
                'url_payment_id' => $tabbyPaymentId,
            ]);
        }

        $joiningDate = $paymentInvoice->response_code['joining_date']
            ?? Carbon::now()->toDateString();

        $tabbyService = new TabbyService();

        // 3️⃣ Get payment status from Tabby (with retry for CREATED→AUTHORIZED timing gap)
        $payment = null;
        $maxRetries = 5;
        for ($attempt = 0; $attempt < $maxRetries; $attempt++) {
            $payment = $tabbyService->getPayment($tabbyPaymentId);

            Log::info('Tabby payment status', [
                'tabby_payment_id' => $tabbyPaymentId,
                'status' => $payment->status ?? null,
                'attempt' => $attempt + 1,
            ]);

            if (!$payment) {
                break;
            }

            // If still CREATED, wait briefly and retry (Tabby may not have authorized yet)
            if ($payment->status === Constants::CREATED && $attempt < $maxRetries - 1) {
                sleep(2);
                continue;
            }

            break;
        }

        if (!$payment) {
            $paymentInvoice->status = Constants::FAILED;
            $paymentInvoice->save();

            \Session::flash('error', trans('front.error_in_data'));
            return redirect()->route('subscription', [
                'id' => $paymentInvoice->subscription_id
            ]);
        }

        /**
         * ─────────────────────────────
         * STATUS HANDLING (IMPORTANT)
         * ─────────────────────────────
         * CREATED     → user still in checkout → wait
         * AUTHORIZED  → capture now
         * CLOSED      → already captured → success
         */

        // 🟡 Still processing after retries (authorization not yet received)
        // Webhook will capture this payment once Tabby authorizes it
        if ($payment->status === Constants::CREATED) {
            Log::info('Tabby payment still CREATED after retries, deferring to webhook', [
                'tabby_payment_id' => $tabbyPaymentId,
                'invoice_id' => $invoiceId,
            ]);
            \Session::flash('info', trans('front.payment_processing'));
            return redirect()->route('subscription', [
                'id' => $paymentInvoice->subscription_id
            ]);
        }

        // 🟢 Capture if authorized
        if ($payment->status === Constants::AUTHORIZED) {

            $capture = $tabbyService->capturePayment(
                $tabbyPaymentId,
                (string) $paymentInvoice->amount
            );

            Log::info('Tabby capture response', (array) $capture);

            if (!$capture || $capture->status !== Constants::CLOSED) {
                $paymentInvoice->status = Constants::FAILED;
                $paymentInvoice->response_code = array_merge(
                    (array) $paymentInvoice->response_code,
                    [
                        'tabby_payment' => (array) $payment,
                        'tabby_capture' => (array) $capture,
                    ]
                );
                $paymentInvoice->save();

                \Session::flash('error', trans('front.error_in_data'));
                return redirect()->route('subscription', [
                    'id' => $paymentInvoice->subscription_id
                ]);
            }
        } elseif ($payment->status !== Constants::CLOSED) {
            // Any other status (REJECTED, EXPIRED, etc.) is a failure
            $paymentInvoice->status = Constants::FAILED;
            $paymentInvoice->response_code = array_merge(
                (array) $paymentInvoice->response_code,
                ['tabby_payment' => (array) $payment]
            );
            $paymentInvoice->save();

            \Session::flash('error', trans('front.error_in_data'));
            return redirect()->route('subscription', [
                'id' => $paymentInvoice->subscription_id
            ]);
        }

        // ✅ CLOSED (either captured now or already captured)
        $paymentInvoice->status = Constants::SUCCESS;
        $paymentInvoice->response_code = array_merge(
            (array) $paymentInvoice->response_code,
            ['tabby_payment' => (array) $payment]
        );
        $paymentInvoice->save();

        // 4️⃣ Finalize subscription
        $memberSubscription = $this->finalizeTabbyCheckout(
            $paymentInvoice,
            $joiningDate,
            $this->current_user,
            true
        );

        if ($memberSubscription) {
            return redirect()->route('invoice', [
                'id' => $memberSubscription->id
            ]);
        }

        // fallback (rare)
        $paymentInvoice->status = Constants::FAILED;
        $paymentInvoice->save();

        return redirect()->route('error-payment', [
            'payment_id' => $invoiceId
        ]);
    }




    public function error_payment(){
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        View::share('currentUser',$this->current_user);

        $title = trans('front.invoice');
        return view('premier::Front.error', compact('title'));
    }
    public function tabbyFailure(Request $request){
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        View::share('currentUser',$this->current_user);

        // Look up the invoice to redirect back to checkout
        $invoiceId = $request->invoice_id ?? $request->route('payment');
        if ($invoiceId) {
            $invoice = PaymentOnlineInvoice::where('payment_id', $invoiceId)->first();
            if ($invoice) {
                $invoice->status = Constants::FAILED;
                $invoice->save();

                \Session::flash('error', trans('front.tabby_error_failure_body_msg'));
                $redirectRoute = @$invoice->payment_channel == 3
                    ? route('subscription-mobile', ['id' => $invoice->subscription_id])
                    : route('subscription', ['id' => $invoice->subscription_id]);
                return redirect($redirectRoute);
            }
        }

        $title = trans('front.invoice');
        return view('premier::Front.tabby_error_failure', compact('title'));
    }
    public function tabbyCancel(Request $request){
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        View::share('currentUser',$this->current_user);

        // Look up the invoice to redirect back to checkout
        $invoiceId = $request->invoice_id ?? $request->route('payment');
        if ($invoiceId) {
            $invoice = PaymentOnlineInvoice::where('payment_id', $invoiceId)->first();
            if ($invoice) {
                \Session::flash('error', trans('front.tabby_error_cancel_body_msg'));
                $redirectRoute = @$invoice->payment_channel == 3
                    ? route('subscription-mobile', ['id' => $invoice->subscription_id])
                    : route('subscription', ['id' => $invoice->subscription_id]);
                return redirect($redirectRoute);
            }
        }

        $title = trans('front.invoice');
        return view('premier::Front.tabby_error_cancel', compact('title'));
    }

    // tamara
    public function tamara_payment($subscription = [], $member = [])
    {
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;

        $vatPercentage = @$this->mainSettings['vat_details']['vat_percentage'] ?? 0;
        $priceBeforeVat = $subscription['price'];
        $vatAmount = ($vatPercentage / 100) * $priceBeforeVat;
        $unique_id = uniqid();

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
            'amount' => round($member['amount'], 2),
            'vat' => $member['vat'],
            'vat_percentage' => $member['vat_percentage'],
            'payment_method' => 6, // TAMARA_TRANSACTION
            'payment_channel' => $member['payment_channel'],
            'payment_gateway' => Constants::TAMARA,
            'response_code' => ['joining_date' => $member['joining_date']],
        ]);

        $items = collect([]);
        $items->push([
            'title' => $subscription['name'],
            'description' => @$subscription['content'],
            'quantity' => 1,
            'unit_price' => $subscription['price'],
            'total_amount' => round((@$subscription['price'] + $vatAmount), 2),
            'reference_id' => (string) $paymentOnlineInvoice->id,
        ]);

        $order_data = [
            'amount' => round((@$subscription['price'] + $vatAmount), 2),
            'currency' => @env('TAMARA_CURRENCY', 'SAR'),
            'description' => @$subscription['content'],
            'full_name' => $member['name'],
            'buyer_phone' => $member['phone'],
            'buyer_email' => $member['email'] ?? '',
            'address' => @env('TAMARA_ADDRESS', ''),
            'city' => @env('TAMARA_CITY', 'Riyadh'),
            'order_id' => $paymentOnlineInvoice->id,
            'success-url' => route('tamara-verify-payment', ['invoice_id' => $unique_id]),
            'cancel-url' => route('tamara-error-cancel', ['invoice_id' => $unique_id]),
            'failure-url' => route('tamara-error-failure', ['invoice_id' => $unique_id]),
            'notification-url' => route('api.tamara-notify'),
            'items' => $items->toArray(),
        ];

        $payment = new TamaraService();
        $response = $payment->createCheckout($order_data);

        if (!@$response->checkout_url) {
            \Session::flash('error', trans('front.error_in_data'));
            return @$member['payment_channel'] == 3
                ? route('subscription-mobile', ['id' => $subscription['id']])
                : route('subscription', ['id' => $subscription['id']]);
        }

        $paymentOnlineInvoice->transaction_id = @$response->order_id;
        $responseArray = @(array)$response;
        $responseArray['joining_date'] = $member['joining_date'];
        $paymentOnlineInvoice->response_code = $responseArray;
        $paymentOnlineInvoice->save();

        return $response->checkout_url;
    }

    public function tamara_payment_verify(Request $request)
    {
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;

        $invoiceId = $request->invoice_id;
        $paymentStatus = $request->paymentStatus;
        $orderId = $request->orderId;

        $paymentInvoice = PaymentOnlineInvoice::with(['subscription' => function ($q) {
            $q->withTrashed();
        }])->where('payment_id', $invoiceId)->first();

        if (!$paymentInvoice) {
            Log::error('Invoice not found for Tamara payment', compact('invoiceId'));
            return redirect()->route('error-payment', ['payment_id' => $invoiceId]);
        }

        // Already processed
        if ($paymentInvoice->member_subscription_id) {
            return redirect()->route('invoice', [
                'id' => $paymentInvoice->member_subscription_id
            ]);
        }

        $joiningDate = $paymentInvoice->response_code['joining_date']
            ?? Carbon::now()->toDateString();

        // Check redirect status
        if ($paymentStatus !== 'approved') {
            $paymentInvoice->status = Constants::FAILED;
            $paymentInvoice->response_code = array_merge(
                (array) $paymentInvoice->response_code,
                ['tamara_redirect_status' => $paymentStatus]
            );
            $paymentInvoice->save();

            \Session::flash('error', trans('front.error_in_data'));
            return redirect()->route('subscription', [
                'id' => $paymentInvoice->subscription_id
            ]);
        }

        $tamaraService = new TamaraService();
        $tamaraOrderId = $paymentInvoice->transaction_id;

        // Step 1: Authorise the order (required by Tamara after approval)
        $authorise = $tamaraService->authoriseOrder($tamaraOrderId);
        $authoriseStatus = @$authorise->status;
        $autoCaptured = @$authorise->auto_captured ?? false;

        Log::info('Tamara authorise response', [
            'tamara_order_id' => $tamaraOrderId,
            'status' => $authoriseStatus,
            'auto_captured' => $autoCaptured,
        ]);

        $capture = null;

        // If auto-capture is enabled, status will be fully_captured directly
        if ($authoriseStatus === 'fully_captured' || $autoCaptured) {
            // Already captured via auto-capture — no separate capture needed
        } elseif ($authoriseStatus === 'authorised') {
            // Step 2: Capture the payment to complete the transaction
            $capture = $tamaraService->capturePayment(
                $tamaraOrderId,
                (string) $paymentInvoice->amount,
                [['title' => @$paymentInvoice->subscription->name, 'quantity' => 1, 'unit_price' => $paymentInvoice->amount, 'total_amount' => $paymentInvoice->amount, 'reference_id' => (string)$paymentInvoice->id]]
            );

            Log::info('Tamara capture response', (array) $capture);

            // Capture succeeds if capture_id is returned or status indicates captured
            if (!$capture || (!@$capture->capture_id && !in_array(@$capture->status, ['fully_captured', 'partially_captured']))) {
                $paymentInvoice->status = Constants::FAILED;
                $paymentInvoice->response_code = array_merge(
                    (array) $paymentInvoice->response_code,
                    ['tamara_authorise' => (array) $authorise, 'tamara_capture' => (array) $capture]
                );
                $paymentInvoice->save();

                \Session::flash('error', trans('front.error_in_data'));
                return redirect()->route('subscription', [
                    'id' => $paymentInvoice->subscription_id
                ]);
            }
        } else {
            // Authorisation failed
            $paymentInvoice->status = Constants::FAILED;
            $paymentInvoice->response_code = array_merge(
                (array) $paymentInvoice->response_code,
                ['tamara_authorise' => (array) $authorise]
            );
            $paymentInvoice->save();

            \Session::flash('error', trans('front.error_in_data'));
            return redirect()->route('subscription', [
                'id' => $paymentInvoice->subscription_id
            ]);
        }

        // Success — finalize
        $paymentInvoice->status = Constants::SUCCESS;
        $paymentInvoice->response_code = array_merge(
            (array) $paymentInvoice->response_code,
            [
                'tamara_authorise' => (array) $authorise,
                'tamara_capture' => (array) $capture,
            ]
        );
        $paymentInvoice->save();

        $memberSubscription = $this->finalizeTabbyCheckout(
            $paymentInvoice,
            $joiningDate,
            $this->current_user,
            true
        );

        if ($memberSubscription) {
            return redirect()->route('invoice', [
                'id' => $memberSubscription->id
            ]);
        }

        // Fallback
        $paymentInvoice->status = Constants::FAILED;
        $paymentInvoice->save();

        return redirect()->route('error-payment', [
            'payment_id' => $invoiceId
        ]);
    }

    public function tamaraNotify(Request $request)
    {
        Log::info('Tamara webhook received', $request->all());

        // Verify Tamara JWT token (HS256) using Notification Key
        $notificationKey = env('TAMARA_NOTIFICATION_TOKEN');
        if ($notificationKey) {
            $tamaraToken = $request->query('tamaraToken')
                ?? str_replace('Bearer ', '', $request->header('Authorization', ''));

            if (!$tamaraToken || !$this->verifyTamaraToken($tamaraToken, $notificationKey)) {
                Log::error('Tamara webhook token verification failed', [
                    'token' => $tamaraToken ? substr($tamaraToken, 0, 20) . '...' : 'empty',
                ]);
                return response()->json(['status' => 'unauthorized'], 401);
            }
        }

        // Tamara sends "order_status" (e.g. "approved") at the root of the payload.
        $orderId     = $request->order_id ?? null;
        $orderStatus = $request->order_status ?? null;

        if (!$orderId || !$orderStatus) {
            Log::error('Invalid Tamara webhook payload', $request->all());
            return response()->json(['status' => 'invalid_payload'], 400);
        }

        $paymentInvoice = PaymentOnlineInvoice::with(['subscription' => function ($q) {
            $q->withTrashed();
        }])->where('transaction_id', $orderId)->first();

        if (!$paymentInvoice) {
            Log::error('Invoice not found for Tamara order', [
                'tamara_order_id' => $orderId
            ]);
            return response()->json(['status' => 'invoice_not_found'], 404);
        }

        // Idempotency — already processed
        if ($paymentInvoice->status === Constants::SUCCESS) {
            Log::info('Tamara webhook ignored — already processed', [
                'invoice_id' => $paymentInvoice->id
            ]);
            return response()->json(['status' => 'already_processed'], 200);
        }

        // Handle declined / expired / canceled
        if (in_array($orderStatus, ['declined', 'canceled', 'expired'])) {
            $paymentInvoice->status = Constants::FAILED;
            $paymentInvoice->response_code = array_merge(
                (array) $paymentInvoice->response_code,
                ['tamara_webhook' => $request->all()]
            );
            $paymentInvoice->save();

            return response()->json(['status' => 'payment_failed'], 200);
        }

        // Only process approved orders
        if ($orderStatus !== 'approved') {
            return response()->json(['status' => 'ignored'], 200);
        }

        DB::beginTransaction();

        try {
            $tamaraService = new TamaraService();

            // Step 1: Authorise order — confirms receipt of approved notification
            $authorise = $tamaraService->authoriseOrder($orderId);
            $authoriseStatus = @$authorise->status;
            $autoCaptured = @$authorise->auto_captured ?? false;

            Log::info('Tamara webhook authorise response', [
                'tamara_order_id' => $orderId,
                'status' => $authoriseStatus,
                'auto_captured' => $autoCaptured,
            ]);

            $capture = null;

            if ($authoriseStatus === 'fully_captured' || $autoCaptured) {
                // Auto-captured — no separate capture needed
            } elseif ($authoriseStatus === 'authorised') {
                // Step 2: Capture payment to complete the transaction
                $capture = $tamaraService->capturePayment(
                    $orderId,
                    (string) $paymentInvoice->amount,
                    [['title' => @$paymentInvoice->subscription->name, 'quantity' => 1, 'unit_price' => $paymentInvoice->amount, 'total_amount' => $paymentInvoice->amount, 'reference_id' => (string)$paymentInvoice->id]]
                );

                Log::info('Tamara webhook capture response', [
                    'tamara_order_id' => $orderId,
                    'capture' => (array) $capture,
                ]);

                // Capture succeeds if capture_id is returned or status indicates captured
                if (!$capture || (!@$capture->capture_id && !in_array(@$capture->status, ['fully_captured', 'partially_captured']))) {
                    throw new \Exception('Tamara capture failed: ' . json_encode($capture));
                }
            } else {
                throw new \Exception('Tamara authorise returned unexpected status: ' . $authoriseStatus);
            }

            // Resolve Member
            $member = null;
            $typeOfPayment = Constants::RenewMember;

            if ($paymentInvoice->member_id) {
                $member = Member::find($paymentInvoice->member_id);
            }

            if (!$member) {
                $maxId = str_pad((Member::withTrashed()->max('code') + 1), 14, 0, STR_PAD_LEFT);
                $member = Member::create([
                    'code'    => $maxId,
                    'name'    => $paymentInvoice->name,
                    'gender'  => $paymentInvoice->gender,
                    'phone'   => $paymentInvoice->phone,
                    'address' => $paymentInvoice->address,
                    'dob'     => $paymentInvoice->dob,
                ]);
                $typeOfPayment = Constants::CreateMember;
            }

            $joiningDate = Carbon::parse(
                $paymentInvoice->response_code['joining_date'] ?? now()
            );

            $memberSubscription = MemberSubscription::create([
                'subscription_id' => $paymentInvoice->subscription_id,
                'member_id'       => $member->id,
                'workouts'        => $paymentInvoice->subscription->workouts,
                'amount_paid'     => $paymentInvoice->amount,
                'vat'             => $paymentInvoice->vat,
                'vat_percentage'  => $paymentInvoice->vat_percentage,
                'joining_date'    => $joiningDate,
                'expire_date'     => $joiningDate->copy()->addDays(
                    $paymentInvoice->subscription->period
                ),
                'status'          => Constants::Active,
                'freeze_limit'    => $paymentInvoice->subscription->freeze_limit,
                'number_times_freeze' => $paymentInvoice->subscription->number_times_freeze,
                'amount_before_discount' => $paymentInvoice->subscription->price,
                'payment_type'    => Constants::ONLINE_PAYMENT,
            ]);

            $paymentInvoice->status = Constants::SUCCESS;
            $paymentInvoice->member_subscription_id = $memberSubscription->id;
            $paymentInvoice->response_code = array_merge(
                (array) $paymentInvoice->response_code,
                [
                    'tamara_webhook' => $request->all(),
                    'tamara_authorise' => (array) $authorise,
                    'tamara_capture' => (array) $capture,
                ]
            );
            $paymentInvoice->save();

            $this->createMoneyBoxEntry($paymentInvoice, $member, $typeOfPayment);

            DB::commit();

            Log::info('Tamara webhook processed successfully', [
                'tamara_order_id' => $orderId,
                'invoice_id' => $paymentInvoice->id,
                'member_subscription_id' => $memberSubscription->id,
            ]);

            return response()->json(['status' => 'success'], 200);

        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Tamara webhook failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'tamara_order_id' => $orderId,
            ]);

            return response()->json(['status' => 'error'], 500);
        }
    }

    public function tamaraFailure(){
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        View::share('currentUser',$this->current_user);

        $title = trans('front.invoice');
        return view('premier::Front.tamara_error_failure', compact('title'));
    }

    public function tamaraCancel(){
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        View::share('currentUser',$this->current_user);

        $title = trans('front.invoice');
        return view('premier::Front.tamara_error_cancel', compact('title'));
    }

    public function tamaraRefund(Request $request, $invoiceId)
    {
        $paymentInvoice = PaymentOnlineInvoice::where('id', $invoiceId)
            ->where('payment_gateway', Constants::TAMARA)
            ->where('status', Constants::SUCCESS)
            ->first();

        if (!$paymentInvoice) {
            return response()->json(['status' => 'error', 'message' => 'Invoice not found or not eligible for refund'], 404);
        }

        $amount = $request->input('amount', $paymentInvoice->amount);
        $comment = $request->input('comment', '');

        $tamaraService = new TamaraService();
        $refund = $tamaraService->refundOrder($paymentInvoice->transaction_id, $amount, $comment);

        if ($refund && in_array(@$refund->status, ['fully_refunded', 'partially_refunded'])) {
            $paymentInvoice->response_code = array_merge(
                (array) $paymentInvoice->response_code,
                ['tamara_refund' => (array) $refund]
            );
            $paymentInvoice->save();

            return response()->json([
                'status' => 'success',
                'refund_id' => @$refund->refund_id,
                'refund_status' => @$refund->status,
            ]);
        }

        Log::error('Tamara refund failed', [
            'invoice_id' => $invoiceId,
            'response' => (array) $refund,
        ]);

        return response()->json([
            'status' => 'error',
            'message' => 'Refund request failed',
            'details' => (array) $refund,
        ], 422);
    }

    /**
     * Verify Tamara webhook JWT token using HS256 algorithm.
     */
    protected function verifyTamaraToken(string $token, string $secret): bool
    {
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            return false;
        }

        [$headerB64, $payloadB64, $signatureB64] = $parts;

        $signature = $this->base64UrlDecode($signatureB64);
        $expectedSignature = hash_hmac('sha256', "$headerB64.$payloadB64", $secret, true);

        return hash_equals($expectedSignature, $signature);
    }

    protected function base64UrlDecode(string $data): string
    {
        $remainder = strlen($data) % 4;
        if ($remainder) {
            $data .= str_repeat('=', 4 - $remainder);
        }
        return base64_decode(strtr($data, '-_', '+/'));
    }

    protected function finalizeTabbyCheckout(PaymentOnlineInvoice $invoice, string $joiningDate, $sessionMember = null, bool $loginNewMember = true): ?MemberSubscription
    {
        $subscription = $invoice->subscription ?? Subscription::withTrashed()->find($invoice->subscription_id);

        if (!$subscription) {
            Log::error('Subscription missing on Tabby finalize', ['invoice_id' => $invoice->id]);
            return null;
        }

        // Acquire the same advisory lock used by tabbyNotify — guarantees that only one
        // of (webhook / browser-redirect) can enter the finalization section at a time.
        $lockKey = 'tabby_finalize_' . $invoice->id;
        DB::selectOne("SELECT GET_LOCK(?, 30) as locked", [$lockKey]);

        try {
        $result = DB::transaction(function () use ($invoice, $joiningDate, $sessionMember, $subscription) {
            // Re-read with exclusive row lock — prevents duplicate processing when both
            // the webhook (tabbyNotify) and the browser redirect (tabby_payment_verify)
            // run simultaneously with a stale invoice object.
            $invoice = PaymentOnlineInvoice::where('id', $invoice->id)->lockForUpdate()->first();

            // Re-check inside the lock with fresh data.
            if ($invoice->member_subscription_id) {
                return ['memberSubscription' => MemberSubscription::find($invoice->member_subscription_id), 'early' => true];
            }

            $member = ($sessionMember && @$sessionMember->id) ? $sessionMember : null;

            if (!$member && $invoice->member_id) {
                $member = Member::find($invoice->member_id);
            }

            // Fallback: look up by phone to avoid creating a duplicate member.
            if (!$member && $invoice->phone) {
                $member = Member::where('phone', $invoice->phone)->first();
            }

            $type = Constants::RenewMember;
            $generatedCode = null;

            if (!$member) {
                $generatedCode = str_pad(((int)Member::withTrashed()->max('code') + 1), 14, 0, STR_PAD_LEFT);
                $member = Member::create([
                    'code' => $generatedCode,
                    'name' => $invoice->name,
                    'gender' => $invoice->gender,
                    'phone' => $invoice->phone,
                    'address' => $invoice->address,
                    'dob' => $invoice->dob,
                ]);
                $type = Constants::CreateMember;
            }

            $joining = Carbon::parse($joiningDate);
            $periodDays = (int)($subscription->period ?? 0);
            $expire = (clone $joining)->addDays(max($periodDays, 0));

            $memberSubscription = MemberSubscription::create([
                'subscription_id' => $invoice->subscription_id,
                'member_id' => $member->id,
                'workouts' => $subscription->workouts ?? null,
                'amount_paid' => $invoice->amount,
                'vat' => $invoice->vat,
                'vat_percentage' => $invoice->vat_percentage,
                'joining_date' => $joining->toDateTimeString(),
                'expire_date' => $expire->toDateTimeString(),
                'status' => Constants::Active,
                'freeze_limit' => $subscription->freeze_limit ?? null,
                'number_times_freeze' => $subscription->number_times_freeze ?? null,
                'amount_before_discount' => $subscription->price ?? null,
                'payment_type' => Constants::ONLINE_PAYMENT,
            ]);

            $invoice->member_subscription_id = $memberSubscription->id;
            $invoice->status = Constants::SUCCESS;
            $invoice->save();

            $this->createMoneyBoxEntry($invoice, $member, $type);

            return [
                'memberSubscription' => $memberSubscription,
                'member' => $member,
                'type' => $type,
                'generatedCode' => $generatedCode,
            ];
        });

        if (!$result) {
            return null;
        }

        // Skip login for early-return path (already processed by concurrent webhook).
        if (empty($result['early']) && @$result['generatedCode'] && @$result['member']->phone) {
            $this->loginMemberAfterOnlinePayment($result['generatedCode'], $result['member']->phone);
        }
        return $result['memberSubscription'];
        } finally {
            DB::selectOne("SELECT RELEASE_LOCK(?)", [$lockKey]);
        }
    }

    protected function createMoneyBoxEntry(PaymentOnlineInvoice $invoice, Member $member, int $type): void
    {
        $amountBox = MoneyBox::orderBy('id', 'desc')->first();
        $amountBefore = $amountBox ? $amountBox->amount_before : 0;
        $operation = $amountBox ? (int)$amountBox->operation : 0;
        $amountAfter = self::amountAfter($invoice->amount, $amountBefore, $operation);

        $notes = trans('sw.member_moneybox_add_msg', [
            'subscription' => optional($invoice->subscription)->name,
            'member' => $member->name,
            'amount_paid' => $invoice->amount,
            'amount_remaining' => 0,
        ]);

        if ($invoice->vat_percentage) {
            $notes .= ' - ' . trans('sw.vat_added');
        }

        MoneyBox::create([
            'operation' => Constants::Add,
            'amount' => $invoice->amount,
            'vat' => $invoice->vat,
            'amount_before' => $amountAfter,
            'notes' => $notes,
            'member_id' => $member->id,
            'type' => $type,
            'payment_type' => Constants::ONLINE_PAYMENT,
            'member_subscription_id' => $invoice->member_subscription_id,
            'online_subscription_id' => $invoice->id,
        ]);
    }

    protected function loginMemberAfterOnlinePayment(string $code, string $phone): void
    {
        //try {
            $auth = new AuthFrontController();
            $user = $auth->getSubscriptionInfo($code, $phone);
            if (isset($user->member)) {
                request()->session()->put('user', $user->member);
            }
        //} catch (\Throwable $throwable) {
            //Log::warning('Auto login after Tabby payment failed', ['error' => $throwable->getMessage()]);
        //}
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


    public function tabbyRegisterWebhook()
    {
        $tabbyService = new TabbyService();
        $result = $tabbyService->createWebHooks();

        return response()->json([
            'message' => 'Webhook registration attempt completed',
            'result' => $result,
        ]);
    }

    public function tabbyCheckWebhooks()
    {
        $tabbyService = new TabbyService();
        $result = $tabbyService->getWebHooks();

        return response()->json([
            'message' => 'Current registered webhooks',
            'result' => $result,
        ]);
    }



}
