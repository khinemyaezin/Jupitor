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
    @yield('style')
    @inject('groupService', 'App\Services\GroupService')
    @inject('systemService', 'App\Services\SystemService')
    @php
        $info = $systemService->getCompanyInfo();
        $services = $groupService->getForNavbar()->list;
    @endphp
    <x-header :info="$info" :services="$services" />
    <main>
        @yield('content')
    </main>
    <x-footer :info="$info" :services="$services"></x-footer>
    @stack('scripts')
    @push('scripts')
        <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
    @endpush
</body>

</html>
