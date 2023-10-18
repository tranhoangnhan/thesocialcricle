<div>
    @foreach ($conversations as $key => $conversation)
        <li class="">
            <a wire:navigate href="{{ route('messages', ['id' => $conversation->users[$key]->user_id])}}">
                <div class="message-avatar"><i class="status-icon status-offline"></i>
                        {!! getAvatar($conversation->users[$key]->user_id) !!}
                    </div>
                <div class="message-by">
                    <div class="message-by-headline">
                        <h5>{!! getName($conversation->users[$key]->user_id) !!}</h5>
                        @if ($conversation->lastMessage)
                        <span>{{ $conversation->lastMessage->time }}</span> <!-- In thời gian tin nhắn cuối cùng -->
                    @endif
                    </div>
                    <p>{{ $conversation->lastMessage->message }}</p>
                </div>
            </a>
        </li>
    @endforeach
</div>
