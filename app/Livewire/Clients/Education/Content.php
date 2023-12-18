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
    public $videoTitles = [];
    public function addVideo()
    {
        $this->videos[] = '';

    }
 
    public function create(){

        $id = $this->course->course_id;
        $Course = CoursesModel::where('course_id', $id)->first();
        $currentpotision = CourseMaterialModel::where('course_id', $id)
        ->where('section_id', $this->section_id)
        ->max('potision');
    
    // Nếu không có bản ghi cho section hiện tại, gán vị trí bằng 0
    $currentpotision = $currentpotision ? $currentpotision : 0;
        foreach($this->videos as $key => $video){
            // Lấy giá trị tiêu đề của video
            $videoTitle = $this->videoTitles[$key];
    
            // Tiếp tục xử lý
            // ...
    
            $info = CoursesModel::where('course_id', $id)->first();
            $section = CourseSectionModel::where('course_id', $id)->where('section_id',$this->section_id)->first();
            $this->path = $video->store("courses/$info->slug/$section->slug", 'ftp');
            $this->section = $section->section_name;
            $this->section_id = $section->section_id;
             // Nếu chuyển sang section mới, reset vị trí về 1
    if ($section->section_id != $this->section_id) {
        $currentpotision = 0;
    }
            CourseMaterialModel::create([
                'course_id' => $id,
                'material_name' => $videoTitle, // Sử dụng giá trị tiêu đề ở đây
                'section_id' => $this->section_id,
                'slug' => str::slug($videoTitle),
                'material_url' => env('APP_URL').'/'.$this->path,
                'material_type' => 'video',
                'material_status' => 'active',
                'review' => '1',
                'potision' => ++$currentpotision,
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
