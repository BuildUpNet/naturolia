<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Return Status Update</title>
  <style>
    body { font-family: Arial, sans-serif; background:#f6f6f6; margin:0; padding:0; color:#333; }
    .wrapper { max-width:600px; margin:20px auto; background:#fff; border-radius:10px; overflow:hidden;
               box-shadow:0 4px 10px rgba(0,0,0,0.05); }
    .header { background:#28a745; text-align:center; padding:25px 0; }
    .header img { max-height:60px; }
    .body { padding:25px 30px; line-height:1.6; }
    .body h2 { color:#28a745; margin-bottom:15px; }
    .body p { font-size:15px; margin:8px 0; }
    .info-box { background:#e8f5e9; border-left:4px solid #28a745; padding:12px 15px; border-radius:5px; margin:15px 0; }
    .footer { background:#f1f1f1; text-align:center; padding:12px; font-size:13px; color:#777; }
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="header">
      <img 
        src="https://naturolia.in/assets/images/logo.png" 
        alt="Naturolia" 
        width="180" 
        height="auto" 
        style="display:block; margin:0 auto; max-width:180px; height:auto; object-fit:contain;">
    </div>

    <div class="body">
      @if($status === 'accepted')
        <h2>Return Request Accepted ✅</h2>
        <p>Hi {{ $order->user->name }},</p>
        <p>Your return request for Order <strong>#{{ $order->order_number }}</strong> has been <b>accepted</b>.</p>
        <p>Our team will verify the product once received and process your refund soon.</p>

      @elseif($status === 'rejected')
        <h2 style="color:#dc3545;">Return Request Rejected ❌</h2>
        <p>Hi {{ $order->user->name }},</p>
        <p>We’re sorry! Your return request for Order <strong>#{{ $order->order_number }}</strong> was <b>rejected</b>.</p>
        <div class="info-box">
          <p><strong>Rejection Reason:</strong> {{ $order->reject_reason }}</p>
        </div>

      @elseif($status === 'refunded')
        <h2 style="color:#007bff;">Refund Processed 💸</h2>
        <p>Hi {{ $order->user->name }},</p>
        <p>Your refund for Order <strong>#{{ $order->order_number }}</strong> has been successfully processed.</p>
        <p>Amount refunded: ₹{{ number_format($order->total,2) }}</p>
      @endif

      <div class="info-box">
        <p><strong>Order ID:</strong> #{{ $order->order_number }}</p>
        <p><strong>Customer:</strong> {{ $order->user->name }}</p>
        <p><strong>Email:</strong> {{ $order->user->email }}</p>
      </div>

      <p>Thank you for shopping with <strong>Naturolia</strong>. We value your trust!</p>
    </div>

    <div class="footer">
      © {{ date('Y') }} <strong>Naturolia</strong>. All Rights Reserved.
    </div>
  </div>
</body>
</html>
