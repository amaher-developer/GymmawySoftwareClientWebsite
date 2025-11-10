<!DOCTYPE html>
<!--[if IE 8]> <html lang="{{app()->getLocale('lang')}}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="{{app()->getLocale('lang')}}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{app()->getLocale('lang')}}" @if(app()->getLocale('lang')=='ar') dir="rtl" @endif>
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    @php($template_version = $template_version ?? env('TEMPLATE_NUM', '1'))
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
    <link href="{{asset('resources/' . $template_version . '/assets/admin/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('resources/' . $template_version . '/assets/admin/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('resources/' . $template_version . '/assets/admin/global/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('resources/' . $template_version . '/assets/admin/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{asset('resources/' . $template_version . '/assets/admin/global/plugins/select2/select2.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('resources/' . $template_version . '/assets/admin/pages/css/login3-rtl.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{asset('resources/' . $template_version . '/assets/admin/global/css/components-rtl.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('resources/' . $template_version . '/assets/admin/global/css/plugins-rtl.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('resources/' . $template_version . '/assets/admin/layouts/layout3/css/layout-rtl.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('resources/' . $template_version . '/assets/admin/layouts/layout3/css/themes/default-rtl.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="{{asset('resources/' . $template_version . '/assets/admin/layouts/layout3/css/custom-rtl.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="{{asset('resources/' . $template_version . '/assets/front/images/favicon.ico')}}"/>
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
<script src="{{asset('resources/' . $template_version . '/assets/admin/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('resources/' . $template_version . '/assets/admin/global/plugins/excanvas.min.js')}}"></script>
<![endif]-->
<script src="{{asset('resources/' . $template_version . '/assets/admin/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/' . $template_version . '/assets/admin/global/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/' . $template_version . '/assets/admin/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/' . $template_version . '/assets/admin/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/' . $template_version . '/assets/admin/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('resources/' . $template_version . '/assets/admin/global/plugins/jquery-validation/js/jquery.validate.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('resources/' . $template_version . '/assets/admin/global/plugins/select2/select2.min.js')}}"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('resources/' . $template_version . '/assets/admin/global/scripts/metronic.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/' . $template_version . '/assets/admin/layouts/layout3/scripts/layout.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/' . $template_version . '/assets/admin/pages/scripts/login.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Login.init();
    });
    @if($lang == 'ar')
        $.extend( $.validator.messages, {
            required: "Ã™â€¡Ã˜Â°Ã˜Â§ Ã˜Â§Ã™â€žÃ˜Â­Ã™â€šÃ™â€ž Ã˜Â¥Ã™â€žÃ˜Â²Ã˜Â§Ã™â€¦Ã™Å ",
            password: "Ã™â€¡Ã˜Â°Ã˜Â§ Ã˜Â§Ã™â€žÃ˜Â­Ã™â€šÃ™â€ž Ã˜Â¥Ã™â€žÃ˜Â²Ã˜Â§Ã™â€¦Ã™Å ",
            remote: "Ã™Å Ã˜Â±Ã˜Â¬Ã™â€° Ã˜ÂªÃ˜ÂµÃ˜Â­Ã™Å Ã˜Â­ Ã™â€¡Ã˜Â°Ã˜Â§ Ã˜Â§Ã™â€žÃ˜Â­Ã™â€šÃ™â€ž Ã™â€žÃ™â€žÃ™â€¦Ã˜ÂªÃ˜Â§Ã˜Â¨Ã˜Â¹Ã˜Â©",
            email: "Ã˜Â±Ã˜Â¬Ã˜Â§Ã˜Â¡ Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¹Ã™â€ Ã™Ë†Ã˜Â§Ã™â€  Ã˜Â¨Ã˜Â±Ã™Å Ã˜Â¯ Ã˜Â¥Ã™â€žÃ™Æ’Ã˜ÂªÃ˜Â±Ã™Ë†Ã™â€ Ã™Å  Ã˜ÂµÃ˜Â­Ã™Å Ã˜Â­",
            url: "Ã˜Â±Ã˜Â¬Ã˜Â§Ã˜Â¡ Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¹Ã™â€ Ã™Ë†Ã˜Â§Ã™â€  Ã™â€¦Ã™Ë†Ã™â€šÃ˜Â¹ Ã˜Â¥Ã™â€žÃ™Æ’Ã˜ÂªÃ˜Â±Ã™Ë†Ã™â€ Ã™Å  Ã˜ÂµÃ˜Â­Ã™Å Ã˜Â­",
            date: "Ã˜Â±Ã˜Â¬Ã˜Â§Ã˜Â¡ Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜ÂªÃ˜Â§Ã˜Â±Ã™Å Ã˜Â® Ã˜ÂµÃ˜Â­Ã™Å Ã˜Â­",
            dateISO: "Ã˜Â±Ã˜Â¬Ã˜Â§Ã˜Â¡ Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜ÂªÃ˜Â§Ã˜Â±Ã™Å Ã˜Â® Ã˜ÂµÃ˜Â­Ã™Å Ã˜Â­ (ISO)",
            number: "Ã˜Â±Ã˜Â¬Ã˜Â§Ã˜Â¡ Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¹Ã˜Â¯Ã˜Â¯ Ã˜Â¨Ã˜Â·Ã˜Â±Ã™Å Ã™â€šÃ˜Â© Ã˜ÂµÃ˜Â­Ã™Å Ã˜Â­Ã˜Â©",
            digits: "Ã˜Â±Ã˜Â¬Ã˜Â§Ã˜Â¡ Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â£Ã˜Â±Ã™â€šÃ˜Â§Ã™â€¦ Ã™ÂÃ™â€šÃ˜Â·",
            creditcard: "Ã˜Â±Ã˜Â¬Ã˜Â§Ã˜Â¡ Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â±Ã™â€šÃ™â€¦ Ã˜Â¨Ã˜Â·Ã˜Â§Ã™â€šÃ˜Â© Ã˜Â§Ã˜Â¦Ã˜ÂªÃ™â€¦Ã˜Â§Ã™â€  Ã˜ÂµÃ˜Â­Ã™Å Ã˜Â­",
            equalTo: "Ã˜Â±Ã˜Â¬Ã˜Â§Ã˜Â¡ Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã™â€ Ã™ÂÃ˜Â³ Ã˜Â§Ã™â€žÃ™â€šÃ™Å Ã™â€¦Ã˜Â©",
            extension: "Ã˜Â±Ã˜Â¬Ã˜Â§Ã˜Â¡ Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã™â€¦Ã™â€žÃ™Â Ã˜Â¨Ã˜Â§Ã™â€¦Ã˜ÂªÃ˜Â¯Ã˜Â§Ã˜Â¯ Ã™â€¦Ã™Ë†Ã˜Â§Ã™ÂÃ™â€š Ã˜Â¹Ã™â€žÃ™Å Ã™â€¡",
            maxlength: $.validator.format( "Ã˜Â§Ã™â€žÃ˜Â­Ã˜Â¯ Ã˜Â§Ã™â€žÃ˜Â£Ã™â€šÃ˜ÂµÃ™â€° Ã™â€žÃ˜Â¹Ã˜Â¯Ã˜Â¯ Ã˜Â§Ã™â€žÃ˜Â­Ã˜Â±Ã™Ë†Ã™Â Ã™â€¡Ã™Ë† {0}" ),
            minlength: $.validator.format( "Ã˜Â§Ã™â€žÃ˜Â­Ã˜Â¯ Ã˜Â§Ã™â€žÃ˜Â£Ã˜Â¯Ã™â€ Ã™â€° Ã™â€žÃ˜Â¹Ã˜Â¯Ã˜Â¯ Ã˜Â§Ã™â€žÃ˜Â­Ã˜Â±Ã™Ë†Ã™Â Ã™â€¡Ã™Ë† {0}" ),
            rangelength: $.validator.format( "Ã˜Â¹Ã˜Â¯Ã˜Â¯ Ã˜Â§Ã™â€žÃ˜Â­Ã˜Â±Ã™Ë†Ã™Â Ã™Å Ã˜Â¬Ã˜Â¨ Ã˜Â£Ã™â€  Ã™Å Ã™Æ’Ã™Ë†Ã™â€  Ã˜Â¨Ã™Å Ã™â€  {0} Ã™Ë† {1}" ),
            range: $.validator.format( "Ã˜Â±Ã˜Â¬Ã˜Â§Ã˜Â¡ Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¹Ã˜Â¯Ã˜Â¯ Ã™â€šÃ™Å Ã™â€¦Ã˜ÂªÃ™â€¡ Ã˜Â¨Ã™Å Ã™â€  {0} Ã™Ë† {1}" ),
            max: $.validator.format( "Ã˜Â±Ã˜Â¬Ã˜Â§Ã˜Â¡ Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¹Ã˜Â¯Ã˜Â¯ Ã˜Â£Ã™â€šÃ™â€ž Ã™â€¦Ã™â€  Ã˜Â£Ã™Ë† Ã™Å Ã˜Â³Ã˜Â§Ã™Ë†Ã™Å  {0}" ),
            min: $.validator.format( "Ã˜Â±Ã˜Â¬Ã˜Â§Ã˜Â¡ Ã˜Â¥Ã˜Â¯Ã˜Â®Ã˜Â§Ã™â€ž Ã˜Â¹Ã˜Â¯Ã˜Â¯ Ã˜Â£Ã™Æ’Ã˜Â¨Ã˜Â± Ã™â€¦Ã™â€  Ã˜Â£Ã™Ë† Ã™Å Ã˜Â³Ã˜Â§Ã™Ë†Ã™Å  {0}" )
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

