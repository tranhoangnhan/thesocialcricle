<?php

namespace App\Livewire\Clients\Home;

use App\Models\FriendsModel;
use Livewire\Component;

class ListContact extends Component
{
    public function render()
    {
        $currentUserId = auth()->user()->user_id;
        $friends = FriendsModel::where('status', strval(1))
            ->where(function ($query) use ($currentUserId) {
                $query->where('user_one_id', $currentUserId)
                    ->orWhere('user_two_id', $currentUserId);
            })
            ->inRandomOrder()
            ->limit(10)
            ->get();
        return view('livewire.clients.home.list-contact', compact('friends'));
    }
}
