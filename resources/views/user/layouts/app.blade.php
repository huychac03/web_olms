<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    @yield('seo')
    {!! \App\Models\Option::getvalue('pageheader') !!}
    <meta name="google-site-verification" content="{!! \App\Models\Option::getvalue('google_veri') !!}" />
    <meta property="fb:admins" content="{{\App\Models\Option::getvalue('fb_admin_id')}}" />
    <meta property="fb:app_id" content="{{\App\Models\Option::getvalue('fb_app')}}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! NoCaptcha::renderJs('vn', true, 'recaptchaCallback') !!}
    <script src="https://apis.google.com/js/platform.js" async defer>
        {lang: 'vi'}

        document.addEventListener('contextmenu', event => event.preventDefault());
        document.onkeypress = function (event) {
            event = (event || window.event);
            if (event.keyCode == 123) {
                return false;
            }
        }
        document.onmousedown = function (event) {
            event = (event || window.event);
            if (event.keyCode == 123) {
                return false;
            }
        }
        document.onkeydown = function (event) {
            event = (event || window.event);
            if (event.keyCode == 123) {
                return false;
            }
        }

        jQuery(document).ready(function($){
            $(document).keydown(function(event) {
                var pressedKey = String.fromCharCode(event.keyCode).toLowerCase();

                if (event.ctrlKey && (pressedKey == "c" || pressedKey == "u")) {
                    return false;
                }
            });

            document.onkeydown = function(e) {
                if (event.keyCode == 123) {
                    return false;
                }
                if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                    return false;
                }
                if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                    return false;
                }
                if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                    return false;
                }
            }
        });
    </script>
    <style>
        body {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
            user-select: none;
        }
    </style>
</head>
<body onselectstart="return false" oncontextmenu="return false">
{{--Facebook--}}
<div id="fb-root"></div>
<div class="wrapper" id="backOnTop">
    @include('user.partials.navibar')
    <div class="ads container">
        {!! \App\Models\Option::getvalue('ads_header') !!}
    </div>
    @yield('content')
<!-- Footer -->
    <div class="clearfix"></div>
    <div class="ads container">
        {!! \App\Models\Option::getvalue('ads_footer') !!}
    </div>

    <div class="footer">
        <div class="container">
            <div class="hidden-xs col-sm-5">
                {!! \App\Models\Option::getvalue('copyright') !!}
            </div>
            <ul class="col-xs-12 col-sm-7 list-unstyled">
                <li class="text-right pull-right">
                    <a href="{{url('contact')}}" title="Liên hệ">Liên hệ</a> - <a href="{{url('tos')}}" title="Terms of Service">Điều khoản</a> - <a href="{{url('sitemap.xml')}}" title="Sitemap" target="_blank">Sơ đồ</a><a class="backtop" href="#backOnTop" rel="nofollow"><span class="glyphicon glyphicon-upload"></span></a>
                </li>
                <li class="hidden-xs tag-list"></li>
            </ul>
        </div>
    </div>
</div> <!-- #Wrapper -->
<!--<div id="fade" style="display: block;"></div>-->
<!--<div class="popup1" style="display: block;">
    <div class="newsletter-sign-box">
        <div class="newsletter-form" style="margin-top: 35px">
            {!! NoCaptcha::display() !!}
            <!--input-box-->
        <!--</div>
    </div>-->
    <!--newsletter-sign-box-->
</div>
<!-- Jquery -->
<script src="{{ asset('user/js/jquery.min.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('user/js/bootstrap.min.js') }}"></script>
<!-- My Script -->
<script src="{{ asset('user/js/main.js') }}"></script>

<script type="text/javascript">
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','__gaTracker');

    __gaTracker('create', '{!! \App\Models\Option::getvalue('google_analytics') !!}', 'auto');
    __gaTracker('set', 'forceSSL', true);
    __gaTracker('send','pageview');


    document.addEventListener('contextmenu', event => event.preventDefault());
    document.onkeypress = function (event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
            return false;
        }
    }
    document.onmousedown = function (event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
            return false;
        }
    }
    document.onkeydown = function (event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
            return false;
        }
    }

    jQuery(document).ready(function($){
        $(document).keydown(function(event) {
            var pressedKey = String.fromCharCode(event.keyCode).toLowerCase();

            if (event.ctrlKey && (pressedKey == "c" || pressedKey == "u")) {
                return false;
            }
        });

        document.onkeydown = function(e) {
            if (event.keyCode == 123) {
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                return false;
            }
        }
    });
</script>
<!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
{!! \App\Models\Option::getvalue('pagefooter') !!}
</body>
</html>