@extends('premier::Front.layouts.master')
@section('style')
<style>
    .thanks-main {
        padding: 40px;
        background: #fff;
        border-radius: 5px;
        margin: 120px 0;
        -webkit-box-shadow: 0px 0px 44px -1px rgb(97, 97, 97, 1);
        -moz-box-shadow: 0px 0px 44px -1px rgb(97, 97, 97, 1);
        box-shadow: 0px 0px 44px -1px rgb(97, 97, 97, 1);
    }

    .thanks-main h3 {
        font-size: 36px;
        font-weight: bold;
        color: #ffc80a;
    }
    .thanks-main img {
        width: 150px;
    }

    .thanks-main p {
        font-weight: 600;
        color: #9fa3a7;
    }
    .all_content {
        background-color: rgba(50,50,50,0.7);
        overflow-x: hidden;
    }
    .dima-navbar-wrap.desk-nav .dima-navbar nav .dima-nav {
        display: none !important;
    }
    .mobile-nav.dima-navbar-wrap .dima-navbar nav .dima-nav{
        display: none !important;
    }
    .dima-center-full  {
        display: none !important;
    }
</style>
@endsection
@section('content')



    <div class="container row">

        <div class="col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1 col-xs-12 thanks-main text-center">
            <img src="{{asset('resources/assets/front/images/thanks.png')}}">
            <h3 style="padding-top: 20px">{{trans('front.thank_you')}}</h3>
{{--            <p>{{trans('front.thank_you_message')}}</p>--}}
            <div class="clearfix" style="padding-top: 20px"></div>
{{--            <h4><a href="{{route('login')}}" >{{trans('global.login_system')}}</a></h4>--}}
            <p><a href="{{route('home')}}">{{trans('global.home')}}</a></p>

        </div>

    </div>










@endsection

@section('style')



@endsection

@section('script')


    @endsection

