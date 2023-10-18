<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsComment extends Model
{
    protected $table = 'posts_comments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'comment_id', 'node_type', 'user_type', 'text', 'image', 'reaction_like_count', 'reaction_love_count', 'reaction_haha_count', 'reaction_yay_count', 'reaction_wow_count', 'reaction_sad_count', 'reaction_angry_count', 'replies', 'node_id', 'user_id'

    ];
    use HasFactory;
}
