@extends('sixtyminutes::Front.layouts.master')
@section('style')
<style>
    /* ── Modern pricing / subscription cards ── */
    #subscriptions.sm-pricing-sec {
        background: radial-gradient(ellipse at top, #1b1b1b 0%, #000 70%);
        padding: 90px 0;
    }
    #subscriptions.sm-pricing-sec .default-title h2 {
        color: #ffffff;
    }
    #subscriptions.sm-pricing-sec .default-title p {
        color: #eeeeee;
    }
    #subscriptions.sm-pricing-sec .title-bdr {
        background: #ffffff;
    }
    #subscriptions .sm-pricing-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 28px;
        margin-top: 20px;
    }
    #subscriptions .sm-plan-card {
        position: relative;
        background: linear-gradient(160deg, rgba(28,28,28,0.96), rgba(8,8,8,0.92));
        border: 1px solid rgba(117,192,67,0.22);
        border-radius: 20px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
    }
    #subscriptions .sm-plan-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 22px 48px rgba(117,192,67,0.28);
        border-color: #75c043;
    }
    #subscriptions .sm-plan-card.sm-featured {
        border-color: #75c043;
        background: linear-gradient(160deg, rgba(30,42,20,0.96), rgba(8,8,8,0.95));
    }
    #subscriptions .sm-featured-badge {
        position: absolute;
        top: 14px;
        {{ $lang == 'ar' ? 'right: 14px;' : 'left: 14px;' }}
        z-index: 2;
        background: linear-gradient(135deg, #75c043, #9ee36b);
        color: #0d1a05;
        font-weight: 800;
        font-size: 0.72rem;
        padding: 6px 14px;
        border-radius: 20px;
        box-shadow: 0 4px 14px rgba(117,192,67,0.55);
    }
    #subscriptions .sm-plan-img-wrap {
        width: 100%;
        height: 170px;
        overflow: hidden;
        background: #101010;
    }
    #subscriptions .sm-plan-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.45s ease;
    }
    #subscriptions .sm-plan-card:hover .sm-plan-img-wrap img {
        transform: scale(1.08);
    }
    #subscriptions .sm-plan-body {
        padding: 24px 26px 28px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    #subscriptions .sm-plan-name {
        font-size: 21px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 4px;
    }
    #subscriptions .sm-plan-desc {
        color: #9a9a9a;
        font-size: 13px;
        min-height: 18px;
        margin-bottom: 14px;
    }
    #subscriptions .sm-plan-meta {
        list-style: none;
        padding: 0;
        margin: 0 0 18px;
    }
    #subscriptions .sm-plan-meta li {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 7px 0;
        border-bottom: 1px solid rgba(255,255,255,0.07);
        font-size: 13px;
        color: #d8d8d8;
    }
    #subscriptions .sm-plan-meta li i {
        color: #75c043;
        width: 16px;
        text-align: center;
    }
    #subscriptions .sm-price-block {
        margin: auto 0 20px;
    }
    #subscriptions .sm-price-old {
        display: block;
        text-decoration: line-through;
        color: #777;
        font-size: 13px;
    }
    #subscriptions .sm-price-discount {
        display: block;
        color: #9ee36b;
        font-size: 12px;
        margin: 3px 0;
        font-weight: 700;
    }
    #subscriptions .sm-price-main {
        font-size: 28px;
        font-weight: 800;
        color: #75c043;
        margin: 2px 0;
    }
    #subscriptions .sm-price-vat {
        display: block;
        color: #9a9a9a;
        font-size: 11px;
    }
    #subscriptions .sm-price-total {
        display: block;
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        margin-top: 3px;
    }
    #subscriptions .sm-plan-cta {
        display: block;
        width: 100%;
        text-align: center;
        padding: 12px 0;
        border-radius: 30px;
        background: transparent;
        border: 2px solid #75c043;
        color: #9ee36b !important;
        font-weight: 700;
        text-decoration: none !important;
        transition: background 0.25s ease, color 0.25s ease;
    }
    #subscriptions .sm-plan-cta:hover,
    #subscriptions .sm-featured .sm-plan-cta {
        background: linear-gradient(135deg, #75c043, #9ee36b);
        color: #0d1a05 !important;
    }

    @media only screen and (max-width: 576px) {
        #subscriptions.sm-pricing-sec { padding: 60px 0; }
        #subscriptions .sm-plan-img-wrap { height: 140px; }
        #subscriptions .sm-price-main { font-size: 24px; }
        #subscriptions .sm-plan-card:hover { transform: none; }
        #subscriptions .sm-plan-card.sm-featured { transform: none; }
    }

    /* ── Modern activities grid ── */
    #activities.sm-activities-sec {
        background: #0d0d0d;
        padding: 90px 0;
    }
    #activities.sm-activities-sec .default-title h2 {
        color: #ffffff;
    }
    #activities.sm-activities-sec .title-bdr {
        background: #ffffff;
    }
    #activities .sm-activities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 24px;
        margin-top: 20px;
    }
    #activities .sm-activity-card {
        position: relative;
        border-radius: 18px;
        overflow: hidden;
        height: 220px;
        background-color: #1c1c1c;
        background-size: cover;
        background-position: center;
        border: 1px solid rgba(117,192,67,0.18);
        box-shadow: 0 14px 34px rgba(0,0,0,0.35);
        transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
    }
    #activities .sm-activity-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 44px rgba(117,192,67,0.3);
        border-color: #75c043;
    }
    #activities .sm-activity-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(13,13,13,0.1) 30%, rgba(13,13,13,0.92) 100%);
        transition: background 0.35s ease;
    }
    #activities .sm-activity-icon {
        position: absolute;
        top: 16px;
        {{ $lang == 'ar' ? 'right: 16px;' : 'left: 16px;' }}
        z-index: 2;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, #75c043, #9ee36b);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0d1a05;
        font-size: 16px;
        box-shadow: 0 6px 16px rgba(117,192,67,0.5);
    }
    #activities .sm-activity-body {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 2;
        padding: 20px;
    }
    #activities .sm-activity-body h5 {
        color: #fff;
        font-weight: 700;
        font-size: 17px;
        margin: 0;
    }
    /* Fallback variant for activities without an uploaded photo */
    #activities .sm-activity-card.sm-activity-noimg {
        background-image: none !important;
        background: linear-gradient(160deg, #1c1c1c 0%, #2a2a2a 100%);
        border-color: rgba(117,192,67,0.3);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        gap: 14px;
        padding: 20px;
    }
    #activities .sm-activity-card.sm-activity-noimg::before { display: none; }
    #activities .sm-activity-card.sm-activity-noimg .sm-activity-icon {
        position: static;
        width: 60px;
        height: 60px;
        font-size: 22px;
    }
    #activities .sm-activity-card.sm-activity-noimg .sm-activity-body {
        position: static;
        padding: 0;
    }

    @media only screen and (max-width: 576px) {
        #activities.sm-activities-sec { padding: 60px 0; }
        #activities .sm-activity-card { height: 190px; }
        #activities .sm-activity-card:hover { transform: none; }
    }
