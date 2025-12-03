<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReturnStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct($order, $status)
    {
        $this->order = $order;
        $this->status = $status;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = match ($this->status) {
            'accepted' => 'Your Return Request Accepted',
            'rejected' => 'Your Return Request Rejected',
            'refunded' => 'Refund Processed Successfully',
            default    => 'Return Status Update',
        };

        return $this->subject($subject)
                    ->view('emails.return_status');
    }
}
