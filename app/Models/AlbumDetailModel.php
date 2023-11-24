<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumDetailModel extends Model
{
    use HasFactory;
    public $table = 'albums_detail';
    public $timestamps = false;
    public $fillable = [
        'source',
        'album_id',
        'user_id'
    ];
}
