<?php
namespace Modules\Stepfitness\app\Http\Controllers\Front;

use App\Http\Classes\Constants;
use Modules\Access\Http\Controllers\Front\AuthFrontController;
use Modules\Stepfitness\app\Http\Controllers\Front\GenericFrontController;
use Modules\Stepfitness\app\Http\Classes\TabbyService;
use Modules\Stepfitness\app\Http\Requests\SubscriptionRequest;
use Modules\Stepfitness\Models\Member;

use Modules\Stepfitness\Models\MemberSubscription;
use Modules\Stepfitness\Models\MoneyBox;
use Modules\Stepfitness\Models\PaymentOnlineInvoice;
use Modules\Stepfitness\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Nafezly\Payments\Classes\PaytabsPayment;

class SubscriptionFrontController extends GenericFrontController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function show($id)
    {
//        $record = (array)$this->getSubscription($id, @$this->mainSettings['subscription']);
        $record = Subscription::where('id', $id)->first();
        $subscriptions = @Subscription::where('is_web', true)->get();
        $title = $record['name'];
        return view('stepfitness::Front.subscription', compact('title', 'record', 'subscriptions'));
    }

    public function showTest($id)
    {
//        $record = (array)$this->getSubscription($id, @$this->mainSettings['subscription']);
        $record = Subscription::where('id', $id)->first();
        $subscriptions = @Subscription::where('is_web', true)->get();
        $title = $record['name'];
        return view('stepfitness::Front.subscription_test', compact('title', 'record', 'subscriptions'));
    }

    public function invoice($invoice_id)
    {
        $record = (array)$this->getInvoiceDetails((int)$invoice_id, @$this->current_user->id);
        $invoice = $record['invoice'];
        $qr_img_invoice = @$record['invoice']->qr_code;
        $title = trans('front.invoice');
        if($record['success'] == false)
            return redirect()->route('home');
        return view('stepfitness::Front.invoice', compact('title', 'invoice', 'qr_img_invoice'));
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
            $member_data['amount'] = @$request->amount;
            $member_data['vat_percentage'] = @$request->vat_percentage;
            $member_data['vat'] = (@$request->vat_percentage / 100) * @$request->amount ;

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


        $registered_since = Carbon::now()->toISOString();
        $updated_at = Carbon::now()->toISOString();
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
            'amount' => $member['amount'],
            'vat' => $member['vat'],
            'vat_percentage' => $member['vat_percentage'],
            'payment_method' => $member['payment_method'],
            'response_code' => ['joining_date' => $member['joining_date']],
        ]);



        // add first product
        $items = collect([]); // array to save your products
        $items->push([
            'title' => $subscription['name'],
            "description" => @$subscription['content'],
            'quantity' => 1,
            'unit_price' => $subscription['price'],
            'category' => 'Membership',
        ]);
        $order_data = [
            'amount'=> @$subscription['price'],
            'currency' => @env('TABBY_CURRENCY', 'SAR'),
            'description'=> @$subscription['content'],
            'full_name'=> $member['name'],
            'buyer_phone'=> $member['phone'],
            'buyer_email' => $member['email'] ?? '',
            'status' => Constants::NEW, //"new" "processing" "complete" "refunded" "canceled" "unknown"
//            'dob' => Carbon::parse($member['dob'])->toDateString(),
            'address'=> @env('TABBY_ADDRESS'),
            'city' => @env('TABBY_CITY'),
            'zip'=> '1234',
            'order_id'=> '"'.$paymentOnlineInvoice->id.'"',
            'registered_since' => $registered_since,
            'updated_at' => $updated_at,
            'purchased_at' => $purchased_at,
            'loyalty_level'=> 0,
            'success-url'=>  route('tabby-verify-payment', ['payment_id' => $unique_id]),
            'cancel-url' => route('tabby-error-cancel', ['payment_id' => $unique_id]),
            'failure-url' => route('tabby-error-failure', ['payment_id' => $unique_id]),
            'items' => $items,
        ];

        // step 1: create session
        $payment = new TabbyService();
        $payment = $payment->createSession($order_data);
        $status = @$payment->status;

        if($status == Constants::REJECTED){
            \Session::flash('error', trans('front.'.@$payment->configuration->products->installments->rejection_reason));
            return route('subscription', ['id' => $subscription['id']]);
        }


