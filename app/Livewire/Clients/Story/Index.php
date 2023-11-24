<?php

namespace App\Livewire\Clients\Story;

use App\Models\FriendsModel;
use App\Models\StoriesMediaModel;
use App\Models\StoriesModel;
use App\Models\UsersModel;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{
    public $story, $friends, $visibleStories, $story1;
    public $activePage = 1;
    public $perPage = 4;
    public $totalPages, $startIndex;


    public function mount()
    {
        $currentUser = auth()->user()->user_id;

        // Get the IDs of friends, including the current user
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
        $this->story1 = $this->story->toArray();
        $this->totalPages = ceil(count($this->story) / $this->perPage);
    }

    #[On('reloadStory')]
    public function story(){
         $this->startIndex = 1;

    }

    public function changeActivePage($page)
    {
        $this->activePage = $page;
        $this->dispatch('activePageStory', $this->activePage);
    }

    public function nextPage()
    {
        if ($this->activePage < $this->totalPages) {
            $this->activePage++;
        }
    }

    public function prevPage()
    {
        if ($this->activePage > 1) {
            $this->activePage--;
        }
    }
    public function slideTransition($direction)
    {
        $this->dispatch('slideTransition', ['direction' => $direction]);
    }
    #[On('uploadStory')]
    public function uploadStory($data, $type, $log)
    {
        if (isset($data) && $data['success'] == 1) {
            $user = UsersModel::where('user_id', auth()->user()->user_id)->first();
            if ($type == 'story') {
                $story = StoriesModel::create([
                    'user_id' => auth()->user()->user_id,
                    'time' => now()
                ]);
                if ($story) {
                    if ($log == "video") {
                        $is_photo = "0";
                    } else {
                        $is_photo = "1";
                    }
                    $storyDetail = StoriesMediaModel::create([
                        'source' => $data['filepath'],
                        'is_photo' => $is_photo,
                        'text' => 'A',
                        'story_id' => $story->story_id,
                    ]);
                }
            }
            if ($story && $storyDetail) {
                $this->dispatch('reloadPage');
            }
        }
    }


    public function render()
    {
        $this->startIndex = ($this->activePage - 1) * $this->perPage;

        $this->paginatedStories = array_slice($this->story1, $this->startIndex, $this->perPage);
        return view('livewire.clients.story.index', [
            'paginatedStories' => $this->paginatedStories,
        ]);
    }
}
