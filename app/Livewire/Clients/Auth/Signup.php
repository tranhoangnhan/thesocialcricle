<?php

namespace App\Livewire\Clients\Auth;

use App\Mail\WelcomeMail;
use App\Models\UsersModel;
use Dotenv\Exception\ValidationException;
use Livewire\Component;
use Mail;

class Signup extends Component
{
    public $username, $fullname, $email, $password, $gender = 0, $phone, $day, $month, $year, $password_confirmation;
    public $isLoading = false;
    public function updated($field)
    {
        $this->validateOnly($field);
        if (isset($this->password) && isset($this->password_confirmation) && $this->password == $this->password_confirmation) {
            $this->resetValidation(['password', 'password_confirmation']);
        }
    }
    protected function rules()
    {
        $blacklist = ['lol', 'son', 'admin'];
        return [
            'fullname' => 'required|string|min:6|max:50|regex:/^[a-zA-Z\sÁÀẢÃẠĂẮẰẲẴẶÂẤẦẨẪẬÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰáàảãạăắằẳẵặâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữự ]+$/u',
            'username' => [
                'required',
                'string',
                'min:3',
                'max:30',
                'regex:/^[a-zA-Z0-9_-]+$/',
                'not_in:' . implode(',', $blacklist),
                'unique:users,user_username',
            ],
            'phone' => 'required|numeric|digits_between:9,11|unique:users,user_phone',
            'email' => 'required|email|unique:users,user_email',
            'password' => 'required|string|min:5|same:password_confirmation',
            'password_confirmation' => 'required|string|min:5|same:password',
            'gender' => 'required|numeric|in:0,1,2',
            'day' => 'required|numeric|min:1|max:31',
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'required|numeric|min:1900|max:' . date('Y'),
        ];
    }
    protected $validationAttributes = [
        'username' => 'Tên người dùng',
        'fullname' => 'Họ và tên',
        'phone' => 'Số điện thoại',
        'email' => 'Địa chỉ email',
        'password' => 'Mật khẩu',
        'password_confirmation' => 'Nhập lại mật khẩu',
        'day' => 'Ngày sinh',
        'month' => 'Tháng sinh',
        'year' => 'Năm sinh',
        'gender' => 'Giới tính',
    ];

    protected $messages = [
        'fullname.required' => 'Vui lòng nhập :attribute.',
        'fullname.string' => ':attribute phải là chuỗi ký tự.',
        'fullname.min' => ':attribute phải có ít nhất :min ký tự.',
        'fullname.max' => ':attribute không được vượt quá :max ký tự.',
        'fullname.regex' => ':attribute chỉ được chứa các ký tự chữ cái và khoảng trắng.',

        'username.required' => 'Vui lòng nhập :attribute.',
        'username.string' => ':attribute phải là chuỗi ký tự.',
        'username.min' => ':attribute phải có ít nhất :min ký tự.',
        'username.not_in' => ':attribute không được phép là "admin".',
        'username.regex' => ':attribute chỉ được chứa các ký tự chữ cái không dấu, chữ số.',
        'username.unique' => ':attribute đã được sử dụng.',

        'phone.required' => 'Vui lòng nhập :attribute.',
        'phone.numeric' => ':attribute chỉ được chứa các ký tự số.',
        'phone.digits_between' => ':attribute phải có từ :min đến :max chữ số.',
        'phone.unique' => ':attribute đã được sử dụng.',

        'email.required' => 'Vui lòng nhập :attribute.',
        'email.email' => ':attribute không hợp lệ.',
        'email.unique' => ':attribute đã được sử dụng.',

        'password.required' => 'Vui lòng nhập :attribute.',
        'password.string' => ':attribute phải là chuỗi ký tự.',
        'password.min' => ':attribute phải có ít nhất :min ký tự.',
        'password.same' => 'Vui lòng nhập mật khẩu giống nhau.',


        'password_confirmation.required' => 'Vui lòng nhập :attribute.',
        'password_confirmation.string' => ':attribute phải là chuỗi ký tự.',
        'password_confirmation.min' => ':attribute phải có ít nhất :min ký tự.',
        'password_confirmation.confirmed' => 'Vui lòng nhập mật khẩu giống nhau.',
        'password_confirmation.same' => 'Vui lòng nhập mật khẩu giống nhau.',

        'gender.required' => 'Vui lòng chọn :attribute.',
        'gender.numeric' => ':attribute phải là một số.',
        'gender.in' => 'Giới tính không có trong hệ thống',

        'day.required' => 'Vui lòng chọn :attribute.',
        'day.numeric' => ':attribute phải là một số.',
        'day.min' => ':attribute phải từ :min đến :max.',
        'day.max' => ':attribute phải từ :min đến :max.',

        'month.required' => 'Vui lòng chọn :attribute.',
        'month.numeric' => ':attribute phải là một số.',
        'month.min' => ':attribute phải từ :min đến :max.',
        'month.max' => ':attribute phải từ :min đến :max.',

        'year.required' => 'Vui lòng chọn :attribute.',
        'year.numeric' => ':attribute phải là một số.',
        'year.min' => ':attribute phải từ :min đến :max.',
        'year.max' => ':attribute phải từ :min đến :max.',
    ];

    public function render()
    {
        return view('livewire.clients.auth.signup');
    }
    private function getDaysInMonth()
    {
        $month = (int) $this->month;
        $year = (int) $this->year;

        if ($month === 2 && $this->isLeapYear($year)) {
            return 29;
        }
        $daysInMonthMap = [
            1 => 31,
            2 => 28,
            3 => 31,
            4 => 30,
            5 => 31,
            6 => 30,
            7 => 31,
            8 => 31,
            9 => 30,
            10 => 31,
            11 => 30,
            12 => 31,
        ];
        return $daysInMonthMap[$month];
    }

    private function isLeapYear($year)
    {
        return ($year % 4 === 0 && $year % 100 !== 0) || ($year % 400 === 0);
    }

    public function save()
    {
        // $this->dispatch('showLoadingOverlay');
        $validatedData = $this->validate();
        if ($validatedData) {
            $this->isLoading = true;
            $userData = UsersModel::createUser(array_merge($validatedData, ['ip' => request()->ip()]));
            if ($userData) {
                Mail::to($userData['email'])->send(new WelcomeMail($userData['name'], $userData['username'], $userData['otp']));
                return redirect(route('home'));
            } else {
                dd('e');
            }
        }
    }

}
