<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizthankyouController extends Controller
{
    public function index(){
        return view('clients.quiz.thankyou');
    }
}
