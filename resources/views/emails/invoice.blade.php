<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->order_number }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>Thank you for your order, {{ $order->user->name }}!</h2>
    <p>Your order <strong>#{{ $order->order_number }}</strong> has been placed successfully.</p>
    <p><strong>Order Total:</strong> ₹{{ number_format($order->total, 2) }}</p>
    <p>We’ve attached your invoice PDF to this email.</p>
    <hr>
    <p style="font-size:13px; color:#999;">© {{ date('Y') }} Naturolia. All rights reserved.</p>
</body>
</html>
