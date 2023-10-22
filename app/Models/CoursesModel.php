<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursesModel extends Model
{
   protected $table = 'course';
   protected $primaryKey = 'course_id';
    protected $fillable = [
         'course_id',
         'course_name',
         'description',
         'banner',
         'course_duration',
         'instructor_id',
         'category',
         'payment',
         'require_skill',
         'learn_skill',
         'status',
         'slug',
         'created_at',
         'updated_at',
    ];
}
