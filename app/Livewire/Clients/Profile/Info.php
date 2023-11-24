<?php

namespace App\Livewire\Clients\Profile;

use App\Models\IntroductionModel;
use App\Models\UsersModel;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithValidation;
use Illuminate\Validation\Rule;

class Info extends Component
{

    public $selectTabFriends = "overview", $info, $user;
    public $user_fullname, $user_birthday,
    $user_phone, $user_email, $user_job, $user_language, $user_marital, $user_bio, $id, $user_username;
    public $detail, $detail1,
    $selectedWard, $selectedWard1, $selectedDistrict,
    $selectedDistrict1, $selectedProvince, $selectedProvince1
    , $user_university, $user_university_type
    , $user_highschool, $user_middleschool, $user_primaryschool, $user_website;
    public function mount($id)
    {
        $this->user = UsersModel::where('user_id', $id)->first();
        if (isset($this->user)) {
            $this->id = $this->user->user_id;
            $this->user_fullname = $this->user->user_fullname;
            $this->user_username = $this->user->user_username;
            $this->user_bio = $this->user->user_bio;
            $this->user_phone = $this->user->user_phone;
            $this->user_email = $this->user->user_email;
            if (isset($this->user->user_birthday)) {
                $formattedBirthday = \Carbon\Carbon::parse($this->user->user_birthday)->format('d-m-Y');
                $this->user_birthday = $formattedBirthday;
            }

            $check = IntroductionModel::where('user_id', $id)->first();

            if (empty($check)) {
                if (auth()->check() && auth()->user()->user_id == $this->id) {
                    IntroductionModel::create([
                        'user_id' => auth()->user()->user_id,
                    ]);
                }
            } else {
                $this->info = $check;
                $this->user_marital = $check->marital;
                $this->user_job = $check->job;
                $this->user_language = $check->language;
                $this->user_website = $check->website;
                if ($check->university) {
                    $type = $this->stripTypeSchoolPrefix($check->university);
                    if ($type == 'Đại học') {
                        $this->user_university_type = 1;
                    } else if ($type == 'Quốc tế') {
                        $this->user_university_type = 2;
                    } else if ($type == 'Cao đẳng') {
                        $this->user_university_type = 3;
                    } else if ($type == 'Cao đẳng nghề') {
                        $this->user_university_type = 4;
                    }
                }
                $this->user_university = $this->stripSchoolPrefix($check->university);
                $this->user_highschool = $this->stripSchoolPrefix($check->high_school);

                $this->user_middleschool = $this->stripSchoolPrefix($check->middle_school);

                $this->user_primaryschool = $this->stripSchoolPrefix($check->primary_school);
                //quê quán
                if (isset($check->location)) {
                    $locationParts = explode(',', $check->location);
                    $locationParts = array_map('trim', $locationParts);
                    $locationParts = array_filter($locationParts, function ($value) {
                        return !empty($value);
                    });
                    $partCount = count($locationParts); //5
                    if ($partCount) {
                        if ($partCount <= 4) {
                            $this->detail1 = $locationParts[$partCount - 4];
                        }
                        if ($partCount >= 5) {
                            $this->detail1 = implode(', ', array_slice($locationParts, 0, $partCount - 3));
                        }
                        $this->selectedWard1 = $locationParts[$partCount - 3]; //2
                        $this->selectedDistrict1 = $locationParts[$partCount - 2]; //3
                        $this->selectedProvince1 = $locationParts[$partCount - 1]; //4
                    }

                }

                //sống tại
                if (isset($check->hometown)) {
                    $hometownParts = explode(',', $check->hometown);
                    $hometownParts = array_map('trim', $hometownParts); // Loại bỏ các khoảng trắng không cần thiết
                    // Lọc ra các giá trị không rỗng
                    $hometownParts = array_filter($hometownParts, function ($value) {
                        return !empty($value);
                    });

                    $partCount = count($hometownParts);

                    if ($partCount) {
                        if ($partCount <= 4) {
                            $this->detail = $hometownParts[$partCount - 4];
                        }
                        if ($partCount >= 5) {
                            $this->detail = implode(', ', array_slice($hometownParts, 0, $partCount - 3));
                        }
                        $this->selectedWard = $hometownParts[$partCount - 3];
                        $this->selectedDistrict = $hometownParts[$partCount - 2];
                        $this->selectedProvince = $hometownParts[$partCount - 1];
                    }
                }


            }
        }
    }
    public function stripSchoolPrefix($schoolName)
    {

        $prefixes = ['Đại học', 'Quốc tế','Cao đẳng nghề', 'Cao đẳng' , 'THPT', 'THCS', 'Tiểu học'];

        $strippedName = str_replace($prefixes, '', $schoolName);
        $strippedName = trim($strippedName);
        return $strippedName;
    }
    public function stripTypeSchoolPrefix($schoolName)
    {
        $prefixes = ['Đại học', 'Quốc tế', 'Cao đẳng nghề', 'Cao đẳng', 'THPT', 'THCS', 'Tiểu học'];
        foreach ($prefixes as $prefix) {
            if (strpos($schoolName, $prefix . ' ') === 0) {
                return $prefix;
            }
        }
        return $schoolName;
    }



