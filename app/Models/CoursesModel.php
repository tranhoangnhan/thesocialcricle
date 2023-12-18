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
         'amount',
         'course_name',
         'description',
         'banner',
         'category_id',
         'instructor_id',
         'created_at',
         'updated_at',
         'slug',
    ];
    public function isEmpty() {
     // Custom logic to check if the course is empty
     // For example, you might check if certain properties are not set.
     return !isset($this->someProperty);
 }
}
