<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Forgotpassword extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $username;
    public $otp;
    public $url;

    public function __construct($name, $username, $otp,$url)
    {
        $this->name = $name;
        $this->username = $username;
        $this->otp = $otp;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('clients.emails.forgotpassword')
            ->with([
                'name' => $this->name,
                'username' => $this->username,
                'otp' => $this->otp,
                'url' => $this->url,
            ])->subject($this->otp .' là mã khôi phục tài khoản SocialCircle của bạn');
    }
}
