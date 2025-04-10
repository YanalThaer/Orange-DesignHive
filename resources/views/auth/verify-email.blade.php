@extends('layouts.app')
@section('title', 'Verify Email')
@section('content')
<main class="d-flex justify-content-center align-items-center" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; padding: 0; margin: 0; overflow: hidden;">
    <div class="container p-4" style="max-width: 480px; width: 100%; background: white; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <h2 class="fw-bold mb-3 text-center">Verify Your Email</h2>

        @if(session('status'))
            <p class="text-center text-success">{{ session('status') }}</p>
        @endif

        <p class="text-muted mb-3 text-center">
            Please enter the verification code sent to your email to proceed.
        </p>

        <form id="verify-form" method="POST" action="{{ route('verify.email.code') }}">
            @csrf

            <div class="mb-4">
                <label for="code" class="form-label fw-semibold">Enter the code</label>
                <input type="text" name="code" class="form-control p-3 rounded-4 border-2 @error('code') is-invalid @enderror" required>

                @error('code')
                    <span class="invalid-feedback d-block mt-1"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <button type="submit" id="submit-btn" class="btn btn-dark rounded-pill w-100 py-2 fw-bold">
                Verify
            </button>

            <div class="text-center mt-4">
                <small>Time remaining: <span id="countdown">02:00</span></small>
            </div>
        </form>

        <div id="expiredModal" style="display:none; position: fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center;">
            <div style="background: white; padding: 30px; border-radius: 10px; text-align: center; max-width: 400px; margin: auto;">
                <h3 style="margin-bottom: 15px;">Code Expired</h3>
                <p>The verification code has expired. Please register again to receive a new one.</p>
                <button onclick="closeModal()" style="margin-top: 20px; padding: 10px 20px; background-color: #dc3545; color: white; border: none; border-radius: 5px;">OK</button>
            </div>
        </div>
    </div>

    <script>
        let duration = 1*60;
        let countdown = document.getElementById('countdown');
        let submitBtn = document.getElementById('submit-btn');
        let modal = document.getElementById('expiredModal');
        let form = document.getElementById('verify-form');

        const timer = setInterval(function () {
            let minutes = Math.floor(duration /60 );
            let seconds = duration % 60;

            countdown.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

            if (--duration < 0) {
                clearInterval(timer);
                countdown.textContent = "Expired";
                submitBtn.disabled = true;
                modal.style.display = 'flex';
            }
        }, 1000);

        function closeModal() {
            modal.style.display = 'none';
        }
    </script>
</main>
@endsection