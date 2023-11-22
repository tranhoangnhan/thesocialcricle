<?php

namespace App\Livewire\Admin\Report;

use App\Models\ReportModel;
use Livewire\Component;

class Index extends Component
{
    public function delete($id){
        ReportModel::find($id)->delete();
    }
    public function render()
    {
        $report=ReportModel::join('users','users.user_id','=','report.user_id_reporter')
        ->join('posts','posts.post_id','=','report.post_id')
        ->join('course','course.course_id','=','report.course_id')
        ->select('report.*','users.user_fullname')
        ->get();
        foreach($report as $row){
            if($row->post_id){
                $row->content=$row->post_id;
            }
            if($row->user_id){
                $row->content=$row->post_id;
            }
            if($row->course_id){
                $row->content=$row->post_id;
            }
        }
        return view('livewire.admin.report.index',['report'=>$report]);
    }
}