    public function rules()
    {
        return [
            'user_fullname' => [
                'required',
                'string',
                'min:3',
                'regex:/^[\pL\s]+$/u',
            ],
            'user_username' => [
                'required',
                'string',
                'min:3',
                'max:30',
                'regex:/^[a-zA-Z0-9_-]+$/',
                Rule::unique('users', 'user_username')->ignore($this->id, 'user_id')
            ],
            'user_phone' => [
                'required',
                'numeric',
                'digits_between:9,11',
                Rule::unique('users', 'user_phone')->ignore($this->id, 'user_id')
            ],
            'user_email' => [
                'required',
                'email',
                Rule::unique('users', 'user_email')->ignore($this->id, 'user_id')
            ],
            'detail' => [
                'max:30',
                'string',
                'regex:/^[\pL\d\s]+$/u',
                'nullable'
            ],

            'detail1' => [
                'max:30',
                'string',
                'regex:/^[\pL\d\s]+$/u',
                'nullable'
            ],
            'user_birthday' => [
                'required',
                'date_format:d-m-Y',
            ],
            'user_bio' => [
                'max:100',
                'string',
                'regex:/^[\pL\d\s]+$/u',
                'nullable'
            ],
            'user_job' => [
                'max:100',
                'string',
                'regex:/^[\pL\d\s]+$/u',
                'nullable'
            ],
            'user_language' => [
                'max:50',
                'string',
                'regex:/^[\pL\d\s,]+$/u',
                'nullable'
            ],
            'user_university_type' => 'in:1,2,3,4|nullable',
            'user_highschool' => ['max:100', 'string', 'regex:/^[\pL\d\s]+$/u', 'nullable'],
            'user_middleschool' => ['max:100', 'string', 'regex:/^[\pL\d\s,]+$/u', 'nullable'],
            'user_primaryschool' => ['max:100', 'string', 'regex:/^[\pL\d\s,]+$/u', 'nullable'],

        ];
    }
    protected $validationAttributes = [
        'user_username' => 'Tên người dùng',
        'user_fullname' => 'Họ và tên',
        'user_phone' => 'Số điện thoại',
        'user_email' => 'Địa chỉ email',
        'user_gender' => 'Giới tính',
        'detail' => 'Địa chỉ chi tiết',
        'detail1' => 'Địa chỉ chi tiết',
        'user_birthday' => 'Ngày sinh',
        'user_marital' => 'Trạng thái',
        'user_bio' => 'Giới thiệu',
        'user_job' => 'Việc làm',
        'user_language' => 'Ngôn ngữ',
    ];
    protected $messages = [
        '*.required' => 'Vui lòng nhập :attribute.',
        '*.string' => ':attribute phải là chuỗi ký tự.',
        '*.min' => ':attribute phải có ít nhất :min ký tự.',
        '*.max' => ':attribute không được vượt quá :max ký tự.',
        '*.regex' => ':attribute chỉ được chứa các ký tự chữ cái và khoảng trắng.',
        'user_username.regex' => ':attribute chỉ được chứa chữ và số',
        '*.email' => ':attribute phải đúng định dạng email',
        '*.unique' => ':attribute đã có trong hệ thống.',
        '*.date_format' => ':attribute không đúng định dạng',
    ];


