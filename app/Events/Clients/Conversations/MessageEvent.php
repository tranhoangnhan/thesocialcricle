<?php

namespace App\Events\Clients\Conversations;

use App\Models\Conversations_MessagesModel;
use App\Models\UsersModel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $message, $receiverId,$name;

    public function __construct($name,$receiverId, $message)
    {
        $this->receiverId = $receiverId;
        $this->message = $message;
        $this->name = $name;
    }

    public function broadcastOn()
    {
        return new Channel('chat.' . $this->receiverId);
    }


    public function broadcastAs()
    {
        return 'MessageEvent';
    }




}
