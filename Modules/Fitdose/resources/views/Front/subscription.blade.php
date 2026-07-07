@extends('fitdose::Front.layouts.master')
@section('title'){{ $title }} | @endsection
@section('style')
    @php
        $isRtl = app()->getLocale() === 'ar';
    @endphp
    <style>
        :root {
            --fd-gold: #c8a84b;
            --fd-gold-light: #e8c870;
            --fd-ink: #16181c;
            --fd-muted: #767676;
            --fd-radius: 16px;
        }

        .fd-checkout-page { background: #f7f6f3; padding: 60px 0 80px; }
        .fd-checkout-page h1, .fd-checkout-page h2, .fd-checkout-page h3,
        .fd-checkout-page h4, .fd-checkout-page h5, .fd-checkout-page h6 {
            color: var(--fd-ink);
            text-transform: none;
            letter-spacing: 0;
        }

        .fd-breadcrumb { color: var(--fd-muted); font-size: .9rem; margin-bottom: 24px; }
        .fd-breadcrumb a { color: var(--fd-gold); }

        .fd-card {
            background: #fff;
            border-radius: var(--fd-radius);
            box-shadow: 0 10px 30px rgba(0,0,0,.05);
            padding: 28px;
            margin-bottom: 24px;
        }
        .fd-card h5.fd-card-title {
            font-weight: 800;
            font-size: 1.15rem;
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 1px solid #efece5;
        }

        /* Plan summary */
        .fd-plan-summary { display: flex; gap: 20px; align-items: center; flex-wrap: wrap; }
        .fd-plan-summary img {
            width: 110px; height: 110px; object-fit: cover; border-radius: 14px; flex-shrink: 0;
        }
        .fd-plan-summary .fd-plan-name { font-weight: 800; font-size: 1.3rem; margin-bottom: 10px; }
        .fd-price-old { text-decoration: line-through; color: #aaa; font-size: .85rem; }
        .fd-price-discount { color: #1f9d55; font-size: .85rem; display: block; margin: 2px 0; }
        .fd-price-main { font-size: 1.7rem; font-weight: 800; color: var(--fd-gold); margin: 2px 0; }
        .fd-price-vat { color: var(--fd-muted); font-size: .82rem; display: block; }
        .fd-price-total { font-weight: 700; color: var(--fd-ink); font-size: .95rem; display: block; margin-top: 2px; }

        .fd-alert {
            border-radius: 10px;
            padding: 14px 18px;
            background: #fdeceb;
            color: #b23b3b;
            border: 1px solid #f6c9c6;
            margin-bottom: 20px;
        }

        /* Form fields */
        .fd-checkout-page .form-control {
            border-radius: 10px;
            border: 1px solid #e3e0d8;
            padding: 12px 16px;
            margin-bottom: 14px;
            color: #333 !important;
            height: auto;
        }
        .fd-field-label {
            font-size: .85rem;
            font-weight: 700;
            color: var(--fd-ink);
            margin-bottom: 6px;
            display: block;
        }
        .fd-gender-row { display: flex; gap: 24px; align-items: center; margin-bottom: 14px; }
        .fd-gender-row label { margin: 0; font-size: .92rem; color: #444; cursor: pointer; }
        .fd-gender-row input[type="radio"] { margin-inline-end: 6px; }

        /* Activities picker */
        .fd-activities-hint {
            color: var(--fd-muted);
            font-size: .88rem;
            margin-bottom: 18px;
        }
        .fd-activities-counter {
            display: inline-block;
            background: #f4efe2;
            color: #8a6d1f;
            font-weight: 700;
            font-size: .8rem;
            padding: 4px 12px;
            border-radius: 20px;
            margin-inline-start: 8px;
        }
        .fd-activities-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .fd-activity-option {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border: 2px solid #ecebe6;
            border-radius: 30px;
            background: #fbfaf7;
            font-size: .9rem;
            font-weight: 600;
            color: var(--fd-ink);
            cursor: pointer;
            transition: border-color .2s ease, background .2s ease, color .2s ease;
        }
        .fd-activity-option input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: var(--fd-gold);
            margin: 0;
        }
        .fd-activity-option:has(input:checked) {
            border-color: var(--fd-gold);
            background: #fdf8ec;
            color: #8a6d1f;
        }
        .fd-activity-option.fd-activity-disabled { opacity: .4; cursor: not-allowed; }

        /* Payment methods */
        .fd-payment-option {
            border: 2px solid #ecebe6;
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 16px;
            transition: border-color .2s ease, background .2s ease;
        }
        .fd-payment-option:has(input:checked) { border-color: var(--fd-gold); background: #fdf8ec; }
        .fd-payment-option-head { display: flex; align-items: center; gap: 12px; }
        .fd-payment-option-head input[type="radio"] { width: 20px; height: 20px; flex-shrink: 0; }
        .fd-payment-option-head label { margin: 0; font-weight: 700; color: var(--fd-ink); cursor: pointer; }
        .fd-payment-logos { margin-top: 10px; }
        .fd-payment-logos img {
            height: 32px; width: auto; padding: 4px 8px; margin-inline-end: 6px;
            border: 1px solid #eee; border-radius: 6px; background: #fff; object-fit: contain;
        }
        .fd-payment-policy { font-size: .78rem; color: var(--fd-muted); display: block; margin-top: 8px; }

        .fd-submit-btn {
            width: 100%;
            padding: 15px 0;
            border: none;
            border-radius: 30px;
            background: linear-gradient(135deg, var(--fd-gold), var(--fd-gold-light));
            color: #1a1408;
            font-weight: 800;
            font-size: 1.05rem;
            box-shadow: 0 10px 26px rgba(200,168,75,.4);
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .fd-submit-btn:hover { transform: translateY(-2px); box-shadow: 0 14px 32px rgba(200,168,75,.55); }

        /* Sidebar */
        .fd-sidebar-card ul { list-style: none; padding: 0; margin: 0; }
        .fd-sidebar-card li { border-bottom: 1px solid #f0ede5; }
        .fd-sidebar-card li:last-child { border-bottom: none; }
        .fd-sidebar-card li a {
            display: block;
            padding: 14px 4px;
            color: var(--fd-ink);
            font-weight: 600;
            font-size: .95rem;
            transition: color .2s ease;
        }
        .fd-sidebar-card li a:hover { color: var(--fd-gold); }

        #tabbyCard div:first-child{ background-color: #f5f5f5 !important; }
        #tabbyCard { padding-top: 14px; width: 100%; }
    </style>
@endsection

@section('content')

    @php
        $vatPercentage = @$mainSettings['vat_details']['vat_percentage'] ?? 0;
        $originalPrice = $record['price'];
        $discountType  = $record['default_discount_type'] ?? 0;
        $discountValue = $record['default_discount_value'] ?? 0;
        if ($discountType == 1 && $discountValue > 0) {
            $discountAmount = round(($discountValue / 100) * $originalPrice, 2);
            $discountLabel  = trans('front.discount') . ' (' . $discountValue . '%)';
        } elseif ($discountType == 2 && $discountValue > 0) {
            $discountAmount = round($discountValue, 2);
            $discountLabel  = trans('front.discount');
        } else {
            $discountAmount = 0;
            $discountLabel  = '';
        }
        $priceBeforeVat = round($originalPrice - $discountAmount, 2);
        $vatAmount = ($vatPercentage / 100) * $priceBeforeVat;
        $priceWithVat = (float)round($priceBeforeVat + $vatAmount, 2);
        $activityLimit = (int)($record['activity_limit'] ?? 0);
        $availableActivities = $record->activities ?? collect();
    @endphp

    <div class="fd-checkout-page">
        <div class="container">
            <div class="fd-breadcrumb">
                <a href="{{route('home')}}">{{trans('front.home')}}</a> / {{$title}}
            </div>

            <div class="row">
                <div class="col-lg-8">

                    @if(\Session::has('error'))
                        <div class="fd-alert">{!! \Session::get('error') !!}</div>
                    @endif
                    @if(@$error)<div class="fd-alert">{!! @$error !!}</div>@endif

                    <!-- Plan Summary -->
                    <div class="fd-card">
                        <h5 class="fd-card-title">{{trans('front.order_summary')}}</h5>
                        <div class="fd-plan-summary">
                            @if(!empty($record['image_name']))
                                <img src="{{env('APP_URL_MASTER').'uploads/subscriptions/'.$record['image_name']}}" alt="{{$record['name']}}">
                            @endif
                            <div>
                                <div class="fd-plan-name">{{$record['name']}}</div>
                                @if($discountAmount > 0)
                                    <span class="fd-price-old">{{number_format($originalPrice, 2)}} {{trans('front.pound_unit')}}</span>
                                    <span class="fd-price-discount">{{$discountLabel}}: -{{number_format($discountAmount, 2)}} {{trans('front.pound_unit')}}</span>
                                @endif
                                <span class="fd-price-main">{{number_format($priceBeforeVat, 2)}} {{trans('front.pound_unit')}}</span>
                                @if($vatPercentage > 0)
                                    <span class="fd-price-vat">{{trans('front.vat')}} ({{$vatPercentage}}%): {{number_format($vatAmount, 2)}} {{trans('front.pound_unit')}}</span>
                                    <span class="fd-price-total">{{trans('global.total')}}: {{number_format($priceWithVat, 2)}} {{trans('front.pound_unit')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <form method="post" action="{{route('invoice', @$record->id)}}">
                        {{csrf_field()}}
                        <input type="hidden" name="subscription_id" value="{{$record['id']}}">
                        <input type="hidden" name="amount" value="{{$priceWithVat}}">
                        <input type="hidden" name="vat_percentage" value="{{@$mainSettings['vat_details']['vat_percentage']}}">
                        <input type="hidden" name="payment_channel" value="2">

                        @if($activityLimit > 0 && $availableActivities->count() > 0)
                        <!-- Activities Selection -->
                        <div class="fd-card">
                            <h5 class="fd-card-title">
                                {{trans('front.choose_activities')}}
                                <span class="fd-activities-counter" id="fdActivitiesCounter">{{trans('front.activities_selected_count', ['count' => 0, 'limit' => $activityLimit])}}</span>
                            </h5>
                            <p class="fd-activities-hint">{{trans('front.choose_activities_hint', ['limit' => $activityLimit])}}</p>
                            <div class="fd-activities-grid" id="fdActivitiesGrid"
                                 data-limit="{{$activityLimit}}"
                                 data-template="{{trans('front.activities_selected_count', ['count' => '__COUNT__', 'limit' => $activityLimit])}}">
                                @foreach($availableActivities as $activity)
                                <label class="fd-activity-option">
                                    <input type="checkbox" name="activities[]" value="{{$activity->id}}">
                                    {{$activity->name}}
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if(!$currentUser)
                        <!-- Guest Registration -->
                        <div class="fd-card">
                            <h5 class="fd-card-title">{{trans('front.register_info')}}</h5>
                            <label class="fd-field-label">{{trans('front.name')}}</label>
                            <input type="text" name="name" class="form-control" placeholder="{{trans('front.name')}}" required>
                            <label class="fd-field-label">{{trans('front.phone')}}</label>
                            <input type="text" name="phone" class="form-control" placeholder="{{trans('front.phone')}}" required>
                            <label class="fd-field-label">{{trans('front.gender')}}</label>
                            <div class="fd-gender-row">
                                <label for="male"><input type="radio" name="gender" value="{{\App\Http\Classes\Constants::MALE}}" id="male" required> {{trans('front.male')}}</label>
                                <label for="female"><input type="radio" name="gender" value="{{\App\Http\Classes\Constants::FEMALE}}" id="female" required> {{trans('front.female')}}</label>
                            </div>
                            <label class="fd-field-label">{{trans('front.birthdate')}}</label>
                            <input type="date" name="dob" class="form-control" required>
                            <label class="fd-field-label">{{trans('front.address')}}</label>
                            <input type="text" name="address" class="form-control" placeholder="{{trans('front.address')}}" required>
                        </div>
                        @endif

                        <!-- Joining Date -->
                        <div class="fd-card">
                            <h5 class="fd-card-title">{{trans('front.register_info_joining_date')}}</h5>
                            <input type="date" name="joining_date" class="form-control"
                                   value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                   min="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                   max="{{\Carbon\Carbon::now()->addMonths(12)->format('Y-m-d')}}"
                                   required>
                        </div>

                        <!-- Payment Methods -->
                        <div class="fd-card">
                            <h5 class="fd-card-title">{{trans('front.choose_payment_methods')}}</h5>

                            @if($mainSettings->hasPaymentGateway('tabby'))
                            <div class="fd-payment-option">
                                <div class="fd-payment-option-head">
                                    <input type="radio" id="tabby" name="payment_method" value="2">
                                    <label for="tabby">{{trans('front.tabby_installment_msg')}}</label>
                                </div>
                                <div class="fd-payment-logos">
                                    <img src="{{asset('resources/assets/images/tabby-logo.webp')}}" alt="Tabby">
                                    <span class="fd-payment-policy">{{trans('front.tabby_policy_msg')}}</span>
                                </div>
                                <div id="tabbyCard" class="row col-md-12 col-xs-12"></div>
                            </div>
                            @endif

                            @if($mainSettings->hasPaymentGateway('tamara'))
                            <div class="fd-payment-option">
                                <div class="fd-payment-option-head">
                                    <input type="radio" id="tamara" name="payment_method" value="4">
                                    <label for="tamara">{{trans('front.tamara_installment_msg')}}</label>
                                </div>
                                <div class="fd-payment-logos">
                                    <img src="https://cdn.tamara.co/assets/png/tamara-logo-badge-{{ app()->getLocale() == 'ar' ? 'ar' : 'en' }}.png" alt="Tamara">
                                    <span class="fd-payment-policy">{{trans('front.tamara_policy_msg')}}</span>
                                </div>
                                <div class="row col-md-12 col-xs-12" style="padding-top: 10px;">
                                    <tamara-widget type="tamara-summary" amount="{{$priceWithVat}}" inline-type="2"></tamara-widget>
                                </div>
                            </div>
                            @endif

                            @if($mainSettings->hasPaymentGateway('paytabs'))
                            <div class="fd-payment-option">
                                <div class="fd-payment-option-head">
                                    <input type="radio" id="paytabs" name="payment_method" value="5">
                                    <label for="paytabs">{{trans('front.paytabs_payment_msg')}}</label>
                                </div>
                                <div class="fd-payment-logos">
                                    <img src="{{asset('resources/assets/images/paytabs-logo.svg')}}" alt="Paytabs" onerror="this.style.display='none'">
                                    <img src="{{asset('resources/assets/images/visa_logo.svg')}}" alt="Visa">
                                    <img src="{{asset('resources/assets/images/mastercard-logo.svg')}}" alt="Mastercard">
                                    <img src="{{asset('resources/assets/images/mada-logo.svg')}}" alt="Mada">
                                    <img src="{{asset('resources/assets/images/apple-pay-logo.svg')}}" alt="Apple Pay">
                                    <span class="fd-payment-policy">{{trans('front.paytabs_policy_msg')}}</span>
                                </div>
                            </div>
                            @endif
                        </div>

                        <input class="fd-submit-btn" type="submit" value="{{trans('front.pay_now')}}">
                    </form>
                </div>

                <div class="col-lg-4">
                    <div class="fd-card fd-sidebar-card">
                        <h5 class="fd-card-title">{{trans('front.other_subscriptions')}}</h5>
                        <ul>
                            @foreach($subscriptions as $subscription)
                                @if($subscription->id != $record['id'])
                                    <li>
                                        <a href="{{route('subscription', ['id' => $subscription->id])}}">{{$subscription->name}}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    @if($mainSettings->hasPaymentGateway('tabby'))
    <script src="https://checkout.tabby.ai/tabby-card.js"></script>
    <script>
        new TabbyCard({
            selector: '#tabbyCard', // empty div for TabbyCard.
            currency: '{{$mainSettings->payments['tabby']['currency'] ?? env('TABBY_CURRENCY')}}', // required, currency of your product. AED|SAR|KWD|BHD|QAR only supported, with no spaces or lowercase.
            lang: '{{app()->getLocale()}}', // language of snippet and popups.
            price: {{$priceWithVat}}, // required, total price or the cart. 2 decimals max for AED|SAR|QAR and 3 decimals max for KWD|BHD.
            size: 'wide', // required, can be also 'wide', depending on the width.
            theme: 'black', // required, can be also 'default'.
            header: false, // if a Payment method name present already.
            publicKey: '{{$mainSettings->payments['tabby']['public_key'] ?? env('TABBY_PK')}}', // required, your Tabby public key.
            merchantCode: '{{$mainSettings->payments['tabby']['merchant_code'] ?? env('TABBY_MERCHANT_CODE')}}' // required, your Tabby merchant code.
        });
    </script>
    @endif
    @if($mainSettings->hasPaymentGateway('tamara'))
    <script>
        window.tamaraWidgetConfig = {
            lang: '{{app()->getLocale()}}',
            country: '{{env("TAMARA_COUNTRY_CODE", "SA")}}',
            publicKey: '{{env("TAMARA_PUBLIC_KEY")}}'
        };
    </script>
    <script defer src="https://cdn.tamara.co/widget-v2/tamara-widget.js"></script>
    @endif

    <script>
        (function () {
            var grid = document.getElementById('fdActivitiesGrid');
            if (!grid) return;
            var limit = parseInt(grid.getAttribute('data-limit'), 10) || 0;
            var template = grid.getAttribute('data-template') || '';
            var counter = document.getElementById('fdActivitiesCounter');
            var checkboxes = grid.querySelectorAll('input[type="checkbox"]');

            function updateState() {
                var checkedCount = grid.querySelectorAll('input[type="checkbox"]:checked').length;
                if (counter) counter.textContent = template.replace('__COUNT__', checkedCount);
                checkboxes.forEach(function (cb) {
                    var option = cb.closest('.fd-activity-option');
                    if (!cb.checked && checkedCount >= limit) {
                        cb.disabled = true;
                        option.classList.add('fd-activity-disabled');
                    } else {
                        cb.disabled = false;
                        option.classList.remove('fd-activity-disabled');
                    }
                });
            }

            checkboxes.forEach(function (cb) {
                cb.addEventListener('change', updateState);
            });
            updateState();
        })();
    </script>
@endsection
