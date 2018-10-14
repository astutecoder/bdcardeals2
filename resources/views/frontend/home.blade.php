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
        <link
            rel="stylesheet"
            type="text/css"
            charset="UTF-8"
            href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css"/>
        <link
            rel="stylesheet"
            type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css"/>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <title>BD Car Deals::@yield('title')</title>
    </head>
    <body>
        <div id="bcd-app"></div>
        <script src="{{ asset('js/frontend.js') }}"></script>
    </body>
</html>