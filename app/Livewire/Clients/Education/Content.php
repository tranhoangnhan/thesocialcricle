<?php

namespace App\Livewire\Clients\Education;

use Livewire\Component;
use App\Models\CoursesModel;
use Illuminate\Support\Str;
use App\Models\CourseCategoryModel;
use App\Models\CourseSectionModel;
use App\Models\CourseMaterialModel;
use Livewire\WithFileUploads;

class Content extends Component
{
    use WithFileUploads;

    public $videos;
    public $title;
    public $message;
    public $nameCourse; // Declare nameCourse as a property
    public $section;    // Declare section as a property
    public $slug;
    public $section_id;
    public $course;
    public function addVideo()
    {
        $this->videos[] = '';
        $this->title[] = '';
    }
    public function create(){
      
        $id = $this->course->course_id;
      
        $Course = CoursesModel::where('course_id',"$id")->first();
        foreach($this->videos as $video){
            
                $info = CoursesModel::where('course_id', $id)->first();
                $section = CourseSectionModel::where('course_id', $id)->where('section_id',$this->section_id)->first();
                $this->path = $video->store("courses/$info->slug/$section->slug", 'ftp');
                $this->section = $section->section_name;
                $this->section_id = $section->section_id;
               
                CourseMaterialModel::create([
                    'course_id' => $id,
                    'material_name' => $this->section,
                    // 'section_id' => $this->section_id,
                    'material_url' => 'https://hoangnhan.ddns.net/cdn/'.$this->path,
                    'material_type' => 'video',
                    'material_status' => 'active',
                ]);
           
        }
        return redirect()->route('courses_register_content', ['slug' => $Course->slug]);
    }
    public function render()
    {
       $slug = $this->course->slug;
        $course = CoursesModel::where('slug', $slug)->first();
        $this->nameCourse = $course;
        $this->section = CourseSectionModel::where('course_id', $course->course_id)->get();
        
        return view('livewire.clients.education.content', ['Section' => $this->section, 'nameCourse' => $this->nameCourse, 'slug' => $slug]);
    }
}
