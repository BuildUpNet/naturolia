@extends('layout.main')

@section('content')
   <section id="badge" class="badge-hero">
        <div class="container hero-content">
            <h1 class="display-3 fw-bold">OUR STORY OF PURITY</h1>
            <p class="lead mt-3">Harnessing the ancient power of Ayurveda with modern science.</p>
        </div>
    </section>

   <section id="about" class="py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="about-image-block">
                        <img src="/assets/images/about.jpg" alt="Ayurvedic herbs" class="img-fluid"
                            style="object-fit: cover; height: 400px; width: 100%;">
                    </div>
                </div>
                <div class="col-lg-6">
                    <p class="text-nat-green fw-bold">WHO WE ARE</p>
                    <h2 class="section-title mb-4">🌿 About NATUROLIA</h2>
                    <p class="lead">
                       NATUROLIA was born with a simple yet powerful vision — to bring people closer to nature's healing wisdom. We believe true wellness comes from balance — between body, mind, and spirit — and that nature holds the key to restoring it.
                    </p>
                    <p class="text-muted">
                      At NATUROLIA, we combine the timeless knowledge of Ayurveda with modern scientific research to create safe, effective, and authentic herbal formulations. Each product is thoughtfully crafted using pure, natural ingredients sourced from trusted cultivators, ensuring potency, purity, and consistency.
                    </p>
                    <p class="text-nat-green fw-bold">
                     Our mission is to help individuals embrace a healthier lifestyle through natural, holistic, and sustainable solutions free from harmful chemicals and side effects.
                    </p>
                    <a href="#mission-vision" class="btn btn-outline-success mt-3">Explore Our Values <i
                            class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section id="mission-vision" class="py-5 bg-light">
        <div class="container py-5">
            <h2 class="section-title text-center mb-5">Our Guiding Philosophy</h2>
            <div class="row text-center">
                <div class="col-md-6 mb-4">
                    <div class="card mission-card p-4">
                        <i class="fa-solid fa-bullseye fa-4x mb-3"></i>
                        <h4 class="fw-bold text-nat-green">Our Mission</h4>
                        <p class="text-muted">
                            To deliver the most authentic and effective herbal solutions globally, empowering
                            individuals to achieve holistic health and vitality naturally.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card mission-card p-4">
                        <i class="fa-solid fa-mountain-sun fa-4x mb-3"></i>
                        <h4 class="fw-bold text-nat-green">Our Vision</h4>
                        <p class="text-muted">
                            To be the most trusted name in natural wellness, creating a healthier planet by promoting
                            sustainable practices and Ayurvedic lifestyle choices.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="why-choose" class="py-5 bg-light">
        <div class="container py-5">
            <div class="common-header text-center" data-aos="fade-up">
                <h2>Why Choose NATUROLIA?</h2>
                <p class="text-muted">Our Core Principles of Purity and Trust</p>
            </div>
            <div class="row mt-5 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-10 p-4 rounded choose-us-block">
                    <div class="row text-center text-white">
                        <div class="col-md-3 mb-4 mb-md-0">
                            <i class="fa-solid fa-seedling fa-3x mb-3"></i>
                            <p class="small fw-bold">
                                100% Herbal & Ayurvedic formulations
                            </p>
                        </div>
                        <div class="col-md-3 mb-4 mb-md-0">
                            <i class="fa-solid fa-vial fa-3x mb-3"></i>
                            <p class="small fw-bold">
                                Backed by traditional wisdom & modern testing
                            </p>
                        </div>
                        <div class="col-md-3 mb-4 mb-md-0">
                            <i class="fa-solid fa-hand-holding-heart fa-3x mb-3"></i>
                            <p class="small fw-bold">
                                Ethically sourced, cruelty-free ingredients
                            </p>
                        </div>
                        <div class="col-md-3 mb-4 mb-md-0">
                            <i class="fa-solid fa-magnifying-glass-chart fa-3x mb-3"></i>
                            <p class="small fw-bold">
                                Commitment to purity, quality, and transparency
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="300">
                <p class="lead mt-4">
                   Whether it's improving vitality, balancing hormones, or enhancing overall wellness, NATUROLIA stands for trust, care, and the healing power of nature.
                </p>
                <p class="display-6 fw-bold text-green mt-4">
                    NATUROLIA — Inspired by Nature, Perfected by Science.
                </p>
            </div>
        </div>
    </section>

    <section id="reviews" class="py-5 bg-nat-green text-white">
        <div class="container py-5">
            <h2 class="section-title text-center text-white mb-5">Hear From Our Wellness Family</h2>
            <div class="row d-flex align-items-stretch">
                <div class="col-lg-4 mb-4">
                    <div class="review-card">
                        <div class="d-flex align-items-center mb-3">
                            <img src="placeholder-user-1.jpg" alt="Riya Sharma" class="review-img me-3">
                            <div>
                                <div class="star-rating">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                </div>
                                <p class="fw-bold text-nat-green mb-0">- Riya Sharma</p>
                            </div>
                        </div>
                        <p class="fst-italic text-dark mb-auto">"The results were noticeable within weeks. True, potent
                            herbs. Highly recommend for natural energy boost!"</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="review-card">
                        <div class="d-flex align-items-center mb-3">
                            <img src="placeholder-user-2.jpg" alt="Anand Singh" class="review-img me-3">
                            <div>
                                <div class="star-rating">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                                <p class="fw-bold text-nat-green mb-0">- Anand Singh</p>
                            </div>
                        </div>
                        <p class="fst-italic text-dark mb-auto">"Finally, a brand I can trust! The commitment to purity
                            and ethical sourcing is evident in their quality. A must-try for everyone seeking natural
                            health."</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="review-card">
                        <div class="d-flex align-items-center mb-3">
                            <img src="placeholder-user-3.jpg" alt="Priya Verma" class="review-img me-3">
                            <div>
                                <div class="star-rating">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="far fa-star"></i>
                                </div>
                                <p class="fw-bold text-nat-green mb-0">- Priya Verma</p>
                            </div>
                        </div>
                        <p class="fst-italic text-dark mb-auto">"Good quality, prompt service. I appreciate the
                            transparent labeling and detailed ingredient info. It aligns perfectly with my wellness
                            goals."</p>
                    </div>
                </div>
            </div>
            <!--<div class="text-center mt-4">-->
            <!--    <a href="#" class="btn btn-warning btn-lg">Read More Reviews</a>-->
            <!--</div>-->
        </div>
    </section>

    <section id="faq" class="py-5">
        <div class="container py-5">
            <h2 class="section-title text-center mb-5">Frequently Asked Questions</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What makes Naturolia products 100% Ayurvedic?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Our formulations strictly adhere to classical Ayurvedic texts, using only natural
                                    herbs, minerals, and compounds. We avoid all artificial additives and synthetic
                                    ingredients.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Are your products lab-tested for heavy metals?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, absolute commitment to safety. All our products undergo rigorous third-party
                                    lab testing to ensure they are free from heavy metals, pesticides, and microbial
                                    contamination.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    What is your return and refund policy?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We offer a 30-day money-back guarantee on all our products. If you are not
                                    completely satisfied, please contact our support team at hello@naturolia.com for a
                                    hassle-free refund.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
