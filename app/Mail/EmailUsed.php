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
    protected $code;
    protected $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $email, $code, $type)
    {
        $this->user = $user;
        $this->email = $email;
        $this->code = $code;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $address = 'no-reply@itsaprojectmanager.tk';
        $name = 'Internalprojectmanager (IPM)';
        $subject = null;

        switch ($this->type) {
            case "addedEmail":
                $subject = 'IPM - New Email added to your account';

                return $this->view('email.addedEmail')
                    ->from($address, $name)
                    ->subject($subject)
                    ->with([
                        'firstName' => $this->user->first_name,
                        'lastName' => $this->user->last_name,
                        'emailAdded' => $this->email,
                        'verifyCode' => $this->code,
                    ]);

            case "newAccount":
                $subject = 'IPM - Account verification';

                return $this->view('email.newAccount')
                    ->from($address, $name)
                    ->subject($subject)
                    ->with([
                        'firstName' => $this->user->first_name,
                        'lastName' => $this->user->last_name,
                        'emailAdded' => $this->email,
                        'verifyCode' => $this->code,
                    ]);

            case 'newEmailExisting':
                $subject = 'IPM - Activate your email address';

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
}
