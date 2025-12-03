@extends('layout.main')

@section('content')
<style>
.tracking-timeline {
    border-left: 3px solid #ddd;
    padding-left: 30px;
    margin-left: 40px;
    position: relative;
}

.timeline-step {
    position: relative;
    margin-bottom: 40px;
    padding-left: 20px;
}

.timeline-step::before {
    content: "";
    position: absolute;
    left: -36px;
    top: 4px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #ddd;
    border: 3px solid white;
    z-index: 10;
    transition: background-color 0.3s ease;
}

.timeline-step.completed::before {
    background-color: #28a745;
    border-color: #28a745;
}
.timeline-step.completed::after {
    background-color: #28a745;
}


.timeline-step::after {
    content: "";
    position: absolute;
    left: -27px;
    top: 26px;
    width: 4px;
    height: 100%;
    background: #ddd;
    z-index: 1;
}

.timeline-step:last-child::after {
    display: none;
}

.timeline-step.completed::after {
    background-color: #28a745;
}

.timeline-step h5 {
    font-weight: 600;
    margin-bottom: 5px;
}

.timeline-step p {
    font-size: 0.85rem;
    color: #666;
    margin: 0;
}

.timeline-step:hover h5 {
    color: #007bff;
    transition: color 0.3s;
}

.timeline-step.cancelled::before {
    background-color: #dc3545; /* red */
    border-color: #dc3545;
    box-shadow: 0 0 8px 3px rgba(220, 53, 69, 0.4);
}

.timeline-step.cancelled::after {
    display: none;
}
</style>

<section class="py-5 bg-light">
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm mb-3">
            <i class="fas fa-arrow-left me-2"></i> Back to Orders
        </a>

        <h2 class="mb-4 fw-bold text-dark">Track Your Order</h2>

        <div class="card shadow-sm mb-5">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Order ID: #{{ strtoupper($order->order_number) }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3 mb-md-0">
                        <p class="mb-0 small text-uppercase text-muted">Current Status</p>
                        <h4 class="fw-bold 
                            {{ $order->status == 'delivered' ? 'text-success' : ($order->status == 'cancelled' ? 'text-danger' : 'text-warning') }}">
                            {{ ucfirst($order->status) }}
                        </h4>
                    </div>
                    <div class="col-md-3 mb-3 mb-md-0">
                        <p class="mb-0 small text-uppercase text-muted">Tracking ID</p>
                        <h4 class="fw-bold text-dark">{{ $order->tracking_number ?? 'N/A' }}</h4>
                    </div>
                    <div class="col-md-3 mb-3 mb-md-0">
                        <p class="mb-0 small text-uppercase text-muted">Courier Name</p>
                        <h4 class="fw-bold text-dark">{{ $order->courier_name ?? 'N/A' }}</h4>
                    </div>
                    <div class="col-md-3">
                        <p class="mb-0 small text-uppercase text-muted">Tracking Link</p>
                        @php
                            $link = $order->courier_link;
                            if ($link && Str::startsWith($link, 'www.') && !Str::startsWith($link, ['http://', 'https://'])) {
                                $link = 'http://' . $link;
                            }
                        @endphp

                        <h4 class="fw-bold text-dark">
                            @if($order->courier_link)
                                <a href="{{ $link }}" target="_blank" rel="noopener noreferrer">
                                    {{ $order->courier_link }}
                                </a>
                            @else
                                N/A
                            @endif
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- 🟢 Shipment Progress --}}
        <div class="row">
            <div class="col-lg-8">
                <div class="card p-4 shadow-sm">
                    <h4 class="mb-4"><i class="fas fa-route me-2"></i> Shipment Progress</h4>

                    <div class="tracking-timeline">
                        @if (strtolower($order->status) === 'cancelled')
                            {{-- 🔴 Show only Cancelled step --}}
                            <div class="timeline-step cancelled">
                                <div class="timeline-icon mb-2" style="position: absolute; left: -65px; top: -4px;">
                                    <i class="fas fa-times-circle fa-lg text-danger"></i>
                                </div>
                                <h5 class="text-danger fw-bold">Order Cancelled</h5>
                                <p class="text-danger mb-0">Your order was cancelled successfully.</p>
                            </div>
                        @else
                            {{-- 🟢 Normal steps --}}
                            @php
                                $statuses = [
                                    'order placed' => ['label' => 'Order Placed', 'icon' => 'fas fa-shopping-cart'],
                                    'courier'      => ['label' => 'Courier Picked Up', 'icon' => 'fas fa-truck'],
                                    'delivered'    => ['label' => 'Delivered', 'icon' => 'fas fa-check-circle'],
                                ];

                                $currentStatus = strtolower($order->status);
                                $currentStatusIndex = array_search($currentStatus, array_keys($statuses));
                                if ($currentStatusIndex === false) $currentStatusIndex = 0;
                            @endphp

                           @foreach ($statuses as $key => $data)
    @php
        $index = array_search($key, array_keys($statuses));
        $stepClass = $index <= $currentStatusIndex ? 'completed' : 'pending';
    @endphp

    <div class="timeline-step {{ $stepClass }}">
        <div class="timeline-icon mb-2" style="position: absolute; left: -65px; top: -4px;">
            <i class="{{ $data['icon'] }} fa-lg 
                {{ $stepClass == 'completed' ? 'text-success' : 'text-secondary' }}">
            </i>
        </div>
        <h5>{{ $data['label'] }}</h5>
    </div>
@endforeach


                            
                        @endif
                    </div>
                </div>
            </div>

            {{-- 🟢 Right Sidebar --}}
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light fw-bold">
                        <i class="fas fa-map-marker-alt me-2"></i> Shipping Address
                    </div>
                    <div class="card-body small">
                        <p class="fw-bold mb-1">{{ $order->user->name ?? 'N/A' }} (Home)</p>
                        <address class="mb-0">
                            {{ $order->shipping_address }}<br>
                            Phone: {{ $order->user->phone ?? 'N/A' }}
                        </address>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-light fw-bold">
                        <i class="fas fa-box me-2"></i> Order Items
                    </div>
                    <div class="card-body p-3">
                        @foreach ($order->items as $item)
                            <div class="d-flex align-items-center mb-2 border-bottom pb-2">
                                <img src="{{ asset($item->product->images->first()->image_path ?? 'assets/images/product-placeholder-2.jpg') }}"
                                     class="product-image me-3"
                                     style="width: 40px; height: 40px; object-fit: contain;" alt="Item">
                                <div class="small">
                                    <p class="mb-0 fw-bold">{{ $item->product->title ?? 'Product' }}</p>
                                    <p class="mb-0 text-muted">
                                        Qty: {{ $item->quantity }} |
                                        Total: ₹{{ number_format($item->price * $item->quantity, 2) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        <p class="fw-bold text-end mb-0 mt-3 small">
                            Order Total: ₹{{ number_format($order->total, 2) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
