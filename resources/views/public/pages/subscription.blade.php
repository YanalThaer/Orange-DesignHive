@extends('layouts.public')
@section('title', 'DesignHive | Subscription Plans')
@section('content')
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #fff;
        color: #2c2c3b;
    }

    .pricing-title {
        font-size: 2.5rem;
        font-weight: 600;
        color: #420363;
    }

    .price-box {
        border: 2px solid #420363;
        border-radius: 20px;
        padding: 2rem;
    }

    .btn-pink {
        background-color: #420363;
        border: none;
        color: #fff;
        padding: 0.75rem 2rem;
        font-weight: 500;
        border-radius: 30px;
    }

    .text-muted-custom {
        color: #ccc;
    }

    .nav-link-custom {
        color: #2c2c3b;
        margin-right: 1rem;
    }

    .download-btn {
        border: 2px solid #420363;
        color: #420363;
        border-radius: 10px;
        padding: 0.3rem 1rem;
    }

    .check-icon {
        color: #4caf50;
        margin-right: 0.5rem;
    }

    @media (max-width: 768px) {
        .pricing-title {
            font-size: 1.8rem;
        }
    }
</style>
<div class="container py-4">
    <div class="text-center">
        <div class="mb-4">
            <h1 class="pricing-title">Level Up Your Design Game</h1>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-md-4 mb-4">
                <div class="price-box">
                    <div>
                        <h4>Basic</h4>
                        <p>$15/month</p>
                        <p><span class="check-icon">✔</span>Featured project visibility</p>
                        <p><span class="check-icon">✔</span>Project view counter</p>
                        <p><span class="check-icon">✔</span>Basic visitor statistics</p>
                        <p class="text-muted-custom">Full chat access</p>
                        <p class="text-muted-custom">Collaboration tools</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="price-box">
                    <h4>Pro Designer</h4>
                    <p>$30/month</p>
                    <p><span class="check-icon">✔</span>All Basic features</p>
                    <p><span class="check-icon">✔</span>Chat with other designers</p>
                    <p><span class="check-icon">✔</span>Send/Receive collaboration requests</p>
                    <p><span class="check-icon">✔</span>“Pro Designer” profile badge</p>
                    <p><span class="check-icon">✔</span>Schedule post publishing</p>
                </div>
            </div>
        </div>
        <div>
            <a href="{{ route('payment') }}" class="btn btn-pink">Get Started</a>
        </div>
    </div>
</div>
@endsection