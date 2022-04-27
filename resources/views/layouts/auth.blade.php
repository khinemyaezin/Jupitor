<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    @inject('systemService', 'App\Services\SystemService')
    @php
        $info = $systemService->getCompanyInfo();
    @endphp
    <nav class="navbar navbar-expand navbar-dark shadow-sm auth-navbar"
        style="background-color: rgba(22, 28, 45, 0.9)">
        <div class="container">
            <a class="my-lg-0 btn text-white " href="{{ url('/') }}">
                <i class="bi bi-chevron-double-left"></i>
                Back
            </a>
        </div>
    </nav>
    <main id="content" role="main" class="">
        @yield('content')
    </main>
    @stack('scripts')
</body>

</html>
