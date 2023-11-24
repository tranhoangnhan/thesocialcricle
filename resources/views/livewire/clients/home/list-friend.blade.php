<div>
    @isset($friends)
        @foreach ($friends as $friend)
            @if ($friend)
                @if ($friend->user_one_id == auth()->user()->user_id)
                    @php $user_id = $friend->user_two_id; @endphp
                @else
                    @php $user_id = $friend->user_one_id; @endphp
                @endif
                <a href="{{ route('messages', ['id' => $user_id]) }}">
                    <div class="contact-avatar">
                        {!! getAvatar($user_id, 'online') !!}
                    </div>
                    <div class="contact-username">
                        {!! getName($user_id) !!}
                    </div>
                </a>
            @endif
        @endforeach
    @endisset
</div>
