@extends('cakorinas::Front.layouts.master')
@section('style')
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
                <!--                <p class="pogoSlider-slide-element slider-para" data-in="slideUp" data-out="slideUp" data-duration="1500" data-delay="500">Ã˜Â§Ã™â€žÃ™â€žÃ™Å Ã˜Â§Ã™â€šÃ˜Â© Ã˜Â¶Ã˜Â±Ã™Ë†Ã˜Â±Ã™Å Ã˜Â© Ã™â€žÃ™Æ’Ã™â€ž Ã˜Â¥Ã™â€ Ã˜Â³Ã˜Â§Ã™â€ </p>-->
                <a href="#contact" class="btn btn-default pogoSlider-slide-element join-btn" data-in="expand" data-out="slideUp" data-duration="1500" data-delay="500" type="submit">{{trans('front.join_us')}}</a>
            </div>
        </div>
    @endforeach
    <!--        <div class="pogoSlider-slide" data-transition="shrinkReveal" data-duration="1000" style="background-image:url(images/rtl-images/slider/2.jpg);">-->
        <!---->
        <!--            <div class="silder-elements">-->
        <!--                <h2 class="pogoSlider-slide-element slider-main-title" data-in="slideDown" data-out="slideUp" data-duration="750" data-delay="500">Ã™Æ’Ã™â€  Ã™â€šÃ™Ë†Ã™Å Ã˜Â§ Ã™â€¦Ã˜Â¹  <span>Fitme</span></h2>-->
        <!--                <p class="pogoSlider-slide-element slider-para" data-in="slideUp" data-out="slideUp" data-duration="1500" data-delay="500">Ã˜Â§Ã™â€žÃ™â€žÃ™Å Ã˜Â§Ã™â€šÃ˜Â© Ã˜Â§Ã™â€žÃ˜Â¨Ã˜Â¯Ã™â€ Ã™Å Ã˜Â© Ã˜Â¶Ã˜Â±Ã™Ë†Ã˜Â±Ã™Å Ã˜Â© Ã™â€žÃ™Æ’Ã™â€ž Ã˜Â¥Ã™â€ Ã˜Â³Ã˜Â§Ã™â€ </p>-->
        <!--                <button class="btn btn-default pogoSlider-slide-element join-btn" data-in="expand" data-out="slideUp" data-duration="1500" data-delay="500" type="submit">Ã˜Â§Ã™â€ Ã˜Â¶Ã™â€¦ Ã˜Â¥Ã™â€žÃ™Å Ã™â€ Ã˜Â§</button>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="pogoSlider-slide" data-transition="shrinkReveal" data-duration="1000" style="background-image:url(images/rtl-images/slider/3.jpg);">-->

        <!--            <div class="silder-elements">-->
        <!--                <h2 class="pogoSlider-slide-element slider-main-title" data-in="slideDown" data-out="slideUp" data-duration="750" data-delay="500">Ã™Æ’Ã™â€  Ã™â€šÃ™Ë†Ã™Å Ã˜Â§ Ã™â€¦Ã˜Â¹  <span>Fitme</span></h2>-->
        <!--                <p class="pogoSlider-slide-element slider-para" data-in="slideUp" data-out="slideUp" data-duration="1500" data-delay="500">Ã˜Â§Ã™â€žÃ™â€žÃ™Å Ã˜Â§Ã™â€šÃ˜Â© Ã˜Â§Ã™â€žÃ˜Â¨Ã˜Â¯Ã™â€ Ã™Å Ã˜Â© Ã˜Â¶Ã˜Â±Ã™Ë†Ã˜Â±Ã™Å Ã˜Â© Ã™â€žÃ™Æ’Ã™â€ž Ã˜Â¥Ã™â€ Ã˜Â³Ã˜Â§Ã™â€ </p>-->
        <!--                <button class="btn btn-default pogoSlider-slide-element join-btn" data-in="expand" data-out="slideUp" data-duration="1500" data-delay="500" type="submit">Ã˜Â§Ã™â€ Ã˜Â¶Ã™â€¦ Ã˜Â¥Ã™â€žÃ™Å Ã™â€ Ã˜Â§</button>-->
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
<!--                            <h3>Ã˜Â±Ã™ÂÃ˜Â¹ Ã˜Â§Ã™â€žÃ˜Â§Ã˜Â«Ã™â€šÃ˜Â§Ã™â€ž</h3>-->
<!--                            <p>Ã˜Â§Ã˜Â¬Ã˜Â¹Ã™â€ž Ã˜Â¬Ã˜Â³Ã™â€¦Ã™Æ’ Ã™â€žÃ˜Â§Ã˜Â¦Ã™â€šÃ™â€¹Ã˜Â§</p>-->
<!--                        </div>-->
<!--                        <div class="features-content">-->
<!--                            <p>Ã™â€¡Ã™â€ Ã˜Â§Ã™â€žÃ™Æ’ Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â§Ã™â€žÃ˜Â£Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¹ Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ™Ë†Ã™ÂÃ˜Â±Ã˜Â© Ã™â€žÃ™â€ Ã˜ÂµÃ™Ë†Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦Ã˜Å’ Ã™Ë†Ã™â€žÃ™Æ’Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂºÃ˜Â§Ã™â€žÃ˜Â¨Ã™Å Ã˜Â© Ã˜ÂªÃ™â€¦ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã™Å Ã™â€žÃ™â€¡Ã˜Â§ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž </p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4 col-md-6 animated bounceInUp slow delay-250">-->
<!--                <div class="features-col col-default-mb30">-->
<!--                    <div class="features-img">-->
<!--                        <img src="images/rtl-images/features/2.jpg" alt="">-->
<!--                        <div class="features-title">-->
<!--                            <h3>Ã˜ÂªÃ˜Â¯Ã˜Â±Ã™Å Ã˜Â¨ Ã˜Â§Ã™â€žÃ™Å Ã™Ë†Ã˜Â¬Ã˜Â§</h3>-->
<!--                            <p>Ã˜Â§Ã˜Â¬Ã˜Â¹Ã™â€ž Ã˜Â¬Ã˜Â³Ã™â€¦Ã™Æ’ Ã™â€žÃ˜Â§Ã˜Â¦Ã™â€šÃ™â€¹Ã˜Â§</p>-->
<!--                        </div>-->
<!--                        <div class="features-content">-->
<!--                            <p>Ã™â€¡Ã™â€ Ã˜Â§Ã™â€žÃ™Æ’ Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â§Ã™â€žÃ˜Â£Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¹ Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ™Ë†Ã™ÂÃ˜Â±Ã˜Â© Ã™â€žÃ™â€ Ã˜ÂµÃ™Ë†Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦Ã˜Å’ Ã™Ë†Ã™â€žÃ™Æ’Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂºÃ˜Â§Ã™â€žÃ˜Â¨Ã™Å Ã˜Â© Ã˜ÂªÃ™â€¦ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã™Å Ã™â€žÃ™â€¡Ã˜Â§ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž </p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4 col-md-6 animated bounceInUp slow delay-500">-->
<!--                <div class="features-col col-default-mb30">-->
<!--                    <div class="features-img">-->
<!--                        <img src="images/rtl-images/features/3.jpg" alt="">-->
<!--                        <div class="features-title">-->
<!--                            <h3>Ã˜ÂªÃ˜Â¯Ã˜Â±Ã™Å Ã˜Â¨ Ã™Æ’Ã˜Â±Ã™Ë†Ã˜Â³ Ã™ÂÃ™Å Ã˜Âª</h3>-->
<!--                            <p>Ã˜Â§Ã˜Â¬Ã˜Â¹Ã™â€ž Ã˜Â¬Ã˜Â³Ã™â€¦Ã™Æ’ Ã™â€žÃ˜Â§Ã˜Â¦Ã™â€šÃ™â€¹Ã˜Â§</p>-->
<!--                        </div>-->
<!--                        <div class="features-content">-->
<!--                            <p>Ã™â€¡Ã™â€ Ã˜Â§Ã™â€žÃ™Æ’ Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â§Ã™â€žÃ˜Â£Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¹ Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ™Ë†Ã™ÂÃ˜Â±Ã˜Â© Ã™â€žÃ™â€ Ã˜ÂµÃ™Ë†Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦Ã˜Å’ Ã™Ë†Ã™â€žÃ™Æ’Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂºÃ˜Â§Ã™â€žÃ˜Â¨Ã™Å Ã˜Â© Ã˜ÂªÃ™â€¦ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã™Å Ã™â€žÃ™â€¡Ã˜Â§ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž </p>-->
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
                    <h1> {{trans('front.welcome')}}  <span><?php echo $mainSettings['name']?></span></h1>
                    <!--                    <p>Ã˜Â­Ã˜Â§Ã™ÂÃ˜Â¸ Ã˜Â¹Ã™â€žÃ™â€° Ã˜Â¬Ã˜Â³Ã™â€¦Ã™Æ’ Ã™â€žÃ˜Â§Ã˜Â¦Ã™â€šÃ™â€¹Ã˜Â§ Ã™Ë†Ã™â€šÃ™Ë†Ã™Å Ã™â€¹Ã˜Â§</p>-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-box">
                    <div style="padding: 32px 10px 0 10px;"><?php echo $mainSettings['about']?></div>

                </div>


            </div>

        </div>
    </div>
