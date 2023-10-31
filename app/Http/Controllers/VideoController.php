<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoursesModel;
class VideoController extends Controller
{
    public $slug;
    public $course;
    public function index($slug)
    {
        $course = CoursesModel::where('slug',"$slug")->first();

        return view('clients.video.index',[
           'course' => $course,
        ]);
    }
}
