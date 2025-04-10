@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light px-3">
    <div style="max-width: 480px; width: 100%;">
        <h2 class="fw-bold mb-3 text-center">Reset Your Password</h2>

        <p class="text-muted mb-3 text-center">
            Enter your email address to receive a password reset link.
        </p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="form-label fw-semibold">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    class="form-control p-3 rounded-4 border-2 @error('email') is-invalid @enderror"
                    style="border-color: #f5d5f9;" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback d-block mt-1"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <button type="submit" class="btn btn-dark rounded-pill w-100 py-2 fw-bold">
                Send Password Reset Link
            </button>

            <div class="text-center mt-4">
                <small>Remember your password? <a href="{{ route('login') }}" class="text-decoration-none">Sign In</a></small>
            </div>
        </form>
    </div>
</div>
@endsection