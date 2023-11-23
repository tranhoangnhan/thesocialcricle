<?php

namespace App\Livewire\Clients\Quiz;

use App\Models\Answer;
use App\Models\Questions;
use App\Models\quiz_result;
use App\Models\quiz_summary;
use App\Models\result_test;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Quiz extends Component
{
    use WithPagination;

    public $slug;
    public $quiz_id;
    public $quiz_name;
    public $get_result = [];
    public $list_choice = [];
    public $mark = '';

    public $course;

    public function mount(){
        $this->slug = request()->route('quiz');
        $this->quiz_name = \App\Models\Quiz::where('quiz_name', $this->slug)->first();
        $this->quiz_id = $this->quiz_name->quiz_id;
    }

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
            $question = Questions::where('question_id', $questionId)->where('quiz_id', $this->quiz_id)->first();
            quiz_summary::create([
                'question_id' => $questionId,
                'question_choice_id' => $this->list_choice[$questionId],
                'user_id' => Auth::id(),
                'score' => $choice->is_correct,
                'quiz_id' => $this->quiz_id
            ]);
        }
        $count = count($this->get_result);
        $result = quiz_summary::where('quiz_id', $this->quiz_id)->where('user_id', Auth::id())->orderBy('created_at', 'desc')
            ->take($count)
            ->get();
        $get_correct = $result->filter(fn ($get_answer) => $get_answer->question_choice_id == 1)->count();
        $percent = ($get_correct / $result->count())*100;
        $percented = ceil($percent);
        if($percented >= 50){
            $this->mark = 'Đạt';
        }else{
            $this->mark = 'Không đạt';
        }
        quiz_result::create([
            'user_id' => Auth::user()->user_id,
            'score-percent' => $percented,
            'mark' => $this->mark,
            'quiz_id' => $this->quiz_id
        ]);
        $result_id = quiz_result::latest()->first()->result_id;
        return redirect()->route('quiz-thankyou', [$result_id, $get_correct, $result->count()]);
    }


    public function render()
    {
        return view('livewire.clients.quiz.quiz',[
            'question' => Questions::where('quiz_id', $this->quiz_id)->paginate(10),
        ]);
    }
}
