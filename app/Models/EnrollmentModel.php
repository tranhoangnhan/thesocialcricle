<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentModel extends Model
{
    use HasFactory;
    protected $table = 'enrollment';
    protected $primaryKey = 'enrollment_id';
    protected $fillable = [
        'enrollment_id',	'enrollment_date',	'created_at',	'updated_at',	'user_id',	'course_id'
    ];
}
