<?php

namespace App\Livewire\Clients\Education;

use Livewire\Component;

class Create extends Component
{
    public $step = 1;
    public $course_name;

    public function next()
    {
        if ($this->step < 3) {
            $this->step++;
        }
    }

    public function back()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }
    public function render()
    {
        return view('livewire.clients.education.create')->with(['step'=>$this->step]);
    }
}
