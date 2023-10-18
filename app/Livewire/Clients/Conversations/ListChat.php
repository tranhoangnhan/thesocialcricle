<?php

namespace App\Livewire\Clients\Conversations;

use App\Models\ConversationsModel;
use Livewire\Component;

class ListChat extends Component
{
    public function render()
    {
        $currentUserId = auth()->user()->user_id;

        $conversations = ConversationsModel::select('conversations_id', 'conversations_message')
            ->with([
                'users' => function ($query) use ($currentUserId) {
                    $query->select('id', 'conversations_id', 'user_id', 'seen', 'typing', 'deleted')
                        ->where('user_id', '<>', $currentUserId);
                },
                'lastMessage'
            ])
            ->whereHas('users', function ($query) use ($currentUserId) {
                $query->where('user_id', $currentUserId);
            })
            ->get();
            // dd($conversations);
        return view('livewire.clients.conversations.list-chat', compact('conversations'));
    }
}
