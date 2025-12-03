<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCancelledMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $type;

    /**
     * Create a new message instance.
     */
    public function __construct($order, $type)
    {
        $this->order = $order;
        $this->type = $type;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = $this->type === 'cod'
            ? 'Your Order has been Cancelled'
            : 'Your Order Cancelled – Refund will be processed soon';

        return $this->subject($subject)
                    ->view('emails.order-cancelled')
                    ->with([
                        'order' => $this->order,
                        'type' => $this->type,
                    ]);
    }
}
