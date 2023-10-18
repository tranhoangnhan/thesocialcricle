<?php

namespace App\Livewire\Clients\Conversations;

use App\Models\ConversationsModel;
use App\Models\UsersModel;
use Livewire\Attributes\On;
use Livewire\Component;

class Chat extends Component
{
    public $tags = [];
    public $user_id;
    public $user_fullname;
    public $users;
    public $count;
    public $son = false;
    public $selectConversations;

    public function mount($id = null)
    {
        $this->selectConversations = $id;
    }


    #[On('tags')]
    public function updatedData($data)
    {
        $this->tags = $data;
        $this->getConversations();
    }

    public function getConversations()
    {
        if (count($this->tags) === 1 || isset($this->selectConversations)) {
            if (isset($this->selectConversations)) {
                $id = $this->selectConversations;
            } else {
                $id = $this->tags[0]['friendId'];
            }
            $a = UsersModel::where('user_id', $id)->first();
            $this->user_id = $a->user_id;
            // dd(getConversationMessages($id));
        } else {
            $a = collect($this->tags)->pluck('friendId')->take(4);
            $b = collect($this->tags)->pluck('friendFullName');
            $this->user_id = $a;
            $this->user_fullname = $b;
            $this->count = count($this->tags);
        }
    }
    public function render()
    {
        if (isset($this->selectConversations)) {
            $this->getConversations();
        }
        return view('livewire.clients.conversations.chat');
    }
}
