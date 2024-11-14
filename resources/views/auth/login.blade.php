{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.app')

@section('content')
    <div class="parent login_In body_login" style="margin-top:-50px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 login_In" dir="rtl">
                    <div class="heading">تسجيل الدخول</div>
                    <form method="POST" action="{{ route('login') }}" class="form">
                        @csrf
                        <div class="mb-3">
                            <input autofocus class="input @error('email') error @enderror mb-2" type="text" name="email"
                                id="email" placeholder="اسم المستخدم" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input class="input @error('password') error @enderror mb-2" type="password" name="password"
                                id="password" placeholder="كلمه السر">
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <span class="forgot-password text-right mr-1 pt-3 pb-3"><a href="#"> هل نسيت كلمه
                                السر؟</a></span>
                        <input class="login-button" type="submit" value="تسجيل دخول">
                    </form>
                    <div class="social-account-container">
                        <span class="title"> سجل دخول بواسطه </span>
                        <div class="social-accounts">
                            <span><i class="fa-brands fa-google"></i></span>
                            <span><i class="fa-brands fa-google-plus"></i></span>
                            <span><i class="fa-brands fa-square-instagram"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
