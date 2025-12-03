@extends('layout.main')

@section('content')
   
    
        <section class="profile-section py-5 bg-light">
        <div class="container">
            <h2 class="mb-4 fw-bold text-dark">My Account</h2>

            <div class="row">
                <div class="col-12 d-lg-none mb-3">
                    <button class="btn btn-outline-secondary w-100" type="button" data-bs-toggle="collapse"
                        data-bs-target="#profileSidebarCollapse">
                        <i class="fas fa-bars me-2"></i> Profile Menu
                    </button>
                </div>

                <div class="col-lg-3 mb-4 mb-lg-0">
                    <div class="collapse d-lg-block" id="profileSidebarCollapse">
                        <div class="list-group profile-sidebar shadow-sm rounded-3 overflow-hidden">
    <a href="{{ route('profile.show') }}" class="list-group-item list-group-item-action {{ request()->routeIs('account.dashboard') ? 'active' : '' }}">
        <i class="fas fa-home me-2"></i> Dashboard
    </a>

    <a href="{{ route('account.orders') }}" class="list-group-item list-group-item-action {{ request()->routeIs('account.orders') ? 'active' : '' }}">
        <i class="fas fa-box me-2"></i> My Orders
    </a>

    <a href="{{ route('account.address') }}" class="list-group-item list-group-item-action {{ request()->routeIs('account.address') ? 'active' : '' }}">
        <i class="fas fa-map-marker-alt me-2"></i> My Addresses
    </a>

    <a href="{{ route('account.detail') }}" class="list-group-item list-group-item-action {{ request()->routeIs('account.detail') ? 'active' : '' }}">
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

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="card profile-content-card shadow-sm h-100">
                        <div class="card-body p-4 p-md-5">

                            <h3 class="card-title mb-4">Welcome Back,  {{ $user->name }}!</h3>

                          @if ($profileCompletion >= 80)
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        Your profile is complete! Start exploring our new collection.
    </div>
@else
    <div class="alert alert-warning d-flex align-items-center" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        Please complete your profile first — add your phone number and address.
    </div>
@endif

                            <div class="row g-4 mb-5">
                                <div class="col-lg-4 col-md-6">
                                    <div class="p-4 border rounded text-center bg-white shadow-sm quick-stat-box">
                                        <i class="fas fa-box fa-3x text-primary mb-2"></i>
                                        <h5 class="mt-2 text-muted small">Pending Orders</h5>
                                        <p class="display-6 fw-bold text-dark">{{ $pendingOrderCount }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="p-4 border rounded text-center bg-white shadow-sm quick-stat-box">
                                        <i class="fas fa-map-marker-alt fa-3x text-success mb-2"></i>
                                        <h5 class="mt-2 text-muted small">Saved Addresses</h5>
                                        <p class="display-6 fw-bold text-dark">{{ $totalAddressCount }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="p-4 border rounded text-center bg-white shadow-sm quick-stat-box">
                                       <i class="fas fa-shopping-cart fa-3x text-danger mb-2"></i>

                                        <h5 class="mt-2 text-muted small">Total Order</h5>
                                        <p class="display-6 fw-bold text-dark">{{ $orderCount }}</p>
                                    </div>
                                </div>
                            </div>

                          <h4 class="mb-3 border-bottom pb-2">Recent Order Summary</h4>

@if($recentOrder)
    <div class="p-4 border rounded bg-white">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="fw-bold mb-0">Order ID: 
                <span class="text-primary">#{{ $recentOrder->order_number }}</span>
            </p>
            <span class="badge bg-warning text-dark py-2">{{ ucfirst($recentOrder->status) }}</span>
        </div>
        <p class="mb-1">Date: {{ $recentOrder->created_at->format('Y-m-d') }}</p>
        <p class="mb-3">Total: ₹{{ number_format($recentOrder->total, 2) }} ({{ $recentOrder->items()->count() }} Item{{ $recentOrder->items()->count() > 1 ? 's' : '' }})</p>
        <a href="{{ route('account.orders') }}" class="btn btn-sm btn-outline-primary">View Full History</a>
    </div>
@else
    <p>No recent orders found.</p>
@endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
