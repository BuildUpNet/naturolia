<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px 40px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            font-size: 14px;
            line-height: 24px;
            font-family: DejaVu Sans, sans-serif;
            color: #555;
            background: white;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        .invoice-box table td {
            padding: 8px;
            vertical-align: top;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 35px;
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 20px;
            width: 33.33%;
        }
        .invoice-box table tr.heading td {
            background: #f1f1f1;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        @media print {
            @page {
                size: A4;
                margin: 0;
            }
            body {
                margin: 0;
                padding: 0;
                background: #fff;
            }
            .hide-on-print {
                display: none !important;
            }
            .invoice-box {
                box-shadow: none !important;
                border: none !important;
                max-width: 100% !important;
                width: 100%;
                padding: 40px;
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="4">
                  <table>
    <tr>
        <td class="title" style="line-height: 1.8; font-size: 13px;">
            <img src="{{ public_path('assets/images/logo.png') }}" 
                 style="max-width: 160px; margin-bottom: 8px;" 
                 alt="Naturolia Logo"><br>

            GST No: <strong>03BUAPR6810C1Z4</strong><br>
            Email: <a href="mailto:sale@naturolia.in" style="color:#555; text-decoration:none;">sale@naturolia.in</a><br>
       Address:  406, 4th Floor, San Plaza Building,<br>
&nbsp;&nbsp;&nbsp;&nbsp;Feroze Gandhi Market, Ludhiana – 141001
        </td>

        <td style="text-align: right; font-size: 13px; line-height: 1.8;">
            <strong style="font-size: 16px;">TAX INVOICE</strong><br>
            Invoice #: {{ $order->invoice_number ?? $order->order_number }}<br>
            Date: {{ $order->created_at->format('d M, Y') }}
        </td>
    </tr>
</table>

                </td>
            </tr>

            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                <strong>Billed To:</strong><br>
                                {{ strtoupper($order->user->name) }}<br>
                                {{ $order->shipping_address }}
                            </td>
                            <td style="text-align: center;">
                                <strong>Shipped To:</strong><br>
                                {{ strtoupper($order->user->name) }}<br>
                                {{ $order->shipping_address }}<br>
                                Phone: {{ $order->user->phone ?? 'N/A' }}
                            </td>
                            <td style="text-align: right;">
                                <strong>Order Details:</strong><br>
                                Order ID: {{ $order->order_number }}<br>
                                Payment: {{ strtoupper($order->payment_method) }}<br>
                                Date: {{ $order->created_at->format('d M, Y') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Item Description</td>
                <td style="text-align: center;">Qty</td>
                <td style="text-align: right;">Unit Price</td>
                <td style="text-align: right;">Amount (₹)</td>
            </tr>

            @foreach($order->items as $item)
            <tr class="item {{ $loop->last ? 'last' : '' }}">
                <td>{{ $item->product->title }}</td>
                <td style="text-align: center;">{{ $item->quantity }}</td>
                <td style="text-align: right;">{{ number_format($item->price, 2) }}</td>
                <td style="text-align: right;">{{ number_format($item->total, 2) }}</td>
            </tr>
            @endforeach

            <tr class="total">
                <td colspan="3" style="text-align: right;">Subtotal:</td>
                <td style="text-align: right;">₹ {{ number_format($order->subtotal, 2) }}</td>
            </tr>
            @if(strtolower($order->payment_method) === 'cod')
<tr class="total">
    <td colspan="3" style="text-align: right;">COD Charges:</td>
    <td style="text-align: right;">₹ {{ number_format($order->cod_charges, 2) }}</td>
</tr>
@endif


            <tr class="total">
                <td colspan="3" style="text-align: right;">Grand Total:</td>
                <td style="text-align: right;">₹ {{ number_format($order->total) }}</td>
            </tr>
        </table>

        <div style="margin-top: 30px; border-top: 1px solid #eee; padding-top: 10px;">
            <p style="font-size: 12px; color: #999;">Note: This is a computer-generated invoice. No signature required.</p>
            <p style="font-size: 12px; color: #999;">Thanks for shopping with Naturolia! For support, contact: info@naturolia.in</p>
        </div>
    </div>
</body>
</html>
