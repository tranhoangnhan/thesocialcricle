<?php

namespace App\Livewire\Clients\Conversations;

use App\Models\FriendsModel;
use Livewire\Component;

class Search extends Component
{
    public $showdiv = false;
    public $search = "";
    public $data = [];
    public $highlightIndex = 0;
    public $tags = [];
    public $showFind = false;

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

        $this->dispatch('tags', $this->tags);
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
            $this->data = FriendsModel::where(function ($query) {
                $query->where('user_one_id', auth()->user()->user_id)
                    ->orWhere('user_two_id', auth()->user()->user_id);
            })
            ->where(function ($query) {
                $query->whereHas('userOne', function ($query) {
                    $query->where('user_fullname', 'like', '%' . $this->search . '%');
                })
                ->whereHas('userTwo', function ($query) {
                    $query->where('user_fullname', 'like', '%' . $this->search . '%');
                });
            })

                ->where('status', '1')
                ->get();
            $this->showFind = true;
            $this->showdiv = true;
        } else {
            $this->data = [];
            $this->showFind = false;
            $this->showdiv = false;
        }
        $this->dispatch('showFind', $this->showFind);
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
        $this->dispatch('tags', $this->tags);
    }

    public function render()
    {
        $this->searchResult();
        return view('livewire.clients.conversations.search', [
            'highlightIndex' => $this->highlightIndex,
        ]);
    }
}
