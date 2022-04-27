@extends('layouts.auth')
@section('style')
    <style>
        .header.header-transparent {
            background-color: rgba(22, 28, 45, 0.9);
        }

    </style>
@endsection
@section('content')
    <div class="jarallax">
        <img class="jarallax-img" src="{{ asset('storage/essential/contact_us_bgcover.jpg') }}">
        <span class="position-absolute top-0 start-0 w-100 h-100 bg-overlay"></span>
        <div class="container position-relative">
            <div class="row">
                <div class="col-lg-7 col-xl-12 d-flex justify-content-center align-items-center mn-vh-100">
                    <div class="flex-grow-1 mx-auto py-3" style="max-width: 30rem;">
                        <div class="card rounded-0 bg-image-default">
                            <div class="card-body">
                                <div class="text-center mb-5 mb-md-7 pt-3">
                                    <h2>Welcome back</h2>
                                    <p>Login to manage your account.</p>
                                </div>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="email">{{ __('Email Address') }}</label>
                                        <input type="email"
                                            class="form-control form-control-lg fs-6  @error('email') is-invalid @enderror"
                                            name="email" id="email" placeholder="email@site.com" aria-label="email@site.com"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label class="form-label" for="password">{{ __('Password') }}</label>
                                            @if (Route::has('password.request'))
                                                <a class="form-label-link small text-decoration-none"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>

                                        <div class="input-group">
                                            <input type="password"
                                                class="form-control form-control-lg fs-6 @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password">

                                        </div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6 ">
                                            <div class="form-check ">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg mb-3 rounded-0 fs-6">Log
                                            in</button>
                                    </div>

                                </form>
                                <div class="row">
                                    <!-- Divider with text -->
                                    <div class="position-relative my-4">
                                        <hr>
                                        <p class="small position-absolute top-50 start-50 translate-middle bg-body px-5">Or
                                        </p>
                                    </div>

                                    <!-- Social btn -->
                                    <div class="col-xxl-12 d-grid">
                                        <a href="{{ route('google.login') }}"
                                            class="btn btn-lg btn-primary mb-2 mb-xxl-0 rounded-0 fs-6">
                                            <i class="bi bi-google text-white me-2"></i>
                                            Login with Google</a>
                                        @error('google')
                                            <div class="invalid-feedback d-block text-center" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <!-- Social btn -->

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- <div class="container position-relative">
        <div class="d-flex align-items-center" style="min-height: 100vh">
            <div class="card rounded-0 bg-image-default mx-auto" style="min-width: 30rem;">
                <div class="card-body">
                    <div class="text-center mb-5 mb-md-7 pt-3">
                        <h2>Welcome back</h2>
                        <p>Login to manage your account.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="email">{{ __('Email Address') }}</label>
                            <input type="email"
                                class="form-control form-control-lg fs-6  @error('email') is-invalid @enderror" name="email"
                                id="email" placeholder="email@site.com" aria-label="email@site.com"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label" for="password">{{ __('Password') }}</label>
                                @if (Route::has('password.request'))
                                    <a class="form-label-link small text-decoration-none"
                                        href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>

                            <div class="input-group">
                                <input type="password"
                                    class="form-control form-control-lg fs-6 @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">

                            </div>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 ">
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg mb-3 rounded-0 fs-6">Log
                                in</button>
                        </div>

                    </form>

                    <div class="row">
                        <!-- Divider with text -->
                        <div class="position-relative my-4">
                            <hr>
                            <p class="small position-absolute top-50 start-50 translate-middle bg-body px-5">Or
                            </p>
                        </div>

                        <!-- Social btn -->
                        <div class="col-xxl-12 d-grid">
                            <a href="{{ route('google.login') }}"
                                class="btn btn-lg btn-primary mb-2 mb-xxl-0 rounded-0 fs-6">
                                <i class="bi bi-google text-white me-2"></i>
                                Login with Google</a>
                            @error('google')
                                <div class="invalid-feedback d-block text-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <!-- Social btn -->

                    </div>
                </div>
            </div>

        </div>

    </div> --}}
@endsection
