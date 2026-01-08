@extends('demo::Front.layouts.master')
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
    <div class="header-offset-mobile tp-banner-container">
        <div class="tp-banner minfullwidth" id="rev_slider">
            <ul>
                <li data-transition="random-static" data-slotamount="1" data-masterspeed="100" data-saveperformance="on" data-title="Intro Slide">
                    <!-- MAIN IMAGE -->
                    <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/images/slides/11.jpg" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                    <!-- LAYERS -->
                    <div class="tp-caption skewfromleft  text-center customout rs-parallaxlevel-0" data-x="center" data-y="center" data-customin="x:50;y:390;z:0;rotationX:-230;rotationY:240;rotationZ:280;scaleX:0;scaleY:1.1;skewX:54;skewY:13;opacity:0;transformPerspective:600;transformOrigin:40% -160%;" data-customout="x:-330;y:-260;z:-50;rotationX:280;rotationY:380;rotationZ:80;scaleX:0.5;scaleY:1.4;skewX:52;skewY:28;opacity:0;transformPerspective:600;transformOrigin:-130% -70%;" data-speed="500" data-start="500" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1">
                        <div class="double-clear"></div>
                        <div class="double-clear"></div>
                        <h2 class="uppercase undertitle">
                            <span class="theme-color"> {{trans('front.banner_title_1')}}</span>
                        </h2>
                        <p class="app ">{!! trans('front.banner_msg_1') !!}</p>
                    </div>
                </li>
                <li data-transition="random-static" data-slotamount="1" data-masterspeed="100" data-saveperformance="on" data-title="Intro Slide">
                    <!-- MAIN IMAGE -->
                    <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/images/slides/11.jpg" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                    <!-- LAYERS -->
                    <div class="tp-caption skewfromleft  text-center customout rs-parallaxlevel-0" data-x="center" data-y="center" data-customin="x:50;y:390;z:0;rotationX:-230;rotationY:240;rotationZ:280;scaleX:0;scaleY:1.1;skewX:54;skewY:13;opacity:0;transformPerspective:600;transformOrigin:40% -160%;" data-customout="x:-330;y:-260;z:-50;rotationX:280;rotationY:380;rotationZ:80;scaleX:0.5;scaleY:1.4;skewX:52;skewY:28;opacity:0;transformPerspective:600;transformOrigin:-130% -70%;" data-speed="500" data-start="500" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1">
                        <div class="double-clear"></div>
                        <div class="double-clear"></div>
                        <h2 class="uppercase undertitle">
                            <span class="theme-color"> {{trans('front.banner_title_2')}}</span>
                        </h2>
                        <p class="app ">{!! trans('front.banner_msg_2') !!}</p>
                    </div>
                </li>
                <li data-transition="random-static" data-slotamount="1" data-masterspeed="100" data-saveperformance="on" data-title="Intro Slide">
                    <!-- MAIN IMAGE -->
                    <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/images/slides/11.jpg" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                    <!-- LAYERS -->
                    <div class="tp-caption skewfromleft  text-center customout rs-parallaxlevel-0" data-x="center" data-y="center" data-customin="x:50;y:390;z:0;rotationX:-230;rotationY:240;rotationZ:280;scaleX:0;scaleY:1.1;skewX:54;skewY:13;opacity:0;transformPerspective:600;transformOrigin:40% -160%;" data-customout="x:-330;y:-260;z:-50;rotationX:280;rotationY:380;rotationZ:80;scaleX:0.5;scaleY:1.4;skewX:52;skewY:28;opacity:0;transformPerspective:600;transformOrigin:-130% -70%;" data-speed="500" data-start="500" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1">
                        <div class="double-clear"></div>
                        <div class="double-clear"></div>
                        <h2 class="uppercase undertitle">
                            <span class="theme-color"> {{trans('front.banner_title_3')}}</span>
                        </h2>
                        <p class="app ">{!! trans('front.banner_msg_3') !!}</p>
                    </div>
                </li>
                <li data-transition="random-static" data-slotamount="1" data-masterspeed="100" data-saveperformance="on" data-title="Intro Slide">
                    <!-- MAIN IMAGE -->
                    <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/images/slides/11.jpg" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                    <!-- LAYERS -->
                    <div class="tp-caption skewfromleft  text-center customout rs-parallaxlevel-0" data-x="center" data-y="center" data-customin="x:50;y:390;z:0;rotationX:-230;rotationY:240;rotationZ:280;scaleX:0;scaleY:1.1;skewX:54;skewY:13;opacity:0;transformPerspective:600;transformOrigin:40% -160%;" data-customout="x:-330;y:-260;z:-50;rotationX:280;rotationY:380;rotationZ:80;scaleX:0.5;scaleY:1.4;skewX:52;skewY:28;opacity:0;transformPerspective:600;transformOrigin:-130% -70%;" data-speed="500" data-start="500" data-easing="Power3.easeInOut" data-elementdelay="0.1" data-endelementdelay="0.1">
                        <div class="double-clear"></div>
                        <div class="double-clear"></div>
                        <h2 class="uppercase undertitle">
                            <span class="theme-color"> {{trans('front.banner_title_4')}}</span>
                        </h2>
                        <p class="app ">{!! trans('front.banner_msg_4') !!}</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!--! SLIDER -->
        <!-- SLIDER -->
{{--        <div class="header-offset-mobile tp-banner-container">--}}
{{--        <div class="header-offset tp-banner-container">--}}
{{--            <div class="tp-banner minfullwidth">--}}
{{--                <ul>--}}
{{--                    <li data-transition="random-static" data-slotamount="4" data-masterspeed="500" data-saveperformance="on"--}}
{{--                        data-title="Intro Slide">--}}
{{--                        <!-- MAIN IMAGE -->--}}
{{--                        <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/images/slides/11.jpg" alt="slidebg1"--}}
{{--                             data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">--}}
{{--                        <!-- LAYERS -->--}}
{{--                        <div class="tp-caption skewfromleft  text-center customout rs-parallaxlevel-0" data-x="center"--}}
{{--                             data-y="center"--}}
{{--                             data-customin="x:50;y:390;z:0;rotationX:-230;rotationY:240;rotationZ:280;scaleX:0;scaleY:1.1;skewX:54;skewY:13;opacity:0;transformPerspective:600;transformOrigin:40% -160%;"--}}
{{--                             data-customout="x:-330;y:-260;z:-50;rotationX:280;rotationY:380;rotationZ:80;scaleX:0.5;scaleY:1.4;skewX:52;skewY:28;opacity:0;transformPerspective:600;transformOrigin:-130% -70%;"--}}
{{--                             data-speed="500" data-start="500" data-easing="Power3.easeInOut" data-elementdelay="0.1"--}}
{{--                             data-endelementdelay="0.1">--}}
{{--                            <div class="double-clear"></div>--}}
{{--                            <div class="double-clear"></div>--}}
{{--                            <h2 class="uppercase undertitle">--}}
{{--                                <span class="theme-color"> {{trans('front.banner_title_1')}} </span>--}}
{{--                            </h2>--}}
{{--                            <div class="app "><div>{{trans('front.banner_msg_1')}}</div></div>--}}
{{--                            <div class="app ">--}}
{{--                                <ul>--}}
{{--                                    <li><i class="fa fa-circle text-nice-light-blue"></i>{{trans('front.easy_used')}} </li>--}}
{{--                                    <li><i class="fa fa-circle text-nice-light-blue"></i>{{trans('front.support_arabic')}}</li>--}}
{{--                                    <li><i class="fa fa-circle text-nice-light-blue"></i> {{trans('front.full_gym_control')}}</li>--}}
{{--                                    <li><i class="fa fa-circle text-nice-light-blue"></i> {{trans('front.best_system')}} </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </li>--}}
{{--                    <li data-transition="random-static" data-slotamount="4" data-masterspeed="500" data-saveperformance="on"--}}
{{--                        data-title="Intro Slide">--}}
{{--                        <!-- MAIN IMAGE -->--}}
{{--                        <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/images/slides/11.jpg" alt="slidebg1"--}}
{{--                             data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">--}}
{{--                        <!-- LAYERS -->--}}
{{--                        <div class="tp-caption skewfromleft  text-center customout rs-parallaxlevel-0" data-x="center"--}}
{{--                             data-y="center"--}}
{{--                             data-customin="x:50;y:390;z:0;rotationX:-230;rotationY:240;rotationZ:280;scaleX:0;scaleY:1.1;skewX:54;skewY:13;opacity:0;transformPerspective:600;transformOrigin:40% -160%;"--}}
{{--                             data-customout="x:-330;y:-260;z:-50;rotationX:280;rotationY:380;rotationZ:80;scaleX:0.5;scaleY:1.4;skewX:52;skewY:28;opacity:0;transformPerspective:600;transformOrigin:-130% -70%;"--}}
{{--                             data-speed="500" data-start="500" data-easing="Power3.easeInOut" data-elementdelay="0.1"--}}
{{--                             data-endelementdelay="0.1">--}}
{{--                            <div class="double-clear"></div>--}}
{{--                            <div class="double-clear"></div>--}}
{{--                            <h2 class="uppercase undertitle">--}}
{{--                                <span class="theme-color"> {{trans('front.banner_title_2')}} </span>--}}
{{--                            </h2>--}}
{{--                            <p class="app ">{{trans('front.banner_msg_2')}}</p>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                    <li data-transition="random-static" data-slotamount="4" data-masterspeed="500" data-saveperformance="on"--}}
{{--                        data-title="Intro Slide">--}}
{{--                        <!-- MAIN IMAGE -->--}}
{{--                        <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/images/slides/11.jpg" alt="slidebg1"--}}
{{--                             data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">--}}
{{--                        <!-- LAYERS -->--}}
{{--                        <div class="tp-caption skewfromleft  text-center customout rs-parallaxlevel-0" data-x="center"--}}
{{--                             data-y="center"--}}
{{--                             data-customin="x:50;y:390;z:0;rotationX:-230;rotationY:240;rotationZ:280;scaleX:0;scaleY:1.1;skewX:54;skewY:13;opacity:0;transformPerspective:600;transformOrigin:40% -160%;"--}}
{{--                             data-customout="x:-330;y:-260;z:-50;rotationX:280;rotationY:380;rotationZ:80;scaleX:0.5;scaleY:1.4;skewX:52;skewY:28;opacity:0;transformPerspective:600;transformOrigin:-130% -70%;"--}}
{{--                             data-speed="500" data-start="500" data-easing="Power3.easeInOut" data-elementdelay="0.1"--}}
{{--                             data-endelementdelay="0.1">--}}
{{--                            <div class="double-clear"></div>--}}
{{--                            <div class="double-clear"></div>--}}
{{--                            <h2 class="uppercase undertitle">--}}
{{--                                <span class="theme-color"> {{trans('front.banner_title_3')}}  </span>--}}
{{--                            </h2>--}}
{{--                            <p class="app ">{{trans('front.banner_msg_3')}}</p>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!--! SLIDER -->
    <!-- ALL CONTENTS -->
    <div class="dima-main">
        <!-- CALL TO ACTION -->
        <div class="section-colored dima-callout text-center callout-custom-one no-margin" data-bg="#ffffff">
            <div class="container">
                <div class="clear"></div>
                <div class="ok-row">
                    <div class="ok-md-9 text-start dima-center-full">
                        <h2 class="bold no-bottom-margin calout-center p-callout" style="font-size:25px!important;">{{trans('front.try_free')}}</h2>
                        <br/><div class="app ">
                            <ul>
                                <li  style="color:gray !important;"><i class="fa fa-check text-nice-light-blue" style="color: #4dc247;"></i>{{trans('front.try_free_title_1')}} </li>
                                <li  style="color:gray !important;"><i class="fa fa-check text-nice-light-blue" style="color: #4dc247;"></i>{{trans('front.try_free_title_2')}}</li>
                                <li  style="color:gray !important;"><i class="fa fa-check text-nice-light-blue" style="color: #4dc247;"></i> {{trans('front.try_free_title_3')}}</li>
                            </ul>
                        </div><br/>
                        <p  class="bold no-bottom-margin calout-center p-callout">{{trans('front.try_free_footer')}}</p>
                    </div>
                    <div class="ok-md-3 ok-xsd-12 ok-sd-6 text-end dima-center-full">
                        <a href="#try" target="blank" class="b-callout button fill small no-margin dima-center-full" data-direction="down">{{trans('front.try')}}</a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <!--! CALL TO ACTION -->
        <!-- ALL CONTENTS -->
        <div class="dima-main" id="about">
            <!-- CALL TO ACTION -->
            <div class="section-colored dima-callout text-center callout-custom-one no-margin" data-bg="#f5f5f5">
                <div class="container">
                    <div class="clear"></div>

                    <div class="ok-row">
                        <div class="ok-md-6 ok-xsd-12">

                            <h2 class="no-margin @if($lang == 'ar') text-right @else text-left @endif" data-animate="fadeInDown"
                                data-delay="0">{{trans('front.about_sw')}}</h2>
                            <div class="full-width">
                                <div class="float-start line-hr"></div>
                            </div>
                            <p data-animate="fadeInUp" data-delay="100" class="@if($lang == 'ar') text-right @else text-left @endif">{!! trans('front.about_us_msg') !!}</p>
                        </div>

                        <div class="ok-md-6 ok-xsd-12">
                            <div class="last second" data-animate="fadeInUp" data-delay="220" style="padding-top: 100px;">

<!-- Youtube Embed -->

    <div class="pad">
        <iframe style="width: 100%;height: 320px" src="https://www.youtube.com/embed/ununBxbCF2w" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
    <!--! Youtube Embed -->

                            </div>
                        </div>
{{--                        <div class="ok-md-6 ok-xsd-12" data-animate="fadeIn" data-delay="500">--}}
{{--                            <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/images/188.svg" alt="" style="width: 80%">--}}
{{--                        </div>--}}
                    </div>

                    <div class="clear"></div>
                </div>
            </div>
            <!--! CALL TO ACTION -->
            <section class="section  section-colored" data-bg="#f5f5f5" id="try">
                <div class="page-section-content overflow-hidden">
                    <div class="background-image-hide parallax-background">
                        <img class="background-image" alt="Background Image"
                             src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/images/region_map.png">
                    </div>
                    <div class="dima-section-cover"></div>
                    <div class="container page-section text-center">
                        <!-- TITLE -->
                        <h2 class="uppercase undertitle" data-animate="fadeInDown"
                            data-delay="0">{{trans('front.try_system_title')}}</h2>
                        <div class="topaz-line">
                            <i class="di-separator"></i>
                        </div>
                    {{--                            <p class="undertitle" data-animate="fadeInUp" data-delay="100">Lorem Ipsum. Proin gravida nibh--}}
                    {{--                                vel--}}
                    {{--                                velit auctor aliquet. Aenean sollicitudin lorem.</p>--}}
                    <!--! TITLE -->
{{--                        <div class="clear-section"></div>--}}
                        <div class="ok-row">
                            <div class="clear-section" style="padding-bottom: 20px;"></div>
                            <!-- FORM -->
                            <form  action=""  method="post"   class="form-small form">
                                {{csrf_field()}}
                                <div class="ok-row">
                                    <div class="post ok-md-3 ok-xsd-6" data-animate="fadeInLeft" data-delay="50">
                                        <div class="field">
                                            <input id="name" name="name" type="text" placeholder="{{trans('front.name')}}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="post ok-md-3 ok-xsd-6" data-animate="fadeInLeft" data-delay="100">
                                        <div class="field">
                                            <input id="email" name="email" type="email"
                                                   placeholder="{{trans('front.email')}}" required>
                                        </div>
                                    </div>
                                    <div class="post ok-md-3 ok-xsd-6" data-animate="fadeInLeft" data-delay="100">
                                        <div class="field">
                                            <input id="country" name="country" type="text"
                                                   placeholder="{{trans('front.country')}}" required>
                                        </div>
                                    </div>
                                    <div class="post ok-md-3 ok-xsd-6" data-animate="fadeInLeft" data-delay="150">
                                        <div class="field">
                                            <input id="phone" name="phone" type="text"
                                                   placeholder="{{trans('front.whatsapp')}}" required>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" value="{{trans('front.try')}}" class=" no-rounded button small fill"
                                       data-animate="fadeInLeft" data-delay="0"></form>
                            <!--! FORM -->
                        </div>
                    </div>
                </div>
            </section>

            <!-- RECENT PROJECTS -->
{{--            <section class="section section-colored" data-bg="#f5f5f5" >--}}
{{--                <div class="page-section-content overflow-hidden">--}}
{{--                    <div class="container text-center">--}}
{{--                        <!-- TITLE -->--}}

{{--                        <div class="ok-row calendly" >--}}
{{--                            <!-- Calendly inline widget begin -->--}}
{{--                            <div  class="calendly-inline-widget" data-url="https://calendly.com/gymmawy-com/g?background_color=f5f5f5&primary_color=fa7e06" style="min-width:320px;height:660px;"></div>--}}
{{--                            <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>--}}
{{--                            <!-- Calendly inline widget end -->--}}
{{--                        </div>--}}
{{--                        <!--! ICON -->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </section>--}}
            <!--! RECENT PROJECTS -->

        <!-- RECENT PROJECTS -->
            <section class="section section-colored" data-bg="#f5f5f5" id="memberships">
                <div class="page-section-content overflow-hidden">
                    <div class="container text-center">
                        <!-- TITLE -->
                        <h2 class="uppercase" data-animate="fadeInDown"
                            data-delay="0">{{trans('front.subscriptions')}}</h2>
                        <div class="line-hr hr_white"></div>
                        <!--! TITLE -->
                        <div class="double-clear"></div>

                        <div class="dima-pricing-table">
                            <div class="ok-row">
                                <!-- TABLE (1)-->
                                <div class="dima-pricing-col ok-md-4 ok-xsd-12 ok-sd-3" data-animate="flipInY"
                                     data-delay="50">
                                    <div class="header">
                                        <h2>{{trans('front.subscriptions_p_1')}}</h2>
{{--                                        <span>{{trans('front.our_system')}}</span>--}}
{{--                                        <div class="topaz-border"><br/><br/></div>--}}
{{--                                        <span>{{number_format(35, 2)}} $ / {{trans('front.monthly')}}</span>--}}
                                        <div class="topaz-border"></div>
                                    </div>
                                    <div class="dima-pricing-col-info">
                                        <ul>
{{--                                            <li>{{trans('front.subscriptions_f_1')}}</li>--}}
                                            <li>{{trans('front.subscriptions_f_29')}}</li>
                                            <li>{{trans('front.subscriptions_f_30')}}</li>
                                            <li>{{trans('front.subscriptions_f_31')}}</li>
                                            <li>{{trans('front.subscriptions_f_2')}}</li>
                                            <li>{{trans('front.subscriptions_f_3')}}</li>
                                            <li>{{trans('front.subscriptions_f_28')}}</li>
                                            <li>{{trans('front.subscriptions_f_11')}}</li>
                                            <li>{{trans('front.subscriptions_f_6')}}</li>
                                            <li>{{trans('front.subscriptions_f_7')}}</li>
                                            <li>{{trans('front.subscriptions_f_8')}}</li>
                                            <li>{{trans('front.subscriptions_f_9')}}</li>
                                            <li>{{trans('front.subscriptions_f_12')}}</li>
                                            <li>{{trans('front.subscriptions_f_20')}}</li>
                                            <li>{{trans('front.subscriptions_f_4')}}</li>
                                            <li>{{trans('front.subscriptions_f_5_a')}}</li>
                                            <li  class="through">{{trans('front.subscriptions_f_22')}}</li>
                                            <li  class="through">{{trans('front.subscriptions_f_23')}}</li>
                                            <li  class="through">{{trans('front.subscriptions_f_19')}}</li>
{{--                                            <li>{{trans('front.subscriptions_f_13')}}</li>--}}
{{--                                            <li>{{trans('front.subscriptions_f_14')}}</li>--}}
{{--                                            <li>{{trans('front.subscriptions_f_15')}}</li>--}}
                                            <li class="through">{{trans('front.subscriptions_f_10')}}</li>
                                            @if($country_name != 'egypt')<li class="through">{{trans('front.subscriptions_f_25')}}</li>@endif
                                            
                                            <li class="through">{{trans('front.subscriptions_f_17')}}</li>
                                            <li class="through">{{trans('front.subscriptions_f_16')}}</li>
                                            <li class="through">{{trans('front.subscriptions_f_18')}}</li>
                                            <li class="through">{{trans('front.subscriptions_f_27')}}</li>
                                            <li class="through">{{trans('front.subscriptions_f_21')}}</li>
                                            @if($country_name != 'egypt')<li class="through">{{trans('front.subscriptions_f_24')}}</li>@endif
                                            @if($country_name != 'egypt')<li class="through">{{trans('front.subscriptions_f_26')}}</li>@endif
                                        </ul>
                                        <a
                                           class="small button-block no-rounded button fill di_header"
                                           href="#try"
                                           title="{{trans('front.subscribe_now')}}"
                                           >{{trans('front.subscribe_now')}}</a>
                                    </div>
                                </div>
                                <!--! TABLE (1)-->
                                <?php /* ?>
                                <!-- TABLE (2)-->
                                <div class="dima-pricing-col ok-md-3 ok-xsd-12 ok-sd-3  " data-animate="flipInY"
                                     data-delay="50">
                                    <div class="header">
                                        <h2>{{trans('front.subscriptions_p_2')}}</h2>
                                        <div class="topaz-border"></div>
                                    </div>
                                    <div class="dima-pricing-col-info">
                                        <ul>
{{--                                            <li>{{trans('front.subscriptions_f_1')}}</li>--}}
                                            <li>{{trans('front.subscriptions_f_29')}}</li>
                                            <li>{{trans('front.subscriptions_f_30')}}</li>
                                            <li>{{trans('front.subscriptions_f_31')}}</li>
                                            <li>{{trans('front.subscriptions_f_2')}}</li>
                                            <li>{{trans('front.subscriptions_f_3')}}</li>
                                            <li>{{trans('front.subscriptions_f_28')}}</li>
                                            <li>{{trans('front.subscriptions_f_11')}}</li>
                                            <li>{{trans('front.subscriptions_f_6')}}</li>
                                            <li>{{trans('front.subscriptions_f_7')}}</li>
                                            <li>{{trans('front.subscriptions_f_8')}}</li>
                                            <li>{{trans('front.subscriptions_f_9')}}</li>
{{--                                            <li>{{trans('front.subscriptions_f_13')}}</li>--}}
{{--                                            <li>{{trans('front.subscriptions_f_14')}}</li>--}}
{{--                                            <li>{{trans('front.subscriptions_f_15')}}</li>--}}
                                            <li>{{trans('front.subscriptions_f_12')}}</li>
                                            <li>{{trans('front.subscriptions_f_20')}}</li>
                                            <li>{{trans('front.subscriptions_f_4')}}</li>
                                            <li>{{trans('front.subscriptions_f_17')}}</li>
                                            <li>{{trans('front.subscriptions_f_5_b')}}</li>
                                            <li class="through">{{trans('front.subscriptions_f_22')}}</li>
                                            <li class="through">{{trans('front.subscriptions_f_23')}}</li>
                                            <li class="through">{{trans('front.subscriptions_f_16')}}</li>
                                            <li class="through">{{trans('front.subscriptions_f_19')}}</li>
                                            <li class="through">{{trans('front.subscriptions_f_10')}}</li>
                                            @if($country_name != 'egypt')<li class="through">{{trans('front.subscriptions_f_25')}}</li>@endif
                                            <li class="through">{{trans('front.subscriptions_f_18')}}</li>
                                            <li class="through">{{trans('front.subscriptions_f_27')}}</li>
                                            <li class="through">{{trans('front.subscriptions_f_21')}}</li>
                                            @if($country_name != 'egypt')<li class="through">{{trans('front.subscriptions_f_24')}}</li>@endif
                                            @if($country_name != 'egypt')<li class="through">{{trans('front.subscriptions_f_26')}}</li>@endif
                                        </ul>
                                        <a
                                           class="small button-block no-rounded button fill di_header"
                                           href="#try"
                                           title="{{trans('front.subscribe_now')}}"
                                           data-options="thumbnail: ''">{{trans('front.subscribe_now')}}</a>
                                    </div>
                                </div>
                                <!--! TABLE (2)-->
<?php */ ?>
                                <!-- TABLE (3)-->
                                <div class="dima-pricing-col ok-md-4 ok-xsd-12 ok-sd-3 " data-animate="flipInY"
                                     data-delay="50">
                                    <div class="header">
                                        <h2>{{trans('front.subscriptions_p_2')}}</h2>
{{--                                        <span>{{trans('front.system')}} + {{trans('front.website')}} + {{trans('front.application')}}</span>--}}
{{--                                        <div class="topaz-border"><br/><br/></div>--}}
{{--                                        <span>{{number_format(65, 2)}} $ / {{trans('front.monthly')}}</span>--}}
                                        <div class="topaz-border"></div>
                                    </div>
                                    <div class="dima-pricing-col-info">
                                        <ul>
{{--                                            <li>{{trans('front.subscriptions_f_1')}}</li>--}}
                                            <li>{{trans('front.subscriptions_f_29')}}</li>
                                            <li>{{trans('front.subscriptions_f_30')}}</li>
                                            <li>{{trans('front.subscriptions_f_31')}}</li>
                                            <li>{{trans('front.subscriptions_f_2')}}</li>
                                            <li>{{trans('front.subscriptions_f_3')}}</li>
                                            <li>{{trans('front.subscriptions_f_28')}}</li>
                                            <li>{{trans('front.subscriptions_f_11')}}</li>
                                            <li>{{trans('front.subscriptions_f_6')}}</li>
                                            <li>{{trans('front.subscriptions_f_7')}}</li>
                                            <li>{{trans('front.subscriptions_f_8')}}</li>
                                            <li>{{trans('front.subscriptions_f_9')}}</li>
                                            {{--                                            <li>{{trans('front.subscriptions_f_13')}}</li>--}}
                                            {{--                                            <li>{{trans('front.subscriptions_f_14')}}</li>--}}
                                            {{--                                            <li>{{trans('front.subscriptions_f_15')}}</li>--}}
                                            <li>{{trans('front.subscriptions_f_12')}}</li>
                                            <li>{{trans('front.subscriptions_f_20')}}</li>
                                            <li>{{trans('front.subscriptions_f_4')}}</li>
                                            <li>{{trans('front.subscriptions_f_5_b')}}</li>
                                            <li>{{trans('front.subscriptions_f_22')}}</li>
                                            <li>{{trans('front.subscriptions_f_23')}}</li>
                                            <li>{{trans('front.subscriptions_f_19')}}</li>
                                            <li>{{trans('front.subscriptions_f_10')}}</li>
                                            @if($country_name != 'egypt')<li>{{trans('front.subscriptions_f_25')}}</li>@endif
                                            
                                            <li>{{trans('front.subscriptions_f_17')}}</li>
                                            <li class="through">{{trans('front.subscriptions_f_16')}}</li>
                                            <li class="through">{{trans('front.subscriptions_f_18')}}</li>
                                            <li class="through">{{trans('front.subscriptions_f_27')}}</li>
                                            <li class="through">{{trans('front.subscriptions_f_21')}}</li>
                                            @if($country_name != 'egypt')<li class="through">{{trans('front.subscriptions_f_24')}}</li>@endif
                                            @if($country_name != 'egypt')<li class="through">{{trans('front.subscriptions_f_26')}}</li>@endif
                                        </ul>
                                        <a
                                                class="small button-block no-rounded button fill di_header"
                                                href="#try"
                                                title="{{trans('front.subscribe_now')}}"
                                        >{{trans('front.subscribe_now')}}</a>
                                    </div>
                                </div>
                                <!--! TABLE (3)-->


                                <!-- TABLE (3)-->
                                <div class="dima-pricing-col ok-md-4 ok-xsd-12 ok-sd-3 featured" data-animate="flipInY"
                                     data-delay="50">
                                    <div class="header">
                                        <h2>{{trans('front.subscriptions_p_3')}}</h2>
{{--                                        <span>{{trans('front.system')}} + {{trans('front.website')}} + {{trans('front.application')}}</span>--}}
{{--                                        <div class="topaz-border"><br/><br/></div>--}}
{{--                                        <span>{{number_format(65, 2)}} $ / {{trans('front.monthly')}}</span>--}}
                                        <div class="topaz-border"></div>
                                    </div>
                                    <div class="dima-pricing-col-info">
                                        <ul>

{{--                                            <li>{{trans('front.subscriptions_f_1')}}</li>--}}
                                            <li>{{trans('front.subscriptions_f_29')}}</li>
                                            <li>{{trans('front.subscriptions_f_30')}}</li>
                                            <li>{{trans('front.subscriptions_f_31')}}</li>
                                            <li>{{trans('front.subscriptions_f_2')}}</li>
                                            <li>{{trans('front.subscriptions_f_3')}}</li>
                                            <li>{{trans('front.subscriptions_f_28')}}</li>
                                            <li>{{trans('front.subscriptions_f_11')}}</li>
                                            <li>{{trans('front.subscriptions_f_6')}}</li>
                                            <li>{{trans('front.subscriptions_f_7')}}</li>
                                            <li>{{trans('front.subscriptions_f_8')}}</li>
                                            <li>{{trans('front.subscriptions_f_9')}}</li>
                                            {{--                                            <li>{{trans('front.subscriptions_f_13')}}</li>--}}
                                            {{--                                            <li>{{trans('front.subscriptions_f_14')}}</li>--}}
                                            {{--                                            <li>{{trans('front.subscriptions_f_15')}}</li>--}}
                                            <li>{{trans('front.subscriptions_f_12')}}</li>
                                            <li>{{trans('front.subscriptions_f_20')}}</li>
                                            <li>{{trans('front.subscriptions_f_4')}}</li>
                                            <li>{{trans('front.subscriptions_f_5_b')}}</li>
                                            <li>{{trans('front.subscriptions_f_22')}}</li>
                                            <li>{{trans('front.subscriptions_f_23')}}</li>
                                            <li>{{trans('front.subscriptions_f_19')}}</li>
                                            <li>{{trans('front.subscriptions_f_10')}}</li>
                                            @if($country_name != 'egypt')<li>{{trans('front.subscriptions_f_25')}}</li>@endif
                                            <li>{{trans('front.subscriptions_f_17')}}</li>
                                            <li>{{trans('front.subscriptions_f_16')}}</li>
                                            <li>{{trans('front.subscriptions_f_18')}}</li>
                                            <li>{{trans('front.subscriptions_f_27')}}</li>
                                            <li>{{trans('front.subscriptions_f_21')}}</li>
                                            @if($country_name != 'egypt')<li>{{trans('front.subscriptions_f_24')}}</li>@endif
                                            @if($country_name != 'egypt')<li>{{trans('front.subscriptions_f_26')}}</li>@endif
                                        </ul>
                                        <a
                                                class="small button-block no-rounded button fill di_header"
                                                href="#try"
                                                title="{{trans('front.subscribe_now')}}"
                                        >{{trans('front.subscribe_now')}}</a>
                                    </div>
                                </div>
                                <!--! TABLE (3)-->
                            </div>
                        </div>

                        <!--! ICON -->
                    </div>
                </div>
            </section>
            <!--! RECENT PROJECTS -->
            <!-- FEATURES SECTION -->
            <section class="section" id="features">
                <div class="page-section-content overflow-hidden">
                    <div class="container">
                        <!-- TITLE -->
                        <h2 class="uppercase text-center" data-animate="fadeInDown"
                            data-delay="0">{{trans('front.sw_features')}}</h2>
                        <div class="line-hr hr_white"></div>
                        <!--! TITLE -->
                        <div class="double-clear"></div>
                        <div class="ok-row">
                            <div class=" ok-md-12 ok-xsd-12">
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="0">
                                        <header role="banner">
                                            <i class="fa fa-globe"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature1')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature1')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="150">
                                        <header role="banner">
                                            <i class="fa fa-language"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature2')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature2')}}</p></div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-lock"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature18')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature18')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="250">
                                        <header role="banner">
                                            <i class="fa fa-users"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature3')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature3')}}</p></div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="350">
                                        <header role="banner">
                                            <i class="fa fa-credit-card"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature4')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature4')}}</p></div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="450">
                                        <header role="banner">
                                            <i class="fa fa-list"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature5')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature5')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-user"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature6')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature6')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-hourglass"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature7')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature7')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-hourglass-half"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature8')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature8')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-barcode"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature9')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature9')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-credit-card"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature10')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature10')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-ban"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature11')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature11')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-bell"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature12')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature12')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-list-alt"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature13')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature13')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-file-code-o"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature14')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature14')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-power-off"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature15')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature15')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-star"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature16')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature16')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>

                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa fa-shield"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature19')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature19')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>

                                <div class="clearfix"></div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-shopping-cart"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature20')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature20')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-calendar"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature21')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature21')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-wechat"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature22')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature22')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>

                                <div class="clearfix"></div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-file-image-o"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature23')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature23')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-ticket"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature24')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature24')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-link"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature17')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature17')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class="clearfix"></div>

                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-mobile-phone"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature25')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature25')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-paper-plane"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature26')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature26')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-whatsapp"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature27')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature27')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class="clearfix"></div>

                                @if($country_name != 'egypt')
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fas fa-fingerprint"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature28')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature28')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                @endif

                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-universal-access"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature29')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature29')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-users"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature30')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature30')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fas fa-code-branch"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature31')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature31')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>

                                @if($country_name != 'egypt')
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-credit-card"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature32')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature32')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                @else
                                    <div class="clearfix"></div>
                                @endif


                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-mobile-phone"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature33')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature33')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>
                                <div class=" ok-md-4 ok-xsd-12">
                                    <div class="features-start small-flat" data-animate="fadeInUp" data-delay="550">
                                        <header role="banner">
                                            <i class="fa fa-user-doctor"></i>
                                        </header>
                                        <div class="features-content">
                                            <h5 class="features-title ">{{trans('front.t_feature34')}}</h5>
                                            <p class="flat-paragraph ">{{trans('front.feature34')}}</p>
                                        </div>
                                    </div>
                                    <div class="double-clear"></div>
                                    <div class="double-clear"></div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--! FEATURES SECTION -->

            <!-- STATS SECTION -->
            {{-- @include('demo::Front.partials.stats') --}}
            <!--! STATS SECTION -->

            <div style="clear: both;float:none;"></div>
            <!-- APP SECTION -->
            <section class="section" id="app">
                <div class="page-section-content overflow-hidden">
                    <div class="background-image-hide parallax-background">
                        <img class="background-image" alt="Background Image" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/images/sections/app-bg.jpg">
                    </div>
                    <div class="dima-section-cover"></div>
                    <div class="container page-section-app text-start">
                        <!-- TITLE -->
                        <div class="ok-row">
                            <div class="ok-md-8 ok-xsd-12">
                                <h2 class="uppercase theme-color" data-animate="fadeInDown" data-delay="0">{{trans('front.gymmawy_app')}}</h2>

                                <div class="double-clear"></div>
                                <p class="undertitle" data-animate="fadeInUp" data-delay="30">{{trans('front.gymmawy_app_msg')}}</p>
                                <div class="double-clear"></div>
                                <div class="double-clear"></div>

