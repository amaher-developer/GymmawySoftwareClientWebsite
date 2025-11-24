@extends('redbone::Front.layouts.master')
@section('style')
@endsection
@section('content')

    <!-- Hero  start -->
    <section class="hero-wrap v3" id="page-top">
        <div class="hero-slider-v3 owl-carousel">
            @foreach($banners as $i => $banner)
            <div class="item">
                <div class="hero-slider-item bg-f hero-bg-{{$i+1}}"  style="background-image: url('{{$banner->image}}') !important;" >

                        <div class="overlay op-6 bg-charcole"></div>

                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="hero-content">
                                            <span class="hero-subhead">
                                                {{$mainSettings->name}}
                                            </span>

                                    <h1><span>{{$banner->title}}</span>

                                    </h1>
                                    <div class="hero-btn">
{{--                                        <a href="#" class="btn v1">Claim New Offer</a>--}}
                                        <a href="#contact" class="btn v4">{{trans('front.contact_us')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Promo area start -->
        <div class="promo-wrap v3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="promo-item">
                            <div class="promo-img bg-f " >
                            </div>
                            <div class="promo-content">
                                <div class="promo-icon">
                                    <i class="flaticon-fitness-1"></i>
                                </div>
                                <div class="promo-text">
                                    <h5>{{trans('front.banner_title_1')}}</h5>
                                    <p>{{trans('front.banner_content_1')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="promo-item">
                            <div class="promo-img bg-f " >
                            </div>
                            <div class="promo-content">
                                <div class="promo-icon">
                                    <i class="flaticon-fitness"></i>
                                </div>
                                <div class="promo-text">
                                    <h5>{{trans('front.banner_title_2')}}</h5>
                                    <p>{{trans('front.banner_content_2')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="promo-item bb-none">
                            <div class="promo-img bg-f " >
                            </div>
                            <div class="promo-content">
                                <div class="promo-icon">
                                    <i class="flaticon-ticket"></i>
                                </div>
                                <div class="promo-text">
                                    <h5>{{trans('front.banner_title_3')}}</h5>
                                    <p>{{trans('front.banner_content_3')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Promo area end -->
    </section>
    <!-- Hero  end -->

    <!-- Testimonial  start -->
    <section class="client-quote-wrap  bg-f test-bg-1 pb-100" >
        <div class="dumb-pos-img">
            <img src="{{asset('resources/')}}/assets/img/dumbell-1.png" alt="Image">
        </div>
        <div class="container pos-rel">
            <div class="row">
                <div class="col-xl-10 offset-xl-1 col-lg-12">
                    <div class="client-quote">
                        <p>{{trans('front.captain_talk')}}</p>
                    </div>
                    <div class="client-info">
                        <div class="client-avatar">
                            <img src="{{asset('resources/')}}/assets/img/client01.jpg" alt="Image">
                        </div>
                        <div class="client-name">
                            <h5>{{trans('front.captain_name')}}</h5>
                            <p>{{trans('front.captain_title')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial  end -->
    <!-- About Section start -->
    <section class="about-wrap bg-black v2 section-padding pb-0" >
        @if(isset($images) && (count($images) > 0))
        <div class="about-img-slider v2 owl-carousel" id="gallery">
                @foreach($images as $image)
            <div class="item">
                <div class="about-feat-img">
                    <img src="{{env('APP_URL_MASTER').'uploads/settings/gyms/'.$image}}" alt="Image">
                </div>
            </div>
                @endforeach
        </div>
        @endif
        <div class="about-content pb-0" id="about" >
            <div class="feature-content">
{{--                <div class="feature-content-title content-title v5">--}}
{{--                    <span>{{trans('sw.about')}}</span>--}}
{{--                    <h2 class="text-white"><?php echo @$mainSettings['about']?></h2>--}}
{{--                </div>--}}
                <div class="feature-box-wrap v2">
                    <div class="feature-box-item">
                        <div class="feature-box-text">
                            <h5>{{trans('sw.about')}}</h5>
                            <p><?php echo $mainSettings['about']?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section end -->
    <!-- Class section start -->
    @if(isset($subscriptions) && (count($subscriptions) > 0))

        <section class="class-wrap v3 bg-charcole section-padding" id="subscriptions">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-6">
                    <div class="section-title v2">
                        <h2>{{trans('front.subscriptions')}}</h2>
                    </div>
                </div>
                <div class="col-md-6 sm-none">
                    <div class="text-md-end">
                        <a href="" class="btn v6">{{trans('global.view_all')}}</a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($subscriptions as $subscription)
                <div class="col-lg-4 col-md-6">
                    <div class="class-item">
{{--                        <div class="class-img">--}}
                        <div class="">
                            <a href="{{route('subscription', $subscription->id)}}"><img class="img-fluid" src="{{$subscription->image ?? @$record->logo}}" alt="Image"></a>
                        </div>
                        <div class="class-info">
                            <a href="{{route('subscription', $subscription->id)}}">{{$subscription->name}}</a>
                            <p>{{trans('front.period')}}: {{$subscription->period}} {{trans('front.day')}}</p>
                            <p>{{trans('front.session_num')}}: {{$subscription->workouts}}</p>
                            <p>{{number_format(($subscription->price + ($subscription->price * (@$record->vat_details['vat_percentage']/100))), 2)}} {{trans('front.pound_unit')}}</p>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row align-items-center my-1">
                <div class="col-12 lg-none mt-3">
                    <div class="text-center">
                        <a href="" class="btn v6">{{trans('global.view_all')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Class section end -->

    @endif
    <!-- Call-to-action start -->
    <section class="cta-wrap v2 bg-f section-padding cta-bg-1"  >
        <div class="overlay op-9 bg-mirage"></div>
        <div class="container">
            <div class="row gx-3 align-items-center">
                <div class="col-lg-9">
                    <div class="section-title v3">
                        <h2>{{trans('front.offer_msg')}}</h2>
                    </div>
                </div>
{{--                <div class="col-lg-4">--}}
{{--                    <div class="cta-para">--}}
{{--                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-lg-3">
                    <div class="cta-call">
                        <i class="las la-phone"></i>
                        <a href="tel:{{$mainSettings->phone}}">{{$mainSettings->phone}}</a>
                        <span>{{trans('front.offer_contact')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call-to-action end -->
    <!-- Feature Section start -->
{{--    <section class="feature-wrap bg-charcole section-padding sm-pb-0">--}}
{{--        <div class="container">--}}
{{--            <div class="row align-items-center">--}}
{{--                <div class="col-xl-6 col-lg-12">--}}
{{--                    <div class="feature-content">--}}
{{--                        <div class="feature-content-title content-title v5 mt-0">--}}
{{--                            <h2 class="text-white">How Gym Keep Your Body Fit?</h2>--}}
{{--                            <p class="text-white">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna.</p>--}}
{{--                        </div>--}}
{{--                        <div class="feature-box-wrap v2">--}}
{{--                            <div class="feature-box-item">--}}
{{--                                <div class="feature-icon">--}}
{{--                                    <i class="flaticon-balanced-diet"></i>--}}
{{--                                </div>--}}
{{--                                <div class="feature-box-text">--}}
{{--                                    <h5>Jump To Maintaining A Balanced Diet</h5>--}}
{{--                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor Invidunt.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="feature-box-item v1">--}}
{{--                                <div class="feature-icon">--}}
{{--                                    <i class="flaticon-body-scale"></i>--}}
{{--                                </div>--}}
{{--                                <div class="feature-box-text">--}}
{{--                                    <h5>Weight Gain Or Help Maintain Weight Loss</h5>--}}
{{--                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor Invidunt.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-6  col-lg-12">--}}
{{--                    <div class="img-comp-container">--}}
{{--                        <div class="img-comp-slider">--}}
{{--                            <span class="left-arrow las la-angle-right"></span>--}}
{{--                            <span class="right-arrow las la-angle-left"></span>--}}
{{--                        </div>--}}
{{--                        <div class="img-comp-responsive">--}}
{{--                            <div class="img-comp-img">--}}
{{--                                <img src="{{asset('resources/')}}/assets/img/comp-slider-1.png"  alt="Image" />--}}
{{--                            </div>--}}
{{--                            <div class="img-comp-img img-comp-overlay" id="img-comp-overlay">--}}
{{--                                <img src="{{asset('resources/')}}/assets/img/comp-slider-2.png"  alt="Image" />--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- Feature Section end -->
    <!-- BMI Section start -->
{{--    <section class="bmi-wrap v1 bg-f section-padding bmi-bg-1" >--}}
{{--        <div class="overlay op-9 bg-mirage"></div>--}}
{{--        <div class="container pos-rel">--}}
{{--            <div class="section_subtext v4 trans_text">--}}
{{--                <span>BMI</span>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-xl-6 col-lg-6 order-xl-1 order-lg-1 order-md-2 order-2">--}}
{{--                    <div class="content-title v5">--}}
{{--                        <h2 class="text-white">Calculate Your Body Metabolic Rate</h2>--}}
{{--                        <p class="text-white">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et.</p>--}}
{{--                    </div>--}}
{{--                    <div class="bmi-form">--}}
{{--                        <form action="#">--}}
{{--                            <div class="select-gender">--}}
{{--                                <div>--}}
{{--                                    <input type="radio" id="test1" name="radio-group" checked>--}}
{{--                                    <label for="test1">Male</label>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <input type="radio" id="test2" name="radio-group">--}}
{{--                                    <label for="test2">Female</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input type="number" placeholder="Hight / CM">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input type="number" placeholder="Weight / KG">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input type="number" placeholder="Age">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <div class="form-group  mb-0">--}}
{{--                                        <button type="submit">Find Your Current BMI</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-5 offset-xl-1 col-lg-5 offset-lg-1 order-xl-2 order-lg-2 order-md-1 order-1">--}}
{{--                    <div class="bmi-chart-wrap">--}}
{{--                        <div class="content-title v5 text-lg-end text-md-start text-sm-start">--}}
{{--                            <h2 class="text-white">BMI Chart</h2>--}}
{{--                            <p class="text-white">Lorem ipsum dolor , consetetur sadipscing elitr </p>--}}
{{--                        </div>--}}
{{--                        <div class="bmi-chart">--}}
{{--                            <div class="bmi-chart-title">--}}
{{--                                <h6>BMI</h6>--}}
{{--                                <h6>Weight Status</h6>--}}
{{--                            </div>--}}
{{--                            <div class="bmi-chart-data">--}}
{{--                                <p>Below 18.5</p>--}}
{{--                                <p>Severe Thinness</p>--}}
{{--                            </div>--}}
{{--                            <div class="bmi-chart-data">--}}
{{--                                <p>18.5 - 25</p>--}}
{{--                                <p>Healthy</p>--}}
{{--                            </div>--}}
{{--                            <div class="bmi-chart-data">--}}
{{--                                <p>25 - 30</p>--}}
{{--                                <p>Over weight</p>--}}
{{--                            </div>--}}
{{--                            <div class="bmi-chart-data">--}}
{{--                                <p>30 and Above</p>--}}
{{--                                <p>Obese</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- BMI Section end -->
    <!-- Product Section  start -->
    @if(isset($activities) && (count($activities) > 0))

        <section class="product-wrap v2 bg-black section-padding s2" id="activities">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-6">
                    <div class="section-title v2">
                        <h2>{{trans('front.activities')}}</h2>
                    </div>
                </div>
{{--                <div class="col-md-6 sm-none">--}}
{{--                    <div class="text-md-end">--}}
{{--                        <a href="" class="btn v6">{{trans('global.view_all')}}</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <div class="row">
                @foreach($activities as $activity)
                <div class="col-md-4" style="padding-bottom: 10px">
                    <div class="single-product-item">
                        <div class="product-img">
                            <img class="img-fluid" src="{{$activity->image ?? @$record->logo}}" alt="Image">
                            <div class="product-option-wrap">

{{--                                <a href="javascript:void(0)" class="view-product" data-bs-toggle="modal" data-bs-target="#productModal">--}}
{{--                                    <i class="flaticon-visibility"></i>--}}
{{--                                </a>--}}
                            </div>
                        </div>
                        <div class="product-info text-center">
                            <ul class="product-rating">
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star"></i></li>
                                <li><i class="flaticon-star-1"></i></li>
                            </ul>
                            <a href="" class="product-name">{{$activity->name}}</a>
{{--                            <span class="product-price">--}}
{{--                                        {{$activity->price}}--}}
{{--                                    </span>--}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
{{--            <div class="row align-items-center my-1">--}}
{{--                <div class="col-12 lg-none">--}}
{{--                    <div class="text-center">--}}
{{--                        <a href="#" class="btn v6">{{trans('global.view_all')}}</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>
    <!-- Product Section  end -->
    @endif
    <!-- Testimonial  start -->
{{--    <div class="testimonial-wrap v3 bg-f test-bg-2" >--}}
{{--        <div class="overlay op-7 bg-black"></div>--}}
{{--        <div class="testimonial-slider-v3 owl-carousel">--}}
{{--            <div class="item">--}}
{{--                <div class="testimonial-item">--}}
{{--                    <div class="container">--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col-lg-10 offset-lg-1">--}}
{{--                                <div class="testimonial-text">--}}
{{--                                    <div class="quote-img">--}}
{{--                                        <img src="{{asset('resources/')}}/assets/img/quote-3.svg" alt="Image">--}}
{{--                                    </div>--}}
{{--                                    <div class="client-quote">--}}
{{--                                        <p>"Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonu my eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et At vero eos et sed diam Voluptua."</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="client-name">--}}
{{--                                        <p>Alex G. Hansen, Banker, USA</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="item">--}}
{{--                <div class="testimonial-item">--}}
{{--                    <div class="container">--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col-lg-10 offset-lg-1">--}}
{{--                                <div class="testimonial-text">--}}
{{--                                    <div class="quote-img">--}}
{{--                                        <img src="{{asset('resources/')}}/assets/img/quote-3.svg" alt="Image">--}}
{{--                                    </div>--}}
{{--                                    <div class="client-quote">--}}
{{--                                        <p> At vero eos et accusam et At vero eos et sed diam Voluptua."Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonu my eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua."</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="client-name">--}}
{{--                                        <p>Jhon Doe G. Hansen, Teacher, UK</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="item">--}}
{{--                <div class="testimonial-item">--}}
{{--                    <div class="container">--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col-lg-10 offset-lg-1">--}}
{{--                                <div class="testimonial-text">--}}
{{--                                    <div class="quote-img">--}}
{{--                                        <img src="{{asset('resources/')}}/assets/img/quote-3.svg" alt="Image">--}}
{{--                                    </div>--}}
{{--                                    <div class="client-quote">--}}
{{--                                        <p>"Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonu my eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et At vero eos et sed diam Voluptua."</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="client-name">--}}
{{--                                        <p> G. Alexa, Doctor, NY</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="item">--}}
{{--                <div class="testimonial-item">--}}
{{--                    <div class="container">--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col-lg-10 offset-lg-1">--}}
{{--                                <div class="testimonial-text">--}}
{{--                                    <div class="quote-img">--}}
{{--                                        <img src="{{asset('resources/')}}/assets/img/quote-3.svg" alt="Image">--}}
{{--                                    </div>--}}
{{--                                    <div class="client-quote">--}}
{{--                                        <p>"Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonu my eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et At vero eos et sed diam Voluptua."</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="client-name">--}}
{{--                                        <p>Alex G. Hansen, Banker, Usa</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- Testimonial  end -->
    <!-- News Post start -->
{{--    <section class="blog-post-wrap section-padding bg-black">--}}
{{--        <div class="container">--}}
{{--            <div class="row align-items-center mb-5">--}}
{{--                <div class="col-md-7">--}}
{{--                    <div class="section-title v2">--}}
{{--                        <h2 class="title">Latest Blog Post</h2>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-5">--}}
{{--                    <div class="section-brief v2">--}}
{{--                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="blog-item-wrap v2">--}}
{{--                        <div class="blog-item">--}}
{{--                            <div class="blog-img">--}}
{{--                                <img class="img-fluid" src="{{asset('resources/')}}/assets/img/blog/blog-1.jpg" alt="Image">--}}
{{--                                <div class="news-date">--}}
{{--                                    <h4>--}}
{{--                                        28--}}
{{--                                        <span>Jan</span>--}}
{{--                                    </h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="blog-content">--}}
{{--                                <div class="blog-info">--}}
{{--                                    <h5><a class="blog-card-title" href="blog-details-left-sidebar.html">How To Support Your Immune System</a></h5>--}}
{{--                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor Invidunt...</p>--}}
{{--                                    <a href="blog-details-left-sidebar.html" class="btn v2">Learn More</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="blog-item">--}}
{{--                            <div class="blog-img">--}}
{{--                                <img class="img-fluid" src="{{asset('resources/')}}/assets/img/blog/blog-4.jpg" alt="Image">--}}
{{--                                <div class="news-date">--}}
{{--                                    <h4>--}}
{{--                                        29--}}
{{--                                        <span>Jan</span>--}}
{{--                                    </h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="blog-content">--}}
{{--                                <div class="blog-info">--}}
{{--                                    <h5><a class="blog-card-title" href="blog-details-left-sidebar.html">How To Tone Your Body</a></h5>--}}
{{--                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor Invidunt...</p>--}}
{{--                                    <a href="blog-details-left-sidebar.html" class="btn v2">Learn More</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="blog-item">--}}
{{--                            <div class="blog-img">--}}
{{--                                <img class="img-fluid" src="{{asset('resources/')}}/assets/img/blog/blog-5.jpg" alt="Image">--}}
{{--                                <div class="news-date">--}}
{{--                                    <h4>--}}
{{--                                        30--}}
{{--                                        <span>Jan</span>--}}
{{--                                    </h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="blog-content">--}}
{{--                                <div class="blog-info">--}}
{{--                                    <h5><a class="blog-card-title" href="blog-details-left-sidebar.html">Exercise Advice For Over 30's </a></h5>--}}
{{--                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor Invidunt...</p>--}}
{{--                                    <a href="blog-details-left-sidebar.html" class="btn v2">Learn More</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- News Post end -->
    <!-- Time-table banner start -->
    <section class="time-table-banner bg-f tb-bg-1" >
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-7">
                    <div class="content-title v1">
                        <h2 class="text-white">{{trans('front.download_mobile_app')}}</h2>
                        <p class="text-white">{{trans('front.app_content')}}</p>
                    </div>
                    <div class="time-table-btn">
                        <a href="{{$mainSettings->android_app}}" target="_blank" class="btn v12">{{trans('front.android')}}</a>
                        <a href="{{$mainSettings->ios_app}}"  target="_blank" class="btn v12">{{trans('front.ios')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Time-table banner end -->

@endsection

@section('script')

@endsection
