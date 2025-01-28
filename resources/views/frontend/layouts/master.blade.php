<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Export Apollo')</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('admin/assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />
   
    @stack('css_links')
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">
    @stack('css')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showAlert('success', '{{ session('success') }}');
            @endif

            @if (session('error'))
                showAlert('error', '{{ session('error') }}');
            @endif

            @if (session('warning'))
                showAlert('warning', '{{ session('warning') }}');
            @endif
        });
    </script>
</head>

<body>
    @include('frontend.partials.header')
    <div class="content-wrapper">
        @yield('content')
    </div>
    @include('frontend.partials.footer')
</body>

<!--   Core JS Files   -->
<script src="{{ asset('admin/assets/js/core/jquery-3.7.1.min.js') }}"></script>
@stack('js_links')

@stack('js')

</html>
