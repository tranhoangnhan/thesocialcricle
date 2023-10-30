<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSectionModel extends Model
{
    use HasFactory;
    protected $table = 'course_section';
    protected $primaryKey = 'section_id';
  
    protected $fillable = [
        'course_id',
        'section_name',
        'slug',
    ];
}
