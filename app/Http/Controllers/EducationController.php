<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseSectionModel;
use App\Models\CoursesModel;
use App\Models\CourseMaterialModel;


use App\Models\CourseCategoryModel;
class EducationController extends Controller
{
public $slug;
    public function index()
    {  
        
        
        return view('clients.education.index',['courses'=>CoursesModel::where('status',0)->get()]);
    }
    public function courses_intro($slug)
    {   

        $course = CoursesModel::where('slug',"$slug")->first();
        
        $course_section = CourseSectionModel::where('course_section.course_id', $course->course_id)
    ->get();
    foreach($course_section as $section){
        $section->material = CourseMaterialModel::where('section_id', $section->section_id)->get();
    }
        return view('clients.education.intro',['course'=>$course, 'sections'=>$course_section]);
    }
    
    public function courses_video()
    {
        return view('clients.education.video');
    }
    public function courses_register()
    {
        return view('clients.education.register');
    }
    public function courses_register_content($slug)
    {
        $course = CoursesModel::where('slug',"$slug")->first();

        return view('clients.education.add_content',['course'=>$course]);
       
    }
}
