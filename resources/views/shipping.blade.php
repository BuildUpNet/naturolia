@extends('layout.main')

@section('content')
<section id="shipping-policy-page" class="py-5" style="min-height: 80vh;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <header class="text-center mb-5" data-aos="fade-down">
                    <h1 class="display-4 fw-bold" style="color: var(--primary-color);">Shipping Policy</h1>
                    <p class="lead text-muted">
                        At Naturolia, we are committed to delivering your favorite wellness products safely and on time. This Shipping Policy outlines our delivery process, timelines, and conditions.
                    </p>
                </header>

                <div class="policy-content">

                    <div class="policy-section mb-5" data-aos="fade-up">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">1. Shipping Coverage</h2>
                        <p class="text-secondary">
                            We currently ship to almost all major pin codes across India through our trusted courier and logistics partners. Our goal is to ensure that your order reaches you quickly and in perfect condition, no matter where you are.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">2. Order Processing Time</h2>
                        <p class="text-secondary">
                            Orders are typically processed within <strong>1–2 business days</strong> after confirmation. During peak seasons, festivals, or sales, order processing may take slightly longer due to increased demand.
                        </p>
                        <p class="text-secondary">
                            Once your order is processed, you will receive a confirmation email or SMS with your tracking details.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">3. Estimated Delivery Time</h2>
                        <p class="text-secondary">
                            Delivery timelines depend on your location:
                        </p>
                        <ul class="text-secondary ps-3">
                            <li><strong>Metro Cities:</strong> 2–4 business days</li>
                            <li><strong>Other Urban Areas:</strong> 3–6 business days</li>
                            <li><strong>Remote / Rural Locations:</strong> 5–8 business days</li>
                        </ul>
                        <p class="text-secondary">
                            Please note that delays caused by natural calamities, strikes, or courier network disruptions are beyond our control.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">4. Order Tracking</h2>
                        <p class="text-secondary">
                            Once your order is shipped, you will receive a tracking link via email or SMS. You can use this link to check the real-time status and estimated delivery date of your package.
                        </p>
                        <p class="text-secondary">
                            If you face any issues tracking your order, please contact our support team for assistance.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="400">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">5. Failed Delivery Attempts</h2>
                        <p class="text-secondary">
                            Our delivery partners will attempt delivery up to <strong>three times</strong>. If the order remains undelivered after multiple attempts due to incorrect address, unavailability, or refusal to accept, it will be returned to our warehouse.
                        </p>
                        <p class="text-secondary">
                            Once returned, the refund (if applicable) will be processed after deducting handling charges.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="500">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">6. International Shipping</h2>
                        <p class="text-secondary">
                            Currently, Naturolia does not offer international shipping. We are working on expanding our reach to serve global customers soon.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="600">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">7. Damaged or Lost Packages</h2>
                        <p class="text-secondary">
                            In the unlikely event that your package is damaged or lost in transit, please contact us within <strong>48 hours</strong> of delivery or the expected delivery date. We will investigate the issue with our logistics partner and arrange a replacement or refund as applicable.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="700">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">8. Contact Us</h2>
                        <p class="text-secondary">
                            For questions or concerns related to shipping, please reach out to us:
                        </p>
                        <ul class="list-unstyled text-secondary ps-3">
                            <li class="mb-2"><i class="fa-solid fa-envelope me-2"></i><strong>Email:</strong> <a href="mailto:Naturoliapharma@gmail.com">Naturoliapharma@gmail.com</a></li>
                            <li class="mb-2"><i class="fa-solid fa-phone me-2"></i><strong>Phone:</strong> +91-97804-11123</li>
                            <li class="mb-2"><i class="fa-solid fa-clock me-2"></i><strong>Business Hours:</strong> Monday – Saturday, 10 AM to 7 PM</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
