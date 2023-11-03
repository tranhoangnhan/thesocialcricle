<?php

namespace App\Livewire\Clients\Video;

use App\Models\VideoModel;
use DateTime;
use Livewire\Component;
use App\Models\CoursesModel;
use App\Models\CourseSectionModel;
use App\Models\CourseMaterialModel;
use App\Models\CourseSectionModel as Section;
use App\Models\EnrollmentModel;
class Index extends Component
{   public $slug;
    public $video;
    public $related;
    public $course;
    public $slug_video;
    
    public function mount()
    {
        $this->slug = request()->route('slug');
        $this->course = CoursesModel::where('slug', $this->slug)->first();
         $id = $this->course->course_id;

        $sections = Section::where('course_id', $this->course->course_id)->get();
        $check_enroll = EnrollmentModel::where('course_id', $id)->where('user_id',auth()->user()->user_id)->first();
        if(!$check_enroll){
            
            return redirect()->route('Courses');
        }
        // Tạo một mảng để lưu trữ các video cho mỗi section
        $sectionVideos = [];
    
        foreach ($sections as $section) {
            // Lấy danh sách video cho từng section
            $sectionVideos[$section->section_id] = VideoModel::where('section_id', $section->section_id)->get();
        }
      // Gán danh sách section và video vào các thuộc tính của Livewire
    $this->sections = $sections;
    $this->sectionVideos = $sectionVideos;

    $this->slug_video = request()->route('video');
    $id = $this->course->course_id;
    $this->video = VideoModel::where('slug', $this->slug_video)->where('course_id', $id)->first();

    if ($this->video) {
        $this->related = VideoModel::where('course_id', $this->video->course_id)->get();
    } else {
        return redirect()->route('Courses');
    }
    }

    public function render()
    {
        

        return view('livewire.clients.video.index', [
            'videos' => $this->video,
            'related' => $this->related,
            'sections' => $this->sections,
            'sectionVideos' => $this->sectionVideos,
            
           
        ]);
    }
}
