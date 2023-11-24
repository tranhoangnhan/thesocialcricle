<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversations_MessagesModel extends Model
{
    use HasFactory;
    protected $table = "conversations_message";

    protected $primaryKey = 'message_id';
    public $timestamps=false;
    public $fillable = [
        "message_id",
        "conversations_id",
        "type",
        "user_id",
        "message",
        "source",
        "reaction_like_count",
        'reaction_love_count',
        'reaction_haha_count',
        'reaction_yay_count',
        'reaction_wow_count',
        'reaction_sad_count',
        'reaction_angry_count',
        'time',
    ];

    

}
