<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Nafilah Kost') }}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Poppins:wght@400;500;700&display=swap">

    <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/fontawesome.min.css') }}" type="text/css">
    @stack('css')

    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}" type="text/css">

    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="icon" href="{{ asset('assets/img/icons/icon.png') }}" sizes="509x339" type="image/png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    @stack('style')

</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layouts.petugas.header')
        @include('layouts.petugas.sidebar')

        <div class="content-wrapper">
            {{ $slot }}
        </div>

        @include('layouts.petugas.footer')
    </div>

    @stack('modal')

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @stack('js')

    <script src="{{ asset('assets/js/adminlte.min.js') }}"></script>

    @stack('script')
</body>
</html>
