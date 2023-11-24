<?php

namespace App\Livewire\Clients\Story;

use Illuminate\Support\Carbon;
use Livewire\Component;
use App\Models\FriendsModel;
use App\Models\StoriesMediaModel;
use App\Models\StoriesModel;
use App\Models\UsersModel;
use Livewire\Attributes\On;

class AllStory extends Component
{
    public $story, $friends;
    public $activePage = 0;

    public function updated()
    {
        if ($this->activePage <= 0) {
            $this->activePage = 0;
        }
    }
    public function mount()
    {
        $currentUser = auth()->user()->user_id;

        // Lấy danh sách bạn bè và user_id của bạn
        // $friendUserIds = FriendsModel::where('status', '1')
        //     ->where(function ($query) use ($currentUser) {
        //         $query->where('user_one_id', $currentUser)
        //             ->orWhere('user_two_id', $currentUser);
        //     })
        //     ->pluck('user_one_id')
        //     ->merge(FriendsModel::pluck('user_two_id'))
        //     ->unique();

        // // Lấy danh sách bạn bè có story trong 24 giờ gần đây, bao gồm cả chính bạn
        // $recentStoryFriendIds = StoriesModel::whereIn('user_id', $friendUserIds)
        //     ->where('time', '>=', Carbon::now()->subDay())
        //     ->pluck('user_id')
        //     ->unique()
        //     ->push($currentUser);

        // // Lấy thông tin người bạn có story
        // $this->friends = UsersModel::whereIn('user_id', $recentStoryFriendIds)->get();

        // // Lấy danh sách stories của bạn bè trong 24 giờ gần đây, sắp xếp theo thời gian giảm dần
        // $this->story = StoriesMediaModel::whereIn('story_id', function ($query) use ($recentStoryFriendIds) {
        //     $query->select('story_id')
        //         ->from('stories')
        //         ->whereIn('user_id', $recentStoryFriendIds)
        //         ->where('time', '>=', Carbon::now()->subDay())
        //         ->orderByDesc('time');
        // })->with('story')->get();


        $friendUserIds = FriendsModel::where('status', '1')
            ->where(function ($query) use ($currentUser) {
                $query->where('user_one_id', $currentUser)
                    ->orWhere('user_two_id', $currentUser);
            })
            ->pluck('user_one_id')
            ->merge(FriendsModel::pluck('user_two_id'))
            ->unique();

        // Get the IDs of friends with recent stories within 24 hours, including the current user
        $recentStoryFriendIds = StoriesModel::whereIn('user_id', $friendUserIds)
            ->where('time', '>=', Carbon::now()->subDay())
            ->pluck('user_id')
            ->unique()
            ->push($currentUser);

        // Get information about friends with recent stories
        $this->friends = UsersModel::whereIn('user_id', $recentStoryFriendIds)->get();

        // Get a list of stories from friends within the last 24 hours, sorted by time in descending order
        $this->story = StoriesMediaModel::whereIn('story_id', function ($query) use ($recentStoryFriendIds) {
            $query->select('story_id')
                ->from('stories')
                ->whereIn('user_id', $recentStoryFriendIds)
                ->where('time', '>=', Carbon::now()->subDay())
                ->orderByDesc('time');
        })->with('story')->get();

        // Reorder the stories to prioritize the current user's stories
        $this->story = $this->story->sortByDesc(function ($story) use ($currentUser) {
            return $story->story->user_id == $currentUser ? 1 : 0;
        });
    }

    public function deleteStory($id)
    {
        // Tìm bản ghi theo $id
        $story = StoriesModel::find($id);

        if ($story) {
            // Xóa bản ghi
            if (auth()->user()->user_id == $story->user_id) {
                $story->delete();
                StoriesMediaModel::where('story_id', $id)->delete();
                return redirect()->route('home');
            }

        }
    }
    #[On('activePageStory')]
    public function activePageStory($page)
    {
        $this->activePage = $page;
    }
    public function closeStory()
    {
        // $this->activePage = 0;
        $this->dispatch('reloadStory');
    }
    public function render()
    {
        return view('livewire.clients.story.all-story');
    }
}
