<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP_Manager extends Model
{
    use HasFactory;
    public $table = "otp_manager";

    public $fillable=[
        'email',
        'type',
        'token',
        'expires_at',
    ];
}
