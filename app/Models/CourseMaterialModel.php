<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMaterialModel extends Model
{
    use HasFactory;
    protected $table = 'course_material';
    protected $primaryKey = 'material_id';
    protected $fillable = [
        'material_id',
        'material_name',
        'material_type',
        'material_url',
        'material_description',
        'uploader_at',
        'created_at',
        'updated_at',
        'course_id',
        'section_id',
        'review'
        'slug',
    ];
}
