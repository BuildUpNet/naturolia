@extends('layout.main')

@section('content')
    <section id="home" class="hero-section d-flex align-items-center" data-aos="fade-in">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 text-white" data-aos="fade-right" data-aos-delay="300">
                    <h1 class="display-2 fw-bolder">
                        THE POWER OF NATURE, DELIVERED TO YOU.
                    </h1>
                    <p class="lead fs-5 mb-4">
                        Embrace a healthier life with our carefully sourced organic and
                        natural wellness products.
                    </p>
                    <a href="{{ route('product') }}" class="btn btn-lg custom-btn-primary">Shop Now <i
                            class="fa-solid fa-leaf ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>

     <section id="about" class="pt-3 bg-white">
        <div class="container py-5">
            <div class="common-header text-center" data-aos="fade-up">
                <h2>Our Story</h2>
                <p class="text-muted">A Commitment to Nature's Healing Wisdom</p>
            </div>
            <div class="row align-items-center mt-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <img src="assets/images/about.jpg" alt="Natural Ingredients" class="img-fluid rounded shadow-lg" />
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0" data-aos="fade-left">
                    <h3 class="fw-bold mb-3 text-green">🌿 About NATUROLIA</h3>
                    <p>
                       NATUROLIA was born with a simple yet powerful vision — to bring people closer to nature's healing wisdom. We believe true wellness comes from balance — between body, mind, and spirit — and that nature holds the key to restoring it.

                    </p>

                    <p>
                       At NATUROLIA, we combine the timeless knowledge of Ayurveda with modern scientific research to create safe, effective, and authentic herbal formulations. Each product is thoughtfully crafted using pure, natural ingredients sourced from trusted cultivators, ensuring potency, purity, and consistency.


                    </p>

                    <p>
                       Our mission is to help individuals embrace a healthier lifestyle through natural, holistic, and sustainable solutions free from harmful chemicals and side effects.
                    </p>

                    <a href="#why-choose" class="btn custom-btn-secondary mt-3">About More</a>
                </div>
            </div>
        </div>
    </section>
    <section id="product" class=" bg-light">
        <div class="container py-3">
            <div class="common-header text-center" data-aos="fade-up">
                <h2>Our Products</h2>
                <p class="text-muted">Nature's Best for Your Daily Health</p>
            </div>

            <div class="product-row-wrapper d-flex align-items-center mt-4 position-relative">
                <div class="row w-100 g-0">
                    <div class="col-12 col-lg-8 product-scroll-container position-relative order-1 order-lg-2"
                        style="overflow-x:auto;">
                        <div class="product-wrapper">
                            <div class="product-list d-flex flex-nowrap" id="productList" style="scroll-behavior:smooth;">
                                @foreach ($products as $product)
                                    <div class="product-card-col" style="min-width:300px; flex: 0 0 auto;">
                                        <div class="card product-card h-100 shadow-sm mx-2">
                                            <div class="img-container">
                                                <!--<div class="img-container">-->
                                                    @if ($product->images->count())
                                                        <img src="{{ asset($product->images->first()->image_path) }}"
                                                            alt="Top Image" class="product-img-large">
                                                    @else
                                                        <span>No top image</span>
                                                    @endif
                                                <!--</div>-->
                                            </div>
                                            <div class="card-body text-center">
                                                <h5 class="card-title fw-bold">
                                                    {{ $product->title }}
                                                </h5>
                                                <div class="mb-2">
                                                    @if ($product->mrp_price && $product->mrp_price > $product->price)
                                                        @php
                                                            $discountPercent = $product->discount
                                                                ? rtrim(
                                                                    rtrim(number_format($product->discount, 2), '0'),
                                                                    '.',
                                                                )
                                                                : round(
                                                                    (($product->mrp_price - $product->price) /
                                                                        $product->mrp_price) *
                                                                        100,
                                                                );
                                                        @endphp

                                                        <span
                                                            class="fs-4 fw-bold text-success">₹{{ number_format($product->price, 2) }}</span>
                                                        <span
                                                            class="text-muted text-decoration-line-through ms-2">₹{{ number_format($product->mrp_price, 2) }}</span>
                                                        <span class="badge bg-success ms-2">{{ $discountPercent }}%
                                                            OFF</span>
                                                    @else
                                                        <span
                                                            class="fs-4 fw-bold text-success">₹{{ number_format($product->price, 2) }}</span>
                                                    @endif
                                                </div>


                                                <div class="d-flex justify-content-center">

                                                    <form action="{{ route('cart.add', ['productId' => $product->id]) }}"
                                                        method="POST" class="pe-2">
                                                        @csrf
                                                        <button type="submit" class="btn custom-btn-primary">
                                                            <i class="fas fa-shopping-cart me-2"></i>Buy Now
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('product.show', $product->slug) }}"
                                                        method="GET" class="w-50">
                                                        @csrf
                                                        <button type="submit" class="btn custom-btn-secondary ms-2">
                                                            View Details
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4 product-fixed-col order-2 order-lg-1">
                        <div class="product-banner-fixed shadow-lg mt-4 mt-lg-0" data-aos="fade-right" data-aos-offset="50">
                            <h3 class="text-white fw-bold mb-3">
                                DISCOVER OUR FEATURED COLLECTION
                            </h3>
                            <a href="#product" class="btn btn-lg custom-btn-primary">Explore Now</a>
                        </div>
                    </div>
                </div>

                <!-- Scroll buttons: Show only on desktop (hidden on mobile) -->
                <button class="scroll-btn scroll-prev d-none d-lg-flex" id="scrollLeftBtn"
                    style="position:absolute;left:0;top:50%;transform:translateY(-50%);z-index:10;">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button class="scroll-btn scroll-next d-none d-lg-flex" id="scrollRightBtn"
                    style="position:absolute;right:0;top:50%;transform:translateY(-50%);z-index:10;">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
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

    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.js"></script>
    @if ($errors->has('status'))
        <script>
            Swal.fire({
                title: 'Account Inactive',
                text: "{{ $errors->first('status') }}",
                icon: 'warning',
                confirmButtonText: 'OK',
            });
        </script>
    @endif


    <script src="{{ asset('js/main.js') }}"></script>
@endsection
