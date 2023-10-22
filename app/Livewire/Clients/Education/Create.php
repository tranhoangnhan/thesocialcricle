<?php

namespace App\Livewire\Clients\Education;

use App\Models\CoursesModel;
use Livewire\Component;
use Livewire\WithFileUploads;
class Create extends Component

{
    use WithFileUploads;
    public $step = 1;
    public $course_name;
    public $category;
    public $payment;
    public $description;
    public $banner;
    public $skills = [''];
    public $contents=[''];

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
            'banner'=>$this->banner,
            'instructor_id'=>auth()->user()->user_id,
            'require_skill'=>json_encode($this->skills),
            'learn_skill'=>json_encode($this->contents),
        ]);
        session()->flash('message', 'Education Created Successfully.');
    }
    public function addSkill()
    {
        $this->skills[] = '';
    }
    public function addContent()
    {
        $this->contents[] = '';
    }
    public function render()
    {
        return view('livewire.clients.education.create')->with(['step'=>$this->step]);
    }
}
