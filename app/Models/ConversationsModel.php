<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationsModel extends Model
{
    use HasFactory;

    public $table = 'conversations';
    public function users()
    {
        return $this->hasMany(Conversations_UsersModel::class, 'conversations_id', 'conversations_id');
    }
    public function lastMessage()
    {
        return $this->hasOne(Conversations_MessagesModel::class, 'conversations_id', 'conversations_id')
            ->orderBy('time', 'desc'); // Sắp xếp theo thời gian giảm dần (tức là lấy tin nhắn cuối cùng)
    }
}
