@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-white px-3">
    <div style="max-width: 480px; width: 100%;">
        <h2 class="fw-bold mb-3">Reset Your Password</h2>

        <p class="text-muted mb-3">
            Enter your email and a new password to reset your account. Make sure your new password is strong and secure.
        </p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-4">
                <label for="email" class="form-label fw-semibold">Email Address</label>
                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}"
                    class="form-control p-3 rounded-4 border-2 @error('email') is-invalid @enderror"
                    style="border-color: #f5d5f9;" required autofocus>
                @error('email')
                    <span class="invalid-feedback d-block mt-1"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label fw-semibold">New Password</label>
                <input id="password" type="password" name="password"
                    class="form-control p-3 rounded-4 border-2 @error('password') is-invalid @enderror"
                    style="border-color: #f5d5f9;" required>
                @error('password')
                    <span class="invalid-feedback d-block mt-1"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password-confirm" class="form-label fw-semibold">Confirm Password</label>
                <input id="password-confirm" type="password" name="password_confirmation"
                    class="form-control p-3 rounded-4 border-2"
                    style="border-color: #f5d5f9;" required>
            </div>

            <button type="submit" class="btn btn-dark rounded-pill w-100 py-2 fw-bold">
                Reset Password
            </button>
        </form>
    </div>
</div>
@endsection
