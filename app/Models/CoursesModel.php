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
         'start_date',
        'end_date',
         'course_duration',
         'intructor_id',
         'created_at',
         'updated_at',
         'slug',
    ];
}
