<div>
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

                    <a href="{{ $isGroupChat ? route('messagesGroup', ['id' => $conversation->conversations_id]) : route('messages', ['id' => $user->user_id]) }}">
                        <div class="message-avatar"><i class="status-icon status-offline"></i>
                            @if ($isGroupChat)
                                <div class="flex items-center justify-center flex-col">
                                    <div class="message-avatar" style="left:-15px!important">
                                        <div class="flex -space-x-5">
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

                            @endif
                        </div>
                        <div class="contact-username ms-2"> @if ($isGroupChat)
                            <h6
                                style=" white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 160px;">
                                {{ $conversation->name ?: getNames($conversation->users->pluck('user_id')->toArray(), 'group') }}
                            </h6>
                        @endif</div>
                    </a>

            @endif
        @endif
    @endforeach
</div>
