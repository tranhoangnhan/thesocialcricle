<?php

namespace App\Livewire\Clients;

use App\Models\FriendsModel;
use Livewire\Component;

class HomeController extends Component
{
    public function render()
    {
        if (auth()->check()) {
            $friendsList = FriendsModel::join('users', function ($join) {
                $join->on('friends.user_one_id', '=', 'users.user_id')
                     ->orOn('friends.user_two_id', '=', 'users.user_id');
            })
            ->select('users.user_fullname as name', 'friends.*')
            ->where(function ($query) {
                $query->where('user_one_id', auth()->user()->user_id)
                      ->orWhere('user_two_id', auth()->user()->user_id);
            })
            ->where('status', '1')
            ->where('users.user_id', '!=', auth()->user()->user_id)
            ->get();
            return view('clients.home.index',['friends' => $friendsList]);
        } else {
            return view('clients.auth.login');
        }
    }
}
