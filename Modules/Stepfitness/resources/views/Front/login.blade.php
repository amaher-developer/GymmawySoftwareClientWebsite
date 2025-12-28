@extends('stepfitness::Front.layouts.master')
@section('title'){{ $title }} | @endsection
@section('style')
    <style>
        #login_bg {
            background: url({{asset('resources/assets/front/img/bg/login_'.$lang.'.jpg')}}) center center no-repeat fixed;
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
                    <h2>{{trans('front.login')}}</h2>
                    <p><a href="{{route('home')}}">{{trans('front.home')}}</a> / {{trans('front.login')}}</p>
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
                        <h2><span> {{trans('front.login')}} </span></h2>
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
                            @if(\Session::has('error'))
                                <div class="alert alert-danger">{!! \Session::get('error') !!}</div>
                            @endif
                            @if(@$error)
                                <div class="alert alert-danger">{{@$error}}</div>
                            @endif
                            <div class="col-default-mb30">
                                <form method="post" action="{{route('loginSubmit')}}">
                                    @csrf
                                    <input type="text" name="phone" class="form-control"
                                           placeholder="{{trans('front.phone')}}" required="">
                                    <input type="number" name="code" class="form-control"
                                           placeholder="{{trans('front.code')}}" required="">
                                    <!--                                <input type="text" class="form-control" placeholder="عدد">-->
                                    <div class="text-center"><button class="btn btn-default simple-btn " name="submit" value="1"
                                                                     type="submit">{{trans('front.login')}}</button></div>
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
@section('script')

@stop
