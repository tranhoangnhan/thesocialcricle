<div>
    <div class="dropdown">
        <a href="#" class="is_icon" uk-tooltip="title: Thông báo" id="dropdownMenuButton1" data-bs-toggle="dropdown">
            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                </path>
            </svg>
            <span id="count-display">{{ $count }}</span>
        </a>
        <ul id="notification-list" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <div class="d-flex justify-content-between p-2">
                <span>Thông báo</span>
                <button wire:click='markAsRead'><i class="uil-check" title="Đã xem"></i></button>
            </div>
            @if (!is_null($notifications))
                @foreach ($notifications as $noti)
                    <li class="notification-{{ $noti->seen }} dropdown-item p-4">
                        <div class="drop_avatar d-flex justify-content-center align-items-center" onclick="window.location.href = '{{$noti->node_url}}';">

                                {!! getAvatar(
                                    $noti->to_user_id,
                                    null,
                                    'border-radius:10px;font-size:30px!important;font-family: Arial, Helvetica, sans-serif;
                                    background: #2a64e2f5;
                                    font-size: 16px;
                                    color: #fff;
                                    text-align: center;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;',
                                    'w-8 h-8 rounded-full',
                                ) !!}

                                <p class="text-sm m-1">{{ $noti->message }}</p>


                        </div>
                        <div class="drop_text">
                            <time class="text-xs mx-4">
                                @php
                                    $createdAt = $noti->created_at;
                                    $now = now();
                                    $diffInSeconds = $now->diffInSeconds($createdAt);
                                    $diffInMinutes = $now->diffInMinutes($createdAt);
                                    $diffInHours = $now->diffInHours($createdAt);
                                    $diffInDays = $now->diffInDays($createdAt);
                                @endphp

                                @if ($diffInSeconds < 60)
                                    {{ $diffInSeconds }} giây trước
                                @elseif ($diffInMinutes < 60)
                                    {{ $diffInMinutes }} phút trước
                                @elseif ($diffInHours < 24)
                                    {{ $diffInHours }} giờ trước
                                @else
                                    {{ $diffInDays }} ngày trước
                                @endif
                            </time>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
