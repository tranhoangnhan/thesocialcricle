<?php

namespace App\Livewire\Clients\Education;

use Livewire\Component;
use App\Models\VideoModel;
use App\Models\CourseSectionModel;
use App\Models\CourseMaterialModel;

use App\Models\CourseSectionModel as Section;
class ControlEducation extends Component
{
    public $course;
    public $section_id;
    public $slug;
    public $title;
    public function mount() {
        if (auth()->user()->user_id == $this->course->instructor_id) {
            return redirect()->route('Courses');
        }
        return redirect()->route('home');
    }
    public function saveTitle() {
        VideoModel::where('section_id', $this->section_id)->where('slug', $this->slug)->update([
            'material_name' => $this->title,
        ]);
    }
    public function upPotision($section_id, $slug) {
        $video = VideoModel::where('section_id', $section_id)->where('slug', $slug)->first();
    
        if ($video->potision == 1) {
            return redirect()->back();
        }
    
        $previousVideo = VideoModel::where('section_id', $section_id)
            ->where('potision', $video->potision - 1)
            ->first();
    
        if ($previousVideo) {
            \DB::transaction(function () use ($video, $previousVideo) {
                $video->decrement('potision');
                $previousVideo->increment('potision');
            });
        }
    
        return redirect()->back();
    }
    
    public function downPotision($section_id, $slug) {
        $video = VideoModel::where('section_id', $section_id)->where('slug', $slug)->first();
    
        $nextVideo = VideoModel::where('section_id', $section_id)
            ->where('potision', $video->potision + 1)
            ->first();
        
        if ($nextVideo) {
            \DB::transaction(function () use ($video, $nextVideo) {
                $video->increment('potision');
                $nextVideo->decrement('potision');
            });
        }
    
        return redirect()->back();
    }
    
    
    public function render()
    {
      
        $sections = Section::where('course_id', $this->course->course_id)->get();
        $sectionVideos = [];

        foreach ($sections as $section) {
            $videos = VideoModel::where('section_id', $section->section_id)->orderBy('potision','asc')->get();
            $sectionVideos[$section->section_id] = $videos;
            
            // Kiểm tra xem video đầu tiên có phải là video có potision cao nhất không
          
            
         
        }
        $this->sections = $sections;
        $this->sectionVideos = $sectionVideos;

        return view('livewire.clients.education.control-education', [
            'sections' => $this->sections,
            'sectionVideos' => $this->sectionVideos,
        ]);
    }
}