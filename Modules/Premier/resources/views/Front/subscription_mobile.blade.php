<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    @php
        $isRtl = app()->getLocale() === 'ar';
        $textAlign = $isRtl ? 'right' : 'left';

        $vatPercentage = @$mainSettings['vat_details']['vat_percentage'] ?? 0;
        $priceBeforeVat = $record['price'];
        $vatAmount = ($vatPercentage / 100) * $priceBeforeVat;
        $priceWithVat = $priceBeforeVat + $vatAmount;
        $priceWithVat = (float)round($priceWithVat, 2);
    @endphp
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #fff;
            margin: 0;
            padding: 15px;
            direction: {{ $isRtl ? 'rtl' : 'ltr' }};
            text-align: {{ $textAlign }};
            color: #333;
        }
        .subscription-header {
            margin-bottom: 15px;
        }
        .subscription-header h4 {
            font-size: 18px;
            margin: 0 0 10px;
        }
        .price-box {
            background: #f5f5f5;
            border-radius: 5px;
            padding: 10px;
            font-size: 14px;
            color: #f97d04;
            line-height: 1.8;
            margin-bottom: 10px;
        }
        .price-box small { font-size: 12px; color: #555; }
        .section-title {
            font-size: 15px;
            margin: 15px 0 8px;
            text-align: {{ $textAlign }};
        }
        .highlight-text {
            border-radius: 10px;
            border: 1px solid grey;
            padding: 10px;
            margin-bottom: 12px;
        }
        .payment-option {
            border-radius: 10px;
            border: 1px solid #f97d04;
            padding: 12px;
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .payment-option input[type="radio"] {
            margin-top: 4px;
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }
        .payment-option .payment-details { flex: 1; }
        .payment-option label {
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            display: block;
            margin-bottom: 5px;
        }
        .payment-option img {
            width: 80px;
            padding: 5px;
            border: 1px solid grey;
            border-radius: 5px;
            margin-top: 5px;
        }
        .payment-option .policy-msg {
            font-size: 11px;
            color: #666;
            vertical-align: bottom;
        }
        #tabbyCard { padding-top: 10px; width: 100%; }
        #tabbyCard div:first-child { background-color: #f5f5f5 !important; }
        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        .gender-row {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 8px 0;
        }
        .gender-row label { font-size: 14px; margin: 0; }
        .gender-row input[type="radio"] { width: 18px; height: 18px; }
        .btn-pay {
            width: 100%;
            padding: 14px;
            background: #f97d04;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn-pay:active { background: #e06c00; }
        .alert { padding: 10px; border-radius: 5px; margin-bottom: 10px; font-size: 13px; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        ::placeholder { color: #bbb !important; }
    </style>
</head>
<body>

    @if(\Session::has('error'))
        <div class="alert alert-danger">{!! \Session::get('error') !!}</div>
    @endif
    @if(@$error)
        <div class="alert alert-danger">{!! @$error !!}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-{{ $isRtl ? 'right' : 'left' }}: 15px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="subscription-header">
        <h4>{{ $record['name'] }}</h4>
        <div class="price-box">
            {{trans('front.price')}}: {{ number_format($priceBeforeVat, 2) }} {{trans('front.pound_unit')}}<br>
            @if($vatPercentage > 0)
                <small>{{trans('front.vat')}} ({{ $vatPercentage }}%): {{ number_format($vatAmount, 2) }} {{trans('front.pound_unit')}}</small><br>
                <strong>{{trans('global.total')}}: {{ $priceWithVat }} {{trans('front.pound_unit')}}</strong>
            @endif
        </div>
    </div>

    <form method="post" action="{{ route('invoice', @$record->id) }}">
        {{ csrf_field() }}
        <input type="hidden" name="subscription_id" value="{{ $record['id'] }}">
        <input type="hidden" name="amount" value="{{ $priceWithVat }}">
        <input type="hidden" name="vat_percentage" value="{{ @$mainSettings['vat_details']['vat_percentage'] }}">
        <input type="hidden" name="payment_channel" value="3">

        @if(!$currentUser)
            <h5 class="section-title">{{trans('front.register_info')}}:</h5>
            <div class="highlight-text">
                <input type="text" name="name" class="form-control" placeholder="{{trans('front.name')}}" value="{{ old('name') }}" required>
                <input type="text" name="phone" class="form-control" placeholder="{{trans('front.phone')}}" value="{{ old('phone') }}" required>
                <div class="gender-row">
                    <input type="radio" name="gender" value="{{ \App\Http\Classes\Constants::MALE }}" id="male_m" {{ old('gender') == \App\Http\Classes\Constants::MALE ? 'checked' : '' }} required>
                    <label for="male_m">{{trans('front.male')}}</label>
                    <input type="radio" name="gender" value="{{ \App\Http\Classes\Constants::FEMALE }}" id="female_m" {{ old('gender') == \App\Http\Classes\Constants::FEMALE ? 'checked' : '' }}>
                    <label for="female_m">{{trans('front.female')}}</label>
                </div>
                <input type="date" name="dob" class="form-control" placeholder="{{trans('front.birthdate')}}" value="{{ old('dob') }}" required>
                <input type="text" name="address" class="form-control" placeholder="{{trans('front.address')}}" value="{{ old('address') }}" required>
            </div>
        @endif

        <h5 class="section-title">{{trans('front.register_info_joining_date')}}:</h5>
        <div class="highlight-text">
            <input type="date" name="joining_date" class="form-control"
                   value="{{ old('joining_date', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                   max="{{ \Carbon\Carbon::now()->addMonths(6)->format('Y-m-d') }}"
                   required>
        </div>

        <h5 class="section-title">{{trans('front.choose_payment_methods')}}:</h5>

        <div class="payment-option">
            <input type="radio" name="payment_method" value="2" id="tabby_m" {{ old('payment_method') == '2' ? 'checked' : '' }}>
            <div class="payment-details">
                <label for="tabby_m">{{trans('front.tabby_installment_msg')}}</label>
                <img src="{{ asset('resources/assets/images/tabby-logo.webp') }}" alt="Tabby">
                <span class="policy-msg">{{trans('front.tabby_policy_msg')}}</span>
                <div id="tabbyCard"></div>
            </div>
        </div>

        <div class="payment-option">
            <input type="radio" name="payment_method" value="4" id="tamara_m" {{ old('payment_method') == '4' ? 'checked' : '' }}>
            <div class="payment-details">
                <label for="tamara_m">{{trans('front.tamara_installment_msg')}}</label>
                <img src="https://cdn.tamara.co/assets/png/tamara-logo-badge-{{ app()->getLocale() == 'ar' ? 'ar' : 'en' }}.png" alt="Tamara">
                <span class="policy-msg">{{trans('front.tamara_policy_msg')}}</span>
                <div style="padding-top: 10px;">
                    <tamara-widget type="tamara-summary" amount="{{ $priceWithVat }}" inline-type="2"></tamara-widget>
                </div>
            </div>
        </div>

        <button type="submit" class="btn-pay">{{trans('front.pay_now')}}</button>
    </form>

    <script>
        window.tamaraWidgetConfig = {
            lang: '{{ app()->getLocale() }}',
            country: '{{ env("TAMARA_COUNTRY_CODE", "SA") }}',
            publicKey: '{{ env("TAMARA_PUBLIC_KEY") }}'
        };
    </script>
    <script defer src="https://cdn.tamara.co/widget-v2/tamara-widget.js"></script>
    <script src="https://checkout.tabby.ai/tabby-card.js"></script>
    <script>
        new TabbyCard({
            selector: '#tabbyCard',
            currency: '{{ env("TABBY_CURRENCY") }}',
            lang: '{{ app()->getLocale() }}',
            price: {{ $priceWithVat }},
            size: 'wide',
            theme: 'black',
            header: false,
            publicKey: '{{ env("TABBY_PK") }}',
            merchantCode: '{{ env("TABBY_MERCHANT_CODE") }}'
        });
    </script>
</body>
</html>
