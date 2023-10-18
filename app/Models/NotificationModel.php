<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    use HasFactory;
    protected $table = 'notification';
    protected $fillable = [
        'to_user_id',
        'from_user_id',
        'from_user_type',
        'action',
        'node_type',
        'node_url',
        'message',
        'seen',
        'time',
    ];

}
