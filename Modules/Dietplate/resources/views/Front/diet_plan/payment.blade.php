@extends('Dietplate::Front.layouts.master')
@section('title'){{ $title }} | @endsection
@section('style')
@php $isRtl = app()->getLocale() === 'ar'; @endphp
<style>
.hero_in.general:before {
    background: url({{asset('resources/assets/front/img/bg/articles.jpg')}}) center center no-repeat;
    -webkit-background-size: cover; background-size: cover;
}
.diet-payment-sec { padding: 60px 0 80px; background: #f9f5ff; }
.summary-card {
    background: #fff; border-radius: 16px; padding: 28px;
    box-shadow: 0 4px 20px rgba(126,76,138,0.10); margin-bottom: 24px;
}
.summary-card-title {
    font-size: 17px; font-weight: 700; color: #333;
    margin-bottom: 18px; border-bottom: 2px solid #f0e6f8; padding-bottom: 10px;
}
.summary-card-title i { color: #7e4c8a; margin-{{ $isRtl ? 'left':'right' }}:8px; }
.summary-option-row {
    display: flex; justify-content: space-between;
    padding: 8px 0; font-size: 14px; border-bottom: 1px solid #f5f0ff;
}
.summary-option-row:last-child { border-bottom: none; }
.summary-option-label { color: #666; }
.summary-option-val { font-weight: 700; color: #333; }
.summary-total-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: 14px 0 0; font-size: 20px; font-weight: 800; color: #7e4c8a;
    border-top: 2px solid #e0d0f0; margin-top: 10px;
}

/* Contact form */
.diet-payment-sec .form-group { margin-bottom: 16px; }
.diet-payment-sec .form-label {
    display: block; font-size: 13px; font-weight: 700; color: #555;
    margin-bottom: 6px;
}
.diet-payment-sec .form-control[readonly] { background: #f8f5fb; color: #777; }
.diet-payment-sec .gender-row { display: flex; align-items: center; gap: 24px; margin: 4px 0 6px; }
.diet-payment-sec .gender-row label { font-size: 14px; color: #444; margin-{{ $isRtl ? 'right':'left' }}: 6px; }
.diet-payment-sec .gender-row input[type=radio] { width: 18px; height: 18px; vertical-align: middle; }

/* Payment method cards */
.payment-method-card {
    display: flex; gap: 14px; align-items: flex-start;
    border: 2px solid #e8ddf2; border-radius: 12px; padding: 16px;
    margin-bottom: 16px; cursor: pointer; transition: border-color .15s, background .15s;
}
.payment-method-card:hover { border-color: #c9a8d8; }
.payment-method-card.selected { border-color: #7e4c8a; background: #faf5ff; }
.payment-method-card input[type=radio] { width: 20px; height: 20px; margin-top: 4px; flex-shrink: 0; }
.payment-method-body { flex: 1; }
.payment-method-title { font-size: 15px; font-weight: 700; color: #333; display: block; cursor: pointer; margin-bottom: 8px; }
.payment-method-logos { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 8px; }
.payment-method-logos img {
    height: 32px; width: auto; padding: 4px 8px; border: solid 1px #e8ddf2;
    border-radius: 6px; object-fit: contain; background: #fff;
}
.payment-method-note { font-size: 12px; color: #888; margin: 0; }
#tabbyCard { padding-top: 14px; width: 100%; }
</style>
@endsection

@section('content')
<section class="page-title-sec over-layer-black">
    <div id="particles-js"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>{{ trans('front.payment') }}</h2>
                <p>
                    <a href="{{ route('home') }}">{{ trans('front.home') }}</a> /
                    <span>{{ $subscription->name }}</span>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="diet-payment-sec">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">

                <!-- Summary Card -->
                <div class="summary-card">
                    <div class="summary-card-title">
                        <i class="fa fa-receipt"></i>
                        {{ trans('front.order_summary') }}
                    </div>
                    <div class="summary-option-row">
                        <span class="summary-option-label">{{ trans('front.plan') }}</span>
                        <span class="summary-option-val">{{ $subscription->name }}</span>
                    </div>
                    @foreach($selectedOptions as $item)
                    <div class="summary-option-row">
                        <span class="summary-option-label">{{ $item['group'] }}</span>
                        <span class="summary-option-val">{{ implode('، ', $item['options']) }}</span>
                    </div>
                    @endforeach
                    @if(!empty($step1['start_date']))
                    <div class="summary-option-row">
                        <span class="summary-option-label">{{ trans('front.start_date') }}</span>
                        <span class="summary-option-val">{{ $step1['start_date'] }}</span>
                    </div>
                    @endif
                    @if($vatPercentage > 0)
                    <div class="summary-option-row">
                        <span class="summary-option-label">{{ trans('front.price') }}</span>
                        <span class="summary-option-val">{{ number_format($priceBeforeVat, 2) }} {{ trans('front.pound_unit') }}</span>
                    </div>
                    <div class="summary-option-row">
                        <span class="summary-option-label">{{ trans('front.vat') }} ({{ $vatPercentage }}%)</span>
                        <span class="summary-option-val">{{ number_format($vatAmount, 2) }} {{ trans('front.pound_unit') }}</span>
                    </div>
                    @endif
                    <div class="summary-total-row">
                        <span>{{ trans('front.total') }}</span>
                        <span>{{ number_format($priceWithVat, 2) }} {{ trans('front.pound_unit') }}</span>
                    </div>
                </div>

                @if(\Session::has('error'))
                    <p class="alert alert-danger">{!! \Session::get('error') !!}</p>
                @endif

                <form method="post" action="{{ route('diet-plan.payment.submit', $subscription->id) }}">
                    {{ csrf_field() }}
                    @if($currentUser)
                        <input type="hidden" name="member_id" value="{{ $currentUser->id }}">
                    @endif

                    <!-- Contact info -->
                    <div class="summary-card">
                        <div class="summary-card-title">
                            <i class="fa fa-user"></i>
                            {{ trans('front.register_info') }}
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="diet_name">{{ trans('front.name') }}</label>
                            <input type="text" id="diet_name" class="form-control" placeholder="{{ trans('front.name') }}" value="{{ old('name', @$currentUser->name) }}" @if($currentUser) readonly @else name="name" required @endif>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="diet_phone">{{ trans('front.phone') }}</label>
                            <input type="text" id="diet_phone" class="form-control" placeholder="{{ trans('front.phone') }}" value="{{ old('phone', @$currentUser->phone) }}" @if($currentUser) readonly @else name="phone" required @endif>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="diet_email">{{ trans('front.email') }}</label>
                            <input type="email" id="diet_email" class="form-control" placeholder="{{ trans('front.email') }}" value="{{ old('email', @$currentUser->email) }}" @if($currentUser) readonly @else name="email" @endif>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="diet_address">{{ trans('front.address') }}</label>
                            <input type="text" id="diet_address" class="form-control" placeholder="{{ trans('front.address') }}" value="{{ old('address', @$currentUser->address) }}" @if($currentUser) readonly @else name="address" required @endif>
                        </div>

                        @if(!$currentUser)
                            <div class="form-group">
                                <label class="form-label">{{ trans('front.gender') }}</label>
                                <div class="gender-row">
                                    <span>
                                        <input type="radio" name="gender" value="{{ \App\Http\Classes\Constants::MALE }}" id="male" required>
                                        <label for="male">{{ trans('front.male') }}</label>
                                    </span>
                                    <span>
                                        <input type="radio" name="gender" value="{{ \App\Http\Classes\Constants::FEMALE }}" id="female">
                                        <label for="female">{{ trans('front.female') }}</label>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="diet_dob">{{ trans('front.birthdate') }}</label>
                                <input type="date" id="diet_dob" name="dob" class="form-control" required>
                            </div>
                        @endif
                    </div>

                    @if($gatewayConfigured)
                        <!-- Payment gateway selection -->
                        <div class="summary-card">
                            <div class="summary-card-title">
                                <i class="fa fa-credit-card"></i>
                                {{ trans('front.choose_payment_methods') }}
                            </div>

                            <label class="payment-method-card" for="pm_tabby">
                                <input class="pm-radio" type="radio" name="payment_method" value="{{ \App\Http\Classes\Constants::TABBY }}" id="pm_tabby" required>
                                <div class="payment-method-body">
                                    <span class="payment-method-title">{{ trans('front.tabby_installment_msg') }}</span>
                                    <div class="payment-method-logos">
                                        <img src="{{ asset('resources/assets/images/tabby-logo.webp') }}" alt="Tabby">
                                    </div>
                                    <p class="payment-method-note">{{ trans('front.tabby_policy_msg') }}</p>
                                    <div id="tabbyCard" class="row col-md-12 col-xs-12"></div>
                                </div>
                            </label>

                            <label class="payment-method-card" for="pm_tamara">
                                <input class="pm-radio" type="radio" name="payment_method" value="{{ \App\Http\Classes\Constants::TAMARA }}" id="pm_tamara">
                                <div class="payment-method-body">
                                    <span class="payment-method-title">{{ trans('front.tamara_installment_msg') }}</span>
                                    <div class="payment-method-logos">
                                        <img src="https://cdn.tamara.co/assets/png/tamara-logo-badge-{{ app()->getLocale() == 'ar' ? 'ar' : 'en' }}.png" alt="Tamara">
                                    </div>
                                    <p class="payment-method-note">{{ trans('front.tamara_policy_msg') }}</p>
                                    <div class="row col-md-12 col-xs-12" style="padding-top: 10px;">
                                        <tamara-widget type="tamara-summary" amount="{{ $priceWithVat }}" inline-type="2"></tamara-widget>
                                    </div>
                                </div>
                            </label>

                            <label class="payment-method-card" for="pm_paytabs">
                                <input class="pm-radio" type="radio" name="payment_method" value="{{ \App\Http\Classes\Constants::PAYTABS_STANDARD }}" id="pm_paytabs">
                                <div class="payment-method-body">
                                    <span class="payment-method-title">{{ trans('front.paytabs_payment_msg') }}</span>
                                    <div class="payment-method-logos">
                                        <img src="{{ asset('resources/assets/images/paytabs-logo.svg') }}" alt="Paytabs" onerror="this.style.display='none'">
                                        <img src="{{ asset('resources/assets/images/visa_logo.svg') }}" alt="Visa">
                                        <img src="{{ asset('resources/assets/images/mastercard-logo.svg') }}" alt="Mastercard">
                                        <img src="{{ asset('resources/assets/images/mada-logo.svg') }}" alt="Mada">
                                        <img src="{{ asset('resources/assets/images/apple-pay-logo.svg') }}" alt="Apple Pay">
                                    </div>
                                    <p class="payment-method-note">{{ trans('front.paytabs_policy_msg') }}</p>
                                </div>
                            </label>
                        </div>

                        <div class="summary-card" style="text-align:center;">
                            <button type="submit" class="btn-subscribe-new" style="border:none;padding:14px 40px;border-radius:12px;">
                                <i class="fa fa-credit-card" style="margin-{{ $isRtl ? 'left':'right' }}:8px;"></i>
                                {{ trans('front.pay_now') }}
                            </button>
                        </div>
                    @else
                        <div class="summary-card" style="text-align:center;">
                            <p style="color:#666;font-size:14px;margin-bottom:20px;">
                                {{ trans('front.diet_order_no_gateway_msg') }}
                            </p>
                            <button type="submit" class="btn-subscribe-new" style="border:none;padding:14px 40px;border-radius:12px;">
                                <i class="fa fa-paper-plane" style="margin-{{ $isRtl ? 'left':'right' }}:8px;"></i>
                                {{ trans('front.confirm_order_request') }}
                            </button>
                        </div>
                    @endif

                    <div style="text-align:center;">
                        <a href="{{ route('diet-plan.meals', $subscription->id) }}" style="color:#7e4c8a;font-size:13px;">
                            <i class="fa fa-arrow-{{ $isRtl ? 'right':'left' }}"></i>
                            {{ trans('front.previous') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

@if($gatewayConfigured)
<script>
    document.querySelectorAll('.pm-radio').forEach(function (radio) {
        radio.addEventListener('change', function () {
            document.querySelectorAll('.payment-method-card').forEach(function (card) {
                card.classList.remove('selected');
            });
            radio.closest('.payment-method-card').classList.add('selected');
        });
    });
</script>
@endif
@endsection

@if($gatewayConfigured)
@section('script')
<script src="https://checkout.tabby.ai/tabby-card.js"></script>
<script>
    window.tamaraWidgetConfig = {
        lang: '{{ app()->getLocale() }}',
        country: '{{ env("TAMARA_COUNTRY_CODE", "SA") }}',
        publicKey: '{{ env("TAMARA_PUBLIC_KEY") }}'
    };
</script>
<script defer src="https://cdn.tamara.co/widget-v2/tamara-widget.js"></script>
<script>
    new TabbyCard({
        selector: '#tabbyCard',
        currency: '{{ env("TABBY_CURRENCY") }}',
        lang: '{{ app()->getLocale() }}',
        price: {{ $priceWithVat }},
        size: 'wide',
        theme: 'default',
        header: false,
        publicKey: '{{ env("TABBY_PK") }}',
        merchantCode: '{{ env("TABBY_MERCHANT_CODE") }}'
    });
</script>
@endsection
@endif
