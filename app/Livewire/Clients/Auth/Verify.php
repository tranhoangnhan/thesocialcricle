<?php

namespace App\Livewire\Clients\Auth;

use App\Models\UsersModel;
use Livewire\Component;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class Verify extends Component
{
    public $otp;
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
    ];

    protected $messages = [
        'otp.required' => 'Vui lòng nhập :attribute.',
        'otp.numeric' => 'Vui lòng nhập :attribute là số.',
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

    public function check()
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
                return $this->redirect(route('home'), navigate: true);
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
