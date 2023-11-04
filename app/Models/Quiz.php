<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    protected $guarded = [];
    protected $table='quiz';
    use HasFactory;
    protected $primaryKey = 'quiz_id';

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function question()
    {
        return $this->hasMany(Questions::class, 'quiz_id', 'quiz_id');
    }

}
