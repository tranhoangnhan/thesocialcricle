<?php

namespace App\Livewire\Clients\Profile;

use App\Models\AlbumDetailModel;
use App\Models\AlbumModel;
use App\Models\UsersModel;
use Livewire\Component;
use Livewire\Attributes\On;

class UploadFile extends Component
{
    #[On('uploadAvatarProfile')]
    public function uploadAvatarProfile($data, $type)
    {
        if (isset($data) && $data['success'] == 1) {
            $user = UsersModel::where('user_id', auth()->user()->user_id)->first();
            if ($type == 'avatar') {
                if ($user->user_avatar) {
                    UsersModel::where('user_id', auth()->user()->user_id)->update([
                        'user_avatar' => $data['filepath']
                    ]);
                    $existingAlbum = AlbumModel::where('user_id', auth()->user()->user_id)->first();
                    if (!$existingAlbum) {
                        $album = AlbumModel::create([
                            'user_id' => auth()->user()->user_id,
                        ]);
                        $albumId = $album->id;
                    } else {
                        $albumId = $existingAlbum->id;
                    }
                }
            }
            if ($type == 'cover') {
                if ($user->user_cover) {
                    UsersModel::where('user_id', auth()->user()->user_id)->update([
                        'user_cover' => $data['filepath'],
                    ]);
                    $existingAlbum = AlbumModel::where('user_id', auth()->user()->user_id)->first();
                    if (!$existingAlbum) {
                        $album = AlbumModel::create([
                            'user_id' => auth()->user()->user_id,
                        ]);
                        $albumId = $album->id;
                    } else {
                        $albumId = $existingAlbum->id;
                    }
                }
            }
            $albumDetail = AlbumDetailModel::create([
                'source' => $data['filepath'],
                'album_id' => $albumId,
                'user_id' => auth()->user()->user_id,
            ]);
            if ($albumDetail) {
                $this->dispatch('reloadPage');
            }
        }
    }
    public function render()
    {
        return view('livewire.clients.profile.upload-file');
    }
}
