<?php

namespace App\Livewire\Clients\Auth;

use Livewire\Component;
use PragmaRX\Google2FA\Google2FA;

class Verify2fa extends Component
{
    public $otp;
    protected $validationAttributes = [
        'user_username' => 'Mã OTP',
    ];
    protected $messages = [
        '*.required' => 'Vui lòng nhập :attribute.',
    ];
    public function save()
    {
        $this->validate([
            'otp' => 'required',
        ]);
        $google2fa = app(Google2FA::class);
        $otp = $this->otp;
        $secret = auth()->user()->google2fa_secret;
        $valid = $google2fa->verifyKey($secret, $otp);
        if ($valid) {
            session(['2fa_enabled' => false]);
            return redirect()->route('home');
        } else {
            $this->addError('errorOTP', 'Mã OTP không chính xác!');
        }
    }
    public function render()
    {
        return view('livewire.clients.auth.verify2fa');
    }
}
