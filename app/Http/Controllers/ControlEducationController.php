<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoursesModel;
use App\Models\EnrollmentModel;
use App\Models\PaymentModel;
use App\Models\Quiz;

class ControlEducationController extends Controller
{
   
    public function index($slug)
    {
       
        $course = CoursesModel::where('slug', "$slug")->first();
        if(auth()->user()->user_id != $course->instructor_id){
            return redirect()->back();
        }
        $enroll = EnrollmentModel::where('course_id', $course->course_id)->get();
        $enroll = count($enroll);
        $payment = PaymentModel::where('course_id', $course->course_id)->get();
        $slary = $payment->sum('vnp_Amount')*0.1;
        $quiz = Quiz::where('course_id', $course->course_id)->get();
        $quiz = count($quiz);
        return view('course/home/index')->with(['course'=>$course,'enroll'=>$enroll,'slary'=>$slary,'quiz'=>$quiz]);
    }
    public function video($slug)
    {
        $course = CoursesModel::where('slug', "$slug")->first();
        if(auth()->user()->user_id != $course->instructor_id){
            return redirect()->back();
        }
        return view('course/video/index')->with(['course'=>$course]);
    }
    public function video_edit($slug)
    {
        $course = CoursesModel::where('slug', "$slug")->first();
        if(auth()->user()->user_id != $course->instructor_id){
            return redirect()->back();
        }
        return view('course/video/edit')->with(['course'=>$course]);
    }
    public function revenue($slug)
    {
        $course = CoursesModel::where('slug', "$slug")->first();
        if(auth()->user()->user_id != $course->instructor_id){
            return redirect()->back();
        }
        return view('course/revenue/index')->with(['course'=>$course]);
    }
    public function member($slug){
        
        $course = CoursesModel::where('slug', "$slug")->first();
        if(auth()->user()->user_id != $course->instructor_id){
            return redirect()->back();
        }
        return view('course/member/index')->with(['course'=>$course]);
    }
}
