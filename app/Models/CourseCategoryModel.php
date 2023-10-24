<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategoryModel extends Model
{
    use HasFactory;
    protected $table = 'course_category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category_name',
        'slug',
    ];

}
