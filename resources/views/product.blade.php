@extends('layout.main')

@section('content')
    <style>
        .product-pricing {
            font-size: 1rem;
        }

        .product-pricing .text-decoration-line-through {
            color: #888;
        }

        .product-pricing .badge {
            font-size: 0.85rem;
            vertical-align: middle;
        }
    </style>
    <section class="product-hero-banner d-flex align-items-center">
        <div class="container py-5" data-aos="zoom-in" data-aos-duration="1200">
            <h1>AUTHENTIC AYURVEDIC WELLNESS</h1>
            <p class="lead mt-3">Discover the purity of nature with our ethically sourced, potent herbal supplements.</p>
        </div>
    </section>

    <div class="container py-5">
        <div class="text-center mb-5">
            <div class="common-header">
                <h2>Our Premium Herbal Range</h2>
            </div>
            <p class="lead text-muted">Harnessing the power of ancient wisdom for modern life.</p>
        </div>

        <div class="row d-flex align-items-stretch">
            @foreach ($products as $product)
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="800">
                    <div class="product-card-unique">
                        <div class="product-img-container">
                            @if ($product->images->isNotEmpty())
                                <img src="{{ asset($product->images->first()->image_path) }}" alt="Product Image">
                            @else
                                <img src="{{ asset('images/default-placeholder.jpg') }}" alt="No Image Available"
                                    class="img-fluid">
                            @endif
                        </div>
                        <div class="product-body d-flex flex-column">
                            <div>
                                <h3 class="product-title">{{ $product->title }}</h3>
                                <p class="product-short-desc">{{ $product->short_description }}</p>
                            </div>

                            <div class="mt-auto">
                                <div class="product-pricing mb-3">
                                    @if ($product->mrp_price && $product->mrp_price > $product->price)
                                        <span class="text-muted text-decoration-line-through me-2">
                                            ₹ {{ number_format($product->mrp_price, 2) }}
                                        </span>
                                    @endif

                                    <span
                                        class="h4 product-price text-primary fw-bold">₹{{ number_format($product->price, 2) }}</span>

                                    @if ($product->discount)
                                        <span class="badge bg-success ms-2">
                                            {{ rtrim(rtrim(number_format($product->discount, 2), '0'), '.') }}% OFF
                                        </span>
                                    @endif
                                </div>


                                <div class="d-flex gap-2">
                                 
                                        <form action="{{ route('cart.add', ['productId' => $product->id]) }}" method="POST"
                                            class="w-50">
                                            @csrf
                                            <button type="submit" class="btn custom-btn-primary w-100">
                                                <i class="fas fa-shopping-cart me-2"></i>Buy Now
                                            </button>
                                        </form>
                                 

                                    <form action="{{ route('product.show', $product->slug) }}" method="GET"
                                        class="w-50">
                                        <button type="submit" class="btn custom-btn-secondary w-100">
                                            View Details
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="container py-2">
            <div class="row mt-5">
                <div class="col-12" data-aos="fade-up" data-aos-duration="1000">
                    <div class="large-cta-banner text-center">
                        <h2 class="mb-3">OUR COMMITMENT: PURE, POTENT, ETHICAL</h2>
                        <p>We guarantee 100% natural, lab-tested, and chemical-free products, sourced with integrity and
                            inspired by
                            nature.</p>
                        <a href="#about" class="btn custom-btn-secondary-outline-light btn-lg mt-3">Learn About Our
                            Quality</a>
                    </div>
                </div>
            </div>
        </div>

        <!--<div class="row d-flex align-items-stretch mt-5">-->
        <!--    <div class="col-lg-6 col-md-12 mb-4" data-aos="fade-right" data-aos-duration="1000">-->
        <!--        <div class="small-product-banner h-100 d-flex flex-column justify-content-center align-items-center text-center">-->
        <!--                    <h3>🌱 Ayurvedic Consultation Offer!</h3>-->
        <!--                    <p class="mt-2">Book a free 15-minute consultation with our expert practitioner. Personalize your path-->
        <!--                        to wellness.</p>-->
        <!--                    <a href="#contact" class="btn custom-btn-primary btn-lg mt-3" style="width: 200px;">Book Now</a>-->
        <!--                </div>-->
        <!--            </div>-->

        <!--            <div class="col-lg-6 col-md-12 mb-4" data-aos="fade-left" data-aos-duration="1000">-->
        <!--         <div class="large-cta-banner h-100 d-flex flex-column justify-content-center text-center">-->
        <!--                    <h2 class="mb-3">OUR COMMITMENT: PURE, POTENT, ETHICAL</h2>-->
        <!--                    <p>We guarantee 100% natural, lab-tested, and chemical-free products, sourced with integrity and inspired by-->
        <!--                        nature.</p>-->
        <!--                    <a href="#about" class="btn custom-btn-secondary-outline-light btn-lg mt-3">Learn About Our Quality</a>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
    </div>
@endsection
