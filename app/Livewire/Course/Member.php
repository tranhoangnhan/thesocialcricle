<?php

namespace App\Livewire\Course;

use Livewire\Component;
use App\Models\EnrollmentModel;

class Member extends Component
{
    public $course;
    public function delete($user_id)
    {
        $id = EnrollmentModel::where('user_id',$user_id)->first()->enrollment_id;
        $enroll = EnrollmentModel::find($id);
        $enroll->delete();
        session()->flash('success','Xóa thành viên thành công');
    }
    public function render()
    {
        $enroll = EnrollmentModel::select('enrollment.*','users.user_fullname')->join('users','users.user_id','=','enrollment.user_id')->where('enrollment.course_id',$this->course->course_id)->get();
        $count_enroll = count($enroll);
        return view('livewire.course.member',['enrolls'=>$enroll,'count_enroll'=>$count_enroll]);
    }
}
