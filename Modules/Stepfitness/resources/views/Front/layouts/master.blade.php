<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    <meta property="og:image" content="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/images/logo.png')}}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{$mainSettings['name']}}">
    <meta name="twitter:description" content="{{$mainSettings['meta_description']}}">
    <meta name="twitter:image" content="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/images/logo.png')}}">

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
    @php 
    $template_version = env('TEMPLATE_NUM', '1');
    @endphp

    <title>{{$mainSettings['name']}}</title>

    <!-- Favicon -->
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/images/favicon.ico')}}" rel="shortcut icon" type="image/png">
    <link href="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/images/favicon.ico')}}" rel="icon" type="image/png">

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('resources/' . $template_version . '/assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('resources/' . $template_version . '/assets/css/style.css') }}" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="{{ asset('resources/' . $template_version . '/assets/css/responsive.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
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
        @media only screen and (max-width: 768px) {
            .logo.logo-width-1 a img {
                height: 50px !important;
                object-fit: cover;
            }
            .visible-mobile {
                display: block !important;
            }
            .visible-pc {
                display: none !important;
            }
        }
        @media only screen and (min-width: 768px ) {
            .visible-mobile {
                display: none !important;
            }
            .visible-pc{
                display: block !important;
            }
        }

        .rtl-theme .main-nav .navbar-nav>li>a {
            margin-right: 22px;
            font-size: 16px;
        }
    </style>

    @yield('style')
</head>

<body <?php if($lang=='ar'){?> class="rtl-theme" <?php } ?> id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<!-- Preloader start -->
<div id="preloader"></div>


<!-- Main Header start -->
<header class="main-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Navigation -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top main-nav" id="mainNav" style="padding-top:0px!important;padding-bottom:0px !important;">
                    <div class="container">
                        <div class="navbar-brand">
                            <a href="#page-top" class="js-scroll-trigger"><img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/images/logo.png')}}" style="width: 135px; height:90px;object-fit: contain" alt="">
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
                                <li class="nav-item">
                                    <a class="nav-link js-scroll-trigger" href="{{asset($lang)}}#about">{{trans('front.about')}}</a>
                                </li>
                                <!--                                <li class="nav-item">-->
                                <!--                                    <a class="nav-link js-scroll-trigger" href="#courses">الدورات</a>-->
                                <!--                                </li>-->

                                <li class="nav-item">
                                    <a class="nav-link js-scroll-trigger" href="{{asset($lang)}}#subscriptions">{{trans('front.subscriptions')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link js-scroll-trigger" href="{{asset($lang)}}#gallery">{{trans('front.gallery')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link js-scroll-trigger" href="{{asset($lang)}}#schedule">{{trans('front.activities')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link js-scroll-trigger" href="{{route('banner')}}">{{trans('front.schedule_banner')}}</a>
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


@yield('content')

<!-- Scroll Up -->
<div class="goto-top-section">
    <span class="triangle"></span>
    <a class="js-scroll-trigger" href="#page-top">
        <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </a>
</div>


<!-- Footer section -->
<footer class="main-footer over-layer-black">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="footer-about-col col-default-mb30">
                    <h4>{{trans('front.about')}}</h4>
                    <p>{{strip_tags($mainSettings['about'])}}</p>
                    <!--                    <p><i class="fa fa-clock-o" aria-hidden="true"></i> الأحد - الجمعة (10:00 - 22:00)</p>-->
                    <!--                    <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص. بينما تعمل </p>-->

                    <div class="social text-left">
                        <?php if ($mainSettings['facebook']) { ?><a href="<?php echo $mainSettings['facebook'] ?>"><i
                                    class="fa fa-facebook" aria-hidden="true"></i></a><?php } ?>
                        <?php if ($mainSettings['twitter']) { ?><a href="<?php echo $mainSettings['twitter'] ?>"><i
                                    class="fa fa-twitter" aria-hidden="true"></i></a><?php } ?>
                        <?php if ($mainSettings['instagram']) { ?><a href="<?php echo $mainSettings['instagram'] ?>"><i
                                    class="fa fa-instagram" aria-hidden="true"></i></a><?php } ?>
                    <!--                        -->
                        <?php //if($record['facebook']){ ?><!--<a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>--><?php //} ?>
                    <!--                        -->
                        <?php //if($record['facebook']){ ?><!--<a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>--><?php //} ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="footer-Tag-col col-default-mb30">
                    <!--                    <h4>القائمة</h4>-->
                    <div class="tag-group clearfix">
                        <a class="tag-btn js-scroll-trigger" href="{{route('home')}}#page-top">{{trans('front.home')}}</a>
                        <a class="tag-btn js-scroll-trigger" href="{{route('home')}}#about">{{trans('front.about')}}</a>
                        <a class="tag-btn js-scroll-trigger"
                           href="{{route('home')}}#subscriptions">{{trans('front.subscriptions')}}</a>
                        <a class="tag-btn js-scroll-trigger" href="{{route('home')}}#gallery">{{trans('front.gallery')}}</a>
                        <a class="tag-btn js-scroll-trigger" href="{{route('home')}}#schedule">{{trans('front.activities')}}</a>
                        <a class="tag-btn js-scroll-trigger" href="{{route('banner')}}">{{trans('front.schedule_banner')}}</a>
                        <a class="tag-btn js-scroll-trigger" href="{{route('home')}}#contact">{{trans('front.contact_us')}}</a>
                        <a class="tag-btn js-scroll-trigger" href="{{route('terms')}}">{{trans('front.terms')}}</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-12 col-sm-12">
                <div class="footer-subscribe-col col-default-mb30">
                    <h4>{{trans('front.contact_info')}}</h4>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $mainSettings['address'] ?> </p>
                    <p><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo $mainSettings['support_email'] ?> </p>
                    <p><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $mainSettings['phone'] ?> </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Copyright section -->
<section class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p> {{trans('front.dev_des')}} <a href="https://demo.gymmawy.com" target="_blank"><img
                                style="width: 24px;"
                                src="https://gymmawy.com/resources/assets/front/img/logo/favicon.ico"/> {{trans('front.gymmawy')}}
                    </a></p>
            </div>
        </div>
    </div>
</section>

<!-- jQuery -->
<script src="{{ asset('resources/' . $template_version . '/assets/js/jquery.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('resources/' . $template_version . '/assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- All Included JavaScript -->
<script type="text/javascript" src="{{ asset('resources/' . $template_version . '/assets/js/jquery.easing.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/' . $template_version . '/assets/js/jquery.pogo-slider.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/' . $template_version . '/assets/js/animated-text.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/' . $template_version . '/assets/js/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/' . $template_version . '/assets/js/jarallax.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/' . $template_version . '/assets/js/css3-animate-it.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/' . $template_version . '/assets/js/counter.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/' . $template_version . '/assets/js/jarallax.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/' . $template_version . '/assets/js/css3-animate-it.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/' . $template_version . '/assets/js/featherlight.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/' . $template_version . '/assets/js/featherlight.gallery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/' . $template_version . '/assets/js/bootstrap-portfilter.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/' . $template_version . '/assets/js/particles.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/' . $template_version . '/assets/js/particles-app.js') }}"></script>

<!-- Google map -->

<!-- Custom Js -->
<script type="text/javascript" src="{{ asset('resources/' . $template_version . '/assets/js/main.js') }}"></script>

@yield('script')
</body>

</html>
