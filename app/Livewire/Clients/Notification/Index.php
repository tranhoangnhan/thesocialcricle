<?php

namespace App\Livewire\Clients\Notification;

use Livewire\Component;
use App\Models\NotificationModel;

class Index extends Component
{
    public $notifications;
    public $count;

    public function mount()
    {
        $this->notifications = NotificationModel::where('to_user_id', auth()->user()->user_id)
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
        $this->count = NotificationModel::where('to_user_id', auth()->user()->user_id)->where('seen', '0')->count();
    }
    public function markAsRead()
    {
        NotificationModel::where('to_user_id', auth()->user()->user_id)->update(['seen' => '1']);
        $this->count = 0;
        $this->notifications = NotificationModel::where('to_user_id', auth()->user()->user_id)
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
        return view('livewire.clients.notification.index')->with(['notifications' => $this->notifications, 'count' => $this->count]);
    }


    public function render()
    {
        return view('livewire.clients.notification.index')->with(['notifications' => $this->notifications, 'count' => $this->count]);
    }
}
