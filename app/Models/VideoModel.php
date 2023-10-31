<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoModel extends Model
{
    use HasFactory;
    protected $table = 'course_material';
    protected $fillable = [
        'material_id',
        'material_name',
        'material_type',
        'material_url',
        'uploader_at',
        'created_at',
        'updated_at',
        'course_id',
        'section_id',
    ];
}

