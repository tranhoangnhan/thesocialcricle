<?php

namespace App\Livewire\Clients\Education;

use App\Models\CoursesModel;
use Livewire\Component;

class Create extends Component
{
    public $step = 1;
    public $course_name;
    public $category;
    public $payment;
    public $description;

    public function next()
    {
        if ($this->step < 3) {
            $this->step=$this->step+1;
        }
    }

    public function back()
    {
        if ($this->step > 1) {
            $this->step=$this->step-1;
        }
    }
    public function create(){
        $education = CoursesModel::create([
            'course_name'=>$this->course_name,
            'category'=>$this->category,
            'payment'=>$this->payment,
            'description'=>$this->description,
        ]);
        $this->step=1;
        $this->course_name='';
        $this->category='';
        $this->payment='';
        $this->description='';
        session()->flash('message', 'Education Created Successfully.');
    }
    public function render()
    {
        return view('livewire.clients.education.create')->with(['step'=>$this->step]);
    }
}
