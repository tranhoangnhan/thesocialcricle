<?php

namespace App\Livewire\Clients\Conversations;

use App\Events\Clients\Conversations\MessageEvent;
use App\Events\Clients\Users\AllUsersEvent;
use App\Models\Conversations_LogModel;
use App\Models\Conversations_MessagesModel;
use App\Models\Conversations_UsersModel;
use App\Models\ConversationsModel;
use App\Models\UsersBlockModel;
use App\Models\UsersModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Request;
use HTMLPurifier;
use App\Helpers\GoogleDriveHelper;
use Illuminate\Http\UploadedFile;
use Livewire\WithFileUploads;

class Chat extends Component
{
    use WithFileUploads;
    public $tags = [];
    public $user_id;
    public $user_fullname;
    public $users;
    public $count;
    public $son = false;
    public $selectConversations;
    public $messagesData;
    public $text;
    public $typing = 0;

    public $checkMess = false, $isGroupChat = false, $nameGroup, $conversationsGroup, $color;
    public $activities, $UIDConversation, $memberGroup, $page = 1, $block;
    public $uploadedImage;

    public function mount($id = null)
    {
        $this->selectConversations = $id;
        if (isset($this->selectConversations)) {
            $a = UsersModel::where('user_id', $id)->first();
            if (isset($a)) {
                $this->user_id = $a->user_id;
                $conversations = Conversations_UsersModel::where('user_id', auth()->user()->user_id)
                    ->whereIn('conversations_id', function ($query) {
                        $query->select('conversations_id')
                            ->from('conversations_users')
                            ->where('user_id', $this->user_id); // $this->user_id là id người bạn muốn trò chuyện
                    })
                    ->get();
                $this->isGroupChat = false;
                $currentUser = auth()->user()->user_id;
                $this->block = UsersBlockModel::whereIn('user_id', [$currentUser, $this->user_id])
                    ->whereIn('block_id', [$currentUser, $this->user_id])
                    ->exists();
                if ($conversations->count() > 0 && isset($conversations)) {
                    $conversationsId = $conversations->first()->conversations_id;
                    $this->UIDConversation = $conversationsId;
                    $data = ConversationsModel::where('conversations_id', $conversationsId)->first();
                    $this->color = $data->color;
                    $this->activities = Redis::get('offline_time_' . $this->user_id);
                }
            }
            $group = ConversationsModel::where('conversations_id', $id)->first();
            if (isset($group)) {
                $userCount = $group->users->count();
                if ($userCount > 2) {
                    $userCount1 = $group->users->where('kick', 0)->count();
                    $roleCount = $group->users->where('role', 1)->where('kick', 0)->count();
                    $this->memberGroup = [
                        'count' => $userCount1,
                        'member' => $group->users->where('kick', 0),
                        'roleCount' => $roleCount,
                        'user_now' => $group->users->where('user_id', auth()->user()->user_id)->where('kick', 0)->first(),
                        'conversations_id' => $id,
                    ];
                    $this->isGroupChat = true;
                    $data = $group;
                    $this->nameGroup = $data->name;
                    if ($group->count() > 0 && isset($group)) {
                        $this->color = $data->color;
                    }
                }
            }
        }
    }

    public function statusMess($event)
    {
        if (isset($this->UIDConversation)) {
            if ($event === 'keydown') {
                $this->typing = 1;
                if ($this->text == NULL || empty($this->text)) {
                    $this->typing = 0;
                }
            }
        }
    }

    protected function rules()
    {
        $rules = [
            'text' => [
                'required',
                'min:1'
            ],
        ];
        return $rules;
    }
    protected $validationAttributes = [
        'text' => 'tin nhắn',

    ];

    protected $messages = [
        'required' => 'Vui lòng nhập :attribute.',
        'min' => 'Vui lòng nhập :attribute có ít nhất :min ký tự.',
    ];


    #[On('tags')]
    public function updatedData($data)
    {
        if (isset($data)) {
            $this->tags = $data;

            $this->getConversations();

        }
    }

    #[On('message')]
    public function updatedText1($message)
    {
        if (isset($message)) {
            $this->text = $message;
            $this->sendMess();
        }

    }

