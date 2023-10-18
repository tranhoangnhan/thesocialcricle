<?php
use App\Models\UsersModel;
use App\Models\ConversationsModel;
use App\Models\Conversations_UsersModel;
use App\Models\Conversations_MessagesModel;
use Illuminate\Database\Eloquent\Collection;

if (!function_exists('getName')) {
    function getName($id)
    {
        $html = '';
        if (auth()->check()) {
            $user = UsersModel::where('user_id', $id)->first();
            $fullname = $user->user_fullname;
            if ($user->user_activated == 1) {
                $html .= '<div class="flex">';
                $html .= $fullname;
                $html .= '<img src="' . asset('clients/assets/images/icons/verify.png') . '" style="width:20px;margin-left:2px">';
                $html .= '</div>';
            }

            if ($user->user_activated != 1) {
                $html .= $fullname;
            }
        }
        return $html;
    }

    function getNames($userIds)
    {
        $html = '';

        if (auth()->check()) {
            $users = UsersModel::whereIn('user_id', $userIds)->get();

            foreach ($users as $user) {
                $fullname = $user->user_fullname;
                if ($user->user_activated == 1) {
                    $html .= '<div class="flex">';
                    $html .= $fullname;
                    $html .= '<img src="' . asset('clients/assets/images/icons/verify.png') . '" style="width:20px;margin-left:2px">';
                    $html .= '</div>';
                } else {
                    $html .= $fullname;
                }

                if ($user !== $users->last()) {
                    $html .= ', ';
                }
            }
        }

        return $html;
    }
    function getAvatar($id)
    {
        $user = UsersModel::where('user_id', $id)->first();
        if (isset($user->user_avatar)) {
            $html = '<img id="profileImage" class="inline-block h-10 w-10 rounded-full ring-2 ring-white dark:ring-gray-800"
            src="' . $user->user_avatar . '">';
        } else {
            $fullname = $user->user_fullname;
            $names = explode(' ', $fullname);
            $initials = '';
            foreach ($names as $name) {
                $initials .= $name[0];
            }
            $initials = strtoupper(trim($initials));
            if (strlen($initials) === 1) {
                $html = '<div id="profileImage" class="inline-block h-10 w-10 rounded-full ring-2 ring-white dark:ring-gray-800">
                ' . $initials . '
            </div>';
            } else {
                $html = '<div id="profileImage" class="inline-block h-10 w-10 rounded-full ring-2 ring-white dark:ring-gray-800">
                ' . $initials[0] . $initials[1] . '
            </div>';
            }
        }
        return $html;
    }
    function getConversationMessages($conversation_id, $offset = 0, $last_message_id = null): Collection
    {
        $user_id = auth()->user()->user_id;

        $us1 = Conversations_UsersModel::where('user_id', $user_id)
            ->pluck('conversations_id')
            ->toArray();

        $us2 = Conversations_UsersModel::where('user_id', $conversation_id)
            ->pluck('conversations_id')
            ->toArray();

        $common_conversations = array_intersect($us1, $us2);
        if (array_diff($us1, $us2) && array_diff($us2, $us1)) {
            $conversation_id = $common_conversations;
        } else {
            $conversation_id = null;
        }
        dd($conversation_id);
        $check_conversation = Conversations_UsersModel::where(function ($query) use ($conversation_id, $user_id) {
            $query->where('user_id', $user_id)
                ->orWhere(function ($query) use ($conversation_id) {
                    $query->where('user_id', $conversation_id);
                });
        })->count();

        dd($check_conversation);
        if ($check_conversation === 0) {
            throw new \Exception("Không có quyền xem!");
        }

        if ($last_message_id !== null) {
            $messages = Conversations_MessagesModel::where('conversations_id', $conversation_id)
                ->where('message_id', '>', $last_message_id)
                ->join('users', 'conversations_messages.user_id', '=', 'users.user_id')
                ->select('conversations_messages.message_id', 'conversations_messages.message', 'conversations_messages.source', 'conversations_messages.time', 'users.user_id', 'users.user_name', 'users.user_firstname', 'users.user_lastname', 'users.user_gender', 'users.user_picture', 'users.user_subscribed', 'users.user_verified')
                ->get();
        } else {
            $messages = Conversations_MessagesModel::where('conversations_id', $conversation_id)
                ->join('users', 'conversations_message.user_id', '=', 'users.user_id')
                ->select('conversations_message.message_id', 'conversations_message.message', 'conversations_message.source', 'conversations_message.time')
                ->orderByDesc('conversations_message.message_id')
                // ->offset(5)
                // ->limit(5)
                ->get();
        }
        return $messages;
    }




}
