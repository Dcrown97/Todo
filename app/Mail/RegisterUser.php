<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($createUser)
    {
        $this->createUser = $createUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = 'Novaji Introserve';
        $address = 'Noaji@info.com';
        $subject = 'Welcome, You have successfully Registered';
        return $this->view('mail.user')
            ->from($address, $name)
            ->subject($subject)
            ->with([
                'createUser' => $this->createUser,
            ]);
    }
}
