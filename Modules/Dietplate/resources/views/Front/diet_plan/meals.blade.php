@extends('Dietplate::Front.layouts.master')
@section('title'){{ $title }} | @endsection
@section('style')
@php $isRtl = app()->getLocale() === 'ar'; @endphp
<style>
.hero_in.general:before {
    background: url({{asset('resources/assets/front/img/bg/articles.jpg')}}) center center no-repeat;
    -webkit-background-size: cover; background-size: cover;
}
.diet-meals-sec { padding: 50px 0 80px; background: #f9f5ff; }

/* Progress */
.diet-progress { display: flex; justify-content: center; margin-bottom: 40px; }
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
}
.diet-progress-step.active .diet-progress-circle { background: #7e4c8a; border-color: #7e4c8a; color: #fff; }
.diet-progress-step.done .diet-progress-circle { background: #28a745; border-color: #28a745; color: #fff; }
.diet-progress-step.active::after,
.diet-progress-step.done::after { background: #7e4c8a; }
.diet-progress-label { margin-top: 6px; font-size: 13px; font-weight: 600; color: #888; }
.diet-progress-step.active .diet-progress-label { color: #7e4c8a; }
.diet-progress-step.done .diet-progress-label { color: #28a745; }

/* Cart counter */
.meal-counter-bar {
    display: flex; align-items: center; justify-content: space-between;
    background: #7e4c8a; color: #fff;
    border-radius: 12px; padding: 14px 22px;
    margin-bottom: 24px; font-size: 16px; font-weight: 700;
}
.meal-counter-nums { font-size: 22px; font-weight: 800; }
.meal-counter-nums span { font-size: 14px; font-weight: 400; margin: 0 4px; }

/* Macros bar */
.macros-bar {
    display: flex; gap: 12px; margin-bottom: 24px; flex-wrap: wrap;
}
.macro-pill {
    flex: 1; min-width: 80px;
    background: #fff; border-radius: 12px;
    padding: 14px 10px; text-align: center;
    box-shadow: 0 2px 10px rgba(126,76,138,0.08);
}
.macro-pill-icon { font-size: 20px; margin-bottom: 4px; }
.macro-pill-val { font-size: 18px; font-weight: 800; color: #333; }
.macro-pill-label { font-size: 11px; color: #888; font-weight: 600; margin-top: 2px; }
.macro-cal { color: #e53935; }
.macro-carbs { color: #f57c00; }
.macro-protein { color: #1565c0; }
.macro-fat { color: #2e7d32; }

/* Category tabs */
.meal-tabs-nav {
    display: flex; gap: 0; border-bottom: 2px solid #e0d0f0;
    margin-bottom: 24px; overflow-x: auto;
    scrollbar-width: thin;
}
.meal-tab-btn {
    padding: 10px 20px; white-space: nowrap;
    border: none; background: transparent;
    color: #888; font-size: 14px; font-weight: 600;
    cursor: pointer; border-bottom: 3px solid transparent;
    margin-bottom: -2px; transition: all 0.2s;
}
.meal-tab-btn.active { color: #7e4c8a; border-bottom-color: #7e4c8a; background: #f5eeff; }
.meal-tab-btn .required-badge {
    background: #e53935; color: #fff;
    border-radius: 10px; padding: 1px 7px; font-size: 10px;
    margin-{{ $isRtl ? 'right' : 'left' }}: 5px;
}
.meal-tab-panel { display: none; }
.meal-tab-panel.active { display: block; }

/* Meal cards */
.meal-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 18px; }
.meal-card {
    background: #fff; border-radius: 14px; overflow: hidden;
    box-shadow: 0 3px 14px rgba(126,76,138,0.09);
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative;
}
.meal-card.selected { box-shadow: 0 0 0 3px #7e4c8a, 0 6px 20px rgba(126,76,138,0.18); }
.meal-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(126,76,138,0.16); }
.meal-card-img { width: 100%; height: 150px; object-fit: cover; }
.meal-card-img-placeholder {
    width: 100%; height: 150px;
    background: linear-gradient(135deg, #f0e6f8, #e8d8f5);
    display: flex; align-items: center; justify-content: center;
}
.meal-card-body { padding: 12px; }
.meal-card-name { font-size: 14px; font-weight: 700; color: #333; margin-bottom: 8px; min-height: 36px; }
.meal-macros { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 10px; }
.macro-tag {
    font-size: 11px; border-radius: 8px; padding: 3px 8px; font-weight: 600;
}
.macro-tag.cal { background: #ffebee; color: #c62828; }
.macro-tag.carbs { background: #fff3e0; color: #e65100; }
.macro-tag.protein { background: #e3f2fd; color: #0d47a1; }
.macro-tag.fat { background: #e8f5e9; color: #1b5e20; }
.meal-card-actions { display: flex; gap: 8px; }
.btn-select-meal {
    flex: 1; padding: 8px; border: none; border-radius: 8px;
    background: #7e4c8a; color: #fff; font-size: 13px; font-weight: 700;
    cursor: pointer; transition: background 0.2s;
}
.btn-select-meal:hover { background: #5d3368; }
.meal-card.selected .btn-select-meal { background: #28a745; }
.meal-card.selected .btn-select-meal::before { content: '✓ '; }
.btn-customize {
    padding: 8px 10px; border: 2px solid #0097a7; border-radius: 8px;
    background: transparent; color: #0097a7; font-size: 13px;
    cursor: pointer; transition: background 0.2s;
}
.btn-customize:hover { background: #e0f7fa; }
.meal-selected-badge {
    position: absolute; top: 8px; {{ $isRtl ? 'left' : 'right' }}: 8px;
    background: #28a745; color: #fff;
    border-radius: 50%; width: 28px; height: 28px;
    display: none; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 700;
}
.meal-card.selected .meal-selected-badge { display: flex; }

/* Bottom bar */
.meals-bottom-bar {
    position: sticky; bottom: 0;
    background: #fff;
    border-top: 2px solid #f0e0ff;
    padding: 16px 0; margin-top: 30px;
    box-shadow: 0 -4px 20px rgba(126,76,138,0.10);
    z-index: 100;
}
.meals-bottom-actions { display: flex; gap: 12px; align-items: center; justify-content: space-between; }
.btn-prev {
    padding: 12px 24px; border-radius: 10px;
    border: 2px solid #7e4c8a; color: #7e4c8a; background: #fff;
    font-size: 15px; font-weight: 700; cursor: pointer;
    transition: background 0.2s; text-decoration: none;
}
.btn-prev:hover { background: #f5eeff; color: #7e4c8a; }
.btn-next-meals {
    padding: 12px 28px; border-radius: 10px;
    background: #7e4c8a; color: #fff;
    border: none; font-size: 15px; font-weight: 700;
    cursor: pointer; transition: background 0.2s, transform 0.2s;
}
.btn-next-meals:hover { background: #5d3368; transform: translateY(-2px); }

/* Customize Modal */
.diet-modal-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.55); z-index: 9999;
    align-items: center; justify-content: center;
}
.diet-modal-overlay.show { display: flex; }
.diet-modal {
    background: #fff; border-radius: 18px; padding: 30px;
    max-width: 480px; width: 90%; max-height: 80vh; overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0,0,0,0.25);
}
.diet-modal-title { font-size: 18px; font-weight: 700; color: #333; margin-bottom: 18px; }
.diet-modal-footer { display: flex; gap: 10px; margin-top: 20px; }
.btn-modal-save {
    flex: 1; padding: 12px; border-radius: 10px;
    background: #28a745; color: #fff; border: none;
    font-size: 15px; font-weight: 700; cursor: pointer;
}
.btn-modal-close {
    padding: 12px 20px; border-radius: 10px;
    background: #f5f5f5; color: #333; border: none;
    font-size: 14px; font-weight: 600; cursor: pointer;
}

/* Confirm Modal */
.confirm-modal { max-width: 380px; text-align: center; }
.confirm-modal h4 { font-size: 17px; color: #333; margin-bottom: 16px; }
.btn-confirm-yes {
    flex: 1; padding: 12px; border-radius: 10px;
    background: #28a745; color: #fff; border: none;
    font-size: 15px; font-weight: 700; cursor: pointer;
}
.btn-confirm-no {
    padding: 12px 20px; border-radius: 10px;
    background: #f5f5f5; color: #333; border: none;
    font-size: 14px; font-weight: 600; cursor: pointer;
}

@media (max-width:576px) {
    .meal-grid { grid-template-columns: 1fr 1fr; }
    .macros-bar { gap: 8px; }
    .macro-pill { padding: 10px 6px; }
}
</style>
@endsection

@section('content')
<section class="page-title-sec over-layer-black">
    <div id="particles-js"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>{{ trans('front.meal_selection') }}</h2>
                <p>
                    <a href="{{ route('home') }}">{{ trans('front.home') }}</a> /
                    <span>{{ $subscription->name }}</span>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="diet-meals-sec">
    <div class="container">

        <!-- Progress Bar -->
        <div class="diet-progress">
            <div class="diet-progress-step done">
                <div class="diet-progress-circle"><i class="fa fa-check"></i></div>
                <div class="diet-progress-label">{{ trans('front.subscription') }}</div>
            </div>
            <div class="diet-progress-step active">
                <div class="diet-progress-circle">2</div>
                <div class="diet-progress-label">{{ trans('front.meal_selection') }}</div>
            </div>
        </div>

        <!-- Cart Counter -->
        <div class="meal-counter-bar">
            <div>
                <i class="fa fa-shopping-cart" style="margin-{{ $isRtl ? 'left':'right' }}:10px;"></i>
                {{ trans('front.selected_meals') }}
            </div>
            <div>
                <span class="meal-counter-nums">
                    <span id="selectedCount">0</span>
                    <span>/</span>
                    <span id="requiredCount">{{ $mealCount }}</span>
                </span>
            </div>
        </div>

        <!-- Macros Summary Bar -->
        <div class="macros-bar">
            <div class="macro-pill">
                <div class="macro-pill-icon macro-cal">🔥</div>
                <div class="macro-pill-val macro-cal" id="totalCal">0</div>
                <div class="macro-pill-label">{{ trans('front.calories') }}</div>
            </div>
            <div class="macro-pill">
                <div class="macro-pill-icon macro-carbs">🍞</div>
                <div class="macro-pill-val macro-carbs" id="totalCarbs">0</div>
                <div class="macro-pill-label">{{ trans('front.carbs') }}</div>
            </div>
            <div class="macro-pill">
                <div class="macro-pill-icon macro-protein">💪</div>
                <div class="macro-pill-val macro-protein" id="totalProtein">0</div>
                <div class="macro-pill-label">{{ trans('front.protein') }}</div>
            </div>
            <div class="macro-pill">
                <div class="macro-pill-icon macro-fat">🥑</div>
                <div class="macro-pill-val macro-fat" id="totalFat">0</div>
                <div class="macro-pill-label">{{ trans('front.fat') }}</div>
            </div>
        </div>

        <!-- Category Tabs -->
        <div class="meal-tabs-nav" id="mealTabsNav">
            @foreach($activeGroups as $index => $group)
            @php $baseName = str_replace(' (اختيار الوجبات)', '', $group->name_ar); @endphp
            <button type="button" class="meal-tab-btn {{ $index === 0 ? 'active' : '' }}"
                data-tab="tab_{{ $group->id }}"
                onclick="switchTab(this, 'tab_{{ $group->id }}')">
                {{ $baseName }}
                @if($group->is_required)
                <span class="required-badge">*</span>
                @endif
            </button>
            @endforeach
        </div>

        <!-- Meal Panels -->
        <form method="POST" action="{{ route('diet-plan.checkout', $subscription->id) }}" id="mealsForm">
            @csrf
            <input type="hidden" name="customize_selections" id="customizeSelectionsInput" value="">
            @foreach($activeGroups as $index => $group)
            @php $baseName = str_replace(' (اختيار الوجبات)', '', $group->name_ar); @endphp
            <div class="meal-tab-panel {{ $index === 0 ? 'active' : '' }}" id="tab_{{ $group->id }}"
                data-group="{{ $group->id }}"
                data-required="{{ $group->is_required ? 'true' : 'false' }}"
                data-max="{{ $group->id == $activeGroups->first()?->id ? $mealCount : 999 }}">

                <div class="meal-grid">
                    @foreach($group->options as $option)
                    @if($option->product)
                    @php $product = $option->product; @endphp
                    <div class="meal-card" id="mealCard_{{ $option->id }}"
                        data-option="{{ $option->id }}"
                        data-group="{{ $group->id }}"
                        data-cal="{{ $product->calories }}"
                        data-protein="{{ $product->protein }}"
                        data-carbs="{{ $product->carbs }}"
                        data-fat="{{ $product->fat }}"
                        data-max="{{ $group->id == $activeGroups->first()?->id ? $mealCount : 999 }}">

                        <div class="meal-selected-badge">✓</div>

                        @if($product->getRawOriginal('image'))
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="meal-card-img">
                        @else
                            <div class="meal-card-img-placeholder">
                                <i class="fa fa-utensils" style="font-size:40px;color:#c9a8e0;"></i>
                            </div>
                        @endif

                        <div class="meal-card-body">
                            <div class="meal-card-name">{{ $product->name }}</div>
                            <div class="meal-macros">
                                <span class="macro-tag cal">🔥 {{ $product->calories }}</span>
                                <span class="macro-tag carbs">🍞 {{ $product->carbs }}g</span>
                                <span class="macro-tag protein">💪 {{ $product->protein }}g</span>
                                <span class="macro-tag fat">🥑 {{ $product->fat }}g</span>
                            </div>
                            <div class="meal-card-actions">
                                <button type="button" class="btn-select-meal"
                                    onclick="selectMeal({{ $option->id }}, {{ $group->id }}, {{ $group->id == $activeGroups->first()?->id ? $mealCount : 999 }}, this)">
                                    {{ trans('front.select') }}
                                </button>
                                <button type="button" class="btn-customize"
                                    onclick="openCustomize({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                    title="{{ trans('front.customize') }}">
                                    <i class="fa fa-sliders"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Hidden inputs for selected meals --}}
                        <input type="hidden" name="meal_selections[{{ $group->id }}][]"
                            value="{{ $option->id }}"
                            id="mealInput_{{ $option->id }}"
                            disabled>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endforeach

            <!-- Bottom bar -->
            <div class="meals-bottom-bar">
                <div class="container">
                    <div class="meals-bottom-actions">
                        <a href="{{ route('diet-plan.subscribe', $subscription->id) }}" class="btn-prev">
                            <i class="fa fa-arrow-{{ $isRtl ? 'right':'left' }}"></i>
                            {{ trans('front.previous') }}
                        </a>
                        <div style="font-size:14px;color:#666;text-align:center;">
                            {{ trans('front.total') }}:
                            <strong style="color:#7e4c8a;font-size:18px;">
                                {{ number_format($step1['base_price'] ?? 0) }} {{ trans('front.pound_unit') }}
                            </strong>
                        </div>
                        <button type="button" class="btn-next-meals" onclick="submitMeals()">
                            {{ trans('front.next') }}
                            <i class="fa fa-arrow-{{ $isRtl ? 'left':'right' }}"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</section>

<!-- Customize Modal -->
<div class="diet-modal-overlay" id="customizeModal">
    <div class="diet-modal">
        <div class="diet-modal-title">
            <i class="fa fa-sliders" style="color:#0097a7;margin-{{ $isRtl ? 'left':'right' }}:8px;"></i>
            <span id="customizeModalTitle">{{ trans('front.customize_meal') }}</span>
        </div>
        <div id="customizeModalContent">
            <!-- Loaded via JS -->
            <div style="text-align:center;padding:30px;">
                <i class="fa fa-spinner fa-spin" style="font-size:30px;color:#7e4c8a;"></i>
            </div>
        </div>
        <div class="diet-modal-footer">
            <button type="button" class="btn-modal-save" onclick="saveCustomize()">
                {{ trans('front.save_and_select') }}
            </button>
            <button type="button" class="btn-modal-close" onclick="closeCustomize()">
                {{ trans('front.close') }}
            </button>
        </div>
    </div>
</div>

<!-- Confirm Modal -->
<div class="diet-modal-overlay" id="confirmModal">
    <div class="diet-modal confirm-modal">
        <h4>{{ trans('front.confirm_incomplete_meals') }}</h4>
        <div class="diet-modal-footer">
            <button type="button" class="btn-confirm-yes" onclick="confirmSubmit()">
                {{ trans('front.yes') }}
            </button>
            <button type="button" class="btn-confirm-no" onclick="closeConfirm()">
                {{ trans('front.close') }}
            </button>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
var selectedMeals = {};   // groupId => [optionIds]
var totalMacros = { cal: 0, protein: 0, carbs: 0, fat: 0 };
var requiredCount = {{ $mealCount }};
var customizeProductId = null;
var customizeProductName = null;
var customizeSelections = {}; // productId => { name: productName, options: [labels] }

// ── Tab switching ─────────────────────────────────────────────────────────
function switchTab(btn, tabId) {
    document.querySelectorAll('.meal-tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.meal-tab-panel').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById(tabId).classList.add('active');
}

// ── Meal selection ────────────────────────────────────────────────────────
function selectMeal(optionId, groupId, maxCount, btn) {
    var card = document.getElementById('mealCard_' + optionId);
    var inputEl = document.getElementById('mealInput_' + optionId);

    if (!selectedMeals[groupId]) selectedMeals[groupId] = [];

    var idx = selectedMeals[groupId].indexOf(optionId);

    if (idx > -1) {
        // Deselect
        selectedMeals[groupId].splice(idx, 1);
        card.classList.remove('selected');
        inputEl.disabled = true;
        // Subtract macros
        updateMacros(card, -1);
    } else {
        // For limited groups (main meal), enforce max
        if (maxCount < 999 && selectedMeals[groupId].length >= maxCount) {
            // Deselect first one
            var firstId = selectedMeals[groupId][0];
            selectedMeals[groupId].shift();
            var firstCard = document.getElementById('mealCard_' + firstId);
            firstCard.classList.remove('selected');
            document.getElementById('mealInput_' + firstId).disabled = true;
            updateMacros(firstCard, -1);
        }
        selectedMeals[groupId].push(optionId);
        card.classList.add('selected');
        inputEl.disabled = false;
        updateMacros(card, 1);
    }

    updateCounters();
}

function updateMacros(card, multiplier) {
    totalMacros.cal     += multiplier * (parseInt(card.dataset.cal)     || 0);
    totalMacros.protein += multiplier * (parseInt(card.dataset.protein) || 0);
    totalMacros.carbs   += multiplier * (parseInt(card.dataset.carbs)   || 0);
    totalMacros.fat     += multiplier * (parseInt(card.dataset.fat)     || 0);
    document.getElementById('totalCal').textContent     = totalMacros.cal;
    document.getElementById('totalProtein').textContent = totalMacros.protein;
    document.getElementById('totalCarbs').textContent   = totalMacros.carbs;
    document.getElementById('totalFat').textContent     = totalMacros.fat;
}

function updateCounters() {
    var mainGroupId = {{ $activeGroups->first()?->id ?? 0 }};
    var cnt = (selectedMeals[mainGroupId] || []).length;
    document.getElementById('selectedCount').textContent = cnt;
}

// ── Customize modal ───────────────────────────────────────────────────────
function openCustomize(productId, productName) {
    customizeProductId = productId;
    customizeProductName = productName;
    document.getElementById('customizeModalTitle').textContent = productName;
    document.getElementById('customizeModalContent').innerHTML =
        '<div style="text-align:center;padding:30px;"><i class="fa fa-spinner fa-spin" style="font-size:30px;color:#7e4c8a;"></i></div>';
    document.getElementById('customizeModal').classList.add('show');

    // Load product details
    fetch('{{ route("diet-plan.product", ["productId" => "__PRODUCT_ID__"]) }}'.replace('__PRODUCT_ID__', productId))
        .then(r => r.json())
        .then(data => {
            var html = '<p style="font-size:13px;color:#666;margin-bottom:16px;">' +
                '{{ trans("front.customize_hint") ?? "اختر الكربوهيدرات والإضافات المرافقة" }}</p>';
            html += '<div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">';
            var carbOptions = [
                '{{ trans("front.rice_mandi") ?? "أرز مندي" }}',
                '{{ trans("front.white_rice") ?? "أرز أبيض" }}',
                '{{ trans("front.rice_keesa") ?? "أرز كيسة" }}',
                '{{ trans("front.mashed_potato") ?? "بطاطس مهروسة" }}',
                '{{ trans("front.grilled_vegs") ?? "خضار مشوي مشكلة" }}',
                '{{ trans("front.plain_pasta") ?? "مكرونة ساده" }}',
                '{{ trans("front.red_sauce_pasta") ?? "مكرونة بالصلصة الحمراء" }}',
            ];
            var savedOptions = (customizeSelections[productId] && customizeSelections[productId].options) || [];
            carbOptions.forEach(function(name, i) {
                var checked = savedOptions.indexOf(name) !== -1 ? 'checked' : '';
                html += '<label style="display:flex;align-items:center;gap:8px;padding:10px;border:2px solid #e0d0f0;border-radius:10px;cursor:pointer;">' +
                    '<input type="checkbox" class="customize-option-checkbox" value="' + name.replace(/"/g, '&quot;') + '" ' + checked + ' style="accent-color:#7e4c8a;">' +
                    '<span style="font-size:13px;font-weight:600;">' + name + '</span></label>';
            });
            html += '</div>';
            document.getElementById('customizeModalContent').innerHTML = html;
        })
        .catch(function() {
            document.getElementById('customizeModalContent').innerHTML =
                '<p style="color:#888;text-align:center;">{{ trans("front.no_customize_options") ?? "لا توجد خيارات تخصيص متاحة" }}</p>';
        });
}

function closeCustomize() {
    document.getElementById('customizeModal').classList.remove('show');
}

function saveCustomize() {
    var checked = Array.prototype.slice.call(
        document.querySelectorAll('#customizeModalContent .customize-option-checkbox:checked')
    ).map(function(cb) { return cb.value; });

    if (checked.length > 0) {
        customizeSelections[customizeProductId] = { name: customizeProductName, options: checked };
    } else {
        delete customizeSelections[customizeProductId];
    }

    document.getElementById('customizeSelectionsInput').value = JSON.stringify(customizeSelections);

    closeCustomize();
}

// ── Submit meals ──────────────────────────────────────────────────────────
function submitMeals() {
    var mainGroupId = {{ $activeGroups->first()?->id ?? 0 }};
    var cnt = (selectedMeals[mainGroupId] || []).length;
    if (cnt < requiredCount) {
        document.getElementById('confirmModal').classList.add('show');
        return;
    }
    document.getElementById('mealsForm').submit();
}

function confirmSubmit() {
    document.getElementById('confirmModal').classList.remove('show');
    document.getElementById('mealsForm').submit();
}

function closeConfirm() {
    document.getElementById('confirmModal').classList.remove('show');
}

// Close modals on overlay click
document.getElementById('customizeModal').addEventListener('click', function(e) {
    if (e.target === this) closeCustomize();
});
document.getElementById('confirmModal').addEventListener('click', function(e) {
    if (e.target === this) closeConfirm();
});
</script>
@endsection
