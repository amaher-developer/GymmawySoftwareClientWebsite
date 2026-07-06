<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php 
    $template_version = env('TEMPLATE_NUM', '1');
    @endphp
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{$mainSettings['meta_description']}}">
    <meta name="keywords" content="{{$mainSettings['meta_keywords']}}">
    <meta name="author" content="{{$mainSettings['name']}}">
    <meta name="robots" content="index, follow" />
    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{asset('/'.$lang)}}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{$mainSettings['name']}}">
    <meta property="og:description" content="{{$mainSettings['meta_description']}}">
    <meta property="og:image" content="{{asset('Modules/Fitdose/resources/assets/img/logo.png')}}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{$mainSettings['name']}}">
    <meta name="twitter:description" content="{{$mainSettings['meta_description']}}">
    <meta name="twitter:image" content="{{asset('Modules/Fitdose/resources/assets/img/logo.png')}}">

    <meta name="robots" content="index, follow"/>
    <meta name="Googlebot" content="index, follow"/>
    <meta name="FAST-WebCrawler" content="index, follow"/>
    <meta name="Scooter" content="index, follow"/>
    <meta name="GOOGLEBOT" content="NOODP"/>
    <meta name="revisit-after" content="daily"/>
    <meta name="allow-search" content="yes"/>
    <meta name="msnbot" content="INDEX, FOLLOW"/>
    <meta name="YahooSeeker" content="INDEX, FOLLOW"/>
    <meta name="rating" content="general"/>
    <meta name="robots" content="all"/>
    <meta http-equiv="Cache-control" content="public"/>


    <title>{{$mainSettings['name']}}</title>
    <!-- Favicon -->
    <link href="{{asset('Modules\Fitdose\resources\assets\img\favicon.png')}}" rel="shortcut icon" type="image/png">
    <link href="{{asset('Modules\Fitdose\resources\assets\img\favicon.png')}}" rel="icon" type="image/png">

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/css/style_fitdose.css')}}" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/css/responsive.css')}}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        /*  Fonts --------------------------------*/
        @import url({{asset('resources/fonts/DroidKufi-Regular.ttf')}});
        /* font-family:'Droid Arabic Kufi',  Tahoma, Geneva, sans-serif; */
        @import url({{asset('resources/fonts/DroidKufi-Regular.ttf')}});
        /* font-family:Arial, Geneva, sans-serif; */
        p, h2 {
            font-family: droid arabic kufi, 'Source Sans Pro', sans-serif;
        }
        body {
            font-family: droid arabic kufi ;
        }
        h2{
            letter-spacing: 0px !important;
        }
        .one-line{
            clear: both;
            display: inline-block;
            overflow: hidden;
            white-space: nowrap;
        }
        .gallery-image-res {
            height: 260px;
            object-fit: cover;
        }
        .testimonial-item h4 {
            color: #645c5c;
        }
        @media (max-width: 480px) {
            .invisible-mobile {
                display: none;
            }
        }
        /* ── Branch Pill Switcher ── */
        .branch-pill-outer { position: relative; display: inline-flex; align-items: center; margin-left: 10px; }
        .branch-pill-outer .branch-dropdown-menu { right: 0; left: auto; }
        /* ── Branch Floating Badge ── */
        #branch-float {
            position: fixed;
            bottom: 26px;
            {{ $lang == 'ar' ? 'left: 20px; right: auto;' : 'right: 20px; left: auto;' }}
            z-index: 9990;
            display: none;
        }
        #branch-float .branch-pill {
            padding: 10px 18px;
            font-size: 0.88rem;
            box-shadow: 0 4px 22px rgba(200,168,75,0.55);
        }
        #branch-float .branch-float-menu {
            position: fixed !important;
            bottom: 76px; /* 26px float-bottom + ~42px button + 8px gap */
            top: auto !important;
            {{ $lang == 'ar' ? 'left: 20px; right: auto;' : 'right: 20px; left: auto;' }}
            margin: 0 !important;
        }
        /* ── WhatsApp Floating Button ── */
        #wa-float {
            position: fixed;
            bottom: 26px;
            {{ $lang == 'ar' ? 'right: 20px; left: auto;' : 'left: 20px; right: auto;' }}
            z-index: 9990;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            background: #25D366;
            color: #fff !important;
            border-radius: 25px;
            text-decoration: none !important;
            font-size: 0.88rem;
            font-weight: 700;
            font-family: inherit;
            box-shadow: 0 4px 22px rgba(37,211,102,0.50);
            transition: opacity 0.2s, box-shadow 0.2s;
            white-space: nowrap;
        }
        #wa-float:hover {
            opacity: 0.9;
            box-shadow: 0 6px 28px rgba(37,211,102,0.65);
            color: #fff !important;
            text-decoration: none !important;
        }
        #wa-float .fa-whatsapp { font-size: 20px; line-height: 1; }
        .branch-pill {
            display: inline-flex !important;
            align-items: center;
            gap: 7px;
            padding: 6px 13px !important;
            background: linear-gradient(135deg, #c8a84b 0%, #e8c870 100%) !important;
            color: #fff !important;
            border: none;
            border-radius: 20px !important;
            font-size: 0.82rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(200,168,75,0.30);
            transition: box-shadow 0.2s, opacity 0.2s;
            white-space: nowrap;
            line-height: 1.4 !important;
            text-decoration: none !important;
            vertical-align: middle;
        }
        .branch-pill:hover, .branch-pill:focus {
            opacity: 0.88;
            box-shadow: 0 4px 16px rgba(200,168,75,0.50);
            color: #fff !important;
            outline: none;
            text-decoration: none;
        }
        .branch-pill::after { display: none !important; }
        .branch-pill .fa-map-marker { font-size: 11px; }
        .branch-pill .fa-chevron-down { font-size: 9px; opacity: 0.8; }
        .branch-dd-header {
            padding: 8px 16px 6px;
            font-size: 0.7rem;
            font-weight: 700;
            color: #c8a84b;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-bottom: 1px solid #f0ebe0;
            margin-bottom: 2px;
        }
        .branch-dropdown-menu {
            min-width: 230px;
            padding: 4px 0 8px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.14);
            background: #fff;
            margin-top: 8px !important;
        }
        .branch-dropdown-menu .branch-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            font-size: 0.88rem;
            color: #333;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.12s;
            border-{{ $lang == 'ar' ? 'right' : 'left' }}: 3px solid transparent;
        }
        .branch-dropdown-menu .branch-item:hover {
            background: #fdf6e3;
            color: #a07830;
            border-{{ $lang == 'ar' ? 'right' : 'left' }}-color: #c8a84b;
            text-decoration: none;
        }
        .branch-dropdown-menu .branch-item.is-active {
            background: #fdf6e3;
            color: #a07830;
            border-{{ $lang == 'ar' ? 'right' : 'left' }}-color: #c8a84b;
            font-weight: 700;
        }
        .branch-item .branch-icon {
            width: 28px; height: 28px;
            background: linear-gradient(135deg,#c8a84b,#e8c870);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 11px; flex-shrink: 0;
        }
        .branch-item.is-active .branch-icon {
            background: linear-gradient(135deg,#a07830,#c8a84b);
        }
        .branch-item .branch-check {
            margin-{{ $lang == 'ar' ? 'right' : 'left' }}: auto;
            color: #c8a84b;
            display: none;
        }
        .branch-item.is-active .branch-check { display: inline; }
        /* ── Branch Modal ── */
        #branch-modal-overlay {
            position: fixed; inset: 0;
            background: rgba(10,10,10,0.78);
            z-index: 99999;
            display: none;
            align-items: center;
            justify-content: center;
        }
        #branch-modal-box {
            background: #fff;
            border-radius: 16px;
            padding: 36px 28px 28px;
            max-width: 420px; width: 92%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            text-align: center;
            animation: modalIn .22s ease;
        }
        @keyframes modalIn {
            from { transform: translateY(18px); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }
        #branch-modal-box .modal-icon {
            width: 58px; height: 58px;
            background: linear-gradient(135deg,#c8a84b,#e8c870);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            font-size: 22px; color: #fff;
            box-shadow: 0 4px 14px rgba(200,168,75,0.4);
        }
        #branch-modal-box h3 {
            color: #1a1a1a;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        #branch-modal-box p.modal-sub {
            color: #999; font-size: 0.83rem; margin-bottom: 20px;
        }
        .modal-branch-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            margin-bottom: 10px;
            padding: 13px 18px;
            background: #f8f8f8;
            border: 2px solid #eaeaea;
            border-radius: 10px;
            font-size: 0.95rem;
            font-family: inherit;
            cursor: pointer;
            color: #333;
            text-decoration: none;
            transition: border-color 0.18s, background 0.18s, box-shadow 0.18s;
        }
        .modal-branch-btn:hover {
            border-color: #c8a84b;
            background: #fdf6e3;
            color: #a07830;
            box-shadow: 0 3px 12px rgba(200,168,75,0.2);
            text-decoration: none;
        }
        .modal-branch-btn .mbtn-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg,#c8a84b,#e8c870);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 14px; flex-shrink: 0;
        }
        .modal-branch-btn span { font-weight: 600; }
    </style>

    @yield('style')
