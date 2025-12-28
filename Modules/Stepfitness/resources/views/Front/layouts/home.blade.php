@extends('stepfitness::Front.layouts.master')
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
            <div class="pogoSlider-slide" data-transition="shrinkReveal" data-duration="1000" style="background-image:url({{env('APP_URL_MASTER').'uploads/settings/gyms/'.$cover_image}});">
                <!-- Slider Elements -->
                <div class="silder-elements">
                    <h2 class="pogoSlider-slide-element slider-main-title" data-in="slideDown" data-out="slideUp" data-duration="750" data-delay="500"> <span class="invisible-mobile ">{{$mainSettings['name']}}</span></h2>
                    <!--                <p class="pogoSlider-slide-element slider-para" data-in="slideUp" data-out="slideUp" data-duration="1500" data-delay="500">اللياقة ضرورية لكل إنسان</p>-->
                    <a href="#contact" class="btn btn-default pogoSlider-slide-element join-btn" data-in="expand" data-out="slideUp" data-duration="1500" data-delay="500" type="submit">{{trans('front.join_us')}}</a>
                </div>
            </div>
        @endforeach
        <!--        <div class="pogoSlider-slide" data-transition="shrinkReveal" data-duration="1000" style="background-image:url(images/rtl-images/slider/2.jpg);">-->
            <!---->
            <!--            <div class="silder-elements">-->
            <!--                <h2 class="pogoSlider-slide-element slider-main-title" data-in="slideDown" data-out="slideUp" data-duration="750" data-delay="500">كن قويا مع  <span>Fitme</span></h2>-->
            <!--                <p class="pogoSlider-slide-element slider-para" data-in="slideUp" data-out="slideUp" data-duration="1500" data-delay="500">اللياقة البدنية ضرورية لكل إنسان</p>-->
            <!--                <button class="btn btn-default pogoSlider-slide-element join-btn" data-in="expand" data-out="slideUp" data-duration="1500" data-delay="500" type="submit">انضم إلينا</button>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        <div class="pogoSlider-slide" data-transition="shrinkReveal" data-duration="1000" style="background-image:url(images/rtl-images/slider/3.jpg);">-->

            <!--            <div class="silder-elements">-->
            <!--                <h2 class="pogoSlider-slide-element slider-main-title" data-in="slideDown" data-out="slideUp" data-duration="750" data-delay="500">كن قويا مع  <span>Fitme</span></h2>-->
            <!--                <p class="pogoSlider-slide-element slider-para" data-in="slideUp" data-out="slideUp" data-duration="1500" data-delay="500">اللياقة البدنية ضرورية لكل إنسان</p>-->
            <!--                <button class="btn btn-default pogoSlider-slide-element join-btn" data-in="expand" data-out="slideUp" data-duration="1500" data-delay="500" type="submit">انضم إلينا</button>-->
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
    <!--                            <h3>رفع الاثقال</h3>-->
    <!--                            <p>اجعل جسمك لائقًا</p>-->
    <!--                        </div>-->
    <!--                        <div class="features-content">-->
    <!--                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل </p>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-lg-4 col-md-6 animated bounceInUp slow delay-250">-->
    <!--                <div class="features-col col-default-mb30">-->
    <!--                    <div class="features-img">-->
    <!--                        <img src="images/rtl-images/features/2.jpg" alt="">-->
    <!--                        <div class="features-title">-->
    <!--                            <h3>تدريب اليوجا</h3>-->
    <!--                            <p>اجعل جسمك لائقًا</p>-->
    <!--                        </div>-->
    <!--                        <div class="features-content">-->
    <!--                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل </p>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-lg-4 col-md-6 animated bounceInUp slow delay-500">-->
    <!--                <div class="features-col col-default-mb30">-->
    <!--                    <div class="features-img">-->
    <!--                        <img src="images/rtl-images/features/3.jpg" alt="">-->
    <!--                        <div class="features-title">-->
    <!--                            <h3>تدريب كروس فيت</h3>-->
    <!--                            <p>اجعل جسمك لائقًا</p>-->
    <!--                        </div>-->
    <!--                        <div class="features-content">-->
    <!--                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل </p>-->
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
                        <!--                    <p>حافظ على جسمك لائقًا وقويًا</p>-->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="about-col">
                        <!--                    <h3>تعرف على  Fitme</h3>-->
                        <!--                    <p>ناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال </p>-->

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
    <!--                    <h2>لنا <span>الدورات</span></h2>-->
    <!--                    <div class="title-bdr">-->
    <!--                        <div class="title-bdr-inside"></div>-->
    <!--                    </div>-->
    <!--                    <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. </p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="row">-->
    <!--            <div class="col-md-12">-->
    <!--                <div class="courses-carousel-rtl" data-slick='{"slidesToShow": 3, "slidesToScroll": 1}'>-->
    <!--                    <div class="item courses-item">-->
    <!--                        <img src="images/rtl-images/courses/1.jpg" alt="">-->
    <!--                        <div class="amount">-->
    <!--                            <p>رسوم الدورة 49 دولار</p>-->
    <!--                        </div>-->
    <!--                        <div class="duration">-->
    <!--                            <p>لمدة 3 اشهر</p>-->
    <!--                        </div>-->
    <!--                        <div class="courses-content">-->
    <!--                            <h4>يوجا مثالية</h4>-->
    <!--                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك</p>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="item courses-item">-->
    <!--                        <img src="images/rtl-images/courses/2.jpg" alt="">-->
    <!--                        <div class="amount">-->
    <!--                            <p>رسوم الدورة 49 دولار</p>-->
    <!--                        </div>-->
    <!--                        <div class="duration">-->
    <!--                            <p>لمدة 3 اشهر</p>-->
    <!--                        </div>-->
    <!--                        <div class="courses-content">-->
    <!--                            <h4>ممارسة الجري</h4>-->
    <!--                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك</p>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="item courses-item">-->
    <!--                        <img src="images/rtl-images/courses/3.jpg" alt="">-->
    <!--                        <div class="amount">-->
    <!--                            <p>رسوم الدورة 49 دولار</p>-->
    <!--                        </div>-->
    <!--                        <div class="duration">-->
    <!--                            <p>لمدة 3 اشهر</p>-->
    <!--                        </div>-->
    <!--                        <div class="courses-content">-->
    <!--                            <h4>ممارسة الزومبا</h4>-->
    <!--                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك</p>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="item courses-item">-->
    <!--                        <img src="images/rtl-images/courses/4.jpg" alt="">-->
    <!--                        <div class="amount">-->
    <!--                            <p>رسوم الدورة 49 دولار</p>-->
    <!--                        </div>-->
    <!--                        <div class="duration">-->
    <!--                            <p>لمدة 3 اشهر</p>-->
    <!--                        </div>-->
    <!--                        <div class="courses-content">-->
    <!--                            <h4>تدريب اللياقة البدنية</h4>-->
    <!--                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك</p>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="item courses-item">-->
    <!--                        <img src="images/rtl-images/courses/5.jpg" alt="">-->
    <!--                        <div class="amount">-->
    <!--                            <p>رسوم الدورة 49 دولار</p>-->
    <!--                        </div>-->
    <!--                        <div class="duration">-->
    <!--                            <p>لمدة 3 اشهر</p>-->
    <!--                        </div>-->
    <!--                        <div class="courses-content">-->
    <!--                            <h4>رفع الاثقال</h4>-->
    <!--                            <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك</p>-->
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
    <!--                    <h2>  <span>مدربينا</span></h2>-->
    <!--                    <div class="title-bdr">-->
    <!--                        <div class="title-bdr-inside"></div>-->
    <!--                    </div>-->
    <!--                    <p>لدينا افضل المدربين وامهرهم علي الاطلاق</p>-->
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
    <!--                            <h4>جون نيلسون</h4>-->
    <!--                            <p>منشئ الجسم</p>-->
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
    <!--                            <h4>كريستينا ليو</h4>-->
    <!--                            <p>مدرب يوجا</p>-->
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
    <!--                            <h4>جوليو نيلسون</h4>-->
    <!--                            <p>مدرب لياقة</p>-->
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
    <!--                            <h4>أليستر جيكسون</h4>-->
    <!--                            <p>رفع الاثقال</p>-->
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
    <!--                            <h4>نيكولاس سينس</h4>-->
    <!--                            <p>مدرب الجري</p>-->
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
                        <h5{{$activity->name}}</h5>
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
                        <!--                    <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص.</p>-->
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
                            @php
                                $vatPercentage = @$mainSettings['vat_details']['vat_percentage'] ?? 0;
                                $priceBeforeVat = $subscription->price;
                                $vatAmount = ($vatPercentage / 100) * $priceBeforeVat;
                                $priceWithVat = $priceBeforeVat + $vatAmount;
                            @endphp
                            <h3>{{number_format($priceBeforeVat, 2)}} {{trans('front.pound_unit')}}</h3>
                            @if($vatPercentage > 0)
                                <small style="font-size: 12px;color: #999;">+ {{trans('front.vat')}} ({{$vatPercentage}}%): {{number_format($vatAmount, 2)}} {{trans('front.pound_unit')}}</small><br>
                                <strong style="font-size: 14px;">{{trans('global.total')}}: {{number_format($priceWithVat, 2)}} {{trans('front.pound_unit')}}</strong>
                                <br>
                            @endif
                            <br>
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
    <!--                    <h2>لنا <span>مقالات</span></h2>-->
    <!--                    <div class="title-bdr">-->
    <!--                        <div class="title-bdr-inside"></div>-->
    <!--                    </div>-->
    <!--                    <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص.</p>-->
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
    <!--                                <li><i class="icofont icofont-businessman"></i><a href="#">مارك جونسون</a>-->
    <!--                                </li>-->
    <!--                                <li><i class="icofont icofont-calendar"></i><a href="#">20 ديسمبر, 2021</a>-->
    <!--                                </li>-->
    <!--                            </ul>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="blog-content">-->
    <!--                        <h4><a href="blog-single.html">هذا هو عنوان المدونة</a></h4>-->
    <!--                        <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. </p>-->
    <!--                        <a class="btn btn-primary simple-btn" href="blog-single.html" role="button">اقرأ أكثر</a>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-lg-4 col-md-6 animated bounceInUp slow delay-250">-->
    <!--                <div class="blog-box col-default-mb30 animated fadeInUpShort slow delay-250">-->
    <!--                    <div class="blog-img">-->
    <!--                        <img src="images/rtl-images/blog/2.jpg" alt="">-->
    <!--                        <div class="blog-date">-->
    <!--                            <ul>-->
    <!--                                <li><i class="icofont icofont-businessman"></i><a href="#">توماس روي</a>-->
    <!--                                </li>-->
    <!--                                <li><i class="icofont icofont-calendar"></i><a href="#">21 ديسمبر, 2021</a>-->
    <!--                                </li>-->
    <!--                            </ul>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="blog-content">-->
    <!--                        <h4><a href="blog-single.html">هذا هو عنوان المدونة</a></h4>-->
    <!--                        <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. </p>-->
    <!--                        <a class="btn btn-primary simple-btn" href="blog-single.html" role="button">اقرأ أكثر</a>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-lg-4 col-md-6 animated bounceInUp slow delay-500">-->
    <!--                <div class="blog-box col-default-mb30 animated fadeInUpShort slow delay-500">-->
    <!--                    <div class="blog-img">-->
    <!--                        <img src="images/rtl-images/blog/3.jpg" alt="">-->
    <!--                        <div class="blog-date">-->
    <!--                            <ul>-->
    <!--                                <li><i class="icofont icofont-businessman"></i><a href="#">نيلسون مونيكا</a>-->
    <!--                                </li>-->
    <!--                                <li><i class="icofont icofont-calendar"></i><a href="#">22  ديسمبر, 2021</a>-->
    <!--                                </li>-->
    <!--                            </ul>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="blog-content">-->
    <!--                        <h4><a href="blog-single.html">هذا هو عنوان المدونة</a></h4>-->
    <!--                        <p>هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. </p>-->
    <!--                        <a class="btn btn-primary simple-btn" href="blog-single.html" role="button">اقرأ أكثر</a>-->
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
                                    <!--                                <input type="text" class="form-control" placeholder="عدد">-->
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
