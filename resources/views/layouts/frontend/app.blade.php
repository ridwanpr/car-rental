<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/ambatucar-logo.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/js/app.js', 'resources/scss/app.scss'])
    <link type="text/css" href="{{ asset('css/volt.css') }}" rel="stylesheet">
    @stack('css')
    @turnstileScripts()
</head>

<body>
    <div id="app">
        @include('layouts.frontend.partials.nav')
        @yield('content')
        @include('layouts.frontend.partials.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    @stack('js')
    <script>
        function displayNotyf(message, type = 'success') {
            const notyf = new Notyf({
                position: {
                    x: 'right',
                    y: 'top',
                },
                types: [{
                        type: 'error',
                        background: 'red',
                        icon: {
                            className: 'fas fa-exclamation-circle',
                            tagName: 'span',
                            color: '#fff'
                        },
                        dismissible: true
                    },
                    {
                        type: 'success',
                        background: 'green',
                        icon: {
                            className: 'fas fa-check-circle',
                            tagName: 'span',
                            color: '#fff'
                        },
                        dismissible: true
                    }
                ]
            });

            notyf.open({
                type: type,
                message: message,
                duration: 5000
            });
        }

        $(document).ready(function() {
            const errors = @json($errors->all());
            if (errors.length > 0) {
                displayNotyf(errors.join('<br>'), 'error');
            }

            const successMessage = @json(session('success'));
            if (successMessage) {
                displayNotyf(successMessage, 'success');
            }
        });
    </script>
</body>

</html>
