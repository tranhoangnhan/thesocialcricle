<div>
    @if (isset($type) && $type == 'header')
    @empty($conversations)
    @else
        <div class="drop_headline">
            <h4>Tin nhắn </h4>
            <div class="btn_action">
                <a id="markAsReadMessage" data-tippy-placement="left" title="Đánh dấu tất cả đã đọc" wire:ignore>
                    <ion-icon name="checkbox-outline"></ion-icon>
                </a>
            </div>
        </div>
        <ul>
            <input type="text" wire:model.live='searchUsers1' placeholder="Tìm kiếm người dùng"
                style="background: #f3f4f6;
        border-radius: 2rem;
        margin: 0 6px 6px 0;
        height: 38px;
        font-weight: 500;
        font-size: 14px;
        width:100%;
        display: flex;
        margin: 0.5rem auto!important;
        align-items: center;">
            @foreach ($conversations as $conversation)
                @if ($conversation->lastMessage)
                    @php
                        $user = $conversation->users->firstWhere('user_id', '<>', auth()->user()->user_id);
                        $myuser = \DB::table('conversations_users')
                            ->where('user_id', auth()->user()->user_id)
                            ->where('conversations_id', $conversation->conversations_id)
                            ->first();
                        $isGroupChat = $conversation->users->count() > 1;
                    @endphp
                    @if ($user && $myuser->kick == 0)
                        <li class="{{ $myuser->seen == 0 ? 'un-read-chat' : '' }}">
                            <a
                                href="{{ $isGroupChat ? route('messagesGroup', ['id' => $conversation->conversations_id]) : route('messages', ['id' => $user->user_id]) }}">
                                <div class="drop_avatar flex" style="padding:5px">
                                    @if ($isGroupChat)
                                        <div class="flex items-center justify-center flex-col">
                                            <div class="message-avatar" style="left:-15px!important">
                                                <div class="flex -space-x-7">
                                                    @php $userIds = $conversation->users->pluck('user_id')->toArray(); @endphp
                                                    @foreach ($userIds as $userId)
                                                        @php
                                                            $trimmedUserId = trim($userId, '[]');
                                                        @endphp
                                                        <div class="message-avatar avatar-group">
                                                            {!! getAvatar($trimmedUserId, 'online') !!}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        {!! getAvatar($user->user_id, 'online') !!}
                                    @endif
                                </div>
                                <div class="drop_text ms-2">
                                    @if ($isGroupChat)
                                        <strong
                                            class="overflow-ellipsis overflow-hidden whitespace-nowrap max-w-[70px]">
                                            {{ $conversation->name ?: getNames($conversation->users->pluck('user_id')->toArray(), 'group') }}
                                        </strong>
                                    @else
                                        <strong>
                                            {!! getName($user->user_id) !!}
                                        </strong>
                                    @endif
                                    <time>{{ formatTimeAgo($conversation->lastMessage->time, 'select') }}</time>
                                    @if (empty($conversation->lastMessage->message) || $conversation->lastMessage->message == null)
                                        <p>Gửi 1 hình ảnh</p>
                                    @else
                                        <p>{{ $conversation->lastMessage->message }} </p>
                                    @endif
                                </div>
                            </a>
                        </li>
                    @endif
                @endif
            @endforeach
        </ul>
    @endempty
@else
@empty($conversations)
@else
    <input type="text" wire:model.live='searchUsers' placeholder="Tìm kiếm người dùng"
        style="background: #f3f4f6;
        border-radius: 2rem;
        margin: 0 6px 6px 0;
        height: 38px;
        font-weight: 500;
        font-size: 14px;
        width:96%;
        display: flex;
        margin: 0.5rem auto!important;
        align-items: center;">

    @foreach ($conversations as $conversation)
        @if ($conversation->lastMessage)
            @php
                $user = $conversation->users->firstWhere('user_id', '<>', auth()->user()->user_id);
                $myuser = \DB::table('conversations_users')
                    ->where('user_id', auth()->user()->user_id)
                    ->where('conversations_id', $conversation->conversations_id)
                    ->first();
                $isGroupChat = $conversation->users->count() > 1;
            @endphp
            @if ($user && $myuser->kick == 0)
                <li class="{{ $myuser->seen == 0 ? 'un-read-chat' : '' }}">
                    <a
                        href="{{ $isGroupChat ? route('messagesGroup', ['id' => $conversation->conversations_id]) : route('messages', ['id' => $user->user_id]) }}">
                        <div class="message-avatar"><i class="status-icon status-offline"></i>
                            @if ($isGroupChat)
                                <div class="flex items-center justify-center flex-col">
                                    <div class="message-avatar" style="left:-15px!important">
                                        <div class="flex -space-x-3">
                                            @php $userIds = $conversation->users->pluck('user_id')->toArray(); @endphp
                                            @foreach ($userIds as $userId)
                                                @php
                                                    $trimmedUserId = trim($userId, '[]');
                                                @endphp
                                                <div class="message-avatar avatar-group">
                                                    {!! getAvatar($trimmedUserId, 'online') !!}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @else
                                {!! getAvatar($user->user_id, 'online') !!}
                            @endif
                        </div>
                        <div class="message-by">
                            <div class="message-by-headline flex justify-between">
                                @if ($isGroupChat)
                                    <h5
                                        style=" white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 160px;">
                                        {{ $conversation->name ?: getNames($conversation->users->pluck('user_id')->toArray(), 'group') }}
                                    </h5>
                                @else
                                    <h5>
                                        {!! getName($user->user_id) !!}
                                    </h5>
                                @endif
                                <span>{{ formatTimeAgo($conversation->lastMessage->time, 'select') }}</span>
                            </div>
                            @if (empty($conversation->lastMessage->message) || $conversation->lastMessage->message == null)
                                <p>Gửi 1 hình ảnh</p>
                            @else
                                <p>{{ $conversation->lastMessage->message }} </p>
                            @endif
                        </div>
                    </a>
                </li>
            @endif
        @endif
    @endforeach
@endempty
@endif
</div>
