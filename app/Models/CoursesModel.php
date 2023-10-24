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
         'payment',
         'required_skill',
         'learn_skill',
         'course_name',
         'description',
         'banner',
         'category_id',
         'instructor_id',
         'created_at',
         'updated_at',
         'slug',
    ];
}
