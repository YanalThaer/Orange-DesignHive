@extends('layouts.app')
@section('title', 'Register')
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
        flex: 0 0 35%;
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
        padding-bottom: 0 !important;
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

    <!-- Right Side: Sign Up Form -->
    <div class="form-side">
        <div class="w-100" style="max-width: 500px;">
            <h2 class="mb-4 fw-bold text-center">Sign up to DesignHive</h2>

            <a href="{{ route('auth.google') }}" class="btn btn-outline-dark w-100 mb-3 d-flex align-items-center justify-content-center" style="border-radius: 14px; border-color: var(--bs-light-border-subtle) !important;">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" class="me-2" width="20">
                Sign up with Google
            </a>

            <div class="text-center text-muted mb-3">or sign up with email</div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row g-3 mb-3">
                    <div class="col">
                        <label for="name" class="form-label fw-semibold">Name</label>
                        <input id="name" type="text" class="form-control rounded-3 @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                        <span class="invalid-feedback d-block mt-1"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input id="email" type="email" class="form-control rounded-3 @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required>
                    @error('email')
                    <span class="invalid-feedback d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input id="password" type="password" class="form-control rounded-3 @error('password') is-invalid @enderror"
                        name="password" required placeholder="6+ characters">
                    @error('password')
                    <span class="invalid-feedback d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                    <input id="password_confirmation" type="password" class="form-control rounded-3"
                        name="password_confirmation" required placeholder="Confirm your password">
                </div>

                <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-bold">Create Account</button>

                <div class="text-center mt-4">
                    <small>Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Sign In</a></small>
                </div>

                <div class="text-muted text-center mt-3" style="font-size: 0.75rem;">
                    This site is protected by reCAPTCHA and the Google <a href="#" class="text-decoration-underline">Privacy Policy</a> and <a href="#" class="text-decoration-underline">Terms of Service</a> apply.
                </div>
            </form>
        </div>
    </div>
</div>
@endsection