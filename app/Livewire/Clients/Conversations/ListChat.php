<?php

namespace App\Livewire\Clients\Conversations;

use App\Models\ConversationsModel;
use Livewire\Component;
use Livewire\Attributes\On;

class ListChat extends Component
{
    public $type, $searchUsers, $searchUsers1;
    public function mount($type = null)
    {
        $this->type = $type;
    }

    #[On('markAsReadMessage')]
    public function markAsReadMessage()
    {
        $currentUserId = auth()->user()->user_id;
        $query = ConversationsModel::select('conversations_id', 'conversations_message', 'name')
            ->with([
                'users' => function ($query) use ($currentUserId) {
                    $query->select('id', 'conversations_id', 'user_id', 'seen', 'typing', 'deleted')
                        ->where('user_id', $currentUserId);
                },
                'message' => function ($query) {
                    $query->select('time')->orderBy('time', 'desc');
                }
            ])
            ->whereHas('users', function ($query) use ($currentUserId) {
                $query->where('user_id', $currentUserId);
            })
            ->orderBy('conversations_message', 'DESC')
            ->get();
        if ($query) {
            foreach ($query as $conversation) {
                foreach ($conversation->users as $user) {
                    $user->seen = "1";
                    $user->save();
                }
            }
            $this->dispatch('chat');
            return $this->listChat();
        }
    }
    public function listChat()
    {
        $currentUserId = auth()->user()->user_id;
        $query = ConversationsModel::select('conversations_id', 'conversations_message', 'name')
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
            });
        if ($query) {
            if ($this->searchUsers1) {
                $currentUserId = auth()->user()->user_id;
                $query->whereHas('users', function ($query) use ($currentUserId) {
                    $query->whereHas('userModelRelation', function ($query) use ($currentUserId) {
                        $query->where(function ($query) {
                            $query->whereRaw("user_username REGEXP ?", ['^' . $this->searchUsers1])
                                ->orWhereRaw("user_fullname REGEXP ?", ['^' . $this->searchUsers1]);
                        })
                            ->orWhere(function ($query) {
                                $query->whereRaw("user_username REGEXP ?", ['\b' . $this->searchUsers1 . '\b'])
                                    ->orWhereRaw("user_fullname REGEXP ?", ['\b' . $this->searchUsers1 . '\b']);
                            }) //^ sẽ yêu cầu phải khớp từ đầu của chuỗi
                            ->where('user_id', '<>', $currentUserId);
                    })->orWhere(function ($query) {
                        $searchTerm = $this->searchUsers1;
                        // Sử dụng biểu thức chính quy để kiểm tra xem ttên nhóm
                        $query->where(function ($query) use ($searchTerm) {
                            $query->whereRaw("name REGEXP ?", ['^' . $searchTerm]);
                        })
                            ->orWhere(function ($query) use ($searchTerm) {
                                $query->whereRaw("name REGEXP ?", ['\b' . $searchTerm . '\b']);
                            });
                    });
                });
            }
            if ($this->searchUsers) {
                $currentUserId = auth()->user()->user_id;
                $query->whereHas('users', function ($query) use ($currentUserId) {
                    $query->whereHas('userModelRelation', function ($query) use ($currentUserId) {
                        $query->where(function ($query) {
                            $searchTerm = $this->searchUsers;
                            $query->where(function ($query) use ($searchTerm) {
                                $query->whereRaw("user_username REGEXP ?", ['^' . $searchTerm])
                                    ->orWhereRaw("user_fullname REGEXP ?", ['^' . $searchTerm]);
                            })
                                ->orWhere(function ($query) use ($searchTerm) {
                                    $query->whereRaw("user_username REGEXP ?", ['\b' . $searchTerm . '\b'])
                                        ->orWhereRaw("user_fullname REGEXP ?", ['\b' . $searchTerm . '\b']);
                                });
                        })->where('user_id', '<>', $currentUserId);
                    });
                })
                    ->orWhere(function ($query) {
                        $searchTerm = $this->searchUsers;
                        // Sử dụng biểu thức chính quy để kiểm tra xem ttên nhóm
                        $query->where(function ($query) use ($searchTerm) {
                            $query->whereRaw("name REGEXP ?", ['^' . $searchTerm]);
                        })
                            ->orWhere(function ($query) use ($searchTerm) {
                            $query->whereRaw("name REGEXP ?", ['\b' . $searchTerm . '\b']);
                        });
                    });
            }
            $query->orderBy('conversations_message', 'DESC');
            $result = $query->get();

            return $result;
        }

    }


    #[On('chat')]
    public function render()
    {
        $this->listChat();
        return view('livewire.clients.conversations.list-chat', [
            'conversations' => $this->listChat()
        ]);
    }
}
