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

        .blog-single-sec .blog-content p{
            text-align: right;
        }
        h4, h5{
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
        .blog-single-sec .blog-content{
            padding-right: 0px;
        }

    </style>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            color: #555;
        }


        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }


        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        @if($lang == 'ar')
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        /** RTL **/
        .invoice-box.rtl {
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: right;
        }
        section {
            direction: rtl;
        }
        .title {
            text-align: right !important;
        }
        .invoice-box table tr.heading td{
            text-align: right !important;
        }
        .invoice-box table tr.item td{
            text-align: right !important;
        }
        .invoice-box table tr.details td{
            text-align: right !important;
        }
        .total {
            text-align: right;
        }
        @else
            .information table tr td:nth-child(1) {
            text-align: right;
        }
        @endif

        .total_for_price {
            color: gray;
            font-size: 12px;
        }
    </style>

@endsection

@section('content')

    <!-- Blog Single Section -->
    <section id="blog" class="blog-sec blog-single-sec">
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title " >
                                <img src="{{asset('resources/' . env('TEMPLATE_NUM', '') . '/assets/images/logo.png')}}"style="width: 100%; max-width: 200px;"/>
                            </td>
                            <td>
                                <br/><br/>
                                <b>{{trans('front.invoice')}}</b> #: {{@$invoice->id}}<br />
                                <b>{{trans('front.date')}}</b>: <i
                                        class="fa fa-calendar text-muted"></i> {{ \Carbon\Carbon::parse($invoice->created_at ?? @$invoice->updated_at)->format('Y-m-d') }} <i
                                        class="fa fa-clock-o text-muted"></i> {{ \Carbon\Carbon::parse($invoice->created_at ?? @$invoice->updated_at)->format('h:i a') }}<br />
{{--                                Due: February 1, 2023--}}
                            </td>

                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <b>{{trans('front.buyer_name')}}:</b><br />
{{--                                12345 Sunny Road<br />--}}
{{--                                Sunnyville, CA 12345--}}
                            </td>

                            <td>
                                {{@$invoice->member->name}}<br />
{{--                                John Doe<br />--}}
{{--                                john@example.com--}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>


            <tr class="heading">
                <td>{{trans('front.subscription_contract_details')}}</td>

                <td>{{trans('front.total_price')}}</td>
            </tr>

            <tr class="item">
                <td>{{trans('front.member_moneybox_add_msg', ['member'=> @$invoice->member->name, 'subscription' => @$invoice->subscription->name .((@$invoice->joining_date && @$invoice->expire_date) ? ' ( '.\Carbon\Carbon::parse($invoice->joining_date)->toDateString().' ~ '.\Carbon\Carbon::parse($invoice->expire_date)->toDateString().' ) ' : ' '), 'amount_paid' => @$invoice->amount_paid, 'amount_remaining' => @$invoice->amount_remaining])}}
                    @if(@$invoice->discount_value) {{ trans('sw.discount_msg', ['value' => $invoice->discount_value])}} @endif</td>

                <td>{{($invoice->amount_paid)}} {{@trans('front.app_currency')}}</td>
            </tr>

            <tr class="total" >
            <td><br/></td>
            </tr>


            <table>
                <tr>
                    <td>
                        <table>
                            <tr class="total" >
                                <td style="font-size: 18px">{{trans('front.total_price')}} <span class="total_for_price">({{trans('front.excluding_vat')}})</span>:  {{number_format(($invoice->amount_paid + @$invoice->amount_remaining - @$invoice->vat),2)}} {{@trans('front.app_currency')}}</td>
                            </tr>
                            <tr class="total" >
                                <td style="font-size: 18px">{{trans('front.total_price')}} <span class="total_for_price">({{trans('front.including_vat')}})</span>: {{number_format(($invoice->amount_paid + @$invoice->amount_remaining),2)}} {{@trans('front.app_currency')}}</td>
                            </tr>

                            <tr class="total" >
                                <td style="font-size: 18px">{{trans('front.vat')}} <span class="total_for_price">({{@$mainSettings->vat_details['vat_percentage'].'%'}})</span>: {{@number_format($invoice->vat, 2)}} {{@trans('front.app_currency')}}</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <div class="col-xs-3">
                            @if(@$qr_img_invoice)
                                <div>
                                    <img style="width: 100px !important;" class="well" src="{{asset($qr_img_invoice)}}"/>
                                </div>
                            @endif
                        </div>

                    </td>
                </tr>

            </table>
        </table>
    </div>
    </section>
@endsection
@section('script')

@endsection
