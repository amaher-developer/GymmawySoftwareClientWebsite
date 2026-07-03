<?php

namespace Modules\Dietplate\app\Http\Controllers\Front;

use App\Http\Classes\Constants;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\Common\Services\GymmawyNotificationService;
use Modules\Dietplate\Models\Member;
use Modules\Dietplate\Models\ReservationMember;
use Modules\Dietplate\Models\Subscription;
use Modules\Dietplate\Models\SubscriptionCategory;
use Modules\Dietplate\Models\SubscriptionOption;
use Modules\Dietplate\Models\SubscriptionOptionGroup;
use Modules\Dietplate\Models\StoreProduct;

class DietPlanFrontController extends SubscriptionFrontController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Screen 2: Sub-plans for a given category
     * GET /diet-plan/{categoryId}
     */
    public function plans($categoryId)
    {
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        View::share('currentUser', $this->current_user);

        $category = SubscriptionCategory::findOrFail($categoryId);
        $plans = Subscription::where('category_id', $categoryId)
            ->where('is_web', true)
            ->orderBy('workouts')
            ->get();

        if ($plans->isEmpty()) {
            \Session::flash('error', trans('front.error_in_data'));
            return redirect()->route('home');
        }

        $lang  = $this->lang;
        $title = $category->name;
        return view('Dietplate::Front.diet_plan.plans', compact('title', 'lang', 'category', 'plans'));
    }

    /**
     * Screen 3 (Step 1): Subscription options form
     * GET /diet-plan/subscribe/{subscriptionId}
     */
    public function subscribe($subscriptionId)
    {
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        View::share('currentUser', $this->current_user);

        $subscription = Subscription::where('id', $subscriptionId)
            ->where('is_web', true)
            ->firstOrFail();

        // Load all fixed option groups (source_type = 'fixed') ordered
        $fixedGroups = SubscriptionOptionGroup::with('options')
            ->where('subscription_id', $subscriptionId)
            ->where('source_type', 'fixed')
            ->orderBy('list_order')
            ->get();

        $lang  = $this->lang;
        $title = $subscription->name;

        return view('Dietplate::Front.diet_plan.subscribe', compact(
            'title', 'lang', 'subscription', 'fixedGroups'
        ));
    }

    /**
     * Store Step 1 selections → redirect to Step 2
     * POST /diet-plan/subscribe/{subscriptionId}
     */
    public function storeSubscribe(Request $request, $subscriptionId)
    {
        $subscription = Subscription::where('id', $subscriptionId)
            ->where('is_web', true)
            ->firstOrFail();

        // Validate required selections
        $fixedGroups = SubscriptionOptionGroup::with('options')
            ->where('subscription_id', $subscriptionId)
            ->where('source_type', 'fixed')
            ->where('is_required', true)
            ->orderBy('list_order')
            ->get();

        $errors = [];
        foreach ($fixedGroups as $group) {
            $key = 'group_' . $group->id;
            if ($group->selection_type === SubscriptionOptionGroup::SELECTION_SINGLE) {
                if (!$request->filled($key)) {
                    $errors[] = $group->name_ar;
                }
            }
        }

        if (!empty($errors)) {
            return back()
                ->withInput()
                ->withErrors(['options' => 'يرجى اختيار: ' . implode('، ', $errors)]);
        }

        // Server-side backstop for the map picker's client-side zone check — only applies
        // when coordinates were actually submitted (i.e. the user used the map picker).
        if ($request->filled('delivery_lat') && $request->filled('delivery_lng') && !$this->isWithinDeliveryZone(
            (float) $request->input('delivery_lat'),
            (float) $request->input('delivery_lng')
        )) {
            return back()
                ->withInput()
                ->withErrors(['options' => trans('front.out_of_delivery_zone')]);
        }

        // Build selections map: group_id => [option_id, ...]
        $selections = [];
        $allGroups = SubscriptionOptionGroup::where('subscription_id', $subscriptionId)
            ->where('source_type', 'fixed')
            ->get();

        foreach ($allGroups as $group) {
            $key = 'group_' . $group->id;
            if ($group->selection_type === SubscriptionOptionGroup::SELECTION_SINGLE) {
                $val = $request->input($key);
                if ($val) {
                    $selections[$group->id] = [$val];
                }
            } else {
                $vals = (array)$request->input($key, []);
                if (!empty($vals)) {
                    $selections[$group->id] = $vals;
                }
            }
        }

        // Calculate base price from option price_modifiers
        $totalPrice = 0;
        $selectedOptionIds = [];
        foreach ($selections as $groupId => $optionIds) {
            foreach ($optionIds as $optionId) {
                $option = SubscriptionOption::find($optionId);
                if ($option) {
                    $totalPrice += $option->price_modifier;
                    $selectedOptionIds[] = (int)$optionId;
                }
            }
        }

        // Determine which add-on groups are active (groups 6-12 are product groups)
        $addOnGroupId = $allGroups->where('name_ar', 'وجبات اضافية')->first()?->id;
        $selectedAddOnNames = [];
        if ($addOnGroupId && isset($selections[$addOnGroupId])) {
            foreach ($selections[$addOnGroupId] as $optionId) {
                $opt = SubscriptionOption::find($optionId);
                if ($opt) {
                    $selectedAddOnNames[] = $opt->name_ar;
                }
            }
        }

        // Store in session
        $sessionData = [
            'subscription_id'       => $subscriptionId,
            'selections'            => $selections,
            'selected_option_ids'   => $selectedOptionIds,
            'selected_addon_names'  => $selectedAddOnNames,
            'base_price'            => $totalPrice,
            'start_date'            => $request->input('start_date'),
            'off_days'              => $request->input('off_days', []),
            'delivery_type'         => $request->input('delivery_type', ''),
            'area'                  => $request->input('area', ''),
            'address'               => $request->input('address', ''),
            'delivery_lat'          => $request->input('delivery_lat', ''),
            'delivery_lng'          => $request->input('delivery_lng', ''),
            'notes'                 => $request->input('notes', ''),
        ];

        session(['diet_plan_step1' => $sessionData]);

        return redirect()->route('diet-plan.meals', $subscriptionId);
    }

    /**
     * Screen 4 (Step 2): Meal selection
     * GET /diet-plan/meals/{subscriptionId}
     */
    public function meals($subscriptionId)
    {
        $step1 = session('diet_plan_step1');
        if (!$step1 || $step1['subscription_id'] != $subscriptionId) {
            return redirect()->route('diet-plan.subscribe', $subscriptionId);
        }

        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        View::share('currentUser', $this->current_user);

        $subscription = Subscription::where('id', $subscriptionId)
            ->where('is_web', true)
            ->firstOrFail();

        // Load product option groups: 'product' source_type, ordered
        // Only show groups that are relevant (main meal always + selected add-ons)
        $productGroups = SubscriptionOptionGroup::with(['options.product'])
            ->where('subscription_id', $subscriptionId)
            ->where('source_type', 'product')
            ->orderBy('list_order')
            ->get();

        // Filter: always show main_meal group; show addon groups only if addon was selected
        $selectedAddonNames = $step1['selected_addon_names'] ?? [];

        $activeGroups = $productGroups->filter(function ($group) use ($selectedAddonNames) {
            $baseName = str_replace(' (اختيار الوجبات)', '', $group->name_ar);
            // Always show main meal group
            if ($baseName === 'وجبة رئيسية') {
                return true;
            }
            // Show if user selected this add-on
            foreach ($selectedAddonNames as $addon) {
                if (str_contains($baseName, $addon) || str_contains($addon, $baseName)) {
                    return true;
                }
            }
            return false;
        })->values();

        // Main meal count comes from subscription workouts/30
        $mealCount = (int) round($subscription->workouts / 30);

        $lang  = $this->lang;
        $title = $subscription->name;

        return view('Dietplate::Front.diet_plan.meals', compact(
            'title', 'lang', 'subscription', 'activeGroups', 'mealCount', 'step1'
        ));
    }

    /**
     * AJAX: get product details (for customize modal)
     * GET /diet-plan/product/{productId}
     */
    public function productDetail($productId)
    {
        $product = StoreProduct::findOrFail($productId);
        return response()->json([
            'id'       => $product->id,
            'name'     => $product->name,
            'name_ar'  => $product->name_ar,
            'name_en'  => $product->name_en,
            'calories' => $product->calories,
            'protein'  => $product->protein,
            'carbs'    => $product->carbs,
            'fat'      => $product->fat,
            'image'    => $product->image_url,
        ]);
    }

    /**
     * Final checkout — save meal selections and move to the payment step.
     * Guests are allowed through; contact details are collected on the payment page.
     * POST /diet-plan/checkout/{subscriptionId}
     */
    public function checkout(Request $request, $subscriptionId)
    {
        $step1 = session('diet_plan_step1');
        if (!$step1 || $step1['subscription_id'] != $subscriptionId) {
            return redirect()->route('diet-plan.subscribe', $subscriptionId);
        }

        // Save meal selections to session
        $mealSelections = $request->input('meal_selections', []);

        // customize_selections is a JSON string built client-side: { productId: { name, options: [labels] } }
        $customizeSelections = json_decode((string) $request->input('customize_selections', ''), true) ?: [];

        session(['diet_plan_step2' => [
            'meal_selections'      => $mealSelections,
            'customize_selections' => $customizeSelections,
        ]]);

        return redirect()->route('diet-plan.payment', $subscriptionId);
    }

    /**
     * Payment page — shows subscription summary and, depending on whether a payment
     * gateway is configured for this client, either the payment method form or a
     * simple "we will contact you" contact-info form.
     * GET /diet-plan/payment/{subscriptionId}
     */
    public function payment($subscriptionId)
    {
        $step1 = session('diet_plan_step1');
        if (!$step1 || $step1['subscription_id'] != $subscriptionId) {
            return redirect()->route('diet-plan.subscribe', $subscriptionId);
        }

        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        View::share('currentUser', $this->current_user);

        $subscription = Subscription::where('id', $subscriptionId)
            ->where('is_web', true)
            ->firstOrFail();

        $step2 = session('diet_plan_step2', []);
        $lang  = $this->lang;
        $title = trans('front.payment');

        // Get selected options detail for summary
        $selectedOptions = [];
        foreach ($step1['selections'] ?? [] as $groupId => $optionIds) {
            $group = SubscriptionOptionGroup::find($groupId);
            if (!$group) continue;
            $opts = SubscriptionOption::whereIn('id', $optionIds)->get();
            $selectedOptions[] = [
                'group' => $group->name_ar,
                'options' => $opts->pluck('name_ar')->toArray(),
            ];
        }

        $vatPercentage  = (float) (@$this->mainSettings['vat_details']['vat_percentage'] ?? 0);
        $priceBeforeVat = (float) ($step1['base_price'] ?? 0);
        $vatAmount      = round(($vatPercentage / 100) * $priceBeforeVat, 2);
        $priceWithVat   = round($priceBeforeVat + $vatAmount, 2);

        $gatewayConfigured = $this->paymentGatewayConfigured();

        return view('Dietplate::Front.diet_plan.payment', compact(
            'title', 'lang', 'subscription', 'step1', 'step2', 'selectedOptions',
            'vatPercentage', 'priceBeforeVat', 'vatAmount', 'priceWithVat', 'gatewayConfigured'
        ));
    }

    /**
     * Submits the diet-plan order.
     * - If a payment gateway is configured: redirects to the chosen gateway's hosted checkout.
     *   Member + MemberSubscription are only created after the gateway confirms success
     *   (handled by the inherited webhook/verify flow from SubscriptionFrontController).
     * - If no gateway is configured: creates a potential-member (lead) record, emails the
     *   company with the full order details, and shows a "we will contact you" message.
     * POST /diet-plan/payment/{subscriptionId}
     */
    public function paymentSubmit(Request $request, $subscriptionId)
    {
        $step1 = session('diet_plan_step1');
        $step2 = session('diet_plan_step2', []);
        if (!$step1 || $step1['subscription_id'] != $subscriptionId) {
            return redirect()->route('diet-plan.subscribe', $subscriptionId);
        }

        $subscription = Subscription::where('id', $subscriptionId)
            ->where('is_web', true)
            ->firstOrFail();

        $dietSelections = $this->buildDietSelectionsSummary($step1, $step2);

        $member_data = [];

        // Logged-in members are identified by the hidden member_id field — re-fetch fresh
        // from the DB rather than trusting the session-cached object, so we always send
        // authoritative data and the shared gateway/finalize logic correctly treats this
        // as a renewal (existing member) vs. a brand-new member for guests.
        $member = $request->filled('member_id') ? Member::find($request->input('member_id')) : null;

        if ($member) {
            $this->current_user = $member;

            $member_data['name']    = $member->name;
            $member_data['phone']   = $member->phone;
            $member_data['email']   = $member->email;
            $member_data['address'] = $member->address;
            $member_data['dob']     = $member->dob;
            $member_data['gender']  = $member->gender;
        } else {
            $this->current_user = null;

            $request->validate([
                'name'    => 'required',
                'phone'   => 'required',
                'gender'  => 'required',
                'dob'     => 'required|date',
                'address' => 'required',
                'email'   => 'nullable|email',
            ]);

            $existingMember = Member::where('phone', $request->phone)->first();
            if ($existingMember) {
                \Session::flash('error', trans('front.error_member_exist'));
                return redirect()->back()->withInput();
            }

            $member_data['name']    = $request->name;
            $member_data['phone']   = $request->phone;
            $member_data['email']   = $request->email;
            $member_data['address'] = $request->address;
            $member_data['dob']     = Carbon::parse($request->dob);
            $member_data['gender']  = $request->gender;
        }

        $vatPercentage  = (float) (@$this->mainSettings['vat_details']['vat_percentage'] ?? 0);
        $priceBeforeVat = (float) ($step1['base_price'] ?? 0);
        $vatAmount      = round(($vatPercentage / 100) * $priceBeforeVat, 2);
        $priceWithVat   = round($priceBeforeVat + $vatAmount, 2);

        $member_data['subscription_id']    = $subscriptionId;
        $member_data['joining_date']       = $step1['start_date'] ?: Carbon::now()->toDateString();
        $member_data['payment_channel']    = 2;
        $member_data['amount']             = $priceWithVat;
        $member_data['vat_percentage']     = $vatPercentage;
        $member_data['vat']                = $vatAmount;
        $member_data['extra_invoice_data'] = ['diet_selections' => $dietSelections];

        if ($this->paymentGatewayConfigured()) {
            $paymentMethod = (int) $request->input('payment_method');
            $member_data['payment_method'] = $paymentMethod;

            $payment_url = match ($paymentMethod) {
                Constants::TABBY           => $this->tabby_payment($subscription->toArray(), $member_data),
                Constants::TAMARA          => $this->tamara_payment($subscription->toArray(), $member_data),
                Constants::PAYTABS_STANDARD => $this->paytabs_standard_payment($subscription->toArray(), $member_data),
                default                    => null,
            };

            if (!$payment_url) {
                \Session::flash('error', trans('front.error_in_data'));
                return redirect()->back()->withInput();
            }

            session()->forget(['diet_plan_step1', 'diet_plan_step2']);
            return redirect($payment_url);
        }

        // No payment gateway configured — capture as a lead and notify the company.
        ReservationMember::create([
            'name'            => $member_data['name'],
            'phone'           => $member_data['phone'],
            'subscription_id' => $subscriptionId,
            'type'            => 0,
            'notes'           => $this->buildDietLeadNotes($subscription, $dietSelections, $member_data),
        ]);

        $this->sendDietOrderAdminEmailFromData([
            'isPaid'           => false,
            'name'             => $member_data['name'],
            'phone'            => $member_data['phone'],
            'email'            => $member_data['email'],
            'address'          => $member_data['address'],
            'gender'           => $member_data['gender'] ?? null,
            'dob'              => $member_data['dob'] ?? null,
            'subscriptionName' => $subscription->name,
            'startDate'        => $dietSelections['start_date'],
            'selectionGroups'  => $dietSelections['selection_groups'],
            'mealGroups'       => $dietSelections['meal_groups'],
            'customizeGroups'  => $dietSelections['customize_groups'],
            'deliveryType'     => $dietSelections['delivery_type'],
            'deliveryArea'     => $dietSelections['delivery_area'],
            'deliveryAddress'  => $dietSelections['delivery_address'],
            'locationUrl'      => $dietSelections['location_url'],
            'notes'            => $dietSelections['notes'],
            'amount'           => $priceWithVat,
            'currency'         => trans('front.pound_unit'),
        ]);

        GymmawyNotificationService::notifyReservation();

        session()->forget(['diet_plan_step1', 'diet_plan_step2']);

        return redirect()->route('diet-plan.thanks');
    }

    /**
     * "We will contact you soon" confirmation shown after a lead is captured
     * (no payment gateway configured for this client).
     * GET /diet-plan/thanks
     */
    public function thanks()
    {
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        View::share('currentUser', $this->current_user);

        $lang  = $this->lang;
        $title = trans('front.thank_you');

        return view('Dietplate::Front.diet_plan.thanks', compact('title', 'lang'));
    }

    /**
     * True when at least one online payment gateway has credentials configured for this client.
     */
    protected function paymentGatewayConfigured(): bool
    {
        return (bool) (env('TABBY_SK') || env('TAMARA_API_TOKEN') || env('PAYTABS_PROFILE_ID'));
    }

    /**
     * Straight-line (Haversine) distance check against the branch location configured
     * in Settings, used as the server-side backstop for the map picker's zone check.
     */
    protected function isWithinDeliveryZone(float $lat, float $lng): bool
    {
        $branchLat = (float) ($this->mainSettings->latitude ?: 24.7136);
        $branchLng = (float) ($this->mainSettings->longitude ?: 46.6753);
        $radiusKm  = (float) env('DIET_DELIVERY_RADIUS_KM', 20);

        $earthRadiusKm = 6371;
        $dLat = deg2rad($lat - $branchLat);
        $dLng = deg2rad($lng - $branchLng);
        $a = sin($dLat / 2) ** 2 + cos(deg2rad($branchLat)) * cos(deg2rad($lat)) * sin($dLng / 2) ** 2;
        $distanceKm = $earthRadiusKm * 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $distanceKm <= $radiusKm;
    }

    /**
     * Resolves step1 (fixed options) + step2 (meal picks) into human-readable group/option
     * name pairs, used for both the admin email and the lead's notes.
     */
    protected function buildDietSelectionsSummary(array $step1, array $step2): array
    {
        $selectionGroups = [];
        foreach ($step1['selections'] ?? [] as $groupId => $optionIds) {
            $group = SubscriptionOptionGroup::find($groupId);
            if (!$group) continue;
            $opts = SubscriptionOption::whereIn('id', $optionIds)->get();
            $selectionGroups[] = [
                'label' => $group->name_ar,
                'value' => implode('، ', $opts->pluck('name_ar')->toArray()),
            ];
        }

        $mealGroups = [];
        foreach ($step2['meal_selections'] ?? [] as $groupId => $optionIds) {
            $group = SubscriptionOptionGroup::find($groupId);
            if (!$group) continue;
            $opts = SubscriptionOption::with('product')->whereIn('id', $optionIds)->get();
            $mealGroups[] = [
                'label' => $group->name_ar,
                'value' => implode('، ', $opts->map(function ($o) {
                    return optional($o->product)->name_ar ?? $o->name_ar;
                })->toArray()),
            ];
        }

        $customizeGroups = [];
        foreach ($step2['customize_selections'] ?? [] as $productId => $customization) {
            if (empty($customization['options'])) continue;
            $customizeGroups[] = [
                'label' => $customization['name'] ?? ('#' . $productId),
                'value' => implode('، ', (array) $customization['options']),
            ];
        }

        $locationUrl = null;
        if (!empty($step1['delivery_lat']) && !empty($step1['delivery_lng'])) {
            $locationUrl = 'https://www.google.com/maps?q=' . $step1['delivery_lat'] . ',' . $step1['delivery_lng'];
        }

        return [
            'selection_groups' => $selectionGroups,
            'meal_groups'      => $mealGroups,
            'customize_groups' => $customizeGroups,
            'notes'            => $step1['notes'] ?? null,
            'start_date'       => $step1['start_date'] ?? null,
            'delivery_type'    => $step1['delivery_type'] ?? null,
            'delivery_area'    => $step1['area'] ?? null,
            'delivery_address' => $step1['address'] ?? null,
            'location_url'     => $locationUrl,
        ];
    }

    protected function buildDietLeadNotes(Subscription $subscription, array $dietSelections, array $member_data = []): string
    {
        $lines = [
            'الخطة: ' . $subscription->name,
        ];

        if (!empty($dietSelections['start_date'])) {
            $lines[] = 'تاريخ البدء: ' . $dietSelections['start_date'];
        }
        foreach ($dietSelections['selection_groups'] as $group) {
            $lines[] = $group['label'] . ': ' . $group['value'];
        }
        foreach ($dietSelections['meal_groups'] as $group) {
            $lines[] = $group['label'] . ': ' . $group['value'];
        }
        foreach ($dietSelections['customize_groups'] ?? [] as $group) {
            $lines[] = 'تخصيص ' . $group['label'] . ': ' . $group['value'];
        }
        if (!empty($dietSelections['delivery_type'])) {
            $lines[] = 'نوع التوصيل: ' . $dietSelections['delivery_type'];
        }
        if (!empty($dietSelections['delivery_area'])) {
            $lines[] = 'المنطقة: ' . $dietSelections['delivery_area'];
        }
        if (!empty($dietSelections['delivery_address'])) {
            $lines[] = 'عنوان التوصيل: ' . $dietSelections['delivery_address'];
        }
        if (!empty($dietSelections['location_url'])) {
            $lines[] = 'الموقع على الخريطة: ' . $dietSelections['location_url'];
        }
        if (!empty($dietSelections['notes'])) {
            $lines[] = 'ملاحظات: ' . $dietSelections['notes'];
        }
        if (!empty($member_data['address'])) {
            $lines[] = 'العنوان: ' . $member_data['address'];
        }
        if (!empty($member_data['email'])) {
            $lines[] = 'البريد الإلكتروني: ' . $member_data['email'];
        }

        return implode("\n", $lines);
    }
}
