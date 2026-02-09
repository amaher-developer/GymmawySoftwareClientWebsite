@extends('cakorinas::Front.layouts.master')
@section('title'){{ $title }} | @endsection
@section('style')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.min.css">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Raleway:400,700,600);
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji" !important;
        }

        .success-container{
            padding: 20px;
        }
        .success-body{
            background-color: #f6f4f4;
            font-family: 'Raleway', sans-serif;
        }
        .teal{
            background-color: #21ba45 !important;
            color: #ffffff !important;
        }
        .teal:hover{
            background-color: #16ab39 !important;
        }

        .message{
            text-align: @if($lang == 'ar') right @else left @endif;
        }
        .price1{
            font-size: 40px;
            font-weight: 200;
            display: block;
            text-align: center;
        }
        .ui.message p {margin: 5px;}
        .success-icon {
            color: #21ba45;
            font-size: 48px;
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('content')

    <!-- Page title -->
    <section class="page-title-sec over-layer-black">
        <div id="particles-js"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>{{$title}}</h2>
                    <p><a href="{{route('home')}}">{{trans('front.home')}}</a> / <a href="#">{{$title}}</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Section -->
    <section id="blog" class="blog-sec blog-single-sec success-body">
        <div class="invoice-box">

            <div class="success-body">
                <div class="success-container">
                    <div class="ui middle aligned center aligned grid">
                        <div class="ui eight wide column">

                            <form class="ui large form">

                                <div class="ui icon positive message">
                                    <i class="check circle icon" style="margin-left: 0.6em !important;"></i>
                                    <div class="content">
                                        <div class="header">
                                            {{trans('front.payment_success_title')}}
                                        </div>
                                        <p>
                                            {{trans('front.payment_success_msg')}}
                                        </p>
                                    </div>

                                </div>

                                @if($invoice_id)
                                    <a href="{{route('invoice', ['id' => $invoice_id])}}">
                                        <span class="ui large teal submit fluid button">{{trans('front.view_invoice')}}</span>
                                    </a>
                                    <br><br>
                                @endif

                                <a href="{{route('home')}}">
                                    <span class="ui large basic button fluid">{{trans('front.back_to_home')}}</span>
                                </a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


@endsection
@section('script')

@endsection
