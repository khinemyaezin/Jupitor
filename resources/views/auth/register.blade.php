@extends('layouts.auth')
@section('style')
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
                                <div class="text-center mb-3 mb-md-7">
                                    <h2>Sign up</h2>
                                    {{-- <span>Already have an account?
                                        <a href="{{ route('login') }}" class="ms-1">Sign in</a></span> --}}
                                </div>

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="name" class="col-12 col-form-label">{{ __('Name') }}</label>

                                        <div class="col-12">
                                            <input id="name" type="text"  placeholder="Your name"
                                                class="form-control form-control-lg fs-6  @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" required autocomplete="name"
                                                autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email"
                                            class="col-12 col-form-label ">{{ __('Email Address') }}</label>

                                        <div class="col-12">
                                            <input id="email" type="email" placeholder="E-mail"
                                                class="form-control form-control-lg fs-6 @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-12 col-form-label ">{{ __('Password') }}</label>

                                        <div class="col-12">
                                            <input id="password" type="password"  placeholder="********"
                                                class="form-control form-control-lg fs-6 @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password-confirm"
                                            class="col-12 col-form-label ">{{ __('Confirm Password') }}</label>

                                        <div class="col-12">
                                            <input id="password-confirm" type="password"  placeholder="********"
                                                class="form-control form-control-lg fs-6" name="password_confirmation"
                                                required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-lg rounded-0 w-100 fs-6">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
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
                                        <a href="{{ url('auth/google') }}"
                                            class="btn btn-lg btn-primary mb-2 mb-xxl-0 rounded-0 fs-6">
                                            <i class="bi bi-google text-white me-2"></i>
                                            Login with Google</a>
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
@endsection
