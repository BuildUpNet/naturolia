@extends('layout.main')

@section('content')
<section id="terms-conditions-page" class="py-5" style="min-height: 80vh;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <header class="text-center mb-5" data-aos="fade-down">
                    <h1 class="display-4 fw-bold" style="color: var(--primary-color);">Terms & Conditions</h1>
                   <p class="lead text-muted">
    Welcome to www.naturolia.in . These Terms & Conditions  explain the rules for using our Website and purchasing our products. By accessing or placing an order, you agree to follow these Terms. If you disagree, please stop using the Website.
</p>

                </header>

                <div class="policy-content">

                    <div class="policy-section mb-5" data-aos="fade-up">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">1. Acceptance of Terms</h2>
                        <p class="text-secondary">
                            By using this Website, you accept and agree to be bound by these Terms, our Privacy Policy, Shipping Policy and Return & Refund Policy, as may be updated from time to time. If you do not agree with any part of these Terms, please do not use the Website.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">2. Eligibility</h2>
                        <p class="text-secondary">
                            You must be at least 18 years old and legally capable of entering into binding contracts to use this Website or purchase any products from us. If you are under 18, you may use the Website only under the supervision of a parent or legal guardian.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">3. Product Information, Pricing & Availability</h2>
                        <p class="text-secondary">
                            We endeavour to ensure that product descriptions, images and pricing on the Website are accurate. However, we do not guarantee that all information is error-free. We reserve the right to correct any errors, change product specifications, adjust pricing or modify availability at any time without prior notice.
                        </p>
                        <p class="text-secondary">
                            All prices shown are in Indian Rupees (INR) and include applicable taxes unless otherwise stated.
                        </p>
                    </div>

                    <!-- ✅ Order Cancellation Policy (Updated Instruction Added) -->
                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">4. Order Cancellation Policy</h2>
                        <p class="text-secondary">
                            You can easily cancel your order through your Naturolia account if the order has not yet been shipped.
                        </p>
                        <ul class="text-secondary ps-3">
                            <li>Go to your <strong>Profile</strong> section on the Website.</li>
                            <li>Open the <strong>Order History</strong> tab.</li>
                            <li>If your order status shows <strong>Not Shipped</strong>, click on the <strong>Cancel Order</strong> button.</li>
                            <li>Your order will be cancelled immediately, and any payment made will be refunded to your original payment method within 7–10 business days.</li>
                        </ul>
                        <p class="text-secondary">
                            Once the order has been shipped, it cannot be cancelled. In such cases, you may refer to our Return & Refund Policy after the product is delivered.
                        </p>
                    </div>

                    <!-- ✅ Account Deletion Process -->
                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="400">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">5. Account Deletion Process</h2>
                        <p class="text-secondary">
                            You can permanently delete or temporarily deactivate your account directly from your profile settings. 
                            Go to your <strong>Profile</strong> → <strong>Account Settings</strong> → click on <strong>“Delete Account”</strong> to permanently remove or inactivate your account.
                        </p>
                        <p class="text-secondary">
                            Once confirmed, your account and associated data will be deleted within 7 business days, except where retention is legally required.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="500">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">6. Payment & Billing</h2>
                        <p class="text-secondary">
                            You agree to provide accurate and complete payment information when placing your order. Payment must be made through the secure methods available on the Website. If your payment fails or is declined, the order will not be processed.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="600">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">7. Use of Website & Restrictions</h2>
                        <p class="text-secondary">
                            You agree to use the Website for lawful purposes only and in accordance with all applicable laws. You must not attempt to gain unauthorized access to any part of the Website or misuse its features.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="700">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">8. Intellectual Property</h2>
                        <p class="text-secondary">
                            All Website content, including text, graphics, logos, and images, is the property of Naturolia or its licensors. It may not be copied, distributed, or used without written consent.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="800">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">9. Limitation of Liability</h2>
                        <p class="text-secondary">
                            Naturolia shall not be liable for any direct or indirect damages arising from your use of the Website, delays in shipment, or the use of our products. Your sole remedy is to discontinue using the Website or request a refund under the applicable policy.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="900">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">10. Governing Law & Jurisdiction</h2>
                        <p class="text-secondary">
                            These Terms shall be governed by and construed under the laws of India. Any disputes will be subject to the exclusive jurisdiction of the courts located in [Your City], India.
                        </p>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="1000">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">11. Contact Details</h2>
                        <p class="text-secondary">
                            For any queries related to these Terms, please contact:
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
