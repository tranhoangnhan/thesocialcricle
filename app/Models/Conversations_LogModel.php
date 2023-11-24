<?php

namespace App\Models;

use App\Events\Clients\Users\AllUsersEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversations_LogModel extends Model
{
    use HasFactory;
    protected $table = "conversations_log";
    public $timestamps=false;
    public $fillable = [
        "conversations_id",
        "user_id",
        "event_data",
        "event_type",
        'time',
    ];

    public static function logConversationEvent($eventType, $conversationId, $message) {
        Conversations_LogModel::create([
            'user_id' => auth()->user()->user_id,
            'event_type' => $eventType,
            'event_data' => $message,
            'time' => now(),
            'conversations_id' => $conversationId
        ]);
    }
    
}
