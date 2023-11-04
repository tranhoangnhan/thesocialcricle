<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = [];
    protected $table='awswer';

    use HasFactory;
    protected $primaryKey = 'awswer_id';

    public function question()
    {
        return $this->belongsTo(Questions::class, 'question_id','awswer_id');
    }
}
