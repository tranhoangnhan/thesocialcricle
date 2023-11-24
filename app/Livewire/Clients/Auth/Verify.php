<?php

namespace App\Livewire\Clients\Auth;

use App\Mail\VeirfyMail;
use App\Mail\WelcomeMail;
use App\Models\UsersModel;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class Verify extends Component
{
    public $otp, $check, $check_mail, $user_email;
    protected $maxLoginAttempts = 5;
    protected $decayMinutes = 2;
    public function render()
    {
        return view('livewire.clients.auth.verify');
    }

    protected function rules()
    {
        $rules = [
            'otp' => ['required', 'numeric'],
        ];
        return $rules;
    }
    protected $validationAttributes = [
        'otp' => 'Mã OTP',
        'user_email' => 'Email',
    ];

    protected $messages = [
        'otp.required' => 'Vui lòng nhập :attribute.',
        'otp.numeric' => 'Vui lòng nhập :attribute là số.',
        '*.required' => 'Vui lòng nhập :attribute.',
        '*.email' => ':attribute phải đúng định dạng email',
        '*.unique' => ':attribute đã có trong hệ thống.',
    ];

    protected function ensureIsNotRateLimited()
    {
        $throttleKey = $this->throttleKey();

        if (RateLimiter::tooManyAttempts($throttleKey, $this->maxLoginAttempts)) {
            $this->dispatch('lockoutEvent');
            $seconds = RateLimiter::availableIn($throttleKey);
            $errorMessage = 'Bạn đã nhập sai quá nhiều lần. Vui lòng thử lại sau ' . $seconds . ' giây.';
            throw ValidationException::withMessages([
                'otp' => $errorMessage,
            ]);
        }
    }


    public function throttleKey()
    {
        return Str::lower($this->otp) . '|' . request()->ip();
    }

    public function resend($type = NULL)
    {
        $error = \app\Helpers\Helper::throttle('verifyOTP', 1, 2, 'mi', 'Chúng tôi đã gửi mã OTP về mail của bạn. Vui lòng thử lại sau');
        if ($error) {
            $this->check = 0;
            throw ValidationException::withMessages([
                'noti' => $error,
            ]);
        } else {
            $otp = \App\Helpers\Helper::random('0123456789', '6');
            if ($type == "change") {
                $update = UsersModel::where('user_id', auth()->user()->user_id)->update([
                    'user_email_verification_code' => $otp,
                    'user_email' => $this->user_email,
                ]);
            } else {
                $update = UsersModel::where('user_id', auth()->user()->user_id)->update([
                    'user_email_verification_code' => $otp,
                ]);
            }

            if ($update) {
                if($type=="change"){
                    Mail::to($this->user_email)->send(new VeirfyMail(auth()->user()->user_fullname, auth()->user()->user_username, $otp));
                }else{
                    Mail::to(auth()->user()->user_email)->send(new VeirfyMail(auth()->user()->user_fullname, auth()->user()->user_username, $otp));
                }
                $this->check = 1;
            }
        }
    }
    public function toggleEmailField($type = NULL)
    {
        if ($type == 'show') {
            $this->check_mail = true;
        } else {
            $this->check_mail = false;
        }
    }
    public function change($type)
    {
        $this->toggleEmailField('show');
        if ($type == 'submit') {
            $this->validate([
                'user_email' => [
                    'required',
                    'email',
                    Rule::unique('users', 'user_email')->ignore(auth()->user()->user_id, 'user_id')
                ],
            ]);
            $this->toggleEmailField('show');
            $this->resend('change');
            $this->toggleEmailField('hide');
        }
    }
    public function save()
    {
        $this->validate();
        // Chặn đăng nhập sai quá nhiều lần
        $this->ensureIsNotRateLimited();
        if (auth()->check()) {
            $user = UsersModel::where('user_username', auth()->user()->user_username)->first();
            if ($user->user_email_verification_code == $this->otp) {
                UsersModel::where(['user_username' => auth()->user()->user_username, 'user_email_verification_code' => $user->user_email_verification_code])->update([
                    'user_email_verification_code' => NULL,
                    'user_email_verified' => (string) 1,
                ]);
                return $this->redirect(route('home'));
            } else {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'otp' => 'Mã OTP không chính xác.',
                ]);
            }
        } else {
            return redirect(route('home'));
        }
    }

}
