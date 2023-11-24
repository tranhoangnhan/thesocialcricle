@php $check = $selectConversations; @endphp
<div @if (empty($check)) class="message-content-scrolbar" data-simplebar @endif>
    @if (!empty($this->tags))
        <!-- Message Content Inner -->
        <div class="message-content-inner max-h-96 overflow-y-auto" id="conversation">
            @if (count($tags) === 1)
                <div class="flex items-center justify-center flex-col">
                    <div class="message-avatar relative">
                        {!! getAvatar($tags[0]['friendId']) !!}
                    </div>
                    <div class="message-text">
                        {{ getNameC($tags[0]['friendId']) }}
                    </div>
                </div>
            @else
                <div class="flex items-center justify-center flex-col">
                    <div class="message-avatar">
                        <div class="flex -space-x-2">
                            @php
                                $userIds = explode(',', $user_id);
                            @endphp
                            @foreach ($userIds as $userId)
                                @php
                                    $trimmedUserId = trim($userId, '[]');
                                    $trimmedUserId = str_replace('"', '', $trimmedUserId);
                                @endphp
                                {{-- {!! getAvatar($trimmedUserId, 'online') !!} --}}
                            @endforeach
                        </div>
                    </div>
                    <div class="message-text">
                        {{ isset($count) && $count <= 4 ? getNames($user_id) : getNames($user_id) . ' và những người khác.' }}
                    </div>
                </div>
            @endif
        @empty($messagesData)
            <p class="mt-2 text-center">Hãy bắt đầu 1 cuộc trò chuyện mới nhé!</p>
        @else
            @foreach ($messagesData as $chat)
                <div class="message-time-sign" style="position: relative;z-index:-1">
                    <span>{{ formatTimeAgo($chat['time']) }}</span>
                </div>
                @if ($chat['type'] == 'notification')
                    <div class="notification text-center">
                        <p class="text-center fw-bold">{{ $chat['data'] }}</p>
                    </div>
                @else
                    @if (is_object($chat['data']))
                        @if (Auth::user()->user_id == $chat['data']->user_id)
                            <div class="message-bubble me">
                                <div class="message-bubble-inner">
                                    <div class="message-avatar"> {!! getAvatar($chat['data']->user_id) !!}
                                    </div>
                                    <div class="message-text">
                                        @if (empty($chat['data']->source))
                                            {{ $chat['data']->message }}
                                        @else
                                            <img src="{{ $chat['data']->source }}" class="lazyloaded"
                                                style="width:355px;height:200px">
                                        @endif
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        @else
                            <div class="message-bubble">
                                <div class="message-bubble-inner">
                                    <div class="message-avatar"> {!! getAvatar($chat['data']->user_id) !!}
                                    </div>
                                    <div class="message-text">
                                        @if (empty($chat['data']->source))
                                            {{ $chat['data']->message }}
                                        @else
                                            <img src="{{ $chat['data']->source }}" class="lazyloaded"
                                                style="width:355px;height:200px">
                                        @endif
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        @endif
                    @endif
                @endif
            @endforeach
        @endempty
    </div>
    <!-- Message Content Inner / End -->
    <!-- Reply Area -->
    @if (empty($block))
        <div
            class="message-reply z-10 d-flex align-items-center absolute bottom-0 bg-white w-full mt-5 right-0 py-2 px-4">
            <div class="flex justify-between w-full gap-2 ">
                {{-- <div class="chat-attagement d-flex gap-2 items-center">
                    <a href="#" class="is_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="25" fill="currentColor"
                            class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                    </a>
                    <div uk-drop="mode: click" class="header_dropdown">
                        <div class="dropdown_scrollbar" data-simplebar>
                            <div class="drop_headline">
                                <h4>Notifications </h4>
                                <div class="btn_action">
                                    <a href="#" data-tippy-placement="left" title="Notifications">
                                        <ion-icon name="settings-outline"></ion-icon>
                                    </a>
                                    <a href="#" data-tippy-placement="left" title="Mark as read all">
                                        <ion-icon name="checkbox-outline"></ion-icon>
                                    </a>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <a href="#">
                                        <div class="drop_avatar">
                                            <img src="{{ asset('clients/assets/images/avatars/avatar-1.jpg') }}"
                                                alt="">
                                        </div>
                                        <span class="drop_icon bg-gradient-primary">
                                            <i class="icon-feather-thumbs-up"></i>
                                        </span>
                                        <div class="drop_text">
                                            <p>
                                                <strong>Adrian Mohani</strong> Like Your Comment On Video
                                                <span class="text-link">Learn Prototype Faster </span>
                                            </p>
                                            <time> 2 hours ago </time>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a href="#" class="d-flex align-items-center pe-3">
                        <svg class="icon-24" width="18" height="23" viewBox="0 0 18 23" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.00021 21.5V18.3391" stroke="currentcolor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.00021 14.3481V14.3481C6.75611 14.3481 4.9384 12.5218 4.9384 10.2682V5.58095C4.9384 3.32732 6.75611 1.5 9.00021 1.5C11.2433 1.5 13.061 3.32732 13.061 5.58095V10.2682C13.061 12.5218 11.2433 14.3481 9.00021 14.3481Z"
                                stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                            </path>
                            <path
                                d="M17 10.3006C17 14.7394 13.418 18.3383 9 18.3383C4.58093 18.3383 1 14.7394 1 10.3006"
                                stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                            </path>
                            <path d="M11.0689 6.25579H13.0585" stroke="currentcolor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M10.0704 9.59344H13.0605" stroke="currentcolor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div> --}}
                <div class="relative flex-1 w-full flex">
                    <div class="uk-button" id="emoji-picker-container"
                        style="left: 13px;position: absolute;top: 50%;transform: translateY(-50%);">
                        <div class="uk-inline">
                            <svg style="color:#0D6EFD" class="icon-24" width="24" viewBox="0 0 24 25"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_156_599)">
                                    <path
                                        d="M20.4853 4.01473C18.2188 1.74823 15.2053 0.5 12 0.5C8.79469 0.5 5.78119 1.74823 3.51473 4.01473C1.24819 6.28119 0 9.29469 0 12.5C0 15.7053 1.24819 18.7188 3.51473 20.9853C5.78119 23.2518 8.79469 24.5 12 24.5C15.2053 24.5 18.2188 23.2518 20.4853 20.9853C22.7518 18.7188 24 15.7053 24 12.5C24 9.29469 22.7518 6.28119 20.4853 4.01473ZM12 23.0714C6.17091 23.0714 1.42856 18.3291 1.42856 12.5C1.42856 6.67091 6.17091 1.92856 12 1.92856C17.8291 1.92856 22.5714 6.67091 22.5714 12.5C22.5714 18.3291 17.8291 23.0714 12 23.0714Z"
                                        fill="currentcolor"></path>
                                    <path
                                        d="M9.40398 9.3309C8.23431 8.16114 6.33104 8.16123 5.16136 9.3309C4.88241 9.60981 4.88241 10.0621 5.16136 10.3411C5.44036 10.62 5.89266 10.62 6.17157 10.3411C6.78432 9.72836 7.78126 9.7284 8.39392 10.3411C8.53342 10.4806 8.71618 10.5503 8.89895 10.5503C9.08171 10.5503 9.26457 10.4806 9.40398 10.3411C9.68293 10.0621 9.68293 9.60986 9.40398 9.3309Z"
                                        fill="currentcolor"></path>
                                    <path
                                        d="M18.8384 9.3309C17.6688 8.16123 15.7655 8.16114 14.5958 9.3309C14.3169 9.60981 14.3169 10.0621 14.5958 10.3411C14.8748 10.62 15.3271 10.62 15.606 10.3411C16.2187 9.72836 17.2156 9.72831 17.8284 10.3411C17.9679 10.4806 18.1506 10.5503 18.3334 10.5503C18.5162 10.5503 18.699 10.4806 18.8384 10.3411C19.1174 10.0621 19.1174 9.60986 18.8384 9.3309Z"
                                        fill="currentcolor"></path>
                                    <path
                                        d="M18.3335 13.024H5.6668C5.2723 13.024 4.95251 13.3438 4.95251 13.7383C4.95251 17.6243 8.11409 20.7859 12.0001 20.7859C15.8862 20.7859 19.0477 17.6243 19.0477 13.7383C19.0477 13.3438 18.728 13.024 18.3335 13.024ZM12.0001 19.3573C9.14366 19.3573 6.77816 17.215 6.42626 14.4525H17.574C17.2221 17.215 14.8566 19.3573 12.0001 19.3573Z"
                                        fill="currentcolor"></path>
                                </g>
                                <defs>
                                    <clipPath>
                                        <rect width="24" height="24" fill="white"
                                            transform="translate(0 0.5)">
                                        </rect>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div uk-dropdown="mode: click; target: !.uk-button-group;" class="uk-drop uk-dropdown"
                            style="top: -274px; left: 0px; max-width: 1313px;">
                            <ul class="uk-nav uk-dropdown-nav">
                                <div style="display: none;" id="emoji-div" class="relative z-100"></div>
                            </ul>
                        </div>
                    </div>
                    <div class="w-full">
                        <textarea id="chat" cols="10" rows="1" placeholder="Tin nhắn" style="border: 1px solid #0584ec;"
                            class="ps-5 w-full" wire:model.blur='text'></textarea>
                    </div>
                </div>
                <button class="button ripple-effect" wire:click='sendMess'>Gửi</button>
            </div>
            {{-- <!--Emoji!-->
            <div id="dropdownHelper"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-60 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownHelperButton">
                    <li>
                        <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <div class="flex items-center h-5">
                                <input id="helper-checkbox-1" aria-describedby="helper-checkbox-text-1"
                                    type="checkbox" value=""
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            </div>
                            <div class="ml-2 text-sm">
                                <label for="helper-checkbox-1"
                                    class="font-medium text-gray-900 dark:text-gray-300">
                                    <div>Enable notifications</div>
                                    <p id="helper-checkbox-text-1"
                                        class="text-xs font-normal text-gray-500 dark:text-gray-300">Some
                                        helpful
                                        instruction goes over here.
                                    </p>
                                </label>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <div class="flex items-center h-5">
                                <input id="helper-checkbox-2" aria-describedby="helper-checkbox-text-2"
                                    type="checkbox" value=""
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            </div>
                            <div class="ml-2 text-sm">
                                <label for="helper-checkbox-2"
                                    class="font-medium text-gray-900 dark:text-gray-300">
                                    <div>Enable 2FA auth</div>
                                    <p id="helper-checkbox-text-2"
                                        class="text-xs font-normal text-gray-500 dark:text-gray-300">Some
                                        helpful
                                        instruction goes over here.
                                    </p>
                                </label>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <div class="flex items-center h-5">
                                <input id="helper-checkbox-3" aria-describedby="helper-checkbox-text-3"
                                    type="checkbox" value=""
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            </div>
                            <div class="ml-2 text-sm">
                                <label for="helper-checkbox-3"
                                    class="font-medium text-gray-900 dark:text-gray-300">
                                    <div>Subscribe newsletter</div>
                                    <p id="helper-checkbox-text-3"
                                        class="text-xs font-normal text-gray-500 dark:text-gray-300">Some
                                        helpful
                                        instruction goes over here.
                                    </p>
                                </label>
                            </div>
                        </div>
                    </li>
                </ul>
            </div> --}}
        </div>
    @else
        <div class="z-10 d-flex align-items-center absolute bottom-0 bg-white w-full mt-5 right-0 py-2 px-4">
            <div class="flex w-full justify-center items-center border-t-2">
                <div class="chat-attagement d-flex justify-center items-center col-span-2">
                    <p class="text-center text-danger mt-3">Hiện tại bạn không thể trả lời tin nhắn
                        này!</p>
                </div>
            </div>
        </div>
    @endif
@endif
@php $user_id = $selectConversations; @endphp
@if (isset($user_id))
    @if (empty($memberGroup) || (isset($memberGroup['user_now']) && $memberGroup['user_now']['kick'] != '1'))
        <div class="messages-headline flex align-items-center relative"
            style="max-height: none; position: sticky; top: 0; background: white; z-index: 10;">
            @if ($isGroupChat)
                <h4>
                    @php
                        $conversationName = \App\Models\ConversationsModel::where('conversations_id', $user_id)
                            ->pluck('name')
                            ->first();
                        $userNames = getNames($conversationsGroup->users->pluck('user_id')->toArray(), 'group');
                        $displayName = $conversationName ?: $userNames;
                        echo $displayName;
                    @endphp
                </h4>
            @else
                <div class="d-flex flex-column">
                    <h4>{!! getName($user_id) !!}</h4>
                    {{-- <span>{{formatTimeAgo($activities, 'select') }}</span> --}}
                </div>
            @endif
            {{-- <a  class="message-action text-red-500 me-3"><i class="icon-feather-trash-2"></i>
        <span class="md:inline hidden"> Xóa cuộc trò chuyện</span> </a> --}}
            <button uk-toggle="target: #custom" type="button" class="md:absolute right-0 me-2"><i
                    class="icon-feather-menu" style="font-size: 20px"></i>
            </button>
            <div id="custom" uk-offcanvas="flip: true" style="z-index: 9999;" wire:ignore>
                <div class="uk-offcanvas-bar bg-light profile_dropdown ">
                    <div class="flex flex-col">
                        <button class="uk-offcanvas-close" type="button" uk-close></button>
                        <h3 style="line-height:50px;font-size:20px" class="ps-3">Công cụ trò chuyện</h3>
                    </div>
                    <div class="container">
                        <div class="flex flex-col justify-content-center  align-items-center">
                            @if ($isGroupChat)
                                <div class="flex items-center justify-center flex-col">
                                    <div class="message-avatar " style="left:-15px!important">
                                        <div class="flex -space-x-3">
                                            @php $userIds = $conversationsGroup->users->pluck('user_id')->toArray(); @endphp
                                            @foreach ($userIds as $userId)
                                                @php
                                                    $trimmedUserId = trim($userId, '[]');
                                                @endphp
                                                <div class="message-avatar avatar-group">
                                                    {!! getAvatar($trimmedUserId) !!}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <h4 class="text-center">
                                    @php
                                        $conversationName = \App\Models\ConversationsModel::where('conversations_id', $user_id)
                                            ->pluck('name')
                                            ->first();
                                        $userNames = getNames($conversationsGroup->users->pluck('user_id')->toArray(), 'group');
                                        $displayName = $conversationName ?: $userNames;
                                        echo $displayName;
                                    @endphp
                                </h4>
                            @else
                                {!! getAvatar($user_id, 'online') !!}
                                <h4 class="text-center">
                                    {!! getName($user_id) !!}
                                </h4>
                                <div class="mt-0">
                                    <a href="{{ route('profile', ['id' => $user_id]) }}"
                                        class="inline-block rounded-lg text-sm font-semibold bg-secondery">Xem
                                        trang cá nhân</a>
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-col mt-2">
                            <ul class="list-none p-0 m-0">
                                <h4 class="dark:text-black">Tùy chỉnh</h4>

                                <ul class="list-none p-0 m-0">
                                    @if (empty($block))
                                        <li class="list-group-item mb-2 cursor-pointer"
                                            uk-toggle="target: #colors; animation: uk-animation-fade ">Màu sắc</li>
                                        <ul class="color-variant flex align-items-center justify-content-center"
                                            id="colors" hidden>
                                            <li class="bg-p-white color-chat " wire:ignore=""
                                                wire:click="change('white','color')" style="background:white">
                                            </li>
                                            <li class="bg-p-yellow  color-chat" wire:ignore=""
                                                wire:click="change('yellow','color')" style="background:yellow">
                                            </li>
                                            <li class="bg-p-red  color-chat" wire:ignore=""
                                                wire:click="change('red','color')" style="background:red"></li>
                                            <li class="bg-p-orange  color-chat" wire:ignore=""
                                                wire:click="change('orange','color')" style="background:orange">
                                            </li>
                                        </ul>
                                    @endif
                                </ul>
                                @if ($isGroupChat)
                                    <ul class="list-none p-0 m-0">
                                        <li class="list-group-item mb-2 cursor-pointer"
                                            uk-toggle="target: #memberGroup; animation: uk-animation-fade">Thành
                                            viên
                                        </li>
                                        <div id="memberGroup" uk-modal>
                                            <div class="uk-modal-dialog uk-modal-body">
                                                <div class="flex justify-between align-items-center">
                                                    <h2 class="uk-modal-title">Thành viên</h2>
                                                    <h5 uk-toggle="target: #add_member">Thêm</h5>
                                                    <!-- This is the modal with the default close button -->
                                                    <div id="add_member" uk-modal>
                                                        <div class="uk-modal-dialog uk-modal-body">
                                                            <button class="uk-modal-close-default" type="button"
                                                                uk-close></button>
                                                            <h2 class="uk-modal-title">Thêm thành viên</h2>
                                                            @livewire('clients.conversations.search-member', ['member' => $memberGroup['conversations_id']])
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="uk-modal-close-default" type="button"
                                                    uk-close></button>
                                                <nav class="responsive-nav border-b extanded mb-2 -mt-2">
                                                    <ul uk-switcher="connect: #mem_group; animation: uk-animation-fade"
                                                        class="overflow-y-hidden">
                                                        <li class="uk-active"><a class="active"
                                                                href="#allMembers">
                                                                Tất cả </a>
                                                        </li>
                                                        <li><a href="#admins"> Quản trị viên</a></li>
                                                    </ul>
                                                </nav>
                                                <div id="mem_group" class="uk-switcher">
                                                    <div id="allMembers" class="uk-active h-60" data-simplebar>
                                                        <h6>{{ $memberGroup['count'] }} thành viên</h6>
                                                        <ul class="list-none p-0 m-0 h-max">
                                                            @foreach ($memberGroup['member'] as $index => $member)
                                                                <li class="cursor-pointer"
                                                                    wire:key="{{ $member->user_id }}">
                                                                    <div class="flex justify-between">
                                                                        <div class="flex ">
                                                                            <div class="drop_avatar flex me-2"
                                                                                style="padding:5px;">
                                                                                {!! getAvatar($member->user_id) !!}
                                                                            </div>
                                                                            <div class="drop_text">
                                                                                <strong
                                                                                    style=" white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 80px;">
                                                                                    {!! getName($member->user_id) !!}
                                                                                </strong>
                                                                                <p>{{ $member->role == 1 ? 'Quản trị viên' : 'Thành viên' }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <ion-icon
                                                                            uk-dropnav="target: !#u-{{ $member->user_id }};"
                                                                            name="ellipsis-vertical-outline"></ion-icon>
                                                                        <div class="bg-white shadow-lg p-2 uk-card uk-card-body uk-card-default "
                                                                            uk-drop="pos:left-center;mode: click"
                                                                            id="u-{{ $member->user_id }}">
                                                                            <ul class="uk-list p-0">
                                                                                @if ($member->user_id == auth()->user()->user_id)
                                                                                    <li class="p-2">Chức năng
                                                                                        hiện
                                                                                        đang cập nhật!
                                                                                    </li>
                                                                                @else
                                                                                    @if ($memberGroup['user_now']['role'] != 1)
                                                                                        <li class="p-2">Chức
                                                                                            năng hiện đang cập nhật
                                                                                        </li>
                                                                                    @else
                                                                                        @if ($member->user_id != auth()->user()->user_id)
                                                                                            <li data-index="{{ $index }}"
                                                                                                data-kick-userid="{{ $member->user_id }}"
                                                                                                class="p-2 cursor-pointer hover:bg-blue-200">
                                                                                                Xóa
                                                                                                khỏi nhóm
                                                                                                chat
                                                                                            </li>
                                                                                        @endif
                                                                                        @php
                                                                                            $log = \App\Models\Conversations_UsersModel::where('role', 1)
                                                                                                ->where('conversations_id', $user_id)
                                                                                                ->first();
                                                                                        @endphp
                                                                                        @if ($member->role == 1)
                                                                                            <li data-index-unqtv={{ $index }}
                                                                                                data-unqtv-userid="{{ $member->user_id }}"
                                                                                                class="p-2 cursor-pointer hover:bg-blue-200">
                                                                                                <a>Chỉ định làm
                                                                                                    thành
                                                                                                    viên</a>
                                                                                            </li>
                                                                                        @endif
                                                                                        @if (isset($log) && $log->role == 1 && $member->role != 1)
                                                                                            <li data-index-qtv={{ $index }}
                                                                                                data-qtv-userid="{{ $member->user_id }}"
                                                                                                class="p-2 cursor-pointer hover:bg-blue-200">
                                                                                                <a>Chỉ định làm
                                                                                                    quản trị
                                                                                                    viên</a>
                                                                                            </li>
                                                                                        @endif
                                                                                    @endif
                                                                                @endif
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div id="admins" class=" h-60" data-simplebar>
                                                        <h6>{{ $memberGroup['roleCount'] }} quản trị viên</h6>
                                                        <ul class="list-none p-0 m-0 h-max">
                                                            @foreach ($memberGroup['member'] as $member)
                                                                @if ($member->role == 1)
                                                                    <li>
                                                                        <a href="" class="flex">
                                                                            <div class="drop_avatar flex me-2"
                                                                                style="padding:5px;">
                                                                                {!! getAvatar($member->user_id) !!}
                                                                            </div>
                                                                            <div class="drop_text">
                                                                                <strong
                                                                                    style=" white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 80px;">
                                                                                    {!! getName($member->user_id) !!}
                                                                                </strong>
                                                                                <p>{{ $member->role == 1 ? 'Quản trị viên' : 'Thành viên' }}
                                                                                </p>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </ul>
                                    <ul class="list-none p-0 m-0">
                                        <li class="list-group-item mb-2 cursor-pointer"
                                            uk-toggle="target: #nameGroup; animation: uk-animation-fade">Tên nhóm
                                        </li>
                                        <ul class="p-0 color-variant flex align-items-center justify-content-center"
                                            id="nameGroup" hidden>
                                            <input type="text" wire:model='nameGroup' class="with-border"
                                                placeholder="Tên nhóm">
                                            <button
                                                class="bg-blue-600 font-semibold p-2 ms-2 rounded-md text-center text-white"
                                                wire:click="change('nameGroup','nameGroup')">Sửa</button>
                                        </ul>
                                    </ul>
                                    <li class="list-group-item mb-2">Ảnh nhóm</li>
                                @endif
                            </ul>
                            @if ($isGroupChat)
                                <ul class="list-none p-0 m-0">
                                    <h4>Quyền</h4>
                                    <li class="list-group-item mb-2 cursor-pointer" wire:click="change('','out')">
                                        Rời khỏi đoạn chat
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="message-content-scrolbar" data-simplebar="init"
            style="background-color: {{ isset($color) ? $color : 'white' }}">
            <!-- Message Content Inner -->
            <div class="message-content-inner max-h-96 overflow-y-auto relative z-1" id="conversation">
                <div class="flex items-center justify-center flex-col">
                    <div class="message-avatar relative">
                        @if ($isGroupChat)
                            <div class="flex items-center justify-center flex-col">
                                <div class="message-avatar" style="left:-15px!important">
                                    <div class="flex -space-x-3">
                                        @php $userIds = $conversationsGroup->users->pluck('user_id')->toArray(); @endphp
                                        @foreach ($userIds as $userId)
                                            @php
                                                $trimmedUserId = trim($userId, '[]');
                                            @endphp
                                            <div class="avatar-group">
                                                {!! getAvatar($trimmedUserId) !!}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            {!! getAvatar($user_id, 'online') !!}
                        @endif
                    </div>
                    <div class="message-text">
                        @if ($isGroupChat)
                            {{ getNames($conversationsGroup->users->pluck('user_id')->toArray(), 'group') }}
                        @else
                            {!! getName($user_id) !!}
                        @endif
                    </div>
                </div>
            @empty($messagesData)
                <p class="mt-2 text-center">Hãy bắt đầu 1 cuộc trò chuyện mới nhé!</p>
            @else
                @foreach ($messagesData as $chat)
                    @if ($chat['type'] === 'notification')
                        <div class="notification text-center">
                            <p class="text-center fw-bold">{{ $chat['data'] }}</p>
                        </div>
                    @else
                        <div class="message-time-sign" style="position: relative;z-index:1">
                            <span>{{ formatTimeAgo($chat['data']->time) }}</span>
                        </div>
                        @if (Auth::user()->user_id == $chat['data']->user_id)
                            <div class="message-bubble me">
                                <div class="message-bubble-inner">
                                    <div class="message-avatar">
                                        {!! getAvatar($chat['data']->user_id, 'online') !!}
                                    </div>
                                    <div class="message-text">
                                        @if (empty($chat['data']->source))
                                            {{ $chat['data']->message }}
                                        @else
                                            <img src="{{ $chat['data']->source }}" class="lazyloaded"
                                                style="width:355px;height:200px">
                                        @endif
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        @else
                            <div class="message-bubble">
                                <div class="message-bubble-inner">
                                    <div class="message-avatar">
                                        {!! getAvatar($chat['data']->user_id, 'online') !!}
                                    </div>
                                    <div class="message-text">
                                        @if (empty($chat['data']->source))
                                            {{ $chat['data']->message }}
                                        @else
                                            <img src="{{ $chat['data']->source }}" class="lazyloaded"
                                                style="width:355px;height:200px">
                                        @endif
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        @endif
                    @endif
                @endforeach
            @endempty
            @if (empty($isGroupChat))
                <div id="typing-chat" data-avatar="{{ getAvatar($user_id, 'online') }}"></div>
            @endif
        </div>
        <!-- Message Content Inner / End -->
        <!-- Reply Area -->
        @if (empty($memberGroup) || $memberGroup['user_now']['kick'] != '1')
            @if (empty($block))
                <div
                    class="message-reply z-10 d-flex align-items-center absolute bottom-0 bg-white w-full mt-5 right-0 py-2 px-4">
                    <div class="flex justify-between w-full gap-2 ">
                        <div class="chat-attagement d-flex gap-2 items-center">
                            <a href="#" class="is_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="25"
                                    fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path
                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                            </a>
                            <div wire:ignore
                                class="dropbar uk-dropbar-left pt-36 h-60 bg-gradient-to-t via-white from-white via-30% from-30% dark:from-slate-900 dark:via-900"
                                uk-drop="stretch: x; target: #message__wrap ;animation:  slide-bottom ;animate-out: true; pos: top-left; offset:10 ; mode: click ; duration: 200">
                                <div class="w-full p-3 flex justify-center gap-3"
                                    uk-scrollspy="target: > button; cls: uk-animation-slide-bottom-small; delay: 100;repeat:true">
                                    <button type="button" id="uploadMessage"
                                        class="bg-sky-50 text-sky-600 border border-sky-100 shadow-sm p-2.5 rounded-full shrink-0 duration-100 hover:scale-[1.15] dark:bg-dark3 dark:border-0">
                                        <ion-icon class="text-3xl flex" name="image"></ion-icon>
                                    </button>
                                    <input type="file" id="fileInput" style="display: none;"
                                        wire:ignore />
                                </div>
                            </div>

                            <a href="#" class="d-flex align-items-center pe-3">
                                <svg class="icon-24" width="18" height="23" viewBox="0 0 18 23"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.00021 21.5V18.3391" stroke="currentcolor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.00021 14.3481V14.3481C6.75611 14.3481 4.9384 12.5218 4.9384 10.2682V5.58095C4.9384 3.32732 6.75611 1.5 9.00021 1.5C11.2433 1.5 13.061 3.32732 13.061 5.58095V10.2682C13.061 12.5218 11.2433 14.3481 9.00021 14.3481Z"
                                        stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                    <path
                                        d="M17 10.3006C17 14.7394 13.418 18.3383 9 18.3383C4.58093 18.3383 1 14.7394 1 10.3006"
                                        stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                    <path d="M11.0689 6.25579H13.0585" stroke="currentcolor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M10.0704 9.59344H13.0605" stroke="currentcolor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </div>

                        <div class="relative flex-1 w-full flex">
                            <div class="uk-button" id="emoji-picker-container"
                                style="left: 13px;position: absolute;top: 50%;transform: translateY(-50%);">
                                <div class="uk-inline">
                                    <svg style="color:#0D6EFD" class="icon-24" width="24"
                                        viewBox="0 0 24 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_156_599)">
                                            <path
                                                d="M20.4853 4.01473C18.2188 1.74823 15.2053 0.5 12 0.5C8.79469 0.5 5.78119 1.74823 3.51473 4.01473C1.24819 6.28119 0 9.29469 0 12.5C0 15.7053 1.24819 18.7188 3.51473 20.9853C5.78119 23.2518 8.79469 24.5 12 24.5C15.2053 24.5 18.2188 23.2518 20.4853 20.9853C22.7518 18.7188 24 15.7053 24 12.5C24 9.29469 22.7518 6.28119 20.4853 4.01473ZM12 23.0714C6.17091 23.0714 1.42856 18.3291 1.42856 12.5C1.42856 6.67091 6.17091 1.92856 12 1.92856C17.8291 1.92856 22.5714 6.67091 22.5714 12.5C22.5714 18.3291 17.8291 23.0714 12 23.0714Z"
                                                fill="currentcolor"></path>
                                            <path
                                                d="M9.40398 9.3309C8.23431 8.16114 6.33104 8.16123 5.16136 9.3309C4.88241 9.60981 4.88241 10.0621 5.16136 10.3411C5.44036 10.62 5.89266 10.62 6.17157 10.3411C6.78432 9.72836 7.78126 9.7284 8.39392 10.3411C8.53342 10.4806 8.71618 10.5503 8.89895 10.5503C9.08171 10.5503 9.26457 10.4806 9.40398 10.3411C9.68293 10.0621 9.68293 9.60986 9.40398 9.3309Z"
                                                fill="currentcolor"></path>
                                            <path
                                                d="M18.8384 9.3309C17.6688 8.16123 15.7655 8.16114 14.5958 9.3309C14.3169 9.60981 14.3169 10.0621 14.5958 10.3411C14.8748 10.62 15.3271 10.62 15.606 10.3411C16.2187 9.72836 17.2156 9.72831 17.8284 10.3411C17.9679 10.4806 18.1506 10.5503 18.3334 10.5503C18.5162 10.5503 18.699 10.4806 18.8384 10.3411C19.1174 10.0621 19.1174 9.60986 18.8384 9.3309Z"
                                                fill="currentcolor"></path>
                                            <path
                                                d="M18.3335 13.024H5.6668C5.2723 13.024 4.95251 13.3438 4.95251 13.7383C4.95251 17.6243 8.11409 20.7859 12.0001 20.7859C15.8862 20.7859 19.0477 17.6243 19.0477 13.7383C19.0477 13.3438 18.728 13.024 18.3335 13.024ZM12.0001 19.3573C9.14366 19.3573 6.77816 17.215 6.42626 14.4525H17.574C17.2221 17.215 14.8566 19.3573 12.0001 19.3573Z"
                                                fill="currentcolor"></path>
                                        </g>
                                        <defs>
                                            <clipPath>
                                                <rect width="24" height="24" fill="white"
                                                    transform="translate(0 0.5)">
                                                </rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div uk-dropdown="mode: click; target: !.uk-button-group;"
                                    class="uk-drop uk-dropdown"
                                    style="top: -274px; left: 0px; max-width: 1313px;">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        <div style="display: none;" id="emoji-div" class="relative z-100">
                                        </div>
                                    </ul>
                                </div>
                            </div>
                            <div class="w-full">
                                @if ($uploadedImage)
                                    <img src="{{ $uploadedImage }}" alt="Uploaded Image"
                                        style="width: 50px;">
                                @endif
                                <textarea id="chat" cols="10" rows="1" placeholder="Tin nhắn" style="border: 1px solid #0584ec;"
                                    class="ps-5 w-full" wire:model.live='text' wire:change="statusMess('change1')"
                                    wire:keydown="statusMess('keydown')"></textarea>
                            </div>
                        </div>
                        <button class="button ripple-effect" wire:click='sendMess'>Gửi</button>

                    </div>
                    <!--Emoji!-->
                    {{-- <div id="dropdownHelper"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-60 dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownHelperButton">
                            <li>
                                <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <div class="flex items-center h-5">
                                        <input id="helper-checkbox-1"
                                            aria-describedby="helper-checkbox-text-1" type="checkbox"
                                            value=""
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    </div>
                                    <div class="ml-2 text-sm">
                                        <label for="helper-checkbox-1"
                                            class="font-medium text-gray-900 dark:text-gray-300">
                                            <div>Enable notifications</div>
                                            <p id="helper-checkbox-text-1"
                                                class="text-xs font-normal text-gray-500 dark:text-gray-300">
                                                Some
                                                helpful
                                                instruction goes over here.
                                            </p>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <div class="flex items-center h-5">
                                        <input id="helper-checkbox-2"
                                            aria-describedby="helper-checkbox-text-2" type="checkbox"
                                            value=""
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    </div>
                                    <div class="ml-2 text-sm">
                                        <label for="helper-checkbox-2"
                                            class="font-medium text-gray-900 dark:text-gray-300">
                                            <div>Enable 2FA auth</div>
                                            <p id="helper-checkbox-text-2"
                                                class="text-xs font-normal text-gray-500 dark:text-gray-300">
                                                Some
                                                helpful
                                                instruction goes over here.
                                            </p>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <div class="flex items-center h-5">
                                        <input id="helper-checkbox-3"
                                            aria-describedby="helper-checkbox-text-3" type="checkbox"
                                            value=""
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    </div>
                                    <div class="ml-2 text-sm">
                                        <label for="helper-checkbox-3"
                                            class="font-medium text-gray-900 dark:text-gray-300">
                                            <div>Subscribe newsletter</div>
                                            <p id="helper-checkbox-text-3"
                                                class="text-xs font-normal text-gray-500 dark:text-gray-300">
                                                Some
                                                helpful
                                                instruction goes over here.
                                            </p>
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                </div>
            @else
                <div
                    class="z-10 d-flex align-items-center absolute bottom-0 bg-white w-full mt-5 right-0 py-2 px-4">
                    <div class="flex w-full justify-center items-center border-t-2">
                        <div class="chat-attagement d-flex justify-center items-center col-span-2">
                            <p class="text-center text-danger mt-3">Hiện tại bạn không thể trả lời tin nhắn
                                này!</p>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div
                class="message-reply z-10 d-flex align-items-center absolute bottom-0 bg-white w-full mt-5 right-0 py-2 px-4">
                <div class="flex justify-center w-full gap-2 ">
                    <div
                        class="chat-attagement d-flex gap-2 items-center text-center justify-center align-items-center">
                        <h4 class="text-center">Bạn đã rời khỏi đoạn chat</h4>
                    </div>
                </div>
            </div>
        @endif
    </div>
@else
    <div class="container">
        <div class="message-content-scrolbar flex  align-items-center justify-center">
            <h4 class="text-center">Bạn đã rời khỏi đoạn chat</h4>
        </div>
    </div>
@endif
@endif
</div>
