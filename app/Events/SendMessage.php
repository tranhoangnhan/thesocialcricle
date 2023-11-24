<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $data;

    /**
    * Create a new event instance.
    *
    * @return void
    */
    public function __construct($message)
    {
        $this->data = $message;
    }

    /**
    * Get the channels the event should broadcast on.
    *
    * @return \Illuminate\Broadcasting\Channel|array
    */
    public function broadcastOn()
    {
        return new Channel('send-chat-message');
    }

    /**
    * The event's broadcast name.
    *
    * @return string
    */
    public function broadcastAs()
    {
        return 'SendChatMessage';
    }

    /**
    * The event's broadcast name.
    *
    * @return string
    */
    public function broadcastWith()
    {
        return ['title'=> $this->data ];
    }
}
