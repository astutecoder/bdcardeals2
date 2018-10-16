<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta
            name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link
            href="https://fonts.googleapis.com/css?family=Hind:300,400,600,700|Poppins:300,500,600,700,900"
            rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('vendor_assets/slider-pro-master/dist/css/slider-pro.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <title>BD Car Deals::@yield('title')</title>
    </head>
    <body>
        <div id="bcd-app"></div>
        <script src="{{ asset('js/frontend.js') }}"></script>
        <!-- <script src="{{ asset('vendor_assets/slider-pro/libs/js/jquery-1.11.0.min.js') }}"></script> -->
        <script src="{{ asset('vendor_assets/slider-pro-master/dist/js/jquery.sliderPro.min.js') }}"></script>
    </body>
</html>