</style>
@endsection
@section('content')
<!-- Main Slider Start -->
<section class="main-slider-sec">
    <!-- Pogo Silder Start -->
    <div class="pogoSlider" id="pogo-slider">
        @foreach($banners as $banner)
        <div class="pogoSlider-slide" data-transition="shrinkReveal" data-duration="1000" style="background-image:url({{$banner}});">
            <!-- Slider Elements -->
            <div class="silder-elements">
                <h2 class="pogoSlider-slide-element slider-main-title" data-in="slideDown" data-out="slideUp" data-duration="750" data-delay="500"> <span>{{$mainSettings['name']}}</span></h2>
                <!--                <p class="pogoSlider-slide-element slider-para" data-in="slideUp" data-out="slideUp" data-duration="1500" data-delay="500">اللياقة ضرورية لكل إنسان</p>-->
                <a href="#contact" class="btn btn-default pogoSlider-slide-element join-btn" data-in="expand" data-out="slideUp" data-duration="1500" data-delay="500" type="submit">{{trans('front.join_us')}}</a>
            </div>
        </div>
    @endforeach
    <!--        <div class="pogoSlider-slide" data-transition="shrinkReveal" data-duration="1000" style="background-image:url(images/rtl-images/slider/2.jpg);">-->
        <!---->
        <!--            <div class="silder-elements">-->
        <!--                <h2 class="pogoSlider-slide-element slider-main-title" data-in="slideDown" data-out="slideUp" data-duration="750" data-delay="500">كن قويا مع  <span>Fitme</span></h2>-->
        <!--                <p class="pogoSlider-slide-element slider-para" data-in="slideUp" data-out="slideUp" data-duration="1500" data-delay="500">اللياقة البدنية ضرورية لكل إنسان</p>-->
        <!--                <button class="btn btn-default pogoSlider-slide-element join-btn" data-in="expand" data-out="slideUp" data-duration="1500" data-delay="500" type="submit">انضم إلينا</button>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="pogoSlider-slide" data-transition="shrinkReveal" data-duration="1000" style="background-image:url(images/rtl-images/slider/3.jpg);">-->

        <!--            <div class="silder-elements">-->
        <!--                <h2 class="pogoSlider-slide-element slider-main-title" data-in="slideDown" data-out="slideUp" data-duration="750" data-delay="500">كن قويا مع  <span>Fitme</span></h2>-->
        <!--                <p class="pogoSlider-slide-element slider-para" data-in="slideUp" data-out="slideUp" data-duration="1500" data-delay="500">اللياقة البدنية ضرورية لكل إنسان</p>-->
        <!--                <button class="btn btn-default pogoSlider-slide-element join-btn" data-in="expand" data-out="slideUp" data-duration="1500" data-delay="500" type="submit">انضم إلينا</button>-->
        <!--            </div>-->
        <!--        </div>-->
    </div>
    <!--Pogo Silder End -->
</section>

<!-- Features Section Start -->
<!--<section class="features-sec">-->
<!--    <div class="container">-->
<!--        <div class="row justify-content-center animatedParent animateOnce">-->
<!--            <div class="col-lg-4 col-md-6 animated bounceInUp slow">-->
<!--                <div class="features-col col-default-mb30 ">-->
<!--                    <div class="features-img">-->
<!--                        <img src="images/rtl-images/features/1.jpg" alt="">-->
<!--                        <div class="features-title">-->
<!--                            <h3>رفع الاثقال</h3>-->
<!--                            <p>اجعل جسمك لائقًا</p>-->
<!--                        </div>-->
<!--                        <div class="features-content">-->
<!--                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل </p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4 col-md-6 animated bounceInUp slow delay-250">-->
<!--                <div class="features-col col-default-mb30">-->
<!--                    <div class="features-img">-->
<!--                        <img src="images/rtl-images/features/2.jpg" alt="">-->
<!--                        <div class="features-title">-->
<!--                            <h3>تدريب اليوجا</h3>-->
<!--                            <p>اجعل جسمك لائقًا</p>-->
<!--                        </div>-->
<!--                        <div class="features-content">-->
<!--                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل </p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4 col-md-6 animated bounceInUp slow delay-500">-->
<!--                <div class="features-col col-default-mb30">-->
<!--                    <div class="features-img">-->
<!--                        <img src="images/rtl-images/features/3.jpg" alt="">-->
<!--                        <div class="features-title">-->
<!--                            <h3>تدريب كروس فيت</h3>-->
<!--                            <p>اجعل جسمك لائقًا</p>-->
<!--                        </div>-->
<!--                        <div class="features-content">-->
<!--                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل </p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

<!-- About Section -->
<style>
    .highlight-text {
        margin-bottom: 10px !important;
        margin-top: 10px !important;
    }
</style>

<section id="about" class="blog-sec blog-single-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="about-title">
                    <h1> {{trans('front.welcome')}}  <span>{{$mainSettings->name}}</span></h1>
                    <!--                    <p>حافظ على جسمك لائقًا وقويًا</p>-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-box">
                    <div style="padding: 32px 10px 0 10px;">{!!$mainSettings->about??''!!}</div>

                </div>


            </div>

        </div>
    </div>
</section>




