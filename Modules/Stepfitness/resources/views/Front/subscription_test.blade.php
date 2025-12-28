@extends('stepfitness::Front.layouts.master')
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
                        <div class="blog-content">
                            @php
                                $vatPercentage = @$mainSettings['vat_details']['vat_percentage'] ?? 0;
                                $priceBeforeVat = $record['price'];
                                $vatAmount = ($vatPercentage / 100) * $priceBeforeVat;
                                $priceWithVat = $priceBeforeVat + $vatAmount;
                            @endphp
                            <h4>{{$record['name']}}
                                <span style="color: #f97d04;float: left;font-size: 14px;padding: 10px;background-color: #6c757d26;border-radius: 5px;line-height: 1.8;">
                                    {{trans('front.price')}}: {{number_format($priceBeforeVat, 2)}} {{trans('front.pound_unit')}}<br>
                                    @if($vatPercentage > 0)
                                        <small style="font-size: 12px;color: #555;">{{trans('front.vat')}} ({{$vatPercentage}}%): {{number_format($vatAmount, 2)}} {{trans('front.pound_unit')}}</small><br>
                                        <strong>{{trans('global.total')}}: {{number_format($priceWithVat, 2)}} {{trans('front.pound_unit')}}</strong>
                                    @endif
                                </span>
                            </h4>
{{--                            <p>It is a long established fact that a reader </p>--}}
                            <div class="clearfix"><br/></div>
                            @if(\Session::has('error'))
                                <p class="alert alert-danger">{!! \Session::get('error') !!}</p>
                            @endif
                            @if(@$error)<div class="alert alert-danger">{!! @$error !!}</div>@endif


                            <form method="post" action="{{route('invoice', @$record->id)}}">
                                {{csrf_field()}}
                                <input type="hidden" name="subscription_id" value="{{$record['id']}}">
                                <input type="hidden" name="amount" value="{{$record['price']}}">
                                <input type="hidden" name="vat_percentage" value="{{@$mainSettings['vat_details']['vat_percentage']}}">
                            <br/><br/>
                            @if(!$currentUser)
                                <h5>{{trans('front.register_info')}}:</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12  ">
                                                @if(@$error)<div class="alert alert-danger">{{@$error}}</div>@endif
                                                <div class="highlight-text" STYLE="border-color: grey !important;">
                                                        <input type="text" name="name" class="form-control"
                                                               placeholder="{{trans('front.name')}}" required="">
                                                        <input type="text" name="phone" class="form-control"
                                                               placeholder="{{trans('front.phone')}}" required="">
                                                        <div class="row text-center">
                                                            <div class="col-md-1"><input type="radio" name="gender" value="{{\App\Http\Classes\Constants::MALE}}"
                                                                                         class="form-control male"
                                                                                         id="male" style="height: 20px"
                                                                                         required=""></div>
                                                            <div class="col-md-1"><label
                                                                        for="male">{{trans('front.male')}}</label></div>
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-1"><input type="radio" name="gender" value="{{\App\Http\Classes\Constants::FEMALE}}"
                                                                                         class="form-control female"
                                                                                         id="female"
                                                                                         style="height: 20px"
                                                                                         required=""></div>
                                                            <div class="col-md-1"><label
                                                                        for="female">{{trans('front.female')}}</label>
                                                            </div>

                                                        </div>
                                                        <input type="date" name="dob" class="form-control"
                                                               placeholder="{{trans('front.birthdate')}}" required="">
                                                        <input type="text" name="address" class="form-control"
                                                               placeholder="{{trans('front.address')}}" required="">
                                                        <!--                                <input type="text" class="form-control" placeholder="عدد">-->


                                                </div>
                                            </div>
                                            <div class="col-md-3 col-md-offset-3"></div>
                                        </div>
                                    </div>
                                </div>
                                <br/><br>
                            @endif
                            <h5>{{trans('front.choose_payment_methods')}}:</h5>
                            <div class="highlight-text">
                                <div class="row">
                                    <div class="col-md-1">
                                        <input class="form-control radio-input mada" id="mada" type="radio"
                                               name="payment_method" value="1" placeholder="Your name">
                                    </div>

                                    <div class="col-md-11">
                                        <p><label for="mada">{{trans('front.mada_payment_msg')}}</label></p>
                                        <p>
                                            <img style="width: 120px;padding: 10px;margin-top: 20px;border: solid grey 1px;border-radius: 5px"
                                                 src="{{asset('resources/assets/images/visa_logo.svg')}}">

                                            <img style="width: 120px;padding: 10px;margin-top: 20px;border: solid grey 1px;border-radius: 5px"
                                                 src="{{asset('resources/assets/images/mada-logo.svg')}}">


                                            <img style="width: 120px;padding: 10px;margin-top: 20px;border: solid grey 1px;border-radius: 5px"
                                                 src="{{asset('resources/assets/images/american_express_logo.svg')}}">
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="highlight-text">

                                <div class="row">
                                    <div class="col-md-1">
                                        <input class="form-control radio-input tabby" id="tabby" type="radio"
                                               name="payment_method" value="2" placeholder="Your name">
                                    </div>

                                    <div class="col-md-11">
                                        <p><label for="tabby">{{trans('front.tabby_installment_msg')}}</label></p>
                                        <p>
                                            <img style="width: 120px;padding: 10px;margin-top: 20px;border: solid grey 1px;border-radius: 5px"
                                                 src="{{asset('resources/assets/images/tabby-logo.webp')}}">
                                        <span style="font-size: 12px;vertical-align: bottom;">{{trans('front.tabby_policy_msg')}}</span></p>
                                        <div id="tabbyCard" class="row col-md-12 col-xs-12"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 simple-btn-div">
                                <input class="btn btn-default mb-4 simple-btn"
                                        type="submit" value="{{trans('front.pay_now')}}" />
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="at-sidebar">
                        <div class="at-categories clearfix">
                            <h3 class="at-sedebar-title">{{trans('front.other_subscriptions')}}</h3>
                            <ul>
                                @foreach($subscriptions as $subscription)
                                    @if($subscription->id != $record['id'])
                                        <li>
                                            <a href="{{route('subscription', ['id' => $subscription->id])}}">{{$subscription->name}}</a>
                                        </li>
                                    @endif
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
