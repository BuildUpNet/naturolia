@extends('layout.main')

@section('content')
<section class="profile-section py-5 bg-light">
    <div class="container">
        <h2 class="mb-4 fw-bold text-dark">Manage Account</h2>

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
                        <a href="{{ route('profile.show') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-home me-2"></i> Dashboard
                        </a>
                        <a href="{{ route('account.orders') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-box me-2"></i> My Orders
                        </a>
                        <a href="{{ route('account.address') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-map-marker-alt me-2"></i> My Addresses
                        </a>
                        <a href="{{ route('account.detail') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-user-edit me-2"></i> Account Details
                        </a>
                        <a href="{{ route('account.delete') }}" class="list-group-item list-group-item-action active text-danger">
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

                        <h3 class="card-title mb-4">Deactivate or Delete Your Account</h3>

                        <!-- Temporary Deactivation -->
                        <div class="alert alert-info d-flex align-items-center" role="alert">
                            <i class="fas fa-user-slash me-2"></i>
                            <div>
                                Temporarily deactivate your account. You can log back in anytime to reactivate your account.
                            </div>
                        </div>

                        <form action="{{ route('account.deactivate.submit') }}" method="POST" class="mb-4" onsubmit="return confirm('Are you sure you want to temporarily deactivate your account?')">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="password_deactivate" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_deactivate" name="password" required placeholder="Enter your password">
                            </div>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-user-slash me-2"></i> Temporarily Deactivate
                            </button>
                        </form>

                        <!-- Permanent Deletion -->
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <div>
                                Permanently delete your account. All your data including orders, addresses, and profile information will be removed and cannot be recovered.
                            </div>
                        </div>

                        <form action="{{ route('account.delete.submit') }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete your account? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <div class="mb-3">
                                <label for="password_delete" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_delete" name="password" required placeholder="Enter your password">
                            </div>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt me-2"></i> Permanently Delete
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
