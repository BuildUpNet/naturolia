@extends('layout.main')

@section('content')
<section id="cancellation-policy-page" class="py-5" style="min-height: 80vh;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <header class="text-center mb-5" data-aos="fade-down">
                    <h1 class="display-4 fw-bold" style="color: var(--primary-color);">Cancellation Policy</h1>
                    <p class="lead text-muted">
                        At Naturolia, we strive to make your shopping experience smooth and transparent. You can cancel your order easily if it has not yet been dispatched.
                    </p>
                </header>
                
                <div class="policy-content">
                    
                    <div class="policy-section mb-5" data-aos="fade-up">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">1. Before Dispatch</h2>
                        <p class="text-secondary">
                            Orders can be cancelled only if the shipment has <strong>not been dispatched</strong> from our warehouse. 
                        </p>
                        <p class="text-secondary">
                            To cancel your order, please go to your <strong>User Profile → Order History</strong> and click on the <strong>“Cancel”</strong> button if the order status is pending or not shipped.
                        </p>
                        <p class="text-secondary">
                            You can also reach us at 
                           <a href="mailto:Naturoliapharma@gmail.com">Naturoliapharma@gmail.com</a> or call our support team at 
                            <strong>+91-97804-11123</strong> (Monday to Saturday, 10 AM – 7 PM).
                        </p>
                        <p class="text-secondary">
                            Once your cancellation request is approved, your refund will be processed within <strong>2–5 business days</strong>.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">2. After Dispatch</h2>
                        <p class="text-secondary">
                            Once the order has been dispatched, it <strong>cannot be cancelled</strong>. However, if you no longer wish to receive the order, you may refuse delivery. The parcel will be marked as “Return to Origin,” and your refund will be processed once we receive the returned package.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">3. Fraudulent or Invalid Transactions</h2>
                        <p class="text-secondary">
                            Naturolia reserves the right to cancel any order that appears to be fraudulent, incomplete, or placed in violation of our Terms & Conditions.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">4. Contact Us</h2>
                        <p class="text-secondary">
                            For any questions or assistance related to cancellations, please contact us:
                        </p>
                        <ul class="list-unstyled text-secondary ps-3">
                            <li class="mb-2"><i class="fa-solid fa-envelope me-2"></i><strong>Email:</strong> <a href="mailto:Naturoliapharma@gmail.com">Naturoliapharma@gmail.com</a></li>
                            <li class="mb-2"><i class="fa-solid fa-phone me-2"></i><strong>Customer Care:</strong> +91-97804-11123</li>
                            <li class="mb-2"><i class="fa-solid fa-clock me-2"></i><strong>Timings:</strong> Monday – Saturday, 10 AM to 7 PM</li>
                        </ul>
                    </div>

                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection
