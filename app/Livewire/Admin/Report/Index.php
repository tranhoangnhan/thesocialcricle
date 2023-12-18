<?php

namespace App\Livewire\Admin\Report;

use App\Models\CoursesModel;
use App\Models\PostsModel;
use App\Models\ReportModel;
use App\Models\User;
use App\Models\UsersModel;
use Livewire\Component;

class Index extends Component
{
    public $option=0,$report;
    public function delete($id){
        ReportModel::find($id)->delete();
    }
    public function block($id){
       if($this->option==0){
            $post=PostsModel::find($id);
            $post->isblock=true;
            $post->save();
       }
       else if($this->option==1){
            $user=UsersModel::find($id);
            $user->user_banned=1;
            $user->save();
       }
       else{
            $course=CoursesModel::find($id);
            $course->status=1;
            $course->save();
       }
    }
    public function changeOption(){
        if($this->option==0){
            $this->report=ReportModel::join('posts','posts.post_id','=','report.post_id')
            ->where('report.post_id','!=',null)
            ->select('report.*','posts.text as post_title')
            ->get();
        }
        else if($this->option==1){
            $this->report=ReportModel::join('users','users.user_id','=','report.user_id')
            ->where('report.user_id','!=',null)
            ->select('report.*','users.user_fullname as user_name','users.user_banned as user_banned')
            ->get();
        }
        else{
            $this->report=ReportModel::join('course','course.course_id','=','report.course_id')
            ->where('report.course_id','!=',null)
            ->select('report.*','course.course_name as course_name','course.slug as course_slug')
            ->get();
        }
    }
    public function render()
    {
        $this->changeOption();
        return view('livewire.admin.report.index',['report'=>$this->report,'option'=>$this->option]);
    }
}
