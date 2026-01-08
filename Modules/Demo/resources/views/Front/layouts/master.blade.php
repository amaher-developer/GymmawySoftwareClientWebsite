<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
@php 
    $template_version = env('TEMPLATE_NUM', '1');
    @endphp
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>@if(isset($title)) {{$title}} |@endif {{@$mainSettings->name}}</title>
    <meta name="description"
          content="{{@$mainSettings->name}}, {{ @$metaDescription ?? $mainSettings->meta_description }}"/>
    <link rel="canonical" href="{{ url()->current() }}"/>
    <meta name="keywords"
          content="{{@$mainSettings->name}}, {!!  @$mainSettings->meta_keywords !!} {{@$metaKeywords}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>

    @yield('meta')

    @if($lang=='ar')
        <link rel="stylesheet" data-them=""
              href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/css/styles-construction-rtl2.css">
    @else
        <link rel="stylesheet" data-them="" href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/css/styles-construction2.css">
    @endif


    <link rel="stylesheet" type="text/css"
          href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/js/specific/revolution-slider/css/settings.css" media="screen"/>
    <!--[if IE]>
    <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js" ></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <!-- Googl Font -->
    <link href="https://fonts.googleapis.com/css?family=Droid+Arabic+Naskh" rel="stylesheet reload" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Droid+Arabic+Kufi" rel="stylesheet reload" type="text/css">
    <link rel="shortcut icon" href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/images/favicon.ico')}}" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/images/favicon.ico')}}" type="image/x-icon"/>

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="{{@$mainSettings->name}}">
    <meta itemprop="description" content="{{@$mainSettings->name}}, {{ @$metaDescription ?? $mainSettings->meta_description }}">
    <meta itemprop="image" content="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/images/gymmawy_system.jpg')}}">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{url('/')}}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{@$mainSettings->name}}">
    <meta property="og:description" content="{{@$mainSettings->name}}, {{ @$metaDescription ?? $mainSettings->meta_description }}">
    <meta property="og:image" content="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/images/gymmawy_system.jpg')}}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{@$mainSettings->name}}">
    <meta name="twitter:description" content="{{@$mainSettings->name}}, {{ @$metaDescription ?? $mainSettings->meta_description }}">
    <meta name="twitter:image" content="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/images/gymmawy_system.jpg')}}">

    <style>
        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .page-section-content {
            padding: 40px 0 !important;
        }

        .image .thumb img {
            border-radius: 0px !important;
            width: 80%;
        }

        .image .thumb {
            margin: 0 auto 0px;
        }

        .image .thumb.overlay:before {
            border-radius: 0px !important;
        }

        .dima-pricing-table .dima-pricing-col .header h2 {
            font-size: 1.5rem !important;
        }

        .countUp {
            padding: 30px 40px;
        }

        .wa-messenger-svg-whatsapp {
            width: 50px !important;
            height: 50px !important;
        }
        #wa-widget-send-button {
            height: 70px !important;
            min-width: 70px !important;
            border-radius: 40px !important;
        }
    </style>


    <!-- Global site tag (gtag.js) - Google Ads: 978062359 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-978062359"></script>
    <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-978062359'); </script>


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-C8XNZW97HT"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-C8XNZW97HT');
    </script>

    <!-- Modern Enhancements CSS -->
    <link rel="stylesheet" href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/css/modern-enhancements.css')}}">

    @yield('style')

<!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KM7PBHR');</script>
    <!-- End Google Tag Manager -->
