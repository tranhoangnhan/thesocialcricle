<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Block extends Model
{
    protected $guarded = [];
    protected $table = 'users_block';
    use HasFactory;
}
