@extends('layouts.app')
@section('title', 'Login')
@section('content')
<style>
    html, body {
        height: 100%;
        margin: 0;
    }

    .auth-container {
        display: flex;
        height: 100vh;
        margin: 0;
    }

    .video-side {
        flex: 0 0 35%; /* قللت العرض أكثر */
        position: relative;
        height: 100vh;
    }

    .video-side .full-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 80%;
        height: 100%;
        object-fit: cover;
    }

    .form-side {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        background-color: #f8f9fa;
        padding-left: 3rem;
    }

    .py-4 {
        padding-top: 0 !important;
        padding-bottom: 0!important;
    }

    @media (max-width: 768px) {
        .video-side {
            display: none;
        }

        .form-side {
            justify-content: center;
            padding: 1rem;
        }
    }
</style>

<div class="auth-container">
    <!-- Left Side: Image -->
    <div class="video-side d-none d-md-block">
        <img src="{{ asset('assets/img/olla.jpg') }}" alt="DesignHive" class="img-fluid full-img">
    </div>

    <!-- Right Side: Login Form -->
    <div class="form-side">
        <div class="w-100" style="max-width: 400px;">
            <h2 class="mb-4 fw-bold text-center">Sign in to DesignHive</h2>

            <a href="{{ route('auth.google') }}" class="btn btn-outline-dark w-100 mb-3 d-flex align-items-center justify-content-center" style="border-radius: 14px; border-color: var(--bs-light-border-subtle) !important;">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" class="me-2" width="20">
                Sign in with Google
            </a>

            <div class="text-center text-muted mb-3">or sign in with email</div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Username or Email</label>
                    <input id="email" type="email" class="form-control rounded-3 border-light-subtle @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autofocus>

                    @error('email')
                        <span class="invalid-feedback d-block mt-1">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <label for="password" class="form-label fw-semibold mb-0">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="small text-decoration-none">Forgot?</a>
                    @endif
                </div>

                <div class="mb-3">
                    <input id="password" type="password" class="form-control rounded-3 border-light-subtle @error('password') is-invalid @enderror"
                        name="password" required>

                    @error('password')
                        <span class="invalid-feedback d-block mt-1">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>

                <button type="submit" class="btn btn-dark w-100 rounded-4 py-2">Sign In</button>

                <div class="text-center mt-4">
                    <small>Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Sign up</a></small>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection