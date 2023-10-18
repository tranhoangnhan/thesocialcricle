<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowAddFriendsController extends Controller
{
    public function render(){
        return view('clients.friends.index');
    }
}
