<!doctype html>
<html class="fixed sidebar-left-collapsed">
<head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <title>@yield('title')</title>

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.css')}}" />

    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.css') }}}" />
    <link rel="stylesheet" href="{{ asset('vendor/magnific-popup/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/datepicker3.css') }}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{ asset('css/skins/default.css') }}" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/theme-custom.css') }}">

    <!-- Head Libs -->
    <script src="{{ asset('vendor/modernizr/modernizr.js') }}"></script>
</head>
<body>
<section class="body">

    <!-- start: header -->
        @include('backend.partials.header')
    <!-- end: header -->

    <div class="inner-wrapper">
        <!-- start: sidebar -->
            @include('backend.partials.sideNav')
        <!-- end: sidebar -->

        <section role="main" class="content-body">
            <header class="page-header">
                <h2>@yield('content-body-head')</h2>
            </header>

            <!-- start: page -->
                @yield('content-body')
            <!-- end: page -->
        </section>
    </div>

    <!-- Vendor -->
    <script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/nanoscroller/nanoscroller.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('vendor/magnific-popup/magnific-popup.js') }}"></script>
    <script src="{{ asset('vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

    <!-- Specific Page Vendor -->

    <!-- Theme Base, Components and Settings -->
    <script src="{{ asset('js/theme.js') }}"></script>

    <!-- Theme Custom -->
    <script src="{{ asset('js/theme.custom.js') }}"></script>

    <!-- Theme Initialization Files -->
    <script src="{{ asset('js/theme.init.js') }}"></script>

</section>
</body>
</html>