<?php

namespace App\Livewire\Clients\Education;

use Livewire\Component;
use App\Models\CoursesModel;
use Illuminate\Support\Str;
class Index extends Component
{
    public function render()
    {   
     
        return view('livewire.clients.education.index',['courses'=>CoursesModel::all()]);
    }
}
