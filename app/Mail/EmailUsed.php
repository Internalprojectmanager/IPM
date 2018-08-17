<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class EmailUsed extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $email)
    {
        $this->user = $user;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $address = 'no-reply@itsaprojectmanager.tk';
        $subject = 'New email address added to your IPM account';
        $name = 'Internalprojectmanager (IPM)';

        return $this->view('email.addedEmail')
            ->from($address, $name)
            ->subject($subject)
            ->with([
                'firstName' => $this->user->first_name,
                'lastName' => $this->user->last_name,
                'emailAdded' => $this->email,
            ]);
    }
}
