<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostReaction extends Model
{
    protected $table = 'posts_reactions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'reaction', 'reaction_time', 'post_id', 'comment_id', 'user_id'

    ];
    use HasFactory;
}