    #[On('loadMoreMessage')]
    public function loadMore()
    {
        return $this->page++;
    }


    public function getConversations()
    {
        $currentRoute = Route::current();
        $routeName = $currentRoute->getName();
        if (count($this->tags) === 1 || isset($this->selectConversations)) {
            if (isset($this->selectConversations)) {
                $id = $this->selectConversations; // id users, group
            } else {
                $id = $this->tags[0]['friendId']; // id users
            }
            // nhóm
            if ($this->isGroupChat) {

                $group = ConversationsModel::where('conversations_id', $id)->first();
                if (isset($group)) {
                    $currentUserId = Auth::user()->user_id;
                    $userCount = $group->users->count();
                    if ($userCount > 1) {
                        $this->isGroupChat = true;
                        $this->conversationsGroup = $group->load('users'); // Lấy thông tin người dùng trong cuộc trò chuyện
                        // $conversations = Conversations_MessagesModel::where('conversations_id', $id)->orderBy('time', 'DESC')
                        // ->take(10)->get();
                        $conversations = Conversations_MessagesModel::where('conversations_id', $id)
                            ->orderBy('time', 'DESC')
                            ->paginate(5, ['*'], 'page', $this->page);
                        $notifications = Conversations_LogModel::where('conversations_id', $id)
                            ->get();
                        if ($conversations->count() > 0 && isset($conversations)) {
                            $combinedData = [];
                            foreach ($conversations as $conversation) {
                                $combinedData[] = [
                                    'type' => 'message',
                                    'time' => $conversation->time,
                                    'data' => $conversation,
                                ];
                            }

                            if (isset($notifications)) {
                                foreach ($notifications as $notification) {
                                    $combinedData[] = [
                                        'type' => 'notification',
                                        'time' => $notification->time,
                                        'data' => $notification->event_data,
                                    ];
                                }
                            }
                            // Sắp xếp mảng theo thời gian
                            usort($combinedData, function ($a, $b) {
                                return $a['time'] <=> $b['time'];
                            });
                            // $this->messagesData = $conversations->reverse();
                            $this->messagesData = $combinedData;
                            $this->checkMess = true;
                            Conversations_UsersModel::where('conversations_id', $id)
                                ->where('user_id', auth()->user()->user_id)->update(['seen' => "1"]);
                        } else {
                            $this->messagesData = '';
                            $this->checkMess = false;
                        }
                    }
                }
            } else {
                // người dùng
                $this->isGroupChat = false;
                if ($id) {
                    $a = UsersModel::where('user_id', $id)->first();
                    if (isset($a)) {
                        $this->user_id = $a->user_id;
                        $conversations = Conversations_UsersModel::where('user_id', auth()->user()->user_id)
                            ->whereIn('conversations_id', function ($query) {
                                $query->select('conversations_id')
                                    ->from('conversations_users')
                                    ->where('user_id', $this->user_id);
                            })
                            ->where('kick', '=', null)
                            ->where('role', '=', null)
                            ->get();
                        $this->block = UsersBlockModel::whereIn('user_id', [auth()->user()->user_id, $this->user_id])
                            ->whereIn('block_id', [auth()->user()->user_id, $this->user_id])
                            ->exists();
                        if ($conversations->count() > 0 && isset($conversations)) {
                            if ($this->typing == 1) {
                                $check = Conversations_UsersModel::where('conversations_id', $this->UIDConversation)
                                    ->where('user_id', auth()->user()->user_id)->first();
                                Conversations_UsersModel::where('conversations_id', $this->UIDConversation)
                                    ->where('user_id', auth()->user()->user_id)->update(['typing' => '1']);
                                Event::dispatch(new AllUsersEvent('typing', '1', auth()->user()->user_id, $this->user_id, now()));
                            } else {
                                $check = Conversations_UsersModel::where('conversations_id', $this->UIDConversation)
                                    ->where('user_id', auth()->user()->user_id)->first();
                                Conversations_UsersModel::where('conversations_id', $this->UIDConversation)
                                    ->where('user_id', auth()->user()->user_id)->update(['typing' => '0']);
                                Event::dispatch(new AllUsersEvent('typing', '0', auth()->user()->user_id, $this->user_id, now()));
                            }

                            $conversationsId = $conversations->first()->conversations_id;

                            $query = Conversations_MessagesModel::where('conversations_id', $conversationsId);
                            $a = $query->orderBy('time', 'DESC')->take(10)->get()->reverse();
                            $notifications = Conversations_LogModel::where('conversations_id', $conversationsId)
                                ->get();
                            $combinedData = [];
                            foreach ($a as $conversation) {
                                $combinedData[] = [
                                    'type' => 'message',
                                    'time' => $conversation->time,
                                    'data' => $conversation,
                                ];
                            }

                            if (isset($notifications)) {
                                foreach ($notifications as $notification) {
                                    $combinedData[] = [
                                        'type' => 'notification',
                                        'time' => $notification->time,
                                        'data' => $notification->event_data,
                                    ];
                                }
                            }

                            // Sắp xếp mảng theo thời gian
                            usort($combinedData, function ($a, $b) {
                                return $a['time'] <=> $b['time'];
                            });
                            $this->messagesData = $combinedData;
                            Conversations_UsersModel::where('conversations_id', $conversationsId)->where('user_id', auth()->user()->user_id)->update(['seen' => "1"]);
                            $this->checkMess = true;
                        } else {
                            $this->messagesData = '';
                            $this->checkMess = false;
                        }
                    }
                }

            }
        } else {
            $this->messagesData = '';
            $this->checkMess = false;
            $a = collect($this->tags)->pluck('friendId')->take(4);
            $b = collect($this->tags)->pluck('friendFullName');
            $this->user_id = $a;
            $this->user_fullname = $b;
            $this->count = count($this->tags);
            $this->isGroupChat = true;
            if (isset($this->user_id) && $this->count >= 2) {
                // dd($this->user_id);
                // dd($this->count);
                $currentUserId = auth()->user()->user_id;
                $this->coversationsGroup = ConversationsModel::select('conversations_id', 'conversations_message', 'name')
                    ->with([
                        'users' => function ($query) use ($currentUserId) {
                            $query->select('id', 'conversations_id', 'user_id', 'seen', 'typing', 'deleted')
                                ->where('user_id', '<>', $currentUserId);
                        },
                    ])
                    ->whereHas('users', function ($query) use ($currentUserId) {
                        $query->where('user_id', $currentUserId);
                    })
                    ->get();
                $this->messagesData = '';
                $this->checkMess = false;
            }
        }
    }

