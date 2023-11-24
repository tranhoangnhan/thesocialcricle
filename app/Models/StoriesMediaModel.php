<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoriesMediaModel extends Model
{
    use HasFactory;
    public $table = "stories_media";

    public $timestamps = false;

    protected $primaryKey = 'media_id';
    public $fillable=[
        'media_id',
        'source',
        'is_photo',
        'text',
        'story_id',
    ];

    public function story()
    {
        return $this->belongsTo(StoriesModel::class, 'story_id', 'story_id');
    }
}
