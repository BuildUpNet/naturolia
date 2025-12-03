@extends('layout.main')

@section('content')
<section id="faq-page" class="py-5" style="min-height: 80vh;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <header class="mb-4 text-center">
                    <h1 class="display-4 fw-bold" style="color: var(--primary-color);">Frequently Asked Questions (FAQ)</h1>
                    <p class="lead text-muted">Find answers to the most common questions about our products, orders, and services.</p>
                </header>

                <div class="accordion" id="faqAccordion">

                    <!-- Question 1 -->
                    <div class="accordion-item mb-3" data-aos="fade-up">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                1. How do I place an order?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                You can place an order directly on our website. Add products to your cart, provide shipping details, and complete payment to confirm your order.
                            </div>
                        </div>
                    </div>

                    <!-- Question 2 -->
                    <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                2. What payment methods are available?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                We accept multiple payment methods including credit/debit cards, net banking, UPI, and popular wallets for your convenience.
                            </div>
                        </div>
                    </div>

                    <!-- Question 3 -->
                    <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                3. How can I track my order?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                After your order is shipped, you will receive a tracking link via email or SMS. You can also check your order status in your account under “Order History.”
                            </div>
                        </div>
                    </div>

                    <!-- Question 4 -->
                    <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                4. Can I cancel or modify my order?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                Orders can be canceled or modified only before they are shipped. Once shipped, cancellation or modification is not possible.
                            </div>
                        </div>
                    </div>

                    <!-- Question 5 -->
                    <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="400">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                5. What is the return or replacement policy?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                We offer a return or replacement within a specific time frame (usually 7 days) for damaged or incorrect products. Contact customer care with order details and evidence of the issue.
                            </div>
                        </div>
                    </div>

                  

                    <!-- Question 6-->
                    <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="600">
                        <h2 class="accordion-header" id="headingSeven">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                6. How do I contact customer support?
                            </button>
                        </h2>
                        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                You can reach our support team via email at  <a href="mailto:Naturoliapharma@gmail.com">Naturoliapharma@gmail.com</a> or through our contact form on the website.
                            </div>
                        </div>
                    </div>

                    <!-- Question 7 -->
                    <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="700">
                        <h2 class="accordion-header" id="headingEight">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                7. How long will delivery take?
                            </button>
                        </h2>
                        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                Delivery typically takes 5–7 business days, depending on your location and product availability.
                            </div>
                        </div>
                    </div>

                    <!-- Question 8 -->
                    <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="800">
                        <h2 class="accordion-header" id="headingNine">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                8. Are the products safe and natural?
                            </button>
                        </h2>
                        <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                All products are made from natural ingredients and are safe for consumption when used as directed.
                            </div>
                        </div>
                    </div>

                    <!-- Question 9 -->
                    <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="900">
                        <h2 class="accordion-header" id="headingTen">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                9. Can I create an account to save my orders?
                            </button>
                        </h2>
                        <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                Yes, creating an account allows you to track orders, manage subscriptions, and save preferences for faster checkout.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
