<?php

namespace App\Livewire\Clients\Education;

use Livewire\Component;
use App\Models\CoursesModel;
use Illuminate\Support\Str;
use App\Models\EnrollmentModel;
class Index extends Component
{
 
    public function enroll($id)
    {
       
         EnrollmentModel::create([
           
            'user_id'=>auth()->user()->user_id,
            'course_id'=>$id
        ]);
        
       
        
      

    }
    

    public function render()
    {   
        
        return view('livewire.clients.education.index',['courses'=>CoursesModel::all()
    
    ]);
    }
}
