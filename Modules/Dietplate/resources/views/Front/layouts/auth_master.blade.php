<!DOCTYPE html>
<!--[if IE 8]> <html lang="{{app()->getLocale('lang')}}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="{{app()->getLocale('lang')}}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{app()->getLocale('lang')}}" @if(app()->getLocale('lang')=='ar') dir="rtl" @endif>
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>{{$mainSettings->name}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="{{$mainSettings->description}}" name="description"/>
    <meta content="{{$mainSettings->name}}" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="{{asset('resources/assets/admin/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('resources/assets/admin/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('resources/assets/admin/global/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('resources/assets/admin/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{asset('resources/assets/admin/global/plugins/select2/select2.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('resources/assets/admin/pages/css/login3-rtl.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{asset('resources/assets/admin/global/css/components-rtl.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('resources/assets/admin/global/css/plugins-rtl.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('resources/assets/admin/layouts/layout3/css/layout-rtl.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('resources/assets/admin/layouts/layout3/css/themes/default-rtl.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="{{asset('resources/assets/admin/layouts/layout3/css/custom-rtl.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="{{asset('resources/assets/front/images/favicon.ico')}}"/>
    @yield('style')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="{{route('login')}}">
        <img src="{{$mainSettings->logo_white}}" alt=""/>
    </a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->

@yield('content')


<!-- BEGIN COPYRIGHT -->
<div class="copyright">
    {{date('Y')}}
    &copy; <a target="_blank" href="{{route('home')}}">{{$mainSettings->name}}</a>

</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{asset('resources/assets/admin/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('resources/assets/admin/global/plugins/excanvas.min.js')}}"></script>
<![endif]-->
<script src="{{asset('resources/assets/admin/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/admin/global/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/admin/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/admin/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/admin/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('resources/assets/admin/global/plugins/jquery-validation/js/jquery.validate.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('resources/assets/admin/global/plugins/select2/select2.min.js')}}"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('resources/assets/admin/global/scripts/metronic.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/admin/layouts/layout3/scripts/layout.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/admin/pages/scripts/login.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Login.init();
    });
    @if($lang == 'ar')
        $.extend( $.validator.messages, {
            required: "هذا الحقل إلزامي",
            password: "هذا الحقل إلزامي",
            remote: "يرجى تصحيح هذا الحقل للمتابعة",
            email: "رجاء إدخال عنوان بريد إلكتروني صحيح",
            url: "رجاء إدخال عنوان موقع إلكتروني صحيح",
            date: "رجاء إدخال تاريخ صحيح",
            dateISO: "رجاء إدخال تاريخ صحيح (ISO)",
            number: "رجاء إدخال عدد بطريقة صحيحة",
            digits: "رجاء إدخال أرقام فقط",
            creditcard: "رجاء إدخال رقم بطاقة ائتمان صحيح",
            equalTo: "رجاء إدخال نفس القيمة",
            extension: "رجاء إدخال ملف بامتداد موافق عليه",
            maxlength: $.validator.format( "الحد الأقصى لعدد الحروف هو {0}" ),
            minlength: $.validator.format( "الحد الأدنى لعدد الحروف هو {0}" ),
            rangelength: $.validator.format( "عدد الحروف يجب أن يكون بين {0} و {1}" ),
            range: $.validator.format( "رجاء إدخال عدد قيمته بين {0} و {1}" ),
            max: $.validator.format( "رجاء إدخال عدد أقل من أو يساوي {0}" ),
            min: $.validator.format( "رجاء إدخال عدد أكبر من أو يساوي {0}" )
        } );
    @endif
</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5c404111ab5284048d0d571d/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<!--End of Tawk.to Script-->
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
