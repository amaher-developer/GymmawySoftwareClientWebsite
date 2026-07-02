@extends('Dietplate::Front.layouts.master')
@section('title'){{ $title }} | @endsection
@section('style')
@php
    $isRtl = app()->getLocale() === 'ar';
    $dir   = $isRtl ? 'rtl' : 'ltr';
@endphp
<style>
.hero_in.general:before {
    background: url({{asset('resources/assets/front/img/bg/articles.jpg')}}) center center no-repeat;
    -webkit-background-size: cover; background-size: cover;
}
/* Progress bar */
.diet-progress { display: flex; justify-content: center; margin-bottom: 40px; gap: 0; }
.diet-progress-step {
    display: flex; align-items: center; flex-direction: column;
    position: relative; flex: 1; max-width: 180px;
}
.diet-progress-step::after {
    content: '';
    position: absolute;
    top: 18px;
    {{ $isRtl ? 'right' : 'left' }}: 50%;
    width: 100%;
    height: 3px;
    background: #e0e0e0;
    z-index: 0;
}
.diet-progress-step:last-child::after { display: none; }
.diet-progress-circle {
    width: 38px; height: 38px; border-radius: 50%;
    border: 3px solid #e0e0e0;
    background: #fff; color: #bbb;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 15px;
    position: relative; z-index: 1;
    transition: background 0.3s, border-color 0.3s, color 0.3s;
}
.diet-progress-step.active .diet-progress-circle {
    background: #7e4c8a; border-color: #7e4c8a; color: #fff;
}
.diet-progress-step.done .diet-progress-circle {
    background: #28a745; border-color: #28a745; color: #fff;
}
.diet-progress-step.active::after,
.diet-progress-step.done::after { background: #7e4c8a; }
.diet-progress-label { margin-top: 6px; font-size: 13px; font-weight: 600; color: #888; }
.diet-progress-step.active .diet-progress-label { color: #7e4c8a; }
.diet-progress-step.done .diet-progress-label { color: #28a745; }

/* Main section */
.diet-subscribe-sec { padding: 50px 0 80px; background: #f9f5ff; }

/* Cards */
.diet-card {
    background: #fff; border-radius: 16px; padding: 28px;
    box-shadow: 0 4px 20px rgba(126,76,138,0.10);
    margin-bottom: 24px;
}
.diet-card-title {
    font-size: 16px; font-weight: 700; color: #333;
    margin-bottom: 18px; border-bottom: 2px solid #f0e6f8; padding-bottom: 10px;
}
.diet-card-title i { color: #7e4c8a; margin-{{ $isRtl ? 'left' : 'right' }}: 8px; }

/* Days buttons */
.days-btn-group { display: flex; gap: 10px; flex-wrap: wrap; }
.day-btn {
    flex: 1; min-width: 80px;
    padding: 12px 8px; border-radius: 12px;
    border: 2px solid #e0d0f0; background: #fff;
    color: #555; font-size: 16px; font-weight: 700;
    cursor: pointer; text-align: center;
    transition: all 0.2s;
}
.day-btn:hover { border-color: #7e4c8a; color: #7e4c8a; background: #f5eeff; }
.day-btn.selected { border-color: #7e4c8a; background: #7e4c8a; color: #fff; }
.day-btn .day-price {
    display: block; font-size: 12px; margin-top: 4px;
    opacity: 0.85;
}

/* Select dropdowns */
.diet-select {
    width: 100%; padding: 11px 14px;
    border: 2px solid #e0d0f0; border-radius: 10px;
    font-size: 14px; background: #fff; color: #333;
    appearance: none; -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='7'%3E%3Cpath d='M6 7L0 0h12z' fill='%237e4c8a'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: {{ $isRtl ? '12px' : 'right 12px' }} center;
    padding-{{ $isRtl ? 'left' : 'right' }}: 36px;
    transition: border-color 0.2s;
}
.diet-select:focus { outline: none; border-color: #7e4c8a; }

/* Add-ons checkboxes */
.addon-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 10px; }
.addon-item {
    border: 2px solid #e0d0f0; border-radius: 12px;
    padding: 12px; cursor: pointer;
    transition: all 0.2s; display: flex; align-items: center; gap: 8px;
}
.addon-item:hover { border-color: #7e4c8a; background: #f5eeff; }
.addon-item input[type="checkbox"] { display: none; }
.addon-item.checked { border-color: #7e4c8a; background: #7e4c8a; color: #fff; }
.addon-item .addon-price {
    font-size: 12px; display: block; margin-top: 3px;
    color: #888;
}
.addon-item.checked .addon-price { color: rgba(255,255,255,0.8); }

/* Delivery type */
.delivery-type-grid { display: flex; gap: 10px; flex-wrap: wrap; }
.delivery-type-btn {
    flex: 1; min-width: 100px;
    padding: 14px 10px; border-radius: 12px;
    border: 2px solid #e0d0f0; background: #fff;
    cursor: pointer; text-align: center;
    transition: all 0.2s; color: #555; font-size: 13px; font-weight: 600;
}
.delivery-type-btn i { display: block; font-size: 22px; margin-bottom: 6px; color: #7e4c8a; }
.delivery-type-btn:hover { border-color: #7e4c8a; background: #f5eeff; }
.delivery-type-btn.selected { border-color: #7e4c8a; background: #7e4c8a; color: #fff; }
.delivery-type-btn.selected i { color: #fff; }

/* Off days checkboxes */
.days-week-grid { display: flex; gap: 8px; flex-wrap: wrap; }
.day-week-btn {
    padding: 8px 14px; border-radius: 8px;
    border: 2px solid #e0d0f0; background: #fff;
    cursor: pointer; font-size: 13px; font-weight: 600; color: #555;
    transition: all 0.2s;
}
.day-week-btn.selected { border-color: #e53935; background: #e53935; color: #fff; }

/* Price summary */
.price-summary {
    background: #f9f5ff;
    border: 2px solid #e0d0f0;
    border-radius: 16px;
    padding: 22px;
}
.price-summary-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: 8px 0; border-bottom: 1px solid #f0e0ff;
    font-size: 14px;
}
.price-summary-row:last-child { border-bottom: none; }
.price-summary-row.total {
    font-weight: 700; font-size: 18px; color: #7e4c8a;
    padding-top: 14px; border-top: 2px solid #e0d0f0; border-bottom: none;
    margin-top: 4px;
}
.price-summary-label { color: #555; }
.price-summary-val { font-weight: 700; color: #333; }
.price-note { font-size: 12px; color: #888; margin-top: 8px; }
.price-note i { color: #7e4c8a; }

/* Next button */
.btn-diet-next {
    display: block; width: 100%;
    background: #7e4c8a; color: #fff;
    border: none; border-radius: 12px;
    padding: 15px; font-size: 17px; font-weight: 700;
    text-align: center; cursor: pointer;
    transition: background 0.2s, transform 0.2s;
    margin-top: 20px;
}
.btn-diet-next:hover { background: #5d3368; transform: translateY(-2px); }

/* Input fields */
.diet-input {
    width: 100%; padding: 11px 14px;
    border: 2px solid #e0d0f0; border-radius: 10px;
    font-size: 14px; color: #333;
    transition: border-color 0.2s;
}
.diet-input:focus { outline: none; border-color: #7e4c8a; }
.form-group-diet { margin-bottom: 18px; }
.form-group-diet label { font-size: 13px; font-weight: 600; color: #555; margin-bottom: 6px; display: block; }

@media (max-width: 768px) {
    .days-btn-group { flex-direction: column; }
    .day-btn { min-width: unset; }
    .diet-progress-step::after { width: 60%; }
}
</style>
@endsection

@section('content')
<!-- Page title -->
<section class="page-title-sec over-layer-black">
    <div id="particles-js"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>{{ trans('front.subscription_options') }}</h2>
                <p>
                    <a href="{{ route('home') }}">{{ trans('front.home') }}</a> /
                    <a href="{{ route('home') }}#subscriptions">{{ trans('front.subscriptions') }}</a> /
                    <span>{{ $subscription->name }}</span>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Subscribe Section -->
<section class="diet-subscribe-sec">
    <div class="container">

        <!-- Progress Bar -->
        <div class="diet-progress">
            <div class="diet-progress-step active">
                <div class="diet-progress-circle">1</div>
                <div class="diet-progress-label">{{ trans('front.subscription') }}</div>
            </div>
            <div class="diet-progress-step">
                <div class="diet-progress-circle">2</div>
                <div class="diet-progress-label">{{ trans('front.meal_selection') }}</div>
            </div>
        </div>

        @if($errors->has('options'))
            <div class="alert alert-danger text-center" style="border-radius:10px;margin-bottom:20px;">
                <i class="fa fa-exclamation-circle"></i> {{ $errors->first('options') }}
            </div>
        @endif

        <form method="POST" action="{{ route('diet-plan.subscribe.store', $subscription->id) }}" id="step1Form">
            @csrf
            <div class="row">
                <div class="col-lg-8">

                    @php
                        // Separate groups by name (for targeted rendering)
                        $daysGroup     = $fixedGroups->firstWhere('name_ar', 'عدد الأيام');
                        $proteinGroup  = $fixedGroups->firstWhere('name_ar', 'وزن البروتين (جرام/الوجبة)');
                        $carbGroup     = $fixedGroups->firstWhere('name_ar', 'وزن الكارب (جرام/الوجبة)');
                        $typeGroup     = $fixedGroups->firstWhere('name_ar', 'نوع الاشتراك');
                        $addOnGroup    = $fixedGroups->firstWhere('name_ar', 'وجبات اضافية');
                    @endphp

                    <!-- Days Selection -->
                    @if($daysGroup)
                    <div class="diet-card">
                        <div class="diet-card-title">
                            <i class="fa fa-calendar"></i> {{ $daysGroup->name_ar }}
                        </div>
                        <div class="days-btn-group" id="daysGroup_{{ $daysGroup->id }}">
                            @foreach($daysGroup->options as $option)
                            <button type="button"
                                class="day-btn {{ old('group_'.$daysGroup->id) == $option->id ? 'selected' : ($loop->first ? 'selected' : '') }}"
                                data-option="{{ $option->id }}"
                                data-price="{{ $option->price_modifier }}"
                                data-group="{{ $daysGroup->id }}"
                                onclick="selectDay(this, {{ $daysGroup->id }})">
                                {{ $option->name_ar }}
                                <span class="day-price">{{ number_format($option->price_modifier) }} {{ trans('front.pound_unit') }}</span>
                            </button>
                            @endforeach
                        </div>
                        <input type="hidden" name="group_{{ $daysGroup->id }}" id="days_input_{{ $daysGroup->id }}"
                            value="{{ old('group_'.$daysGroup->id, $daysGroup->options->first()?->id) }}">
                    </div>
                    @endif

                    <!-- Protein Weight -->
                    @if($proteinGroup)
                    <div class="diet-card">
                        <div class="diet-card-title">
                            <i class="fa fa-balance-scale"></i> {{ $proteinGroup->name_ar }}
                        </div>
                        <select name="group_{{ $proteinGroup->id }}" class="diet-select" id="proteinSelect"
                            onchange="updatePrice()">
                            @foreach($proteinGroup->options as $option)
                            <option value="{{ $option->id }}"
                                data-price="{{ $option->price_modifier }}"
                                {{ old('group_'.$proteinGroup->id) == $option->id ? 'selected' : '' }}>
                                {{ $option->name_ar }}
                                @if($option->price_modifier > 0)
                                    (+{{ number_format($option->price_modifier) }} {{ trans('front.pound_unit') }})
                                @endif
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <!-- Carb Weight -->
                    @if($carbGroup)
                    <div class="diet-card">
                        <div class="diet-card-title">
                            <i class="fa fa-leaf"></i> {{ $carbGroup->name_ar }}
                        </div>
                        <select name="group_{{ $carbGroup->id }}" class="diet-select" id="carbSelect"
                            onchange="updatePrice()">
                            @foreach($carbGroup->options as $option)
                            <option value="{{ $option->id }}"
                                data-price="{{ $option->price_modifier }}"
                                {{ old('group_'.$carbGroup->id) == $option->id ? 'selected' : '' }}>
                                {{ $option->name_ar }}
                                @if($option->price_modifier > 0)
                                    (+{{ number_format($option->price_modifier) }} {{ trans('front.pound_unit') }})
                                @endif
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <!-- Subscription Type (Delivery / Pickup) -->
                    @if($typeGroup)
                    <div class="diet-card">
                        <div class="diet-card-title">
                            <i class="fa fa-truck"></i> {{ $typeGroup->name_ar }}
                        </div>
                        <div class="delivery-type-grid" id="typeGroup_{{ $typeGroup->id }}">
                            @foreach($typeGroup->options as $option)
                            @php
                                $icon = $option->name_ar === 'توصيل' ? 'fa-truck' : 'fa-store';
                                $isDelivery = $option->name_ar === 'توصيل';
                            @endphp
                            <button type="button"
                                class="delivery-type-btn {{ $loop->first ? 'selected' : '' }}"
                                data-option="{{ $option->id }}"
                                data-price="{{ $option->price_modifier }}"
                                data-is-delivery="{{ $isDelivery ? 'true' : 'false' }}"
                                data-group="{{ $typeGroup->id }}"
                                onclick="selectType(this, {{ $typeGroup->id }})">
                                <i class="fa {{ $icon }}"></i>
                                {{ $option->name_ar }}
                                @if($option->price_modifier > 0)
                                    <br><small style="font-size:11px;">+{{ number_format($option->price_modifier) }} {{ trans('front.pound_unit') }}</small>
                                @endif
                            </button>
                            @endforeach
                        </div>
                        <input type="hidden" name="group_{{ $typeGroup->id }}" id="type_input_{{ $typeGroup->id }}"
                            value="{{ old('group_'.$typeGroup->id, $typeGroup->options->first()?->id) }}">
                    </div>
                    @endif

                    <!-- Delivery Details (conditionally shown) -->
                    <div class="diet-card" id="deliveryDetailsCard">
                        <div class="diet-card-title">
                            <i class="fa fa-map-marker"></i> {{ trans('front.delivery_details') }}
                        </div>
                        <!-- Delivery type icons -->
                        <div class="form-group-diet">
                            <label>{{ trans('front.delivery_location_type') }}</label>
                            <div class="delivery-type-grid">
                                <button type="button" class="delivery-type-btn selected" data-dtype="home" onclick="selectDeliveryType(this)">
                                    <i class="fa fa-home"></i> {{ trans('front.home_address') }}
                                </button>
                                <button type="button" class="delivery-type-btn" data-dtype="office" onclick="selectDeliveryType(this)">
                                    <i class="fa fa-building"></i> {{ trans('front.office') }}
                                </button>
                                <button type="button" class="delivery-type-btn" data-dtype="other" onclick="selectDeliveryType(this)">
                                    <i class="fa fa-map-pin"></i> {{ trans('front.other') }}
                                </button>
                            </div>
                            <input type="hidden" name="delivery_type" id="deliveryTypeInput" value="home">
                        </div>
                        <div class="form-group-diet">
                            <label>{{ trans('front.area') }}</label>
                            <input type="text" name="area" class="diet-input"
                                placeholder="{{ trans('front.enter_area') }}"
                                value="{{ old('area') }}">
                        </div>
                        <div class="form-group-diet">
                            <label>{{ trans('front.address') }}</label>
                            <input type="text" name="address" class="diet-input"
                                placeholder="{{ trans('front.enter_address') }}"
                                value="{{ old('address') }}">
                        </div>
                    </div>

                    <!-- Start Date -->
                    <div class="diet-card">
                        <div class="diet-card-title">
                            <i class="fa fa-calendar-check-o"></i> {{ trans('front.start_date') }}
                        </div>
                        <div class="form-group-diet" style="margin-bottom:0">
                            <input type="date" name="start_date" class="diet-input"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                value="{{ old('start_date', date('Y-m-d', strtotime('+1 day'))) }}">
                        </div>
                    </div>

                    <!-- Days Off -->
                    <div class="diet-card">
                        <div class="diet-card-title">
                            <i class="fa fa-ban"></i> {{ trans('front.off_days') }}
                        </div>
                        <p style="font-size:13px;color:#888;margin-bottom:14px;">{{ trans('front.off_days_hint') }}</p>
                        <div class="days-week-grid">
                            @php
                                $weekDays = [
                                    'sat' => 'السبت', 'sun' => 'الأحد', 'mon' => 'الاثنين',
                                    'tue' => 'الثلاثاء', 'wed' => 'الأربعاء', 'thu' => 'الخميس', 'fri' => 'الجمعة'
                                ];
                            @endphp
                            @foreach($weekDays as $key => $name)
                            <button type="button" class="day-week-btn" data-day="{{ $key }}" onclick="toggleOffDay(this)">
                                {{ $name }}
                            </button>
                            @endforeach
                        </div>
                        <div id="offDaysInputs"></div>
                    </div>

                    <!-- Add-ons -->
                    @if($addOnGroup)
                    <div class="diet-card">
                        <div class="diet-card-title">
                            <i class="fa fa-plus-circle"></i> {{ $addOnGroup->name_ar }}
                        </div>
                        <div class="addon-grid">
                            @foreach($addOnGroup->options as $option)
                            <div class="addon-item" onclick="toggleAddon(this, {{ $option->id }}, {{ $option->price_modifier }}, '{{ addslashes($option->name_ar) }}')"
                                data-option="{{ $option->id }}"
                                data-price="{{ $option->price_modifier }}"
                                data-name="{{ $option->name_ar }}"
                                data-group="{{ $addOnGroup->id }}">
                                <input type="checkbox" name="group_{{ $addOnGroup->id }}[]" value="{{ $option->id }}"
                                    id="addon_{{ $option->id }}"
                                    {{ is_array(old('group_'.$addOnGroup->id)) && in_array($option->id, old('group_'.$addOnGroup->id)) ? 'checked' : '' }}>
                                <div>
                                    <div style="font-size:14px;font-weight:600;">{{ $option->name_ar }}</div>
                                    <span class="addon-price">+{{ number_format($option->price_modifier) }} {{ trans('front.pound_unit') }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Notes -->
                    <div class="diet-card">
                        <div class="diet-card-title">
                            <i class="fa fa-sticky-note"></i> {{ trans('front.notes') }}
                        </div>
                        <textarea name="notes" class="diet-input" rows="3"
                            placeholder="{{ trans('front.any_special_notes') }}"
                            style="resize:vertical;">{{ old('notes') }}</textarea>
                    </div>

                    <!-- Discount note -->
                    <div class="diet-card" style="background:#fff8e1;border:2px solid #ffc107;">
                        <i class="fa fa-tag" style="color:#ffc107;margin-{{ $isRtl ? 'left':'right' }}:8px;"></i>
                        <span style="font-size:13px;color:#666;">{{ trans('front.discount_code_note') }}</span>
                    </div>

                </div><!-- /col-lg-8 -->

                <!-- Sidebar: Price Summary -->
                <div class="col-lg-4">
                    <div class="price-summary" style="position:sticky;top:100px;">
                        <h4 style="font-size:16px;font-weight:700;color:#333;margin-bottom:18px;border-bottom:2px solid #f0e0ff;padding-bottom:10px;">
                            <i class="fa fa-calculator" style="color:#7e4c8a;margin-{{ $isRtl ? 'left':'right' }}:8px;"></i>
                            {{ trans('front.price_summary') }}
                        </h4>
                        <div id="priceSummaryRows"></div>
                        <div class="price-summary-row total">
                            <span class="price-summary-label">{{ trans('front.total') }}</span>
                            <span class="price-summary-val" id="totalPriceDisplay">0</span>
                        </div>
                        <p class="price-note">
                            <i class="fa fa-info-circle"></i>
                            {{ trans('front.price_note_vat') }}
                        </p>
                        <button type="submit" class="btn-diet-next">
                            {{ trans('front.next') }}
                            <i class="fa fa-arrow-{{ $isRtl ? 'right' : 'left' }}" style="margin-{{ $isRtl ? 'right':'left' }}:8px;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@section('script')
<script>
// ── State ─────────────────────────────────────────────────────────────────
var priceRows = {};  // key => {label, amount}

// ── Days selection ────────────────────────────────────────────────────────
function selectDay(btn, groupId) {
    document.querySelectorAll('#daysGroup_' + groupId + ' .day-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    document.getElementById('days_input_' + groupId).value = btn.dataset.option;
    priceRows['days'] = { label: btn.textContent.split('\n')[0].trim(), amount: parseFloat(btn.dataset.price) };
    renderPriceSummary();
}

// ── Subscription type (delivery/pickup) ──────────────────────────────────
function selectType(btn, groupId) {
    document.querySelectorAll('#typeGroup_' + groupId + ' .delivery-type-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    document.getElementById('type_input_' + groupId).value = btn.dataset.option;
    var isDelivery = btn.dataset.isDelivery === 'true';
    document.getElementById('deliveryDetailsCard').style.display = isDelivery ? 'block' : 'none';
    var price = parseFloat(btn.dataset.price || 0);
    if (price > 0) {
        priceRows['delivery'] = { label: '{{ trans("front.delivery") ?? "توصيل" }}', amount: price };
    } else {
        delete priceRows['delivery'];
    }
    renderPriceSummary();
}

// ── Delivery location type ────────────────────────────────────────────────
function selectDeliveryType(btn) {
    document.querySelectorAll('#deliveryDetailsCard .delivery-type-grid .delivery-type-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    document.getElementById('deliveryTypeInput').value = btn.dataset.dtype;
}

// ── Off days ──────────────────────────────────────────────────────────────
var offDays = [];
function toggleOffDay(btn) {
    var day = btn.dataset.day;
    if (btn.classList.contains('selected')) {
        btn.classList.remove('selected');
        offDays = offDays.filter(d => d !== day);
    } else {
        btn.classList.add('selected');
        offDays.push(day);
    }
    var container = document.getElementById('offDaysInputs');
    container.innerHTML = '';
    offDays.forEach(function(d) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'off_days[]';
        input.value = d;
        container.appendChild(input);
    });
}

// ── Add-ons ───────────────────────────────────────────────────────────────
function toggleAddon(el, optionId, price, name) {
    var cb = document.getElementById('addon_' + optionId);
    cb.checked = !cb.checked;
    if (cb.checked) {
        el.classList.add('checked');
        priceRows['addon_' + optionId] = { label: name, amount: price };
    } else {
        el.classList.remove('checked');
        delete priceRows['addon_' + optionId];
    }
    renderPriceSummary();
}

// ── Protein/Carb selects ──────────────────────────────────────────────────
function updatePrice() {
    var proteinSel = document.getElementById('proteinSelect');
    var carbSel = document.getElementById('carbSelect');
    if (proteinSel) {
        var pOpt = proteinSel.options[proteinSel.selectedIndex];
        var pPrice = parseFloat(pOpt.dataset.price || 0);
        if (pPrice > 0) {
            priceRows['protein'] = { label: '{{ trans("front.protein_weight") ?? "وزن البروتين" }}: ' + pOpt.text.split('(')[0].trim(), amount: pPrice };
        } else {
            delete priceRows['protein'];
        }
    }
    if (carbSel) {
        var cOpt = carbSel.options[carbSel.selectedIndex];
        var cPrice = parseFloat(cOpt.dataset.price || 0);
        if (cPrice > 0) {
            priceRows['carb'] = { label: '{{ trans("front.carb_weight") ?? "وزن الكارب" }}: ' + cOpt.text.split('(')[0].trim(), amount: cPrice };
        } else {
            delete priceRows['carb'];
        }
    }
    renderPriceSummary();
}

// ── Render price summary ──────────────────────────────────────────────────
function renderPriceSummary() {
    var container = document.getElementById('priceSummaryRows');
    var total = 0;
    var html = '';
    Object.values(priceRows).forEach(function(row) {
        total += row.amount;
        html += '<div class="price-summary-row">' +
            '<span class="price-summary-label">' + row.label + '</span>' +
            '<span class="price-summary-val">' + formatNumber(row.amount) + ' {{ trans("front.pound_unit") }}</span>' +
            '</div>';
    });
    container.innerHTML = html;
    document.getElementById('totalPriceDisplay').textContent = formatNumber(total) + ' {{ trans("front.pound_unit") }}';
}

function formatNumber(n) {
    return Number(n).toLocaleString('{{ app()->getLocale() }}', {minimumFractionDigits: 0, maximumFractionDigits: 2});
}

// ── Initialize ────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function () {
    // Trigger first day button click to init price
    var firstDayBtn = document.querySelector('.days-btn-group .day-btn.selected');
    if (firstDayBtn) {
        var groupId = firstDayBtn.dataset.group;
        priceRows['days'] = { label: firstDayBtn.textContent.split('\n')[0].trim(), amount: parseFloat(firstDayBtn.dataset.price) };
    }
    // Show/hide delivery details based on initial type
    var selectedTypeBtn = document.querySelector('.delivery-type-btn.selected');
    if (selectedTypeBtn) {
        var isDelivery = selectedTypeBtn.dataset.isDelivery === 'true';
        document.getElementById('deliveryDetailsCard').style.display = isDelivery ? 'block' : 'none';
        var price = parseFloat(selectedTypeBtn.dataset.price || 0);
        if (price > 0) {
            priceRows['delivery'] = { label: '{{ trans("front.delivery") ?? "توصيل" }}', amount: price };
        }
    }
    updatePrice();
    renderPriceSummary();
});
</script>
@endsection
