@extends('almadagym::Front.layouts.master')
@section('title'){{ $title }} | @endsection
@section('style')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.min.css">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Raleway:400,700,600);
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji" !important;
        }

        .error-container{
            padding: 20px;
        }
        .error-body{
            background-color: #f6f4f4;
            font-family: 'Raleway', sans-serif;
        }
        .teal{
            background-color: #ffc952 !important;
            color: #444444 !important;
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
    </style>
@endsection

@section('content')

    <!-- Blog Single Section -->
    <section id="blog" class="blog-sec blog-single-sec error-body">
        <div class="invoice-box">

            <div class="error-body">
                <div class="error-container">
                    <div class="ui middle aligned center aligned grid">
                        <div class="ui eight wide column">

                            <form class="ui large form">

                                <div class="ui icon negative message">
                                    <i class="warning icon" style="margin-left: 0.6em !important;"></i>
                                    <div class="content">
                                        <div class="header">
                                            {{trans('front.error_title_msg')}}
                                        </div>
                                        <p>
                                            {{trans('front.tabby_error_cancel_body_msg')}}
                                        </p>
                                    </div>

                                </div>

                                <a href="{{route('home')}}"> <span class="ui large teal submit fluid button">{{trans('front.try_again')}}</span></a>

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