</section>


@if(@$video_banner)
    <section class="banners mb-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 visible-pc" >
                    <div class="wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <div class="videoWrapper text-center">
                            <iframe width="90%" height="450" src="https://www.youtube.com/embed/{{$video_banner}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 visible-mobile" >
                    <div class="wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <div class="videoWrapper text-center">
                            <iframe width="90%" height="250" src="https://www.youtube.com/embed/{{$video_banner}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End banners-->
@endif

{{--<section id="gallery" class="about-sec clearfix">--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-lg-6">--}}
{{--                <div class="default-title text-center">--}}
{{--                    <h2>  <span>Ã˜Â§Ã™â€žÃ˜ÂµÃ™Ë†Ã˜Â±</span></h2>--}}
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
    <section id="subscriptions" class="pricing-table-sec jarallax over-layer-black">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="default-title text-center">
                        <h2> <span>{{trans('front.subscriptions')}}</span> </h2>
                        <div class="title-bdr">
                            <div class="title-bdr-inside"></div>
                        </div>
                        <!--                    <p>Ã™â€¡Ã™â€ Ã˜Â§Ã™â€žÃ™Æ’ Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â§Ã™â€žÃ˜Â£Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¹ Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ™Ë†Ã™ÂÃ˜Â±Ã˜Â© Ã™â€žÃ™â€ Ã˜ÂµÃ™Ë†Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦Ã˜Å’ Ã™Ë†Ã™â€žÃ™Æ’Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂºÃ˜Â§Ã™â€žÃ˜Â¨Ã™Å Ã˜Â© Ã˜ÂªÃ™â€¦ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã™Å Ã™â€žÃ™â€¡Ã˜Â§ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž Ã™â€¦Ã˜Â§ Ã˜Â¹Ã˜Â¨Ã˜Â± Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¨Ã˜Â¹Ã˜Â¶ Ã˜Â§Ã™â€žÃ™â€ Ã™Ë†Ã˜Â§Ã˜Â¯Ã˜Â± Ã˜Â£Ã™Ë† Ã˜Â§Ã™â€žÃ™Æ’Ã™â€žÃ™â€¦Ã˜Â§Ã˜Âª Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â´Ã™Ë†Ã˜Â§Ã˜Â¦Ã™Å Ã˜Â© Ã˜Â¥Ã™â€žÃ™â€° Ã˜Â§Ã™â€žÃ™â€ Ã˜Âµ.</p>-->
                    </div>
                </div>
            </div>
            <div class="row animatedParent animateOnce">
                @foreach($subscriptions as $subscription)
                    <div class="col-lg-3 col-md-6">
                        <div class="pricing-box col-default-mb30 animated bounceInUp slow">
                            <div class="pricing-header">
                                <h2>{{$subscription->name}}</h2>
                            </div>
                            <div class="pricing-content">
                                <ul>
                                    <li> {{trans('front.period')}}: {{$subscription->period}} {{trans('front.day')}} </li>
                                    <li> {{trans('front.session_num')}}: {{$subscription->workouts}}</li>
                                </ul>
                                <h3>{{$subscription->price}} {{trans('front.pound_unit')}} </h3>
                                <a class="btn btn-default sing-up-btn" style="border: 1px solid;" type="button" href="{{route('subscription', ['id' => $subscription->id])}}">{{trans('front.subscribe')}}</a>
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
<!--                    <h2>Ã™â€žÃ™â€ Ã˜Â§ <span>Ã˜Â§Ã™â€žÃ˜Â¯Ã™Ë†Ã˜Â±Ã˜Â§Ã˜Âª</span></h2>-->
<!--                    <div class="title-bdr">-->
<!--                        <div class="title-bdr-inside"></div>-->
<!--                    </div>-->
<!--                    <p>Ã™â€¡Ã™â€ Ã˜Â§Ã™â€žÃ™Æ’ Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â§Ã™â€žÃ˜Â£Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¹ Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ™Ë†Ã™ÂÃ˜Â±Ã˜Â© Ã™â€žÃ™â€ Ã˜ÂµÃ™Ë†Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦Ã˜Å’ Ã™Ë†Ã™â€žÃ™Æ’Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂºÃ˜Â§Ã™â€žÃ˜Â¨Ã™Å Ã˜Â© Ã˜ÂªÃ™â€¦ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã™Å Ã™â€žÃ™â€¡Ã˜Â§ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž Ã™â€¦Ã˜Â§ Ã˜Â¹Ã˜Â¨Ã˜Â± Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¨Ã˜Â¹Ã˜Â¶ Ã˜Â§Ã™â€žÃ™â€ Ã™Ë†Ã˜Â§Ã˜Â¯Ã˜Â± Ã˜Â£Ã™Ë† Ã˜Â§Ã™â€žÃ™Æ’Ã™â€žÃ™â€¦Ã˜Â§Ã˜Âª Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â´Ã™Ë†Ã˜Â§Ã˜Â¦Ã™Å Ã˜Â© Ã˜Â¥Ã™â€žÃ™â€° Ã˜Â§Ã™â€žÃ™â€ Ã˜Âµ. </p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row">-->
<!--            <div class="col-md-12">-->
<!--                <div class="courses-carousel-rtl" data-slick='{"slidesToShow": 3, "slidesToScroll": 1}'>-->
<!--                    <div class="item courses-item">-->
<!--                        <img src="images/rtl-images/courses/1.jpg" alt="">-->
<!--                        <div class="amount">-->
<!--                            <p>Ã˜Â±Ã˜Â³Ã™Ë†Ã™â€¦ Ã˜Â§Ã™â€žÃ˜Â¯Ã™Ë†Ã˜Â±Ã˜Â© 49 Ã˜Â¯Ã™Ë†Ã™â€žÃ˜Â§Ã˜Â±</p>-->
<!--                        </div>-->
<!--                        <div class="duration">-->
<!--                            <p>Ã™â€žÃ™â€¦Ã˜Â¯Ã˜Â© 3 Ã˜Â§Ã˜Â´Ã™â€¡Ã˜Â±</p>-->
<!--                        </div>-->
<!--                        <div class="courses-content">-->
<!--                            <h4>Ã™Å Ã™Ë†Ã˜Â¬Ã˜Â§ Ã™â€¦Ã˜Â«Ã˜Â§Ã™â€žÃ™Å Ã˜Â©</h4>-->
<!--                            <p>Ã™â€¡Ã™â€ Ã˜Â§Ã™â€žÃ™Æ’ Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â§Ã™â€žÃ˜Â£Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¹ Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ™Ë†Ã™ÂÃ˜Â±Ã˜Â© Ã™â€žÃ™â€ Ã˜ÂµÃ™Ë†Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦Ã˜Å’ Ã™Ë†Ã™â€žÃ™Æ’Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂºÃ˜Â§Ã™â€žÃ˜Â¨Ã™Å Ã˜Â© Ã˜ÂªÃ™â€¦ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã™Å Ã™â€žÃ™â€¡Ã˜Â§ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž Ã™â€¦Ã˜Â§ Ã˜Â¹Ã˜Â¨Ã˜Â± Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¨Ã˜Â¹Ã˜Â¶ Ã˜Â§Ã™â€žÃ™â€ Ã™Ë†Ã˜Â§Ã˜Â¯Ã˜Â± Ã˜Â£Ã™Ë† Ã˜Â§Ã™â€žÃ™Æ’Ã™â€žÃ™â€¦Ã˜Â§Ã˜Âª Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â´Ã™Ë†Ã˜Â§Ã˜Â¦Ã™Å Ã˜Â© Ã˜Â¥Ã™â€žÃ™â€° Ã˜Â§Ã™â€žÃ™â€ Ã˜Âµ. Ã˜Â¥Ã™â€  Ã™Æ’Ã™â€ Ã˜Âª Ã˜ÂªÃ˜Â±Ã™Å Ã˜Â¯ Ã˜Â£Ã™â€  Ã˜ÂªÃ˜Â³Ã˜ÂªÃ˜Â®Ã˜Â¯Ã™â€¦ Ã™â€ Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦ Ã™â€¦Ã˜Â§Ã˜Å’ Ã˜Â¹Ã™â€žÃ™Å Ã™Æ’</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="item courses-item">-->
<!--                        <img src="images/rtl-images/courses/2.jpg" alt="">-->
<!--                        <div class="amount">-->
<!--                            <p>Ã˜Â±Ã˜Â³Ã™Ë†Ã™â€¦ Ã˜Â§Ã™â€žÃ˜Â¯Ã™Ë†Ã˜Â±Ã˜Â© 49 Ã˜Â¯Ã™Ë†Ã™â€žÃ˜Â§Ã˜Â±</p>-->
<!--                        </div>-->
<!--                        <div class="duration">-->
<!--                            <p>Ã™â€žÃ™â€¦Ã˜Â¯Ã˜Â© 3 Ã˜Â§Ã˜Â´Ã™â€¡Ã˜Â±</p>-->
<!--                        </div>-->
<!--                        <div class="courses-content">-->
<!--                            <h4>Ã™â€¦Ã™â€¦Ã˜Â§Ã˜Â±Ã˜Â³Ã˜Â© Ã˜Â§Ã™â€žÃ˜Â¬Ã˜Â±Ã™Å </h4>-->
<!--                            <p>Ã™â€¡Ã™â€ Ã˜Â§Ã™â€žÃ™Æ’ Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â§Ã™â€žÃ˜Â£Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¹ Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ™Ë†Ã™ÂÃ˜Â±Ã˜Â© Ã™â€žÃ™â€ Ã˜ÂµÃ™Ë†Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦Ã˜Å’ Ã™Ë†Ã™â€žÃ™Æ’Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂºÃ˜Â§Ã™â€žÃ˜Â¨Ã™Å Ã˜Â© Ã˜ÂªÃ™â€¦ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã™Å Ã™â€žÃ™â€¡Ã˜Â§ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž Ã™â€¦Ã˜Â§ Ã˜Â¹Ã˜Â¨Ã˜Â± Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¨Ã˜Â¹Ã˜Â¶ Ã˜Â§Ã™â€žÃ™â€ Ã™Ë†Ã˜Â§Ã˜Â¯Ã˜Â± Ã˜Â£Ã™Ë† Ã˜Â§Ã™â€žÃ™Æ’Ã™â€žÃ™â€¦Ã˜Â§Ã˜Âª Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â´Ã™Ë†Ã˜Â§Ã˜Â¦Ã™Å Ã˜Â© Ã˜Â¥Ã™â€žÃ™â€° Ã˜Â§Ã™â€žÃ™â€ Ã˜Âµ. Ã˜Â¥Ã™â€  Ã™Æ’Ã™â€ Ã˜Âª Ã˜ÂªÃ˜Â±Ã™Å Ã˜Â¯ Ã˜Â£Ã™â€  Ã˜ÂªÃ˜Â³Ã˜ÂªÃ˜Â®Ã˜Â¯Ã™â€¦ Ã™â€ Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦ Ã™â€¦Ã˜Â§Ã˜Å’ Ã˜Â¹Ã™â€žÃ™Å Ã™Æ’</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="item courses-item">-->
<!--                        <img src="images/rtl-images/courses/3.jpg" alt="">-->
<!--                        <div class="amount">-->
<!--                            <p>Ã˜Â±Ã˜Â³Ã™Ë†Ã™â€¦ Ã˜Â§Ã™â€žÃ˜Â¯Ã™Ë†Ã˜Â±Ã˜Â© 49 Ã˜Â¯Ã™Ë†Ã™â€žÃ˜Â§Ã˜Â±</p>-->
<!--                        </div>-->
<!--                        <div class="duration">-->
<!--                            <p>Ã™â€žÃ™â€¦Ã˜Â¯Ã˜Â© 3 Ã˜Â§Ã˜Â´Ã™â€¡Ã˜Â±</p>-->
<!--                        </div>-->
<!--                        <div class="courses-content">-->
<!--                            <h4>Ã™â€¦Ã™â€¦Ã˜Â§Ã˜Â±Ã˜Â³Ã˜Â© Ã˜Â§Ã™â€žÃ˜Â²Ã™Ë†Ã™â€¦Ã˜Â¨Ã˜Â§</h4>-->
<!--                            <p>Ã™â€¡Ã™â€ Ã˜Â§Ã™â€žÃ™Æ’ Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â§Ã™â€žÃ˜Â£Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¹ Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ™Ë†Ã™ÂÃ˜Â±Ã˜Â© Ã™â€žÃ™â€ Ã˜ÂµÃ™Ë†Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦Ã˜Å’ Ã™Ë†Ã™â€žÃ™Æ’Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂºÃ˜Â§Ã™â€žÃ˜Â¨Ã™Å Ã˜Â© Ã˜ÂªÃ™â€¦ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã™Å Ã™â€žÃ™â€¡Ã˜Â§ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž Ã™â€¦Ã˜Â§ Ã˜Â¹Ã˜Â¨Ã˜Â± Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¨Ã˜Â¹Ã˜Â¶ Ã˜Â§Ã™â€žÃ™â€ Ã™Ë†Ã˜Â§Ã˜Â¯Ã˜Â± Ã˜Â£Ã™Ë† Ã˜Â§Ã™â€žÃ™Æ’Ã™â€žÃ™â€¦Ã˜Â§Ã˜Âª Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â´Ã™Ë†Ã˜Â§Ã˜Â¦Ã™Å Ã˜Â© Ã˜Â¥Ã™â€žÃ™â€° Ã˜Â§Ã™â€žÃ™â€ Ã˜Âµ. Ã˜Â¥Ã™â€  Ã™Æ’Ã™â€ Ã˜Âª Ã˜ÂªÃ˜Â±Ã™Å Ã˜Â¯ Ã˜Â£Ã™â€  Ã˜ÂªÃ˜Â³Ã˜ÂªÃ˜Â®Ã˜Â¯Ã™â€¦ Ã™â€ Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦ Ã™â€¦Ã˜Â§Ã˜Å’ Ã˜Â¹Ã™â€žÃ™Å Ã™Æ’</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="item courses-item">-->
<!--                        <img src="images/rtl-images/courses/4.jpg" alt="">-->
<!--                        <div class="amount">-->
<!--                            <p>Ã˜Â±Ã˜Â³Ã™Ë†Ã™â€¦ Ã˜Â§Ã™â€žÃ˜Â¯Ã™Ë†Ã˜Â±Ã˜Â© 49 Ã˜Â¯Ã™Ë†Ã™â€žÃ˜Â§Ã˜Â±</p>-->
<!--                        </div>-->
<!--                        <div class="duration">-->
<!--                            <p>Ã™â€žÃ™â€¦Ã˜Â¯Ã˜Â© 3 Ã˜Â§Ã˜Â´Ã™â€¡Ã˜Â±</p>-->
<!--                        </div>-->
<!--                        <div class="courses-content">-->
<!--                            <h4>Ã˜ÂªÃ˜Â¯Ã˜Â±Ã™Å Ã˜Â¨ Ã˜Â§Ã™â€žÃ™â€žÃ™Å Ã˜Â§Ã™â€šÃ˜Â© Ã˜Â§Ã™â€žÃ˜Â¨Ã˜Â¯Ã™â€ Ã™Å Ã˜Â©</h4>-->
<!--                            <p>Ã™â€¡Ã™â€ Ã˜Â§Ã™â€žÃ™Æ’ Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â§Ã™â€žÃ˜Â£Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¹ Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ™Ë†Ã™ÂÃ˜Â±Ã˜Â© Ã™â€žÃ™â€ Ã˜ÂµÃ™Ë†Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦Ã˜Å’ Ã™Ë†Ã™â€žÃ™Æ’Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂºÃ˜Â§Ã™â€žÃ˜Â¨Ã™Å Ã˜Â© Ã˜ÂªÃ™â€¦ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã™Å Ã™â€žÃ™â€¡Ã˜Â§ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž Ã™â€¦Ã˜Â§ Ã˜Â¹Ã˜Â¨Ã˜Â± Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¨Ã˜Â¹Ã˜Â¶ Ã˜Â§Ã™â€žÃ™â€ Ã™Ë†Ã˜Â§Ã˜Â¯Ã˜Â± Ã˜Â£Ã™Ë† Ã˜Â§Ã™â€žÃ™Æ’Ã™â€žÃ™â€¦Ã˜Â§Ã˜Âª Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â´Ã™Ë†Ã˜Â§Ã˜Â¦Ã™Å Ã˜Â© Ã˜Â¥Ã™â€žÃ™â€° Ã˜Â§Ã™â€žÃ™â€ Ã˜Âµ. Ã˜Â¥Ã™â€  Ã™Æ’Ã™â€ Ã˜Âª Ã˜ÂªÃ˜Â±Ã™Å Ã˜Â¯ Ã˜Â£Ã™â€  Ã˜ÂªÃ˜Â³Ã˜ÂªÃ˜Â®Ã˜Â¯Ã™â€¦ Ã™â€ Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦ Ã™â€¦Ã˜Â§Ã˜Å’ Ã˜Â¹Ã™â€žÃ™Å Ã™Æ’</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="item courses-item">-->
<!--                        <img src="images/rtl-images/courses/5.jpg" alt="">-->
<!--                        <div class="amount">-->
<!--                            <p>Ã˜Â±Ã˜Â³Ã™Ë†Ã™â€¦ Ã˜Â§Ã™â€žÃ˜Â¯Ã™Ë†Ã˜Â±Ã˜Â© 49 Ã˜Â¯Ã™Ë†Ã™â€žÃ˜Â§Ã˜Â±</p>-->
<!--                        </div>-->
<!--                        <div class="duration">-->
<!--                            <p>Ã™â€žÃ™â€¦Ã˜Â¯Ã˜Â© 3 Ã˜Â§Ã˜Â´Ã™â€¡Ã˜Â±</p>-->
<!--                        </div>-->
<!--                        <div class="courses-content">-->
<!--                            <h4>Ã˜Â±Ã™ÂÃ˜Â¹ Ã˜Â§Ã™â€žÃ˜Â§Ã˜Â«Ã™â€šÃ˜Â§Ã™â€ž</h4>-->
<!--                            <p>Ã™â€¡Ã™â€ Ã˜Â§Ã™â€žÃ™Æ’ Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â§Ã™â€žÃ˜Â£Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¹ Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ™Ë†Ã™ÂÃ˜Â±Ã˜Â© Ã™â€žÃ™â€ Ã˜ÂµÃ™Ë†Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦Ã˜Å’ Ã™Ë†Ã™â€žÃ™Æ’Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂºÃ˜Â§Ã™â€žÃ˜Â¨Ã™Å Ã˜Â© Ã˜ÂªÃ™â€¦ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã™Å Ã™â€žÃ™â€¡Ã˜Â§ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž Ã™â€¦Ã˜Â§ Ã˜Â¹Ã˜Â¨Ã˜Â± Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¨Ã˜Â¹Ã˜Â¶ Ã˜Â§Ã™â€žÃ™â€ Ã™Ë†Ã˜Â§Ã˜Â¯Ã˜Â± Ã˜Â£Ã™Ë† Ã˜Â§Ã™â€žÃ™Æ’Ã™â€žÃ™â€¦Ã˜Â§Ã˜Âª Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â´Ã™Ë†Ã˜Â§Ã˜Â¦Ã™Å Ã˜Â© Ã˜Â¥Ã™â€žÃ™â€° Ã˜Â§Ã™â€žÃ™â€ Ã˜Âµ. Ã˜Â¥Ã™â€  Ã™Æ’Ã™â€ Ã˜Âª Ã˜ÂªÃ˜Â±Ã™Å Ã˜Â¯ Ã˜Â£Ã™â€  Ã˜ÂªÃ˜Â³Ã˜ÂªÃ˜Â®Ã˜Â¯Ã™â€¦ Ã™â€ Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦ Ã™â€¦Ã˜Â§Ã˜Å’ Ã˜Â¹Ã™â€žÃ™Å Ã™Æ’</p>-->
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
{{--                    <!--                    <p>Ã™â€¡Ã™â€ Ã˜Â§Ã™â€žÃ™Æ’ Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â§Ã™â€žÃ˜Â£Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¹ Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ™Ë†Ã™ÂÃ˜Â±Ã˜Â© Ã™â€žÃ™â€ Ã˜ÂµÃ™Ë†Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦Ã˜Å’ Ã™Ë†Ã™â€žÃ™Æ’Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂºÃ˜Â§Ã™â€žÃ˜Â¨Ã™Å Ã˜Â© Ã˜ÂªÃ™â€¦ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã™Å Ã™â€žÃ™â€¡Ã˜Â§ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž Ã™â€¦Ã˜Â§ Ã˜Â¹Ã˜Â¨Ã˜Â± Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¨Ã˜Â¹Ã˜Â¶ Ã˜Â§Ã™â€žÃ™â€ Ã™Ë†Ã˜Â§Ã˜Â¯Ã˜Â± Ã˜Â£Ã™Ë† Ã˜Â§Ã™â€žÃ™Æ’Ã™â€žÃ™â€¦Ã˜Â§Ã˜Âª Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â´Ã™Ë†Ã˜Â§Ã˜Â¦Ã™Å Ã˜Â© Ã˜Â¥Ã™â€žÃ™â€° Ã˜Â§Ã™â€žÃ™â€ Ã˜Âµ.</p>-->--}}
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
{{--                        <!--                                <h2>Ã˜Â®Ã™â€¦Ã˜Â³Ã˜Â©</h2>-->--}}
{{--                        <!--                                <table class="table text-center">-->--}}
{{--                        <!--                                    <thead>-->--}}
{{--                        <!--                                    <tr>-->--}}
{{--                        <!--                                        <th>Ã˜Â§Ã™â€žÃ˜Â£Ã˜Â­Ã˜Â¯Ã˜Â§Ã˜Â«</th>-->--}}
{{--                        <!--                                        <th>Ã™â€¦Ã˜Â¯Ã˜Â±Ã˜Â¨</th>-->--}}
{{--                        <!--                                        <th>Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ˜Â¯Ã˜Â±Ã˜Â¨</th>-->--}}
{{--                        <!--                                        <th>Ã˜Â²Ã™â€¦Ã™â€ </th>-->--}}
{{--                        <!--                                    </tr>-->--}}
{{--                        <!--                                    </thead>-->--}}
{{--                        <!--                                    <tbody>-->--}}
{{--                        <!--                                    <tr>-->--}}
{{--                        <!--                                        <td>Ã™Å Ã™Ë†Ã˜Â¬Ã˜Â§</td>-->--}}
{{--                        <!--                                        <td>Ã˜Â±Ã™Ë†Ã˜Â¨Ã˜Â§Ã˜Â±Ã˜Âª Ã˜Â¬Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€ </td>-->--}}
{{--                        <!--                                        <td>Ã˜Â¹Ã˜Â´Ã˜Â±Ã™Ë†Ã™â€ </td>-->--}}
{{--                        <!--                                        <td>11:00 - 01:00 Ã™â€¦Ã˜Â³Ã˜Â§Ã˜Â¡Ã™â€¹</td>-->--}}
{{--                        <!--                                    </tr>-->--}}
{{--                        <!--                                    <tr>-->--}}
{{--                        <!--                                        <td>Ã˜Â¨Ã˜Â±Ã™â€ Ã˜Â§Ã™â€¦Ã˜Â¬ Ã™â€žÃ™Å Ã˜Â§Ã™â€šÃ˜Â© Ã˜Â¹Ã˜Â§Ã™â€žÃ™Å  Ã˜Â§Ã™â€žÃ™Æ’Ã˜Â«Ã˜Â§Ã™ÂÃ˜Â©</td>-->--}}
{{--                        <!--                                        <td>Ã™â€¦Ã˜Â§Ã™Æ’ Ã™â€¦Ã™Å Ã™â€žÃ˜Â§Ã™â€ </td>-->--}}
{{--                        <!--                                        <td>Ã˜Â«Ã™â€žÃ˜Â§Ã˜Â«Ã™Ë†Ã™â€ </td>-->--}}
{{--                        <!--                                        <td>01:00 - 03:00 Ã™â€¦Ã˜Â³Ã˜Â§Ã˜Â¡Ã™â€¹</td>-->--}}
{{--                        <!--                                    </tr>-->--}}
{{--                        <!--                                    <tr>-->--}}
{{--                        <!--                                        <td>Ã˜Â±Ã™Æ’Ã™Ë†Ã˜Â¨ Ã˜Â§Ã™â€žÃ˜Â¯Ã˜Â±Ã˜Â§Ã˜Â¬Ã˜Â§Ã˜Âª</td>-->--}}
{{--                        <!--                                        <td>Ã˜Â¬Ã™Ë†Ã™â€  Ã™â€¦Ã™Ë†Ã˜Â¬Ã™Å Ã™â€ Ã˜Â§</td>-->--}}
{{--                        <!--                                        <td>Ã˜Â®Ã™â€¦Ã˜Â³Ã˜Â© Ã™Ë† Ã˜Â¹Ã˜Â´Ã˜Â±Ã™Ë†Ã™â€ </td>-->--}}
{{--                        <!--                                        <td>03:00 - 05:00 Ã™â€¦Ã˜Â³Ã˜Â§Ã˜Â¡Ã™â€¹</td>-->--}}
{{--                        <!--                                    </tr>-->--}}
{{--                        <!--                                    <tr>-->--}}
{{--                        <!--                                        <td>Ã˜Â§Ã™â€žÃ™Æ’Ã™Å Ã™Æ’ Ã˜Â¨Ã™Ë†Ã™Æ’Ã˜Â³Ã™Å Ã™â€ Ã˜Âº</td>-->--}}
{{--                        <!--                                        <td>Ã˜Â¬Ã™Ë†Ã™â€žÃ™Å Ã™Ë† Ã™â€žÃ™Å </td>-->--}}
{{--                        <!--                                        <td>Ã˜Â¹Ã˜Â´Ã˜Â±Ã™Ë†Ã™â€ </td>-->--}}
{{--                        <!--                                        <td>05:00 - 07:00 Ã™â€¦Ã˜Â³Ã˜Â§Ã˜Â¡Ã™â€¹</td>-->--}}
{{--                        <!--                                    </tr>-->--}}
{{--                        <!--                                    <tr>-->--}}
{{--                        <!--                                        <td>Ã˜Â²Ã™Ë†Ã™â€¦Ã˜Â¨Ã˜Â§</td>-->--}}
{{--                        <!--                                        <td>Ã˜ÂªÃ™Ë†Ã™â€¦Ã˜Â§Ã˜Â³ Ã™â€¦Ã˜Â§Ã˜Â±Ã™Æ’Ã˜Â³</td>-->--}}
{{--                        <!--                                        <td>Ã˜Â«Ã™â€žÃ˜Â§Ã˜Â«Ã™Ë†Ã™â€ </td>-->--}}
{{--                        <!--                                        <td>07:00 - 09:00 Ã™â€¦Ã˜Â³Ã˜Â§Ã˜Â¡Ã™â€¹</td>-->--}}
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
<!--                    <h2>  <span>Ã™â€¦Ã˜Â¯Ã˜Â±Ã˜Â¨Ã™Å Ã™â€ Ã˜Â§</span></h2>-->
<!--                    <div class="title-bdr">-->
<!--                        <div class="title-bdr-inside"></div>-->
<!--                    </div>-->
<!--                    <p>Ã™â€žÃ˜Â¯Ã™Å Ã™â€ Ã˜Â§ Ã˜Â§Ã™ÂÃ˜Â¶Ã™â€ž Ã˜Â§Ã™â€žÃ™â€¦Ã˜Â¯Ã˜Â±Ã˜Â¨Ã™Å Ã™â€  Ã™Ë†Ã˜Â§Ã™â€¦Ã™â€¡Ã˜Â±Ã™â€¡Ã™â€¦ Ã˜Â¹Ã™â€žÃ™Å  Ã˜Â§Ã™â€žÃ˜Â§Ã˜Â·Ã™â€žÃ˜Â§Ã™â€š</p>-->
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
<!--                            <h4>Ã˜Â¬Ã™Ë†Ã™â€  Ã™â€ Ã™Å Ã™â€žÃ˜Â³Ã™Ë†Ã™â€ </h4>-->
<!--                            <p>Ã™â€¦Ã™â€ Ã˜Â´Ã˜Â¦ Ã˜Â§Ã™â€žÃ˜Â¬Ã˜Â³Ã™â€¦</p>-->
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
<!--                            <h4>Ã™Æ’Ã˜Â±Ã™Å Ã˜Â³Ã˜ÂªÃ™Å Ã™â€ Ã˜Â§ Ã™â€žÃ™Å Ã™Ë†</h4>-->
<!--                            <p>Ã™â€¦Ã˜Â¯Ã˜Â±Ã˜Â¨ Ã™Å Ã™Ë†Ã˜Â¬Ã˜Â§</p>-->
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
<!--                            <h4>Ã˜Â¬Ã™Ë†Ã™â€žÃ™Å Ã™Ë† Ã™â€ Ã™Å Ã™â€žÃ˜Â³Ã™Ë†Ã™â€ </h4>-->
<!--                            <p>Ã™â€¦Ã˜Â¯Ã˜Â±Ã˜Â¨ Ã™â€žÃ™Å Ã˜Â§Ã™â€šÃ˜Â©</p>-->
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
<!--                            <h4>Ã˜Â£Ã™â€žÃ™Å Ã˜Â³Ã˜ÂªÃ˜Â± Ã˜Â¬Ã™Å Ã™Æ’Ã˜Â³Ã™Ë†Ã™â€ </h4>-->
<!--                            <p>Ã˜Â±Ã™ÂÃ˜Â¹ Ã˜Â§Ã™â€žÃ˜Â§Ã˜Â«Ã™â€šÃ˜Â§Ã™â€ž</p>-->
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
<!--                            <h4>Ã™â€ Ã™Å Ã™Æ’Ã™Ë†Ã™â€žÃ˜Â§Ã˜Â³ Ã˜Â³Ã™Å Ã™â€ Ã˜Â³</h4>-->
<!--                            <p>Ã™â€¦Ã˜Â¯Ã˜Â±Ã˜Â¨ Ã˜Â§Ã™â€žÃ˜Â¬Ã˜Â±Ã™Å </p>-->
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
<!-- Counter Section -->

@if(isset($activities) && (count($activities) > 0))
<section class="schedule-sec  jarallax over-layer-black">
    <div class="container">
        <div class="row">
            @foreach($activities as $activity)
            <div class="col-lg-3 col-sm-6">
                <div class="counter-col col-default-mb30 text-center">
                    <h5 class=""><i class="fa fa-list"></i></h5>
                    <div class="counter-bdr"></div>
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
{{--                    <span style="font-size: 13px;color: #E4007C;">Exective Director& Cakorinas Founder</span>--}}
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
{{--                    <span style="font-size: 13px;color: #E4007C;">Ballet Consultant</span>--}}
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
{{--                    <!--                    <p>Ã™â€¡Ã™â€ Ã˜Â§Ã™â€žÃ™Æ’ Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â§Ã™â€žÃ˜Â£Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¹ Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ™Ë†Ã™ÂÃ˜Â±Ã˜Â© Ã™â€žÃ™â€ Ã˜ÂµÃ™Ë†Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦Ã˜Å’ Ã™Ë†Ã™â€žÃ™Æ’Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂºÃ˜Â§Ã™â€žÃ˜Â¨Ã™Å Ã˜Â© Ã˜ÂªÃ™â€¦ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã™Å Ã™â€žÃ™â€¡Ã˜Â§ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž Ã™â€¦Ã˜Â§ Ã˜Â¹Ã˜Â¨Ã˜Â± Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¨Ã˜Â¹Ã˜Â¶ Ã˜Â§Ã™â€žÃ™â€ Ã™Ë†Ã˜Â§Ã˜Â¯Ã˜Â± Ã˜Â£Ã™Ë† Ã˜Â§Ã™â€žÃ™Æ’Ã™â€žÃ™â€¦Ã˜Â§Ã˜Âª Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â´Ã™Ë†Ã˜Â§Ã˜Â¦Ã™Å Ã˜Â© Ã˜Â¥Ã™â€žÃ™â€° Ã˜Â§Ã™â€žÃ™â€ Ã˜Âµ.</p>-->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-lg-8">--}}
{{--                <div class="<?php if($lang=='ar'){?>testimonial-carousel-rtl<?php }else{ ?>testimonial-carousel<?php } ?>" data-slick='{"slidesToShow": 1, "slidesToScroll": 1}'>--}}

{{--                    <div class="testimonial-item">--}}
{{--                        <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/images/logo.png')}}" alt="">--}}
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
{{--                        <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/images/logo.png')}}" alt="">--}}
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
{{--                        <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/images/logo.png')}}" alt="">--}}
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
<!--                    <h2>Ã™â€žÃ™â€ Ã˜Â§ <span>Ã™â€¦Ã™â€šÃ˜Â§Ã™â€žÃ˜Â§Ã˜Âª</span></h2>-->
<!--                    <div class="title-bdr">-->
<!--                        <div class="title-bdr-inside"></div>-->
<!--                    </div>-->
<!--                    <p>Ã™â€¡Ã™â€ Ã˜Â§Ã™â€žÃ™Æ’ Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â§Ã™â€žÃ˜Â£Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¹ Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ™Ë†Ã™ÂÃ˜Â±Ã˜Â© Ã™â€žÃ™â€ Ã˜ÂµÃ™Ë†Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦Ã˜Å’ Ã™Ë†Ã™â€žÃ™Æ’Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂºÃ˜Â§Ã™â€žÃ˜Â¨Ã™Å Ã˜Â© Ã˜ÂªÃ™â€¦ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã™Å Ã™â€žÃ™â€¡Ã˜Â§ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž Ã™â€¦Ã˜Â§ Ã˜Â¹Ã˜Â¨Ã˜Â± Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¨Ã˜Â¹Ã˜Â¶ Ã˜Â§Ã™â€žÃ™â€ Ã™Ë†Ã˜Â§Ã˜Â¯Ã˜Â± Ã˜Â£Ã™Ë† Ã˜Â§Ã™â€žÃ™Æ’Ã™â€žÃ™â€¦Ã˜Â§Ã˜Âª Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â´Ã™Ë†Ã˜Â§Ã˜Â¦Ã™Å Ã˜Â© Ã˜Â¥Ã™â€žÃ™â€° Ã˜Â§Ã™â€žÃ™â€ Ã˜Âµ.</p>-->
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
<!--                                <li><i class="icofont icofont-businessman"></i><a href="#">Ã™â€¦Ã˜Â§Ã˜Â±Ã™Æ’ Ã˜Â¬Ã™Ë†Ã™â€ Ã˜Â³Ã™Ë†Ã™â€ </a>-->
<!--                                </li>-->
<!--                                <li><i class="icofont icofont-calendar"></i><a href="#">20 Ã˜Â¯Ã™Å Ã˜Â³Ã™â€¦Ã˜Â¨Ã˜Â±, 2021</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="blog-content">-->
<!--                        <h4><a href="blog-single.html">Ã™â€¡Ã˜Â°Ã˜Â§ Ã™â€¡Ã™Ë† Ã˜Â¹Ã™â€ Ã™Ë†Ã˜Â§Ã™â€  Ã˜Â§Ã™â€žÃ™â€¦Ã˜Â¯Ã™Ë†Ã™â€ Ã˜Â©</a></h4>-->
<!--                        <p>Ã™â€¡Ã™â€ Ã˜Â§Ã™â€žÃ™Æ’ Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â§Ã™â€žÃ˜Â£Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¹ Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ™Ë†Ã™ÂÃ˜Â±Ã˜Â© Ã™â€žÃ™â€ Ã˜ÂµÃ™Ë†Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦Ã˜Å’ Ã™Ë†Ã™â€žÃ™Æ’Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂºÃ˜Â§Ã™â€žÃ˜Â¨Ã™Å Ã˜Â© Ã˜ÂªÃ™â€¦ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã™Å Ã™â€žÃ™â€¡Ã˜Â§ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž Ã™â€¦Ã˜Â§ Ã˜Â¹Ã˜Â¨Ã˜Â± Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¨Ã˜Â¹Ã˜Â¶ Ã˜Â§Ã™â€žÃ™â€ Ã™Ë†Ã˜Â§Ã˜Â¯Ã˜Â± Ã˜Â£Ã™Ë† Ã˜Â§Ã™â€žÃ™Æ’Ã™â€žÃ™â€¦Ã˜Â§Ã˜Âª Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â´Ã™Ë†Ã˜Â§Ã˜Â¦Ã™Å Ã˜Â© Ã˜Â¥Ã™â€žÃ™â€° Ã˜Â§Ã™â€žÃ™â€ Ã˜Âµ. </p>-->
<!--                        <a class="btn btn-primary simple-btn" href="blog-single.html" role="button">Ã˜Â§Ã™â€šÃ˜Â±Ã˜Â£ Ã˜Â£Ã™Æ’Ã˜Â«Ã˜Â±</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4 col-md-6 animated bounceInUp slow delay-250">-->
<!--                <div class="blog-box col-default-mb30 animated fadeInUpShort slow delay-250">-->
<!--                    <div class="blog-img">-->
<!--                        <img src="images/rtl-images/blog/2.jpg" alt="">-->
<!--                        <div class="blog-date">-->
<!--                            <ul>-->
<!--                                <li><i class="icofont icofont-businessman"></i><a href="#">Ã˜ÂªÃ™Ë†Ã™â€¦Ã˜Â§Ã˜Â³ Ã˜Â±Ã™Ë†Ã™Å </a>-->
<!--                                </li>-->
<!--                                <li><i class="icofont icofont-calendar"></i><a href="#">21 Ã˜Â¯Ã™Å Ã˜Â³Ã™â€¦Ã˜Â¨Ã˜Â±, 2021</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="blog-content">-->
<!--                        <h4><a href="blog-single.html">Ã™â€¡Ã˜Â°Ã˜Â§ Ã™â€¡Ã™Ë† Ã˜Â¹Ã™â€ Ã™Ë†Ã˜Â§Ã™â€  Ã˜Â§Ã™â€žÃ™â€¦Ã˜Â¯Ã™Ë†Ã™â€ Ã˜Â©</a></h4>-->
<!--                        <p>Ã™â€¡Ã™â€ Ã˜Â§Ã™â€žÃ™Æ’ Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â§Ã™â€žÃ˜Â£Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¹ Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ™Ë†Ã™ÂÃ˜Â±Ã˜Â© Ã™â€žÃ™â€ Ã˜ÂµÃ™Ë†Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦Ã˜Å’ Ã™Ë†Ã™â€žÃ™Æ’Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂºÃ˜Â§Ã™â€žÃ˜Â¨Ã™Å Ã˜Â© Ã˜ÂªÃ™â€¦ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã™Å Ã™â€žÃ™â€¡Ã˜Â§ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž Ã™â€¦Ã˜Â§ Ã˜Â¹Ã˜Â¨Ã˜Â± Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¨Ã˜Â¹Ã˜Â¶ Ã˜Â§Ã™â€žÃ™â€ Ã™Ë†Ã˜Â§Ã˜Â¯Ã˜Â± Ã˜Â£Ã™Ë† Ã˜Â§Ã™â€žÃ™Æ’Ã™â€žÃ™â€¦Ã˜Â§Ã˜Âª Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â´Ã™Ë†Ã˜Â§Ã˜Â¦Ã™Å Ã˜Â© Ã˜Â¥Ã™â€žÃ™â€° Ã˜Â§Ã™â€žÃ™â€ Ã˜Âµ. </p>-->
<!--                        <a class="btn btn-primary simple-btn" href="blog-single.html" role="button">Ã˜Â§Ã™â€šÃ˜Â±Ã˜Â£ Ã˜Â£Ã™Æ’Ã˜Â«Ã˜Â±</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4 col-md-6 animated bounceInUp slow delay-500">-->
<!--                <div class="blog-box col-default-mb30 animated fadeInUpShort slow delay-500">-->
<!--                    <div class="blog-img">-->
<!--                        <img src="images/rtl-images/blog/3.jpg" alt="">-->
<!--                        <div class="blog-date">-->
<!--                            <ul>-->
<!--                                <li><i class="icofont icofont-businessman"></i><a href="#">Ã™â€ Ã™Å Ã™â€žÃ˜Â³Ã™Ë†Ã™â€  Ã™â€¦Ã™Ë†Ã™â€ Ã™Å Ã™Æ’Ã˜Â§</a>-->
<!--                                </li>-->
<!--                                <li><i class="icofont icofont-calendar"></i><a href="#">22  Ã˜Â¯Ã™Å Ã˜Â³Ã™â€¦Ã˜Â¨Ã˜Â±, 2021</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="blog-content">-->
<!--                        <h4><a href="blog-single.html">Ã™â€¡Ã˜Â°Ã˜Â§ Ã™â€¡Ã™Ë† Ã˜Â¹Ã™â€ Ã™Ë†Ã˜Â§Ã™â€  Ã˜Â§Ã™â€žÃ™â€¦Ã˜Â¯Ã™Ë†Ã™â€ Ã˜Â©</a></h4>-->
<!--                        <p>Ã™â€¡Ã™â€ Ã˜Â§Ã™â€žÃ™Æ’ Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â§Ã™â€žÃ˜Â£Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¹ Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ™Ë†Ã™ÂÃ˜Â±Ã˜Â© Ã™â€žÃ™â€ Ã˜ÂµÃ™Ë†Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦Ã˜Å’ Ã™Ë†Ã™â€žÃ™Æ’Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂºÃ˜Â§Ã™â€žÃ˜Â¨Ã™Å Ã˜Â© Ã˜ÂªÃ™â€¦ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã™Å Ã™â€žÃ™â€¡Ã˜Â§ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž Ã™â€¦Ã˜Â§ Ã˜Â¹Ã˜Â¨Ã˜Â± Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¨Ã˜Â¹Ã˜Â¶ Ã˜Â§Ã™â€žÃ™â€ Ã™Ë†Ã˜Â§Ã˜Â¯Ã˜Â± Ã˜Â£Ã™Ë† Ã˜Â§Ã™â€žÃ™Æ’Ã™â€žÃ™â€¦Ã˜Â§Ã˜Âª Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â´Ã™Ë†Ã˜Â§Ã˜Â¦Ã™Å Ã˜Â© Ã˜Â¥Ã™â€žÃ™â€° Ã˜Â§Ã™â€žÃ™â€ Ã˜Âµ. </p>-->
<!--                        <a class="btn btn-primary simple-btn" href="blog-single.html" role="button">Ã˜Â§Ã™â€šÃ˜Â±Ã˜Â£ Ã˜Â£Ã™Æ’Ã˜Â«Ã˜Â±</a>-->
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
                        <div class="col-default-mb30">
                            <form method="post" action="contact.php?lang={{$lang}}">
                                <input type="hidden" name="csrf" value="{{csrf_token()}}">
                                <input type="text" name="name" class="form-control" placeholder="{{trans('front.name')}}" required="">
                                <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="{{trans('front.email')}}" required="">
                                <!--                                <input type="text" class="form-control" placeholder="Ã˜Â¹Ã˜Â¯Ã˜Â¯">-->
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


@endsection

@section('script')

@endsection


