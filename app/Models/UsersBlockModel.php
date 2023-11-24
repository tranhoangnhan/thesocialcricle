<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersBlockModel extends Model
{
    use HasFactory;

    public $table = "users_block";
    public $timestamps = false;
    public $fillable=[
        'user_id',
        'block_id',
    ];
}
