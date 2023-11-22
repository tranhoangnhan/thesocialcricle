<?php

namespace App\Livewire\Clients\Friends;

use App\Events\Clients\Notification\User;
use Livewire\Component;
use App\Models\FriendsModel;
use App\Models\NotificationModel;

class ShowAddFriends extends Component
{
    public $listFriends;
    public function showFriends()
    {
      //Lời mời nhận được
      $this->listFriends = FriendsModel::where('user_two_id', auth()->user()->user_id)
      ->where('status', '0')
      ->join('users', 'users.user_id', '=', 'friends.user_one_id')
      ->select('friends.*', 'friends.created_at as timeAddFriend','users.user_fullname as nameUserOne')
      ->get();
        return $this->listFriends;
    }
    public function addFriends($id)
    {
      $friends = FriendsModel::where('user_two_id',auth()->user()->user_id )->where('user_one_id', $id)->first();
      $friends->status = '1';
      $friends->time_accept = date('Y-m-d H:i:s');
      $friends->save();
      if (auth()->user()->user_id != $id) {
        NotificationModel::create([
            'from_user_id' => auth()->user()->user_id,
            'to_user_id' => $id,
            'action' => 'add_friends',
            'node_type' => 'user',
            'node_url' => `/profile/` . auth()->user()->user_id,
            'message' => auth()->user()->user_fullname . ' đã chấp nhận lời mời kết bạn của bạn',
            'time' => date('Y-m-d H:i:s'),
        ]);
        event(new User(auth()->user()->user_fullname . ' đã chấp nhận lời mời kết bạn của bạn', auth()->user(), $id));
    }
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
