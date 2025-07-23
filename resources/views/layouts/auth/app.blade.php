<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Perpustakaan SMPN 26 Kota Jambi') }}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Poppins:wght@400;500;700&display=swap">

    <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/fontawesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}" type="text/css">

    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="icon" href="{{ asset('assets/img/icons/icon.png') }}" sizes="509x339" type="image/png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <style>
        @media (max-width: 676px) {
            .login-box,
            .register-box {
                width: 96%
            }
        }

        .input-group-append {
            cursor: pointer;
        }
    </style>

</head>
<body class="hold-transition login-page">
    <div class="login-box">
        {{ $slot }}
    </div>

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/adminlte.min.js') }}"></script>

    <script>
        document.querySelectorAll('.toggle-password').forEach(function(toggle) {
            toggle.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('span');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-lock');
                    icon.classList.add('fa-lock-open');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-lock-open');
                    icon.classList.add('fa-lock');
                }
            });
        });
    </script>
</body>
</html>
