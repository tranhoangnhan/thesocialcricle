<?php

namespace App\Livewire\Clients\Posts;
use App\Models\PostsModel;
use Livewire\Component;

class Post extends Component
{
    public $content;
    public $privacy;
    public function createPostIndex() {
        $post = new PostsModel();
        $post->user_id = auth()->user()->user_id;
        $post->user_type = 'user';
        $post->post_type = 'text';
      
        $post->text = request()->content;
        $post->privacy = request()->privacy;
        $post->save();
        return redirect()->back();
    }
    public function render()
    {
        return view('livewire.clients.posts.post');
    }
}
