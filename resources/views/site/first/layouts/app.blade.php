<!DOCTYPE html>
<html lang="{{ session('lang') }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Author -->
    <meta name="author" content="{{ setting('meta_author') }}">
    <!-- description -->
    <meta name="description" content="{{ setting('meta_description') }}">
    <!-- keywords -->
    <meta name="keywords" content="{{ setting('meta_keywords') }}">
    <!-- Page Title -->
    <title>{{ setting('website_title') }}</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('site/part1/img/favicon.png') }}">


    <link rel="stylesheet" href="{{ asset('site/part1/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('site/part1/css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('site/part1/css/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('site/part1/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('site/part1/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('site/part1/css/boxicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('site/part1/css/flaticon.css') }}">

    <link rel="stylesheet" href="{{ asset('site/part1/css/meanmenu.css') }}">

    <link rel="stylesheet" href="{{ asset('site/part1/css/nice-select.css') }}">

    <link rel="stylesheet" href="{{ asset('site/part1/css/odometer.css') }}">

    <link rel="stylesheet" href="{{ asset('site/part1/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('site/part1/css/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('site/part1/css/rtl.css') }}">


    @stack('styles')

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ setting('google_analytics') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', '{{ setting('google_analytics') }}');
    </script>

</head>
<body>

<div class="loader-wrapper">
    <div class="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>

@include('site.first.layouts.header')

@yield('content')

@include('site.first.layouts.footer')



<div class="go-top">
    <i class='bx bx-chevrons-up'></i>
    <i class='bx bx-chevrons-up'></i>
</div>

<!-- JAVASCRIPT FILES ========================================= -->


<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="{{ asset('site/part1/js/jquery-3.5.0.min.js') }}"></script>

<script src="{{ asset('site/part1/js/popper.min.js') }}"></script>

<script src="{{ asset('site/part1/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('site/part1/js/jquery.meanmenu.js') }}"></script>

<script src="{{ asset('site/part1/js/wow.min.js') }}"></script>

<script src="{{ asset('site/part1/js/owl.carousel.js') }}"></script>

<script src="{{ asset('site/part1/js/jquery.magnific-popup.min.js') }}"></script>

<script src="{{ asset('site/part1/js/jquery.nice-select.min.js') }}"></script>

<script src="{{ asset('site/part1/js/parallax.min.js') }}"></script>

<script src="{{ asset('site/part1/js/jquery.appear.js') }}"></script>

<script src="{{ asset('site/part1/js/odometer.min.js') }}"></script>

<script src="{{ asset('site/part1/js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ asset('site/part1/js/jquery.ajaxchimp.min.js') }}"></script>

<script src="{{ asset('site/part1/js/form-validator.min.js') }}"></script>

<script src="{{ asset('site/part1/js/contact-form-script.js') }}"></script>

<script src="{{ asset('site/part1/js/custom.js') }}"></script>


@stack('scripts')

</body>
</html>
