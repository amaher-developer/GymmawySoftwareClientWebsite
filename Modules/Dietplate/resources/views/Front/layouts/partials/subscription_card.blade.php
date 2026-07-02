@php
    // Meals per day = workouts ÷ period  (seeder sets workouts = mealCount × period)
    $mealsPerDay = ($subscription->period > 0)
        ? (int) round($subscription->workouts / $subscription->period)
        : (int) $subscription->workouts;

    // Tier label: extract part after " - " from name  (e.g. "باقة الضخامة - 3 وجبة رئيسية" → "3 وجبة رئيسية")
    $subNameFull = $subscription->name ?? '';
    $dashPos = mb_strpos($subNameFull, ' - ');
    $tierLabel = $dashPos !== false ? mb_substr($subNameFull, $dashPos + 3) : $subNameFull;
    $catLabel  = $dashPos !== false ? mb_substr($subNameFull, 0, $dashPos) : '';

    // Description
    $description = $subscription->content ?? '';

    // Subscribe link — use url() to avoid RouteNotFoundException in any context
    $langPrefix = (isset($lang) && in_array($lang, ['ar','en'])) ? '/' . $lang : '';
    $subscribeUrl = url($langPrefix . '/diet-plan/subscribe/' . $subscription->id);
@endphp
<div class="program-card w-100">
    @if($subscription->getRawOriginal('image'))
        <img src="{{ $subscription->image }}" alt="{{ $tierLabel }}" class="program-card-img">
    @else
        <div class="program-card-img-placeholder">
            <img src="{{ asset('Modules/Dietplate/resources/assets/img/logo.png') }}" alt="{{ $tierLabel }}" style="max-width:60%;max-height:120px;object-fit:contain;opacity:0.85;">
        </div>
    @endif
    <div class="program-card-body">
        @if($catLabel)
        <span style="display:inline-block;background:#f0e6f8;color:#7e4c8a;border-radius:20px;padding:3px 12px;font-size:11px;font-weight:700;margin-bottom:8px;">
            {{ $catLabel }}
        </span>
        @endif
        <h3 class="program-card-title">{{ $tierLabel }}</h3>
        <ul class="program-card-features">
            <li>
                <i class="fa fa-cutlery"></i>
                {{ trans('front.meals_per_day') }}:
                <strong style="margin-right:4px;margin-left:4px;">{{ $mealsPerDay }}</strong>
                {{ trans('front.meal') }}
            </li>
            <li>
                <i class="fa fa-calendar"></i>
                {{ trans('front.starting_from') }}
                <strong style="margin-right:4px;margin-left:4px;">{{ trans('front.select_days_to_see_price') }}</strong>
            </li>
        </ul>
        @if($description)
        <p style="font-size:12px;color:#888;margin-bottom:10px;line-height:1.6;">
            {{ \Illuminate\Support\Str::limit($description, 70) }}
        </p>
        @endif
        <div class="program-card-pricing">
            <a class="btn-subscribe-new" href="{{ $subscribeUrl }}">
                <i class="fa fa-arrow-{{ isset($lang) && $lang === 'en' ? 'right' : 'left' }}" style="margin-left:6px;margin-right:6px;"></i>
                {{ trans('front.select_plan') }}
            </a>
        </div>
    </div>
</div>
