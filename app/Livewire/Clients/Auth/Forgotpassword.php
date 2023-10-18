<?php

namespace App\Livewire\Clients\Auth;

use App\Mail\Forgotpassword as Forgotpassword_Mail;
use App\Models\OTP_Manager;
use App\Models\UsersModel;
use Livewire\Component;
use Mail;
use OTPHP\TOTP;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class Forgotpassword extends Component
{
    public $email;
    protected function rules()
    {
        $rules = [
            'email' => 'required|string|email|exists:users,user_email',
        ];
        return $rules;
    }
    protected $validationAttributes = [
        'email' => 'email',
    ];

    protected $messages = [
        'email.required' => 'Vui lòng nhập :attribute.',
        'email.string' => 'Vui lòng nhập :attribute là 1 chuỗi.',
        'email.email' => 'Vui lòng nhập đúng định dạng email',
        'email.exists' => 'Email không tồn tại trong hệ thống',
    ];

    public function render()
    {
        return view('livewire.clients.auth.forgotpassword');
    }
    public function check()
    {
        $validatedData = $this->validate();
        $error = \app\Helpers\Helper::throttle('otp', 5, 5, 'mi');
        if ($error) {
            $this->addError('email', $error);
        }
        $secretKey = Str::random(32);
        $otp = TOTP::create(\app\Helpers\Helper::base32_encode($secretKey), 6);
        if ($validatedData) {
            $userData = UsersModel::where('user_email', $this->email)->first();
            if ($userData) {
                $error = \app\Helpers\Helper::throttle('forgotpassword', 1, 10, 'mi');
                if ($error) {
                    throw ValidationException::withMessages([
                        'email' => 'Chúng tôi đã gửi mã OTP về email của bạn!',
                    ]);
                }
                $check = OTP_Manager::where('email', $this->email)->first();
                if ($check) {
                    OTP_Manager::where('email',$this->email)->update([
                        'token' => $otp->now(),
                        'expires_at' => Carbon::now()->addMinutes(30),
                    ]);
                } else {
                    OTP_Manager::create([
                        'email' => $this->email,
                        'token' => $otp->now(),
                        'type' => 'forgotpassword',
                        'expires_at' => Carbon::now()->addMinutes(30),
                    ]);
                }

                $key = encrypt(\app\Helpers\Helper::base32_encode($this->email . '|' . $otp->now() . '|' . Carbon::now()->addMinutes(30)));
                $url = route('reset_password', ['key' => $key]); // url gửi về mail
                $key2 = 'tc?log=' . encrypt(\app\Helpers\Helper::base32_encode($this->email));
                Mail::mailer('mailgun')->to($userData['user_email'])->send(new Forgotpassword_Mail($userData['user_fullname'], $userData['user_username'], $otp->now(), $url));
                return redirect(route('reset_password', ['key' => $key2]));
            } else {
                dd('error');
            }
        }
    }


}
