@extends('Dietplate::Front.layouts.master')
@section('style')
<style>
    .tp-caption {
        background: rgba(0,0,0,.5);
        border-radius: 20px;
        padding: 15px !important;
        opacity: 100% !important;
    }
    input {
        color: white !important;
    }
    ::-webkit-input-placeholder { /* Edge */
        color: white;
    }

    :-ms-input-placeholder { /* Internet Explorer 10-11 */
        color: white;
    }

    ::placeholder {
        color: white;
    }
    @media screen and (min-width: 767px) {
        .header-offset-mobile {
            margin-top: -110px;
            overflow: hidden;
            float: left;
            width: 100%;
        }

        .tp-caption {
            left: 110px !important;
        }
    }
    @media only screen and (max-width: 768px) {
        div .ok-xsd-6 {
            width: 50% !important;
        }
    }
    .overlay {
        font-size: 0.53125rem;
        line-height: 0.79688rem;
        overflow: hidden;
        position: relative;
        border-radius: 85px;
        font-weight: normal;
        text-align: center;
        margin: 0 auto 25px;
        width: 170px !important;
        height: 170px !important;
        float: right;
    }
    .overlay img {
        position: relative;
        border-radius: 85px
    }
    .image .thumb img{
        width: 100%;
        padding-bottom: 10px;
    }
    .image .thumb {
        margin: 10px auto 0px;
        border: 1px solid #9e9e9e;
    }
    #demo-construction .dima-navbar-transparent.dima-navbar .dima-nav>li>a, #demo-construction .dima-navbar-transparent.dima-navbar .dima-nav-end>li>a {
        color: #ff9800;
    }

    .text-nice-light-blue {
        padding: 0 10px;
        color: #ffc107;
    }
    .app li{
        color: #fff !important;
        @if($lang == 'ar')
            text-align: right;
            line-height: initial;
        @else
            text-align: left;
        @endif
    }

    /* ===== ABOUT VIDEO ===== */
    .about-video-wrap {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,0.18);
        position: relative;
    }
    .about-video-wrap video {
        width: 100%;
        display: block;
        border-radius: 16px;
        min-height: 480px;
        max-height: 560px;
        object-fit: cover;
    }

    /* ===== HOW IT WORKS ===== */
    .how-it-works-sec {
        padding: 80px 0;
        background: linear-gradient(135deg, #f8f0fc 0%, #f0e8f8 100%);
    }
    .hiw-step {
        background: #fff;
        border-radius: 16px;
        padding: 45px 20px 30px;
        text-align: center;
        margin-bottom: 30px;
        box-shadow: 0 5px 25px rgba(126,76,138,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        border-top: 4px solid #7e4c8a;
    }
    .hiw-step:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(126,76,138,0.22);
    }
    .hiw-step-num {
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #7e4c8a;
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(126,76,138,0.4);
    }
    .hiw-step-icon {
        font-size: 42px;
        color: #7e4c8a;
        margin-bottom: 16px;
        display: block;
    }
    .hiw-step h4 {
        font-size: 15px;
        color: #222;
        margin-bottom: 10px;
        font-weight: 700;
        text-transform: none;
    }
    .hiw-step p {
        color: #777;
        font-size: 13px;
        line-height: 1.7;
        margin: 0;
    }

    /* ===== FEATURED PROGRAMS (SUBSCRIPTIONS REDESIGN) ===== */
    .featured-programs-sec {
        padding: 80px 0;
        background: #f7f3fa;
    }
    .program-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        margin-bottom: 0;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .featured-programs-sec .col-lg-3,
    .featured-programs-sec .col-md-6 {
        padding-bottom: 40px;
    }
    .program-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(126,76,138,0.22);
    }
    .program-card-img {
        width: 100%;
        height: 190px;
        object-fit: contain;
    }
    .program-card-img-placeholder {
        width: 100%;
        height: 190px;
        background: linear-gradient(135deg, #7e4c8a, #a86bbf);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .program-card-img-placeholder i {
        font-size: 60px;
        color: rgba(255,255,255,0.5);
    }
    .program-card-body {
        padding: 22px 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .program-card-title {
        font-size: 17px;
        font-weight: 700;
        color: #222;
        margin-bottom: 14px;
        text-transform: none;
    }
    .program-card-features {
        list-style: none;
        padding: 0;
        margin: 0 0 15px;
    }
    .program-card-features li {
        padding: 7px 0;
        color: #555;
        font-size: 13px;
        border-bottom: 1px solid #f5f5f5;
        display: flex;
        align-items: center;
    }
    .program-card-features li i {
        color: #7e4c8a;
        margin-left: 8px;
        margin-right: 8px;
        width: 16px;
        text-align: center;
    }
    .program-card-pricing {
        margin-top: auto;
        text-align: center;
        padding: 15px 0 0;
        border-top: 1px solid #f0e6f6;
    }
    .program-card-old-price {
        font-size: 13px;
        color: #bbb;
        text-decoration: line-through;
        display: block;
    }
    .program-card-discount-label {
        font-size: 11px;
        color: #5cb85c;
        display: block;
        margin-bottom: 4px;
    }
    .program-card-price {
        font-size: 28px;
        font-weight: 700;
        color: #7e4c8a;
        line-height: 1.2;
    }
    .program-card-price-unit {
        font-size: 13px;
        color: #999;
        display: block;
        margin-bottom: 4px;
    }
    .program-card-vat {
        font-size: 11px;
        color: #999;
        display: block;
    }
    .program-card-total {
        font-size: 13px;
        font-weight: 700;
        color: #333;
        display: block;
        margin-bottom: 8px;
    }
    .program-card .btn-subscribe-new {
        display: block;
        width: 100%;
        background: #7e4c8a;
        color: #fff;
        border: none;
        padding: 13px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        transition: background 0.3s, transform 0.2s;
        margin-top: 14px;
    }
    .program-card .btn-subscribe-new:hover {
        background: #6a3d75;
        color: #fff;
        text-decoration: none;
        transform: scale(1.02);
    }

    /* ===== SUBSCRIPTION CATEGORY TABS ===== */
    .subscription-tabs-nav {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 14px;
        margin-bottom: 45px;
    }
    .subscription-tab-item {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #fff;
        border: 2px solid transparent;
        border-radius: 50px;
        padding: 8px 22px 8px 8px;
        cursor: pointer;
        box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        transition: all 0.3s ease;
    }
    [dir="rtl"] .subscription-tab-item {
        padding: 8px 8px 8px 22px;
    }
    .subscription-tab-item:hover {
        box-shadow: 0 10px 25px rgba(126,76,138,0.2);
        transform: translateY(-2px);
    }
    .subscription-tab-item.active {
        background: #7e4c8a;
        border-color: #7e4c8a;
        box-shadow: 0 10px 25px rgba(126,76,138,0.35);
    }
    .subscription-tab-img {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
        background: #f0e6f6;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .subscription-tab-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .subscription-tab-img-generic {
        color: #7e4c8a;
        font-size: 18px;
    }
    .subscription-tab-item.active .subscription-tab-img-generic {
        color: #fff;
    }
    .subscription-tab-name {
        font-family: 'droid arabic kufi', 'Source Sans Pro', sans-serif;
        font-size: 17px;
        font-weight: 700;
        letter-spacing: 0.2px;
        color: #333;
        white-space: nowrap;
        transition: color 0.3s ease;
    }
    .subscription-tab-item.active .subscription-tab-name {
        color: #fff;
    }
    .subscription-tab-panel {
        display: none;
    }
    .subscription-tab-panel.active {
        display: block;
        animation: subscriptionTabFade 0.4s ease;
    }
    @keyframes subscriptionTabFade {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media only screen and (max-width: 768px) {
        .featured-programs-sec {
            padding: 50px 0;
        }
        .subscription-tabs-nav {
            flex-wrap: nowrap;
            justify-content: flex-start;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scroll-snap-type: x proximity;
            gap: 10px;
            margin: 0 -15px 30px;
            padding: 4px 15px 10px;
        }
        .subscription-tabs-nav::-webkit-scrollbar {
            height: 4px;
        }
        .subscription-tabs-nav::-webkit-scrollbar-thumb {
            background: rgba(126,76,138,0.3);
            border-radius: 10px;
        }
        .subscription-tab-item {
            flex-shrink: 0;
            scroll-snap-align: start;
            padding: 6px 16px 6px 6px;
        }
        [dir="rtl"] .subscription-tab-item {
            padding: 6px 6px 6px 16px;
        }
        .subscription-tab-img {
            width: 36px;
            height: 36px;
        }
        .subscription-tab-name {
            font-size: 14px;
        }
        .program-card-img,
        .program-card-img-placeholder {
            height: 150px;
        }
        .program-card-body {
            padding: 18px 16px;
        }
        .program-card-price {
            font-size: 24px;
        }
    }

    /* ===== MODERN ACTIVITIES SECTION ===== */
    .activities-modern-sec {
        padding: 80px 0;
        background: linear-gradient(135deg, #1a0a2e 0%, #3d1a5c 55%, #7e4c8a 100%);
        position: relative;
        overflow: hidden;
    }
    .activities-modern-sec::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -20%;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(168,107,191,0.15) 0%, transparent 70%);
        pointer-events: none;
    }
    .activities-modern-sec .default-title h2 {
        color: #fff;
    }
    .activities-modern-sec .default-title h2 span {
        color: #d4a8e8;
    }
    .activities-modern-sec .title-bdr {
        background: rgba(255,255,255,0.15);
    }
    .activities-modern-sec .title-bdr-inside {
        background: #d4a8e8;
    }
    .activity-card {
        background: rgba(255,255,255,0.07);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.13);
        border-radius: 18px;
        padding: 38px 20px 32px;
        margin-bottom: 25px;
        transition: transform 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
    }
    .activity-card:hover {
        transform: translateY(-9px);
        background: rgba(255,255,255,0.14);
        box-shadow: 0 22px 45px rgba(0,0,0,0.35);
    }
    .activity-icon-wrap {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: linear-gradient(135deg, #7e4c8a, #b07fc8);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        box-shadow: 0 8px 24px rgba(126,76,138,0.55);
    }
    .activity-icon-wrap i {
        font-size: 28px;
        color: #fff;
    }
    .activity-card-title {
        color: #fff;
        font-size: 15px;
        font-weight: 600;
        margin: 0;
        text-transform: none;
        letter-spacing: 0;
        line-height: 1.5;
    }

    /* ===== BMI CALCULATOR SECTION ===== */
    .bmi-calc-sec {
        padding: 80px 0;
        background: #fff;
    }
    .bmi-calc-sec .default-title h2 span { color: #7e4c8a; }
    .bmi-calc-sec .title-bdr { background: #f0e6f8; }
    .bmi-calc-sec .title-bdr-inside { background: #7e4c8a; }

    .bmi-form-card, .bmi-result-card {
        background: #f7f3fa;
        border-radius: 18px;
        padding: 32px 28px;
        box-shadow: 0 6px 28px rgba(126,76,138,0.10);
        height: 100%;
    }
    .bmi-gender-row {
        display: flex;
        gap: 14px;
        margin-bottom: 24px;
    }
    .bmi-gender-btn {
        flex: 1;
        background: #fff;
        border: 2px solid #e0d4eb;
        border-radius: 12px;
        padding: 14px 10px;
        cursor: pointer;
        font-size: 15px;
        color: #888;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        transition: all 0.25s;
    }
    .bmi-gender-btn i { font-size: 26px; }
    .bmi-gender-btn.active {
        background: #7e4c8a;
        border-color: #7e4c8a;
        color: #fff;
        box-shadow: 0 4px 14px rgba(126,76,138,0.30);
    }
    .bmi-input-group {
        margin-bottom: 20px;
    }
    .bmi-input-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #555;
        margin-bottom: 8px;
        text-transform: none;
    }
    .bmi-number-input {
        display: flex;
        align-items: center;
        background: #fff;
        border: 2px solid #e0d4eb;
        border-radius: 12px;
        overflow: hidden;
    }
    .bmi-number-input button {
        width: 44px;
        height: 48px;
        border: none;
        background: transparent;
        font-size: 22px;
        color: #7e4c8a;
        cursor: pointer;
        font-weight: 700;
        flex-shrink: 0;
        transition: background 0.2s;
    }
    .bmi-number-input button:hover { background: #f0e6f8; }
    .bmi-number-input input {
        flex: 1;
        border: none;
        text-align: center;
        font-size: 18px;
        font-weight: 700;
        color: #333 !important;
        background: transparent;
        outline: none;
        padding: 0;
        -moz-appearance: textfield;
    }
    .bmi-number-input input::-webkit-outer-spin-button,
    .bmi-number-input input::-webkit-inner-spin-button { -webkit-appearance: none; }
    .bmi-calc-btn {
        width: 100%;
        background: linear-gradient(135deg, #7e4c8a, #a86bbf);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 15px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        margin-top: 8px;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 16px rgba(126,76,138,0.35);
    }
    .bmi-calc-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(126,76,138,0.45);
    }
    .bmi-calc-btn i { margin-left: 8px; margin-right: 8px; }

    /* result card */
    .bmi-gauge-wrap {
        text-align: center;
        margin-bottom: 8px;
    }
    .bmi-gauge-svg {
        width: 200px;
        height: 110px;
    }
    .bmi-value-display {
        text-align: center;
        margin-bottom: 20px;
    }
    .bmi-value-num {
        display: block;
        font-size: 52px;
        font-weight: 800;
        color: #7e4c8a;
        line-height: 1;
    }
    .bmi-value-label {
        display: block;
        font-size: 15px;
        font-weight: 600;
        color: #888;
        margin-top: 4px;
    }
    .bmi-categories { margin-bottom: 16px; }
    .bmi-cat-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 12px;
        border-radius: 8px;
        margin-bottom: 6px;
        transition: background 0.25s;
    }
    .bmi-cat-item.active { background: rgba(126,76,138,0.10); }
    .bmi-cat-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .bmi-cat-range {
        font-size: 12px;
        color: #888;
        width: 80px;
        flex-shrink: 0;
    }
    .bmi-cat-name {
        font-size: 13px;
        font-weight: 600;
        color: #444;
    }
    .bmi-cat-item.active .bmi-cat-name { color: #7e4c8a; }
    .bmi-ideal-weight {
        background: #f0e6f8;
        border-radius: 10px;
        padding: 12px 14px;
        display: flex;
        align-items: flex-start;
        gap: 8px;
        font-size: 13px;
        color: #555;
    }
    .bmi-ideal-weight i { color: #7e4c8a; margin-top: 2px; flex-shrink: 0; }

    /* ===== PRODUCTS SECTION ===== */
    .products-sec {
        padding: 0;
        background: #F5F5F5;
        overflow: hidden;
    }
    .products-sec .default-title h2 span {
        color: #7e4c8a;
    }
    .products-carousel {
        padding: 8px 0 12px;
    }
    .products-carousel .slick-slide {
        padding: 6px 12px;
    }
    .product-card {
        text-align: center;
        cursor: pointer;
        outline: none;
    }
    .product-img-circle {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 10px;
        box-shadow: 0 6px 22px rgba(126,76,138,0.18);
        background: linear-gradient(135deg, #f0e6f8, #e8d8f5);
        transition: transform 0.35s ease, box-shadow 0.35s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .product-img-circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
        display: block;
    }
    .product-card:hover .product-img-circle {
        transform: translateY(-7px);
        box-shadow: 0 16px 38px rgba(126,76,138,0.3);
    }
    .product-card:hover .product-img-circle img {
        transform: scale(1.1);
    }
    .product-img-circle.placeholder img {
        width: 65%;
        height: 65%;
        object-fit: contain;
        opacity: 0.75;
    }
    .product-card-name {
        font-size: 13px;
        font-weight: 700;
        color: #333;
        text-align: center;
        letter-spacing: 0;
        text-transform: none;
        line-height: 1.4;
        padding: 0 6px;
    }
    .products-sec .slick-prev,
    .products-sec .slick-next {
        width: 40px;
        height: 40px;
        background: #7e4c8a;
        border-radius: 50%;
        z-index: 10;
        transition: background 0.3s;
    }
    .products-sec .slick-prev:hover,
    .products-sec .slick-next:hover { background: #6a3d75; }
    .products-sec .slick-prev:before,
    .products-sec .slick-next:before { font-size: 16px; color: #fff; opacity: 1; }
    .products-sec .slick-prev { left: 0; }
    .products-sec .slick-next { right: 0; }
    .products-sec .slick-dots li button:before { color: #7e4c8a; font-size: 9px; opacity: 0.35; }
    .products-sec .slick-dots li.slick-active button:before { color: #7e4c8a; opacity: 1; }

</style>

@endsection
@section('content')
    <!-- SLIDER -->

    <!-- Main Slider Start -->
    <section class="main-slider-sec">
        <!-- Pogo Silder Start -->
        <div class="pogoSlider" id="pogo-slider">
            @foreach($cover_images as $cover_image)
            <div class="pogoSlider-slide" data-transition="shrinkReveal" data-duration="1000" style="background-image:url({{$cover_image}});">
                <!-- Slider Elements -->
                <div class="silder-elements">
                    <h2 class="pogoSlider-slide-element slider-main-title" data-in="slideDown" data-out="slideUp" data-duration="750" data-delay="500"> <span class="invisible-mobile ">{{$mainSettings['name']}}</span></h2>
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

    @if(isset($stores) && count($stores) > 0)
    <section id="products" class="about-sec" style="padding: 50px 0 0 !important;">
        <div class="container">
            <div class="products-carousel">
                @foreach($stores as $store)
                <div>
                    <div class="product-card">
                        @php $hasImage = $store->image_name; @endphp
                        <div class="product-img-circle {{ $hasImage ? '' : 'placeholder' }}">
                            @if($hasImage)
                                <img src="{{ $store->image }}" alt="{{ $store->name }}">
                            @else
                                <img src="{{ asset('Modules/Dietplate/resources/assets/img/logo.png') }}" alt="{{ $store->name }}">
                            @endif
                        </div>
                        <div class="product-card-name">{{ $store->display_name }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Features Section Start -->
<!-- <section class="features-sec">
    <div class="container">
        <div class="row justify-content-center animatedParent animateOnce">
            <div class="col-lg-4 col-md-6 animated bounceInUp slow">
                <div class="features-col col-default-mb30">
                    <div class="features-img">
                        <img src="images/rtl-images/features/1.jpg" alt="">
                        <div class="features-title">
                            <h3>رفع الاثقال</h3>
                            <p>اجعل جسمك لائقًا</p>
                        </div>
                        <div class="features-content">
                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 animated bounceInUp slow delay-250">
                <div class="features-col col-default-mb30">
                    <div class="features-img">
                        <img src="images/rtl-images/features/2.jpg" alt="">
                        <div class="features-title">
                            <h3>تدريب اليوجا</h3>
                            <p>اجعل جسمك لائقًا</p>
                        </div>
                        <div class="features-content">
                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 animated bounceInUp slow delay-500">
                <div class="features-col col-default-mb30">
                    <div class="features-img">
                        <img src="images/rtl-images/features/3.jpg" alt="">
                        <div class="features-title">
                            <h3>تدريب كروس فيت</h3>
                            <p>اجعل جسمك لائقًا</p>
                        </div>
                        <div class="features-content">
                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

    <!-- About Section -->
    <section id="about" class="about-sec"  style="padding: 50px 0 0 !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="about-title">
                        <h1>{{trans('front.welcome')}} <span><?php echo $mainSettings['name']?></span></h1>
                        <!--                    <p>حافظ على جسمك لائقًا وقويًا</p>-->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="about-col">
                        <!--                    <h3>تعرف على  Fitme</h3>-->
                        <!--                    <p>ناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال </p>-->

                    </div>
                </div>
            </div>
            <div class="row animatedParent animateOnce">
                <div class="col-lg-7">
                    <div class="about-col">
                        <div class="row">
                            <div style="padding: 0px 10px;"><?php echo $mainSettings['about']?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="animated bounceInLeft slow about-video-wrap">
                        <video autoplay muted loop playsinline>
                            <source src="https://cdn.dietcenter.com.sa/sekaweeeeeb.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="how-it-works-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="default-title text-center">
                        <h2><span>{{ $lang == 'ar' ? 'كيف يعمل' : 'How It Works' }}</span></h2>
                        <div class="title-bdr"><div class="title-bdr-inside"></div></div>
                        <p>{{ $lang == 'ar' ? 'خطوات بسيطة للبدء في رحلتك الصحية' : 'Simple steps to start your healthy journey' }}</p>
                    </div>
                </div>
            </div>
            <div class="row animatedParent animateOnce justify-content-center">
                <div class="col-lg-3 col-sm-6 animated bounceInUp slow">
                    <div class="hiw-step">
                        <span class="hiw-step-num">1</span>
                        <i class="fa fa-list-ul hiw-step-icon"></i>
                        <h4>{{ $lang == 'ar' ? 'اختر برنامجك' : 'Choose Your Plan' }}</h4>
                        <p>{{ $lang == 'ar' ? 'تصفح باقاتنا المتنوعة واختر الأنسب لأهدافك الصحية' : 'Browse our programs and choose what fits your health goals' }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 animated bounceInUp slow delay-250">
                    <div class="hiw-step">
                        <span class="hiw-step-num">2</span>
                        <i class="fa fa-user-plus hiw-step-icon"></i>
                        <h4>{{ $lang == 'ar' ? 'أدخل بياناتك' : 'Enter Your Details' }}</h4>
                        <p>{{ $lang == 'ar' ? 'أكمل بياناتك الشخصية لتخصيص البرنامج وفق احتياجاتك' : 'Complete your profile to personalize the program for you' }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 animated bounceInUp slow delay-500">
                    <div class="hiw-step">
                        <span class="hiw-step-num">3</span>
                        <i class="fa fa-credit-card hiw-step-icon"></i>
                        <h4>{{ $lang == 'ar' ? 'أكّد طلبك' : 'Confirm Your Order' }}</h4>
                        <p>{{ $lang == 'ar' ? 'اختر طريقة الدفع وأكد اشتراكك بكل سهولة وأمان' : 'Select a payment method and confirm your subscription securely' }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 animated bounceInUp slow delay-750">
                    <div class="hiw-step">
                        <span class="hiw-step-num">4</span>
                        <i class="fa fa-heart hiw-step-icon"></i>
                        <h4>{{ $lang == 'ar' ? 'استمتع بنتائجك' : 'Enjoy Your Results' }}</h4>
                        <p>{{ $lang == 'ar' ? 'ابدأ رحلتك نحو حياة أكثر صحة وتوازناً مع خبرائنا' : 'Begin your journey to a healthier, balanced life with our experts' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

    

    @if(isset($subscriptions) && (count($subscriptions) > 0))
    <!-- Featured Programs Section -->
    <section id="subscriptions" class="featured-programs-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="default-title text-center">
                        <h2><span>{{trans('front.subscriptions')}}</span></h2>
                        <div class="title-bdr"><div class="title-bdr-inside"></div></div>
                    </div>
                </div>
            </div>

            @php
                $subscriptionCategories = $subscriptionCategories ?? collect();
                $uncategorizedSubscriptions = $uncategorizedSubscriptions ?? collect();
                $hasUncategorized = count($uncategorizedSubscriptions) > 0;
                $tabsCount = count($subscriptionCategories) + ($hasUncategorized ? 1 : 0);
            @endphp

            @if($tabsCount > 1)
            <div class="subscription-tabs-nav">
                @foreach($subscriptionCategories as $index => $category)
                <button type="button" class="subscription-tab-item {{ $index === 0 ? 'active' : '' }}" data-target="#subscription-panel-{{ $category->id }}">
                    <span class="subscription-tab-img">
                        <img src="{{ $category->image }}" alt="{{ $category->name }}">
                    </span>
                    <span class="subscription-tab-name">{{ $category->name }}</span>
                </button>
                @endforeach
                @if($hasUncategorized)
                <button type="button" class="subscription-tab-item {{ count($subscriptionCategories) === 0 ? 'active' : '' }}" data-target="#subscription-panel-other">
                    <span class="subscription-tab-img subscription-tab-img-generic">
                        <i class="fa fa-star"></i>
                    </span>
                    <span class="subscription-tab-name">{{trans('front.other_subscriptions')}}</span>
                </button>
                @endif
            </div>
            @endif

            <div class="subscription-tabs-content">
                @foreach($subscriptionCategories as $index => $category)
                <div id="subscription-panel-{{ $category->id }}" class="subscription-tab-panel {{ $index === 0 ? 'active' : '' }}">
                    <div class="row">
                        @foreach($category->subscriptions as $subscription)
                        <div class="col-lg-3 col-md-6 d-flex">
                            @include('Dietplate::Front.layouts.partials.subscription_card')
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach

                @if($hasUncategorized)
                <div id="subscription-panel-other" class="subscription-tab-panel {{ count($subscriptionCategories) === 0 ? 'active' : '' }}">
                    <div class="row">
                        @foreach($uncategorizedSubscriptions as $subscription)
                        <div class="col-lg-3 col-md-6 d-flex">
                            @include('Dietplate::Front.layouts.partials.subscription_card')
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    @endif
<!-- BMI Calculator Section -->
    <section id="bmi-calculator" class="bmi-calc-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="default-title text-center">
                        <h2><span>{{trans('front.bmi_calculator')}}</span></h2>
                        <div class="title-bdr"><div class="title-bdr-inside"></div></div>
                        <p>{{trans('front.bmi_calculator_desc')}}</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center animatedParent animateOnce">
                <!-- Form -->
                <div class="col-lg-5 col-md-6 animated bounceInUp slow" style="margin-bottom:30px;">
                    <div class="bmi-form-card">
                        <div class="bmi-gender-row">
                            <button type="button" class="bmi-gender-btn active" data-gender="male" onclick="setBmiGender('male')">
                                <i class="fa fa-male"></i>
                                <span>{{trans('front.bmi_male')}}</span>
                            </button>
                            <button type="button" class="bmi-gender-btn" data-gender="female" onclick="setBmiGender('female')">
                                <i class="fa fa-female"></i>
                                <span>{{trans('front.bmi_female')}}</span>
                            </button>
                        </div>
                        <div class="bmi-input-group">
                            <label>{{trans('front.bmi_age')}}</label>
                            <div class="bmi-number-input">
                                <button type="button" onclick="bmiAdjust('age', -1)">−</button>
                                <input type="number" id="bmi-age" value="25" min="5" max="120">
                                <button type="button" onclick="bmiAdjust('age', 1)">+</button>
                            </div>
                        </div>
                        <div class="bmi-input-group">
                            <label>{{trans('front.bmi_height')}}</label>
                            <div class="bmi-number-input">
                                <button type="button" onclick="bmiAdjust('height', -1)">−</button>
                                <input type="number" id="bmi-height" value="170" min="50" max="250">
                                <button type="button" onclick="bmiAdjust('height', 1)">+</button>
                            </div>
                        </div>
                        <div class="bmi-input-group">
                            <label>{{trans('front.bmi_weight')}}</label>
                            <div class="bmi-number-input">
                                <button type="button" onclick="bmiAdjust('weight', -1)">−</button>
                                <input type="number" id="bmi-weight" value="70" min="10" max="300">
                                <button type="button" onclick="bmiAdjust('weight', 1)">+</button>
                            </div>
                        </div>
                        <button type="button" class="bmi-calc-btn" onclick="calculateBMI()">
                            <i class="fa fa-calculator"></i> {{trans('front.bmi_calculate_now')}}
                        </button>
                    </div>
                </div>
                <!-- Result -->
                <div class="col-lg-5 col-md-6 animated bounceInUp slow delay-250" style="margin-bottom:30px;">
                    <div class="bmi-result-card">
                        <div class="bmi-gauge-wrap">
                            <svg viewBox="0 0 200 110" class="bmi-gauge-svg">
                                <!-- Underweight arc (blue) -->
                                <path d="M 30 100 A 70 70 0 0 1 56 46" stroke="#64b5f6" stroke-width="13" fill="none" stroke-linecap="round"/>
                                <!-- Normal arc (green) -->
                                <path d="M 56 46 A 70 70 0 0 1 100 30" stroke="#81c784" stroke-width="13" fill="none" stroke-linecap="round"/>
                                <!-- Overweight arc (orange) -->
                                <path d="M 100 30 A 70 70 0 0 1 135 39" stroke="#ffb74d" stroke-width="13" fill="none" stroke-linecap="round"/>
                                <!-- Obese arc (red) -->
                                <path d="M 135 39 A 70 70 0 0 1 170 100" stroke="#e57373" stroke-width="13" fill="none" stroke-linecap="round"/>
                                <!-- Needle -->
                                <line id="bmi-needle" x1="100" y1="100" x2="100" y2="36"
                                      stroke="#7e4c8a" stroke-width="3" stroke-linecap="round"
                                      transform="rotate(-90, 100, 100)"/>
                                <circle cx="100" cy="100" r="7" fill="#7e4c8a"/>
                            </svg>
                        </div>
                        <div class="bmi-value-display">
                            <span class="bmi-value-num" id="bmi-value">--</span>
                            <span class="bmi-value-label" id="bmi-category-label">{{trans('front.bmi_enter_data')}}</span>
                        </div>
                        <div class="bmi-categories">
                            <div class="bmi-cat-item" id="bmi-cat-underweight">
                                <span class="bmi-cat-dot" style="background:#64b5f6"></span>
                                <span class="bmi-cat-range">&lt; 18.5</span>
                                <span class="bmi-cat-name">{{trans('front.bmi_underweight')}}</span>
                            </div>
                            <div class="bmi-cat-item" id="bmi-cat-normal">
                                <span class="bmi-cat-dot" style="background:#81c784"></span>
                                <span class="bmi-cat-range">18.5 – 24.9</span>
                                <span class="bmi-cat-name">{{trans('front.bmi_normal_weight')}}</span>
                            </div>
                            <div class="bmi-cat-item" id="bmi-cat-overweight">
                                <span class="bmi-cat-dot" style="background:#ffb74d"></span>
                                <span class="bmi-cat-range">25 – 29.9</span>
                                <span class="bmi-cat-name">{{trans('front.bmi_overweight')}}</span>
                            </div>
                            <div class="bmi-cat-item" id="bmi-cat-obese">
                                <span class="bmi-cat-dot" style="background:#e57373"></span>
                                <span class="bmi-cat-range">≥ 30</span>
                                <span class="bmi-cat-name">{{trans('front.bmi_obese')}}</span>
                            </div>
                        </div>
                        <div class="bmi-ideal-weight" id="bmi-ideal-weight" style="display:none;">
                            <i class="fa fa-info-circle"></i>
                            <span id="bmi-ideal-text"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @if(isset($activities) && (count($activities) > 0))
    <!-- Activities Section -->
    <section id="activities" class="activities-modern-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="default-title text-center">
                        <h2><span>{{trans('front.activities', [], $lang)}}</span></h2>
                        <div class="title-bdr"><div class="title-bdr-inside"></div></div>
                    </div>
                </div>
            </div>
            <div class="row animatedParent animateOnce justify-content-center">
                @php
                    $activityIcons = ['fa-heartbeat','fa-bicycle','fa-child','fa-leaf','fa-fire','fa-bolt','fa-star','fa-trophy','fa-futbol-o','fa-clock-o','fa-users','fa-bar-chart'];
                @endphp
                @foreach($activities as $index => $activity)
                <div class="col-lg-3 col-md-4 col-sm-6 animated bounceInUp slow">
                    <div class="activity-card text-center">
                        <div class="activity-icon-wrap">
                            <i class="fa {{ $activityIcons[$index % count($activityIcons)] }}"></i>
                        </div>
                        <h4 class="activity-card-title">{{$activity->name}}</h4>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if(isset($images) && (count($images) > 0))
    <section id="gallery" class="gallery-sec clearfix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="default-title text-center">
                        <h2><span>{{trans('front.gallery')}}</span></h2>
                        <div class="title-bdr"><div class="title-bdr-inside"></div></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <ul class="portfolio-all-item">
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
                            <a href="mailto:<?php echo $mainSettings['phone']?>">
                                <div class="angle-box col-default-mb30">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <p><?php echo $mainSettings['support_email']?></p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 animated bounceInUp slow delay-500">
                            <a href="callto:<?php echo $mainSettings['phone']?>">
                                <div class="angle-box col-default-mb30">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <p style="direction: ltr"><?php echo $mainSettings['phone']?></p>
                                </div></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-default-mb30">
                                <form method="post" action="contact.php?lang={{$lang}}">
                                    <input type="hidden" name="csrf" value="{{csrf_token()}}">
                                    <input type="text" name="name" class="form-control" placeholder="{{trans('front.name')}}" required="">
                                    <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="{{trans('front.email')}}" required="">
                                    <!--                                <input type="text" class="form-control" placeholder="عدد">-->
                                    <textarea class="form-control textarea-hight-full" name="message" rows="6" required="" placeholder="{{trans('front.message')}}"></textarea>
                                    <button class="btn btn-default simple-btn" type="submit">{{trans('front.send')}}</button>
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

    <!-- Scroll Up -->
    <div class="goto-top-section">
        <span class="triangle"></span>
        <a class="js-scroll-trigger" href="#page-top">
            <i class="fa fa-angle-double-up" aria-hidden="true"></i>
        </a>
    </div>



@endsection
@section('script')
<script>
// Subscription category tabs
document.querySelectorAll('.subscription-tab-item').forEach(function(tab) {
    tab.addEventListener('click', function() {
        var target = document.querySelector(tab.dataset.target);
        if (!target) return;
        document.querySelectorAll('.subscription-tab-item').forEach(function(t) { t.classList.remove('active'); });
        document.querySelectorAll('.subscription-tab-panel').forEach(function(p) { p.classList.remove('active'); });
        tab.classList.add('active');
        target.classList.add('active');
    });
});

// BMI Calculator
var bmiGender = 'male';
var bmiLang   = '{{ $lang }}';
function setBmiGender(g) {
    bmiGender = g;
    document.querySelectorAll('.bmi-gender-btn').forEach(function(btn) {
        btn.classList.toggle('active', btn.dataset.gender === g);
    });
}
function bmiAdjust(field, delta) {
    var el  = document.getElementById('bmi-' + field);
    var val = parseInt(el.value) + delta;
    el.value = Math.max(parseInt(el.min), Math.min(parseInt(el.max), val));
}
function calculateBMI() {
    var weight = parseFloat(document.getElementById('bmi-weight').value);
    var heightCm = parseFloat(document.getElementById('bmi-height').value);
    if (!weight || !heightCm || heightCm <= 0) return;
    var h = heightCm / 100;
    var bmi = Math.round((weight / (h * h)) * 10) / 10;
    document.getElementById('bmi-value').textContent = bmi;

    var category, label;
    if (bmi < 18.5) {
        category = 'underweight';
        label = bmiLang === 'ar' ? 'نقص الوزن' : 'Underweight';
    } else if (bmi < 25) {
        category = 'normal';
        label = bmiLang === 'ar' ? 'وزن طبيعي' : 'Normal Weight';
    } else if (bmi < 30) {
        category = 'overweight';
        label = bmiLang === 'ar' ? 'زيادة الوزن' : 'Overweight';
    } else {
        category = 'obese';
        label = bmiLang === 'ar' ? 'سمنة' : 'Obese';
    }
    document.getElementById('bmi-category-label').textContent = label;

    // Rotate needle: BMI=10 → -90°, BMI=40 → +90° (linear)
    var angle = Math.max(-90, Math.min(90, (bmi - 10) / 30 * 180 - 90));
    document.getElementById('bmi-needle').setAttribute('transform', 'rotate(' + angle + ', 100, 100)');

    ['underweight', 'normal', 'overweight', 'obese'].forEach(function(cat) {
        document.getElementById('bmi-cat-' + cat).classList.toggle('active', cat === category);
    });

    var idealMin = Math.round(18.5 * h * h * 10) / 10;
    var idealMax = Math.round(24.9 * h * h * 10) / 10;
    var idealText = bmiLang === 'ar'
        ? 'نطاق وزنك المثالي: ' + idealMin + ' – ' + idealMax + ' كجم'
        : 'Your ideal weight range: ' + idealMin + ' – ' + idealMax + ' kg';
    document.getElementById('bmi-ideal-text').textContent = idealText;
    document.getElementById('bmi-ideal-weight').style.display = 'flex';
}

$(document).ready(function(){
    if ($('.products-carousel').length && $('.products-carousel .slick-slide').length === 0) {
        $('.products-carousel').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2800,
            infinite: true,
            dots: true,
            arrows: true,
            rtl: {{ $lang == 'ar' ? 'true' : 'false' }},
            responsive: [
                { breakpoint: 1200, settings: { slidesToShow: 4 } },
                { breakpoint: 992,  settings: { slidesToShow: 3 } },
                { breakpoint: 768,  settings: { slidesToShow: 2 } },
                { breakpoint: 480,  settings: { slidesToShow: 1 } }
            ]
        });
    }
});
</script>
@endsection
