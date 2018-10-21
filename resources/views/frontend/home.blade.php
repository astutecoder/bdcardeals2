<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta
                name="viewport"
                content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta property="og:title" content="Welcome to BDCarDeals.Com" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://www.bdcardeals.com/" />
        <meta property="og:description" content="আমরাই দিচ্ছি, সকল ব্রান্ডের রিকন্ডিশন গাড়ি" />
        <meta property="og:image" content="https://www.bdcardeals.com/images/bd_car_deals_logo.png" />

        <link rel="apple-touch-icon" sizes="57x57" href="/images/favicon.ico/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/images/favicon.ico/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/images/favicon.ico/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/images/favicon.ico/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/images/favicon.ico/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/images/favicon.ico/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/images/favicon.ico/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/images/favicon.ico/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon.ico/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/images/favicon.ico/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon.ico/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon.ico/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon.ico/favicon-16x16.png">
        <link rel="manifest" href="/images/favicon.ico/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/images/favicon.ico/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <link
                href="https://fonts.googleapis.com/css?family=Hind:300,400,600,700|Poppins:300,500,600,700,900"
                rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('vendor_assets/slider-pro-master/dist/css/slider-pro.min.css') }}">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <title>BD Car Deals</title>
    </head>
    <body>
        <div id="bcd-app"></div>
        <script src="{{ asset('js/frontend.js') }}"></script>
    <!-- <script src="{{ asset('vendor_assets/slider-pro/libs/js/jquery-1.11.0.min.js') }}"></script> -->
        <script src="{{ asset('vendor_assets/slider-pro-master/dist/js/jquery.sliderPro.min.js') }}"></script>
    </body>
</html>