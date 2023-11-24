<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingProfileController extends Controller
{
    public function index(){
        return view('clients.setting.index');
    }
}
