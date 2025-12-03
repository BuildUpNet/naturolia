<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Cancellation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        h2 {
            color: #27ae60;
        }
        p {
            margin-bottom: 15px;
        }
        strong {
            color: #000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hello {{ $order->user->name ?? 'Customer' }},</h2>

        @if($type === 'cod')
            <p>Your Cash on Delivery (COD) order <strong>#{{ $order->order_number }}</strong> has been successfully cancelled.</p>
            <p>No refund is required since this was a COD order.</p>
        @else
            <p>Your prepaid order <strong>#{{ $order->order_number }}</strong> has been cancelled.</p>
            <p>Your payment will be refunded to your original payment method within <strong>7 business days</strong>.</p>
        @endif

        <p>Thank you for shopping with us!<br><strong>Naturolia</strong></p>
    </div>
</body>
</html>
