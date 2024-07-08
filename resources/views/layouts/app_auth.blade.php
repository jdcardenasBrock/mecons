<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MECONS') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('font/iconsmind-s/css/iconsminds.css')}}" />
    <link rel="stylesheet" href="{{ asset('font/simple-line-icons/css/simple-line-icons.css')}}" />

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.rtl.only.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-float-label.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/main.css')}}" />
    @livewireStyles
</head>
<body class="background show-spinner no-footer">
    <div class="fixed-background"></div> 

        <main>
            @yield('content')
        </main>
    </div>
    <script src="{{asset('js/vendor/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/dore.script.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    @livewireScripts
</body>
</html>
