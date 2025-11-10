<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php($template_version = $template_version ?? env('TEMPLATE_NUM', '1'))
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
    <meta property="og:image" content="{{asset('Modules/Zonegym/resources/assets/images/logo.png')}}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{$mainSettings['name']}}">
    <meta name="twitter:description" content="{{$mainSettings['meta_description']}}">
    <meta name="twitter:image" content="{{asset('Modules/Zonegym/resources/assets/images/logo.png')}}">

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
    <link href="{{asset('favicon.png')}}" rel="shortcut icon" type="image/png">
    <link href="{{asset('favicon.png')}}" rel="icon" type="image/png">

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('resources/' . $template_version . '/assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('resources/' . $template_version . '/assets/css/style.css')}}" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="{{asset('resources/' . $template_version . '/assets/css/responsive.css')}}" rel="stylesheet">

    @if(!empty($zonegymInlineCss))
        <style>{!! $zonegymInlineCss !!}</style>
    @endif

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        /*  Fonts --------------------------------*/
        @import url({{asset('resources/' . $template_version . '/assets/fonts/Droid.Arabic.Kufi_DownloadSoftware.iR_.ttf')}});
        /* font-family:'Droid Arabic Kufi',  Tahoma, Geneva, sans-serif; */
        @import url({{asset('resources/' . $template_version . '/assets/fonts/Droid.Arabic.Kufi_DownloadSoftware.iR_.ttf')}});
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
        .main-slider-sec {
    margin-top: 60px;
}

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
                            <a href="{{asset($lang)}}" class="js-scroll-trigger"><img src="{{asset('Modules/Zonegym/resources/assets/logo.png')}}" style="width: 135px; height:80px;object-fit: contain" alt="">
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
                                <!--                                    <a class="nav-link js-scroll-trigger" href="#courses">Ã˜Â§Ã™â€žÃ˜Â¯Ã™Ë†Ã˜Â±Ã˜Â§Ã˜Âª</a>-->
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
                                <!--                                <li class="nav-item">-->
                                <!--                                    <a class="nav-link js-scroll-trigger" href="#blog">Ã™â€¦Ã˜Â¯Ã™Ë†Ã™â€ Ã˜Â© Ã˜Â§Ã™Ë† Ã™â€¦Ã˜Â°Ã™Æ’Ã˜Â±Ã˜Â©</a>-->
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

<!-- Footer section -->
<footer class="main-footer over-layer-black">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="footer-about-col col-default-mb30">
                    <h4>{{trans('front.about')}}</h4>
                    <p><?php echo strip_tags($mainSettings['about'])?> </p>
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
                    <!--                    <h4>Ã˜Â§Ã™â€žÃ˜Â¹Ã™â€žÃ˜Â§Ã™â€¦Ã˜Â§Ã˜Âª</h4>-->
                    <div class="tag-group clearfix">
                        <a class="tag-btn " href="{{route('home')}}#page-top">{{trans('front.home')}}</a>
                        <a class="tag-btn " href="{{route('home')}}#about">{{trans('front.about')}}</a>
                        <a class="tag-btn " href="{{route('home')}}#activities">{{trans('front.activities')}}</a>
                        <a class="tag-btn " href="{{route('home')}}#gallery">{{trans('front.gallery')}}</a>
                        <a class="tag-btn " href="{{route('home')}}#subscriptions">{{trans('front.subscriptions')}}</a>
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
<script src="{{asset('resources/' . $template_version . '/assets/js/jquery.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('resources/' . $template_version . '/assets/js/bootstrap.bundle.min.js')}}"></script>

<!-- All Included JavaScript -->
<script type="text/javascript" src="{{asset('resources/' . $template_version . '/assets/js/jquery.easing.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . $template_version . '/assets/js/jquery.pogo-slider.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . $template_version . '/assets/js/animated-text.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . $template_version . '/assets/js/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . $template_version . '/assets/js/jarallax.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . $template_version . '/assets/js/css3-animate-it.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . $template_version . '/assets/js/counter.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . $template_version . '/assets/js/jarallax.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . $template_version . '/assets/js/css3-animate-it.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . $template_version . '/assets/js/featherlight.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . $template_version . '/assets/js/featherlight.gallery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . $template_version . '/assets/js/bootstrap-portfilter.js')}}"></script>
<script type="text/javascript" src="{{asset('resources/' . $template_version . '/assets/js/particles.js')}}"></script>
@if(!empty($zonegymInlineParticlesJs))
    <script>{!! $zonegymInlineParticlesJs !!}</script>
@else
    <script type="text/javascript" src="{{asset('resources/' . $template_version . '/assets/js/particles-app.js')}}"></script>
@endif

<!-- Google map -->
<script type="text/javascript" src="{{asset('resources/' . $template_version . '/assets/js/google-map.js')}}"></script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdEPAHqgxFK5pioDAB3rsvKchAtXxRGO4&callback=myMap"></script>

<!-- Custom Js -->
<script type="text/javascript" src="{{asset('resources/' . $template_version . '/assets/js/main.js')}}"></script>
@yield('script')

</body>
</html>

