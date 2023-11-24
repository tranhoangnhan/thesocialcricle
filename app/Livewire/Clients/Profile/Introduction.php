<?php

namespace App\Livewire\Clients\Profile;

use App\Models\IntroductionModel;
use App\Models\UsersModel;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithValidation;
use Illuminate\Validation\Rule;

class Introduction extends Component
{
    public $step = 1;
    public $info, $user;
    public $user_fullname, $user_birthday,
    $user_phone, $user_email, $user_job, $user_language, $user_marital, $user_bio, $id, $user_username;
    public $detail, $detail1,
    $selectedWard, $selectedWard1, $selectedDistrict,
    $selectedDistrict1, $selectedProvince, $selectedProvince1,$user_website,$user_university,$user_university_type
    ,$user_highschool,$user_middleschool,$user_primaryschool;
    public function mount()
    {
        $id = auth()->user()->user_id;
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
            }
            if($check){
                
                $this->info = $check;
                $this->user_marital = $check->marital;
                $this->user_job = $check->job;
                $this->user_language = $check->language;
                $this->user_website = $check->website;
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
        'user_website' => 'Trang web',
    ];
    protected $messages = [
        '*.required' => 'Vui lòng nhập :attribute.',
        '*.string' => ':attribute phải là chuỗi ký tự.',
        '*.min' => ':attribute phải có ít nhất :min ký tự.',
        '*.max' => ':attribute không được vượt quá :max ký tự.',
        '*.regex' => ':attribute chỉ được chứa các ký tự chữ cái và khoảng trắng.',
        'user_username.regex' => ':attribute chỉ được chứa chữ và số',
        '*.unique' => ':attribute đã có trong hệ thống.',
        '*.date_format' => ':attribute không đúng định dạng',
        'user_website.regex' => ':attribute phải là định dạng tsonit.com hoặc https://tsonit.com'
    ];

    public function save($type)
    {
        if ($type == 'address') {
            if (empty($this->selectedProvince) || empty($this->selectedDistrict) || empty($this->selectedWard) || empty($this->detail)) {
                $this->addError('errorHomeTown', 'Vui lòng chọn, nhập đầy đủ thông tin địa chỉ nơi sống.');
            }
            if (empty($this->selectedProvince1) || empty($this->selectedDistrict1) || empty($this->selectedWard1) || empty($this->detail1)) {
                $this->addError('errorLocation', 'Vui lòng chọn đầy đủ thông tin địa chỉ quê quán.');
            }
            if ($this->getErrorBag()->any()) {
                return;
            }
            $hometownAddressParts = [$this->selectedWard, $this->selectedDistrict, $this->selectedProvince];
            $hometownAddress = $this->detail ? $this->detail . ', ' . implode(', ', $hometownAddressParts) : implode(', ', $hometownAddressParts);
            $livingAddressParts = [$this->selectedWard1, $this->selectedDistrict1, $this->selectedProvince1];
            $livingAddress = $this->detail1 ? $this->detail1 . ', ' . implode(', ', $livingAddressParts) : implode(', ', $livingAddressParts);
            $this->info->location = $livingAddress;
            $this->info->hometown = $hometownAddress;
            $log = $this->info->save();
            if($log){
                $this->goToStep(2);
            }
        }
        if ($type == 'infoBonus') {
            $this->validate([
                'user_job' => ['max:100', 'string', 'regex:/^[\pL\d\s]+$/u', 'nullable'],
                'user_language' => ['max:50', 'string', 'regex:/^[\pL\d\s,]+$/u', 'nullable'],
                'user_marital' => ['max:50', 'string', 'regex:/^[\pL\d\s,]+$/u', 'nullable'],
                'user_website' => ['max:100', 'string', 'regex:/^[\pL\d\s.,:\/\-_]+(\.[\pL]{2,})+$/u', 'nullable'],
            ]);

            $this->info->marital = $this->user_marital;
            $this->info->job = $this->user_job;
            $this->info->language = $this->user_language;
            if(empty($this->user_language)){
                $this->info->language = NULL;
            }
            $this->info->website = $this->user_website;

            $log = $this->info->save();
            if ($log) {
                $this->goToStep(3);
            }
        }

        if($type=="school"){
            $this->validate([
                'user_university_type' => 'in:1,2,3,4|nullable',
                'user_highschool' => ['max:100', 'string', 'regex:/^[\pL\d\s]+$/u', 'nullable'],
                'user_middleschool' => ['max:100', 'string', 'regex:/^[\pL\d\s,]+$/u', 'nullable'],
                'user_primaryschool' => ['max:100', 'string', 'regex:/^[\pL\d\s,]+$/u', 'nullable'],
            ]);
            if($this->user_university_type == 1){
                $user_university = 'Đại học '.$this->user_university;
            }else if($this->user_university_type ==2){
                $user_university = 'Quốc tế '.$this->user_university;
            }else if($this->user_university_type ==3){
                $user_university = 'Cao đẳng '.$this->user_university;
            }else if($this->user_university_type ==4){
                $user_university = 'Cao đẳng nghề '.$this->user_university;
            }
            $this->info->university = $user_university;
            $this->info->high_school = 'THPT '.$this->user_highschool;
            $this->info->middle_school = 'THCS '.$this->user_middleschool;
            $this->info->primary_school = 'Tiểu học '.$this->user_primaryschool;
            $log = $this->info->save();
            if($log){
                redirect()->route('home');
            }
        }

    }
    public function render()
    {
        return view('livewire.clients.profile.introduction');
    }
    public function goToStep($step)
    {
        $this->step = $step;
    }

}
