<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $guarded = [];
    protected $table='question';
    use HasFactory;
    protected $primaryKey = 'question_id';


    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'question_id');
    }

    public function answer()
    {
        return $this->hasMany(Answer::class , 'question_id','question_id');
    }

}
