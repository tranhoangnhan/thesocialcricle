<?php

namespace App\Livewire\Clients\Profile;

use App\Models\FriendsModel;
use App\Models\IntroductionModel;
use App\Models\UsersModel;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Friend extends Component
{
    use WithPagination;

    public $data, $friends = [], $id,
    $selectTabFriends = "all", $countFriendsList, $friendsReCent, $friendsBirthday, $friendsCity;
    public $perPage = [
        'all' => 4,
        'recent' => 4,
        'birthday' => 4,
        'city' => 4,
    ];
    public function mount($data, $id)
    {
        $this->data = $data;
        $this->id = $id;
        Cache::put('user_id', $this->id);
    }
    public function refreshing()
    {
        Cache::forget('user_id');
    }

    public function selectTab($data)
    {
        $this->selectTabFriends = $data;
        if ($data == 'all') {
            $this->friendsList();
        } elseif ($data == 'recent') {
            $this->friendsList();
        } elseif ($data == 'birthday') {
            $this->friendsList();
        } elseif ($data == 'city') {
            $this->friendsList();
        }
    }

    #[On('loadMoreFriendsList')]
    public function loadMoreFriendsList()
    {
        $this->perPage[$this->selectTabFriends] = $this->perPage[$this->selectTabFriends] + 8;
        $this->friendsList();
    }
    public function friendsList()
    {
        $id = Cache::get('user_id');
        if ($this->data) {
            $dataLog = UsersModel::where('user_id', $id)->first();
            if (empty($dataLog)) {
                $dataLog = UsersModel::where('user_username', $id)->first();
            }
            $friendsQuery = FriendsModel::where('status', '1')
                ->where(function ($query) use ($dataLog) {
                    $query->where('user_one_id', $dataLog->user_id)
                        ->orWhere('user_two_id', $dataLog->user_id);
                });
            if ($this->selectTabFriends == 'recent') {
                $friendsQuery = FriendsModel::where('status', '1')
                    ->where(function ($query) use ($dataLog) {
                        $query->where('user_one_id', $dataLog->user_id)
                            ->orWhere('user_two_id', $dataLog->user_id);
                    })->orderBy('time_accept', 'DESC');
            }
            $friends = $friendsQuery->paginate($this->perPage[$this->selectTabFriends]);

            $friendUserIds = [];
            foreach ($friends as $friend) {
                if ($friend->user_one_id != $dataLog->user_id) {
                    $friendUserIds[] = $friend->user_one_id;
                }
                if ($friend->user_two_id != $dataLog->user_id) {
                    $friendUserIds[] = $friend->user_two_id;
                }
            }
            if ($this->selectTabFriends == 'all') {
                $this->friends = UsersModel::whereIn('user_id', $friendUserIds)->get();
            } else if ($this->selectTabFriends == 'recent') {
                $friendsUnsorted = UsersModel::whereIn('user_id', $friendUserIds)->get();
                $this->friendsReCent = $friendsUnsorted->sortBy(function ($user) use ($friendUserIds) {
                    return array_search($user->user_id, $friendUserIds);
                });
            } else if ($this->selectTabFriends == 'birthday') {
                $currentMonth = date('m');
                $this->friendsBirthday = UsersModel::whereIn('user_id', $friendUserIds)
                    ->whereMonth('user_birthday', $currentMonth)
                    ->get();
            } else if ($this->selectTabFriends == 'city') {
                $currentCity = IntroductionModel::where('user_id', $id)->first();
                if ($currentCity) {
                    $currentCity = $currentCity->hometown;
                    $hometownParts = explode(',', $currentCity);
                    if (count($hometownParts) > 2) {
                        // $district = trim($hometownParts[count($hometownParts) - 2]);
                        $province = trim($hometownParts[count($hometownParts) - 1]);
                        // $combinedHomeTown = $district . ', ' . $province;
                        $combinedHomeTown = $province;
                    }
                    $friendUserIds = IntroductionModel::where('user_id', '!=', $id)->
                        where('hometown', 'LIKE', '%' . $combinedHomeTown . '%')
                        ->pluck('user_id')
                        ->toArray();
                    $this->friendsCity = UsersModel::whereIn('user_id', $friendUserIds)
                        ->get();
                    //thêm tỉnh
                    $this->friendsCity->each(function ($friend) use ($combinedHomeTown) {
                        $friend->combinedHomeTown = $combinedHomeTown;
                    });
                }

            }

        }
    }
    public function render()
    {
        $this->friendsList();
        return view('livewire.clients.profile.friend');

    }
}
