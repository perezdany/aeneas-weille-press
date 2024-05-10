<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgottenPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data= [];

    public function __construct(Array $user)
    {
        //
        $this->data = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /*return $this
        ->from('donotreply@thortechnologie.com')
        ->subject('Ne pas répondre, Confirmation de mail')
        ->view('emails/mailview');*/
        return $this->markdown('emails.resetpass');
    }
}
