<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReturnRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $for;

    public function __construct($order, $for)
    {
        $this->order = $order;
        $this->for = $for;
    }

    public function build()
    {
        $subject = $this->for === 'admin'
            ? 'New Return Request Received'
            : 'Your Return Request Has Been Received';

        return $this->subject($subject)
            ->view('emails.return_request');
    }
}
