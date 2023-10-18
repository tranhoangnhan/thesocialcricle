<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        $blacklist = ['son', 'admin'];

        return [
            'name' => 'required|string|min:6|max:50|regex:/^[a-zA-Z\sÁÀẢÃẠĂẮẰẲẴẶÂẤẦẨẪẬÉÈẺẼẸÊẾỀỂỄỆÍÌỈĨỊÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢÚÙỦŨỤƯỨỪỬỮỰáàảãạăắằẳẵặâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữự ]+$/u',
            'fullname' => [
                'required',
                'string',
                'min:3',
                'regex:/^[a-zA-Z0-9_-]+$/',
                'not_in:' . implode(',', $blacklist),
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

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập :attribute.',
            'name.string' => ':attribute phải là chuỗi ký tự.',
            'name.min' => ':attribute phải có ít nhất :min ký tự.',
            'name.max' => ':attribute không được vượt quá :max ký tự.',
            'name.regex' => ':attribute chỉ được chứa các ký tự chữ cái và khoảng trắng.',

            'fullname.required' => 'Vui lòng nhập :attribute.',
            'fullname.string' => ':attribute phải là chuỗi ký tự.',
            'fullname.min' => ':attribute phải có ít nhất :min ký tự.',
            'fullname.not_in' => ':attribute không được phép là "admin".',
            'fullname.regex' => ':attribute chỉ được chứa các ký tự chữ cái không dấu, chữ số.',


            'phone.required' => 'Vui lòng nhập :attribute.',
            'phone.numeric' => ':attribute chỉ được chứa các ký tự số.',
            'phone.digits_between' => ':attribute phải có từ :min đến :max chữ số.',

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
    }

    public function attributes()
    {
        return [
            'name' => 'Họ và tên',
            'fullname' => 'Tên người dùng',
            'phone' => 'Số điện thoại',
            'email' => 'Địa chỉ email',
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Nhập lại mật khẩu',
            'day' => 'Ngày sinh',
            'month' => 'Tháng sinh',
            'year' => 'Năm sinh',
            'gender' => 'Giới tính',
        ];
    }
}
