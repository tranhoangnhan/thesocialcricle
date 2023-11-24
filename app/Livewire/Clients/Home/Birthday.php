<?php

namespace App\Livewire\Clients\Home;

use App\Models\FriendsModel;
use App\Models\UsersModel;
use Livewire\Component;
use Livewire\Attributes\On;

class Birthday extends Component
{
    public $users = [], $check = null;
    public $currentMonth,$defaultMonth,$month;
    public function mount()
    {
        $this->currentMonth = now()->month;
        $this->defaultMonth = now()->month;
        $this->loadData($this->currentMonth);
    }
    public function loadData($month)
    {
        $user_id = auth()->user()->user_id;
        $currentDate = now();

        $friends = FriendsModel::where('status', strval(1))
            ->where(function ($query) use ($user_id) {
                $query->where('user_one_id', $user_id)
                    ->orWhere('user_two_id', $user_id);
            })
            ->where(function ($query) use ($user_id) {
                $query->where('user_one_id', '!=', $user_id)
                    ->orWhere('user_two_id', '!=', $user_id);
            })
            ->get();

        if ($friends) {
            $friendIds = $friends->pluck('user_one_id')->merge($friends->pluck('user_two_id'))->unique();
            $usersData = UsersModel::whereIn('user_id', $friendIds)->where('user_id', '!=', $user_id)
                ->whereMonth('user_birthday', '=', $month)
                ->whereDay('user_birthday', '>=', $currentDate->day)
                ->orWhereYear('user_birthday', '>', $currentDate->year)
                ->orderByRaw("DATEDIFF(user_birthday, '{$currentDate->toDateString()}')")
                ->get();

            if (count($usersData) >= 1) {
                $this->users[$month] = $usersData;
                $this->check = true;
            }
        }
    }

    #[On('loadNextMonth_Birthday')]
    public function loadNextMonth()
    {
        $this->currentMonth++;
        if ($this->currentMonth > 12) {
            $this->currentMonth = 1;
        }
        $this->loadData($this->currentMonth);
    }

    public function render()
    {
        return view('livewire.clients.home.birthday');
    }
}
