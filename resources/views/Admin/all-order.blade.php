@extends('Admin.layout.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">All Orders</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Order Number</th>
                <th>User</th>
                <th>Mobile no</th>
                <th>Status</th>
                <th>Total</th>
                <th>Invoice</th>
                <th>Shipment</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->user->name ?? 'N/A' }}</td>
                 <td>{{ $order->user->phone ?? 'N/A' }}</td>
                <td>
                    <span class="badge bg-info text-dark">{{ ucfirst($order->status) }}</span>
                </td>
                <td>₹{{ number_format($order->total, 2) }}</td>
                <td>
                 @if($order->invoice_path && file_exists(public_path($order->invoice_path)))
    <a href="{{ asset($order->invoice_path) }}" 
       target="_blank" 
       class="btn btn-sm btn-primary">
       View Invoice
    </a>

    <a href="{{ route('invoice.download', $order->id) }}" 
       class="btn btn-sm btn-secondary">
       Download Invoice
    </a>
@else
    <a href="{{ route('invoice.download', $order->id) }}" 
       class="btn btn-sm btn-warning">
       Generate Invoice
    </a>
@endif


                </td>
                <td>
                    @if($order->tracking_number || $order->courier_link)
                        <a href="{{ $order->courier_link }}" target="_blank" class="btn btn-sm btn-success">Track Shipment</a>
                    @else
                        <span class="text-muted">No Tracking Info</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No orders found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
