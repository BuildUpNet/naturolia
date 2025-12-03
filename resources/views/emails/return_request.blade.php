<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Return Request Notification</title>
  <style>
    body {
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
      color: #333;
    }
    .email-wrapper {
      max-width: 600px;
      margin: 30px auto;
      background-color: #ffffff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      border: 1px solid #007300;
    }
    .email-header {
      background-color: #ffffff;
      text-align: center;
      padding: 25px 20px 15px;
      border-bottom: 3px solid #007300;
    }
    .email-header img {
      max-height: 60px;
    }
    .email-body {
      padding: 25px 30px;
      line-height: 1.7;
    }
    .email-body h2 {
      color: #222;
      margin-bottom: 15px;
    }
    .email-body p {
      margin: 8px 0;
      font-size: 15px;
    }
    .info-box {
      background-color: #f8f9fa;
      border-left: 4px solid #007300;
      padding: 12px 15px;
      margin: 15px 0;
      border-radius: 5px;
    }
    .footer {
      background-color: #f3f4f6;
      text-align: center;
      padding: 15px;
      font-size: 13px;
      color: #777;
    }
    .highlight {
      font-weight: 600;
      color: #007300;
    }
  </style>
</head>
<body>

  <div class="email-wrapper">
    <div class="email-header">
    <img 
        src="https://naturolia.in/assets/images/logo.png" 
        alt="Naturolia" 
        width="180" 
        height="auto" 
        style="display:block; margin:0 auto; max-width:180px; height:auto; object-fit:contain;">
    </div>

    <div class="email-body">
      @if ($for === 'admin')
        <h2>New Return Request Received</h2>
        <p>Dear Admin,</p>
        <p>A new return request has been submitted by a customer.</p>

        <div class="info-box">
          <p><strong>Order ID:</strong> <span class="highlight">#{{ $order->order_number }}</span></p>
          <p><strong>Customer:</strong> {{ $order->user->name }}</p>
          <p><strong>Email:</strong> {{ $order->user->email }}</p>
          <p><strong>Reason:</strong> {{ $order->return_reason }}</p>
          <p><strong>Requested on:</strong> {{ \Carbon\Carbon::parse($order->return_requested_at)->format('M d, Y h:i A') }}</p>
        </div>

        <p>Please review the return request in your admin panel.</p>

      @else
        <h2>Your Return Request Has Been Received</h2>
        <p>Hi <strong>{{ $order->user->name }}</strong>,</p>
        <p>We’ve received your return request for the following order:</p>

        <div class="info-box">
          <p><strong>Order ID:</strong> <span class="highlight">#{{ $order->order_number }}</span></p>
          <p><strong>Reason:</strong> {{ $order->return_reason }}</p>
          <p><strong>Request Date:</strong> {{ \Carbon\Carbon::parse($order->return_requested_at)->format('M d, Y h:i A') }}</p>
        </div>

        <p>Our team will review your request and notify you once it’s accepted or rejected.</p>
         <p><em>When accepted, your refund will be initiated within two to three working days</em></p>
        <p>Thank you for shopping with <strong>Naturolia</strong>!</p>
      @endif
    </div>

    <div class="footer">
      <p>© {{ date('Y') }} <strong>Naturolia</strong>. All Rights Reserved.</p>
    </div>
  </div>

</body>
</html>