</head>
<body class="responsive" id="demo-construction">

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KM7PBHR"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<!-- LOADING -->
<div class="all_content">
    <!-- Dima-loading -->
{{--    <div class="dima-loading">--}}
{{--        <span class="loading-top"></span>--}}
{{--        <span class="loading-bottom"></span>--}}
{{--        <span class="spin-2"><p>LOADING</p>--}}
{{--                </span><a href="#" class="load-close">X</a>--}}
{{--    </div>--}}
<!--! Dima-loading -->
    <!-- HEADER -->


    <header role="banner">
        <!-- DESKTOP MENU -->
        <div class="dima-navbar-wrap dima-navbar-fixed-top-active dima-topbar-active desk-nav">
            <div class="dima-navbar fix-one dima-navbar-transparent">
                <!-- TOP BAR -->
                <div class="dima-topbar">
                    <div class="container">
                        <ul class="float-start text-start dima-menu">
{{--                            <li><a data-animated-link="fadeOut" style="direction: ltr"--}}
{{--                                   href="callto:{{$mainSettings->phone}}"><i--}}
{{--                                            class="fa fa-phone"></i>{{$mainSettings->phone}}</a>--}}
{{--                            </li>--}}
                            <li><a data-animated-link="fadeOut" style="direction: ltr"
                                   href="callto:00201014401468"><i
                                            class="fa fa-phone"></i>00201014401468</a>
                            </li>
                        </ul>
                        <ul class="float-end text-end dima-menu">
                            <li>
                                @if($lang == 'en')
                                    <a data-animated-link="fadeOut"
                                       href="{{preg_replace('/'.request()->segment(1).'/', 'ar', strtolower(request()->fullUrl()),1)}}">العربية</a>
                                @else
                                    <a data-animated-link="fadeOut"
                                       href="{{preg_replace('/'.request()->segment(1).'/', 'en', strtolower(request()->fullUrl()),1)}}">English</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <!--! TOP BAR -->
                <div class="clearfix dima-nav-fixed"></div>
                <div class="container">
                    <!-- Nav bar button -->
                    <a class="dima-btn-nav" href="#"><i class="fa fa-bars"></i></a>
                    <!-- LOGO -->
                    <div class="logo">
                        <h1>
                            <a data-animated-link="fadeOut" href="{{asset('/')}}" title="{{$mainSettings->name}}">
                                <span class="vertical-middle"></span>
                                <img class="one" src="{{asset('resources/assets/images/logo_w_ar.png')}}" alt="{{$mainSettings->name}}"
                                     title="{{$mainSettings->name}}">
                                <img class="two" src="{{asset('resources/assets/images/logo_w_ar.png')}}" alt="{{$mainSettings->name}}"
                                     title="{{$mainSettings->name}}">
                            </a>
                        </h1>
                    </div>
                    <!-- MENU -->
                    <nav role="navigation" class="clearfix">
                        <ul class="dima-nav dima-onepage  ">
                            <li><a data-animated-link="fadeOut" href="#about">{{trans('front.about')}}</a>
                            </li>
                            <li><a data-animated-link="fadeOut" href="#try" style="font-weight: bold;font-size: medium;">{{trans('front.try')}}</a>
                            </li>
                            <li><a data-animated-link="fadeOut" href="#memberships">{{trans('front.subscriptions')}}</a>
                            </li>
                            <li><a data-animated-link="fadeOut" href="#features">{{trans('front.features')}}</a>
                            </li>
                            <li><a data-animated-link="fadeOut" href="#clients">{{trans('front.clients')}}</a>
                            </li>
{{--                            <li><a data-animated-link="fadeOut" href="#activities">{{trans('front.activities')}}</a>--}}
{{--                            </li>--}}
{{--                            <li><a data-animated-link="fadeOut" href="#gallery">{{trans('front.gallery')}}</a>--}}
{{--                            </li>--}}
                            {{--                            <li><a data-animated-link="fadeOut" href="#blog">blog</a>--}}
                            {{--                            </li>--}}
                            {{--                            <li><a data-animated-link="fadeOut" href="#contact-us">contact</a>--}}
                            {{--                            </li>--}}
                        </ul>
                    </nav>
                </div>
                <!-- container -->
            </div>
            <div class="clear-nav"></div>
        </div>
        <!--! DESKTOP MENU -->
        <!-- PHONE MENU -->
        <div class="dima-navbar-wrap mobile-nav">
            <div class="dima-navbar fix-one">
                <div class="clearfix dima-nav-fixed"></div>
                <div class="container">
                    <!-- Nav bar button -->
                    <a class="dima-btn-nav" href="#"><i class="fa fa-bars"></i></a>
                    <!-- LOGO -->
                    <div class="logo">
                        <h1>
                            <a data-animated-link="fadeOut" href="{{asset('/')}}" title="{{@$mainSettings->name}}">
                                <span class="vertical-middle"></span>
                                <img src="{{asset('resources/assets/images/logo_w_ar.png')}}" alt="{{@$mainSettings->name}}"
                                     title="{{@$mainSettings->name}}">
                            </a>
                        </h1>
                    </div>
                    <!-- MENU -->
                    <nav role="navigation" class="clearfix">
                        <ul class="dima-nav dima-onepage  ">
                            <li><a data-animated-link="fadeOut" href="#about">{{trans('front.about')}}</a>
                            </li>
                            <li><a data-animated-link="fadeOut" href="#try" style="font-weight: bold;font-size: medium;">{{trans('front.try')}}</a>
                            </li>
                            <li><a data-animated-link="fadeOut" href="#memberships">{{trans('front.subscriptions')}}</a>
                            </li>
                            <li><a data-animated-link="fadeOut" href="#features">{{trans('front.features')}}</a>
                            </li>
                            <li><a data-animated-link="fadeOut" href="#clients">{{trans('front.clients')}}</a>
                            </li>
{{--                            <li><a data-animated-link="fadeOut" href="#activities">{{trans('front.activities')}}</a>--}}
{{--                            </li>--}}
{{--                            <li><a data-animated-link="fadeOut" href="#gallery">{{trans('front.gallery')}}</a>--}}
{{--                            </li>--}}
                        </ul>
                    </nav>
                </div>
                <!-- container -->

            </div>
        </div>
        <!-- !PHONE MENU -->
    </header>
    <!--! HEADER -->

