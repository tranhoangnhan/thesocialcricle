<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $username;
    public $otp;

    public function __construct($name, $username, $otp)
    {
        $this->name = $name;
        $this->username = $username;
        $this->otp = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('clients.emails.welcome')
            ->with([
                'name' => $this->name,
                'username' => $this->username,
                'otp' => $this->otp,
            ])->subject($this->otp .' là mã xác thực tài khoản SocialCircle');
    }
}
