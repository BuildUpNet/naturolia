@extends('layout.main')

@section('content')

<section class="profile-section py-5 bg-light">
    <div class="container">
        <h2 class="mb-4 fw-bold text-dark">My Account</h2>

        <div class="row">
            <div class="col-12 d-lg-none mb-3">
                <button class="btn btn-outline-secondary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#profileSidebarCollapse">
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
                        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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

                        <h3 class="card-title mb-4">My Saved Addresses</h3>
                      <!-- Button to Open Add Address Modal -->
<button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addAddressModal">
    <i class="fas fa-plus me-2"></i> Add New Address
</button>


                 <div class="row g-4">
    <!-- Home Address from Users Table -->
    <div class="col-lg-6 col-md-12">
        <div class="card address-card border-success h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-home me-2"></i> Home Address</span>
                <span class="badge bg-success">DEFAULT</span>
            </div>
            <div class="card-body">
                <p class="fw-bold mb-1">{{ $userAddress['name'] }}</p>
                <address class="mb-3 small">
                    {{ $userAddress['address'] }}<br>
                    {{ $userAddress['city'] }}, {{ $userAddress['state'] }} - {{ $userAddress['zipcode'] }}<br>
                    Phone: {{ $userAddress['phone'] }}
                </address>
                <div>
                    <button 
                        class="btn btn-sm btn-outline-primary me-2 edit-user-address-btn" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editUserAddressModal"
                        data-name="{{ $userAddress['name'] }}"
                        data-address="{{ $userAddress['address'] }}"
                        data-city="{{ $userAddress['city'] }}"
                        data-zipcode="{{ $userAddress['zipcode'] }}"
                        data-phone="{{ $userAddress['phone'] }}"
                    >
                        <i class="fas fa-edit"></i> Edit
                    </button>

                    <!-- Delete button triggers form submit -->
                    <form method="POST" action="{{ route('user.address.delete') }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete your home address?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" type="submit">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
 </div>


                        <!-- Address List -->
@foreach ($addresses as $address)
<div class="col-lg-6 col-md-12">
    <div class="card address-card border-secondary h-100">
        <div class="card-header bg-light text-dark">
            <i class="fas fa-building me-2"></i> Other Address
        </div>
        <div class="card-body">
            <p class="fw-bold mb-1">{{ $address->receiver_name }}</p>
            <address class="mb-3 small">
                {{ $address->address }}<br>
                {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}<br>
            </address>
            <div>
                <!-- Edit button -->
                <button class="btn btn-sm btn-outline-primary me-2 edit-address-btn" data-id="{{ $address->id }}" data-bs-toggle="modal" data-bs-target="#editAddressModal">
                    <i class="fas fa-edit"></i> Edit
                </button>

                <!-- Delete form -->
                <form action="{{ route('address.destroy', $address->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this address?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" type="submit"><i class="fas fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Edit Address Modal -->
<div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="editAddressForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editAddressModalLabel">Edit Address</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="addressId" name="id" />

                    <div class="mb-3">
                        <label for="receiverName" class="form-label">Receiver Name</label>
                        <input type="text" class="form-control" id="receiverName" name="receiver_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="addressText" class="form-label">Address</label>
                        <textarea class="form-control" id="addressText" name="address" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="pincode" class="form-label">Pincode</label>
                        <input type="text" class="form-control" id="pincode" name="pincode" required>
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>

                    <div class="mb-3">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" id="state" name="state" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100">Update Address</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Edit Home Address Modal -->
<div class="modal fade" id="editUserAddressModal" tabindex="-1" aria-labelledby="editUserAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="editUserAddressForm" method="POST" action="{{ route('user.address.update') }}">
                @csrf
                @method('PUT')

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editUserAddressModalLabel">Edit Home Address</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="userName" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="userAddress" class="form-label">Address</label>
                        <textarea class="form-control" id="userAddress" name="address" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="userCity" class="form-label">City</label>
                        <input type="text" class="form-control" id="userCity" name="city" required>
                    </div>

                    <div class="mb-3">
                        <label for="userZipcode" class="form-label">Zipcode</label>
                        <input type="text" class="form-control" id="userZipcode" name="zipcode" required>
                    </div>

                    <div class="mb-3">
                        <label for="userPhone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="userPhone" name="phone" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100">Update Address</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal for Add New Address -->
<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('account.add_address') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addAddressModalLabel">Add New Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" name="receiver_name" class="form-control" placeholder="Receiver Name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="address" class="form-control" placeholder="Full Address" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="pincode" class="form-control" placeholder="Pincode" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="city" class="form-control" placeholder="City" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="state" class="form-control" placeholder="State" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Address</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {

    // Setup CSRF for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // When Edit button clicked
    $('.edit-address-btn').click(function() {
        const addressId = $(this).data('id');
        const url = `/address/${addressId}/edit`;

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                // Fill the modal inputs with data
                $('#addressId').val(response.id);
                $('#receiverName').val(response.receiver_name);
                $('#addressText').val(response.address);
                $('#pincode').val(response.pincode);
                $('#city').val(response.city);
              

                // Set form action for update route
                $('#editAddressForm').attr('action', `/address/${response.id}`);
            },
            error: function(xhr) {
                alert('Failed to fetch address data.');
                console.error(xhr);
            }
        });
    });

    // On form submit, send AJAX PUT request
    $('#editAddressForm').submit(function(e) {
        e.preventDefault();

        const actionUrl = $(this).attr('action');
        const formData = $(this).serialize();

        $.ajax({
            url: actionUrl,
            type: 'PUT',
            data: formData,
            success: function(response) {
                if (response.success) {
                    alert('Address updated successfully!');
                    location.reload();
                } else {
                    alert('Failed to update address.');
                }
            },
            error: function(xhr) {
                alert('Error updating address.');
                console.error(xhr);
            }
        });
    });

});
</script>


<script>
$(document).ready(function() {
    // When edit button clicked, fill modal inputs with data attributes
    $('.edit-user-address-btn').click(function() {
        $('#userName').val($(this).data('name'));
        $('#userAddress').val($(this).data('address'));
        $('#userCity').val($(this).data('city'));
        $('#userState').val($(this).data('state'));
        $('#userZipcode').val($(this).data('zipcode'));
        $('#userPhone').val($(this).data('phone'));
    });
});
</script>
@endsection
