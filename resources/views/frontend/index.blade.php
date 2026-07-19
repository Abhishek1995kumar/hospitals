<!DOCTYPE html>
<html lang="hi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        <link rel="icon" type="image/x-icon" class="logo-icon" href="{{ asset('favicon.ico') }}">
        <link href="{{ asset('frontend/css/fonts.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/select2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/flatpickr.min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
        @yield('style')
        
    </head>

    <body>
        @include('frontend.navbar')

        @yield('content')

        @include('frontend.footer')

        <div class="toast" id="toast"></div>
        <!-- JS Sequence -->
        <script src="{{ asset('frontend/js/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
        <script src="{{ asset('frontend/js/flatpickr.js') }}"></script>
        <script src="{{ asset('frontend/js/script.js') }}"></script>
        <script src="{{ asset('frontend/js/comman.js') }}"></script>

        @yield('script')
    </body>
</html>