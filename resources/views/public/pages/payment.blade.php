@extends('layouts.public')
@section('title', 'DesignHive | Subscription Plans')
@section('content')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #fff;
        color: #000;
    }

    .payment-box {
        border: 1px solid #eee;
        border-radius: 15px;
        padding: 2rem;
        background-color: #fff;
    }

    .price-box {
        border-radius: 15px;
        padding: 2rem;
        background-color: white;
    }

    .btn-paypal {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 50px;
        padding: 0.6rem 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 45px;
        width: 48%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .btn-gpay {
        background-color: #000;
        color: #fff;
        border-radius: 50px;
        padding: 0.6rem 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 45px;
        width: 48%;
        font-weight: 600;
        gap: 0.5rem;
        border: none;
    }

    .form-control::placeholder {
        color: #bbb;
    }

    .subscribe-btn {
        background-color: #545065;
        color: white;
        font-weight: 600;
        width: 100%;
        border-radius: 50px;
        padding: 0.75rem;
    }

    .btn-paypal {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 50px;
        padding: 0.6rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 45px;
        width: 48%;
        gap: 0.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .btn-gpay {
        background-color: #000;
        color: #fff;
        border-radius: 50px;
        padding: 0.6rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 45px;
        width: 48%;
        font-weight: 600;
        gap: 0.5rem;
        border: none;
    }

    .subscribe-btn:hover {
        background-color: #3f3a51;
    }

    @media (max-width: 768px) {

        .btn-paypal,
        .btn-gpay {
            width: 100%;
            margin-bottom: 10px;
        }
    }

    .title-text {
        font-size: 2rem;
        font-weight: 600;
    }

    #planSelect {
        border-radius: 12px;
        padding: 0.6rem 1rem;
        font-size: 1rem;
        font-weight: 500;
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        transition: all 0.2s ease-in-out;
    }

    #planSelect:focus {
        outline: none;
        border-color: #420363;
        box-shadow: 0 0 0 0.2rem rgba(199, 112, 255, 0.2);
        background-color: #fff;
    }

    #planSelect {
        appearance: none;
        background-image: url('data:image/svg+xml;charset=UTF-8,<svg fill="gray" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M7.41 8.59 10 11.17l2.59-2.58L14 10l-4 4-4-4z"/></svg>');
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1rem;
        padding-right: 2.5rem;
    }

    a {
    text-decoration: none !important;
}

</style>
<div class="container pb-4">
    <div class="row justify-content-center mb-4">
        <!-- <div class="col-12 text-center">
            <h2 class="title-text">Build your design career<br>with DesignHive Pro</h2>
        </div> -->
    </div>
    <div class="row justify-content-center g-4">
        <div class="col-lg-6">
            <div class="payment-box shadow-sm">
                <h5 class="mb-4 fw-semibold">Payment details</h5>
                <div class="d-flex justify-content-between mb-3 flex-wrap gap-2">
                    <button class="btn-paypal">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" height="22">
                        <span class="ms-2"></span>
                    </button>
                    <button class="btn-gpay">
                    <img src="{{ asset('assets/img/qq.png') }}" alt="GPay" height="50" width="50">
                    <span></span>
                    </button>
                </div>
                <p class="text-muted mb-3">or pay another way</p>
                <form>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Cardholder Name</label>
                        <input type="text" class="form-control" placeholder="Full name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Card Number</label>
                        <input type="text" class="form-control" placeholder="4111 1111 1111 1111" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Expiration</label>
                            <input type="text" class="form-control" placeholder="MM/YY" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">CVV</label>
                            <input type="text" class="form-control" placeholder="123" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Postal Code</label>
                        <input type="text" class="form-control" placeholder="Postal or ZIP code" required>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="price-box shadow-sm">
                <div class="mb-3">
                    <label for="planSelect" class="form-label fw-semibold">Choose your plan</label>
                    <select id="planSelect" class="form-select">
                        <option value="basic" data-price="180">Basic – $15/month</option>
                        <option value="pro" data-price="360" selected>Pro Designer – $30/month</option>
                    </select>
                </div>
                <h6 class="fw-semibold mb-3" id="planTitle">Dribbble Pro Designer<br><small class="text-muted" id="planYear">$30/month</small></h6>
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <span id="subtotalPrice">$720.00</span>
                </div>
                <div class="d-flex justify-content-between text-purple fw-semibold mb-3" style="color: #420363;">
                    <span>Yearly plan discount</span>
                    <span id="discountPrice">-$360.00</span>
                </div>
                <div class="d-flex justify-content-between fw-bold border-top pt-2 mb-3">
                    <span>Billed Now</span>
                    <span id="billedNow">USD $360.00</span>
                </div>
                <button class="subscribe-btn" style="background-color: #420363; color: #fff;" data-bs-toggle="modal" data-bs-target="#420363" >Subscribe</button>
                <p class="text-muted mt-3 small">
                    All sales are charged in USD and all sales are final. You will be charged the full amount immediately. You will be charged yearly thereafter while the subscription is active. Cancel any time.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 text-center px-4 py-5" style="background-color: #f9f9fb;">
            <div class="modal-body">
                <div class="mb-3">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Success" width="64" height="64">
                </div>
                <h5 class="modal-title fw-bold mb-3" id="subscribeModalLabel" style="color: #4CAF50;">
                    Subscription Successful!
                </h5>
                <p class="text-muted">Thank you for subscribing to DesignHive Pro </p>
                <button type="button" class="btn btn-outline-dark rounded-pill px-4 mt-4" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const planSelect = document.getElementById('planSelect');
    const planTitle = document.getElementById('planTitle');
    const planYear = document.getElementById('planYear');
    const subtotal = document.getElementById('subtotalPrice');
    const discount = document.getElementById('discountPrice');
    const billedNow = document.getElementById('billedNow');

    planSelect.addEventListener('change', function() {
        const selectedOption = planSelect.options[planSelect.selectedIndex];
        const planType = selectedOption.value;
        const yearlyPrice = parseInt(selectedOption.dataset.price);
        const monthlyPrice = planType === 'basic' ? 15 : 30;

        const subtotalAmount = yearlyPrice * 2;
        const discountAmount = yearlyPrice;

        planTitle.innerHTML = `Dribbble ${planType === 'pro' ? 'Pro Designer' : 'Basic'}<br><small class="text-muted">$${monthlyPrice}/month</small>`;
        planYear.innerText = `$${monthlyPrice}/month`;
        subtotal.innerText = `$${subtotalAmount}.00`;
        discount.innerText = `-$${discountAmount}.00`;
        billedNow.innerText = `USD $${yearlyPrice}.00`;
    });

    document.querySelector('.subscribe-btn').addEventListener('click', function() {
        const subscribeModal = new bootstrap.Modal(document.getElementById('subscribeModal'));
        subscribeModal.show();
    });
</script>
@endsection