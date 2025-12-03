@extends('layout.main')

@section('content')
<section id="returns-policy-page" class="py-5" style="min-height: 80vh;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <header class="mb-4 text-center">
                    <h1 class="display-4 fw-bold" style="color: var(--primary-color);">Returns & Replacements</h1>
                    <p class="lead text-muted">
                        We offer a simple 5-day return policy for eligible products to ensure customer satisfaction and safety.
                    </p>
                </header>
                
                <div class="policy-content">

                    <div class="policy-section mb-5" data-aos="fade-up">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">Returns & Replacements</h2>
                        <p class="text-secondary mb-3">
                            You can request a return or replacement within <strong>5 days of receiving your order</strong> if:
                        </p>
                        <ul class="list-unstyled text-secondary ps-3">
                            <li class="mb-2">
                                <i class="fa-solid fa-circle-right text-success me-2"></i>You have received a damaged, defective, leaking, or wrong product.
                            </li>
                            <li class="mb-2">
                                <i class="fa-solid fa-circle-right text-success me-2"></i>The product delivered does not match your order details.
                            </li>
                        </ul>
                        
                        <p class="text-secondary mt-4"><strong>Please note:</strong></p>
                        <ul class="list-unstyled text-secondary ps-3">
                            <li class="mb-2">
                                <i class="fa-solid fa-ban text-danger me-2"></i>Returns are accepted only if products are <strong>unused, unopened, and in their original packaging</strong> with all seals, labels, and barcodes intact.
                            </li>
                            <li class="mb-2">
                                <i class="fa-solid fa-gift text-info me-2"></i>Any free gifts, sample packs, or promotional items must also be returned with the original order.
                            </li>
                            <li class="mb-2">
                                <i class="fa-solid fa-xmark text-danger me-2"></i>We cannot accept returns for products that are <strong>opened, used, or altered</strong> for hygiene and safety reasons.
                            </li>
                        </ul>
                        
                        <h4 class="fw-semibold mt-4">How to Raise a Return/Replacement Request</h4>
                        <ol class="text-secondary">
                            <li>Email us at <a href="mailto:Naturoliapharma@gmail.com">Naturoliapharma@gmail.com</a> within <strong>5 days</strong> of delivery.</li>
                            <li>Include your Order ID, reason for return, and attach clear <strong>images/videos</strong> of the product and invoice.</li>
                            <li>Our team will review your request within <strong>3 business days</strong>.</li>
                            <li>Once approved, we’ll arrange a reverse pickup within <strong>4–7 business days</strong>.</li>
                            <li>Replacement or refund will be initiated after inspection of the returned product.</li>
                        </ol>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="fw-bold text-danger mb-3 pb-2 border-bottom">Non-Returnable Products</h2>
                        <p class="text-secondary">For health and safety reasons, the following items <strong>cannot be returned</strong>:</p>
                        <ul class="list-unstyled text-secondary ps-3">
                            <li class="mb-2"><i class="fa-solid fa-ban text-danger me-2"></i>Opened or used herbal supplements, powders, or liquids.</li>
                            <li class="mb-2"><i class="fa-solid fa-ban text-danger me-2"></i>Products with tampered or missing seals.</li>
                            <li class="mb-2"><i class="fa-solid fa-ban text-danger me-2"></i>Items returned after 5 days of delivery.</li>
                        </ul>
                    </div>

                    <div class="policy-section mb-5" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="fw-bold text-success mb-3 pb-2 border-bottom">Policy Updates</h2>
                        <p class="text-secondary">
                            Naturolia reserves the right to update or modify this policy anytime without prior notice. Updates will be reflected on this page, and we recommend reviewing it periodically.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
