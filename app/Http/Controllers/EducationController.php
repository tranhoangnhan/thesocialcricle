<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseSectionModel;
use App\Models\CoursesModel;
use App\Models\CourseMaterialModel;
use App\Models\VideoModel;

use App\Models\CourseCategoryModel;
use App\Models\EnrollmentModel;

use function Laravel\Prompts\select;

class EducationController extends Controller
{
    public $slug;
    public function index()
    {

        $related = CoursesModel::join('course_category', 'course_category.category_id', '=', 'course.category_id')
            ->join('users', 'users.user_id', '=', 'course.instructor_id')
            ->where('status', '0')
            ->whereNotExists(function ($query) {
                $query->select('course_id')
                    ->from('enrollment')
                    ->whereRaw('enrollment.course_id = course.course_id')
                    ->where('enrollment.user_id', auth()->user()->user_id);
            })
            ->select('course.*', 'course_category.category_name', 'users.user_fullname')
            ->get();
        return view('clients.education.index', ['courses' => $related]);
    }
    public function courses_intro($slug)

    {   
        
        $course = CoursesModel::where('slug',"$slug")->first();
        $first_video = VideoModel::where('course_id', $course->course_id)->first();
        $enroll_first = $first_video->slug;
        
        $course_section = CourseSectionModel::where('course_section.course_id', $course->course_id)
    ->get();
    foreach($course_section as $section){
        $section->material = CourseMaterialModel::where('section_id', $section->section_id)->get();
    }
        return view('clients.education.intro',['course'=>$course, 'sections'=>$course_section, 'first_video'=>$enroll_first]);
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
        $course = CoursesModel::where('slug', "$slug")->first();

        return view('clients.education.add_content', ['course' => $course]);
    }
}
