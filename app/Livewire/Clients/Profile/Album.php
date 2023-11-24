<?php

namespace App\Livewire\Clients\Profile;

use App\Models\AlbumDetailModel;
use App\Models\UsersModel;
use Livewire\Component;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Livewire\WithPagination;
use Livewire\Attributes\On;
class Album extends Component
{
    use WithPagination;

    public $data, $album = [], $id,
    $selectTabAlbum = "all", $countAlbumList, $AlbumReCent,$totalAlbum,$albums;
    public $perPage = [
        'all' => 8,
        'recent' => 8,
    ];
    public function mount($data, $id)
    {
        $this->data = $data;
        $this->id = $id;
        $this->album = [];
        Cache::put('user_id', $this->id);
    }
    public function refreshing()
    {
        Cache::forget('user_id');
    }

    public function selectTab($data)
    {
        $this->selectTabAlbum = $data;
        if ($data == 'all') {
            $this->albumList();
        } elseif ($data == 'recent') {
            $this->albumList();
        }
    }
    #[On('loadMoreAlbumList')]
    public function loadMoreAlbumList()
    {
        $this->perPage[$this->selectTabAlbum] = $this->perPage[$this->selectTabAlbum] + 8;
        $this->albumList();
    }
    public function albumList()
    {
        $id = Cache::get('user_id');
        if ($this->data) {
            $dataLog = UsersModel::where('user_id', $id)->first();
            if (empty($dataLog)) {
                $dataLog = UsersModel::where('user_username', $id)->first();
            }
            $AlbumQueryA = AlbumDetailModel::where('user_id', $dataLog->user_id);
            if ($this->selectTabAlbum == 'recent') {
                $albumQuery = $AlbumQueryA->orderBy('id', 'DESC');
            }
            if ($this->selectTabAlbum == 'all') {
                $albumQuery = $AlbumQueryA;
            }
            $this->totalAlbum = $albumQuery->count();
            $album = $albumQuery->paginate($this->perPage[$this->selectTabAlbum]);
            $this->albums = json_encode($album);
            return $album;
        }
    }

    public function render()
    {
        return view('livewire.clients.profile.album',[
            'album' => $this->albumList(),
        ]);
    }
}
