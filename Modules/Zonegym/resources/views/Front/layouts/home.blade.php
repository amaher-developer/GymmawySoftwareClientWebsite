@extends('zonegym::Front.layouts.master')
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
    <section id="about" class="about-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="about-title">
                        <h1>{{trans('front.welcome')}} <span><?php echo $mainSettings['name']?></span></h1>
                        <!--                    <p>Ã˜Â­Ã˜Â§Ã™ÂÃ˜Â¸ Ã˜Â¹Ã™â€žÃ™â€° Ã˜Â¬Ã˜Â³Ã™â€¦Ã™Æ’ Ã™â€žÃ˜Â§Ã˜Â¦Ã™â€šÃ™â€¹Ã˜Â§ Ã™Ë†Ã™â€šÃ™Ë†Ã™Å Ã™â€¹Ã˜Â§</p>-->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="about-col">
                        <!--                    <h3>Ã˜ÂªÃ˜Â¹Ã˜Â±Ã™Â Ã˜Â¹Ã™â€žÃ™â€°  Fitme</h3>-->
                        <!--                    <p>Ã™â€ Ã˜Â§Ã™Æ’ Ã˜Â­Ã™â€šÃ™Å Ã™â€šÃ˜Â© Ã™â€¦Ã˜Â«Ã˜Â¨Ã˜ÂªÃ˜Â© Ã™â€¦Ã™â€ Ã˜Â° Ã˜Â²Ã™â€¦Ã™â€  Ã˜Â·Ã™Ë†Ã™Å Ã™â€ž Ã™Ë†Ã™â€¡Ã™Å  Ã˜Â£Ã™â€  Ã˜Â§Ã™â€žÃ™â€¦Ã˜Â­Ã˜ÂªÃ™Ë†Ã™â€° Ã˜Â§Ã™â€žÃ™â€¦Ã™â€šÃ˜Â±Ã™Ë†Ã˜Â¡ Ã™â€žÃ˜ÂµÃ™ÂÃ˜Â­Ã˜Â© Ã™â€¦Ã˜Â§ Ã˜Â³Ã™Å Ã™â€žÃ™â€¡Ã™Å  Ã˜Â§Ã™â€žÃ™â€šÃ˜Â§Ã˜Â±Ã˜Â¦ Ã˜Â¹Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂªÃ˜Â±Ã™Æ’Ã™Å Ã˜Â² Ã˜Â¹Ã™â€žÃ™â€° Ã˜Â§Ã™â€žÃ˜Â´Ã™Æ’Ã™â€ž Ã˜Â§Ã™â€žÃ˜Â®Ã˜Â§Ã˜Â±Ã˜Â¬Ã™Å  Ã™â€žÃ™â€žÃ™â€ Ã˜Âµ Ã˜Â£Ã™Ë† Ã˜Â´Ã™Æ’Ã™â€ž Ã˜ÂªÃ™Ë†Ã˜Â¶Ã˜Â¹ Ã˜Â§Ã™â€žÃ™ÂÃ™â€šÃ˜Â±Ã˜Â§Ã˜Âª Ã™ÂÃ™Å  Ã˜Â§Ã™â€žÃ˜ÂµÃ™ÂÃ˜Â­Ã˜Â© Ã˜Â§Ã™â€žÃ˜ÂªÃ™Å  Ã™Å Ã™â€šÃ˜Â±Ã˜Â£Ã™â€¡Ã˜Â§. Ã™Ë†Ã™â€žÃ˜Â°Ã™â€žÃ™Æ’ Ã™Å Ã˜ÂªÃ™â€¦ Ã˜Â§Ã˜Â³Ã˜ÂªÃ˜Â®Ã˜Â¯Ã˜Â§Ã™â€¦ Ã˜Â·Ã˜Â±Ã™Å Ã™â€šÃ˜Â© Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦ Ã™â€žÃ˜Â£Ã™â€ Ã™â€¡Ã˜Â§ Ã˜ÂªÃ˜Â¹Ã˜Â·Ã™Å  Ã˜ÂªÃ™Ë†Ã˜Â²Ã™Å Ã˜Â¹Ã˜Â§Ã™Å½ Ã˜Â·Ã˜Â¨Ã™Å Ã˜Â¹Ã™Å Ã˜Â§Ã™Å½ -Ã˜Â¥Ã™â€žÃ™â€° Ã˜Â­Ã˜Â¯ Ã™â€¦Ã˜Â§- Ã™â€žÃ™â€žÃ˜Â£Ã˜Â­Ã˜Â±Ã™Â Ã˜Â¹Ã™Ë†Ã˜Â¶Ã˜Â§Ã™â€¹ Ã˜Â¹Ã™â€  Ã˜Â§Ã˜Â³Ã˜ÂªÃ˜Â®Ã˜Â¯Ã˜Â§Ã™â€¦ "Ã™â€¡Ã™â€ Ã˜Â§ Ã™Å Ã™Ë†Ã˜Â¬Ã˜Â¯ Ã™â€¦Ã˜Â­Ã˜ÂªÃ™Ë†Ã™â€° Ã™â€ Ã˜ÂµÃ™Å Ã˜Å’ Ã™â€¡Ã™â€ Ã˜Â§ Ã™Å Ã™Ë†Ã˜Â¬Ã˜Â¯ Ã™â€¦Ã˜Â­Ã˜ÂªÃ™Ë†Ã™â€° Ã™â€ Ã˜ÂµÃ™Å " Ã™ÂÃ˜ÂªÃ˜Â¬Ã˜Â¹Ã™â€žÃ™â€¡Ã˜Â§ Ã˜ÂªÃ˜Â¨Ã˜Â¯Ã™Ë† (Ã˜Â£Ã™Å  Ã˜Â§Ã™â€žÃ˜Â£Ã˜Â­Ã˜Â±Ã™Â) Ã™Ë†Ã™Æ’Ã˜Â£Ã™â€ Ã™â€¡Ã˜Â§ Ã™â€ Ã˜Âµ Ã™â€¦Ã™â€šÃ˜Â±Ã™Ë†Ã˜Â¡. Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â¨Ã˜Â±Ã˜Â§Ã™â€¦Ã˜Â­ Ã˜Â§Ã™â€žÃ™â€ Ã˜Â´Ã˜Â± Ã˜Â§Ã™â€žÃ™â€¦Ã™Æ’Ã˜ÂªÃ˜Â¨Ã™Å  Ã™Ë†Ã˜Â¨Ã˜Â±Ã˜Â§Ã™â€¦Ã˜Â­ Ã˜ÂªÃ˜Â­Ã˜Â±Ã™Å Ã˜Â± Ã˜ÂµÃ™ÂÃ˜Â­Ã˜Â§Ã˜Âª Ã˜Â§Ã™â€žÃ™Ë†Ã™Å Ã˜Â¨ Ã˜ÂªÃ˜Â³Ã˜ÂªÃ˜Â®Ã˜Â¯Ã™â€¦ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž Ã˜Â¥Ã™ÂÃ˜ÂªÃ˜Â±Ã˜Â§Ã˜Â¶Ã™Å  Ã™Æ’Ã™â€ Ã™â€¦Ã™Ë†Ã˜Â°Ã˜Â¬ Ã˜Â¹Ã™â€  Ã˜Â§Ã™â€žÃ™â€ Ã˜ÂµÃ˜Å’ Ã™Ë†Ã˜Â¥Ã˜Â°Ã˜Â§ Ã™â€šÃ™â€¦Ã˜Âª Ã˜Â¨Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž </p>-->

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
                <div class="col-lg-5" >
                    <div class="animated bounceInLeft slow">
                        <!--                    <img src="https://kytharainstitute-art.com/images/rtl-images/about/3-38429_girl-dance-png-photos-woman-ballerina-ballet-dancer.png" alt="">-->
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
@if(isset($activities) && (count($activities) > 0))
    <!-- Counter Section -->
    <section  id="activities" class="counter-sec jarallax over-layer-black">
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
    <!-- Gallery Section -->
    @endif
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
                        <!--                    <p>Ã™â€¡Ã™â€ Ã˜Â§Ã™â€žÃ™Æ’ Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â¯Ã™Å Ã˜Â¯ Ã™â€¦Ã™â€  Ã˜Â§Ã™â€žÃ˜Â£Ã™â€ Ã™Ë†Ã˜Â§Ã˜Â¹ Ã˜Â§Ã™â€žÃ™â€¦Ã˜ÂªÃ™Ë†Ã™ÂÃ˜Â±Ã˜Â© Ã™â€žÃ™â€ Ã˜ÂµÃ™Ë†Ã˜Âµ Ã™â€žÃ™Ë†Ã˜Â±Ã™Å Ã™â€¦ Ã˜Â¥Ã™Å Ã˜Â¨Ã˜Â³Ã™Ë†Ã™â€¦Ã˜Å’ Ã™Ë†Ã™â€žÃ™Æ’Ã™â€  Ã˜Â§Ã™â€žÃ˜ÂºÃ˜Â§Ã™â€žÃ˜Â¨Ã™Å Ã˜Â© Ã˜ÂªÃ™â€¦ Ã˜ÂªÃ˜Â¹Ã˜Â¯Ã™Å Ã™â€žÃ™â€¡Ã˜Â§ Ã˜Â¨Ã˜Â´Ã™Æ’Ã™â€ž Ã™â€¦Ã˜Â§ Ã˜Â¹Ã˜Â¨Ã˜Â± Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¨Ã˜Â¹Ã˜Â¶ Ã˜Â§Ã™â€žÃ™â€ Ã™Ë†Ã˜Â§Ã˜Â¯Ã˜Â± Ã˜Â£Ã™Ë† Ã˜Â§Ã™â€žÃ™Æ’Ã™â€žÃ™â€¦Ã˜Â§Ã˜Âª Ã˜Â§Ã™â€žÃ˜Â¹Ã˜Â´Ã™Ë†Ã˜Â§Ã˜Â¦Ã™Å Ã˜Â© Ã˜Â¥Ã™â€žÃ™â€° Ã˜Â§Ã™â€žÃ™â€ Ã˜Âµ.</p>-->
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


    @if(isset($subscriptions) && (count($subscriptions) > 0))
    <!-- Pricing Table Section -->
    <section id="subscriptions" class="pricing-table-sec jarallax over-layer-black">
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

    <!-- Scroll Up -->
    <div class="goto-top-section">
        <span class="triangle"></span>
        <a class="js-scroll-trigger" href="#page-top">
            <i class="fa fa-angle-double-up" aria-hidden="true"></i>
        </a>
    </div>



@endsection
@section('script')

@endsection

