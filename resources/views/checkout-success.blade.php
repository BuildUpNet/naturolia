@extends('layout.main')

@section('content')
<section class="py-5 text-center">
    <div class="container">
        <h2 class="fw-bold text-success mb-3"><i class="fas fa-check-circle"></i> Order Successful!</h2>
        <p class="lead">Thank you for shopping with us.</p>
        <p class="text-muted">We’ve emailed your invoice and order details.</p>
        <a href="{{ route('account.orders') }}" class="btn btn-primary mt-3">Order History</a>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('order_success') || request()->has('Order Placed'))
<script>
Swal.fire({
    icon: 'success',
    title: '{{ request()->has("paid") ? "Payment Successful!" : "Order Placed Successfully!" }}',
    text: 'Your invoice has been emailed.',
    confirmButtonColor: '#38b000',
}).then(() => {
    window.location.href = "{{ route('account.orders') }}";
});
</script>
@endif
@endsection
