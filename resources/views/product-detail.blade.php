@extends('layout.main')

@section('content')

<section id="product-detail" class="py-5" style="min-height: 80vh;">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="row">
                    <div class="col-12">
                        <div class="product-image-box p-3 border rounded shadow-sm mb-3">
                            <img src="{{ asset($product->images->first()->image_path ?? 'assets/images/product-placeholder-1.jpg') }}" alt="{{ $product->title }}"
                                class="img-fluid rounded" id="mainProductImage" style="height: 500px; width: 100%; object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-12 d-flex product-thumbnails">
                        @foreach ($product->images as $image)
                        <div class="thumbnail-item me-3 border p-1 rounded cursor-pointer" data-image-url="{{ asset($image->image_path) }}">
                            <img src="{{ asset($image->image_path) }}" alt="Thumbnail"
                                class="img-fluid rounded" style="width: 70px; height: 70px; object-fit: cover;">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="product-info p-3">
                    <h1 class="display-5 fw-bold text-dark mb-1">{{ $product->title }}</h1>
                    <p class="lead text-muted mb-4">{{ $product->short_description }}</p>

                  
                    <div class="price-section border-top border-bottom py-3 mb-4">
    @if($product->mrp_price && $product->mrp_price > $product->price)
        <div class="d-flex align-items-baseline gap-2">
            <h2 class="display-6 text-primary fw-bold mb-0">₹{{ number_format($product->price, 2) }}</h2>
            <span class="text-muted text-decoration-line-through fs-5">
                ₹{{ number_format($product->mrp_price, 2) }}
            </span>

            @if($product->discount)
                <span class="badge bg-success fs-6">{{ rtrim(rtrim(number_format($product->discount, 2), '0'), '.') }}% OFF</span>
            @else
                <span class="badge bg-success fs-6">
                    {{ round((($product->mrp_price - $product->price) / $product->mrp_price) * 100) }}% OFF
                </span>
            @endif
        </div>
    @else
        <h2 class="display-6 text-primary fw-bold mb-0">₹{{ number_format($product->price, 2) }}</h2>
    @endif

    <p class="small text-muted mt-1">Inclusive of all taxes</p>
</div>
@if(!empty($product->qnty))
    <p class="fw-semibold text-dark mb-4">
        <i class="fa-solid fa-box-open me-2 text-secondary"></i>
        Pack Size: <span class="text-muted">{{ $product->qnty }}</span>
    </p>
@endif

                    <div class="d-flex align-items-center mb-5">
                        <label for="quantity-input" class="fw-bold me-3">Quantity:</label>
                        <div class="input-group" style="width: 130px;">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon-minus">-</button>
                            <input type="text" class="form-control text-center" id="quantity-input" value="1" min="1" max="10" readonly>
                            <button class="btn btn-outline-secondary" type="button" id="button-addon-plus">+</button>
                        </div>
    <form action="{{ route('cart.add', ['productId' => $product->id]) }}" method="POST"
                                            class="w-50">
                                            @csrf
                                            <button type="submit" class="btn custom-btn-primary ms-4 w-50">
                                                <i class="fas fa-shopping-cart me-2"></i>Buy Now
                                            </button>
                                        </form>
                                 
                      
                                          
                                      
                    </div>
                    
                    <div class="accordion accordion-flush" id="productDetailAccordion">
                        
                        <div class="accordion-item border mb-3 rounded shadow-sm">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Product Description
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#productDetailAccordion">
                                <div class="accordion-body text-secondary">
                                    {!! $product->description !!}
                                </div>
                            </div>
                        </div>

                 
 <div class="accordion-item border mb-3 rounded shadow-sm">
    <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Key Benefits
        </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#productDetailAccordion">
        <div class="accordion-body">
            <ul class="list-unstyled mb-0">
                @foreach(explode('•', $product->key_benefits) as $benefit)
                    @if(trim($benefit)) <!-- Ensure benefit is not empty -->
                        <li class="mb-2 text-secondary">
                            <i class="fa-solid fa-check-circle text-success me-2"></i>{{ trim($benefit) }}
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="accordion-item border mb-3 rounded shadow-sm">
    <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Key Ingredients
        </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#productDetailAccordion">
        <div class="accordion-body text-muted small">
          <ul class="list-unstyled mb-0">
               @foreach(preg_split("/[\n,]+/", $product->ingredient) as $ingredient)
    @if(trim($ingredient) != '')
        <li class="mb-2">
            <i class="fa-solid fa-check-circle text-success me-2"></i>{{ trim($ingredient) }}
        </li>
    @endif
@endforeach

            </ul>
        </div>
    </div>
</div>



                    </div>
                    </div>
            </div>
        </div>
    </div>
    
<hr class="my-5">
<div id="best-sellers-section" class="py-4">
    <div class="container"> 
        <div class="common-header text-center mb-5">
             <h2>Our Best Sellers</h2>
        </div>
    <!--<h2 class="common-header text-center mb-5">Our Best Sellers</h2>-->
    @if($bestSellers->isEmpty())
        <p class="text-center text-muted">No best sellers available at the moment.</p>
    @else
        <div class="row">
            @foreach($bestSellers as $bestSeller)
                <div class="col-lg-4 col-md-6 mb-4" >
                    <div class="card h-100 product-card-unique shadow-sm">
                        <img src="{{ asset($bestSeller->images->first()->image_path ?? 'assets/images/product-placeholder-1.jpg') }}" 
                             class="card-img-top"
                             alt="{{ $bestSeller->title }}" 
                             style="height: 450px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title product-title">{{ $bestSeller->title }}</h5>
                            <p class="card-text text-muted small">{{ \Illuminate\Support\Str::limit($bestSeller->short_description, 100) }}</p>
                            <div class="product-price-section mb-2">
    @if($bestSeller->mrp_price && $bestSeller->mrp_price > $bestSeller->price)
        <div class="d-flex justify-content-center align-items-baseline gap-2">
           <p class="h4 product-price text-primary fw-bold">₹{{ number_format($bestSeller->price, 2) }}</p>
            <span class="text-muted text-decoration-line-through">
                ₹{{ number_format($bestSeller->mrp_price, 2) }}
            </span>

            @php
                $discountPercent = $bestSeller->discount 
                    ? rtrim(rtrim(number_format($bestSeller->discount, 2), '0'), '.') 
                    : round((($bestSeller->mrp_price - $bestSeller->price) / $bestSeller->mrp_price) * 100);
            @endphp

            <span class="badge bg-success">{{ $discountPercent }}% OFF</span>
        </div>
    @else
        <h5 class="text-success fw-bold mb-0">₹{{ number_format($bestSeller->price, 2) }}</h5>
    @endif
</div>

                    
                            <a href="{{ route('product.show', $bestSeller->slug) }}" class="btn custom-btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    </div>
</div>

</section>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const quantityInput = document.getElementById('quantity-input');
        const mainImage = document.getElementById('mainProductImage');
        const thumbnails = document.querySelectorAll('.thumbnail-item');
        
        // 1. Thumbnail Click Logic
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                const newImageUrl = this.getAttribute('data-image-url');
                mainImage.src = newImageUrl;

                // Update active class
                thumbnails.forEach(t => t.classList.remove('active-thumbnail'));
                this.classList.add('active-thumbnail');
            });
        });

        // 2. Quantity Buttons Logic
        document.getElementById('button-addon-plus').addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < 10) {
                quantityInput.value = currentValue + 1;
            }
        });

        document.getElementById('button-addon-minus').addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
        
    });
</script>

@endsection