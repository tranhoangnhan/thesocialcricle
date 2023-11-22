<?php

namespace App\Livewire\Admin\Course;

use App\Models\CoursesModel;
use Livewire\Component;

class Index extends Component
{
    public function accept($id)
    {
        $course = CoursesModel::find($id);
        if($course->status == 0){
            $course->status = '1';
        }
        else{
            $course->status = '0';
        }
        $course->save();
    }
    public function render()
    {
        $courses = CoursesModel::join('course_category', 'course_category.category_id', '=', 'course.category_id')
            ->join('users', 'users.user_id', '=', 'course.instructor_id')
            ->select('course.*', 'course_category.category_name as category_name', 'users.user_fullname as user_name')
            ->get();
        foreach ($courses as $course) {
            if ($course->status == 1) {
                $course->status = 'Đang chờ duyệt';
            } else {
                $course->status = 'Đã được duyệt';
            }
        }
        return view('livewire.admin.course.index', ['courses' => $courses]);
    }
}
