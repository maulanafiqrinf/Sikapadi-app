@extends('layouts.auth.main')

@section('title','Login')

@section('content')
    <div class="authentication-inner py-6">
        <div class="card p-md-7 p-1">
            <div class="app-brand justify-content-center mt-5">
                <a href="{{ url('/') }}" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo">
                    </span>
                    <span class="app-brand-text demo text-heading fw-semibold">SIKAPADI</span>
                </a>
            </div>
            <div class="card-body mt-1">
                <h4 class="mb-1">Welcome to Sikapadi! 👋</h4>
                <p class="mb-5">Please sign-in to your account and start the adventure</p>
                <form id="formAuthentication" class="mb-5" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-floating form-floating-outline mb-5">
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Enter your email" value="{{ old('email') }}" required autofocus
                            autocomplete="email">
                        <label for="email">Email</label>
                        @error('email')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <div class="form-password-toggle">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" required autocomplete="current-password" />
                                    <label for="password">Password</label>
                                </div>
                                <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                            </div>
                        </div>
                        @error('password')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5 d-flex justify-content-between mt-5">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="remember-me">
                            <label class="form-check-label" for="remember-me">
                                Remember Me
                            </label>
                        </div>
                        <a href="auth-forgot-password-basic.html" class="float-end mb-1 mt-2">
                            <span>Forgot Password?</span>
                        </a>
                    </div>
                    <div class="mb-5">
                        <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
