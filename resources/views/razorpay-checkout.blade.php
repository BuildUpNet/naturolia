<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing Payment...</title>
</head>
<body>
    <h3 style="text-align:center; margin-top:50px;">Please wait... redirecting to payment gateway</h3>

    <form action="{{ route('razorpay.verify') }}" method="POST" id="razorpay-form">
        @csrf
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id" value="{{ $razorpayOrder['id'] }}">
        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
    </form>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var options = {
                key: "{{ $key }}",
                amount: "{{ $razorpayOrder['amount'] }}",
                currency: "INR",
                name: "Naturolia",
                description: "Order #{{ $order->order_number }}",
                order_id: "{{ $razorpayOrder['id'] }}",
                prefill: {
                    name: "{{ $user->name }}",
                    email: "{{ $user->email }}",
                    contact: "{{ $user->phone ?? '' }}"
                },
                notes: {
                    order_id: "{{ $order->id }}"
                },
                theme: {
                    color: "#3399cc"
                },
                handler: function (response) {
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('razorpay_signature').value = response.razorpay_signature;
                    document.getElementById('razorpay-form').submit();
                },
                modal: {
                    ondismiss: function () {
                        window.location.href = "{{ route('cart.view') }}";
                    }
                }
            };

            var rzp1 = new Razorpay(options);
            rzp1.open(); // ✅ auto open payment popup
        });
    </script>
</body>
</html>
