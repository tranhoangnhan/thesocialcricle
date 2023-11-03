<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoursesModel;
use App\Models\CourseMaterialModel;
class VideoController extends Controller
{
    public $slug;
    public $course;
    public $video;
    public function index($slug,$video)
    {
        $course = CoursesModel::where('slug',"$slug")->first();
        $change_video = CourseMaterialModel::where('slug',"$video")->first();
        return view('clients.video.index',[
           'course' => $course,
           'video' => $change_video,
            
        ]);
    }
  
}