@yield('content')
<!-- FOOTER -->
    <!-- TOP FOOTER -->
    <div class="top-footer">
        <div class="container">
            <div class="ok-row">
                <!-- ABOUT US WIDGET -->
                <div class="ok-md-6 ok-xsd-12 widget">
                    <h5 class="widget-titel uppercase">{{trans('front.about_us')}}</h5>
                    <div class="widget-content">
                        <p>{!! trans('front.footer_about_msg2')!!}</p>
                    </div>
{{--                    <div class="widget-content">--}}
{{--                        <div class="dima-social-footer social-media social-medium">--}}
{{--                            <ul class="inline clearfix">--}}
{{--                                @if(@$mainSettings->facebook)--}}
{{--                                    <li><a data-animated-link="fadeOut" href="{{@$mainSettings->facebook}}"--}}
{{--                                           target="_blank"><i class="fa fa-facebook"></i></a></li>@endif--}}
{{--                                @if(@$mainSettings->twitter)--}}
{{--                                    <li><a data-animated-link="fadeOut" href="{{@$mainSettings->twitter}}"--}}
{{--                                           target="_blank"><i class="fa fa-twitter"></i></a></li>@endif--}}
{{--                                @if(@$mainSettings->google)--}}
{{--                                    <li><a data-animated-link="fadeOut" href="{{@$mainSettings->google}}"--}}
{{--                                           target="_blank"><i class="fa fa-google-plus"></i></a></li>@endif--}}
{{--                                @if(@$mainSettings->pinterest)--}}
{{--                                    <li><a data-animated-link="fadeOut" href="{{@$mainSettings->pinterest}}"--}}
{{--                                           target="_blank"><i class="fa fa-pinterest"></i></a></li>@endif--}}
{{--                                @if(@$mainSettings->instagram)--}}
{{--                                    <li><a data-animated-link="fadeOut" href="{{@$mainSettings->instagram}}"--}}
{{--                                           target="_blank"><i class="fa fa-instagram"></i></a></li>@endif--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <!--! ABOUT US WIDGET -->
                <!-- FEATURED POSTS WIDGET -->
                <div class=" ok-md-3 ok-xsd-12 ok-sd-6 widget">
                    <h5 class="widget-titel uppercase">{{trans('front.languages')}}</h5>
                    <div class="widget-content">
                        <ul class="with-border featured-posts">
                            <!-- POST (1) -->
                            <li>
                                <a data-animated-link="fadeOut" href="{{preg_replace('/'.request()->segment(1).'/', 'ar', strtolower(request()->fullUrl()),1)}}">
                                    <h6 class="uppercase">العربية</h6>
                                </a>
                            </li>
                            <!--! POST (1) -->
                            <!-- POST (2) -->
                            <li>
                                <a data-animated-link="fadeOut" href="{{preg_replace('/'.request()->segment(1).'/', 'en', strtolower(request()->fullUrl()),1)}}">
                                    <h6 class="uppercase">English</h6>
                                </a>
                            </li>
                            <!--! POST (2) -->
                        </ul>
                    </div>
                </div>
                <!--! FEATURED POSTS WIDGET -->
                <!-- CONTACT US WIDGET -->
                <div class="ok-md-3 ok-xsd-12 ok-sd-6 widget ">
                    <h5 class="widget-titel uppercase">{{trans('front.contact_us')}}</h5>
                    <div class="widget-content">
                        <ul class="with-border featured-posts contact-icon">
                            {{--                            <li>--}}
                            {{--                                <i class="fa fa-map-marker "></i>--}}
                            {{--                                <p>حي من الأحياء الجزائرية 18 جانفي</p>--}}
                            {{--                            </li>--}}
                            <li>
                                <i class="fa fa-phone"></i>
                                <p><a href="callto:00201014401468">00201014401468</a></p>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i>
                                <p>
                                    <a href="mailto:support@gymmawy.com	">support@gymmawy.com</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--! CONTACT US WIDGET -->
            </div>
        </div>
    </div>
    <!--! TOP FOOTER -->
    <!-- BOTTOM FOOTER -->
    <footer role="contentinfo" class="dima-footer">
        <div class="container">
            <div class="ok-row">
                <!-- COPYRIGHT -->
                <div class="ok-md-4 ok-xsd-12 ok-sd-12">
                    <div class="dima-center-full copyright">
                        <p dir="ltr">{{trans('front.copy_right')}}</p>
                    </div>
                </div>
                <!--! COPYRIGHT -->
                <!-- FOOTER MENU -->
                <div class="ok-md-8 ok-xsd-12 ok-sd-12 hidden-xsd">

                    {{--                    <ul class="dima-nav dima-onepage  ">--}}
                    <ul class="dima-center-full dima-menu dima-onepage ">
                        <li><a data-animated-link="fadeOut" href="#about">{{trans('front.about')}}</a>
                        </li>
                        <li><a data-animated-link="fadeOut" href="#try">{{trans('front.try')}}</a>
                        </li>
                        <li><a data-animated-link="fadeOut" href="#memberships">{{trans('front.subscriptions')}}</a>
                        </li>
                        <li><a data-animated-link="fadeOut" href="#features">{{trans('front.features')}}</a>
                        </li>
                        <li><a data-animated-link="fadeOut" href="#clients">{{trans('front.clients')}}</a>
                        </li>
{{--                        <li><a data-animated-link="fadeOut" href="#activities">{{trans('front.activities')}}</a>--}}
{{--                        </li>--}}
{{--                        <li><a data-animated-link="fadeOut" href="#gallery">{{trans('front.gallery')}}</a>--}}
{{--                        </li>--}}
                    </ul>
                </div>
                <!--! FOOTER MENU -->
            </div>
        </div>
    </footer>
    <!--! BOTTOM FOOTER -->

</div>
<!--! LOADING -->

<!-- 1)Important in all pages -->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/js/core/jquery-2.1.1.min.js"></script>
<!--
<script src="https://ajax.googleapis.com/ajax/module/jquery/2.1.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/module/jquery-2.1.1.min.js"><\/script>')</script>
-->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/js/core/load.js"></script>
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/js/core/jquery.easing.1.3.js"></script>
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/js/core/modernizr-2.8.2.min.js"></script>
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/js/core/imagesloaded.pkgd.min.js"></script>
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/js/core/respond.src.js"></script>
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/js/libs.min.js"></script>
<!-- ALL THIS FILES CAN BE REPLACE WITH ONE FILE libs.min.js -->
<!--
<script src="js/module/waypoints.min.js"></script>
<script src="js/module/SmoothScroll.js"></script>
<script src="js/module/skrollr.js"></script>
<script src="js/module/sly.min.js"></script>
<script src="js/module/perfect-scrollbar.js"></script>
<script src="js/module/retina.min.js"></script>
<script src="js/module/jquery.localScroll.min.js"></script>
<script src="js/module/jquery.scrollTo-min.js"></script>
<script src="js/module/jquery.nav.js"></script>
<script src="js/module/hoverIntent.js"></script>
<script src="js/module/superfish.js"></script>
<script src="js/module/jquery.placeholder.js"></script>
<script src="js/module/countUp.js"></script>
<script src="js/module/isotope.pkgd.min.js"></script>
<script src="js/module/jquery.flatshadow.js"></script>
<script src="js/module/jquery.knob.js"></script>
<script src="js/module/jflickrfeed.min.js"></script>
<script src="js/module/instagram.min.js"></script>
<script src="js/module/jquery.tweet.js"></script>
<script src="js/module/bootstrap.min.js"></script>
<script src="js/module/bootstrap-transition.js"></script>
<script src="js/module/responsive.tab.js"></script>
<script src="js/module/jquery.magnific-popup.min.js"></script>
<script src="js/module/jquery.validate.min.js"></script>
<script src="js/module/owl.carousel.min.js"></script>
<script src="js/module/jquery.flexslider.js"></script>
<script src="js/module/jquery-ui.min.js"></script>
<script src="js/module/zoomsl-3.0.min.js"></script>
-->
<!-- END -->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/js/specific/mediaelement/mediaelement-and-player.min.js"></script>
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/js/specific/video.js"></script>
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/js/specific/bigvideo.js"></script>
<script src="https://maps.google.com/maps/api/js?sensor=true"></script>
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/js/specific/gmap3.min.js"></script>
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/js/map.js"></script>
<script type="text/javascript"
        src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/js/specific/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript"
        src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/js/specific/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/js/main.js"></script>

<!-- Modern Enhancements JS -->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/js/modern-enhancements.js')}}"></script>

<!--! FOOTER -->

@yield('script')


<script>
    var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?75826';
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var options = {
        "enabled":true,
        "chatButtonSetting":{
            "backgroundColor":"#4dc247",
            "ctaText":"",
            "borderRadius":"25",
            "marginLeft":"0",
            "marginBottom":"50",
            "marginRight":"50",
            "position":"right"
        },
        "brandSetting":{
            "brandName":"{{$mainSettings->name}}",
            "brandSubTitle":"{{trans('front.chat_msg')}}",
            "brandImg":"{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/images/favicon.ico')}}",
            "welcomeText":"{{trans('front.connected_us')}}",
            "backgroundColor":"#0a5f54",
            "ctaText":"{{trans('front.start_chat')}}",
            "borderRadius":"25",
            "autoShow":false,
            "phoneNumber":"+201014401468"
        }
    };
    s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
</script>
<style>
.wa-chat-box-poweredby {
    display: none;
}
</style>
</body>
</html>


<?php /* ?>

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" @if($lang=='ar') dir="rtl" @else dir="ltr" @endif>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="@if(isset($title)) {{$title}}  |@endif {{ @$mainSettings->name }}">
    <title>@if(isset($title)) {{$title}}  |@endif {{ @$mainSettings->name }} </title>
    <meta name="keywords" content="{{@$mainSettings->name}}, {!!  @$mainSettings->meta_keywords !!} {{@$metaKeywords}}"/>
    <meta name="description" content="{{@$mainSettings->name}}, {{ @$metaDescription ?? $mainSettings->meta_description }}"/>
    <link rel="canonical" href="{{ url()->current() }}" />


{{--    <meta name="robots" content="noindex">--}}
{{--    <meta name="robots" content="nofollow">--}}
{{--    <meta name="googlebot" content="noindex">--}}


@yield('meta')

<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons-->
    <link rel="shortcut icon" href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/img/logo/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon"
          href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/img/logo/White_icon_Ver.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
          href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/img/logo/White_icon_Ver.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
          href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/img/logo/White_icon_Ver.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
          href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/img/logo/White_icon_Ver.png')}}">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="preload">

    <!-- BASE CSS -->

    @if($lang=='ar')
        <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/css/bootstrap-rtl.min.css')}}" rel="stylesheet">
    @else
        <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/css/bootstrap.min.css')}}" rel="stylesheet">
    @endif
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/css/style.min.css')}}" rel="stylesheet">

    @if($lang=='ar')
        <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/css/style-rtl.css')}}" rel="stylesheet">
    @endif
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/css/vendors.min.css')}}" rel="stylesheet preload">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/css/custom.css')}}" rel="stylesheet">

    <style>
        .required {
            color: #e02222;
        }
        body {
            font-size: 1.00rem;
        }
    </style>

    @yield('style')

<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-180323439-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-180323439-1');
    </script>

</head>

<body @if($lang=='ar') class="rtl" @else class="ltr" @endif >

<div id="page">

    <header class="header menu_fixed">
        {{--        <div id="preloader">--}}
        {{--            <div data-loader="circle-side"></div>--}}
        {{--        </div><!-- /Page Preload -->--}}
        <div id="logo">
            <a href="{{asset($lang)}}">
                <img src="{{$mainSettings->logo_white}}" width="150" height="36" data-retina="true"
                     alt="{{$mainSettings->name}}" class="logo_normal">
                <img src="{{$mainSettings->logo}}" width="150" height="36"
                     data-retina="true" alt="{{$mainSettings->name}}" class="logo_sticky">
            </a>
        </div>
        <ul id="top_menu">
            {{--            <li><a href="cart-1.html" class="cart-menu-btn" title="Cart"><strong>4</strong></a></li>--}}
            <li><a id="login_btn"  @if($currentUser) href="{{route('dashboard')}}"  class="login " @else href="#sign-in-dialog"  class="login sign-in-form"  title="{{trans('global.login')}}" @endif>{{trans('global.login')}}</a></li>
            <li><a href="{{route('favorites')}}" class="wishlist_bt_top"
                   title="{{trans('global.wishlist')}}">{{trans('global.wishlist')}}</a></li>
        </ul>
        <!-- /top_menu -->
        <a href="#menu" class="btn_mobile">
            <div class="hamburger hamburger--spin" id="hamburger">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                </div>
            </div>
        </a>
        <nav id="menu" class="main-menu">
            <ul>

                <li><span><a href="{{asset($lang)}}">{{trans('global.home')}}</a></span></li>
                 <li><span><a href="{{route('contact')}}">{{trans('global.contact_us')}}</a></span></li>
            </ul>
        </nav>
    </header>
    <!-- /header -->


    @yield('content')


    <footer>
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-5 col-md-12 p-r-5">
                    <p><img src="{{$mainSettings->logo_white}}" width="150" height="36"
                            data-retina="true" alt="{{$mainSettings->name}}"></p>
                    <p>{{trans('global.footer_about_msg')}}</p>
                    <div class="follow_us">
                        <ul>
                            <li>{{trans('global.follow_us')}}</li>
                            @if(@$mainSettings->facebook)<li><a href="{{@$mainSettings->facebook}}"><i class="ti-facebook"></i></a></li>@endif
                            @if(@$mainSettings->twitter)<li><a href="{{@$mainSettings->twitter}}"><i class="ti-twitter-alt"></i></a></li>@endif
                            @if(@$mainSettings->google)<li><a href="{{@$mainSettings->google}}"><i class="ti-google"></i></a></li>@endif
                            @if(@$mainSettings->pinterest)<li><a href="{{@$mainSettings->pinterest}}"><i class="ti-pinterest"></i></a></li>@endif
                            @if(@$mainSettings->instagram)<li><a href="{{@$mainSettings->instagram}}"><i class="ti-instagram"></i></a></li>@endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 ml-lg-auto">
                    <h5>{{trans('global.links')}}</h5>
                    <ul class="links">
                        <li><a href="{{trans('about')}}">{{trans('global.about')}}</a></li>
                        <li><a href="{{route('register')}}">{{trans('global.register')}}</a></li>
                        <li><a href="{{route('login')}}">{{trans('global.login')}}</a></li>
                       <li><a href="{{route('contact')}}">{{trans('global.contact_us')}}</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    {{--                    <h5>{{trans('global.contact')}}</h5>--}}
                    {{--                    <ul class="contacts">--}}
                    {{--                        <li><a href="tel://61280932400"><i class="ti-mobile"></i> + 61 23 8093 3400</a></li>--}}
                    {{--                        <li><a href="mailto:info@Panagea.com"><i class="ti-email"></i> info@Panagea.com</a></li>--}}
                    {{--                    </ul>--}}
                    <div id="newsletter">
                        <h6>{{trans('global.newsletter')}}</h6>
                        <div id="message-newsletter"
                             style="padding-bottom: 20px">{{trans('global.footer_newsletter_msg')}}</div>
                        <form method="post" action="{{route('newsletter')}}" name="newsletter_form" id="newsletter_form">
                            <div class="form-group">
                                <input type="email" name="email_newsletter" id="email_newsletter" class="form-control"
                                       placeholder="{{trans('global.email')}}">
                                <input type="submit" value="{{trans('global.register_now')}}" id="submit-newsletter">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--/row-->
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <ul id="footer-selector">
                        <li>
                            <div class="styled-select" id="lang-selector">
                                <select id="change_language">
                                    <option value="en" @if($lang == 'en') selected @endif>English</option>
                                    <option value="ar" @if($lang == 'ar') selected @endif>عربي</option>
                                    {{--                                    <option value="Spanish">Spanish</option>--}}
                                    {{--                                    <option value="Russian">Russian</option>--}}
                                </select>
                            </div>
                        </li>
                        {{--                        <li>--}}
                        {{--                            <div class="styled-select" id="currency-selector">--}}
                        {{--                                <select>--}}
                        {{--                                    <option value="US Dollars" selected>US Dollars</option>--}}
                        {{--                                    <option value="Euro">Euro</option>--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                        </li>--}}
{{--                        <li><img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/img/cards_all.svg')}}" alt=""></li>--}}
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul id="additional_links">
                        <li><a href="#0">{{trans('global.terms')}}</a></li>
                        {{--                        <li><a href="#0">Privacy</a></li>--}}
                        <li><span>{{trans('global.copy_right')}}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!--/footer-->

</div>
<!-- page -->

<!-- Sign In Popup -->
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h3>{{trans('global.login')}}</h3>
    </div>
        <div class="sign-in-wrapper">
            <a href="{{route('socialLogin').'?provider=facebook'}}" class="social_bt facebook">{{trans('global.login_facebook')}}</a>
{{--            <a href="{{route('socialLogin').'?provider=twitter'}}" class="social_bt twitter"><i class="fa fa-twitter"></i>{{trans('global.login_twitter')}}</a>--}}
            <a href="{{route('socialLogin').'?provider=google'}}" class="social_bt google">{{trans('global.login_google')}}</a>
            <div class="divider"><span>{{trans('global.or')}}</span></div>

            <form action="{{route('login')}}" method="post">
                {{csrf_field()}}
            <div class="form-group">
                <label>{{trans('global.email')}}</label>
                <input type="email" class="form-control" name="email" id="email">
                <i class="icon_mail_alt"></i>
            </div>
            <div class="form-group">
                <label>{{trans('global.password')}}</label>
                <input type="password" class="form-control" name="password" id="password" value="">
                <i class="icon_lock_alt"></i>
            </div>
            <div class="clearfix add_bottom_15">
                <div class="checkboxes float-left">
                    <label class="container_check">{{trans('global.remember_me')}}
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="float-right mt-1"><a
{{--                                                id="forgot"--}}
                                                 href="{{ route('password.request') }}">{{trans('global.forgot_password')}}</a>
                </div>
            </div>
            <div class="text-center"><input type="submit" value="{{trans('global.login')}}" class="btn_1 full-width">
            </div>
            </form>
            <div class="text-center">
                {{trans('global.account_not_found')}} <a href="{{route('register')}}">{{trans('global.sign_up')}}</a>
            </div>
            <form action="{{ route('password.email') }}" method="post">
                {{csrf_field()}}
            <div id="forgot_pw">
                <div class="form-group">
                    <label>{{trans('global.forgot_password')}}</label>
                    <input type="email" class="form-control" name="email_forgot" id="email_forgot">
                    <i class="icon_mail_alt"></i>
                </div>
                <p>{{trans('global.forgot_password_msg')}}</p>
                <div class="text-center"><input type="submit" value="{{trans('global.reset_password')}}" class="btn_1">
                </div>
            </div>
            </form>
        </div>
    <!--form -->
</div>
<!-- /Sign In Popup -->

<div id="toTop"></div><!-- Back to top button -->

<!-- COMMON SCRIPTS -->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/js/jquery-2.2.4.min.js')}}"></script>
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/js/common_scripts.min.js')}}"></script>
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/js/main_rtl.min.js')}}"></script>
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/assets/validate.js')}}"></script>

<!-- DATEPICKER  -->
<script>
    function addFavorite(id, type) {
        @if(!$currentUser)
        document.getElementById('login_btn').click();
        return true;
        @else
        $.ajax({
            url: '{{route('addFavoriteByAjax')}}',
            method: "POST",
            data: {id: id, type: type, _token: "{{csrf_token()}}"},
            dataType: "text",
            success: function (data) {
                document.getElementById("favorite_" + type + "_" + id).setAttribute("onClick", "removeFavorite(" + id + ", " + type + ")");
                document.getElementById("favorite_" + type + "_" + id).classList.add('liked');
                // removeFavoriteText(id, type);

            }
        });
        @endif
    }

    function removeFavorite(id, type) {
        $.ajax({
            url: '{{route('removeFavoriteByAjax')}}',
            method: "POST",
            data: {id: id, type: type, _token: "{{csrf_token()}}"},
            dataType: "text",
            success: function (data) {
                document.getElementById("favorite_" + type + "_" + id).setAttribute("onClick", "addFavorite(" + id + ", " + type + ")");
                document.getElementById("favorite_" + type + "_" + id).classList.remove('liked');
                // addFavoriteText(id, type);
            }
        });
    }
    function removeFavoriteText(id, type) {
        $("#favorite_" + type + "_" + id).html("<i class='icon-heart-empty'></i> {{trans('global.add_to_favourites')}}");
    }
    function addFavoriteText(id, type) {
        $("#favorite_" + type + "_" + id).html("<i class='icon_heart'></i> {{trans('global.remove_from_favourites')}}");
    }

    $(function () {
        'use strict';
        $('input[name="dates"]').daterangepicker({
            autoUpdateInput: false,
            opens: 'left',
            locale: {
                direction: 'rtl',
                cancelLabel: 'Clear'
            }
        });
        $('input[name="dates"]').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('MM-DD-YY') + ' > ' + picker.endDate.format('MM-DD-YY'));
        });
        $('input[name="dates"]').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });
    });
</script>


<script>


    $(document).ready(function () {

        // get your select element and listen for a change event on it
        $('#change_language').change(function () {
            // set the window's location property to the value of the option the user has selected
            change_language = $('#change_language').val();
            //alert(city_agents);
            if (change_language == 'ar')
                window.location = "{{preg_replace('/'.request()->segment(1).'/', 'ar', strtolower(request()->fullUrl()),1)}}";
            else
                window.location = "{{preg_replace('/'.request()->segment(1).'/', 'en', strtolower(request()->fullUrl()),1)}}";
        });

    });
</script>

<!-- INPUT QUANTITY  -->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/js/input_qty.js')}}"></script>


@yield('script')

</body>
</html>

<?php */ ?>
