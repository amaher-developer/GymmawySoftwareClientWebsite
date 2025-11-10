@extends('zonegym::layouts.user_form')
@section('breadcrumb')
    <ul class="page-breadcrumb breadcrumb">
        <li>
            {{ $title }}
        </li>
    </ul>
@endsection

@section('styles')
    <style>
        .maher-dashboard-current-image {
            height: 120px;
            width: 120px;
            object-fit: cover;
        }
    </style>
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{asset('resources/' . $template_version . '/assets/admin/pages/css/pricing.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('form_title') {{ @$title }} @endsection
@section('page_body')



@endsection


