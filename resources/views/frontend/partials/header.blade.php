<!DOCTYPE html>
<html lang="{{$user_select_lang_slug}}"  dir="{{get_user_lang_direction()}}">
<head>
    @if(!empty(get_static_option('site_google_analytics')))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{get_static_option('site_google_analytics')}}"></script>
    <script>
        (function(){
        "use strict";
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', "{{get_static_option('site_google_analytics')}}");
        })();
    </script>
    @endif
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dr. Sunita Mishra</title>
    <!--{!! render_favicon_by_id(filter_static_option_value('site_favicon',$global_static_field_data)) !!}-->
    <!-- load fonts dynamically -->
    {!! load_google_fonts() !!}
    <!-- favicon -->
    <!--{!! render_favicon_by_id(filter_static_option_value('site_favicon',$global_static_field_data)) !!}-->
    <link rel="icon" type="image/x-icon" href="{{asset("assets/uploads/media-uploader/sunita-mishra-logo1703774311.png")}}">
    <!-- animate -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/animate.css') }}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/magnific-popup.css') }}">
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.carousel.min.css') }}">
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/font-awesome.min.css') }}">
    <!-- fontawesome support -->
    <link rel="stylesheet" href="{{asset('assets/backend/css/fontawesome.min.css')}}">
    <!-- flaticon -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/flaticon.css')}}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <!-- responsive Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom-style.css') }}">
    <!-- Dynamic CSS -->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/dynamic-style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/jquery.ihavecookies.css')}}">
    <!-- Toaster CSS -->
    <link rel="stylesheet" href="{{asset('assets/common/css/toastr.css')}}">
    <!-- JQUERY  -->
    <script src="{{asset('assets/common/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/common/js/jquery-migrate-3.3.2.min.js')}}"></script>
    <!-- Site Root Style  -->
    @include('frontend.partials.root-style')
    @yield('style')
    @if(!empty(filter_static_option_value('site_rtl_enabled',$global_static_field_data)) || get_user_lang_direction() == 'rtl')
            <link rel="stylesheet" href="{{asset('assets/frontend/css/rtl.css')}}">
    @endif
    @include('frontend.partials.og-meta')
    {!! filter_static_option_value('site_third_party_tracking_code') !!}
</head>

<body>
    <!-- preloader area start -->
    @if(!empty(get_static_option('site_loader_animation')))
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="blobs">
                <div class="blob-center"></div>
                <div class="blob"></div>
                <div class="blob"></div>
                <div class="blob"></div>
                <div class="blob"></div>
                <div class="blob"></div>
                <div class="blob"></div>
            </div>
        </div>
    </div>
    @endif
    <!-- preloader area end -->