<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ambatucar</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/ambatucar-logo.jpg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link type="text/css" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('vendor/notyf/notyf.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link type="text/css" href="{{ asset('css/volt.css') }}" rel="stylesheet">
    @stack('css')
</head>

<body>
    @include('layouts.backend.partials.sidebar')

    <main class="content">
        @include('layouts.backend.partials.nav')

        @yield('content')

        @include('layouts.backend.partials.footer')
    </main>

    @stack('modals')
    @include('layouts.backend.partials.script')
    @stack('js')
    @vite(['resources/js/spinner.js'])
</body>

</html>
