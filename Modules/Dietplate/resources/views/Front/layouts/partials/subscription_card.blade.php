@php
    $vatPercentage = @$mainSettings['vat_details']['vat_percentage'] ?? 0;
    $originalPrice = $subscription->price;
    $discountType  = $subscription->default_discount_type ?? 0;
    $discountValue = $subscription->default_discount_value ?? 0;
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
    $vatAmount      = ($vatPercentage / 100) * $priceBeforeVat;
    $priceWithVat   = round($priceBeforeVat + $vatAmount, 2);
@endphp
<div class="program-card w-100">
    @if($subscription->image)
        <img src="{{ $subscription->image }}" alt="{{ $subscription->name }}" class="program-card-img">
    @else
        <div class="program-card-img-placeholder">
            <img src="{{ asset('Modules/Dietplate/resources/assets/img/logo.png') }}" alt="{{ $subscription->name }}" style="max-width:60%;max-height:120px;object-fit:contain;opacity:0.85;">
        </div>
    @endif
    <div class="program-card-body">
        <h3 class="program-card-title">{{ $subscription->name }}</h3>
        <ul class="program-card-features">
            <li>
                <i class="fa fa-calendar"></i>
                {{trans('front.period')}}: <strong style="margin-right:4px;margin-left:4px;">{{ $subscription->period }}</strong> {{trans('front.day')}}
            </li>
            <li>
                <i class="fa fa-check-circle"></i>
                {{trans('front.session_num')}}: <strong style="margin-right:4px;margin-left:4px;">{{ $subscription->workouts }}</strong>
            </li>
        </ul>
        <div class="program-card-pricing">
            @if($discountAmount > 0)
                <span class="program-card-old-price">{{number_format($originalPrice, 2)}} {{trans('front.pound_unit')}}</span>
                <span class="program-card-discount-label">{{ $discountLabel }}: -{{number_format($discountAmount, 2)}} {{trans('front.pound_unit')}}</span>
            @endif
            <span class="program-card-price">{{number_format($priceBeforeVat, 2)}}</span>
            <span class="program-card-price-unit">{{trans('front.pound_unit')}}</span>
            @if($vatPercentage > 0)
                <span class="program-card-vat">+ {{trans('front.vat')}} ({{$vatPercentage}}%): {{number_format($vatAmount, 2)}} {{trans('front.pound_unit')}}</span>
                <span class="program-card-total">{{trans('global.total') ?? 'الإجمالي'}}: {{number_format($priceWithVat, 2)}} {{trans('front.pound_unit')}}</span>
            @endif
            <a class="btn-subscribe-new" href="{{route('subscription', ['id' => $subscription->id])}}">
                <i class="fa fa-shopping-cart" style="margin-left:6px;margin-right:6px;"></i> {{trans('front.subscribe')}}
            </a>
        </div>
    </div>
</div>
