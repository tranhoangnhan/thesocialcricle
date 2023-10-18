<?php

namespace App\Livewire\Clients\Conversations;

use App\Events\Clients\Conversations\NewMessageEvent;
use App\Models\ConversationsModel;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $tags = [];
    public $users = '';
    public $message;
   
    #[On('tags')]
    public function updatedData($data)
    {
        $this->tags = $data;
    }
    public function fetchUser()
    {
        $this->users = implode(', ', $this->tags);
        // event(new NewMessageEvent($this->users));
    }
    #[On('echo:clients-conversations-newmessageevent')]
    public function test(){
        $this->message = $this->users;
    }

    public function render()
    {
        return view('livewire.clients.conversations.index');
    }
}
