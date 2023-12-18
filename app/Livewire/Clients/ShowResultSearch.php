<?php

namespace App\Livewire\Clients;

use App\Models\CoursesModel;
use App\Models\PostReaction;
use App\Models\PostsComment;
use App\Models\PostsModel;
use App\Models\User;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Livewire\Component;

class ShowResultSearch extends Component
{
    public $friendData;

    public $search="";
    public $totalRecords;
    public $loadAmount = 3;
    public $postReaction;
    public $statusLike;
    public $ContentComment = [];
    public $loadComment = [];

    public $category = 0;
    public function category0(){
        $this->category = 0;
    }
    public function category1(){
        $this->category = 1;
    }
    public function category2(){
        $this->category = 2;
    }
    public function category3(){
        $this->category = 3;
    }


    public function mount(Request $request){
        $this->search= $request->get('query');

        $this->totalRecords = PostsModel::where('is_hidden', '0')->count();
        $this->loadComment = PostsModel::where('is_hidden', '0')->pluck('post_id')->toArray();
        foreach ($this->loadComment as $key => $value) {
            $this->loadComment[$value] = 3;
            $this->ContentComment[$value] = '';
    }
    }
    public function loadMore() {

        $this->loadAmount += 1;
    }
    public function loadMoreComment($post_id) {
        $this->loadComment[$post_id] += 3;
    }
    public function upLike($id)
    {
        $postReaction = PostReaction::where('post_id', $id)
            ->where('user_id', auth()->user()->user_id)
            ->first();

        $post = PostsModel::find($id);

        if ($postReaction) {
            // Đã thích, vì đã có reaction
            $post->reaction_like_count = $post->reaction_like_count - 1;
            $post->save();

            $postReaction->delete(); // Xóa reaction của người dùng

        } else {
            // Chưa thích, thêm reaction mới
            $post->reaction_like_count = $post->reaction_like_count + 1;
            $post->save();

            PostReaction::create([
                'reaction' => 'like',
                'comment_id' => 0,
                'post_id' => $id,
                'user_id' => auth()->user()->user_id,
            ]);


            // Kiểm tra số lượng reaction của người dùng cho bài viết


        }
    }


    public function Insertcomment($post_id){

        $comment = PostsComment::create([
            'node_type' => 'post',
            'user_type' => 'user',
            'text' =>$this->ContentComment[$post_id] ,
            'image' => '',
            'reaction_like_count' => 0,
            'reaction_love_count' => 0,
            'reaction_haha_count' => 0,
            'reaction_yay_count' => 0,
            'reaction_wow_count' => 0,
            'reaction_sad_count' => 0,
            'reaction_angry_count' => 0,
            'replies' => 0,
            'node_id' => $post_id,
            'user_id' => auth()->user()->user_id,
        ]);
        $post = PostsModel::find($post_id);
        $post->comments = $post->comments + 1;
        $post->save();
        $this->ContentComment[$post_id] = '';
    }


    public function render()
    {
        $friend = [];
        if(strlen($this->search >= 1)){
            $friend = User::where('user_fullname', 'LIKE', "%{$this->search}%")
            ->limit(5)->get();
        }
        $course = [];
        if(strlen($this->search >= 1)){
            $course = CoursesModel::where('course_name', 'LIKE', "%{$this->search}%")
                ->limit(5)->get();
        }
        $posts = PostsModel::where('text','LIKE',"%{$this->search}%")
            ->limit($this->loadAmount)
            ->get();


// Lấy danh sách người đăng dựa trên user_id của từng bài viết
        $userIds = $posts->pluck('user_id')->toArray();

        $users = UsersModel::whereIn('user_id', $userIds)->get();
// Gán thông tin người đăng vào mỗi bài viết
        foreach ($posts as $post) {
            $post->user = $users->where('user_id', $post->user_id)->first();
            $post->comments = PostsComment::where('node_id',  $post->post_id)->join('users', 'users.user_id', '=', 'posts_comments.user_id')->limit($this->loadComment[$post->post_id])->get();
            $post->reaction = PostReaction::where('post_id', $post->post_id)
                ->where('user_id', auth()->user()->user_id)
                ->get();
            $post->reaction_count = PostReaction::where('post_id', $post->post_id)
                ->where('user_id', auth()->user()->user_id)
                ->count();
            $commentCount = PostsComment::where('node_id', $post->post_id)->count();
        }
        return view('livewire.clients.show-result-search', [
            'friend' => $friend,
            'posts' => $posts,
            'course' => $course
        ]);
    }
}
