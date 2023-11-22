<?php

namespace App\Livewire\Course;

use Livewire\Component;
use App\Models\CourseSectionModel as Section;
use App\Models\VideoModel;
use App\Models\CourseSectionModel;
use App\Models\CourseMaterialModel;
class VideoEdit extends Component
{
    public $course;
    public $section_id;
    public $slug;
    public $sections;
    public $sectionVideos;
    public $id;
    public $title = [];
    public $message = '';
    public function saveTitle($id) {
        if(!isset($this->title[$id])) {
            $this->message = '<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Thông báo!</h5>
            Tên không được để trống !
          </div>';
            return;
        }
        $titleCurent = VideoModel::where('material_id', $id)->first()->material_name;
        if($this->title[$id] == $titleCurent) {
            $this->message = '   <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Thông báo!</h5>
           Tên mới và tên hiện tại không có thay đổi !
          </div>';
            return;
        } 
        VideoModel::where('material_id', $id)->update([
            'material_name' => $this->title[$id],
        ]);
        $this->message = '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Thông báo</h5>
        Cập nhật thành công !
    </div>';
    

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
        return view('livewire.course.video-edit', [
            'sections' => $this->sections,
            'sectionVideos' => $this->sectionVideos,
        ]);
    }
}