</head>

<body <?php if($lang=='ar'){?> class="rtl-theme" <?php } ?> id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<!-- Preloader start -->
{{--<div id="preloader"></div>--}}


<!-- Main Header start -->
<header class="main-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Navigation -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top main-nav" id="mainNav">
                    <div class="container">
                        <div class="navbar-brand">
                            <a href="{{asset($lang)}}" class="js-scroll-trigger"><img src="{{asset('Modules/Fitdose/resources/assets/img/logo.png')}}" style="width: 185px; height:51px;object-fit: contain" alt="">
                            </a>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav mr-auto">
                                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                                <li class="nav-item">
                                    <a class="nav-link js-scroll-trigger" href="{{asset($lang)}}#page-top">{{trans('front.home')}}</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link js-scroll-trigger" href="{{asset($lang)}}#about">{{trans('front.about')}}</a>
                                </li> --}}
                                <!--                                <li class="nav-item">-->
                                <!--                                    <a class="nav-link js-scroll-trigger" href="#courses">الدورات</a>-->
                                <!--                                </li>-->
                                <li class="nav-item">
                                    <a class="nav-link js-scroll-trigger" href="{{asset($lang)}}#activities">{{trans('front.activities')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link js-scroll-trigger" href="{{asset($lang)}}#gallery">{{trans('front.gallery')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link js-scroll-trigger" href="{{asset($lang)}}#subscriptions">{{trans('front.subscriptions')}}</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link js-scroll-trigger" href="{{asset($lang)}}#testimonials">{{trans('front.success_stories')}}</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link js-scroll-trigger" href="{{asset($lang)}}#faq">{{trans('front.faq')}}</a>
                                </li>
                                <!--                                <li class="nav-item">-->
                                <!--                                    <a class="nav-link js-scroll-trigger" href="#blog">مدونة او مذكرة</a>-->
                                <!--                                </li>-->
                                <li class="nav-item">
                                    <a class="nav-link js-scroll-trigger" href="{{asset($lang)}}#contact">{{trans('front.contact_us')}}</a>
                                </li>
                                <li class="nav-item">
                                    @if(@$currentUser)
                                        <a class="nav-link js-scroll-trigger" href="{{route('showProfile')}}"  style="margin-left: 10px !important;">| <i class="fa fa-user"></i> {{trans('front.profile')}} </a>
                                    @else
                                        <a class="nav-link js-scroll-trigger" href="{{route('login')}}"  style="margin-left: 10px !important;">| <i class="fa fa-user"></i> {{trans('front.login')}} </a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container -->
                    <div class="time-top-box">
                        <a href="mailto:{{$mainSettings['support_email']}}"> <p class="one-line"><i class="fa fa-envelope-o" aria-hidden="true"></i>{{$mainSettings['support_email']}}</p></a>
                    </div>
                    <div class="call-top-box">
                        <a href="callto:{{$mainSettings['phone']}}"> <p class="one-line"><i class="fa fa-phone" aria-hidden="true"></i>{{$mainSettings['phone']}}</p></a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

{{-- Branch Selection Modal – appears on every page when no branch is active --}}
@if(isset($allBranches) && $allBranches->count() > 1)
<div id="branch-modal-overlay">
    <div id="branch-modal-box">
        <div class="modal-icon"><i class="fa fa-map-marker"></i></div>
        <h3>{{ trans('front.select_branch') }}</h3>
        <p class="modal-sub">{{ $lang == 'ar' ? 'اختر الفرع الأقرب إليك للاستمرار' : 'Choose your nearest branch to continue' }}</p>
        @foreach($allBranches as $branch)
        <a href="{{ route('setBranch', $branch->id) }}"
           class="modal-branch-btn"
           onclick="localStorage.setItem('fitdose_branch_id','{{ $branch->id }}');localStorage.setItem('fitdose_branch_name','{{ addslashes($lang=='ar'?$branch->getRawOriginal('name_ar'):$branch->getRawOriginal('name_en')) }}');">
            <span class="mbtn-icon"><i class="fa fa-building-o"></i></span>
            <span>{{ $lang == 'ar' ? $branch->getRawOriginal('name_ar') : $branch->getRawOriginal('name_en') }}</span>
        </a>
        @endforeach
    </div>
</div>
<script>
(function () {
    var stored = localStorage.getItem('fitdose_branch_id');
    var server = '{{ $selectedBranchId ?? "" }}';
    if (!stored && !server) {
        document.getElementById('branch-modal-overlay').style.display = 'flex';
    }
})();
</script>
@endif

{{-- Branch floating badge – fixed corner button to change branch (shown when branch is active) --}}
@if(isset($allBranches) && $allBranches->count() > 1)
<div id="branch-float">
    <a href="#" class="branch-pill dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-map-marker"></i>
        <span>{{ $lang == 'ar' ? $mainSettings->getRawOriginal('name_ar') : $mainSettings->getRawOriginal('name_en') }}</span>
        <i class="fa fa-chevron-up"></i>
    </a>
    <div class="dropdown-menu branch-dropdown-menu branch-float-menu">
        <div class="branch-dd-header">{{ trans('front.change_branch') }}</div>
        @foreach($allBranches as $branch)
        @php $isActive = ($selectedBranchId == $branch->id); @endphp
        <a href="{{ route('setBranch', $branch->id) }}"
           class="branch-item {{ $isActive ? 'is-active' : '' }}"
           onclick="localStorage.setItem('fitdose_branch_id','{{ $branch->id }}');localStorage.setItem('fitdose_branch_name','{{ addslashes($lang=='ar'?$branch->getRawOriginal('name_ar'):$branch->getRawOriginal('name_en')) }}');">
            <span class="branch-icon"><i class="fa fa-building-o"></i></span>
            {{ $lang == 'ar' ? $branch->getRawOriginal('name_ar') : $branch->getRawOriginal('name_en') }}
            <i class="fa fa-check branch-check"></i>
        </a>
        @endforeach
    </div>
</div>
@endif

{{-- WhatsApp floating button – number changes with selected branch --}}
@php
    $waPhone = $mainSettings->getRawOriginal('phone') ?? '';
    // Use wa_details number if set
    $waDetails = $mainSettings->wa_details;
    if ($waDetails && is_array($waDetails) && !empty($waDetails['number'])) {
        $waPhone = $waDetails['number'];
    }
    $waPhone = preg_replace('/[^0-9]/', '', $waPhone);
@endphp
@if($waPhone)
<a id="wa-float"
   href="https://wa.me/{{ $waPhone }}"
   target="_blank"
   rel="noopener">
    <i class="fa fa-whatsapp"></i>
    <span>{{ $lang == 'ar' ? 'واتساب' : 'WhatsApp' }}</span>
</a>
@endif

@yield('content')

<!-- Footer section -->
<footer class="main-footer over-layer-black">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="footer-about-col col-default-mb30">
                    <h4>{{trans('front.about')}}</h4>
                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($mainSettings['about']), 160) }}</p>
                    <div class="social text-left">
                        <?php if ($mainSettings['facebook']) { ?><a href="<?php echo $mainSettings['facebook'] ?>"><i
                                    class="fa fa-facebook" aria-hidden="true"></i></a><?php } ?>
                        <?php if ($mainSettings['twitter']) { ?><a href="<?php echo $mainSettings['twitter'] ?>"><i
                                    class="fa fa-twitter" aria-hidden="true"></i></a><?php } ?>
                        <?php if ($mainSettings['instagram']) { ?><a href="<?php echo $mainSettings['instagram'] ?>"><i
                                    class="fa fa-instagram" aria-hidden="true"></i></a><?php } ?>
                    <!--                        -->
                        <?php //if($mainSettings['facebook']){ ?><!--<a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>--><?php //} ?>
                    <!--                        -->
                        <?php //if($mainSettings['facebook']){ ?><!--<a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>--><?php //} ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="footer-Tag-col col-default-mb30">
                    <!--                    <h4>العلامات</h4>-->
                    <div class="tag-group clearfix">
                        <a class="tag-btn " href="{{route('home')}}#page-top">{{trans('front.home')}}</a>
                        <a class="tag-btn " href="{{route('home')}}#about">{{trans('front.about')}}</a>
                        <a class="tag-btn " href="{{route('home')}}#activities">{{trans('front.activities')}}</a>
                        <a class="tag-btn " href="{{route('home')}}#gallery">{{trans('front.gallery')}}</a>
                        <a class="tag-btn " href="{{route('home')}}#subscriptions">{{trans('front.subscriptions')}}</a>
                        <a class="tag-btn " href="{{route('home')}}#testimonials">{{trans('front.success_stories')}}</a>
                        <a class="tag-btn " href="{{route('home')}}#faq">{{trans('front.faq')}}</a>
                        <a class="tag-btn " href="{{route('home')}}#contact">{{trans('front.contact_us')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12">
                <div class="footer-subscribe-col col-default-mb30">
                    <h4>{{trans('front.contact_info')}}</h4>
                    <p style="padding-bottom: 5px;"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $mainSettings['address'] ?> </p>
                    <p style="padding-bottom: 5px;"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo $mainSettings['support_email'] ?> </p>
                    <p style="padding-bottom: 5px;"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $mainSettings['phone'] ?> </p>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- Payment Methods section -->
<section class="payment-methods-sec" style="background:#1a1a1a; padding: 16px 0; border-top: 1px solid #333;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <span style="color:#aaa; font-size:13px; margin-right:12px; vertical-align:middle;">{{trans('front.payment_methods')}}</span>
                <span style="display:inline-flex; align-items:center; justify-content:center; background:#fff; border-radius:6px; padding:5px 12px; margin:4px; height:40px; vertical-align:middle;">
                    <img src="{{asset('resources/assets/images/visa_logo.svg')}}"       alt="Visa"       style="height:22px; width:auto;">
                </span>
                <span style="display:inline-flex; align-items:center; justify-content:center; background:#fff; border-radius:6px; padding:5px 12px; margin:4px; height:40px; vertical-align:middle;">
                    <img src="{{asset('resources/assets/images/mastercard-logo.svg')}}" alt="Mastercard" style="height:28px; width:auto;">
                </span>
                <span style="display:inline-flex; align-items:center; justify-content:center; background:#fff; border-radius:6px; padding:5px 12px; margin:4px; height:40px; vertical-align:middle;">
                    <img src="{{asset('resources/assets/images/mada-logo.svg')}}"       alt="Mada"       style="height:22px; width:auto;">
                </span>
                <span style="display:inline-flex; align-items:center; justify-content:center; background:#fff; border-radius:6px; padding:5px 12px; margin:4px; height:40px; vertical-align:middle;">
                    <img src="{{asset('resources/assets/images/tabby-logo.webp')}}"     alt="Tabby"      style="height:22px; width:auto;">
                </span>
                <span style="display:inline-flex; align-items:center; justify-content:center; background:#fff; border-radius:6px; padding:5px 12px; margin:4px; height:40px; vertical-align:middle;">
                    <img src="{{asset('resources/assets/images/tamara-logo.svg')}}"     alt="Tamara"     style="height:22px; width:auto;">
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Copyright section -->
<section class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p style="margin-bottom: 6px;">
                    <a href="https://fitdosefitnes.com/{{$lang}}/terms" target="_blank" style="color:#aaa; margin: 0 8px;">{{trans('front.terms')}}</a>
                    |
                    <a href="https://fitdosefitnes.com/{{$lang}}/policy" target="_blank" style="color:#aaa; margin: 0 8px;">{{trans('front.policy')}}</a>
                    |
                    <a href="https://fitdosefitnes.com/{{$lang}}/refund-policy" target="_blank" style="color:#aaa; margin: 0 8px;">{{trans('front.refund_policy')}}</a>
                </p>
                <p style="margin-bottom: 6px; color:#aaa; font-size:12px;">{{trans('front.commercial_registration')}}: 5906338027</p>
                <p> {{trans('front.dev_des')}} <a href="https://demo.gymmawy.com" target="_blank"><img
                                style="width: 24px;"
                                src="https://gymmawy.com/resources/assets/front/img/logo/favicon.ico"/> {{trans('front.gymmawy')}}
                    </a></p>
            </div>
        </div>
    </div>
</section>

<!-- jQuery -->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/jquery.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/bootstrap.bundle.min.js')}}"></script>

<!-- All Included JavaScript -->
<script type="text/javascript" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/jquery.easing.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/jquery.pogo-slider.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/animated-text.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/jarallax.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/css3-animate-it.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/counter.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/jarallax.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/css3-animate-it.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/featherlight.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/featherlight.gallery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/bootstrap-portfilter.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/particles.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/particles-app.js')}}"></script>

<!-- Google map -->
<script type="text/javascript" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/google-map.js')}}"></script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdEPAHqgxFK5pioDAB3rsvKchAtXxRGO4&callback=myMap"></script>

<!-- Custom Js -->
<script type="text/javascript" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/main.js')}}"></script>

{{-- Branch: sync localStorage → server if localStorage has branch but URL/session doesn't --}}
@if(isset($allBranches) && $allBranches->count() > 1)
<script>
(function () {
    var stored = localStorage.getItem('fitdose_branch_id');
    var server = '{{ $selectedBranchId ?? "" }}';
    if (stored && !server) {
        // Write plain cookie so PHP can read it on next request without session
        document.cookie = 'fitdose_branch_id=' + stored + '; path=/; max-age=2592000; SameSite=Lax';
        // Stay on current page – just append ?branch=id so PHP reads it this request
        var url = new URL(window.location.href);
        url.searchParams.set('branch', stored);
        window.location.replace(url.toString());
        return;
    }
    // Show floating branch badge whenever a branch is active
    if (stored || server) {
        var f = document.getElementById('branch-float');
        if (f) f.style.display = 'block';
    }
})();
</script>
@endif

@yield('script')

</body>
</html>
