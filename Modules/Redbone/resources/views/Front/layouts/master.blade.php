

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if($lang == 'ar') dir="rtl" @endif>
<head>
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{$mainSettings['meta_description']}}">
    <meta name="keywords" content="{{$mainSettings['meta_keywords']}}">
    <meta name="author" content="{{$mainSettings['name']}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{asset('/'.$lang)}}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{$mainSettings['name']}}">
    <meta property="og:description" content="{{$mainSettings['meta_description']}}">
    <meta property="og:image" content="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/img/logo.png')}}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{$mainSettings['name']}}">
    <meta name="twitter:description" content="{{$mainSettings['meta_description']}}">
    <meta name="twitter:image" content="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/img/logo.png')}}">

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
    @php 
    $template_version = env('TEMPLATE_NUM', '1');
    @endphp
    <!--====== Favicon Icon ======-->
    <!-- Favicon -->
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/img/logo.png')}}" rel="shortcut icon" type="image/png">
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/img/logo.png')}}" rel="icon" type="image/png">
    <!--====== Bootstrap css ======-->
    @if($lang == 'ar')
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
        <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/css/bootstrap.min.css" rel="stylesheet">
    @endif
        <!--====== Mmenu css ======-->
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/css/mmenu.css" rel="stylesheet">
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/css/mmenu.all.css" rel="stylesheet">
    <!--====== icon css ======-->
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/css/line-awesome.min.css" rel="stylesheet">
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/css/flaticon.css" rel="stylesheet">
    <!--====== Animate  css ======-->
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/css/animate.min.css" rel="stylesheet">
    <!--====== Owl carousel css ======-->
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/css/owl.carousel.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/css/owl.theme.default.min.css">
    <!--====== Odometer Min  css ======-->
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/css/odometer.min.css" rel="stylesheet">
    <!--====== Swiper css ======-->
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/css/swiper-bundle.min.css" rel="stylesheet">
    <!--====== nice-select css ======-->
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/css/nice-select.css" rel="stylesheet">
    <!--====== Style css ======-->
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/scss/style.css" rel="stylesheet">

    @yield('style')
    <style>
        .product-img {
            text-align: center;
            object-fit: cover;
            height: 350px;
        }
    </style>
</head>
<body>
<!-- Preloader start -->
<div class="proloader">
    <div class="loader_34">
        <!-- Preloader Elements -->
        <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/img/preloader.gif" alt="Image">
    </div>
</div>
<!-- Preloader end -->

<!-- Theme Switcher Start -->
<div class="switch-theme-mode">
    <label id="switch" class="switch">
        <input type="checkbox" onchange="toggleTheme()" id="slider">
        <span class="slider round"></span>
    </label>
</div>
<!-- Theme Switcher End -->

