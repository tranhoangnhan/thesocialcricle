<?php

namespace App\Events\Clients\Users;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AllUsersEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $type, $status ,$userId,$time,$receiverId,$message;

    public function __construct($type,$status, $userId,$receiverId=NULL, $time,$message=NULL)
    {
        $this->type = $type;
        $this->status = $status;
        $this->userId = $userId;
        $this->time = $time;
        $this->receiverId = $receiverId;
    }

    public function broadcastOn()
    {
        if($this->type=='typing'){
            return new Channel('users_typing_to.' . $this->receiverId);
        }else if($this->type=="addGroup"){
            return new Channel("chat_notifications.".$this->receiverId);
        }else if($this->type=="loading"){
            return new Channel("loading.".$this->userId);
        }else{
          return new Channel('users.' . $this->userId);
        }
    }


    public function broadcastAs()
    {
        return 'AllUsersEvent';
    }
}