//        $id = $payment->payment->id;
        $redirect_url = @$payment->configuration->available_products->installments[0]->web_url;

        if(!$redirect_url){
            \Session::flash('error', trans('front.error_in_data'));
            return route('subscription', ['id' => $subscription['id']]);
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
        $service = new TabbyService();
        $payment = $service->getPayment(@$request->id);

        if (!$payment) {
            Log::warning('Tabby notify received empty payment payload', ['request_id' => $request->id]);
            return false;
        }

        $payment_invoice = PaymentOnlineInvoice::with(['subscription' => function ($q) {
            $q->withTrashed();
        }])->where('transaction_id', @$payment->id)->first();

        if (!$payment_invoice) {
            Log::warning('Tabby notify missing invoice', ['tabby_id' => $payment->id]);
            return false;
        }

        if ($payment_invoice->member_subscription_id) {
            return true;
        }

        if (!in_array($payment->status, [Constants::AUTHORIZED, Constants::CLOSED])) {
            $payment_invoice->status = Constants::FAILED;
            $payment_invoice->response_code = array_merge((array)$payment_invoice->response_code, [
                'tabby_payment' => (array)$payment,
            ]);
            $payment_invoice->save();
            return false;
        }

        $capture = $service->capturePayment(@$request->id, $payment_invoice['amount']);

        if (@$capture->status !== Constants::CLOSED) {
            Log::warning('Tabby capture failed on notify', ['tabby_id' => $payment->id, 'status' => @$capture->status]);
            $payment_invoice->status = Constants::FAILED;
            $payment_invoice->response_code = array_merge((array)$payment_invoice->response_code, [
                'tabby_payment' => (array)$payment,
                'tabby_capture' => (array)$capture,
            ]);
            $payment_invoice->save();
            return false;
        }

        $joining_date = $payment_invoice->response_code['joining_date'] ?? Carbon::now()->toDateString();
        $payment_invoice->response_code = array_merge((array)$payment_invoice->response_code, [
            'tabby_payment' => (array)$payment,
            'tabby_capture' => (array)$capture,
        ]);
        $payment_invoice->status = Constants::SUCCESS;
        $payment_invoice->save();

        $this->finalizeTabbyCheckout($payment_invoice, $joining_date, null, false);

        return true;
    }

    public function tabby_payment_verify(Request $request)
    {
        $payment_invoice = PaymentOnlineInvoice::with(['subscription' => function ($q) {
            $q->withTrashed();
        }])->where('payment_id', $request['payment_id'])->first();

        if (!$payment_invoice) {
            return \redirect()->route('error-payment', ['payment_id' => @$request['payment_id']]);
        }

        if ($payment_invoice->member_subscription_id) {
            return \redirect()->route('invoice', ['id' => $payment_invoice->member_subscription_id]);
        }

        $joining_date = $payment_invoice->response_code['joining_date'] ?? Carbon::now()->toDateString();
        $service = new TabbyService();
        $tabby_payment_id = $payment_invoice->transaction_id;
        $payment = $service->getPayment($tabby_payment_id);

        if (!$payment || !in_array($payment->status, [Constants::AUTHORIZED, Constants::CLOSED])) {
            $payment_invoice->status = Constants::FAILED;
            $payment_invoice->response_code = array_merge((array)$payment_invoice->response_code, [
                'tabby_payment' => (array)$payment,
            ]);
            $payment_invoice->save();
            \Session::flash('error', trans('front.error_in_data'));
            return \redirect()->route('subscription', ['id' => $payment_invoice->subscription_id]);
        }

        $capture = $service->capturePayment($tabby_payment_id, $payment_invoice['amount']);

        if (@$capture->status !== Constants::CLOSED) {
            $payment_invoice->status = Constants::FAILED;
            $payment_invoice->response_code = array_merge((array)$payment_invoice->response_code, [
                'tabby_payment' => (array)$payment,
                'tabby_capture' => (array)$capture,
            ]);
            $payment_invoice->save();
            \Session::flash('error', trans('front.error_in_data'));
            return \redirect()->route('subscription', ['id' => $payment_invoice->subscription_id]);
        }

        $payment_invoice->response_code = array_merge((array)$payment_invoice->response_code, [
            'tabby_payment' => (array)$payment,
            'tabby_capture' => (array)$capture,
        ]);
        $payment_invoice->status = Constants::SUCCESS;
        $payment_invoice->save();

        $member_subscription = $this->finalizeTabbyCheckout($payment_invoice, $joining_date, $this->current_user, true);

        if ($member_subscription) {
            return \redirect()->route('invoice', ['id' => $member_subscription->id]);
        }

        $payment_invoice->status = Constants::FAILED;
        $payment_invoice->save();

        return \redirect()->route('error-payment', ['payment_id' => @$request['payment_id']]);
    }

    public function error_payment(){
        $title = trans('front.invoice');
        return view('stepfitness::Front.error', compact('title'));
    }
    public function tabbyFailure(){
        $title = trans('front.invoice');
        return view('stepfitness::Front.tabby_error_failure', compact('title'));
    }
    public function tabbyCancel(){
        $title = trans('front.invoice');
        return view('stepfitness::Front.tabby_error_cancel', compact('title'));
    }


    protected function finalizeTabbyCheckout(PaymentOnlineInvoice $invoice, string $joiningDate, $sessionMember = null, bool $loginNewMember = true): ?MemberSubscription
    {
        if ($invoice->member_subscription_id) {
            return MemberSubscription::find($invoice->member_subscription_id);
        }

        $subscription = $invoice->subscription ?? Subscription::withTrashed()->find($invoice->subscription_id);

        if (!$subscription) {
            Log::error('Subscription missing on Tabby finalize', ['invoice_id' => $invoice->id]);
            return null;
        }

        $result = DB::transaction(function () use ($invoice, $joiningDate, $sessionMember, $subscription) {
            $member = ($sessionMember && @$sessionMember->id) ? $sessionMember : null;

            if (!$member && $invoice->member_id) {
                $member = Member::find($invoice->member_id);
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

        if ($loginNewMember && !$this->current_user && $result['type'] === Constants::CreateMember && $result['generatedCode']) {
            $this->loginMemberAfterOnlinePayment($result['generatedCode'], $result['member']->phone);
        }

        return $result['memberSubscription'];
    }

    protected function createMoneyBoxEntry(PaymentOnlineInvoice $invoice, Member $member, int $type): void
    {
        $amountBox = MoneyBox::orderBy('id', 'desc')->first();
        $amountBefore = $amountBox ? $amountBox->amount : 0;
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
        try {
            $auth = new AuthFrontController();
            $user = $auth->getSubscriptionInfo($code, $phone);
            if (isset($user->member)) {
                request()->session()->put('user', $user->member);
            }
        } catch (\Throwable $throwable) {
            Log::warning('Auto login after Tabby payment failed', ['error' => $throwable->getMessage()]);
        }
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
