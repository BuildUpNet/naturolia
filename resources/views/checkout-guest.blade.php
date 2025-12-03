@extends('layout.main')
@section('content')
<style>
    :root {
        --primary-color: #007300;
        --secondary-color: #38b000;
        --accent-color: #cddc39;
        --light-bg: #f8f9fa;
        --text-color: #333;
    }

    .checkout-section {
        padding-top: 100px !important;
    }

    .checkout-step .card-header {
        background-color: var(--light-bg);
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--text-color);
        padding: 15px 20px;
    }

    .place-order-btn {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
        color: #fff;
        font-weight: bold;
        padding: 12px 20px;
        transition: 0.3s;
    }

    .place-order-btn:hover {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: #fff;
    }

    .page-checkout-heading {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary-color);
        border-bottom: 3px solid var(--accent-color);
        padding-bottom: 10px;
        margin-bottom: 30px !important;
        display: inline-block;
    }

    @media (min-width: 992px) {
        .summary-sticky {
            position: sticky;
            top: 80px;
        }
    }
</style>

<section id="checkout" class="checkout-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="page-checkout-heading"><i class="fas fa-shopping-cart me-2"></i>GUEST CHECKOUT</h1>
        </div>

        <div class="row g-4">
            <!-- Left Column -->
            <div class="col-lg-8">
                <form method="POST" action="{{ route('checkout.guest.place') }}">
                    @csrf

                    <!-- Step 1: Contact Details -->
                    <div class="card checkout-step mb-3 shadow-sm">
                        <div class="card-header">
                            <span class="text-success me-2"><i class="fas fa-user"></i></span>
                            1. CONTACT DETAILS
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Phone</label>
                                  <input type="tel" name="phone" class="form-control"
       placeholder="99999 99999" maxlength="10"
       oninput="this.value = this.value.replace(/[^0-9]/g, '');"
       required>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Shipping Address -->
                    <div class="card checkout-step mb-3 shadow-sm">
                        <div class="card-header">
                            <span class="text-success me-2"><i class="fas fa-map-marker-alt"></i></span>
                            2. SHIPPING ADDRESS
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="123, Street Name" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">City</label>
                                    <input type="text" name="city" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">State</label>
                                    <input type="text" name="state" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Pincode</label>
                                    <input type="text" name="pincode" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Order Summary -->
                    <div class="card checkout-step mb-3 shadow-sm">
                        <div class="card-header">3. ORDER SUMMARY</div>
                        <div class="card-body">
                            @foreach ($cartItems as $item)
                                <div class="d-flex border-bottom pb-3 mb-3 align-items-center">
                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" style="width:60px; height:60px; object-fit:cover;" class="me-3">
                                    <div>
                                        <p class="fw-bold mb-1">{{ $item['title'] }}</p>
                                        <p class="mb-0 small text-muted">
                                            Qty: {{ $item['quantity'] ?? 1 }} |
                                            Price: ₹{{ number_format($item['price'] ?? 0, 2) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Step 4: Payment -->
                    <div class="card checkout-step mb-3 shadow-sm">
                        <div class="card-header">4. PAYMENT OPTIONS</div>
                        <div class="card-body">
                            <div class="form-check mb-3 p-3 border rounded-3 bg-light">
                                <input class="form-check-input" type="radio" name="payment_method" value="cod" id="cod" checked>
                                <label class="form-check-label fw-bold" for="cod">
                                    <i class="fas fa-handshake me-2"></i> Cash on Delivery (COD)
                                </label>
                            </div>
                            <div class="form-check mb-3 p-3 border rounded-3">
                                <input class="form-check-input" type="radio" name="payment_method" value="online" id="online">
                                <label class="form-check-label fw-bold" for="online">
                                    <i class="fas fa-credit-card me-2"></i> Online Payment (UPI / Cards)
                                </label>
                            </div>

                            <div class="border-top pt-3 mt-4">
                                <button type="submit" id="placeOrderBtn" class="btn btn-lg w-100 place-order-btn">
                                    PLACE ORDER (TOTAL: ₹{{ number_format($totalPrice, 2) }})
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <div class="card shadow-sm p-4 summary-sticky">
                    <h5 class="mb-3 text-dark border-bottom pb-2">PRICE DETAILS</h5>

                    <div class="d-flex justify-content-between py-2">
                        <span class="text-muted small">Price ({{ count($cartItems) }} items)</span>
                        <span class="small">₹{{ number_format($totalPrice, 2) }}</span>
                    </div>

                    <div id="codChargeRow" class="d-flex justify-content-between py-2" style="display:none;">
                        <span class="text-muted small">COD Charges</span>
                        <span class="small" id="codChargeAmount">₹{{ number_format($codCharge ?? 0, 2) }}</span>
                    </div>

                    <div class="d-flex justify-content-between py-3 border-top border-2 mt-2">
                        <h5 class="fw-bold text-dark mb-0">Total Payable</h5>
                        <h5 class="fw-bold text-dark mb-0" id="finalTotal">
                            ₹{{ number_format($totalPrice, 2) }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const codInput = document.getElementById("cod");
    const onlineInput = document.getElementById("online");
    const codRow = document.getElementById("codChargeRow");
    const finalTotal = document.getElementById("finalTotal");
    const placeOrderBtn = document.getElementById("placeOrderBtn");

    const codCharge = parseFloat("{{ $codCharge ?? 0 }}");
    const baseTotal = parseFloat("{{ $totalPrice }}");

    function updateTotal() {
        let newTotal = baseTotal;

        if (codInput.checked) {
            codRow.style.display = "flex";
            newTotal += codCharge;
        } else {
            codRow.style.display = "none";
        }

        finalTotal.textContent = "₹" + newTotal.toFixed(2);
        placeOrderBtn.innerHTML = `PLACE ORDER (TOTAL: ₹${newTotal.toFixed(2)})`;
    }

    codInput.addEventListener("change", updateTotal);
    onlineInput.addEventListener("change", updateTotal);

    updateTotal();
});
</script>
@endsection
