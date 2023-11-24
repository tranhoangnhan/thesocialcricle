<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumModel extends Model
{
    use HasFactory;
    public $table = 'albums';
    public $timestamps = false;
    public $fillable = [
        'user_id'
    ];
}
