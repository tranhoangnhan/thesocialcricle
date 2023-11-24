<?php

namespace App\Livewire\Clients\Home;

use App\Models\ConversationsModel;
use Livewire\Component;

class ListGroup extends Component
{
    public function render()
    {
        $currentUserId = auth()->user()->user_id;
        $conversations = ConversationsModel::select('conversations_id', 'conversations_message', 'name')
            ->with([
                'users' => function ($query) use ($currentUserId) {
                    $query->select('id', 'conversations_id', 'user_id', 'seen', 'typing', 'deleted')
                        ->where('user_id', '<>', $currentUserId);
                },
                'message' => function ($query) {
                    $query->select('time')->orderBy('time', 'desc');
                }
            ])
            ->whereHas('users', function ($query) use ($currentUserId) {
                $query->where('user_id', $currentUserId);
            })
            ->orderBy('conversations_message','DESC')
            ->get();
        return view('livewire.clients.home.list-group',compact('conversations'));
    }
}
