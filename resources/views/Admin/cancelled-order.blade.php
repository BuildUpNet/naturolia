@extends('Admin.layout.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-4"><i class="bi bi-x-circle me-2 text-danger"></i> Cancelled Orders</h4>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order No.</th>
                        <th>Customer</th>
                        <th>Payment Method</th>
                        <th>Total</th>
                        <th>Refund Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->order_number }}</td>
                           <td>{{ $order->guest_name ?? ($order->user->name ?? 'Null') }}</td>

                            <td>{{ strtoupper($order->payment_method) }}</td>
                            <td>₹{{ number_format($order->total, 2) }}</td>
                            <td>
                                @if($order->refund_status === 'completed')
                                    <span class="badge bg-success">Refunded</span>
                                @elseif($order->refund_status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($order->refund_status === 'failed')
                                    <span class="badge bg-danger">Failed</span>
                                @else
                                    <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($order->payment_method === 'online' && $order->refund_status === 'pending')
                                <form action="{{ route('admin.orders.refund', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Refund this payment?')">
                                        <i class="bi bi-arrow-repeat"></i> Refund
                                    </button>
                                </form>
                                @else
                                    <span class="text-muted">No Action</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted">No cancelled orders found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
