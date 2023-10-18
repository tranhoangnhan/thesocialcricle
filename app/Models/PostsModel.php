<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsModel extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'post_id';
    protected $fillable = [
        'post_id', 'user_type', 'in_group', 'group_approved', 'in_wall', 'post_type', 'privacy', 'text', 'comment_disable', 'is_hidden', 'is_anonymous', 'reaction_like_count', 'reaction_love_count', 'reaction_haha_count', 'reaction_yay_count', 'reaction_wow_count', 'reaction_sad_count', 'reaction_angry_count', 'comments', 'views', 'shares', 'created_at', 'updated_at', 'user_id', 'group_id', 'colored_pattern'

    ];
    use HasFactory;
}
