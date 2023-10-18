<?php

namespace App\Http\Controllers;

use App\Models\NotificationModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return view('clients.home.index');
        } else {
            return view('clients.auth.login');
        }
    }
}
