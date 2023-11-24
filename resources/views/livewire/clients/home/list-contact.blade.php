<div>
    @isset($friends)
        @foreach ($friends as $friend)
            @if ($friend)
                @if ($friend->user_one_id == auth()->user()->user_id)
                    @php $user_id = $friend->user_two_id; @endphp
                @else
                    @php $user_id = $friend->user_one_id; @endphp
                @endif
                <a href="#">
                    <div class="contact-avatar">
                        {!! getAvatar($user_id, 'online') !!}
                    </div>
                    <div class="contact-username line-clamp-1 leading-6">
                        {!! getName($user_id) !!} </div>
                </a>
                <div uk-drop="pos: left-center ;animation: uk-animation-slide-left-small">
                    <div class="contact-list-box">
                        <div class="contact-avatar">
                            {!! getAvatar($user_id, NULL,'width: 60px;
                            height: 60px;
                            margin-right: 5px;display:flex;justify-content:center') !!}
                        </div>
                        <div class="contact-username text-center m-auto flex justify-content-center">
                            {!! getName($user_id) !!} </div>
                        <p>
                            <ion-icon name="people" class="text-lg mr-1"></ion-icon> Bạn chung với
                            <strong> A </strong> and <strong> 14 người khác</strong>
                        </p>
                        <div class="contact-list-box-btns">
                            <button type="button" onclick="window.location.href = '{{ route('messages', ['id' => $user_id]) }}'" class="button primary flex-1 block mr-2">
                                <i class="uil-envelope mr-1"></i> Nhắn tin</button>
                            <button type="button" onclick="window.location.href = '{{ route('profile', ['id' => $user_id]) }}'" class="button secondary button-icon mr-2">
                                <i class="uil-user"> </i> </button>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endisset
</div>
