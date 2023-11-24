<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntroductionModel extends Model
{
    use HasFactory;
    public $table = "users_introduction";

    public $timestamps=false;

    public $fillable = [
        'location',
        'hometown',
        'marital',
        'website',
        'job',
        'university',
        'high_school',
        'middle_shool',
        'primary_school',
        'language',
        'user_id'
    ];
}
