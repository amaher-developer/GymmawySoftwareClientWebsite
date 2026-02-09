@extends('cakorinas::Front.layouts.master')
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
            text-align: {{ $lang == 'ar' ? 'right' : 'left' }};
        }

        h4, h5 {
            text-align: {{ $lang == 'ar' ? 'right' : 'left' }} !important;
        }

        .highlight-text {
            border-radius: 10px;
            border: solid 1px #f97d04;
            margin-bottom: 20px !important;
            margin-top: 20px !important;
            direction: {{ $lang == 'ar' ? 'rtl' : 'ltr' }};
            text-align: {{ $lang == 'ar' ? 'right' : 'left' }};
        }

        .simple-btn-div {
            text-align: {{ $lang == 'ar' ? 'right' : 'left' }};
        }

        .radio-input {
            height: 30px !important;
        }

        .blog-sec .blog-box {
            border-top: none;
            background: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
            direction: {{ $lang == 'ar' ? 'rtl' : 'ltr' }};
            text-align: {{ $lang == 'ar' ? 'right' : 'left' }};
        }

        .blog-single-sec .blog-content {
            {{ $lang == 'ar' ? 'padding-right' : 'padding-left' }}: 0px;
        }

        ::placeholder {
            color: #d5d5d5 !important;
            opacity: 1; /* Firefox */
        }

        ::-ms-input-placeholder { /* Edge 12-18 */
            color: #555555;
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
                            <h4>{{$record['name']}} <span style="color: #f97d04;float: {{ $lang == 'ar' ? 'left' : 'right' }};font-size: 16px;padding: 10px;background-color: #6c757d26;border-radius: 5px">{{trans('front.price')}}: {{$record['price']}} {{trans('front.pound_unit')}}</span></h4>
{{--                            <p>It is a long established fact that a reader </p>--}}
                            <div class="clearfix"><br/></div>
                            @if(\Session::has('error'))
                                <p class="alert alert-danger">{!! \Session::get('error') !!}</p>
                            @endif
                            @if(@$error)<div class="alert alert-danger">{!! @$error !!}</div>@endif


                            <form method="post" action="{{route('invoice-payment', @$record->id)}}">
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
                                                        <input type="email" name="email" class="form-control"
                                                               placeholder="{{trans('front.email')}}" required="">
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

                            <h5>{{trans('front.start_date')}}:</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="highlight-text" style="border-color: grey !important;">
                                        <input type="date" name="start_date" class="form-control"
                                               placeholder="{{trans('front.start_date')}}"
                                               min="{{\Carbon\Carbon::now()->toDateString()}}"
                                               max="{{\Carbon\Carbon::now()->addMonth()->toDateString()}}"
                                               value="{{\Carbon\Carbon::now()->toDateString()}}"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <br/><br>

                            <h5>{{trans('front.choose_payment_methods')}}:</h5>

                            <!-- Paymob Payment Option (Egypt) -->
                            <div class="highlight-text">
                                <div class="row">
                                    <div class="col-md-1">
                                        <input class="form-control radio-input paymob" id="paymob" type="radio"
                                               name="payment_method" value="{{\App\Http\Classes\Constants::PAYMOB}}" required checked>
                                    </div>

                                    <div class="col-md-11">
                                        <p><label for="paymob" style="font-weight: bold; font-size: 16px; color: #333;">
                                            {{trans('front.paymob_payment_msg')}}
                                        </label></p>
                                        <p style="margin-bottom: 15px;">
                                            <span style="font-size: 14px; color: #666;">{{trans('front.paymob_description')}}</span>
                                        </p>
                                        <p>
                                            <img style="width: 140px; height: 50px; padding: 10px; margin-left: 10px; background: white; border: solid 2px #e0e0e0; border-radius: 8px; object-fit: contain;"
                                                 src="{{asset('resources/assets/images/paymob.png')}}"
                                                 alt="Paymob">
                                            <img style="width: 100px; height: 50px; padding: 10px; margin-left: 10px; background: white; border: solid 2px #e0e0e0; border-radius: 8px; object-fit: contain;"
                                                 src="{{asset('resources/assets/images/visa_logo.svg')}}"
                                                 alt="Visa">
                                            <img style="width: 100px; height: 50px; padding: 10px; margin-left: 10px; background: white; border: solid 2px #e0e0e0; border-radius: 8px; object-fit: contain;"
                                                 src="{{asset('resources/assets/images/mastercard-logo.svg')}}"
                                                 alt="Mastercard">
                                        </p>
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
    <script>
    </script>
@endsection