{{--<section id="gallery" class="about-sec clearfix">--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-lg-6">--}}
{{--                <div class="default-title text-center">--}}
{{--                    <h2>  <span>الصور</span></h2>--}}
{{--                    <div class="title-bdr">--}}
{{--                        <div class="title-bdr-inside"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <iframe width="560" height="315" src="https://www.youtube.com/embed/g8yMMoCr4Uw?si=VhadVAJ2LMbDU2Zx&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}



@if(isset($subscriptions) && (count($subscriptions) > 0))
    <section id="subscriptions" class="sm-pricing-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="default-title text-center">
                        <h2> <span>{{trans('front.subscriptions')}}</span> </h2>
                        <div class="title-bdr">
                            <div class="title-bdr-inside"></div>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $featuredSubId = null;
                if ($subscriptions->count() > 1) {
                    $withDiscount = $subscriptions->filter(function ($s) {
                        return ($s->default_discount_type ?? 0) > 0 && ($s->default_discount_value ?? 0) > 0;
                    });
                    if ($withDiscount->count() > 0) {
                        $featuredSubId = $withDiscount->sortByDesc('default_discount_value')->first()->id;
                    }
                }
                $vatPercentage = @$record->vat_details['vat_percentage'] ?? 0;
            @endphp
            <div class="sm-pricing-grid">
                @foreach($subscriptions as $subscription)
                    @php
                        $isFeatured = $featuredSubId && $subscription->id === $featuredSubId;

                        $originalPrice = (float) $subscription->price;
                        $discountType  = $subscription->default_discount_type ?? 0;
                        $discountValue = (float) ($subscription->default_discount_value ?? 0);
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
                        $priceAfterDiscount = round($originalPrice - $discountAmount, 2);
                        $vatAmount    = round(($vatPercentage / 100) * $priceAfterDiscount, 2);
                        $priceWithVat = round($priceAfterDiscount + $vatAmount, 2);
                    @endphp
                    <div class="sm-plan-card {{ $isFeatured ? 'sm-featured' : '' }}">
                        @if($isFeatured)
                            <span class="sm-featured-badge">{{ trans('front.best_offer') }}</span>
                        @endif
                        <div class="sm-plan-img-wrap">
                            @if($subscription->getRawOriginal('image'))
                                <img src="{{ $subscription->image }}" alt="{{ $subscription->name }}">
                            @else
                                <img src="{{ asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/images/logo.png') }}" alt="{{ $subscription->name }}" style="object-fit: contain; padding: 20px; background: #181818;">
                            @endif
                        </div>
                        <div class="sm-plan-body">
                            <h2 class="sm-plan-name">{{$subscription->name}}</h2>
                            @if($subscription->content)
                                <p class="sm-plan-desc">{{ \Illuminate\Support\Str::limit(strip_tags($subscription->content), 70) }}</p>
                            @endif
                            <ul class="sm-plan-meta">
                                <li><i class="fa fa-calendar"></i> {{trans('front.period')}}: {{$subscription->period}} {{trans('front.day')}}</li>
                                <li><i class="fa fa-fire"></i> {{trans('front.session_num')}}: {{$subscription->workouts}}</li>
                            </ul>
                            <div class="sm-price-block">
                                @if($discountAmount > 0)
                                    <span class="sm-price-old">{{number_format($originalPrice, 2)}} {{trans('front.pound_unit')}}</span>
                                    <span class="sm-price-discount">{{$discountLabel}}: -{{number_format($discountAmount, 2)}} {{trans('front.pound_unit')}}</span>
                                @endif
                                <span class="sm-price-main">{{number_format($priceAfterDiscount, 2)}} {{trans('front.pound_unit')}}</span>
                                @if($vatPercentage > 0)
                                    <span class="sm-price-vat">+ {{trans('front.vat')}} ({{$vatPercentage}}%): {{number_format($vatAmount, 2)}} {{trans('front.pound_unit')}}</span>
                                    <span class="sm-price-total">{{trans('front.total_price')}}: {{number_format($priceWithVat, 2)}} {{trans('front.pound_unit')}}</span>
                                @endif
                            </div>
                            <a class="sm-plan-cta" href="{{route('subscription', ['id' => $subscription->id])}}">{{trans('front.subscribe')}}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif


@if(@$schedule_banner->image)
    <section class="banners mb-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12" >
                    <div class="" >
                        <div class="videoWrapper text-center">
                            <img src="{{$schedule_banner->image}}" class="img-responsive" style="padding: 40px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End banners-->
@endif

@if(isset($pt_classes) && (count($pt_classes) > 0))
    <section id="subscriptions"  class="blog-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="default-title text-center">
                        <h2> <span>{{trans('front.pt')}}</span> </h2>
                        <div class="title-bdr">
                            <div class="title-bdr-inside"></div>
                        </div>
                        <!--                    <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص.</p>-->
                    </div>
                </div>
            </div>
            <div class="row justify-content-center animatedParent animateOnce">
                @foreach($pt_classes as $pt_class)
                    <div class="col-lg-4 col-md-6 animated bounceInUp slow">
                        <div class="blog-box col-default-mb30 animated fadeInUpShort slow">
                            <div class="blog-img">
                                <img src="{{$pt_class->image ?? asset('placeholder_black.png')}}" alt="">
                                <div class="blog-date">
                                    <ul>
                                        <li><i class="icofont icofont-businessman"></i><a href="{{route('pt-class', $pt_class->id)}}">{{$pt_class->name}}</a>
                                        </li>
                                        <li><i class="icofont icofont-number"></i><a href="#">{{ number_format(($pt_class->price + ($pt_class->price * (@$record->vat_details['vat_percentage']/100))), 2)}}  {{trans('front.pound_unit')}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog-content">
                                <h4><a href="{{route('pt-class', $pt_class->id)}}">{{$pt_class->name}}</a></h4>
                                <a class="btn btn-primary simple-btn" href="{{route('pt-class', $pt_class->id)}}" role="button">{{trans('front.details')}}</a>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- Courses Section -->
<!--<section id="courses" class="courses-sec">-->
<!--    <div class="container">-->
<!--        <div class="row justify-content-center">-->
<!--            <div class="col-lg-6">-->
<!--                <div class="default-title text-center">-->
<!--                    <h2>لنا <span>الدورات</span></h2>-->
<!--                    <div class="title-bdr">-->
<!--                        <div class="title-bdr-inside"></div>-->
<!--                    </div>-->
<!--                    <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. </p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row">-->
<!--            <div class="col-md-12">-->
<!--                <div class="courses-carousel-rtl" data-slick='{"slidesToShow": 3, "slidesToScroll": 1}'>-->
<!--                    <div class="item courses-item">-->
<!--                        <img src="images/rtl-images/courses/1.jpg" alt="">-->
<!--                        <div class="amount">-->
<!--                            <p>رسوم الدورة 49 دولار</p>-->
<!--                        </div>-->
<!--                        <div class="duration">-->
<!--                            <p>لمدة 3 اشهر</p>-->
<!--                        </div>-->
<!--                        <div class="courses-content">-->
<!--                            <h4>يوجا مثالية</h4>-->
<!--                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="item courses-item">-->
<!--                        <img src="images/rtl-images/courses/2.jpg" alt="">-->
<!--                        <div class="amount">-->
<!--                            <p>رسوم الدورة 49 دولار</p>-->
<!--                        </div>-->
<!--                        <div class="duration">-->
<!--                            <p>لمدة 3 اشهر</p>-->
<!--                        </div>-->
<!--                        <div class="courses-content">-->
<!--                            <h4>ممارسة الجري</h4>-->
<!--                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="item courses-item">-->
<!--                        <img src="images/rtl-images/courses/3.jpg" alt="">-->
<!--                        <div class="amount">-->
<!--                            <p>رسوم الدورة 49 دولار</p>-->
<!--                        </div>-->
<!--                        <div class="duration">-->
<!--                            <p>لمدة 3 اشهر</p>-->
<!--                        </div>-->
<!--                        <div class="courses-content">-->
<!--                            <h4>ممارسة الزومبا</h4>-->
<!--                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="item courses-item">-->
<!--                        <img src="images/rtl-images/courses/4.jpg" alt="">-->
<!--                        <div class="amount">-->
<!--                            <p>رسوم الدورة 49 دولار</p>-->
<!--                        </div>-->
<!--                        <div class="duration">-->
<!--                            <p>لمدة 3 اشهر</p>-->
<!--                        </div>-->
<!--                        <div class="courses-content">-->
<!--                            <h4>تدريب اللياقة البدنية</h4>-->
<!--                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="item courses-item">-->
<!--                        <img src="images/rtl-images/courses/5.jpg" alt="">-->
<!--                        <div class="amount">-->
<!--                            <p>رسوم الدورة 49 دولار</p>-->
<!--                        </div>-->
<!--                        <div class="duration">-->
<!--                            <p>لمدة 3 اشهر</p>-->
<!--                        </div>-->
<!--                        <div class="courses-content">-->
<!--                            <h4>رفع الاثقال</h4>-->
<!--                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

<!-- Schedule Section -->
{{--<section id="schedule" class="schedule-sec over-layer-black jarallax">--}}
{{--    <div id="particles-js"></div>--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-lg-6">--}}
{{--                <div class="default-title text-center">--}}
{{--                    <h2><span><?php echo $trans['schedule_times']?></span>  </h2>--}}
{{--                    <div class="title-bdr">--}}
{{--                        <div class="title-bdr-inside"></div>--}}
{{--                    </div>--}}
{{--                    <!--                    <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص.</p>-->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="schedule-chart">--}}
{{--                    <!-- Nav tabs -->--}}
{{--                    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">--}}

{{--                        <li class="nav-item" role="presentation"><a class="nav-link active" id="pills-saturday" data-toggle="pill" href="#saturday" aria-controls="saturday" role="tab" aria-selected="false"><?php echo $trans['saturday']?></a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item" role="presentation"><a class="nav-link" id="pills-sunday" data-toggle="pill" href="#sunday" aria-controls="sunday" role="tab" aria-selected="false"><?php echo $trans['sunday']?></a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item" role="presentation"><a class="nav-link " id="pills-monday" data-toggle="pill" href="#monday" aria-controls="monday" role="tab" aria-selected="true"><?php echo $trans['monday']?></a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item" role="presentation"><a class="nav-link" id="pills-tuesday" data-toggle="pill" href="#tuesday" aria-controls="tuesday" role="tab" aria-selected="false"><?php echo $trans['tuesday']?></a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item" role="presentation"><a class="nav-link" id="pills-wednesday" data-toggle="pill" href="#wednesday" aria-controls="wednesday" role="tab" aria-selected="false"><?php echo $trans['wednesday']?></a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item" role="presentation"><a class="nav-link" id="pills-thursday" data-toggle="pill" href="#thursday" aria-controls="thursday" role="tab" aria-selected="false"><?php echo $trans['thursday']?></a>--}}
{{--                        </li>--}}
{{--                        <!--                        <li class="nav-item" role="presentation"><a class="nav-link" id="pills-friday" data-toggle="pill" href="#friday" aria-controls="friday" role="tab" aria-selected="false">--><?php //echo $trans['friday']?><!--</a>-->--}}
{{--                        <!--                        </li>-->--}}
{{--                    </ul>--}}
{{--                    <!-- Tab panes -->--}}
{{--                    <div class="tab-content animatedParent" id="pills-tabContent">--}}
{{--                        <div class="tab-pane fade show active animated pulse slow" id="saturday" role="tabpanel" aria-labelledby="pills-profile-tab">--}}
{{--                            <div class="schedule-table table-responsive">--}}
{{--                                <h2><?php echo $trans['saturday']?></h2>--}}
{{--                                <table class="table text-center">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th><?php echo $trans['times'] ?></th>--}}
{{--                                        <th>Studio 1</th>--}}
{{--                                        <th>Studio 2</th>--}}
{{--                                        <th>Studio 3</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>1:00 PM</td>--}}
{{--                                        <td>Cakorinas Classsic troupe (Cako)</td>--}}
{{--                                        <td>year 8(Ballet) Ouzi</td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>2:00 PM</td>--}}
{{--                                        <td>Cakorinas Classic troupe (Cako)</td>--}}
{{--                                        <td>year ,8 (character).  Ouzi</td>--}}
{{--                                        <td>year 1 (Ballet). Nahed</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>3:00 PM</td>--}}
{{--                                        <td>Year 5 (Ballet). Cako</td>--}}
{{--                                        <td>year 7 (Ballet). Ouzi</td>--}}
{{--                                        <td>year 2 (Ballet) Nahed</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>4:00 PM</td>--}}
{{--                                        <td>Year 5 ( character). Cako</td>--}}
{{--                                        <td>year 7,6 (chracter) Ouzi</td>--}}
{{--                                        <td>year 2 (pointe&Allegro)  Nahed</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>5:00 PM</td>--}}
{{--                                        <td>Year 6 (Ballet) Cako</td>--}}
{{--                                        <td> - </td>--}}
{{--                                        <td>year 3 (Ballet) Nahed</td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="tab-pane fade animated pulse slow" id="sunday" role="tabpanel" aria-labelledby="pills-profile-tab">--}}
{{--                            <div class="schedule-table table-responsive">--}}
{{--                                <h2><?php echo $trans['sunday']?></h2>--}}
{{--                                <table class="table text-center">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th><?php echo $trans['times'] ?></th>--}}
{{--                                        <th>Studio 1</th>--}}
{{--                                        <th>Studio 2</th>--}}
{{--                                        <th>Studio 3</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>4:00 PM</td>--}}
{{--                                        <td> - </td>--}}
{{--                                        <td> - </td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>5:00 PM</td>--}}
{{--                                        <td>Year2 (classic) Nahed</td>--}}
{{--                                        <td> - </td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>6:00 PM</td>--}}
{{--                                        <td>Year2 (history) Nahed</td>--}}
{{--                                        <td> - </td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>7:00 PM</td>--}}
{{--                                        <td> - </td>--}}
{{--                                        <td>Modern troupe (ouzi)</td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>8:00 PM</td>--}}
{{--                                        <td> - </td>--}}
{{--                                        <td>Modern troupe (ouzi)</td>--}}
{{--                                        <td>Silver tutu (Ballet) Nevo</td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="tab-pane fade animated pulse slow" id="monday" role="tabpanel" aria-labelledby="pills-home-tab">--}}
{{--                            <div class="schedule-table table-responsive">--}}
{{--                                <h2><?php echo $trans['monday']?></h2>--}}
{{--                                <table class="table text-center">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th><?php echo $trans['times'] ?></th>--}}
{{--                                        <th>Studio 1</th>--}}
{{--                                        <th>Studio 2</th>--}}
{{--                                        <th>Studio 3</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>5:00 PM</td>--}}
{{--                                        <td> - </td>--}}
{{--                                        <td> - </td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>6:00 PM</td>--}}
{{--                                        <td>Year 5 (Modern) Ouzii</td>--}}
{{--                                        <td>Year 8(PBT) Cako</td>--}}
{{--                                        <td>Class p.tutu (Ballet) Hana/ Cako</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>7:00 PM</td>--}}
{{--                                        <td>Year 5 (Stretching) Ouzii</td>--}}
{{--                                        <td>Year 8 (Ballet) Cako</td>--}}
{{--                                        <td>Class w.tutu (Ballet)  Hana/Cako</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>8:00 PM</td>--}}
{{--                                        <td>Year 6 ,7(Stretching) Ouzii</td>--}}
{{--                                        <td>Cakorinas Troupe (Cako)</td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>9:00 PM</td>--}}
{{--                                        <td>Year 6 ,7(Modern) Ouzii</td>--}}
{{--                                        <td>Cakorinas Troupe (Cako)</td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="tab-pane fade animated pulse slow" id="tuesday" role="tabpanel" aria-labelledby="pills-profile-tab">--}}
{{--                            <div class="schedule-table table-responsive">--}}
{{--                                <h2><?php echo $trans['tuesday']?></h2>--}}
{{--                                <table class="table text-center">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th><?php echo $trans['times'] ?></th>--}}
{{--                                        <th>Studio 1</th>--}}
{{--                                        <th>Studio 2</th>--}}
{{--                                        <th>Studio 3</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>5:00 PM</td>--}}
{{--                                        <td>Year 2,3 (Modern) Ouzi</td>--}}
{{--                                        <td>Year 1 (Classic) Rahma</td>--}}
{{--                                        <td>classic troup</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>6:00 PM</td>--}}
{{--                                        <td>Year 2,3 (Modern) Ouzi</td>--}}
{{--                                        <td>Year 1 (Modern) Rahma</td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>7:00 PM</td>--}}
{{--                                        <td>Cakorinas Modern Troupe Ouzi</td>--}}
{{--                                        <td>Year 6 (classic) Rahma</td>--}}
{{--                                        <td>Class pr.tutu(Ballet) Nevo</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>8:00 PM</td>--}}
{{--                                        <td>Cakorinas Modern Troupe Ouzi</td>--}}
{{--                                        <td>Year 6 (pointe&Allegro) Rahma</td>--}}
{{--                                        <td>Silver tutu (Ballet) Nevo</td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="tab-pane fade animated pulse slow" id="wednesday" role="tabpanel" aria-labelledby="pills-profile-tab">--}}
{{--                            <div class="schedule-table table-responsive">--}}
{{--                                <h2><?php echo $trans['wednesday']?></h2>--}}
{{--                                <table class="table text-center">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th><?php echo $trans['times'] ?></th>--}}
{{--                                        <th>Studio 1</th>--}}
{{--                                        <th>Studio 2</th>--}}
{{--                                        <th>Studio 3</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>6:00 PM</td>--}}
{{--                                        <td>year 8 (Stretching) Ouzii</td>--}}
{{--                                        <td>Year 5 (Ballet) Dr tahany</td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>7:00 PM</td>--}}
{{--                                        <td>year 8 (Modern) Ouzii</td>--}}
{{--                                        <td>Year 5 (Pointe-Allegro)  Dr tahany</td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>8:00 PM</td>--}}
{{--                                        <td>year 9 (Stretching) Ouzii</td>--}}
{{--                                        <td>Year 7 (Ballet) Dr tahany</td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>9:00 PM</td>--}}
{{--                                        <td>year 9 (Modern) Ouzii</td>--}}
{{--                                        <td>Year 7 (Pointe-Allegro)  Dr tahany</td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="tab-pane fade animated pulse slow" id="thursday" role="tabpanel" aria-labelledby="pills-profile-tab">--}}
{{--                            <div class="schedule-table table-responsive">--}}
{{--                                <h2><?php echo $trans['thursday']?></h2>--}}
{{--                                <table class="table text-center">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th><?php echo $trans['times'] ?></th>--}}
{{--                                        <th>Studio 1</th>--}}
{{--                                        <th>Studio 2</th>--}}
{{--                                        <th>Studio 3</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>4:00 PM</td>--}}
{{--                                        <td> - </td>--}}
{{--                                        <td>Year 1 (stretching) Hala/cako</td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>5:00 PM</td>--}}
{{--                                        <td>Year 3 (History) Nahed</td>--}}
{{--                                        <td>Year 1 (History) Hala/cako</td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>6:00 PM</td>--}}
{{--                                        <td>Year 3 (pointe-Allegro ) Nahed</td>--}}
{{--                                        <td>Class p.tutu (Ballet) Hana/cako</td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>7:00 PM</td>--}}
{{--                                        <td> - </td>--}}
{{--                                        <td>Class w.tutu (Ballet) Hana/cako</td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>8:00 PM</td>--}}
{{--                                        <td> - </td>--}}
{{--                                        <td> - </td>--}}
{{--                                        <td> - </td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!--                        <div class="tab-pane fade animated pulse slow" id="friday" role="tabpanel" aria-labelledby="pills-profile-tab">-->--}}
{{--                        <!--                            <div class="schedule-table table-responsive">-->--}}
{{--                        <!--                                <h2>خمسة</h2>-->--}}
{{--                        <!--                                <table class="table text-center">-->--}}
{{--                        <!--                                    <thead>-->--}}
{{--                        <!--                                    <tr>-->--}}
{{--                        <!--                                        <th>الأحداث</th>-->--}}
{{--                        <!--                                        <th>مدرب</th>-->--}}
{{--                        <!--                                        <th>المتدرب</th>-->--}}
{{--                        <!--                                        <th>زمن</th>-->--}}
{{--                        <!--                                    </tr>-->--}}
{{--                        <!--                                    </thead>-->--}}
{{--                        <!--                                    <tbody>-->--}}
{{--                        <!--                                    <tr>-->--}}
{{--                        <!--                                        <td>يوجا</td>-->--}}
{{--                        <!--                                        <td>روبارت جيبسون</td>-->--}}
{{--                        <!--                                        <td>عشرون</td>-->--}}
{{--                        <!--                                        <td>11:00 - 01:00 مساءً</td>-->--}}
{{--                        <!--                                    </tr>-->--}}
{{--                        <!--                                    <tr>-->--}}
{{--                        <!--                                        <td>برنامج لياقة عالي الكثافة</td>-->--}}
{{--                        <!--                                        <td>ماك ميلان</td>-->--}}
{{--                        <!--                                        <td>ثلاثون</td>-->--}}
{{--                        <!--                                        <td>01:00 - 03:00 مساءً</td>-->--}}
{{--                        <!--                                    </tr>-->--}}
{{--                        <!--                                    <tr>-->--}}
{{--                        <!--                                        <td>ركوب الدراجات</td>-->--}}
{{--                        <!--                                        <td>جون موجينا</td>-->--}}
{{--                        <!--                                        <td>خمسة و عشرون</td>-->--}}
{{--                        <!--                                        <td>03:00 - 05:00 مساءً</td>-->--}}
{{--                        <!--                                    </tr>-->--}}
{{--                        <!--                                    <tr>-->--}}
{{--                        <!--                                        <td>الكيك بوكسينغ</td>-->--}}
{{--                        <!--                                        <td>جوليو لي</td>-->--}}
{{--                        <!--                                        <td>عشرون</td>-->--}}
{{--                        <!--                                        <td>05:00 - 07:00 مساءً</td>-->--}}
{{--                        <!--                                    </tr>-->--}}
{{--                        <!--                                    <tr>-->--}}
{{--                        <!--                                        <td>زومبا</td>-->--}}
{{--                        <!--                                        <td>توماس ماركس</td>-->--}}
{{--                        <!--                                        <td>ثلاثون</td>-->--}}
{{--                        <!--                                        <td>07:00 - 09:00 مساءً</td>-->--}}
{{--                        <!--                                    </tr>-->--}}
{{--                        <!--                                    </tbody>-->--}}
{{--                        <!--                                </table>-->--}}
{{--                        <!--                            </div>-->--}}
{{--                        <!--                        </div>-->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

<!-- Trainer Section -->
<!--<section id="trainer" class="trainer-sec">-->
<!--    <div class="container">-->
<!--        <div class="row justify-content-center">-->
<!--            <div class="col-lg-6">-->
<!--                <div class="default-title text-center">-->
<!--                    <h2>  <span>مدربينا</span></h2>-->
<!--                    <div class="title-bdr">-->
<!--                        <div class="title-bdr-inside"></div>-->
<!--                    </div>-->
<!--                    <p>لدينا افضل المدربين وامهرهم علي الاطلاق</p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row">-->
<!--            <div class="col-md-12">-->
<!--                <div class="trainer-carousel-rtl" data-slick='{"slidesToShow": 3, "slidesToScroll": 1}'>-->
<!--                    <div class="trainer-item">-->
<!--                        <div class="trainer-img">-->
<!--                            <img src="images/rtl-images/trainer/1.jpg" alt="">-->
<!--                            <div class="trainer-social">-->
<!--                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>-->
<!--                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>-->
<!--                                <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>-->
<!--                                <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="trainer-name">-->
<!--                            <h4>جون نيلسون</h4>-->
<!--                            <p>منشئ الجسم</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="trainer-item">-->
<!--                        <div class="trainer-img">-->
<!--                            <img src="images/rtl-images/trainer/2.jpg" alt="">-->
<!--                            <div class="trainer-social">-->
<!--                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>-->
<!--                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>-->
<!--                                <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>-->
<!--                                <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="trainer-name">-->
<!--                            <h4>كريستينا ليو</h4>-->
<!--                            <p>مدرب يوجا</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="trainer-item">-->
<!--                        <div class="trainer-img">-->
<!--                            <img src="images/rtl-images/trainer/3.jpg" alt="">-->
<!--                            <div class="trainer-social">-->
<!--                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>-->
<!--                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>-->
<!--                                <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>-->
<!--                                <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="trainer-name">-->
<!--                            <h4>جوليو نيلسون</h4>-->
<!--                            <p>مدرب لياقة</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="trainer-item">-->
<!--                        <div class="trainer-img">-->
<!--                            <img src="images/rtl-images/trainer/4.jpg" alt="">-->
<!--                            <div class="trainer-social">-->
<!--                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>-->
<!--                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>-->
<!--                                <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>-->
<!--                                <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="trainer-name">-->
<!--                            <h4>أليستر جيكسون</h4>-->
<!--                            <p>رفع الاثقال</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="trainer-item">-->
<!--                        <div class="trainer-img">-->
<!--                            <img src="images/rtl-images/trainer/5.jpg" alt="">-->
<!--                            <div class="trainer-social">-->
<!--                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>-->
<!--                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>-->
<!--                                <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>-->
<!--                                <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="trainer-name">-->
<!--                            <h4>نيكولاس سينس</h4>-->
<!--                            <p>مدرب الجري</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
<!-- Gallery Section -->
@if(isset($images) && (count($images) > 0))
<section id="gallery" class="gallery-sec clearfix">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="default-title text-center">
                    <h2>  <span>{{trans('front.gallery')}}</span></h2>
                    <div class="title-bdr">
                        <div class="title-bdr-inside"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <ul class="col-md-12 portfolio-all-item">
                @foreach($images as $image)
                <li class="portfolio-item clearfix" data-tag='yoga'>
                    <div class="hover-me">
                        <img src="{{env('APP_URL_MASTER').'uploads/settings/gyms/'.$image}}" alt="" class="gallery-image-res">
                        <div class="hover-layer"></div>
                        <div class="hover-me-content">
                            <a class="thumbnail gallery" href="{{env('APP_URL_MASTER').'uploads/settings/gyms/'.$image}}"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endif
<!-- Activities Section -->

@if(isset($activities) && (count($activities) > 0))
<section id="activities" class="sm-activities-sec">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="default-title text-center">
                    <h2> <span>{{trans('front.activities')}}</span> </h2>
                    <div class="title-bdr">
                        <div class="title-bdr-inside"></div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $activityIcons = ['fa-heartbeat', 'fa-fire', 'fa-bolt', 'fa-trophy', 'fa-bicycle', 'fa-futbol-o'];
        @endphp
        <div class="sm-activities-grid">
            @foreach($activities as $activity)
                @php $hasActivityImage = !empty($activity->image_name); @endphp
                <div class="sm-activity-card {{ $hasActivityImage ? '' : 'sm-activity-noimg' }}"
                     @if($hasActivityImage) style="background-image:url('{{ $activity->image }}');" @endif>
                    <span class="sm-activity-icon"><i class="fa {{ $activityIcons[$loop->index % count($activityIcons)] }}"></i></span>
                    <div class="sm-activity-body">
                        <h5>{{$activity->name}}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{--<section id="about" class="about-sec">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="about-title">--}}
{{--                    <h1><?php echo strtoupper(trans('front.powered_by'))?></h1>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-9">--}}
{{--                <div class="about-col">--}}
{{--                    <h3>Dr Nesma Jad</h3>--}}
{{--                    <span style="font-size: 13px;color: #75c043;">Exective Director& Cakorinas Founder</span>--}}
{{--                    <p style="margin-top:10px;">Born in 1989, she obtained her diploma from the Royal Academy of Dance (UK) in 2005, followed by a notable tenure as a dancer at the Royal Opera House (London) until 2013. Achieving a Bachelor's in Financial Institutions in 2009, she took on the role of Representative of CIOFF Youth Egypt (UNESCO) NGO in 2013. Commencing her ballet journey in 2005 as a teacher at the Integrated Care Society, she established her own academy in 2007, specializing in classical ballet. In 2015, she attained her first master's in teaching ballet from (RAD), and in 2019, she earned her second Master's Diploma in heritage from the Academy of Arts. In 2022, she completed her Ph.D. from RAD. Renowned for her ballet performances, including Swan Lake, Nutcracker, Cinderella, Sleeping Beauty, La Bayadere, The Pharaoh's Daughter, Egyptian Folklore, Choppiniana, and Carmen. Beyond her ballet endeavors, she serves as the director of various significant events, such as the opening of the Suez Canal, school graduations, 6th October Festivals, the Year of Special Need, and numerous TV programs. She actively represents Egyptian heritage globally, showcasing the richness of the culture in countries like France, China, Greece, Italy, the UK, Serbia, and Spain.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-3">--}}
{{--                <div class="animated bounceInLeft slow go">--}}
{{--                    <img src="images/rtl-images/testimonial/5.jpg" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-3">--}}
{{--                <div class="animated bounceInLeft slow go">--}}
{{--                    <img src="images/rtl-images/testimonial/1.jpg" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-9">--}}
{{--                <div class="about-col">--}}
{{--                    <h3>Dr Gamal Saleh</h3>--}}
{{--                    <span style="font-size: 13px;color: #75c043;">Ballet Consultant</span>--}}
{{--                    <p style="margin-top:10px;">joined ballet school in 1968-earned a ballet diploma in 1976 excellent degree. his bachelor's cerograph&directing 1980, master's degree in 1991, Ph.D. 1996, Dein of ballet institute 2015, in 2000 he was a lecturer in international heritage at Royal Hampton in the UK he joined Cairo opera house in 1970 he performed the ballet Don Quixote-nutcracker -Gaiane- Shahrazad- Giselle- Oun Bahia Gamal joined Kythara Institute as the head of the Ballet department in 2016, and the consultant for The Cakorinas he participates in many festivals as a dancer and director in France - India- UK -turkey -Algeria-UK- Italy- Russia</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</section>--}}

<!-- Testimonial Section -->
{{--<section class="testimonial-sec" style="padding-top: 40px !important;">--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-lg-6">--}}
{{--                <div class="default-title text-center">--}}
{{--                    <h2><span>{{trans('front.testimonials')}}</span></h2>--}}
{{--                    <div class="title-bdr">--}}
{{--                        <div class="title-bdr-inside"></div>--}}
{{--                    </div>--}}
{{--                    <!--                    <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص.</p>-->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-lg-8">--}}
{{--                <div class="<?php if($lang=='ar'){?>testimonial-carousel-rtl<?php }else{ ?>testimonial-carousel<?php } ?>" data-slick='{"slidesToShow": 1, "slidesToScroll": 1}'>--}}

{{--                    <div class="testimonial-item">--}}
{{--                        <img src="{{asset('resources/{{@env('TEMPLATE_NUM')}}/assets/images/logo.png')}}" alt="">--}}
{{--                        <h4>Suzi Fayad</h4>--}}
{{--                        <span>Head of Modern Department</span>--}}
{{--                        <p>In 2003 got her ballet diploma with an excellent degree. Joined Higher Ballet Institute and Graduated with a superb Degree in 2007 then she travel to the USA to start her master's diploma at ( Duke University ), in 2002 signed her contract with Cairo opera house as Dancer she present many roles in Shahrazad, Shady Abdelsalam, Nashret Ghaseel, Summer Kund, Underground, The Mummy Mahmoud Mokhtar, Huda shaarawy, Banat Baharyand .2009.she signed her contract as a choreographer and directing and she achieved high success in presenting (Aladdin -Ali El Zabak-El Waly-El Mulled-Women from Egypt- Egypt Folk - Disney land-Sindbad - cinderella -The Island. In 2017 she started work in Kythara as Head of the Modern Department School she spread every year her success by presenting a new storyboard. she participates in many international festivals "Mexico-U.K-China-Italy-France-Spain -Amman -Morocco -Turky-India-Algeria</p>--}}
{{--                        <i class="fa fa-quote-right" aria-hidden="true"></i>--}}
{{--                        <div class="style-border-top"></div>--}}
{{--                        <div class="style-border-right"></div>--}}
{{--                        <div class="style-border-bottom"></div>--}}
{{--                        <div class="style-border-left"></div>--}}
{{--                    </div>--}}

{{--                    <div class="testimonial-item">--}}
{{--                        <img src="{{asset('resources/{{@env('TEMPLATE_NUM')}}/assets/images/logo.png')}}" alt="">--}}
{{--                        <h4>Saeid Ibrahim</h4>--}}
{{--                        <span>Choreographer & Director</span>--}}
{{--                        <p>Born in 1997, he enrolled in the Higher Ballet Institute in 2016 and achieved his diploma with an outstanding degree. In 2014, he commenced studies in design and choreography, culminating in a superb degree in 2020. Joining a ballet troupe at the Cairo Opera House as a soloist, he began collaborating with Kythara and The Cakorinas in 2014 as a choreographer, leaving a distinct mark in performances involving children. Versatile in his roles, he has portrayed characters such as Robert in Swan Lake, Drossmair in Nutcracker, Basilio in Don Quixote, Romeo in Romeo & Juliet, and Solar in La Bayadere. He has been an active participant in various international festivals in China, London, France, Greece, Serbia, Italy, and Poland.</p>--}}
{{--                        <i class="fa fa-quote-right" aria-hidden="true"></i>--}}
{{--                        <div class="style-border-top"></div>--}}
{{--                        <div class="style-border-right"></div>--}}
{{--                        <div class="style-border-bottom"></div>--}}
{{--                        <div class="style-border-left"></div>--}}
{{--                    </div>--}}

{{--                    <div class="testimonial-item">--}}
{{--                        <img src="{{asset('resources/{{@env('TEMPLATE_NUM')}}/assets/images/logo.png')}}" alt="">--}}
{{--                        <h4>Omar Ibrahim</h4>--}}
{{--                        <span>Master Ballet Teacher</span>--}}
{{--                        <p>Born in 1995, he earned his ballet diploma in 2013 with distinction. Joining the Higher Ballet Institute in 2015, he graduated with an excellent degree in 2019. In 2021, he completed his master's diploma in the teaching ballet department, achieving an outstanding degree. His journey with Kythara & The Cakorinas began in 2017 as a 1st teacher. As a soloist, he contributed to the Cairo Opera House & Kythara ballet troupe, showcasing his talent in various roles such as Swan Lake, La Bayadere, The Pharao's Daughter, Carmen, Romeo & Juliet, Nutcracker, Kleopatra, and Spartakios. His international presence extends to festivals in Serbia, China, Italy, France, Spain, Greece, Amman, and Montenegro.</p>--}}
{{--                        <i class="fa fa-quote-right" aria-hidden="true"></i>--}}
{{--                        <div class="style-border-top"></div>--}}
{{--                        <div class="style-border-right"></div>--}}
{{--                        <div class="style-border-bottom"></div>--}}
{{--                        <div class="style-border-left"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<!-- Pricing Table Section -->



<!-- Blog Section -->
<!--<section id="blog" class="blog-sec">-->
<!--    <div class="container">-->
<!--        <div class="row justify-content-center">-->
<!--            <div class="col-lg-6">-->
<!--                <div class="default-title text-center">-->
<!--                    <h2>لنا <span>مقالات</span></h2>-->
<!--                    <div class="title-bdr">-->
<!--                        <div class="title-bdr-inside"></div>-->
<!--                    </div>-->
<!--                    <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص.</p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row justify-content-center animatedParent animateOnce">-->
<!--            <div class="col-lg-4 col-md-6 animated bounceInUp slow">-->
<!--                <div class="blog-box col-default-mb30 animated fadeInUpShort slow">-->
<!--                    <div class="blog-img">-->
<!--                        <img src="images/rtl-images/blog/1.jpg" alt="">-->
<!--                        <div class="blog-date">-->
<!--                            <ul>-->
<!--                                <li><i class="icofont icofont-businessman"></i><a href="#">مارك جونسون</a>-->
<!--                                </li>-->
<!--                                <li><i class="icofont icofont-calendar"></i><a href="#">20 ديسمبر, 2021</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="blog-content">-->
<!--                        <h4><a href="blog-single.html">هذا هو عنوان المدونة</a></h4>-->
<!--                        <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. </p>-->
<!--                        <a class="btn btn-primary simple-btn" href="blog-single.html" role="button">اقرأ أكثر</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4 col-md-6 animated bounceInUp slow delay-250">-->
<!--                <div class="blog-box col-default-mb30 animated fadeInUpShort slow delay-250">-->
<!--                    <div class="blog-img">-->
<!--                        <img src="images/rtl-images/blog/2.jpg" alt="">-->
<!--                        <div class="blog-date">-->
<!--                            <ul>-->
<!--                                <li><i class="icofont icofont-businessman"></i><a href="#">توماس روي</a>-->
<!--                                </li>-->
<!--                                <li><i class="icofont icofont-calendar"></i><a href="#">21 ديسمبر, 2021</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="blog-content">-->
<!--                        <h4><a href="blog-single.html">هذا هو عنوان المدونة</a></h4>-->
<!--                        <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. </p>-->
<!--                        <a class="btn btn-primary simple-btn" href="blog-single.html" role="button">اقرأ أكثر</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4 col-md-6 animated bounceInUp slow delay-500">-->
<!--                <div class="blog-box col-default-mb30 animated fadeInUpShort slow delay-500">-->
<!--                    <div class="blog-img">-->
<!--                        <img src="images/rtl-images/blog/3.jpg" alt="">-->
<!--                        <div class="blog-date">-->
<!--                            <ul>-->
<!--                                <li><i class="icofont icofont-businessman"></i><a href="#">نيلسون مونيكا</a>-->
<!--                                </li>-->
<!--                                <li><i class="icofont icofont-calendar"></i><a href="#">22  ديسمبر, 2021</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="blog-content">-->
<!--                        <h4><a href="blog-single.html">هذا هو عنوان المدونة</a></h4>-->
<!--                        <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. </p>-->
<!--                        <a class="btn btn-primary simple-btn" href="blog-single.html" role="button">اقرأ أكثر</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

<!-- Contact Section -->
<section id="contact" class="contact-sec over-layer-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="default-title text-center">
                    <h2><span> {{trans('front.contact_us')}} </span> </h2>
                    <div class="title-bdr">
                        <div class="title-bdr-inside"></div>
                    </div>
                    <p>{{trans('front.contact_us_msg')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row justify-content-center animatedParent animateOnce">
                    <div class="col-lg-4 col-md-6 animated bounceInUp slow">
                        <div class="angle-box col-default-mb30">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <address>
                                <?php echo $mainSettings['address']?>
                            </address>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 animated bounceInUp slow delay-250">
                        <div class="angle-box col-default-mb30">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <p><?php echo $mainSettings['support_email']?></p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 animated bounceInUp slow delay-500">
                        <div class="angle-box col-default-mb30">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <p><?php echo $mainSettings['phone']?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="col-default-mb30" >
                            <form method="post"  id="contact_form">
                                <input type="text" name="contact_name" id="contact_name" class="form-control" placeholder="{{trans('front.name')}}" required="">
                                <input type="email" name="contact_email" id="contact_email" class="form-control"  placeholder="{{trans('front.email')}}" required="">
                                <!--                                <input type="text" class="form-control" placeholder="عدد">-->
                                <textarea class="form-control textarea-hight-full" id="contact_message" name="message" rows="6" required="" placeholder="{{trans('front.message')}}"></textarea>
                                <button class="btn btn-default simple-btn" id="submitButton" type="submit">{{trans('front.send')}}</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="col-default-mb30">
                            <iframe style="height: 420px" width="100%" height="500"
                                    id="gmap_canvas"
                                    src="https://maps.google.com/maps?q=<?php echo $mainSettings['latitude']?>,<?php echo $mainSettings['longitude']?>&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                    frameborder="0" scrolling="no" marginheight="0"
                                    marginwidth="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('script')
<script>
    $(document).ready(function(){
        // On some button click or event

        $('#submitButton').click(function(e){
            let name = $('#contact_name').val();
            let email = $('#contact_email').val();
            let message = $('#contact_message').val();
            e.preventDefault();
            if(!name || !email || !message){
                alert('{{trans('sw.error_login')}}')
            }else {
                $.ajax({
                    url: '{{ route("contact") }}',  // Laravel route name
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',  // Add CSRF token for security
                        name: name,               // Your form data or any key-value pair
                        email: email,
                        message: message
                    },
                    success: function (response) {
                        console.log(response);       // Do something on success
                        $('#contact_form').html('<div class="alert alert-success">{{trans('global.thank_you_message')}}</div>');
                        // alert('Data sent successfully!');
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);  // Handle errors here
                        alert('Something went wrong.');
                    }
                });
            }
        });
    });
</script>
@endsection