<!-- page wrapper Start -->
<div class="page-wrapper">
    <!-- Header  start -->
    <header class="header-wrap v1 s2 bg-black">
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 d-lg-inline-block d-none">
{{--                        <p class="mb-0">New Membership Deals Going On! Join Now For $0 Initiation. </p>--}}
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="header-top-right">
                            <div class="close-header-top">
                                <button type="button"><i class="las la-times"></i></button>
                            </div>
                            <div class="header-top-contact">
                                <p><i class="las la-map-marker-alt"></i>{{$mainSettings['address']}}</p>
                                <a href="callto:{{$mainSettings['phone']}}"><i class="flaticon-phone-call"></i>{{$mainSettings['phone']}}</a>
                            </div>
                            <div class="lang_selctor v2">
                                <i class="las la-globe"></i>
                                <select id="languageSwitcher">
                                    <option value="en" @if($lang == 'en') selected="" @endif>English</option>
                                    <option value="ar" @if($lang == 'ar') selected="" @endif>العربية</option>
                                </select>
                            </div>
{{--                            <div class="header_btn xl-none">--}}
{{--                                <a href="#" class="btn v1">Make A Visit</a>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-3 col-8">
                        <div class="logo v2">
                            <a href="{{asset('/')}}">
                                <img class="logo-dark" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/img/logo.png" alt="Image">
                                <img class="logo-light" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/img/logo.png" alt="Image">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-1 col-4 order-lg-1 order-md-2 order-2">
                        <nav id="menu" class="main-menu  text-center">
                            <ul>
                                <li ><a class="active" href="{{asset($lang)}}#page-top">{{trans('front.home')}}</a>
                                </li>
                                <li><a href="{{asset($lang)}}#about">{{trans('front.about')}}</a>
                                </li>
                                <li><a href="{{asset($lang)}}#subscriptions">{{trans('front.subscriptions')}}</a>
                                </li>
                                <li><a href="{{asset($lang)}}#gallery">{{trans('front.gallery')}}</a>
                                </li>
{{--                                <li><a href="{{asset($lang)}}#schedule">{{trans('front.activities')}}</a>--}}
{{--                                </li>--}}
{{--                                <li><a href="{{route('banner')}}">{{trans('front.schedule_banner')}}</a>--}}
{{--                                </li>--}}
                                <li><a href="{{asset($lang)}}#activities">{{trans('front.activities')}}</a>
                                </li>
                                <li><a href="{{asset($lang)}}#contact">{{trans('front.contact_us')}}</a>
                                </li>
                            </ul>
                        </nav>
                        <div class="mobile-menu">
                            <a href='#menu'><i class="las la-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-1 col-md-4  col-5 mpx-0">
                </div>
                <div class="col-lg-11 col-md-8 col-7">
                </div>
            </div>
        </div>
    </header>
   <!-- Header  end -->
    @yield('content')
    <!-- Footer  start -->
    <footer class="footer-wrap v2" id="contact">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-12">
                        <div class="footer-widget">
{{--                            <div class="footer-widget-title">--}}
{{--                                <h5>{{trans('front.about')}}</h5>--}}
{{--                            </div>--}}
{{--                            <div class="comp-text">--}}
{{--                                <p>{{strip_tags($mainSettings['about'])}}</p>--}}
{{--                            </div>--}}
                            <div class="comp-address-wrap">
                                <div class="com-address-item">
                                    <div class="com-address-icon">
                                        <i class="las la-envelope"></i>
                                    </div>
                                    <div class="comp-address-info">
                                        <p>{{trans('sw.email')}}:</p>
                                        <a href="mailTo:<?php echo $mainSettings['support_email'] ?>"><span class="__cf_email__" data-cfemail="71000418121a020401011e0305311718081f5f121e1c"><?php echo $mainSettings['support_email'] ?></span></a>
                                    </div>
                                </div>
                                <div class="com-address-item">
                                    <div class="com-address-icon">
                                        <i class="las la-phone"></i>
                                    </div>
                                    <div class="comp-address-info">
                                        <p>{{trans('sw.phone')}}:
                                        </p>
                                        <a href="tel:<?php echo $mainSettings['phone'] ?>"><?php echo $mainSettings['phone'] ?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="social-profile">
                                <ul>
                                    <?php if ($mainSettings['facebook']) { ?><li><a target="_blank" href="<?php echo $mainSettings['facebook'] ?>"><i class="lab la-facebook-f"></i></a></li><?php } ?>
                                        <?php if ($mainSettings['instagram']) { ?><li><a target="_blank" href="<?php echo $mainSettings['instagram'] ?>"><i class="lab la-instagram"></i></a></li><?php } ?>
                                        <?php if ($mainSettings['twitter']) { ?><li><a target="_blank" href="<?php echo $mainSettings['twitter'] ?>"><i class="lab la-twitter"></i></a></li><?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-12">
                        <div class="footer-widget">
                            <div class="footer-widget-title">
{{--                                <h5>Useful Links</h5>--}}
                            </div>
                            <div class="footer-menu">
                                <ul>
                                    <li><a class="link v3" href="{{route('home')}}#page-top">{{trans('front.home')}}</a></li>
                                    <li><a class="link v3" href="{{route('home')}}#about">{{trans('front.about')}}</a></li>
                                    <li><a class="link v3" href="{{route('home')}}#subscriptions">{{trans('front.subscriptions')}}</a></li>
                                    <li><a class="link v3" href="{{route('home')}}#gallery">{{trans('front.gallery')}}</a></li>
{{--                                    <li><a class="link v3" href="{{route('home')}}#schedule">{{trans('front.activities')}}</a></li>--}}
{{--                                    <li><a class="link v3" href="{{route('banner')}}">{{trans('front.schedule_banner')}}</a></li>--}}
                                    <li><a class="link v3" href="{{route('home')}}#activities">{{trans('front.activities')}}</a></li>
                                    <li><a class="link v3" href="{{route('home')}}#contact">{{trans('front.contact_us')}}</a></li>
{{--                                    <li><a class="link v3" href="{{route('terms')}}">{{trans('front.terms')}}</a></li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-12 col-12">
                        <div class="footer-widget">
                            <div class="footer-widget-title">
                                <h5>{{trans('front.contact_info')}}</h5>
                            </div>
                            <div class="comp-location-wrap row">
                                <div class="col-lg-12">
                                    <div class="comp-location">
                                        <div class="loc-icon">
                                            <i class="las la-map-marker-alt"></i>
                                        </div>
{{--                                        <h6>New York </h6>--}}
                                        <span><?php echo $mainSettings['address'] ?></span>
                                        <p><a href="tel:<?php echo $mainSettings['phone'] ?>"> <?php echo $mainSettings['phone'] ?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright-text">
                            <p> {{trans('front.dev_des')}} <a href="https://demo.gymmawy.com" target="_blank"><img style="width: 24px;" src="https://gymmawy.com/resources/assets/front/img/logo/favicon.ico"/> {{trans('front.gymmawy')}}
                                </a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer  end -->

</div>
<!-- Page wrapper end -->
<!-- Back-to-top button start -->
<a href="#" class="back-to-top bounce"><i class="las la-arrow-up"></i></a>
<!-- Back-to-top button end -->
<!--====== jquery js ======-->
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/js/jquery.min.js"></script>
<!--====== Bootstrap js ======-->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/js/bootstrap-validator.min.js"></script>
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/js/form-validation.js"></script>
<!--====== Jquery mmenu js ======-->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/js/mmenu.js"></script>
<!--====== Owl carousel js ======-->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/js/owl.carousel.min.js"></script>
<!--====== Swiper js ======-->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/js/swiper-bundle.min.js"></script>
<!--====== Mixitup js ======-->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/js/mixitup.min.js"></script>
<!--====== Fslightbox js ======-->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/js/fslightbox.js"></script>
<!--====== Odometer Min js ======-->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/js/jquery.appear.js"></script>
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/js/odometer.min.js"></script>
<!--======Comparison to js ======-->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/js/comparison-slider.js"></script>
<!--====== Nice-selcet js ======-->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/js/jquery.nice-select.min.js"></script>
<!--====== Main js ======-->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/js/main.js"></script>
<!--====== Tweenmax js ======-->
<script src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/')}}/assets/js/tweenmax.min.js"></script>
@yield('script')
<script>
    $('#languageSwitcher').on('change', function () {
        const selectedLang = $(this).val();
        let currentUrl = window.location.href;
        // Replace language part in the URL
        if (selectedLang === 'en') {
            currentUrl = currentUrl.replace('/ar', '/en');
        } else if (selectedLang === 'ar') {
            currentUrl = currentUrl.replace('/en', '/ar');
        }

        // Redirect to the new URL
        window.location.href = currentUrl;
    });
</script>
</body>
</html>



