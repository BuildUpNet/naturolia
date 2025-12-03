<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status Updated - {{ $order->order_number }}</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Arial', sans-serif;
            color: #333;
            padding: 30px;
        }
        .email-container {
            max-width: 700px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 250px;
        }
        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 15px;
        }
        .status-box {
            background: #e8f5e9;
            color: #27ae60;
            padding: 12px 20px;
            border-radius: 6px;
            text-align: center;
            font-weight: bold;
            display: inline-block;
        }
        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
            color: #777;
        }
        .footer strong {
            color: #2c3e50;
        }
    </style>
</head>
<body>

    <div class="email-container">
     <!-- Email Header -->
<div style="text-align:center; background:#f5fff6; padding:20px 0; border-radius:8px 8px 0 0;">
    <img 
        src="https://naturolia.in/assets/images/logo.png" 
        alt="Naturolia" 
        width="180" 
        height="auto" 
        style="display:block; margin:0 auto; max-width:180px; height:auto; object-fit:contain;">
</div>


        <h2>Order Status Updated</h2>

        <p>Hello <strong>{{ $order->user->name }}</strong>,</p>

        <p>Your order <strong>#{{ $order->order_number }}</strong> status has been updated to:</p>

        <div class="text-center mb-4">
            <span class="status-box">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <p>We’ll keep you informed as your order progresses. You can check your order details anytime from your Naturolia account.</p>

        <p>Thanks <strong>Naturolia</strong>!</p>

        <div class="footer">
            <p>© {{ date('Y') }} <strong>Naturolia</strong>. All rights reserved.</p>
        </div>
    </div>

</body>
</html>
