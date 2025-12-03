<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class AdminNewOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('🛍️ New Order Received - ' . $this->order->order_number)
                    ->view('emails.admin-order')
                    ->with([
                        'order' => $this->order,
                        'user' => $this->order->user,
                        'items' => $this->order->items,
                    ]);
    }
}
