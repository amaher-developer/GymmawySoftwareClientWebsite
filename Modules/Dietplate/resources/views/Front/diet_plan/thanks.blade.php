@extends('Dietplate::Front.layouts.master')
@section('title'){{ $title }} | @endsection
@section('style')
@php $isRtl = app()->getLocale() === 'ar'; @endphp
<style>
.hero_in.general:before {
    background: url({{asset('resources/assets/front/img/bg/articles.jpg')}}) center center no-repeat;
    -webkit-background-size: cover; background-size: cover;
}
.diet-thanks-sec { padding: 80px 0; background: #f9f5ff; text-align: center; }
.diet-thanks-card {
    background: #fff; border-radius: 16px; padding: 48px 32px;
    box-shadow: 0 4px 20px rgba(126,76,138,0.10); max-width: 520px; margin: 0 auto;
}
.diet-thanks-icon { font-size: 56px; color: #7e4c8a; margin-bottom: 20px; }
.diet-thanks-title { font-size: 22px; font-weight: 800; color: #333; margin-bottom: 14px; }
.diet-thanks-msg { font-size: 15px; color: #666; line-height: 1.8; }
</style>
@endsection

@section('content')
<section class="page-title-sec over-layer-black">
    <div id="particles-js"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>{{ $title }}</h2>
                <p><a href="{{ route('home') }}">{{ trans('front.home') }}</a></p>
            </div>
        </div>
    </div>
</section>

<section class="diet-thanks-sec">
    <div class="container">
        <div class="diet-thanks-card">
            <div class="diet-thanks-icon"><i class="fa fa-check-circle"></i></div>
            <div class="diet-thanks-title">{{ trans('front.thank_you') }}</div>
            <p class="diet-thanks-msg">{{ trans('front.diet_order_received_msg') }}</p>
            <br>
            <a href="{{ route('home') }}" class="btn-subscribe-new" style="display:inline-block;padding:12px 32px;border-radius:12px;">
                {{ trans('front.home') }}
            </a>
        </div>
    </div>
</section>
@endsection
