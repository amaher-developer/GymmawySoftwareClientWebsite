@extends('generic::Front.layouts.master')
@section('title'){{ $title }} | @endsection
@section('style')
    <style>
        #login_bg {
            background: url({{asset('resources/assets/front/img/bg/register.jpg')}}) center center no-repeat fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            min-height: 100vh;
            width: 100%;
        }
    </style>
@endsection
@section('content')


    <!-- Features Section Start -->
    <section class="page-title-sec over-layer-black">
        <div id="particles-js"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>{{$title}}</h2>
                    <p><a href="{{route('home')}}">{{trans('front.home')}}</a> / {{$title}}</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Contact Section -->
    <section id="contact" class="contact-sec over-layer-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="default-title text-center">
                        <h2><span> {{$title}} </span></h2>
                        <div class="title-bdr">
                            <div class="title-bdr-inside"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3 col-md-offset-3"></div>
                        <div class="col-md-6  ">
                            <?php if(@$error){?><div class="alert alert-danger"><?php echo @$error?></div><?php } ?>
                            <div class="col-default-mb30">
                                <form method="post" action="login.php?lang=<?php echo $lang ?>">
                                    <input type="hidden" name="csrf" value="{{csrf_token()}}">
                                    <input type="text" name="name" class="form-control"
                                           placeholder="{{trans('front.name')}}" required="">
                                    <input type="text" name="phone" class="form-control"
                                           placeholder="{{trans('front.phone')}}" required="">
                                    <div class="row text-center">
                                        <div class="col-md-1"><input type="radio" name="birthdate" class="form-control" style="height: 20px"
                                                                     placeholder="{{trans('front.birthdate')}}" required=""></div>
                                        <div class="col-md-1">{{trans('front.male')}}</div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-1"><input type="radio" name="birthdate" class="form-control" style="height: 20px"
                                                                     placeholder="{{trans('front.birthdate')}}" required=""></div>
                                        <div class="col-md-1">{{trans('front.female')}}</div>

                                    </div>
                                    <input type="date" name="birthdate" class="form-control"
                                           placeholder="{{trans('front.birthdate')}}" required="">
                                    <input type="text" name="address" class="form-control"
                                           placeholder="{{trans('front.address')}}" required="">
                                    <!--                                <input type="text" class="form-control" placeholder="عدد">-->
                                    <div class="text-center"><button class="btn btn-default simple-btn " name="submit" value="1"
                                                                     type="submit">{{trans('front.register')}}</button></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-3 col-md-offset-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scroll Up -->
    <div class="goto-top-section">
        <span class="triangle"></span>
        <a class="js-scroll-trigger" href="{{route('login')}}#page-top">
            <i class="fa fa-angle-double-up" aria-hidden="true"></i>
        </a>
    </div>



@endsection

