@extends('software::layouts.form')
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
{!! $response !!}
<form action="http://localhost/gym/gymmawy/ar/save-backup" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <input name="username" type="text" >
    <input value="Submit" type="submit">
</form>

@endsection


