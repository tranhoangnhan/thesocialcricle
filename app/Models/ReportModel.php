<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportModel extends Model
{
    use HasFactory;
    protected $table = 'report';
    protected $fillable = [
        'user_id_reporter',
        'user_id',
        'post_id',
        'course_id',
    ];
}
