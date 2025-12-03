@extends('layout.main')

@section('content')
    <section class="profile-section py-5 bg-light">
        <div class="container">
            <h2 class="mb-4 fw-bold text-dark">My Account</h2>

            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <div class="list-group profile-sidebar shadow-sm rounded-3 overflow-hidden">
                        <a href="{{ route('profile.show') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-home me-2"></i> Dashboard
                        </a>
                        <a href="{{ route('account.orders') }}" class="list-group-item list-group-item-action active">
                            <i class="fas fa-box me-2"></i> My Orders
                        </a>
                        <a href="{{ route('account.address') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-map-marker-alt me-2"></i> My Addresses
                        </a>
                        <a href="{{ route('account.detail') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-user-edit me-2"></i> Account Details
                        </a>
                          <a href="{{ route('account.delete') }}" class="list-group-item list-group-item-action {{ request()->routeIs('account.delete') ? 'active' : '' }}">
                            <i class="fas fa-trash-alt me-2"></i> Delete Account
                        </a>
                        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action text-danger"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>

                <!-- Orders Section -->
                <div class="col-lg-9">
                    <div class="card shadow-sm">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="card-title mb-4">My Orders History</h3>

                            @forelse($orders as $order)
                                <div class="order-card mb-4">
                                    <div class="order-header row g-0 text-muted">
                                        <div class="col-4 text-start">
                                            <p class="mb-0 small text-uppercase">Order Placed</p>
                                            <p class="mb-0 fw-bold text-dark">{{ $order->created_at->format('M d, Y') }}</p>
                                        </div>
                                        <div class="col-4 text-center">
                                            <p class="mb-0 small text-uppercase">Total</p>
                                            <p class="mb-0 fw-bold text-dark">₹{{ number_format($order->total, 2) }}</p>
                                        </div>
                                        <div class="col-4 text-end">
                                            <p class="mb-0 small text-uppercase">Order ID</p>
                                            <p class="mb-0 fw-bold text-primary">#{{ strtoupper($order->order_number) }}</p>
                                        </div>
                                    </div>

                                    <div class="order-body mt-3">
                                        {{-- Order Status --}}
                                        <p
                                            class="status-line mb-3 
                                        {{ $order->status == 'delivered'
                                            ? 'text-success'
                                            : ($order->status == 'shipped'
                                                ? 'text-warning'
                                                : 'text-secondary') }}">
                                            <i class="fas fa-box-open me-2"></i>
                                            {{ ucfirst($order->status) }}
                                            @if ($order->delivered_at)
                                                on {{ \Carbon\Carbon::parse($order->delivered_at)->format('M d, Y') }}
                                            @endif
                                        </p>

                                        {{-- Order Items --}}
                                        @foreach ($order->items as $item)
                                            <div class="order-product-item d-flex align-items-center mb-3">
                                                <img src="{{ $item->product->images->first()->image_path
                                                    ? asset($item->product->images->first()->image_path)
                                                    : asset('assets/images/product-placeholder-1.jpg') }}"
                                                    class="product-image me-3" width="60" height="60"
                                                    alt="{{ $item->product->name }}">
                                                <div>
                                                    <p class="mb-1 fw-bold">{{ $item->product->title ?? 'Product' }}</p>
                                                    <p class="mb-0 small text-muted">
                                                        Quantity: {{ $item->quantity }} |
                                                        Price: ₹{{ number_format($item->price, 2) }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="mt-4 pt-3 border-top">

                                          
                                            @if ($order->invoice_path)
                                                <a href="{{ asset($order->invoice_path) }}" target="_blank"
                                                    class="btn btn-sm btn-outline-primary me-2">
                                                    <i class="fas fa-receipt me-1"></i> View Invoice
                                                </a>
                                            @else
                                                <span class="text-muted me-2">No Invoice</span>
                                            @endif

                                        
                                          
                                                <a href="{{ route('orders.track', $order->id) }}"
                                                    class="btn btn-sm btn-primary me-2">
                                                    <i class="fas fa-truck me-1"></i> Track Shipment
                                                </a>
                                        

                                     @if ($order->status === 'Order Placed')
                                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="d-inline">
                             @csrf
                            <button type="submit" class="btn btn-sm btn-danger"
                              onclick="return confirm('Are you sure you want to cancel this order?')">
                               <i class="fas fa-times me-1"></i> Cancel Order
                                 </button>
                                    </form>
                                     @endif
                                        @if ($order->status === 'delivered')
    @php
        $deliveredAt = \Carbon\Carbon::parse($order->delivered_at);
        $daysSinceDelivery = now()->diffInDays($deliveredAt);
    @endphp

    @if ($daysSinceDelivery <= 5 && $order->return_status == 'none')
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
            data-bs-target="#returnModal{{ $order->id }}">
            <i class="fas fa-undo me-1"></i> Return Order
        </button>

        <!-- Modal -->
        <div class="modal fade" id="returnModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('orders.return', $order->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Return Order #{{ $order->order_number }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <label for="reason" class="form-label">Reason for Return</label>
                            <textarea name="return_reason" class="form-control" required rows="3"
                                placeholder="Explain the reason..."></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning">Submit Return Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @elseif($order->return_status == 'requested')
        <span class="text-warning"><i class="fas fa-clock me-1"></i> Return Requested</span>
    @elseif($order->return_status == 'accepted')
        <span class="text-success"><i class="fas fa-check me-1"></i> Return Accepted</span>
    @elseif($order->return_status == 'rejected')
        <span class="text-danger"><i class="fas fa-times me-1"></i> Return Rejected</span>
    @else
        <span class="text-muted"><i class="fas fa-clock me-1"></i> Return window closed</span>
    @endif
@endif
  

                                        </div>


                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i> You haven't placed any orders yet.
                                </div>
                            @endforelse

                            <div class="mt-4 d-flex justify-content-center">
                                {{ $orders->links('pagination::bootstrap-5') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
