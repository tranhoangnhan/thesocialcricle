<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersLogModel extends Model
{
    use HasFactory;
    public $table = "users_log";
    protected $fillable = [
        'user_id',
        'ip',
        'country',
        'country_code',
        'timezone',
        'location',
        'latitude',
        'longitude',
        'browser',
        'os',
        'city',
        'proxy'
    ];
}
