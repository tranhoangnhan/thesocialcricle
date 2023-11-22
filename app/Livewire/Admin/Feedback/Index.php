<?php

namespace App\Livewire\Admin\Feedback;

use App\Models\FeedBackModel;
use Livewire\Component;

class Index extends Component
{
    public function delete($id){
        FeedBackModel::find($id)->delete();
    }
    public function render()
    {
        $feedback=FeedBackModel::all();
        return view('livewire.admin.feedback.index',['feedback'=>$feedback]);
    }
}
