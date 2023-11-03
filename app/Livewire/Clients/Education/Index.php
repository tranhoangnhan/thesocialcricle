<?php

namespace App\Livewire\Clients\Education;

use Livewire\Component;
use App\Models\CoursesModel;
use Illuminate\Support\Str;
use App\Models\EnrollmentModel;
class Index extends Component
{
 
  
    

    public function render()
    {   
        $courses = CoursesModel::all();
        foreach($courses as $course){
            $course->count_enroll = EnrollmentModel::where('course_id', $course->course_id)->count();
        }

        return view('livewire.clients.education.index',['courses'=>$courses]);
        
    
    }
}
