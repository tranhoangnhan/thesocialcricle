<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversations_UsersModel extends Model
{
    use HasFactory;
    protected $table="conversations_users";
    public function conversation()
    {
        return $this->belongsTo(ConversationsModel::class, 'conversations_id', 'conversations_message');
    }
}
