<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoriesModel extends Model
{
    use HasFactory;

    public $table = "stories";

    public $timestamps = false;

    protected $primaryKey = 'story_id';
    public $fillable=[
        'story_id',
        'time',
        'user_id',
    ];
}
