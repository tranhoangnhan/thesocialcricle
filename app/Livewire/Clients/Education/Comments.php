<?php

namespace App\Livewire\Clients\Education;

use App\Models\CommentCourseModel;
use Livewire\Component;

class Comments extends Component
{
    public $course;
    public $content;
    public $count;
    public function comment(){
        CommentCourseModel::create([
            'user_id'=>auth()->user()->user_id,
            'comment'=>$this->content,
            'course_id'=>$this->course->course_id,
        ]);
        $this->content='';
    }
    public function render()
    {
        $comments=CommentCourseModel::join('users','users.user_id','=','comment_course.user_id')
        ->select('comment_course.*','users.user_fullname','users.user_avatar')
        ->where('course_id',$this->course->course_id)
        ->orderBy('comment_course.created_at','desc')
        ->get();
        foreach ($comments as $comment) {
            $comment->date=date('d-m-Y',strtotime($comment->created_at));
        }
        $this->count=count($comments);
        return view('livewire.clients.education.comments',['comments'=>$comments,'count'=>$this->count]);
    }
}
