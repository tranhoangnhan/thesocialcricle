<?php

namespace App\Livewire\Course;

use Livewire\Component;

class Index extends Component
{
    public $course;
    public $enroll;
    public $slary;
    public $quiz;
    public function render()
    {
        return view('livewire.course.index');
    }
}
