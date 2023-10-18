<?php

namespace App\Livewire\Clients\Auth;

use Hash;
use Livewire\Component;
use App\Models\OTP_Manager;
use App\Models\UsersModel;
use Exception;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Url;

class ResetPassword extends Component
{
    public $otp, $data, $password, $password_confirmation;
    #[Url]
    public $log = '';
    public $typeOTP, $success = false;
    public function updated($field)
    {
        if (isset($this->password) && isset($this->password_confirmation) && $this->password == $this->password_confirmation) {
            $this->resetValidation(['password', 'password_confirmation']);
        }
    }
    protected $validationAttributes = [
        'otp' => 'mã otp',
        'password' => 'Mật khẩu',
        'password_confirmation' => 'Nhập lại mật khẩu',
    ];

    protected $messages = [
        'otp.required' => 'Vui lòng nhập :attribute.',
        'otp.numeric' => 'Vui lòng nhập :attribute là số.',

        'password.required' => 'Vui lòng nhập :attribute.',
        'password.string' => ':attribute phải là chuỗi ký tự.',
        'password.min' => ':attribute phải có ít nhất :min ký tự.',
        'password.same' => 'Vui lòng nhập mật khẩu giống nhau.',


        'password_confirmation.required' => 'Vui lòng nhập :attribute.',
        'password_confirmation.string' => ':attribute phải là chuỗi ký tự.',
        'password_confirmation.min' => ':attribute phải có ít nhất :min ký tự.',
        'password_confirmation.confirmed' => 'Vui lòng nhập mật khẩu giống nhau.',
        'password_confirmation.same' => 'Vui lòng nhập mật khẩu giống nhau.',

    ];
    public function mount($data)
    {
        $this->data = $data;
    }
    public function render()
    {
        if ($this->log) {
            $this->typeOTP = true;
        } else {
            $this->typeOTP = false;
        }
        return view('livewire.clients.auth.reset_password');
    }
    public function save()
    {
        if ($this->log) {
            $rules = [
                'otp' => 'required|numeric',
            ];
            $validatedData = $this->validate($rules);
            $email = $this->data;
            $otp = OTP_Manager::where(['email' => $email, 'type' => 'forgotpassword'])->first();
            if ($this->otp !== $otp->token) {
                $this->addError('otp', 'Mã OTP không chính xác');
                $error = \app\Helpers\Helper::throttle('reset_password', 5, 5, 'mi');
                if ($error) {
                    throw ValidationException::withMessages([
                        'otp' => $error,
                    ]);
                }
            } else {
                if ($validatedData) {
                    $this->success = true;
                    $rules2 = [
                        'password' => 'required|string|min:5|same:password_confirmation',
                        'password_confirmation' => 'required|string|min:5|same:password',
                    ];
                    $this->validate($rules2);
                    if ($this->password == $this->password_confirmation) {
                        UsersModel::where('user_email', $email)->update([
                            'user_password' => Hash::make($this->password),
                        ]);
                        $otp->delete();
                        return $this->redirect(route('home'), navigate: true);
                    }
                }
            }

        } else {
            list($email, $otp, $time) = explode('|', $this->data);
            $user = UsersModel::where('user_email', $email)->first();
            if (!$user) {
                return $this->redirect(route('home'), navigate: true);
            }
            $passwordReset = OTP_Manager::where('email', $email)->first();
            if (!$passwordReset || $passwordReset->token !== $otp || Carbon::now() > $time) {
                return $this->redirect(route('home'), navigate: true);
            }
            $rules2 = [
                'password' => 'required|string|min:5|same:password_confirmation',
                'password_confirmation' => 'required|string|min:5|same:password',
            ];
            $this->validate($rules2);
            if ($this->password == $this->password_confirmation) {
                UsersModel::where('user_email', $email)->update([
                    'user_password' => Hash::make($this->password),
                ]);
                $passwordReset->delete();
                return $this->redirect(route('home'), navigate: true);
            }
        }
    }
}
