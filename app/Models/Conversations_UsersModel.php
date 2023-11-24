<?php

namespace App\Models;

use App\Events\Clients\Users\AllUsersEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversations_UsersModel extends Model
{
    use HasFactory;
    protected $table = "conversations_users";

    public $timestamps = false;
    public $fillable = [
        "seen",
        "typing",
        "deleted",
        "conversations_id",
        
        "user_id",
        "role",
        "kick",
    ];
    public function conversation()
    {
        return $this->belongsTo(ConversationsModel::class, 'conversations_id', 'conversations_message');
    }

    public function userModelRelation()
    {
        return $this->belongsTo(UsersModel::class, 'user_id', 'user_id');
    }

    public static function broadcastGroupEvent($conversationId, $message)
    {
        $conversationMembers = Conversations_UsersModel::where('conversations_id', $conversationId)->get();
        if ($conversationMembers) {
            foreach ($conversationMembers as $member) {
                event(new AllUsersEvent('addGroup', 'success', auth()->user()->user_id, $member->user_id, now(), $message));
            }
        }

    }

}
