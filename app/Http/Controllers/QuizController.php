<?php

namespace App\Http\Controllers;

use App\Models\CoursesModel;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index($slug){
        $course = CoursesModel::where('slug', $slug)->first();
        return view('clients.quiz.index', compact('course'));
    }
}
