@extends('Admin.layout.app')

@section('content')
<div class="container-fluid">
    <!-- Success / Error Alerts -->
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mb-4" id="adminSettingsTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-bold" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profileTab" type="button" role="tab">
                <i class="bi bi-person-circle"></i> Account Info
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold" id="password-tab" data-bs-toggle="tab" data-bs-target="#passwordTab" type="button" role="tab">
                <i class="bi bi-lock"></i> Change Password
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-bold" id="cod-tab" data-bs-toggle="tab" data-bs-target="#codTab" type="button" role="tab">
                <i class="bi bi-cash-coin"></i> COD Charges
            </button>
        </li>
    </ul>

    <!-- Tabs Content -->
    <div class="tab-content" id="adminSettingsTabsContent">

        <!-- Profile Tab -->
        <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="bi bi-person-circle"></i> Admin Profile
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.updateProfile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4 text-center">
                            <img src="{{ asset($admin->profile_image ?? 'default-avatar.png') }}" alt="Profile Image" class="rounded-circle mb-2" width="120">
                            <div>
                                <label for="profile_image" class="btn btn-info btn-sm">Change Image</label>
                                <input type="file" name="profile_image" id="profile_image" class="d-none">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" value="{{ old('phone', $admin->phone) }}" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">City</label>
                                <input type="text" name="city" value="{{ old('city', $admin->city) }}" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" value="{{ old('address', $admin->address) }}" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Zip Code</label>
                                <input type="text" name="zipcode" value="{{ old('zipcode', $admin->zipcode) }}" class="form-control">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Password Tab -->
        <div class="tab-pane fade" id="passwordTab" role="tabpanel">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-warning text-white fw-bold">
                    <i class="bi bi-lock"></i> Change Password
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.updatePassword') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-warning w-100">Change Password</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- COD Charge Tab -->
        <div class="tab-pane fade" id="codTab" role="tabpanel">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white fw-bold">
                    <i class="bi bi-cash-coin"></i> Cash on Delivery (COD) Charges
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.updateCodCharge') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">COD Charge (₹)</label>
                            <input type="number" step="0.01" name="cod_charge"
                                   value="{{ \App\Models\CodCharge::first()->amount ?? 0 }}"
                                   class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-save"></i> Save COD Charge
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