    #[On('chat')]
    public function chat()
    {
        $this->getConversations();
    }


    public function sendMess()
    {
        $this->validate();
        if (count($this->tags) === 1 || isset($this->selectConversations)) {

            if (isset($this->selectConversations)) {
                $id = $this->selectConversations; // id users
            } else {
                $id = $this->tags[0]['friendId']; // id users
            }
            // nhóm
            if ($this->isGroupChat) {
                $group = ConversationsModel::where('conversations_id', $id)->first();
                if (isset($group)) {
                    $userCount = $group->users->count();
                    if ($userCount > 1) {
                        $this->conversationsGroup = $group->load('users'); // Lấy thông tin người dùng trong cuộc trò chuyện
                        $conversationsId = $group->conversations_id;
                        $send = Conversations_MessagesModel::create([
                            'type' => 'text',
                            'source' => NULL,
                            'time' => now(),
                            'conversations_id' => $conversationsId,
                            'message' => $this->text,
                            'user_id' => Auth::user()->user_id,
                        ]);
                        ConversationsModel::where('conversations_id', $conversationsId)->update([
                            'conversations_message' => $send->message_id
                        ]);
                        if ($send) {
                            $this->dispatch('chat');
                            $name = UsersModel::where('user_id', Auth::user()->user_id)->pluck('user_fullname');
                            // nhóm nên foreach
                            foreach ($group->users as $user) {
                                Conversations_UsersModel::
                                    where('conversations_id', $conversationsId)
                                    ->where('user_id', $user->user_id)->update(['seen' => "0"]);
                                event(new MessageEvent($name, $user->user_id, $this->text));
                            }
                            $this->text = '';
                            $this->isGroupChat = true;
                            $this->getConversations();
                        }
                    }
                }
            } else {
                // người dùng
                $this->isGroupChat = false;
                if (isset($id) && isset($this->user_id) && empty($this->block)) {
                    $conversations = Conversations_UsersModel::where('user_id', auth()->user()->user_id)
                        ->whereIn('conversations_id', function ($query) {
                            $query->select('conversations_id')
                                ->from('conversations_users')
                                ->where('user_id', $this->user_id);
                        })
                        ->where('kick', '=', null)
                        ->where('role', '=', null)
                        ->get();
                    if ($conversations->count() <= 0) {
                        $newConversation = ConversationsModel::create([
                            'color' => NULL,
                            'name' => NULL,
                            'conversations_message' => 1,
                        ]);
                        if ($newConversation) {
                            // id người gửi
                            Conversations_UsersModel::create([
                                'user_id' => auth()->user()->user_id,
                                'conversations_id' => $newConversation->conversations_id,
                            ]);
                            //id người nhận
                            Conversations_UsersModel::create([
                                'user_id' => $this->user_id,
                                'conversations_id' => $newConversation->conversations_id,
                            ]);

                            $send = Conversations_MessagesModel::create([
                                'type' => 'text',
                                'source' => NULL,
                                'time' => now(),
                                'conversations_id' => $newConversation->conversations_id,
                                'message' => $this->text,
                                'user_id' => auth()->user()->user_id,
                            ]);
                            if ($send) {

                                $this->dispatch('chat');
                                ConversationsModel::where('conversations_id', $newConversation->conversations_id)->update([
                                    'conversations_message' => $send->message_id
                                ]);
                                Conversations_UsersModel::
                                    where('conversations_id', $newConversation->conversations_id)
                                    ->where('user_id', $this->user_id)->update(['seen' => "0"]);
                                $name = UsersModel::where('user_id', auth()->user()->user_id)->pluck('user_fullname');
                                event(new MessageEvent($name, $id, $this->text));
                                $this->text = '';
                                $this->getConversations();
                            }
                        }
                    }
                    if ($conversations->count() > 0 && isset($conversations)) {
                        $conversationsId = $conversations->first()->conversations_id;
                        $send = Conversations_MessagesModel::create([
                            'type' => 'text',
                            'source' => NULL,
                            'time' => now(),
                            'conversations_id' => $conversationsId,
                            'message' => $this->text,
                            'user_id' => Auth::user()->user_id,
                        ]);
                        ConversationsModel::where('conversations_id', $conversationsId)->update([
                            'conversations_message' => $send->message_id
                        ]);
                        if ($send) {
                            $this->dispatch('chat');
                            $name = UsersModel::where('user_id', Auth::user()->user_id)->pluck('user_fullname');
                            Conversations_UsersModel::
                                where('conversations_id', $conversationsId)
                                ->where('user_id', $this->user_id)->update(['seen' => "0"]);
                            event(new MessageEvent($name, $id, $this->text));
                            $this->text = '';
                            $this->getConversations();
                        }
                    }
                }
            }


        } elseif (count($this->tags) >= 2) {
            // Tạo cuộc trò chuyện nhóm
            $lastConversationsMessage = ConversationsModel::latest('conversations_message')->first();
            if ($lastConversationsMessage) {
                $nextConversationsMessage = $lastConversationsMessage->conversations_message + 1;
            } else {
                $nextConversationsMessage = 1;
            }
            $groupConversation = new ConversationsModel();
            $groupConversation->conversations_message = $nextConversationsMessage;
            $groupConversation->save();

            // Lấy giá trị conversations_id mới sau khi đã lưu bản ghi
            $conversationsId = $groupConversation->conversations_id;

            // Thêm thành viên vào cuộc trò chuyện nhóm
            // Trích xuất tất cả các friendId từ mảng $this->tags
            $memberUserIds = array_column($this->tags, 'friendId');

            // Thêm user_id của người dùng hiện tại vào mảng
            $memberUserIds[] = Auth::user()->user_id;

            // Lặp qua mảng thành viên và thêm chúng vào cuộc trò chuyện nhóm
            foreach ($memberUserIds as $memberUserId) {
                Conversations_UsersModel::create([
                    'user_id' => $memberUserId,
                    'conversations_id' => $conversationsId,
                    'role' => ($memberUserId == auth()->user()->user_id) ? 1 : null,
                    'kick' => 0,
                ]);
            }
            // Gửi tin nhắn vào cuộc trò chuyện nhóm
            $send = Conversations_MessagesModel::create([
                'type' => 'text',
                'source' => NULL,
                'time' => now(),
                'conversations_id' => $conversationsId,
                'message' => $this->text,
                'user_id' => Auth::user()->user_id,
            ]);

            if ($send) {
                $this->dispatch('chat');
                $this->text = '';
                $this->getConversations();
                return redirect()->route('messagesGroup', ['id' => $conversationsId]);
            }
        }
    }

    #[On('change1')]
    public function change($data = NULL, $type = NULL)
    {

        if ($this->isGroupChat) {
            // $this->validate([
            //     'nameGroup' => 'required|min:1|max:30',
            // ]);
        }

        if (isset($this->selectConversations)) {
            $id = $this->selectConversations; // id users, group
        }
        // người dùng
        if (isset($id)) {
            $a = UsersModel::where('user_id', $id)->first();
            if (isset($a)) {
                $this->user_id = $a->user_id;
                if (isset($id) && isset($this->user_id)) {
                    $conversations = Conversations_UsersModel::where('user_id', auth()->user()->user_id)
                        ->whereIn('conversations_id', function ($query) {
                            $query->select('conversations_id')
                                ->from('conversations_users')
                                ->where('user_id', $this->user_id); // $this->user_id là id người bạn muốn trò chuyện
                        })
                        ->get();
                    if ($conversations->count() > 0 && isset($conversations)) {
                        if ($type == 'color') {
                            $color = $data;
                            if ($color == 'white') {
                                $color = '#FFFFFF';
                            } else if ($color == 'red') {
                                $color = '#FF8080';
                            } else if ($color == 'yellow') {
                                $color = '#F6FDC3';
                            } else if ($color == 'orange') {
                                $color = '#FFCF96';
                            } else {
                                $color = NULL;
                            }
                        }
                        if ($conversations->count() > 0 && isset($conversations)) {
                            $conversationsId = $conversations->first()->conversations_id;
                            ConversationsModel::updateConversation($conversationsId, 'color', $color);
                            $message = auth()->user()->user_fullname . " đã đổi màu đoạn chat";
                            Conversations_LogModel::logConversationEvent('changeColorChat', $conversationsId, $message);
                            Conversations_UsersModel::broadcastGroupEvent($conversationsId, $message);
                            return redirect()->route('messages', ['id' => $a->user_id]);
                        }
                    }
                }
            }

            $group = ConversationsModel::where('conversations_id', $id)->first();
            if (isset($group)) {
                $userCount = $group->users->count();
                if ($userCount > 1) {
                    $idConversation = $group->conversations_id;
                    if ($idConversation) {
                        if ($this->isGroupChat) {
                            if ($type == 'color') {
                                $color = $data;
                                if ($color == 'white') {
                                    $color = '#FFFFFF';
                                } else if ($color == 'red') {
                                    $color = '#FF8080';
                                } else if ($color == 'yellow') {
                                    $color = '#F6FDC3';
                                } else if ($color == 'orange') {
                                    $color = '#FFCF96';
                                } else {
                                    $color = NULL;
                                }
                                if (isset($color)) {
                                    ConversationsModel::updateConversation($idConversation, 'color', $color);
                                    $message = auth()->user()->user_fullname . " đã đổi màu đoạn chat";
                                    Conversations_LogModel::logConversationEvent('changeColorChat', $idConversation, $message);
                                    Conversations_UsersModel::broadcastGroupEvent($idConversation, $message);
                                    return redirect()->route('messagesGroup', ['id' => $idConversation]);
                                }
                            }
                            if ($type == "nameGroup") {
                                $nameGroup = $this->nameGroup;
                                $existingName = $group->name;

                                if (isset($nameGroup)) {
                                    if ($nameGroup !== $existingName && strlen($nameGroup) <= 30) {
                                        ConversationsModel::updateConversation($idConversation, 'name', $nameGroup);
                                        $message = auth()->user()->user_fullname . " đã đổi tên nhóm chat";
                                        Conversations_LogModel::logConversationEvent('changeNameChat', $idConversation, $message);
                                        Conversations_UsersModel::broadcastGroupEvent($idConversation, $message);
                                        return redirect()->route('messagesGroup', ['id' => $idConversation]);
                                    } else {
                                        $this->dispatch('reloadPage');
                                    }
                                }
                            }
                            if ($type == "kick" || $type == "out") {
                                if ($type == "out") {
                                    if (auth()->check()) {
                                        $message = auth()->user()->user_fullname . " đã rời khỏi nhóm.";
                                        Conversations_LogModel::logConversationEvent('outGroupChat', $idConversation, $message);
                                        Conversations_UsersModel::where('conversations_id', $idConversation)
                                            ->where('user_id', auth()->user()->user_id)->update(
                                                ['kick' => 1]
                                            );

                                        Conversations_UsersModel::broadcastGroupEvent($idConversation, $message);
                                        return redirect()->route('messagesGroup', ['id' => $idConversation]);
                                    }
                                } else {
                                    $check = Conversations_UsersModel::where('conversations_id', $idConversation)
                                        ->where('user_id', auth()->user()->user_id)->where('role', 1)->first();
                                    if (isset($check)) {
                                        $user = UsersModel::where('user_id', $data)->first();
                                        if (isset($user)) {
                                            $message = auth()->user()->user_fullname . " đã đá " . $user->user_fullname . " khỏi nhóm.";
                                            Conversations_LogModel::logConversationEvent('kickGroupChat', $idConversation, $message);
                                            Conversations_UsersModel::where('conversations_id', $idConversation)
                                                ->where('user_id', $user->user_id)->update(
                                                    ['kick' => 1]
                                                );
                                            Conversations_UsersModel::broadcastGroupEvent($idConversation, $message);
                                        }
                                        return redirect()->route('messagesGroup', ['id' => $idConversation]);
                                    }
                                }
                            }
                            if ($type == "setAdmin") {
                                $check = Conversations_UsersModel::where('conversations_id', $idConversation)
                                    ->where('user_id', auth()->user()->user_id)->where('role', 1)->first();
                                if (isset($check)) {
                                    $user = UsersModel::where('user_id', $data)->first();
                                    if (isset($user)) {
                                        $message = auth()->user()->user_fullname . " đã đưa " . $user->user_fullname . " lên làm QTV nhóm.";
                                        Conversations_LogModel::logConversationEvent('setAdminGroup', $idConversation, $message);
                                        Conversations_UsersModel::where('conversations_id', $idConversation)
                                            ->where('user_id', $user->user_id)->update(
                                                ['role' => 1]
                                            );
                                        Conversations_UsersModel::broadcastGroupEvent($idConversation, $message);
                                    }
                                    return redirect()->route('messagesGroup', ['id' => $idConversation]);
                                }
                            }
                            if ($type == "setUnAdmin") {
                                $check = Conversations_UsersModel::where('conversations_id', $idConversation)
                                    ->where('user_id', auth()->user()->user_id)->where('role', 1)->first();
                                if (isset($check)) {
                                    $user = UsersModel::where('user_id', $data)->first();
                                    if (isset($user)) {
                                        $message = auth()->user()->user_fullname . " đã đưa " . $user->user_fullname . " về làm thành viên nhóm.";
                                        Conversations_LogModel::logConversationEvent('setUnAdminGroup', $idConversation, $message);
                                        Conversations_UsersModel::where('conversations_id', $idConversation)
                                            ->where('user_id', $user->user_id)->update(
                                                ['role' => 0]
                                            );
                                        Conversations_UsersModel::broadcastGroupEvent($idConversation, $message);
                                    }
                                    return redirect()->route('messagesGroup', ['id' => $idConversation]);
                                }
                            }
                        }

                    }
                }
            }
        }

    }

    #[On('uploadImageMessage')]
    public function uploadImageMessage($image)
    {
        if ($image) {
            $base64_img = $image;
            $split = explode(',', substr($base64_img, 5), 2);
            $mime = $split[0];
            $img_data = $split[1];
            $mime_split_without_base64 = explode(';', $mime, 2);
            $mime_split = explode('/', $mime_split_without_base64[0], 2);
            if (count($mime_split) == 2) {
                $extension = $mime_split[1];
                $tempFile = tempnam(sys_get_temp_dir(), 'uploaded_image') . '.' . $extension;
                file_put_contents($tempFile, base64_decode($img_data));
                $uploadedFile = new UploadedFile($tempFile, 'uploaded_image.' . $extension, $mime);
                $extension = $uploadedFile->getClientOriginalExtension();
                $log = GoogleDriveHelper::uploadFile($uploadedFile);
                if ($log) {
                    $content = $log->getContent();
                    $jsonData = json_decode($content, true);
                    $urlImage = $jsonData['filepath'];
                    if (count($this->tags) === 1 || isset($this->selectConversations)) {

                        if (isset($this->selectConversations)) {
                            $id = $this->selectConversations; // id users
                        } else {
                            $id = $this->tags[0]['friendId']; // id users
                        }
                        // nhóm
                        if ($this->isGroupChat) {
                            $group = ConversationsModel::where('conversations_id', $id)->first();
                            if (isset($group)) {
                                $userCount = $group->users->count();
                                if ($userCount > 1) {
                                    $this->conversationsGroup = $group->load('users'); // Lấy thông tin người dùng trong cuộc trò chuyện
                                    $conversationsId = $group->conversations_id;
                                    $send = Conversations_MessagesModel::create([
                                        'type' => 'text',
                                        'source' => $urlImage,
                                        'time' => now(),
                                        'conversations_id' => $conversationsId,
                                        'message' => $this->text,
                                        'user_id' => Auth::user()->user_id,
                                    ]);
                                    ConversationsModel::where('conversations_id', $conversationsId)->update([
                                        'conversations_message' => $send->message_id
                                    ]);
                                    if ($send) {
                                        $this->dispatch('chat');
                                        $name = UsersModel::where('user_id', Auth::user()->user_id)->pluck('user_fullname');
                                        // nhóm nên foreach
                                        foreach ($group->users as $user) {
                                            Conversations_UsersModel::
                                                where('conversations_id', $conversationsId)
                                                ->where('user_id', $user->user_id)->update(['seen' => "0"]);
                                            event(new MessageEvent($name, $user->user_id, $this->text));
                                        }
                                        $this->text = '';
                                        $this->isGroupChat = true;
                                        $this->getConversations();
                                    }
                                }
                            }
                        } else {
                            // người dùng
                            $this->isGroupChat = false;
                            if (isset($id) && isset($this->user_id) && empty($this->block)) {
                                $conversations = Conversations_UsersModel::where('user_id', auth()->user()->user_id)
                                    ->whereIn('conversations_id', function ($query) {
                                        $query->select('conversations_id')
                                            ->from('conversations_users')
                                            ->where('user_id', $this->user_id);
                                    })
                                    ->where('kick', '=', null)
                                    ->where('role', '=', null)
                                    ->get();
                                if ($conversations->count() <= 0) {
                                    $newConversation = ConversationsModel::create([
                                        'color' => NULL,
                                        'name' => NULL,
                                        'conversations_message' => 1,
                                    ]);
                                    if ($newConversation) {
                                        // id người gửi
                                        Conversations_UsersModel::create([
                                            'user_id' => auth()->user()->user_id,
                                            'conversations_id' => $newConversation->conversations_id,
                                        ]);
                                        //id người nhận
                                        Conversations_UsersModel::create([
                                            'user_id' => $this->user_id,
                                            'conversations_id' => $newConversation->conversations_id,
                                        ]);

                                        $send = Conversations_MessagesModel::create([
                                            'type' => 'text',
                                            'source' => $urlImage,
                                            'time' => now(),
                                            'conversations_id' => $newConversation->conversations_id,
                                            'message' => $this->text,
                                            'user_id' => auth()->user()->user_id,
                                        ]);
                                        if ($send) {

                                            $this->dispatch('chat');
                                            ConversationsModel::where('conversations_id', $newConversation->conversations_id)->update([
                                                'conversations_message' => $send->message_id
                                            ]);
                                            Conversations_UsersModel::
                                                where('conversations_id', $newConversation->conversations_id)
                                                ->where('user_id', $this->user_id)->update(['seen' => "0"]);
                                            $name = UsersModel::where('user_id', auth()->user()->user_id)->pluck('user_fullname');
                                            event(new MessageEvent($name, $id, $this->text));
                                            $this->text = '';
                                            $this->getConversations();
                                        }
                                    }
                                }
                                if ($conversations->count() > 0 && isset($conversations)) {
                                    $conversationsId = $conversations->first()->conversations_id;
                                    $send = Conversations_MessagesModel::create([
                                        'type' => 'text',
                                        'source' => $urlImage,
                                        'time' => now(),
                                        'conversations_id' => $conversationsId,
                                        'message' => $this->text,
                                        'user_id' => Auth::user()->user_id,
                                    ]);
                                    ConversationsModel::where('conversations_id', $conversationsId)->update([
                                        'conversations_message' => $send->message_id
                                    ]);
                                    if ($send) {
                                        $this->dispatch('chat');
                                        $name = UsersModel::where('user_id', Auth::user()->user_id)->pluck('user_fullname');
                                        Conversations_UsersModel::
                                            where('conversations_id', $conversationsId)
                                            ->where('user_id', $this->user_id)->update(['seen' => "0"]);
                                        event(new MessageEvent($name, $id, $this->text));
                                        $this->text = '';
                                        $this->getConversations();
                                    }
                                }
                            }
                        }


                    } elseif (count($this->tags) >= 2) {
                        // Tạo cuộc trò chuyện nhóm
                        $lastConversationsMessage = ConversationsModel::latest('conversations_message')->first();
                        if ($lastConversationsMessage) {
                            $nextConversationsMessage = $lastConversationsMessage->conversations_message + 1;
                        } else {
                            $nextConversationsMessage = 1;
                        }
                        $groupConversation = new ConversationsModel();
                        $groupConversation->conversations_message = $nextConversationsMessage;
                        $groupConversation->save();

                        // Lấy giá trị conversations_id mới sau khi đã lưu bản ghi
                        $conversationsId = $groupConversation->conversations_id;

                        // Thêm thành viên vào cuộc trò chuyện nhóm
                        // Trích xuất tất cả các friendId từ mảng $this->tags
                        $memberUserIds = array_column($this->tags, 'friendId');

                        // Thêm user_id của người dùng hiện tại vào mảng
                        $memberUserIds[] = Auth::user()->user_id;

                        // Lặp qua mảng thành viên và thêm chúng vào cuộc trò chuyện nhóm
                        foreach ($memberUserIds as $memberUserId) {
                            Conversations_UsersModel::create([
                                'user_id' => $memberUserId,
                                'conversations_id' => $conversationsId,
                                'role' => ($memberUserId == auth()->user()->user_id) ? 1 : null,
                                'kick' => 0,
                            ]);
                        }



                        // Gửi tin nhắn vào cuộc trò chuyện nhóm
                        $send = Conversations_MessagesModel::create([
                            'type' => 'text',
                            'source' => $urlImage,
                            'time' => now(),
                            'conversations_id' => $conversationsId,
                            'message' => $this->text,
                            'user_id' => Auth::user()->user_id,
                        ]);

                        if ($send) {
                            $this->dispatch('chat');
                            $this->text = '';
                            $this->getConversations();
                            return redirect()->route('messagesGroup', ['id' => $conversationsId]);
                        }
                    }
                }
                Event::dispatch(new AllUsersEvent('loading', 'end', auth()->user()->user_id, '', ''));
            }
        }
    }

    public function render()
    {
        if (isset($this->selectConversations)) {
            $this->getConversations();
        }
        return view('livewire.clients.conversations.chat');
    }
}
