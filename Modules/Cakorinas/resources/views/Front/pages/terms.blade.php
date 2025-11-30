@extends('generic::Front.layouts.master')
@section('title'){{ $title }} | @endsection
@section('style')
    <style>
        .img-fluid {
            height: 100%;
            object-fit: cover;
        }

        .hero_in.general:before {
            background: url({{asset('resources/assets/front/img/bg/articles.jpg')}}) center center no-repeat;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .blog-single-sec .blog-content p {
            text-align: right;
        }

        h4, h5 {
            text-align: right;
        }

        .highlight-text {
            border-radius: 10px;
            border: solid 1px #f97d04;
            margin-bottom: 20px !important;
            margin-top: 20px !important;
        }

        .simple-btn-div {
            text-align: right;
        }

        .radio-input {
            height: 30px !important;
        }

        .blog-sec .blog-box {
            border-top: none;
            background: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
        }

        .blog-single-sec .blog-content {
            padding-right: 0px;
        }

        ::placeholder {
            color: #d5d5d5 !important;
            opacity: 1; /* Firefox */
        }

        ::-ms-input-placeholder { /* Edge 12-18 */
            color: #555555;
        }

        #tabbyCard div:first-child{
            background-color: #f5f5f5 !important;
        }
        #tabbyCard {
            padding-top: 20px;
            width: 100%;
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

    <!-- Blog Single Section -->
    <section id="blog" class="blog-sec blog-single-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-box">
                        <div class="blog-content">
                           {!! @$terms !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')

@endsection

