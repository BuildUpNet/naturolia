<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class AccountReactivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $url = route('account.reactivate.token', ['token' => $this->user->reactivation_token]);

        return $this->subject('Reactivate Your Account')
                    ->markdown('emails.reactivate-account', ['url' => $url]);
    }
}
