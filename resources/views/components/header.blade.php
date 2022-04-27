<header class="header-outer header header-transparent">
    <div class="container">
        <nav class="header-inner">
            <div class="header-navigation-left d-flex justify-content-center w-sm-100 w-md-auto">
                <button class="btn btn-link d-md-none  btn-offcanvas-dismiss" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvas" aria-expanded="false">
                    <i class="bi bi-list fs-2"></i>
                </button>
                <a class="header-logo" href="/">
                    <img id="brand-logo" src="{{ $info->data?->image_url }}"
                        onerror="document.getElementById('brand-logo').src = '{{ asset('storage/essential/err_logo.png') }}' " />
                </a>
            </div>
            <div class="header-navigation offcanvas offcanvas-start" id="offcanvas">
                <div class="offcanvas-header d-md-none justify-content-end">
                    <button type="button" class="btn " data-bs-dismiss="offcanvas" style="color: white"
                        aria-label="Close">
                        <i class="bi bi-x-lg fs-2"></i>

                    </button>
                </div>
                <a href="/" class="header-item text-capitalize">Home</a>
                <a href="/about" class="header-item text-capitalize">About Us</a>
                @foreach ($services as $item)
                    @if ($item->on_navbar && $item->dropdown_on_navbar)
                        <div class="dropdown header-item">
                            <a class="dropdown-toggle text-decoration-none text-capitalize"
                                href="{{ route('page.groupInfo', ['typeid' => $item->type->code]) }}" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $item->title }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item text-capitalize"
                                        href="{{ route('page.groupInfo', ['typeid' => $item->type->code]) }}">{{ 'Go to ' . $item->title }}</a>
                                </li>
                                @foreach ($item->articles as $article)
                                    <li>
                                        <a class="dropdown-item text-capitalize"
                                            href="{{ route('page.articleInfo', ['typeid' => $item->type->code,'groupid'=> $item->id, 'articleid' => $article->id]) }}">{{ $article->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif($item->on_navbar)
                        <a href="{{ route('page.groupInfo', ['typeid' => $item->type->code]) }}"
                            class="header-item text-capitalize">{{ $item->title }}</a>
                    @endif
                @endforeach
                <a href="{{ route('contactus.index') }}" class="header-item text-capitalize">Contact Us</a>
                @guest
                    <div class="dropdown header-item">
                        <a class="dropdown-toggle text-decoration-none" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Sign In
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            @if (Route::has('login'))
                                <li>
                                    <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            {{-- @if (Route::has('register'))
                                <li>
                                    <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        </ul>
                    </div>
                @else
                    <div class="dropdown header-item">
                        <a class="dropdown-toggle text-decoration-none" href="#" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ route('admin.index') }}">Dashboard</a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>

                @endguest

            </div>

        </nav>

    </div>
</header>
