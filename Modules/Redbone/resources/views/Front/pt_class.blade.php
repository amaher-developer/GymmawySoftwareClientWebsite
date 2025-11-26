@extends('redbone::Front.layouts.master')
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
                <div class="col-lg-8">
                    <div class="blog-box">
                        <div class="blog-img">
                            @if($record->image_name)<img src="{{@$record['image']}}" alt="">@endif
                            <div class="blog-date text-left">
                                <ul>
                                    <li><i class="icofont icofont-businessman"></i><a >{{$record['name']}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog-content">
                            <h4>{{$record['name']}} <span style="color: #f97d04;float: left;;font-size: 16px;padding: 10px;background-color: #6c757d26;border-radius: 5px">{{trans('front.price')}}:  {{number_format(($record['price'] + ($record['price'] * (@$mainSettings['vat_details']['vat_percentage']/100))), 2)}}  {{trans('front.pound_unit')}}</span></h4>
                            <p>{{@$record['content']}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="at-sidebar">
                        <div class="at-categories clearfix">
                            <h3 class="at-sedebar-title">{{trans('front.other_subscriptions')}}</h3>
                            <ul>
                                @foreach($pt_classes as $pt_class)
                                        <li>
                                            <a href="{{route('pt-class', ['id' => $pt_class->id])}}">{{$pt_class->name}}</a>
                                        </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')
    <script src="https://checkout.tabby.ai/tabby-card.js"></script>
    <script>
        new TabbyCard({
            selector: '#tabbyCard', // empty div for TabbyCard.
            currency: '{{env("TABBY_CURRENCY")}}', // required, currency of your product. AED|SAR|KWD|BHD|QAR only supported, with no spaces or lowercase.
            lang: 'ar', // Optional, language of snippet and popups.
            price: {{$record['price']}}, // required, total price or the cart. 2 decimals max for AED|SAR|QAR and 3 decimals max for KWD|BHD.
            size: 'wide', // required, can be also 'wide', depending on the width.
            theme: 'black', // required, can be also 'default'.
            header: false // if a Payment method name present already.
        });
    </script>
    <script>
    </script>
@endsection
