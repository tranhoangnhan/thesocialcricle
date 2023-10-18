<?php

namespace App\Livewire\Clients\Friends;

use Livewire\Component;
use App\Models\FriendsModel;
class ShowAddFriends extends Component
{
    public $listFriends;
    public function showFriends()
    {
      //Lời mời nhận được
      $this->listFriends = FriendsModel::where('user_two_id', auth()->user()->user_id )->where('status','0')->join('users', 'users.user_id', '=', 'friends.user_one_id')->get();
      return $this->listFriends;
    }
    public function addFriends($id)
    {
      $friends = FriendsModel::where('user_two_id',auth()->user()->user_id )->where('user_one_id', $id)->first();
      $friends->status = '1';
      $friends->time_accept = date('Y-m-d H:i:s');
      $friends->save();
      $this->showFriends();
    }
    public function removeFriends($id)
    {
      FriendsModel::where('user_two_id', auth()->user()->user_id)->where('user_one_id', $id)->delete();
    }
    public function render()
    {
        return view('livewire.clients.friends.show-add-friends',[
          'listFriends' => $this->showFriends()
        ]);
    }
}
