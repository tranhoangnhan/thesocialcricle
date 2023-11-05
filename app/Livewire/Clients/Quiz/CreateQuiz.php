<?php

namespace App\Livewire\Clients\Quiz;

use App\Models\Answer;
use App\Models\Questions;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Quiz;

class CreateQuiz extends Component
{
    use WithPagination;

    public $course;

    public $quiz_name = '';
    public $quiz_descript = '';
    public $deletequizId = '';

    public $question_content = '';
    public $quiz_id = '';
    public $question_id = '';
    public $awswer_content1 = '';
    public $awswer_content2 = '';
    public $awswer_content3 = '';
    public $awswer_content4 = '';
    public $is_correct1 = 0;
    public $is_correct2 = 0;
    public $is_correct3 = 0;
    public $is_correct4 = 0;
    public $alt_is_correct1 = 'A';
    public $alt_is_correct2 = 'B';
    public $alt_is_correct3 = 'C';
    public $alt_is_correct4 = 'D';
    public $deleteId = '';

    public $updateId = '';
    public $question_content_update = '';
    public $answer_content_update = '';
    public $choice = '';

    public function createquiz(){
        $quiz = Quiz::create([
            'quiz_name' => $this->quiz_name,
            'description' => $this->quiz_descript,
            'course_id' => $this->course->course_id,
        ]);
        $quiz->save();
    }

    public function storeQuestion(){
//        thêm câu hỏi
        $question = Questions::create([
            'question_content' => $this->question_content,
            'quiz_id' => $this->quiz_id,
        ]);
        $question->save();
        if ($question->save()){
            $this->question_id = Questions::latest()->first()->question_id;;
        }

//        thêm 4 câu trả lời
        $answer = Answer::create([
                'awswer_content' => $this->awswer_content1,
                'is_correct' => $this->is_correct1,
                'question_id' => $this->question_id,
        ]);
//
        if ($this->is_correct1 == 1){
            $questionToUpdate = Questions::find($this->question_id);
            $questionToUpdate->update([
                'correct_awswer' => "$this->alt_is_correct1",
            ]);
        }
        $answer->save();
        $answer = Answer::create([
            'awswer_content' => $this->awswer_content2,
            'is_correct' => $this->is_correct2,
            'question_id' => $this->question_id,
        ]);

        if ($this->is_correct2 == 1){
            $questionToUpdate = Questions::find($this->question_id);
            $questionToUpdate->update([
                'correct_awswer' => "$this->alt_is_correct2",
            ]);
        }
        $answer->save();
        $answer = Answer::create([
            'awswer_content' => $this->awswer_content3,
            'is_correct' => $this->is_correct3,
            'question_id' => $this->question_id,
        ]);

        if ($this->is_correct3 == 1){
            $questionToUpdate = Questions::find($this->question_id);
            $questionToUpdate->update([
                'correct_awswer' => "$this->alt_is_correct3",
            ]);
        }
        $answer->save();
        $answer = Answer::create([
            'awswer_content' => $this->awswer_content4,
            'is_correct' => $this->is_correct4,
            'question_id' => $this->question_id,
        ]);

        if ($this->is_correct4 == 1){
            $questionToUpdate = Questions::find($this->question_id);
            $questionToUpdate->update([
                'correct_awswer' => "$this->alt_is_correct4",
            ]);
        }
        $answer->save();
        }

    public function store($id){
        $this->quiz_id = $id;
    }
    public function deletequiz($id){
        $this->deletequizId = $id;
    }
    public function deletequizconfirm()
    {
        $delete = Quiz::find($this->deletequizId);
        $delete->delete();
        $this->reset('deletequizId');
    }

    public function delete($id){
        $this->deleteId = $id;
    }

    public function deleteconfirm()
    {
        $delete = Questions::find($this->deleteId);
        $delete->answer()->delete();
        $delete->delete();
        $this->reset('deleteId');
    }

    public function findupdateId($id, $question_content)
    {
        $this->updateId = $id;
        $this->question_content_update = $question_content;
    }

    public function render()
    {
        return view('livewire.clients.quiz.create-quiz', [
            'question' => Questions::where('quiz_id', $this->quiz_id)->paginate(10),
            'updateId' => Questions::where('quiz_id', $this->updateId)->get(),
            'quiz' => Quiz::where('course_id', $this->course->course_id)->get(),
        ]);
    }
}
