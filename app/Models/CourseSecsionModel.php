<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSecsionModel extends Model
{
    use HasFactory;
    protected $table = 'course_secsion';
    protected $fillable = [
        'secsion_name',
        'secsion_slug',
        'course_id'
    ];
}
