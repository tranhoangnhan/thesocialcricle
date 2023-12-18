<?php

namespace App\Livewire\Admin\Feedback;

use App\Models\FeedBackModel;
use Livewire\Component;
use Carbon\Carbon;

class Index extends Component
{
    public function delete($id){
        FeedBackModel::find($id)->delete();
    }
    public function render()
    {
        $feedback=FeedBackModel::all();
        foreach($feedback as $f){
            $f->created_at=$f->created_at->format('d-m-Y');
        }
        return view('livewire.admin.feedback.index',['feedback'=>$feedback]);
    }
}
