@extends('Admin.layout.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">
            <i class="bi bi-x-circle me-2 text-success"></i>Return Requests
        </h4>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            @if($returns->isEmpty())
                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle me-2"></i> No return requests found.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

                        <thead class="table-success text-dark">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Phone</th>
                                <th>Payment Type</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th>Requested At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($returns as $order)
                                <tr>
                                    <td><strong>#{{ $order->order_number }}</strong></td>
                                    <td>
                                        {{ $order->user->name }}<br>
                                        <small class="text-muted">{{ $order->user->email }}</small>
                                    </td>
                                    <td>{{ $order->user->phone ?? '—' }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ strtoupper($order->payment_method) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->return_reason }}</td>

                                    <td>
                                        @if($order->return_status == 'requested')
                                            <span class="badge bg-info">Requested</span>
                                        @elseif($order->return_status == 'accepted')
                                            <span class="badge bg-success">Accepted</span>
                                        @elseif($order->return_status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @elseif($order->return_status == 'refunded')
                                            <span class="badge bg-primary">Refunded</span>
                                        @endif
                                    </td>

                                    <td>{{ \Carbon\Carbon::parse($order->return_requested_at)->format('M d, Y h:i A') }}</td>

                                    <td>
                                        {{-- Requested --}}
                                        @if($order->return_status == 'requested')
                                            <form action="{{ route('admin.return.accept', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-sm btn-success">
                                                    <i class="bi bi-check2-circle me-1"></i> Accept
                                                </button>
                                            </form>

                                            <!-- Reject Button -->
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#rejectModal{{ $order->id }}">
                                                <i class="bi bi-x-circle me-1"></i> Reject
                                            </button>

                                            <!-- Reject Modal -->
                                            <div class="modal fade" id="rejectModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.return.reject', $order->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Reject Return Request</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label class="form-label">Reason for Rejection</label>
                                                                <textarea name="reject_reason" class="form-control" rows="3" required></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-danger">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        {{-- Accepted --}}
                                        @elseif($order->return_status == 'accepted')
                                           <form action="{{ route('admin.return.refund', $order->id) }}" method="POST">

                                                @csrf
                                                <button class="btn btn-sm btn-primary"
                                                    onclick="return confirm('Process refund for this order?')">
                                                    <i class="bi bi-cash-stack me-1"></i>
                                                    @if($order->payment_mode == 'online')
                                                        Refund (Online)
                                                    @else
                                                    Refund (COD)
                                                    @endif
                                                </button>
                                            </form>

                                        {{-- Rejected --}}
                                        @elseif($order->return_status == 'rejected')
                                            <span class="text-muted small">Rejected</span>

                                        {{-- Refunded --}}
                                        @elseif($order->return_status == 'refunded')
                                            <span class="text-success small">Refunded Successfully</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
