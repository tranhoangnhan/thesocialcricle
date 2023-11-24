<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\AlbumDetailModel;
use App\Models\AlbumModel;
use App\Models\FriendsModel;
use App\Models\IntroductionModel;
use App\Models\UsersBlockModel;
use App\Models\UsersModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use PragmaRX\Google2FA\Google2FA;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request)
    {
        $id = request()->id;
        if (isset($id)) {
            if (preg_match('/^@?(\d+)$/', $id, $matches)) {
                $type = 'id';
                $data = UsersModel::where('user_id', $matches[1])->first();
                $check = IntroductionModel::where('user_id', $matches[1])->first();

            } elseif (preg_match('/^@?([a-zA-Z0-9]+)$/', $id, $matches)) {
                $type = 'username';
                $data = UsersModel::where('user_username', $matches[1])->first();
                $check = IntroductionModel::where('user_id', $data->user_id)->first();
            }
            if (auth()->check()) {
                $currentUser = auth()->user()->user_id;
                $block = UsersBlockModel::where('user_id', $currentUser)
                    ->where('block_id', $data->user_id)
                    ->orWhere(function ($query) use ($currentUser, $data) {
                        $query->where('user_id', $data->user_id)
                            ->where('block_id', $currentUser);
                    })
                    ->first();
                if (isset($block)) {
                    return response()->view('errors.block', compact('block'));
                }
            }

            $friends = FriendsModel::where('status', '1')
                ->where(function ($query) use ($data) {
                    $query->where('user_one_id', $data->user_id)
                        ->orWhere('user_two_id', $data->user_id);
                })
                ->get();
            $friendUserIds = [];
            foreach ($friends as $friend) {
                if ($friend->user_one_id != $data->user_id) {
                    $friendUserIds[] = $friend->user_one_id;
                }
                if ($friend->user_two_id != $data->user_id) {
                    $friendUserIds[] = $friend->user_two_id;
                }
            }
            $friends = UsersModel::whereIn('user_id', $friendUserIds)->get();
            if (isset($check)) {
                $introduction = $check;
            } else {
                $introduction = 0;
            }
            $info = $data;
            $posts = $data;

        }
        $layout = auth()->check() ? 'layouts.clients' : 'layouts.auth';
        return view('clients.profile.index', compact('data', 'layout', 'friends', 'id', 'introduction','info','posts'));
    }


    public function updateAvatar(Request $request)
    {
        try {
            $type = $request->type;
            $data = $request->data;
            if (auth()->check()) {
                if (isset($data) && $data['success'] == 1) {
                    $user = UsersModel::where('user_id', auth()->user()->user_id)->first();
                    if ($type == 'avatar') {
                        if ($user->user_avatar) {
                            UsersModel::where('user_id', auth()->user()->user_id)->update([
                                'user_avatar' => $data['filepath'],
                            ]);
                            $album = AlbumModel::where('user_id', auth()->user()->user_id)->first();
                            if ($album) {
                                $albumDetail = AlbumDetailModel::create([
                                    'source' => $data['filepath'],
                                    'album_id' => $album->id,
                                    'user_id' => auth()->user()->user_id,
                                ]);
                            }
                        }
                    }
                    if ($type == 'cover') {
                        if ($user->user_cover) {
                            UsersModel::where('user_id', auth()->user()->user_id)->update([
                                'user_cover' => $data['filepath'],
                            ]);
                            $album = AlbumModel::where('user_id', auth()->user()->user_id)->first();
                            if ($album) {
                                $albumDetail = AlbumDetailModel::create([
                                    'source' => $data['filepath'],
                                    'album_id' => $album->id,
                                    'user_id' => auth()->user()->user_id,
                                ]);
                            }
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            \Log::error('Lỗi trong quá trình cập nhật ảnh đại diện: ' . $e->getMessage());
            return response()->json(['message' => 'Có lỗi xảy ra'], 500);
        }
    }
    public function verify_2fa(Request $request)
    {
        if (auth()->user()->turn_on_2fa != 1) {
            return redirect()->route('home');
        }
        return view('clients.auth.2fa');
    }

    public function block(Request $request)
    {
        try {
            $id = $request->id;
            if (isset($id)) {
                $id = decrypt($request->id);
                $log = UsersBlockModel::create([
                    'user_id' => auth()->user()->user_id,
                    'block_id' => $id,
                ]);
                if ($log) {
                    return redirect()->route('home');
                }
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404);
        }
    }


    public function introduction()
    {
        return view('clients.profile.introduction');
    }

}
