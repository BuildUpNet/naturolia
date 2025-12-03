<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

  protected $fillable = [
    'user_id',
    'guest_email',
    'guest_phone',
    'order_number',
    'shipping_address',
    'shipping_label',
    'payment_method',
    'subtotal',
    'cod_charges',
    'total',
    'status',
    'refund_status',
    'razorpay_order_id',
    'razorpay_payment_id',
    'razorpay_signature',
    'return_status',
    'return_reason',
    'reject_reason',
    'return_requested_at',
    'invoice_path',
    'courier_name',
    'tracking_number',
    'courier_link',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
