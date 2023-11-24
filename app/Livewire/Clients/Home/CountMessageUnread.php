<?php

namespace App\Livewire\Clients\Home;

use App\Models\Conversations_UsersModel;
use Livewire\Component;
use Livewire\Attributes\On;
class CountMessageUnread extends Component
{
    public $message = 0;
    public function mount(){
        $this->count();
    }
    #[On('chat')]
    public function count()
    {
        $this->message = Conversations_UsersModel::where('seen', "0")
            ->where('deleted', "0")
            ->where('user_id', auth()->user()->user_id)
            ->count();
    }
    public function render()
    {
        return view('livewire.clients.home.count-message-unread');
    }
}
