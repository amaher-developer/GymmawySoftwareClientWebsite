@extends('premier::Front.layouts.master')
@section('style')
    <style>
        .one-line {
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

        .page-title-sec {
            padding: 180px 0 100px;
            background: url(https://www.rajibweb.com/html/fitme/images/bg/1.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .blog-single-sec{
            padding-top: 0px;
        }
        .card-body hr:last-child {
            display: none;
        }
        .text-green {
            color: white;
            background-color: green;
            border: 1px solid;
            border-radius: 20%;
            padding: 2px;
        }
        .text-red {
            color: white;
            background-color: red;
            border: 1px solid;
            border-radius: 20%;
            padding: 2px;
        }

        .i-profile {
            color: black !important;
        }



        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap");


    </style>

@stop
@section('content')



    <!-- Features Section Start -->
    <section class="page-title-sec over-layer-black">
        <div id="particles-js"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>{{trans('front.profile')}}</h2>
                    <p><a href="{{route('home')}}">{{trans('front.home')}}</a> / {{trans('front.profile')}}</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Blog Single Section -->
    <section id="blog" class="blog-sec blog-single-sec">
        <div class="container">
            <div class="row">
                <section class="col-lg-12">
                    <div class="container py-5">
                        <!--                    <div class="row">-->
                        <!--                        <div class="col">-->
                        <!--                            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">-->
                        <!--                                <ol class="breadcrumb mb-0">-->
                        <!--                                    <li class="breadcrumb-item"><a href="#">--><?php //echo $trans['home']?><!--</a></li>-->
                        <!--                                    <li class="breadcrumb-item active" aria-current="page">--><?php //echo $trans['profile']?><!--</li>-->
                        <!--                                </ol>-->
                        <!--                            </nav>-->
                        <!--                        </div>-->
                        <!--                    </div>-->

                        <div class="row col-xs-12">
                        </div>

                        <div class="row">
                            <div class="col-lg-4">

                                <div >
                                    <?php //include '__menu_profile2.php'?>
                                </div>
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <img src="<?php echo @$currentUser->image?>" alt="avatar"
                                             class="rounded-circle img-fluid" style="width: 150px;height: 150px;object-fit: cover">
                                        <h5 class="my-3"><?php echo @$currentUser->name?></h5>
                                        <p class="text-muted mb-1"><?php echo @$currentUser->code?></p>
                                        <p class="text-muted mb-4"><img src="<?php echo @$currentUser->code_url?>"></p>

                                        <div class="d-flex justify-content-center mb-2" >
                                            <a href="{{route('logout')}}" style="color: lightgray">{{trans('front.logout')}}</a>
                                        </div>
                                    </div>
                                </div>
                                <!--                            <div class="card mb-4 mb-lg-0">-->
                                <!--                                --><?php //include '__menu_profile.php'?>
                            <!--                            </div>-->
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{trans('front.name')}}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo @$currentUser->name?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php if(@$currentUser->email){ ?>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{trans('front.email')}}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo @$currentUser->email?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php } ?>
                                        <?php if(@$currentUser->phone){ ?>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{trans('front.phone')}}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo @$currentUser->phone?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php } ?>
                                        <?php if(@$currentUser->address){ ?>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{trans('front.address')}}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo @$currentUser->address?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mb-4 mb-md-0">
                                            <div class="card-body">
                                                <p class="mb-4">{{trans('front.my_subscription')}}
                                                    <?php
                                                    $date = date_create(@$currentUser->expire_date);
                                                    $date =  date_format($date, 'U');
                                                    if($date > time()){ ?>
                                                    <span class="text-green font-italic me-1">{{trans('front.active')}}</span>
                                                    <?php }else{ ?>
                                                    <span class="text-red font-italic me-1">{{trans('front.expired')}}</span>
                                                    <?php } ?>
                                                </p>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">{{trans('front.subscription')}}</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo @$currentUser->subscription_name?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <?php if(@$currentUser->joining_date){ ?>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">{{trans('front.joining_date')}}</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo date('Y-m-d', strtotime(@$currentUser->joining_date))?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <?php } ?>
                                                <?php if(@$currentUser->expire_date){ ?>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">{{trans('front.expire_date')}}</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo date('Y-m-d', strtotime(@$currentUser->expire_date))?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <?php } ?>

                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">{{trans('front.amount_paid')}}</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo @$currentUser->amount_paid?></p>
                                                    </div>
                                                </div>
                                                <hr>

                                                <?php if(@$currentUser->amount_remaining){ ?>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">{{trans('front.amount_remaining')}}</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo round(@$currentUser->amount_remaining,2)?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <?php } ?>
                                                <?php if(@$currentUser->attendees_count){ ?>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">{{trans('front.attendances')}}</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo @$currentUser->attendees_count?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </section>
    <!-- Scroll Up -->
    <div class="goto-top-section">
        <span class="triangle"></span>
        <a class="js-scroll-trigger" href="{{route('showProfile')}}#page-top">
            <i class="fa fa-angle-double-up" aria-hidden="true"></i>
        </a>
    </div>





@endsection

@section('script')
@stop