{{--                                <div class="row col-md-12">--}}
{{--                                <a href="https://play.google.com/store/apps/details?id=com.gymmawy" target="_blank" data-animated-link="fadeOut" class="no-rounded uppercase  small ok-md-4 ok-xsd-12">--}}
{{--                                    <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/images/play_store_icon.png">--}}
{{--                                </a>--}}
{{--                                <a href="https://apps.apple.com/us/app/gymmawy/id1616309138" target="_blank"  data-animated-link="fadeOut" class="no-rounded uppercase  small ok-md-4 ok-xsd-12" >--}}
{{--                                    <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/images/apple_store_icon.png" >--}}
{{--                                </a>--}}
{{--                                </div>--}}
{{--                                <div class="double-clear"></div>--}}
{{--                                <a data-animated-link="fadeOut" class="text-center ok-md-3 ok-xsd-6 no-rounded uppercase small">--}}
{{--                                    <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/images/onlink_to_gymmawy_small.png">--}}
{{--                                </a>--}}
                                <div class="double-clear"></div>
                                <div class="double-clear"></div>
                                <div class="clear"></div>
                            </div>
                            <!--! TITLE -->
                            <!-- PHONE DEVICE -->
                            <div class="ok-md-4 ok-xsd-6 hidden-xsd hidden-sd">
                                <div class="full-width in-bottom-absolute" style="margin-bottom: 0;">
                                    <div class="double-clear"></div>
                                    <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/images/devices/device-iphone.png" class="topaz-div-bg" alt="">
                                    <div class="device-content phone">
                                        <ul class="image-carousel owl-carousel" data-owl-namber="1" data-owl-autoPlay="false" data-owl-navigation="false" data-owl-pagination="false">
                                            <li>
                                                <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/images/iphone-bg-app.png" alt="">
                                            </li>
                                            <li>
                                                <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/images/iphone-bg-app.png" alt="">
                                            </li>
{{--                                            <li>--}}
{{--                                                <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/')}}/images/iphone-bg-1.png" alt="">--}}
{{--                                            </li>--}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--! PHONE DEVICE -->
                        </div>
                    </div>
                </div>
            </section>
            <!--! APP SECTION -->

            <!-- TESTIMONIALS SECTION -->
            @include('demo::Front.partials.testimonials')
            <!--! TESTIMONIALS SECTION -->

            <!-- QUOTE SECTION -->
{{--            <section class="section " id="clients">--}}
{{--                <div class="page-section-content overflow-hidden">--}}
{{--                    <div class="background-image-hide parallax-background">--}}
{{--                        <img class="background-image" alt="" src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/front/images/sections/quote-bg.jpg')}}">--}}
{{--                    </div>--}}
{{--                    <div class="dima-section-cover"></div>--}}
{{--                    <div class="container page-section text-center" data-animate="bounceIn" data-delay="0" data-owl-autoPlay="true">--}}
{{--                        <div class="topaz-line quote">--}}
{{--                            <i class="fa fa-quote-left"></i>--}}
{{--                        </div>--}}
{{--                        <div class="ok-offset-md-2 ok-md-8 ok-xsd-12" data-animate="bounceIn" >--}}
{{--                            <div class="owl-carousel" data-autoPlay="true"  >--}}
{{--                                <!-- QUOTE (1) -->--}}
{{--                                <div class="dima-testimonial quote-style" >--}}
{{--                                    <blockquote >--}}
{{--                                        <p>A designer is an emerging synthesis of artist, inventor, mechanic, objective economist and evolutio­nary strategist.--}}
{{--                                        </p>--}}
{{--                                        <span class="dima-testimonial-meta">--}}
{{--                                            <strong>-Buckminster Fuller-</strong>--}}
{{--                                            </span>--}}
{{--                                    </blockquote>--}}
{{--                                </div>--}}
{{--                                <!--! QUOTE (1) -->--}}
{{--                                <!-- QUOTE (2) -->--}}
{{--                                <div class="dima-testimonial quote-style"  >--}}
{{--                                    <blockquote>--}}
{{--                                        <p>A designer is an emerging synthesis of artist, inventor, mechanic, objective economist and evolutio­nary strategist.--}}
{{--                                        </p>--}}
{{--                                        <span class="dima-testimonial-meta">--}}
{{--                                            <strong>-Buckminster Fuller-</strong>--}}
{{--                                            </span>--}}
{{--                                    </blockquote>--}}
{{--                                </div>--}}
{{--                                <!--! QUOTE (2) -->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="ok-md-2"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </section>--}}
            <!-- QUOTE SECTION -->


            <!-- SECTION -->
            <section class="section section-colored" data-bg="#f5f5f5" style="background-color: rgb(245, 245, 245);"  id="clients">
                <div class="page-section-content overflow-hidden">
                    <div class="container">
                        <!-- TITLE -->
                        <h2 class="uppercase text-center" data-animate="fadeInDown"
                            data-delay="0">{{trans('front.our_clients')}}</h2>
                        <div class="line-hr hr_white"></div>
                        <!--! TITLE -->
                        <div class="double-clear"></div>
                        <div class="ok-row">

                            @foreach($client_images as $image)
                                <div class=" ok-md-3 ok-xsd-6 ok-sd-6 services  text-center image">
                                    <header role="banner">
                                        <div class="thumb overlay">
                                            <img src="{{$image}}"
                                                 alt="">
                                        </div>
                                    </header>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </section>
            <!--! SECTION -->

            <!-- FAQ SECTION -->
            @include('demo::Front.partials.faq')
            <!--! FAQ SECTION -->

            @if($country_name != 'egypt')
            <!-- CLIENTS SECTION -->
            <section class="section " id="clients">
                <div class="page-section-content overflow-hidden">
                    <div class="container text-center ">
                        <!-- TITLE -->
                        <h2 class="uppercase  " data-animate="fadeInDown" data-delay="0">{{trans('front.support')}}</h2>
                        <div class="topaz-line">
                            <i class="di-separator"></i>
                        </div>
{{--                        <p data-animate="fadeInUp" data-delay="100">أبجد هوز هو مجرد دمية النص من التنضيد والطباعة وصناعة. أبجد هوز وقد نص في هذه الصناعة</p>--}}
                        <!--! TITLE -->
{{--                        <div class="clear-section"></div>--}}
                        <div class="clients-wrapper" data-animate="fadeIn" data-delay="150">
                            <div class="collection">
                                <div class="ok-row">
                                    <!-- CLIENT (1) -->
                                    <div class="client ok-md-3 ok-xsd-12 ok-sd-6 ">
                                        <a data-animated-link="fadeOut" href="#">
                                            <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/images/visa_logo.svg')}}" style="width: 150px;" alt="visa">
                                        </a>
                                    </div>
                                    <!--! CLIENT (1) -->
                                    <!-- CLIENT (2) -->
                                    <div class="client ok-md-3 ok-xsd-12 ok-sd-6">
                                        <a data-animated-link="fadeOut" href="#">
                                            <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/images/american_express_logo.svg')}}" style="width: 150px;" alt="american express">
                                        </a>
                                    </div>
                                    <!--! CLIENT (2) -->
                                    <!-- CLIENT (3) -->
                                    <div class="client ok-md-3 ok-xsd-12 ok-sd-6">
                                        <a data-animated-link="fadeOut" href="#">
                                            <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/images/mada-logo.svg')}}" style="width: 150px;" alt="mada">
                                        </a>
                                    </div>
                                    <!--! CLIENT (3) -->
                                    <!-- CLIENT (4) -->
                                    <div class="client ok-md-3 ok-xsd-12 ok-sd-6">
                                        <a data-animated-link="fadeOut" href="#">
                                            <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/images/tabby-logo.webp')}}" style="width: 150px;" alt="tabby">
                                        </a>
                                    </div>
                                    <!--! CLIENT (4) -->
                                </div>
                            </div>
                            <div class="double-clear"></div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- CLIENTS SECTION -->
                @endif

            <!-- TRUST BADGES SECTION -->
            {{-- @include('demo::Front.partials.trust-badges') --}}
            <!--! TRUST BADGES SECTION -->

        </div>
        <!--! ALL CONTENTS -->


@endsection
@section('script')
    <script src="https://kit.fontawesome.com/2b21bbc359.js" crossorigin="anonymous"></script>
    <script>
        $('#rev_slider').revolution({
            delay: 4000, // Delay in milliseconds (9000ms = 9 seconds)
        });
    </script>
@endsection
