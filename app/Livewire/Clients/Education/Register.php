<?php

namespace App\Livewire\Clients\Education;

use Livewire\Component;
use App\Models\CoursesModel;
use Illuminate\Support\Str;
use App\Models\CourseCategoryModel;
use App\Models\CourseSectionModel;

class Register extends Component
{
    public $course_name;
    public $category;
    public $payment;
    public $description;
    public $banner;
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
            'required_skill'=>json_encode($this->skills),
            'learn_skill'=>json_encode($this->learns),
        ]);
        foreach($this->contents as $content){
            $secsion=CourseSectionModel::create([
                'course_id'=>$education->course_id,
                'section_name'=>$content,
                'slug'=>str::slug($content),
            ]);
        }
    }

    public function render()
    {

        return view('livewire.clients.education.register')->with(['Categories'=> CourseCategoryModel::all()]);
    }
}
