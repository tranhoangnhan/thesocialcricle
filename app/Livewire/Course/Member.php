<?php

namespace App\Livewire\Course;

use Livewire\Component;
use App\Models\EnrollmentModel;

class Member extends Component
{
    public $course;
 
    public function render()
    {
        $enroll = EnrollmentModel::select('enrollment.*','users.user_fullname')->join('users','users.user_id','=','enrollment.user_id')->where('enrollment.course_id',$this->course->course_id)->get();
        $count_enroll = count($enroll);
        return view('livewire.course.member',['enrolls'=>$enroll,'count_enroll'=>$count_enroll]);
    }
}
