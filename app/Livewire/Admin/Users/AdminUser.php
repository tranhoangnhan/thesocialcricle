<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Models\User_Block;
use App\Models\User_Intro;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;

class AdminUser extends Component
{
    public $user_name;
    public $user_fullname;
    public $user_email;
    public $user_password;
    public $user_phone;
    public $user_date;
    public $user_gender;
    public $user_active;
    public $user_workplace;
    public $user_positon;
    public $user_role;

    public $modalOpen = false;
    protected $listeners = ['openModal'];
    public $dataUpdate = '';

    public function createUser(){
        $createUser = UsersModel::create([
            'user_username' => $this->user_name,
            'user_fullname' => $this->user_fullname,
            'user_email' => $this->user_email,
            'user_password' => Hash::make($this->user_password),
            'user_phone' => $this->user_phone,
            'user_birthday' => $this->user_date,
            'user_gender' => $this->user_gender,
            'user_email_verified' => $this->user_active,
            'user_role' => $this->user_role,
            'user_token' => encrypt(Str::random(16))
        ]);
        $createUser->save();
    }

    public function getUpdateId($id){

        $this->dataUpdate = User::where('user_id', $id)->first();
        $this->modalOpen = true;
    }
    public function closeModal(){
        $this->modalOpen = false;
        $this->dataUpdate = '';
    }

    public function updateUser(Request $request){
        $user = User::where('user_id', $request->id)->update([
            'user_username' => $request->username,
            'user_fullname' => $request->fullname,
            'user_email' => $request->email,
            'user_password' => Hash::make($request->password),
            'user_phone' => $request->phone,
            'user_birthday' => $request->birthdate,
            'user_gender' => $request->genre,
            'user_email_verified' => $request->active,
            'user_role' => $request->role,
        ]);
        return back();
    }

    public function getBlockId($id){
        $this->getUserId = $id;
    }

    public function confirmBlockId(){
        $blockUser = User_Block::create([
            'user_id' => Auth::user()->user_id,
            'block_id' => $this->getUserId
        ]);
        $updateBlock = UsersModel::where('user_id', $this->getUserId )
            ->update([
                'user_banned' => '1'
            ]);
    }

    public function getUnblockId($id){
        $this->getUserId = $id;
    }

    public function confirmUnlockId(){
        $unblockUser = User_Block::where('block_id', $this->getUserId)->delete();
        $updateBlock = UsersModel::where('user_id', $this->getUserId )
            ->update([
                'user_banned' => '0'
            ]);
    }

    public function getDeleteId($id){
        $this->getUserId = $id;
    }

    public function confirmDeleteId(){
        $delete = User::where('user_id', $this->getUserId);
        $delete->delete();
    }


    public function render()
    {
        return view('livewire.admin.users.admin-user',[
            'users' => User::orderBy('user_id', 'DESC')->get(),
        ]);
    }
}
