<?php

namespace App\Livewire\Clients\Conversations;

use App\Events\Clients\Users\AllUsersEvent;
use App\Models\Conversations_LogModel;
use App\Models\Conversations_UsersModel;
use App\Models\FriendsModel;
use App\Models\UsersModel;
use Livewire\Component;

class SearchMember extends Component
{
    public $showdiv = false;
    public $search = "";
    public $data = [];
    public $highlightIndex = 0;
    public $tags = [];
    public $showFind = false;

    public $member;
    public function mount($member)
    {
        $this->member = intval($member);
    }
    public function add($friendId)
    {
        $friendId = (int) $friendId;
        $friendFullName = $this->getFriendFullName($friendId);
        $data = [
            'friendId' => $friendId,
            'friendFullName' => $friendFullName,
        ];
        if (!collect($this->tags)->contains('friendId', $friendId)) {
            $this->tags[] = $data;
            $this->resetSearch();
        }
    }

    public function updatedSearch()
    {
        $this->searchResult();
    }


    public function getFriendFullName($friendId)
    {
        $friend = FriendsModel::where(function ($query) use ($friendId) {
            $query->where('user_one_id', auth()->user()->user_id)
                ->orWhere('user_two_id', auth()->user()->user_id);
        })
            ->where(function ($query) use ($friendId) {
                $query->whereHas('userOne', function ($query) use ($friendId) {
                    $query->where('user_id', $friendId);
                })
                    ->orWhereHas('userTwo', function ($query) use ($friendId) {
                        $query->where('user_id', $friendId);
                    });
            })
            ->where('status', '1')
            ->first();

        if ($friend) {
            if (auth()->user()->user_id == $friend->user_one_id) {
                return getName($friend->userTwo->user_id);
            } elseif (auth()->user()->user_id == $friend->user_two_id) {
                return getName($friend->userOne->user_id);
            }
        }
        return '';
    }

    public function resetSearch()
    {
        $this->search = "";
        $this->data = [];
        $this->showdiv = false;
        $this->showFind = false;
    }
    public function searchResult()
    {
        if (!empty($this->search)) {
            // Lấy danh sách bạn bè
            $friends = FriendsModel::where(function ($query) {
                $query->where('user_one_id', auth()->user()->user_id)
                    ->orWhere('user_two_id', auth()->user()->user_id);
            })
                ->where(function ($query) {
                    $query->whereHas('userOne', function ($query) {
                        $query->where('user_fullname', 'like', '%' . $this->search . '%');
                    })
                        ->orWhereHas('userTwo', function ($query) {
                            $query->where('user_fullname', 'like', '%' . $this->search . '%');
                        });
                })
                ->where('status', '1')
                ->get();
            $friendsInGroup = Conversations_UsersModel::where('conversations_id', $this->member)
                ->pluck('user_id')
                ->toArray();
            $friendsKickGroup = Conversations_UsersModel::where('conversations_id', $this->member)
                ->where('kick', 1)
                ->pluck('user_id')
                ->toArray();
            $filteredFriends = $friends->filter(function ($friend) use ($friendsInGroup, $friendsKickGroup) {
                // Kiểm tra xem cả user_one_id và user_two_id đều không nằm trong danh sách friendsInGroup hoặc user_one_id và user_two_id nằm trong danh sách friendsKickGroup
                return (!in_array($friend->user_one_id, $friendsInGroup) && !in_array($friend->user_two_id, $friendsInGroup)) || (in_array($friend->user_one_id, $friendsKickGroup) || in_array($friend->user_two_id, $friendsKickGroup));
            });



            $this->data = $filteredFriends;
            $this->showFind = true;
            $this->showdiv = true;
        } else {
            $this->data = [];
            $this->showFind = false;
            $this->showdiv = false;
        }
    }

    public function incrementHighlight()
    {
        $this->highlightIndex = min(count($this->data) - 1, $this->highlightIndex + 1);
    }

    public function decrementHighlight()
    {
        $this->highlightIndex = max(0, $this->highlightIndex - 1);
    }
    public function removeTag($tag)
    {
        foreach ($this->tags as $key => $tagData) {
            if ($tagData['friendId'] === decrypt($tag)) {
                unset($this->tags[$key]);
                $this->tags = array_values($this->tags);
                break;
            }
        }
    }

    public function addToGroup()
    {
        if (isset($this->tags)) {
            foreach ($this->tags as $tag) {
                $existingUserInGroup = Conversations_UsersModel::where('user_id', $tag['friendId'])
                    ->where('conversations_id', $this->member)
                    ->where('kick', 0)
                    ->first();
                if (!$existingUserInGroup) {
                    $checkKick = Conversations_UsersModel::where('user_id', $tag['friendId'])
                        ->where('conversations_id', $this->member)
                        ->where('kick', 1)
                        ->first();
                    if ($checkKick) {
                        $checkKick->update([
                            'kick' => 0,
                        ]);
                    } else {
                        Conversations_UsersModel::create([
                            'user_id' => $tag['friendId'],
                            'conversations_id' => $this->member,
                        ]);
                    }
                    $user = UsersModel::where('user_id', $tag['friendId'])->first();
                    $message = auth()->user()->user_fullname . " đã thêm " . $user->user_fullname . " vào nhóm";
                    Conversations_LogModel::create([
                        'user_id' => auth()->user()->user_id,
                        'event_type' => 'addMemberGroup',
                        'event_data' => $message,
                        'time' => now(),
                        'conversations_id' => $this->member
                    ]);
                    $conversationMembers = Conversations_UsersModel::where('conversations_id', $this->member)->get();
                    foreach ($conversationMembers as $member) {
                        event(new AllUsersEvent('addGroup', 'success', auth()->user()->user_id, $member->user_id, now(), $message));
                    }


                    return redirect()->route('messagesGroup', ['id' => $this->member]);
                } else {
                    return redirect()->route('messagesGroup', ['id' => $this->member]);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.clients.conversations.search-member', [
            'highlightIndex' => $this->highlightIndex,
        ]);
    }
}
