<?php

namespace App\Livewire\Clients\Auth;

use App\Models\NotificationModel;
use App\Models\UsersLogModel;
use App\Models\UsersModel;
use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Events\Clients\Notification\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public $info, $password;

    public function render()
    {
        return view('livewire.clients.auth.login');
    }
    protected function rules()
    {
        $emailValidationRule = $this->info && strpos($this->info, '@') !== false ? 'email' : 'regex:/^[a-zA-Z0-9_-]+$/';

        $rules = [
            'info' => [
                'required',
                'string',
                $emailValidationRule,
            ],
            'password' => 'required|string|min:5',
        ];
        $validInfoValues = [];
        if ($this->info && strpos($this->info, '@') !== false) {
            $validInfoValues = UsersModel::pluck('user_email')->toArray();
        } else {
            $validInfoValues = UsersModel::pluck('user_username')->toArray();
        }
        $rules['info'][] = 'in:' . implode(',', $validInfoValues);
        return $rules;
    }
    protected $validationAttributes = [
        'info' => 'email hoặc tên người dùng',
        'password' => 'mật khẩu',
    ];

    protected $messages = [
        'info.required' => 'Vui lòng nhập :attribute.',
        'info.string' => 'Vui lòng nhập :attribute là 1 chuỗi.',
        'info.in' => 'Email hoặc tên người dùng bạn nhập không kết nối với tài khoản nào.',
        'info.regex' => 'Vui lòng nhập đúng :attribute',
        'password.required' => 'Vui lòng nhập :attribute.',
        'password.string' => 'Vui lòng nhập :attribute phải là chuỗi',
        'password.min' => 'Vui lòng nhập :attribute có ít nhất :min ký tự.',
    ];
    protected function setLog($user)
    {
        UsersLogModel::create([
            'user_id' => $user->user_id,
            'ip' => vIpInfo()->ip,
            'country' => vIpInfo()->country,
            'country_code' => vIpInfo()->country_code,
            'city' =>  vIpInfo()->city,
            'timezone' => vIpInfo()->timezone,
            'location' => vIpInfo()->location,
            'latitude' => vIpInfo()->latitude,
            'longitude' => vIpInfo()->longitude,
            'browser' => vBrowser(),
            'os' => vPlatform(),
            'proxy' => vIpInfo()->proxy,
        ]);

    }

    public function save()
    {
        $this->validate();
        $error = \app\Helpers\Helper::throttle('login', 5, 5, 'mi');
        if ($error) {
            throw ValidationException::withMessages([
                'info' => $error,
            ]);
        }
        $field = filter_var($this->info, FILTER_VALIDATE_EMAIL) ? 'user_email' : 'user_username';
        $user = UsersModel::where($field, $this->info)->first();
        if (!Auth::attempt([$field => $this->info, 'password' => $this->password])) {
            $this->addError('info', 'Tài khoản mật khẩu không chính xác.');
        } else {
            UsersModel::where('user_id', Auth::user()->user_id)->update([
                'user_ip_address' => request()->ip(),
                'user_last_seen' => now(),
            ]);
            Auth::loginUsingId($user->user_id);
            $this->setLog($user);
            NotificationModel::create([
                'from_user_id' => auth()->user()->user_id,
                'to_user_id' => auth()->user()->user_id,
                'action' => 'login_security',
                'node_type' => 'user',
                'node_url' => route('setting'),
                'message' => 'Phát hiện có người đăng nhập vào tài khoản của bạn!',
                'time' => date('Y-m-d H:i:s'),
            ]);
            event(new User('Phát hiện có người đăng nhập vào tài khoản của bạn!', auth()->user(), auth()->user()->user_id));

            return $this->redirect(route('home'));
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect(route('home'));
    }
}
