<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoursesModel;

class EducationController extends Controller
{
    public function index()
    {  
        
        
        return view('clients.education.index',['courses'=>CoursesModel::where('status',0)->get()]);
    }
    public function courses_intro($slug)
    {   

        $course = CoursesModel::where('slug',"$slug")->first();
       

        return view('clients.education.intro',['course'=>$course]);
    }
    public function courses_video()
    {
        return view('clients.education.video');
    }
}
