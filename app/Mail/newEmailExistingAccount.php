<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class newEmailExistingAccount extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $email;
    protected $code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $email, $code)
    {
        $this->user = $user;
        $this->email = $email;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $address = 'no-reply@itsaprojectmanager.tk';
        $subject = 'IPM - Activate your email address';
        $name = 'Internalprojectmanager (IPM)';

        return $this->view('email.newEmailExisting')
            ->from($address, $name)
            ->subject($subject)
            ->with([
                'firstName' => $this->user->first_name,
                'lastName' => $this->user->last_name,
                'emailAdded' => $this->email,
                'verifyCode' => $this->code,
            ]);
    }
}
