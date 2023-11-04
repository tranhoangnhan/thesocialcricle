<?php

namespace App\Livewire\Clients\Quiz;

use Livewire\Component;

class QuizThankyou extends Component
{
    public $result_id;
    public $get_correct;
    public $result;

    public function ok($result, $get_correct, $result_id){
        $this->get_correct = $get_correct;
        $this->result = $result;
        $this->result_id = $result_id;
    }

    public function render()
    {
        return view('livewire.clients.quiz.quiz-thankyou');
    }
}
