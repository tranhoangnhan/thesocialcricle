<?php

namespace App\Livewire\Clients\Quiz;

use App\Models\quiz_result;
use Livewire\Component;

class QuizThankyou extends Component
{
    public $result_id;
    public $get_correct;
    public $result;
    public $count;

    public function mount($result_id, $get_correct, $count)
    {
        $this->get_correct = $get_correct;
        $this->result_id = $result_id;
        $this->count = $count;
        return $this->render();
    }

    public function render()
    {
        return view('livewire.clients.quiz.quiz-thankyou',[
            'count_correct' => $this->get_correct,
            'count' => $this->count,
            'data' => quiz_result::where('result_id', $this->result_id)->get()
        ]);
    }
}
