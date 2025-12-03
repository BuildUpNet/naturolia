<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Order Received - {{ $order->order_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px; }
        .container { max-width: 700px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 10px; }
        h2 { color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f4f4f4; }
        .footer { margin-top: 20px; font-size: 13px; color: #777; text-align: center; }
        .logo { width: 160px; display: block; margin: 0 auto 20px; }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://naturolia.in/assets/images/logo.png" alt="Naturolia" class="logo">
        <h2>New Order Received</h2>

        <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
        <p><strong>Customer:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Mobile No:</strong> {{ $user->phone }}</p>
        <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
 <p><strong>Payment Mode:</strong> 
            @if($order->payment_method === 'cod')
                Cash on Delivery (COD)
            @elseif($order->payment_method === 'online')
                Online Payment
            @else
                {{ ucfirst($order->payment_method) ?? 'N/A' }}
            @endif
        </p>
        <h3>Products:</h3>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->product->title ?? 'N/A' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ number_format($item->price, 2) }}</td>
                    <td>₹{{ number_format($item->total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Total Amount: ₹{{ number_format($order->total, 2) }}</h3>

        <div class="footer">
            <p>© {{ date('Y') }} Naturolia. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
