@extends('fitdose::Front.layouts.master')
@section('style')
<style>
    :root {
        --fd-gold: #c8a84b;
        --fd-gold-light: #e8c870;
        --fd-dark: #101012;
        --fd-dark-2: #222429;
        --fd-dark-3: #2b2e34;
        --fd-text-light: #f5f0e6;
        --fd-muted: #9a9a9a;
        --fd-radius: 18px;
    }

    /* Original slider styles (kept for pogoSlider plugin) */
    .tp-caption {
        background: rgba(0,0,0,.5);
        border-radius: 20px;
        padding: 15px !important;
        opacity: 100% !important;
    }
    input { color: white !important; }
    ::-webkit-input-placeholder { color: white; }
    :-ms-input-placeholder { color: white; }
    ::placeholder { color: white; }
    @media screen and (min-width: 767px) {
        .header-offset-mobile {
            margin-top: -110px;
            overflow: hidden;
            float: left;
            width: 100%;
        }
        .tp-caption { left: 110px !important; }
    }
    @media only screen and (max-width: 768px) {
        div .ok-xsd-6 { width: 50% !important; }
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

    /* ---------- Scroll reveal ---------- */
    .fd-reveal {
        opacity: 0;
        transform: translateY(28px);
        transition: opacity .7s ease, transform .7s ease;
    }
    .fd-reveal.fd-in {
        opacity: 1;
        transform: translateY(0);
    }

    /* ---------- Hero ---------- */
    .main-slider-sec { position: relative; }
    .pogoSlider-slide {
        background-size: cover !important;
        background-position: center !important;
    }
    .pogoSlider-slide::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(10,10,10,.55) 0%, rgba(10,10,10,.35) 45%, rgba(10,10,10,.85) 100%);
    }
    .silder-elements { position: relative; z-index: 2; }
    .pogoSlider-slide .slider-main-title {
        font-weight: 800;
        letter-spacing: 1px;
        text-shadow: 0 4px 24px rgba(0,0,0,.5);
    }
    .pogoSlider-slide .slider-main-title span {
        color: var(--fd-gold-light);
    }
    .join-btn {
        background: linear-gradient(135deg, var(--fd-gold) 0%, var(--fd-gold-light) 100%) !important;
        border: none !important;
        color: #1a1408 !important;
        font-weight: 700;
        border-radius: 30px !important;
        padding: 14px 38px !important;
        box-shadow: 0 8px 28px rgba(200,168,75,.45);
        transition: transform .25s ease, box-shadow .25s ease;
    }
    .join-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 34px rgba(200,168,75,.6);
        color: #1a1408 !important;
    }

    /* ---------- Section header (shared) ---------- */
    .fd-section {
        padding: 90px 0;
        position: relative;
    }
    .fd-section-dark {
        background: var(--fd-dark);
        color: var(--fd-text-light);
    }
    .fd-section-light {
        background: #f7f6f3;
    }
    .fd-eyebrow {
        display: inline-block;
        font-size: .95rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--fd-gold);
        margin-bottom: 12px;
    }
    /* Legacy template forces h1-h6 { color:#111 } with an element selector,
       which beats any inherited color from a parent - headings need an
       explicit color or they render invisible on dark sections. */
    .fd-section-title {
        font-size: 2.6rem;
        font-weight: 800;
        margin-bottom: 14px;
        color: #16181c;
    }
    .fd-section-dark .fd-section-title { color: #ffffff; }
    .fd-section-title span { color: var(--fd-gold); }
    .fd-section-sub {
        color: var(--fd-muted);
        font-size: 1.02rem;
        max-width: 640px;
        margin: 0 auto;
    }
    .fd-section-dark .fd-section-sub { color: #b7b3a8; }
    .fd-underline {
        width: 64px;
        height: 4px;
        margin: 18px auto 26px;
        border-radius: 4px;
        background: linear-gradient(90deg, var(--fd-gold), var(--fd-gold-light));
    }
    .fd-header-center { text-align: center; margin-bottom: 55px; }
    @media (max-width: 767px) {
        .fd-section-title { font-size: 1.9rem; }
    }

    /* ---------- About ---------- */
    .fd-about-grid {
        display: grid;
        grid-template-columns: 1.05fr .95fr;
        gap: 55px;
        align-items: center;
    }
    .fd-about-media {
        position: relative;
        border-radius: var(--fd-radius);
        overflow: hidden;
        min-height: 380px;
        box-shadow: 0 25px 50px rgba(0,0,0,.12);
    }
    .fd-about-media img {
        width: 100%;
        height: 100%;
        min-height: 380px;
        object-fit: cover;
        display: block;
    }
    .fd-about-media::after {
        content: '';
        position: absolute;
        inset: 0;
        border: 3px solid var(--fd-gold);
        border-radius: var(--fd-radius);
        margin: 14px;
        pointer-events: none;
        opacity: .55;
    }
    .fd-about-text .fd-eyebrow { color: var(--fd-gold); }
    .fd-about-text h2 { font-size: 2.3rem; font-weight: 800; margin-bottom: 20px; color: #16181c; }
    .fd-about-text h2 span { color: var(--fd-gold); }
    .fd-about-content {
        color: #4d4d4d;
        line-height: 1.9;
        font-size: 1.02rem;
    }
    .fd-about-content p { margin-bottom: 14px; }
    @media (max-width: 991px) {
        .fd-about-grid { grid-template-columns: 1fr; }
        .fd-about-media { order: -1; }
    }

    /* ---------- Why Fit Dose ---------- */
    .fd-why-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 24px;
    }
    .fd-why-card {
        background: #fff;
        border-radius: var(--fd-radius);
        padding: 32px 24px;
        text-align: center;
        box-shadow: 0 12px 30px rgba(0,0,0,.06);
        transition: transform .3s ease, box-shadow .3s ease;
    }
    .fd-why-card:hover { transform: translateY(-6px); box-shadow: 0 18px 40px rgba(0,0,0,.1); }
    .fd-why-icon {
        width: 64px; height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--fd-gold), var(--fd-gold-light));
        color: #1a1408;
        font-size: 24px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 18px;
    }
    .fd-why-card h4 { font-size: 1.1rem; font-weight: 800; color: #16181c; margin-bottom: 10px; }
    .fd-why-card p { color: #666; font-size: .92rem; line-height: 1.75; margin: 0; }

    /* ---------- Activities ---------- */
    .fd-activities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 26px;
    }
    .fd-activity-card {
        position: relative;
        border-radius: var(--fd-radius);
        overflow: hidden;
        height: 260px;
        background-color: var(--fd-dark-2);
        background-size: cover;
        background-position: center;
        border: 1px solid rgba(255,255,255,.1);
        box-shadow: 0 18px 40px rgba(0,0,0,.35);
        transition: transform .35s ease, box-shadow .35s ease, border-color .35s ease;
    }
    .fd-activity-card:hover { transform: translateY(-8px); box-shadow: 0 24px 50px rgba(0,0,0,.5); border-color: rgba(200,168,75,.4); }
    .fd-activity-card::before {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(180deg, rgba(16,16,18,.15) 30%, rgba(16,16,18,.92) 100%);
        transition: background .35s ease;
    }
    .fd-activity-card .fd-activity-icon {
        position: absolute;
        top: 18px;
        {{ $lang == 'ar' ? 'right: 18px;' : 'left: 18px;' }}
        z-index: 2;
        width: 42px; height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--fd-gold), var(--fd-gold-light));
        display: flex; align-items: center; justify-content: center;
        color: #1a1408;
        font-size: 16px;
        box-shadow: 0 6px 16px rgba(200,168,75,.5);
    }
    .fd-activity-body {
        position: absolute;
        left: 0; right: 0; bottom: 0;
        z-index: 2;
        padding: 22px;
    }
    .fd-activity-body h5 {
        color: #fff;
        font-weight: 700;
        font-size: 1.15rem;
        margin: 0;
    }
    /* Fallback variant for activities without an uploaded photo */
    .fd-activity-card.fd-activity-noimg {
        background-image: none !important;
        background: linear-gradient(160deg, var(--fd-dark-3) 0%, #3a3d44 100%);
        border-color: rgba(200,168,75,.3);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        gap: 16px;
        padding: 20px;
    }
    .fd-activity-card.fd-activity-noimg::before { display: none; }
    .fd-activity-card.fd-activity-noimg .fd-activity-icon {
        position: static;
        width: 64px; height: 64px;
        font-size: 24px;
    }
    .fd-activity-card.fd-activity-noimg .fd-activity-body { position: static; padding: 0; }

    /* ---------- Gallery ---------- */
    .fd-gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 18px;
    }
    .fd-gallery-item {
        position: relative;
        border-radius: 14px;
        overflow: hidden;
        aspect-ratio: 1 / 1;
        display: block;
        box-shadow: 0 10px 26px rgba(0,0,0,.08);
    }
    .fd-gallery-item img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
        display: block;
    }
    .fd-gallery-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(180deg, rgba(16,16,18,0) 40%, rgba(16,16,18,.75) 100%);
        opacity: 0;
        transition: opacity .35s ease;
        display: flex; align-items: center; justify-content: center;
    }
    .fd-gallery-overlay i {
        color: var(--fd-gold-light);
        font-size: 26px;
        transform: scale(.7);
        transition: transform .35s ease;
    }
    .fd-gallery-item:hover img { transform: scale(1.08); }
    .fd-gallery-item:hover .fd-gallery-overlay { opacity: 1; }
    .fd-gallery-item:hover .fd-gallery-overlay i { transform: scale(1); }

    /* ---------- Pricing / Subscriptions ---------- */
    .fd-pricing-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 26px;
        align-items: stretch;
    }
    .fd-pricing-card {
        position: relative;
        background: var(--fd-dark-2);
        border: 1px solid rgba(255,255,255,.1);
        border-radius: var(--fd-radius);
        padding: 34px 28px;
        color: var(--fd-text-light);
        display: flex;
        flex-direction: column;
        transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
    }
    .fd-pricing-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 45px rgba(0,0,0,.4);
        border-color: rgba(200,168,75,.4);
    }
    .fd-pricing-card.fd-featured {
        background: linear-gradient(160deg, var(--fd-dark-3) 0%, #241f12 100%);
        border-color: var(--fd-gold);
        transform: scale(1.03);
    }
    .fd-featured-badge {
        position: absolute;
        top: -14px;
        {{ $lang == 'ar' ? 'right: 24px;' : 'left: 24px;' }}
        background: linear-gradient(135deg, var(--fd-gold), var(--fd-gold-light));
        color: #1a1408;
        font-weight: 700;
        font-size: .75rem;
        padding: 6px 16px;
        border-radius: 20px;
        box-shadow: 0 4px 14px rgba(200,168,75,.5);
    }
    .fd-pricing-card h4.fd-plan-name {
        font-size: 1.35rem;
        font-weight: 800;
        margin-bottom: 6px;
        color: #fff;
    }
    .fd-plan-desc {
        color: var(--fd-muted);
        font-size: .88rem;
        margin-bottom: 18px;
        min-height: 20px;
    }
    .fd-plan-meta {
        list-style: none;
        padding: 0; margin: 0 0 20px;
    }
    .fd-plan-meta li {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 7px 0;
        border-bottom: 1px solid rgba(255,255,255,.06);
        font-size: .92rem;
        color: #d8d3c8;
    }
    .fd-plan-meta li i { color: var(--fd-gold); width: 16px; }
    .fd-price-block { margin: auto 0 22px; }
    .fd-price-old {
        text-decoration: line-through;
        color: #777;
        font-size: .85rem;
    }
    .fd-price-discount { color: #7ed99a; font-size: .8rem; display: block; margin: 4px 0; }
    .fd-price-main {
        font-size: 2rem;
        font-weight: 800;
        color: var(--fd-gold-light);
        margin: 4px 0;
    }
    .fd-price-vat { display: block; color: var(--fd-muted); font-size: .78rem; }
    .fd-price-total { display: block; font-size: .9rem; font-weight: 700; color: #fff; margin-top: 4px; }
    .fd-plan-cta {
        display: inline-block;
        text-align: center;
        width: 100%;
        padding: 13px 0;
        border-radius: 30px;
        background: transparent;
        border: 2px solid var(--fd-gold);
        color: var(--fd-gold-light) !important;
        font-weight: 700;
        text-decoration: none !important;
        transition: background .25s ease, color .25s ease;
    }
    .fd-plan-cta:hover {
        background: linear-gradient(135deg, var(--fd-gold), var(--fd-gold-light));
        color: #1a1408 !important;
    }
    .fd-featured .fd-plan-cta {
        background: linear-gradient(135deg, var(--fd-gold), var(--fd-gold-light));
        color: #1a1408 !important;
    }

    /* ---------- Success Stories / Testimonials ---------- */
    .fd-testimonials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 26px;
    }
    .fd-testimonial-card {
        background: #fff;
        border-radius: var(--fd-radius);
        padding: 34px 28px;
        box-shadow: 0 12px 30px rgba(0,0,0,.06);
        transition: transform .3s ease, box-shadow .3s ease;
    }
    .fd-testimonial-card:hover { transform: translateY(-6px); box-shadow: 0 18px 40px rgba(0,0,0,.1); }
    .fd-testimonial-quote-icon {
        color: var(--fd-gold);
        font-size: 26px;
        margin-bottom: 14px;
        display: block;
    }
    .fd-testimonial-stars { color: var(--fd-gold); font-size: .85rem; margin-bottom: 14px; }
    .fd-testimonial-text {
        color: #555;
        line-height: 1.9;
        font-size: .98rem;
        margin-bottom: 22px;
        min-height: 96px;
    }
    .fd-testimonial-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 16px;
        border-top: 1px solid #eee;
    }
    .fd-testimonial-name { font-weight: 700; color: #1a1a1a; }
    .fd-testimonial-result {
        font-size: .75rem;
        font-weight: 700;
        color: #1a1408;
        background: linear-gradient(135deg, var(--fd-gold), var(--fd-gold-light));
        padding: 5px 12px;
        border-radius: 20px;
    }

    /* ---------- FAQ ---------- */
    .fd-faq-list { max-width: 780px; margin: 0 auto; }
    .fd-faq-item {
        background: var(--fd-dark-2);
        border: 1px solid rgba(255,255,255,.1);
        border-radius: 14px;
        margin-bottom: 16px;
        overflow: hidden;
    }
    .fd-faq-item summary {
        list-style: none;
        cursor: pointer;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        font-weight: 700;
        color: #fff;
        font-size: 1.02rem;
    }
    .fd-faq-item summary::-webkit-details-marker { display: none; }
    .fd-faq-item .fd-faq-toggle {
        flex-shrink: 0;
        width: 30px; height: 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--fd-gold), var(--fd-gold-light));
        color: #1a1408;
        display: flex; align-items: center; justify-content: center;
        font-size: 14px;
        transition: transform .25s ease;
    }
    .fd-faq-item[open] .fd-faq-toggle { transform: rotate(45deg); }
    .fd-faq-answer {
        padding: 0 24px 22px;
        color: var(--fd-muted);
        line-height: 1.85;
        font-size: .95rem;
    }

    /* ---------- Contact ---------- */
    .fd-contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 45px;
    }
    .fd-contact-card {
        background: #fff;
        border-radius: 16px;
        padding: 28px 22px;
        text-align: center;
        box-shadow: 0 12px 30px rgba(0,0,0,.06);
        transition: transform .3s ease, box-shadow .3s ease;
    }
    .fd-contact-card:hover { transform: translateY(-6px); box-shadow: 0 18px 40px rgba(0,0,0,.1); }
    .fd-contact-card i {
        width: 56px; height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--fd-gold), var(--fd-gold-light));
        color: #1a1408;
        font-size: 20px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 16px;
    }
    .fd-contact-form-card, .fd-contact-map-card {
        background: #fff;
        border-radius: var(--fd-radius);
        overflow: hidden;
        box-shadow: 0 12px 30px rgba(0,0,0,.06);
        height: 100%;
    }
    .fd-contact-form-card { padding: 30px; }
    .fd-contact-form-card .form-control {
        border-radius: 10px;
        border: 1px solid #e3e0d8;
        padding: 12px 16px;
        margin-bottom: 16px;
        color: #333 !important;
    }
    .fd-contact-form-card .form-control::placeholder { color: #999 !important; }
    .fd-contact-form-card button {
        background: linear-gradient(135deg, var(--fd-gold), var(--fd-gold-light));
        border: none;
        border-radius: 30px;
        padding: 13px 34px;
        font-weight: 700;
        color: #1a1408;
    }
    .fd-contact-map-card iframe { width: 100%; height: 100%; min-height: 380px; border: 0; display: block; }
</style>
@endsection
@section('content')

<!-- Main Slider Start -->
<section class="main-slider-sec">
    <div class="pogoSlider" id="pogo-slider">
        @foreach($cover_images as $cover_image)
        <div class="pogoSlider-slide" data-transition="shrinkReveal" data-duration="1000" style="background-image:url({{$cover_image}});">
            <div class="silder-elements">
                <h2 class="pogoSlider-slide-element slider-main-title" data-in="slideDown" data-out="slideUp" data-duration="750" data-delay="500"> <span class="invisible-mobile ">{{$mainSettings['name']}}</span></h2>
                <a href="#contact" class="btn btn-default pogoSlider-slide-element join-btn" data-in="expand" data-out="slideUp" data-duration="1500" data-delay="500" type="submit">{{trans('front.join_us')}}</a>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Why Fit Dose Section -->
<section class="fd-section fd-section-light" style="padding-bottom: 40px;">
    <div class="container">
        <div class="fd-header-center fd-reveal">
            <span class="fd-eyebrow">{{trans('front.why_us')}}</span>
            <h2 class="fd-section-title">{{trans('front.why_us_subtitle')}}</h2>
            <div class="fd-underline"></div>
        </div>
        <div class="fd-why-grid">
            @foreach([1, 2, 3, 4] as $w)
            <div class="fd-why-card fd-reveal">
                <span class="fd-why-icon"><i class="fa {{ ['fa-clock-o', 'fa-bolt', 'fa-line-chart', 'fa-shield'][$w-1] }}"></i></span>
                <h4>{{trans('front.why_us_'.$w.'_title')}}</h4>
                <p>{{trans('front.why_us_'.$w.'_text')}}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="fd-section fd-section-light">
    <div class="container">
        <div class="fd-about-grid">
            <div class="fd-about-text fd-reveal">
                <span class="fd-eyebrow">{{trans('front.about_subtitle')}}</span>
                <h2>{{trans('front.welcome')}} <span>{{$mainSettings['name']}}</span></h2>
                <div class="fd-about-content">{!! $mainSettings['about'] !!}</div>
            </div>
            <div class="fd-about-media fd-reveal">
                @php
                    $aboutImage = null;
                    if (isset($images) && count($images) > 0) {
                        $aboutImage = env('APP_URL_MASTER').'uploads/settings/gyms/'.array_values($images)[0];
                    } elseif (!empty($mainSettings['logo'])) {
                        $aboutImage = $mainSettings['logo'];
                    }
                @endphp
                @if($aboutImage)
                    <img src="{{$aboutImage}}" alt="{{$mainSettings['name']}}">
                @endif
            </div>
        </div>
    </div>
</section>

@if(isset($activities) && (count($activities) > 0))
<!-- Activities Section -->
<section id="activities" class="fd-section fd-section-dark">
    <div class="container">
        <div class="fd-header-center fd-reveal">
            <span class="fd-eyebrow">{{trans('front.activities')}}</span>
            <h2 class="fd-section-title">{{trans('front.activities_subtitle')}}</h2>
            <div class="fd-underline"></div>
        </div>
        <div class="fd-activities-grid">
            @foreach($activities as $activity)
            @php $hasActivityImage = !empty($activity->image_name); @endphp
            <div class="fd-activity-card fd-reveal {{ $hasActivityImage ? '' : 'fd-activity-noimg' }}" @if($hasActivityImage) style="background-image:url('{{$activity->image}}');" @endif>
                <span class="fd-activity-icon"><i class="fa fa-heartbeat"></i></span>
                <div class="fd-activity-body">
                    <h5>{{$activity->name}}</h5>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if(isset($images) && (count($images) > 0))
<!-- Gallery Section -->
<section id="gallery" class="fd-section fd-section-light">
    <div class="container">
        <div class="fd-header-center fd-reveal">
            <span class="fd-eyebrow">{{trans('front.gallery')}}</span>
            <h2 class="fd-section-title">{{trans('front.gallery_subtitle')}}</h2>
            <div class="fd-underline"></div>
        </div>
        <div class="fd-gallery-grid">
            @foreach($images as $image)
            <a class="fd-gallery-item gallery fd-reveal" href="{{env('APP_URL_MASTER').'uploads/settings/gyms/'.$image}}">
                <img src="{{env('APP_URL_MASTER').'uploads/settings/gyms/'.$image}}" alt="">
                <div class="fd-gallery-overlay"><i class="fa fa-search-plus"></i></div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@if(isset($subscriptions) && (count($subscriptions) > 0))
<!-- Subscriptions / Pricing Section -->
<section id="subscriptions" class="fd-section fd-section-dark">
    <div class="container">
        <div class="fd-header-center fd-reveal">
            <span class="fd-eyebrow">{{trans('front.subscriptions')}}</span>
            <h2 class="fd-section-title">{{trans('front.subscriptions_subtitle')}}</h2>
            <div class="fd-underline"></div>
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
        @endphp
        <div class="fd-pricing-grid">
            @foreach($subscriptions as $subscription)
            @php $isFeatured = $featuredSubId && $subscription->id === $featuredSubId; @endphp
            <div class="fd-pricing-card fd-reveal {{ $isFeatured ? 'fd-featured' : '' }}">
                @if($isFeatured)
                    <span class="fd-featured-badge">{{trans('front.best_offer')}}</span>
                @endif
                <h4 class="fd-plan-name">{{$subscription->name}}</h4>
                <p class="fd-plan-desc">{{ \Illuminate\Support\Str::limit(strip_tags($subscription->content), 70) }}</p>
                <ul class="fd-plan-meta">
                    <li><i class="fa fa-calendar"></i> {{trans('front.period')}}: {{$subscription->period}} {{trans('front.day')}}</li>
                    <li><i class="fa fa-fire"></i> {{trans('front.session_num')}}: {{$subscription->workouts}}</li>
                </ul>
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
                    $vatAmount = ($vatPercentage / 100) * $priceBeforeVat;
                    $priceWithVat = round($priceBeforeVat + $vatAmount, 2);
                @endphp
                <div class="fd-price-block">
                    @if($discountAmount > 0)
                        <span class="fd-price-old">{{number_format($originalPrice, 2)}} {{trans('front.pound_unit')}}</span>
                        <span class="fd-price-discount">{{$discountLabel}}: -{{number_format($discountAmount, 2)}} {{trans('front.pound_unit')}}</span>
                    @endif
                    <span class="fd-price-main">{{number_format($priceBeforeVat, 2)}} {{trans('front.pound_unit')}}</span>
                    @if($vatPercentage > 0)
                        <span class="fd-price-vat">+ {{trans('front.vat')}} ({{$vatPercentage}}%): {{number_format($vatAmount, 2)}} {{trans('front.pound_unit')}}</span>
                        <span class="fd-price-total">{{trans('global.total')}}: {{number_format($priceWithVat, 2)}} {{trans('front.pound_unit')}}</span>
                    @endif
                </div>
                <a class="fd-plan-cta" href="{{route('subscription', ['id' => $subscription->id])}}">{{trans('front.subscribe')}}</a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Success Stories Section -->
<section id="testimonials" class="fd-section fd-section-light">
    <div class="container">
        <div class="fd-header-center fd-reveal">
            <span class="fd-eyebrow">{{trans('front.success_stories')}}</span>
            <h2 class="fd-section-title">{{trans('front.success_stories_subtitle')}}</h2>
            <div class="fd-underline"></div>
        </div>
        <div class="fd-testimonials-grid">
            @foreach([1, 2, 3] as $t)
            <div class="fd-testimonial-card fd-reveal">
                <i class="fa fa-quote-{{ $lang == 'ar' ? 'right' : 'left' }} fd-testimonial-quote-icon"></i>
                <div class="fd-testimonial-stars">
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                </div>
                <p class="fd-testimonial-text">{{trans('front.testimonial_'.$t.'_text')}}</p>
                <div class="fd-testimonial-footer">
                    <span class="fd-testimonial-name">{{trans('front.testimonial_'.$t.'_name')}}</span>
                    <span class="fd-testimonial-result">{{trans('front.testimonial_'.$t.'_result')}}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="fd-section fd-section-dark">
    <div class="container">
        <div class="fd-header-center fd-reveal">
            <span class="fd-eyebrow">{{trans('front.faq')}}</span>
            <h2 class="fd-section-title">{{trans('front.faq_subtitle')}}</h2>
            <div class="fd-underline"></div>
        </div>
        <div class="fd-faq-list">
            @foreach([1, 2, 3, 4] as $q)
            <details class="fd-faq-item fd-reveal" @if($q == 1) open @endif>
                <summary>
                    <span>{{trans('front.faq_'.$q.'_q')}}</span>
                    <span class="fd-faq-toggle"><i class="fa fa-plus"></i></span>
                </summary>
                <div class="fd-faq-answer">{{trans('front.faq_'.$q.'_a')}}</div>
            </details>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="fd-section fd-section-light">
    <div class="container">
        <div class="fd-header-center fd-reveal">
            <span class="fd-eyebrow">{{trans('front.contact_us')}}</span>
            <h2 class="fd-section-title">{{trans('front.contact_us')}}</h2>
            <div class="fd-underline"></div>
            <p class="fd-section-sub">{{trans('front.contact_us_msg')}}</p>
        </div>

        <div class="fd-contact-grid">
            <div class="fd-contact-card fd-reveal">
                <i class="fa fa-map-marker"></i>
                <address style="margin:0; color:#555;">{!! $mainSettings['address'] !!}</address>
            </div>
            <a href="mailto:{{$mainSettings['support_email']}}" style="text-decoration:none;">
                <div class="fd-contact-card fd-reveal">
                    <i class="fa fa-envelope"></i>
                    <p style="margin:0; color:#555;">{{$mainSettings['support_email']}}</p>
                </div>
            </a>
            <a href="callto:{{$mainSettings['phone']}}" style="text-decoration:none;">
                <div class="fd-contact-card fd-reveal">
                    <i class="fa fa-phone"></i>
                    <p style="margin:0; direction: ltr; color:#555;">{{$mainSettings['phone']}}</p>
                </div>
            </a>
        </div>

        <div class="row">
            <div class="col-lg-6 fd-reveal" style="margin-bottom: 24px;">
                <div class="fd-contact-form-card">
                    <form method="post" action="contact.php?lang={{$lang}}">
                        <input type="hidden" name="csrf" value="{{csrf_token()}}">
                        <input type="text" name="name" class="form-control" placeholder="{{trans('front.name')}}" required="">
                        <input type="email" name="email" class="form-control" placeholder="{{trans('front.email')}}" required="">
                        <textarea class="form-control" name="message" rows="6" required="" placeholder="{{trans('front.message')}}" style="border-radius:10px; border:1px solid #e3e0d8; padding:12px 16px; margin-bottom:16px; width:100%;"></textarea>
                        <button type="submit">{{trans('front.send')}}</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 fd-reveal" style="margin-bottom: 24px;">
                <div class="fd-contact-map-card">
                    <iframe id="gmap_canvas"
                            src="https://maps.google.com/maps?q={{$mainSettings['latitude']}},{{$mainSettings['longitude']}}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" scrolling="no"></iframe>
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
    (function () {
        if (!('IntersectionObserver' in window)) {
            document.querySelectorAll('.fd-reveal').forEach(function (el) { el.classList.add('fd-in'); });
            return;
        }
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fd-in');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        document.querySelectorAll('.fd-reveal').forEach(function (el) { observer.observe(el); });
    })();
</script>
@endsection
