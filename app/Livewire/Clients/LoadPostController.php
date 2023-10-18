<?php

namespace App\Livewire\Clients;
use App\Models\PostsModel;
use App\Models\UsersModel;
use Livewire\Component;
use App\Models\PostReaction;
use App\Models\PostsComment;

class LoadPostController extends Component
{
    public $emit;
    public $totalRecords;
    public $loadAmount = 3;
    public $postReaction;
    public $statusLike;
    public $posts;

    public $ContentComment = [];
    public $loadComment = [];
    public function mount()
    {
        $this->totalRecords = PostsModel::where('is_hidden', '0')->count();
        $this->loadComment = PostsModel::where('is_hidden', '0')->pluck('post_id')->toArray();
        foreach ($this->loadComment as $key => $value) {
            $this->loadComment[$value] = 3;
            $this->ContentComment[$value] = '';
        }
 

        
    }
    public function loadMore() {
  
        $currentCount = count($this->posts);

        if ($currentCount >= $this->totalRecords) {
            $newPosts = PostsModel::where('is_hidden', '0')
                ->where('privacy', 'public')
                ->skip($currentCount)
                ->take(3)
                ->get();
    
            if ($newPosts->isNotEmpty()) {
                $this->loadAmount += 5;
    
                // Cập nhật giá trị loadComment cho bài viết mới
                foreach ($newPosts as $newPost) {
                    $this->loadComment[$newPost->post_id] = 5;
                }
    
                $this->posts = $this->posts->concat($newPosts);
            }
        } else {
            $this->loadAmount += 5;
        }
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
       

     
       
    }
}

    
        public function Insertcomment($post_id){
            
            $commentText = $this->ContentComment[$post_id];
    
            // Kiểm tra xem nội dung bình luận có rỗng không
            if (preg_match('/^\s*$/', $commentText)) {
                // Nếu rỗng, xử lý lỗi hoặc thông báo người dùng
                return response()->json(['error' => 'Nội dung bình luận không được để trống'], 400);
            } else {
                // Nếu không rỗng, thêm bình luận vào cơ sở dữ liệu
                $comment = PostsComment::create([
                    'node_type' => 'post',
                    'user_type' => 'user',
                    'text' => $commentText,
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
        
                // Cập nhật số lượng bình luận của bài viết
                $post = PostsModel::find($post_id);
                $post->comments = $post->comments + 1;
                $post->save();
        
                // Đặt lại nội dung bình luận sau khi thêm
                $this->ContentComment[$post_id] = '';
                
                // Có thể trả về thông báo thành công cho người dùng nếu cần
              return response()->json(['success' => 'Bình luận đã được thêm'], 200);
            }
        }

   
    public function render()
{
 
    $this->posts = PostsModel::where('is_hidden', '0')->where('privacy', 'public')
    ->limit($this->loadAmount)
    ->get();
    $posts = $this->posts;

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
 
}

return view('livewire.clients.load-post-controller')
    ->with(['posts' => $posts]);
}


}