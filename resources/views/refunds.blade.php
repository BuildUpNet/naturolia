@extends('layout.main')

@section('content')
<section id="refund-policy-page" class="py-5" style="min-height: 80vh;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <header class="text-center mb-5" data-aos="fade-down">
                    <h1 class="display-4 fw-bold" style="color: var(--primary-color);">Refund Policy</h1>
                    <p class="lead text-muted">
                        At Naturolia, your satisfaction is our priority. We aim to ensure quick and hassle-free refunds for all eligible orders.
                    </p>
                </header>
                
                <div class="policy-content">

                    <div class="policy-section mb-5" data-aos="fade-up">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">1. Refund Eligibility</h2>
                        <p class="text-secondary">
                            Refunds are applicable in the following cases:
                        </p>
                        <ul class="list-unstyled text-secondary ps-3">
                            <li class="mb-2"><i class="fa-solid fa-file-invoice text-success me-2"></i>Order cancelled before dispatch.</li>
                            <li class="mb-2"><i class="fa-solid fa-box-open text-success me-2"></i>Product returned as per our Return Policy (damaged, defective, or wrong item received).</li>
                            <li class="mb-2"><i class="fa-solid fa-truck-fast text-success me-2"></i>Failed delivery due to customer unavailability or incorrect address.</li>
                        </ul>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">2. Refund Process</h2>
                        <p class="text-secondary">
                            Once your return or cancellation request is approved, we will initiate your refund within <strong>2–5 business days</strong>.
                        </p>
                        <p class="text-secondary">
                            You will receive a confirmation email or message once the refund has been processed from our end.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">3. Mode of Refund</h2>
                        <p class="text-secondary"><strong>Prepaid Orders (Credit/Debit Card, Net Banking, UPI):</strong> Refunds will be credited back to the original payment method within <strong>2–5 business days</strong> after product verification.</p>
                        <p class="text-secondary"><strong>Cash on Delivery (COD) Orders:</strong> Refunds will be processed via <strong>bank transfer</strong> within <strong>2–5 business days</strong> after you share your bank details with us.</p>
                        <p class="text-secondary small mt-3">
                            <i class="fa-solid fa-clock text-warning me-2"></i><strong>Note:</strong> Refund reflection time may vary depending on your bank or payment provider.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">4. Non-Refundable Situations</h2>
                        <ul class="list-unstyled text-secondary ps-3">
                            <li class="mb-2"><i class="fa-solid fa-ban text-danger me-2"></i>Products damaged after delivery due to misuse or negligence.</li>
                            <li class="mb-2"><i class="fa-solid fa-ban text-danger me-2"></i>Items returned without original packaging, seal, or invoice.</li>
                            <li class="mb-2"><i class="fa-solid fa-ban text-danger me-2"></i>Opened or partially used wellness or personal care products.</li>
                        </ul>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="400">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">5. Contact Us</h2>
                        <p class="text-secondary">
                            If you have any questions or concerns about your refund, please contact us:
                        </p>
                        <ul class="list-unstyled text-secondary ps-3">
                           <li class="mb-2"><i class="fa-solid fa-envelope me-2"></i><strong>Email:</strong> <a href="mailto:Naturoliapharma@gmail.com">Naturoliapharma@gmail.com</a></li>
                            <li class="mb-2"><i class="fa-solid fa-phone me-2"></i><strong>Customer Care:</strong> +91-97804-11123</li>
                            <li class="mb-2"><i class="fa-solid fa-clock me-2"></i><strong>Timings:</strong> Monday – Saturday, 10 AM to 7 PM</li>
                        </ul>
                        <p class="text-secondary mt-4 fst-italic">
                            We are committed to ensuring a transparent and customer-friendly refund process for all our valued customers.
                        </p>
                    </div>

                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection
