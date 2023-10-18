<?php

namespace App\Livewire\Clients;

use App\Models\PostsModel;
use App\Models\UsersModel;
use Livewire\Component;
use App\Models\PostReaction;
use App\Models\PostsComment;
use App\Events\PostLike;
use App\Models\NotificationModel;

class LoadPostController extends Component
{

    public $totalRecords;

    public $selectedPostId = null;
    public $displayedCommentIds = [];

    public $loadAmount;
    public $loadComment = 3;

    public $ContentComment = [];
    public function mount(){
        $this->totalRecords = PostsModel::where('is_hidden', '0')->count();
    }
    public function loadMore()
    {
        $this->loadAmount += 3;
    }
    public function moreComment($postId)
    {
        if ($this->selectedPostId != $postId) {
            // Đặt lại loadComment về 3 khi bạn chuyển sang bài viết khác
            $this->loadComment = 3;
        }
        $this->selectedPostId = $postId;
        $this->displayedCommentIds = array_merge(
            $this->displayedCommentIds,
            PostsComment::where('node_id', $postId)
                ->limit($this->loadComment)
                ->pluck('comment_id')
                ->toArray()
        );
        $this->loadComment += 3;
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
            if(auth()->user()->user_id != $post->user_id){
                NotificationModel::create([
                   'from_user_id'=>auth()->user()->user_id,
                     'to_user_id'=>$post->user_id,
                     'action'=>'like',
                     'node_type'=>'post',
                     'node_url'=>$post->post_id,
                     'message'=>auth()->user()->user_fullname.' Đã thích bài viết của bạn',
                     'time'=>date('Y-m-d H:i:s'),
                ]);
                event(new PostLike(auth()->user()->user_fullname.' Đã thích bài viết của bạn',auth()->user(),$post->user_id));
            }
    }
}
    public function Insertcomment($post_id)
    {
        $comment = PostsComment::create([
            'node_type' => 'post',
            'user_type' => 'user',
            'text' => $this->ContentComment[$post_id],
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
        if(auth()->user()->user_id != $post->user_id){
            NotificationModel::create([
               'from_user_id'=>auth()->user()->user_id,
                 'to_user_id'=>$post->user_id,
                 'action'=>'comment',
                 'node_type'=>'post',
                 'node_url'=>$post->post_id,
                 'message'=>auth()->user()->user_fullname.' đã bình luận một bài viết của bạn',
                 'time'=>date('Y-m-d H:i:s'),
            ]);
            event(new PostLike(auth()->user()->user_fullname.' đã bình luận một bài viết của bạn',auth()->user()));
        }
    }
    public function render()
    {
        $posts = PostsModel::where('is_hidden', '0')
            ->limit($this->loadAmount)
            ->get();
        $this->loadAmount = 3;

        // Lấy danh sách người đăng dựa trên user_id của từng bài viết
        $userIds = $posts->pluck('user_id')->toArray();

        $users = UsersModel::whereIn('user_id', $userIds)->get();
        // Gán thông tin người đăng vào mỗi bài viết
        foreach ($posts as $post) {
            $post->user = $users->where('user_id', $post->user_id)->first();
            $post->reaction = PostReaction::where('post_id', $post->post_id)
                ->where('user_id', auth()->user()->user_id)
                ->count();
            $post->comments = PostsComment::where('node_id',  $post->post_id)->join('users', 'users.user_id', '=', 'posts_comments.user_id')->limit(3)->get();

            if ($post->post_id === $this->selectedPostId) {
                $post->additionalComments = PostsComment::where('node_id', $post->post_id)
                    ->join('users', 'users.user_id', '=', 'posts_comments.user_id')
                    ->whereNotIn('comment_id', $this->displayedCommentIds)
                    ->limit($this->loadComment)
                    ->get();
            } else {
                $post->additionalComments = [];
            }

        }

        return view('livewire.clients.load-post-controller')
            ->with(['posts' => $posts]);
    }
}
