<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentCourseModel extends Model
{
    use HasFactory;
    protected $table='comment_course';
    protected $fillable=[
        'id',
        'user_id',
        'comment',
        'course_id',
    ];
}
