<?php

namespace App\Livewire\Clients\Home;

use App\Models\ConversationsModel;
use App\Models\FriendsModel;
use Livewire\Component;

class ListFriend extends Component
{
    public function render()
    {
        $currentUserId = auth()->user()->user_id;

        $friends = FriendsModel::where('status', strval(1))
            ->where(function ($query) use ($currentUserId) {
                $query->where('user_one_id', $currentUserId)
                    ->orWhere('user_two_id', $currentUserId);
            })
            ->where(function ($query) use ($currentUserId) {
                $query->where('user_one_id', '!=', $currentUserId)
                    ->orWhere('user_two_id', '!=', $currentUserId);
            })
            ->get();

        return view('livewire.clients.home.list-friend', compact('friends'));
    }
}
