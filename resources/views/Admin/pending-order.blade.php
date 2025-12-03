@extends('Admin.layout.app')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark text-white fw-bold">
                    Pending Order List
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

                <div class="card-body p-0">
                    <div class="accordion" id="accordionOrders">
                        @forelse ($orders as $order)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $order->id }}">
                                    <button class="accordion-button collapsed border-0 bg-light" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $order->id }}"
                                        aria-expanded="false" aria-controls="collapse{{ $order->id }}">
                                        <table class="table align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Status</th>
                                                    <th>Change Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $order->order_number }}</td>
                                                    <td><span
                                                            class="badge bg-info text-dark">{{ ucfirst($order->status) }}</span>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('admin.orders.status', $order->id) }}"
                                                            method="POST" class="d-flex gap-2"
                                                            id="status-form-{{ $order->id }}">
                                                            @csrf
                                                            @method('PATCH')
                                                            <select name="status"
                                                                class="form-select form-select-sm status-select"
                                                                data-order-id="{{ $order->id }}" required>
                                                            
                                                                <option value="packed"
                                                                    {{ $order->status == 'packed' ? 'selected' : '' }}>
                                                                    Order Packed</option>
                                                                <option value="courier"
                                                                    {{ $order->status == 'courier' ? 'selected' : '' }}
                                                                    {{ !$order->courier_name ? 'disabled' : '' }}>
                                                                    Courier</option>
                                                                <option value="delivered"
                                                                    {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                                                    Delivered</option>
                                                                <option value="cancelled"
                                                                    {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                                                    Cancelled</option>
                                                            </select>

                                                            <button type="submit"
                                                                class="btn btn-sm btn-primary">Update</button>

                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#courierModal{{ $order->id }}">
                                                                Courier Details
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </button>
                                </h2>

                                <div class="modal fade" id="courierModal{{ $order->id }}" tabindex="-1"
                                    aria-labelledby="courierModalLabel{{ $order->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('admin.orders.courier-details', $order->id) }}"
                                            method="POST" class="modal-content">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="courierModalLabel{{ $order->id }}">Add
                                                    Courier Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="courier_name_{{ $order->id }}"
                                                        class="form-label">Courier Name</label>
                                                    <input type="text" name="courier_name"
                                                        id="courier_name_{{ $order->id }}" class="form-control"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tracking_number_{{ $order->id }}"
                                                        class="form-label">Tracking Number</label>
                                                    <input type="text" name="tracking_number"
                                                        id="tracking_number_{{ $order->id }}" class="form-control"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="courier_link_{{ $order->id }}"
                                                        class="form-label">Courier Link</label>
                                                   <input type="text" name="courier_link" id="courier_link_{{ $order->id }}" class="form-control"
       placeholder="https://tracking-url.com/your-tracking-code"
       pattern="^(https?:\/\/|www\.)[^\s]+$"
       title="Enter a valid URL starting with http://, https://, or www.">

                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save Details</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="collapse{{ $order->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="heading{{ $order->id }}" data-bs-parent="#accordionOrders">
                                    <div class="accordion-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Product Image</th>
                                                        <th>Quantity</th>
                                                        <th>Mobile NO</th>
                                                        <th>User City</th>
                                                        <th>Shipping Address</th>
                                                        <th>Zip Code</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->items as $item)
                                                        <tr>
                                                            <td>{{ $item->product->title ?? 'N/A' }}</td>
                                                            <td>
                                                                <img src="{{ asset($item->product->images->first()->image_path ?? 'images/default-placeholder.jpg') }}"
                                                                    alt="Product Image" width="50" height="50"
                                                                    class="rounded">
                                                            </td>
                                                           
                                                            <td>{{ $item->quantity }}</td>
                                                             <td>{{ $order ->user->phone ?? 'N/A' }}</td>
                                                            <td>{{ $order->user->city ?? 'N/A' }}</td>
                                                            <td>{{ $order->shipping_address }}</td>
                                                            <td>{{ $order->user->zipcode ?? 'N/A' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center p-4">No pending orders found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.status-select').forEach(select => {
            select.addEventListener('change', function() {
                const selected = this.value;
                const orderId = this.dataset.orderId;

                // If user tries to select 'courier' but courier details are missing, prevent submission
                if (selected === 'courier' && this.querySelector('option[value="courier"]').disabled) {
                    alert('Please add courier details before changing status to courier.');
                    // Reset select to previous value
                    this.value = @json(old('status', 'pending')); // Or store previous value if needed
                }
            });
        });
    </script>
@endsection
