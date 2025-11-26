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
    <!-- Breadcrumb  start -->
    <section class="breadcrumb-wrap bg-f br-bg-2">
        <div class="section_subtext v3 trans_text"><span>{{$title}}</span></div>
        <div class="overlay bg-charcole op-8"></div>
        <div class="breadcrumb-title">
            <h2>{{$title}}</h2>
        </div>
    </section>
    <!-- Breadcrumb  end -->

    <!-- Join class start -->
    <section class="join-class-wrap bmi-wrap v1 section-padding">
        <div class="container">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6 col-md-12 col-12 order-lg-1 order-md-2 order-2">
                    <div class="content-title v2 mb-40">
                        <h2>{{$title}}</h2>
                        <p>{{$record->content}}</p>
                    </div>
                    @if(\Session::has('error'))
                        <p class="alert alert-danger">{!! \Session::get('error') !!}</p>
                    @endif

                    @if(\Session::has('message'))
                        <p class="alert alert-success">{!! \Session::get('message') !!}</p>
                    @else
                        <form method="post" action="{{route('reservation', @$record->id)}}" class="membership-form">
                            {{csrf_field()}}

                            <input type="hidden" name="subscription_id" value="{{$record['id']}}">
                            <input type="hidden" name="amount" value="{{$record['price']}}">
                            <input type="hidden" name="gender" value="{{\App\Http\Classes\Constants::FEMALE}}"/>
                            <input type="hidden" name="vat_percentage" value="{{@$mainSettings['vat_details']['vat_percentage']}}">
                            <br/><br/>
                        <div class="form-group">
                            <input type="text"  name="name"
                                   placeholder="{{trans('front.name')}}" required="">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone"
                                   placeholder="{{trans('front.phone')}}" required="">
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <input type="text" placeholder="Contact Number">--}}
{{--                        </div>--}}
                        <button type="submit" class="btn v14 d-block w-100">{{trans('front.reserve')}}</button>
                    </form>
                        @endif
                </div>
                <div class="col-lg-6 col-md-12 col-12 order-lg-2 order-md-1 order-1">
                    <div class="join-class-bg bg-f" style="background-image: url({{$record->image ?? $mainSettings->logo}});">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Join class end -->

    <!-- Related class slider start -->
    <section class="related-class-wrap section-padding_v4">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-7">
                    <div class="section-title v1">
                        <h2 class="title">{{trans('front.other_subscriptions')}}</h2>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="section-brief text-start">
{{--                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore.</p>--}}
                    </div>
                </div>
            </div>
            <div class="row class-wrap v3">
                <div class="col-md-12">
                    <div class="product-slider-v1 owl-carousel">
                        @foreach($subscriptions as $subscription)
                            @if($subscription->id != $record['id'])
                        <div class="item">
                            <div class="class-item s1 mb-0">
                                <div class="">
                                    <img class="img-fluid" src="{{$subscription->image ?? $mainSettings->logo}}" alt="Image">
                                </div>
                                <div class="class-info">
                                    <a href="{{route('subscription', ['id' => $subscription->id])}}">{{$subscription->name}}</a>
                                    <p>{{@$subscription->content}}</p>

                                </div>
                            </div>
                        </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related class slider end -->















@endsection
@section('script')

@endsection
