@extends('layout.main')

@section('content')
<section class="profile-section py-5 bg-light">
    <div class="container">
        <h2 class="mb-4 fw-bold text-dark">My Account</h2>

        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4 mb-lg-0">
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

            <!-- Profile Content -->
            <div class="col-lg-9">
                <div class="card shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="card-title mb-4">Edit Account Details</h3>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('account.update') }}" method="POST">
                            @csrf

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-bold">Full Name</label>
                                    <input type="text" class="form-control form-control-lg" id="name" name="name"
                                           value="{{ old('name', $user->name) }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label fw-bold">Phone Number</label>
                                    <input type="tel" class="form-control form-control-lg" id="phone" name="phone"
                                           value="{{ old('phone', $user->phone) }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-bold">Email Address</label>
                                    <input type="email" class="form-control form-control-lg" id="email"
                                           name="email" value="{{ old('email', $user->email) }}" required>
                                </div>

                                <!-- Change Password -->
                                <div class="col-12 mt-4 pt-4 border-top">
                                    <h4 class="mb-3 text-primary"><i class="fas fa-lock me-2"></i> Change Password</h4>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <input type="password" name="current_password" class="form-control"
                                                   placeholder="Current Password">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="password" name="password" class="form-control"
                                                   placeholder="New Password">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                   placeholder="Confirm New Password">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-5">
                                    <button type="submit" class="btn btn-success btn-lg px-5 me-3">Save Changes</button>
                                    <a href="{{ route('account.detail') }}" class="btn btn-outline-secondary btn-lg px-5">Cancel</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
