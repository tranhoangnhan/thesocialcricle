<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendsModel extends Model
{
    use HasFactory;

    public $table="friends";
    public function userOne()
    {
        return $this->belongsTo(UsersModel::class, 'user_one_id');
    }

    public function userTwo()
    {
        return $this->belongsTo(UsersModel::class, 'user_two_id');
    }

    public function friends()
    {
        return $this->hasMany(FriendsModel::class, 'user_one_id');
    }

    public function friendsOfUserTwo()
    {
        return $this->hasMany(FriendsModel::class, 'user_two_id');
    }
}
