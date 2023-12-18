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
    public $categoryFilter;
    public $search = "", $post = [], $friend = [], $course = [];


    public function updatedSearch($search)
    {
        $this->$search = $search;
        $this->dispatch('search');
    }
    public function applyFilter(){
        $this->reset('post', 'course', 'friend');
    }

    #[On('search')]
    public function search()
    {
        if (strlen($this->search >= 1 && $this->categoryFilter == 3)) {
            $this->post = PostsModel::where('text', 'LIKE', "%{$this->search}%")
                ->limit(10)->get();
        }
        elseif (strlen($this->search >= 1 && $this->categoryFilter == 2)) {
            $this->friend = User::where('user_fullname', 'LIKE', "%{$this->search}%")
                ->limit(10)->get();
        }
        elseif (strlen($this->search >= 1 && $this->categoryFilter == 1)) {
            $this->course = CoursesModel::where('course_name', 'LIKE', "%{$this->search}%")
                ->limit(10)->get();
        }

        if (strlen($this->search >= 1 && $this->categoryFilter == 0)){
            $this->course = CoursesModel::where('course_name', 'like', '%' . $this->search . '%')
                ->limit(5)->get();
            $this->friend = User::where('user_fullname', 'like', '%' . $this->search . '%')
                ->limit(5)->get();
            $this->post = PostsModel::where('text', 'LIKE', "%{$this->search}%")
                ->limit(5)->get();
        }
    }
    public function render()
    {
        $this->search();
        return view('livewire.clients.search');
    }
}
