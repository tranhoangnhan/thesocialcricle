<?php

namespace App\Livewire\Clients\Feedback;

use App\Models\FeedBackModel;
use Livewire\Component;

class Index extends Component
{
    public $name;
    public $email;
    public $content;
    public function mount()
    {
        $this->name = auth()->user()->user_fullname;
        $this->email = auth()->user()->user_email;
    }
    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
        'content' => 'required|min:6',
    ];
    protected $messages = [
        'name.required' => 'Vui lòng nhập tên.',
        'name.min' => 'Tên phải có ít nhất 6 ký tự.',
        'email.required' => 'Vui lòng nhập email.',
        'email.email' => 'Email không đúng định dạng.',
        'content.required' => 'Vui lòng nhập nội dung.',
        'content.min' => 'Nội dung phải có ít nhất 6 ký tự.',
    ];
    public function submit()
    {
        $this->validate();
        FeedBackModel::create([
            'name' => $this->name,
            'email' => $this->email,
            'content' => $this->content,
        ]);
    }
    public function render()
    {
        return view('livewire.clients.feedback.index');
    }
}
