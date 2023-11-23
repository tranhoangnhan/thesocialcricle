<?php

namespace App\Livewire\Clients\Education;

use App\Models\CourseCategoryModel;
use Livewire\Component;
use App\Models\CoursesModel;
use Illuminate\Support\Str;
use App\Models\EnrollmentModel;

class Index extends Component
{
    public $course;

    public function enroll($id)
    {
        $enrollment = EnrollmentModel::where('user_id', auth()->user()->user_id)
            ->where('course_id', $id)
            ->first();

        if ($enrollment) {
            $enrollment->delete();
        } else {
            EnrollmentModel::create([
                'user_id' => auth()->user()->user_id,
                'course_id' => $id
            ]);
        }
    }

    private function fetchEnrollmentsForUser()
    {
        $enrollments = EnrollmentModel::where('user_id', auth()->user()->user_id)
            ->pluck('course_id')
            ->all();
        return $enrollments;
    }

    public function render()
    {
        $courses = CoursesModel::join('course_category', 'course_category.category_id', '=', 'course.category_id')
        ->join('users', 'users.user_id', '=', 'course.instructor_id')
        ->join('enrollment', 'enrollment.course_id', '=', 'course.course_id')
        ->where('enrollment.user_id', auth()->user()->user_id)
        ->where('course.status', '1')
            ->select('course.*', 'course_category.category_name','users.user_fullname')
            ->get();
        $userEnrollments = $this->fetchEnrollmentsForUser();
        foreach ($courses as $course) {
            $course->enroller = in_array($course->course_id, $userEnrollments);
            $course->enroll = EnrollmentModel::where('course_id', $course->course_id)->count();
        }
        return view('livewire.clients.education.index', ['courses' => $courses]);

    }
}
