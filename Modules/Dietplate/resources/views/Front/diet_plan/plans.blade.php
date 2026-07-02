@extends('Dietplate::Front.layouts.master')
@section('title'){{ $title }} | @endsection
@section('style')
@php $isRtl = app()->getLocale() === 'ar'; @endphp
<style>
.hero_in.general:before {
    background: url({{asset('resources/assets/front/img/bg/articles.jpg')}}) center center no-repeat;
    -webkit-background-size: cover; background-size: cover;
}
/* Plans grid */
.diet-plans-sec { padding: 60px 0 80px; background: #f9f5ff; }
.diet-plans-sec .default-title h2 span { color: #7e4c8a; }
.plan-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(126,76,138,0.10);
    transition: transform 0.25s, box-shadow 0.25s;
    margin-bottom: 28px;
    display: flex;
    flex-direction: column;
}
.plan-card:hover { transform: translateY(-6px); box-shadow: 0 12px 36px rgba(126,76,138,0.18); }
.plan-card-img {
    width: 100%; height: 200px; object-fit: cover;
}
.plan-card-img-placeholder {
    width: 100%; height: 200px;
    background: linear-gradient(135deg, #f0e6f8, #e8d8f5);
    display: flex; align-items: center; justify-content: center;
}
.plan-card-body { padding: 20px; flex: 1; display: flex; flex-direction: column; }
.plan-card-title { font-size: 17px; font-weight: 700; color: #333; margin-bottom: 10px; }
.plan-card-meta { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 14px; }
.plan-meta-badge {
    background: #f0e6f8; color: #7e4c8a;
    border-radius: 20px; padding: 4px 12px; font-size: 12px; font-weight: 600;
}
.plan-card-price { margin-top: auto; }
.plan-price-amount { font-size: 22px; font-weight: 800; color: #7e4c8a; }
.plan-price-unit { font-size: 13px; color: #888; margin-{{ $isRtl ? 'right' : 'left' }}: 4px; }
.btn-plan-select {
    display: block; width: 100%; margin-top: 14px;
    background: #7e4c8a; color: #fff;
    border: none; border-radius: 10px;
    padding: 12px; font-size: 15px; font-weight: 700;
    text-align: center; text-decoration: none;
    transition: background 0.2s, transform 0.2s;
}
.btn-plan-select:hover { background: #5d3368; color: #fff; transform: translateY(-2px); }
.breadcrumb-sec { background: transparent; }
</style>
@endsection

@section('content')
<!-- Page title -->
<section class="page-title-sec over-layer-black">
    <div id="particles-js"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>{{ $category->name }}</h2>
                <p>
                    <a href="{{ route('home') }}">{{ trans('front.home') }}</a>
                    /
                    <a href="{{ route('home') }}#subscriptions">{{ trans('front.subscriptions') }}</a>
                    /
                    <span>{{ $category->name }}</span>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Plans Section -->
<section class="diet-plans-sec">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="default-title text-center">
                    <h2><span>{{ $category->name }}</span></h2>
                    <div class="title-bdr"><div class="title-bdr-inside"></div></div>
                    <p>{{ trans('front.choose_plan_for_category') }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($plans as $plan)
            @php
                $mealCount = $plan->workouts > 0 ? (int)round($plan->workouts / 30) : 1;
                $planNameParts = explode(' - ', $plan->name);
                $planSubTitle = count($planNameParts) > 1 ? $planNameParts[1] : '';
            @endphp
            <div class="col-lg-3 col-md-6 d-flex">
                <div class="plan-card w-100">
                    @if($plan->getRawOriginal('image'))
                        <img src="{{ $plan->image }}" alt="{{ $plan->name }}" class="plan-card-img">
                    @else
                        <div class="plan-card-img-placeholder">
                            <img src="{{ $category->image }}" alt="{{ $plan->name }}" style="max-width:70%;max-height:150px;object-fit:contain;opacity:0.75;">
                        </div>
                    @endif
                    <div class="plan-card-body">
                        <h3 class="plan-card-title">{{ $plan->name }}</h3>
                        <div class="plan-card-meta">
                            <span class="plan-meta-badge">
                                <i class="fa fa-cutlery"></i>
                                {{ $mealCount }} {{ trans('front.main_meal') }}
                            </span>
                            <span class="plan-meta-badge">
                                <i class="fa fa-calendar"></i>
                                {{ $plan->period }} {{ trans('front.day') }}
                            </span>
                        </div>
                        @if($plan->content)
                            <p style="font-size:13px;color:#666;margin-bottom:12px;">{{ Str::limit($plan->content, 80) }}</p>
                        @endif
                        <div class="plan-card-price">
                            <span class="plan-price-amount">{{ trans('front.starting_from') }}</span>
                            <span class="plan-price-unit">{{ trans('front.select_days_to_see_price') }}</span>
                        </div>
                        <a href="{{ route('diet-plan.subscribe', $plan->id) }}" class="btn-plan-select">
                            <i class="fa fa-arrow-{{ $isRtl ? 'left' : 'right' }}"></i>
                            {{ trans('front.select_plan') }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
