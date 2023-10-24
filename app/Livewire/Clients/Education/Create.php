<?php

namespace App\Livewire\Clients\Education;

use App\Models\CoursesModel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\CourseCategoryModel;
use App\Models\CourseSecsionModel;

class Create extends Component

{
    use WithFileUploads;
    public $course_name;
    public $category;
    public $payment;
    public $description;
    public $skills = [''];
    public $contents=[''];
    public $learns=[''];
    public $showct;
    public function addSkill()
    {
        $this->skills[] = '';

    }
    public function addContent()
    {
        $this->contents[] = '';
    }
    public function addLearn()
    {
        $this->learns[] = '';

    }
    public function create(){
        $education = CoursesModel::create([
            'course_name'=>$this->course_name,
            'slug'=>str::slug($this->course_name),
            'category_id'=>$this->category,
            'payment'=>$this->payment,
            'description'=>$this->description,
            'banner'=>'banner',
            'instructor_id'=>auth()->user()->user_id,
            'require_skill'=>json_encode($this->skills),
            'learn_skill'=>json_encode($this->learns),
        ]);
        foreach($this->contents as $content){
            $secsion=CourseSecsionModel::create([
                'course_id'=>$education->course_id,
                'secsion_name'=>$content,
                'secsion_slug'=>str::slug($content),
            ]);
        }
    }
    public function render()
    {
        $this->showct = CourseCategoryModel::all();

        return view('livewire.clients.education.create')->with(['Categories'=> $this->showct]);
    }
}
