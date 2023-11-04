<?php

namespace App\Livewire\Clients\Quiz;

use App\Models\Answer;
use App\Models\Questions;
use App\Models\quiz_result;
use App\Models\quiz_summary;
use App\Models\result_test;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Quiz extends Component
{
    public $quiz_id = 1;
    public $get_result = [];
    public $list_choice = [];
    public $mark = '';

    public function result($get_question, $get_answer, $get_choice){
        $this->get_result[$get_question] = $get_answer;
        $this->list_choice[$get_question] = $get_choice;
    }

//    public function result(){
//        $this->get_result[$this->get_question] = $this->get_answer;
//    }

    public function caculated(){
        foreach ($this->get_result as $questionId => $answerId){
            $choice =Answer::where('question_id', $questionId)->where('awswer_id', $answerId)->first();
            $question = Questions::where('question_id', $questionId)->where('quiz_id', 1)->first();
            quiz_summary::create([
                'question_id' => $questionId,
                'question_choice_id' => $this->list_choice[$questionId],
                'user_id' => Auth::id(),
                'score' => $choice->is_correct,
                'quiz_id' => 1
            ]);
        }
        $count = count($this->get_result);
        $result = quiz_summary::where('quiz_id', 1)->where('user_id', Auth::id())->orderBy('created_at', 'desc')
            ->take($count)
            ->get();
        $get_correct = $result->filter(fn ($get_answer) => $get_answer->score == 1)->count();
        $percent = ($get_correct / $result->count())*100;
        $percented = ceil($percent);
        if($percented >= 50){
            $this->mark = 'Đạt';
        }else{
            $this->mark = 'Không đạt';
        }
        quiz_result::create([
            'user_id' => Auth::id(),
            'score-percent' => $percented,
            'mark' => $this->mark,
            'quiz_id' => 1
        ]);
        $result_id = quiz_result::latest()->first()->result_id;
        return redirect()->route('quiz-thankyou',[
            'result' => $result->count(),
            'get_correct' => $get_correct,
            'result_id' => $result_id
        ]);
    }

    public function render()
    {
        return view('livewire.clients.quiz.quiz',[
            'question' => Questions::where('quiz_id', $this->quiz_id)->get(),
        ]);
    }
}
