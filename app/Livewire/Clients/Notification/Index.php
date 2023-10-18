<?php

namespace App\Livewire\Clients\Notification;

use Livewire\Component;
use App\Models\NotificationModel;

class Index extends Component
{
    public $notifications;
    public $count; // Change 'notification' to 'notifications' to store an array of notifications
    public function mount()
    {
        $this->markAsRead();
    }
    public function markAsRead()
    {
        $user = auth()->user();

        if ($user) {
            $this->notifications = NotificationModel::where('to_user_id', $user->user_id)->orderBy('seen', 'asc')->get();

            foreach ($this->notifications as $notification) {
                $notification->update(['seen' => 1]);
            }
        }
    }

    public function render()
    {
        $user = auth()->user();

        if ($user) {
            $this->notifications = NotificationModel::where('to_user_id', $user->user_id)
            ->orderBy('id', 'desc') // Sau đó sắp xếp theo cột "time" theo thứ tự tăng dần
            ->limit(10) // Giới hạn kết quả cho 10 bản ghi
            ->get();
        } else {
            $this->notifications = collect(); // Create an empty collection
        }

        $this->count = NotificationModel::where('to_user_id', $user->user_id)->where('seen', '0')->count();
        return view('livewire.clients.notification.index')->with(['notifications' => $this->notifications, 'count' => $this->count]);
    }
}