    #[On('changeInfoProfile')]
    public function save()
    {
        $this->validate();
        $hometownAddressParts = [$this->selectedWard, $this->selectedDistrict, $this->selectedProvince];
        $hometownAddress = $this->detail ? $this->detail . ', ' . implode(', ', $hometownAddressParts) : implode(', ', $hometownAddressParts);
        $livingAddressParts = [$this->selectedWard1, $this->selectedDistrict1, $this->selectedProvince1];
        $livingAddress = $this->detail1 ? $this->detail1 . ', ' . implode(', ', $livingAddressParts) : implode(', ', $livingAddressParts);
        $currentUser = UsersModel::where('user_id', auth()->user()->user_id)->first();
        $currentIntroduction = IntroductionModel::where('user_id', auth()->user()->user_id)->first();

        if ($currentUser || $currentIntroduction) {
            if (
                $livingAddress != $currentIntroduction->location
                || $hometownAddress != $currentIntroduction->hometown
                || $this->user_marital != $currentIntroduction->marital

                || $this->user_job != $currentIntroduction->user_job
                || $this->user_language != $currentIntroduction->user_language
            ) {
                $currentIntroduction->location = $livingAddress;
                $currentIntroduction->hometown = $hometownAddress;
                $currentIntroduction->marital = $this->user_marital;
                $currentIntroduction->job = $this->user_job;
                $currentIntroduction->language = $this->user_language;
                $currentIntroduction->save();
            }
            if (
                $this->user_highschool != $currentIntroduction->high_school
                || $this->user_university != $currentIntroduction->university
                || $this->user_middleschool != $currentIntroduction->middle_school
                || $this->user_primaryschool != $currentIntroduction->primary_school
            ) {
                if ($currentIntroduction->university != $this->user_university) {
                    if ($this->user_university_type == 1) {
                        $user_university = 'Đại học ' . $this->user_university;
                    } else if ($this->user_university_type == 2) {
                        $user_university = 'Quốc tế ' . $this->user_university;
                    } else if ($this->user_university_type == 3) {
                        $user_university = 'Cao đẳng ' . $this->user_university;
                    } else if ($this->user_university_type == 4) {
                        $user_university = 'Cao đẳng nghề ' . $this->user_university;
                    }
                    $currentIntroduction->university = $user_university;
                }
                $currentIntroduction->high_school = 'THPT ' . $this->user_highschool;
                $currentIntroduction->middle_school = 'THCS ' . $this->user_middleschool;
                $currentIntroduction->primary_school = 'Tiểu học ' . $this->user_primaryschool;
                $currentIntroduction->save();
            }
            if (
                $this->user_bio != $currentUser->user_bio
                || $this->user_fullname != $currentUser->user_fullname
                || $this->user_username != $currentUser->user_username
                || $this->user_email != $currentUser->user_email
                || $this->user_phone != $currentUser->user_phone
                || $this->user_birthday != $currentUser->user_birthday
            ) {
                $currentUser->user_bio = $this->user_bio;
                $currentUser->user_fullname = $this->user_fullname;
                $currentUser->user_username = $this->user_username;
                if($this->user_email != $currentUser->user_email){
                    $currentUser->user_email = $this->user_email;
                    $currentUser->user_email_verified = "0";
                    $currentUser->user_email_verification_code = NULL;
                }

                $currentUser->user_phone = $this->user_phone;
                $currentUser->user_birthday = \Carbon\Carbon::parse($this->user_birthday)->format('Y-m-d');
                $currentUser->save();
            }
            $this->dispatch('reloadPage');
        }
    }


    public function selectTab($data)
    {
        $this->selectTabFriends = $data;
    }
    public function render()
    {
        return view('livewire.clients.profile.info');
    }
}
