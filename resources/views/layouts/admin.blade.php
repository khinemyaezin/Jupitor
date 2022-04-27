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
    <div id="app">
        @inject('systemService', 'App\Services\SystemService')
        @php
            $info = $systemService->getCompanyInfo();
        @endphp
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm sticky-top"
            style="background-color: rgba(22, 28, 45, 0.9)">

            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ $info->data?->image_url }}" id="brand-logo" alt="" height="43"
                        onerror="document.getElementById('brand-logo').src = '{{ asset('storage/essential/err_logo.png') }}' ">

                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @auth
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/admin">Home</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Settings
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.forehead.index') }}">Carousel</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.type.all') }}">Types</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.group.all') }}">Headlines</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.theme.all') }}">Theme</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.theme_group.index') }}">Theme
                                            group</a>
                                    </li>
                                    {{-- <li>
                                        <a class="dropdown-item" href="{{ route('admin.social.index') }}">Socials</a>
                                    </li> --}}
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.info.index') }}">Vital info</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <div class="d-flex me-4 gap-2 dropdown" style="max-width: 210px;">
                                    <img class="icon icon-xs rounded-circle" style="width: 36px; height: 36px;"
                                        src="@if (Auth::user()->google_id) {{ Auth::user()->image_url }} @else {{ asset('storage/' . Auth::user()->image_url) }} @endif">
                                    <a class="text align-self-center dropdown-toggle text-decoration-none text-white"
                                        id="user-dropdown" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark"
                                        aria-labelledby="user-dropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>


                        </ul>
                    </div>
                @endauth

            </div>
        </nav>

        <main class="admin-main">
            @yield('content')
        </main>

    </div>
    @stack('scripts')
</body>

</html>
