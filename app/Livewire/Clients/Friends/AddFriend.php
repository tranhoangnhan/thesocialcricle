<?php

namespace App\Livewire\Clients\Friends;

use Livewire\Component;
use App\Models\FriendsModel;
use App\Models\UsersModel;


class AddFriend extends Component
{
  
    public $friendData;
    public $status;
    public function addFriend($user_id) {
        $check = FriendsModel::where('user_one_id', auth()->user()->user_id)
        ->where('user_two_id', $user_id)
        ->first();
        if($check){
            $check->delete();

        }else{
       
            FriendsModel::create([
                'user_one_id' => auth()->user()->user_id,
                'user_two_id' => $user_id,
                'status' => '0',
            ]);
        }
    

    }
    public function areFriends($user_id)
    {
        $friendship = FriendsModel::where(function ($query) use ($user_id) {
            $query->where('user_one_id', auth()->user()->user_id)
                ->where('user_two_id', $user_id);
        })->orWhere(function ($query) use ($user_id) {
            $query->where('user_one_id', $user_id)
                ->where('user_two_id', auth()->user()->user_id);
        })->first();
       
        return $friendship;
    }
    
   
    public function render()
    {
        
        return view('livewire.clients.friends.add-friend',[
            'Users' => UsersModel::all(),
        ]);
    }
}
