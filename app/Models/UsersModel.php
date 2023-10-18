<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersModel extends Model
{
    use HasFactory;

    protected $table = "users";
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_username',
        'user_fullname',
        'user_password',
        'user_cover',
        'user_banned',
        'user_banned_message',
        'user_email',
        'user_email_verified',
        'user_email_verification_code',
        'user_activated',
        'user_phone',
        'user_role',
        'user_birthday',
        'user_avatar',
        'user_bio',
        'user_ip_address',
        'user_gender',
        'user_registered',
        'user_last_seen',
        'user_chat_enabled',
        'user_token',
    ];

    const CREATED_AT = 'user_registered';
    const UPDATED_AT = 'user_last_seen';
    public static function createUser($data)
    {

        $key = Config::get('app.key');
        $token = Str::random(16);
        $encryptedToken = encrypt($token, $key);
        $otp = \App\Helpers\Helper::random('0123456789', '6');
        $month = str_pad($data['month'], 2, '0', STR_PAD_LEFT);
        $day = str_pad($data['day'], 2, '0', STR_PAD_LEFT);

        // Gộp thành chuỗi có định dạng YYYY-MM-DD
        $birthday = "{$data['year']}-{$month}-{$day}";

        $user = self::create([
            'user_username' => $data['username'],
            'user_fullname' => $data['fullname'],
            'user_password' => Hash::make($data['password']),
            'user_email' => $data['email'],
            'user_phone' => $data['phone'],
            'user_gender' => (string) $data['gender'],
            'user_ip_address' => $data['ip'],
            'user_birthday' => $birthday,
            'user_status' => 0,
            'user_email_verification_code' => $otp,
            'user_registered' => now(),
            'user_token' => $encryptedToken,
        ]);

        return [
            'username' => $user->username,
            'name' => $user->user_fullname,
            'email' => $user->user_email,
            'otp' => $user->user_email_verification_code,
        ];
    }

    public function friends()
    {
        return $this->hasMany(FriendsModel::class, 'user_id');
    }
}
