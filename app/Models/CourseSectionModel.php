<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSectionModel extends Model
{
    use HasFactory;
    protected $table = 'course_section';
    protected $fillable = [
        'course_id',
        'secsion_name',
        'secsion_slug',
    ];
}
