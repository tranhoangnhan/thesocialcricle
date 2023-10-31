<?php

namespace App\Livewire\Clients\Video;

use App\Models\VideoModel;
use DateTime;
use Livewire\Component;
use App\Models\CoursesModel;
class Index extends Component
{   public $slug;
    public $video;
    public $related;
    public $course;
    public function mount()
    {
        
        $id = $this->course->course_id;
        $this->video = VideoModel::where('course_material.course_id', $id)
            ->join('course', 'course.course_id', '=', 'course_material.course_id')
            ->select('course_material.*', 'course.course_name')
            ->first();

        if ($this->video) {
            $this->related = VideoModel::where('course_id', $this->video->course_id)->get();
        }
    }

    public function render()
    {
     

        return view('livewire.clients.video.index', [
            'videos' => $this->video,
            'related' => $this->related,
           
        ]);
    }
}
