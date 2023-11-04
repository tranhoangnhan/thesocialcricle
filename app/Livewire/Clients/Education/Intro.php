<?php

namespace App\Livewire\Clients\Education;

use Livewire\Component;
use App\Models\EnrollmentModel;
use App\Models\CoursesModel;

class Intro extends Component
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
        $userEnrollments = $this->fetchEnrollmentsForUser();
        $enroller = in_array($this->course->course_id, $userEnrollments);
        $enroll = EnrollmentModel::where('course_id', $this->course->course_id)->count();
        $time = date('d/m/y', strtotime($this->course->created_at));
        return view('livewire.clients.education.intro', ['enroll' => $enroll, 'enroller' => $enroller, 'time' => $time]);
    }
}
