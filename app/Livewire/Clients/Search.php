<?php

namespace App\Livewire\Clients;

use App\Models\CoursesModel;
use App\Models\PostsModel;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Search extends Component
{
    public $friendData;

    public $search = "", $post = [], $friend = [], $course = [];


    public function updatedSearch($search)
    {
        $this->$search = $search;
        $this->dispatch('search');
    }
    #[On('search')]
    public function search()
    {

        if (strlen($this->search >= 1)) {
            $this->post = PostsModel::where('text', 'LIKE', "%{$this->search}%")
                ->limit(3)->get();
        }
        if (strlen($this->search >= 1)) {
            $this->friend = User::where('user_fullname', 'like', '%' . $this->search . '%')
                ->get();
        }
        if (strlen($this->search >= 1)) {
            $this->course = CoursesModel::where('course_name', 'like', '%' . $this->search . '%')
                ->get();
        }
    }
    public function render()
    {
        $this->search();
        return view('livewire.clients.search');
    }
}
