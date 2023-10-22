<div>
    <a href="#" class="is_icon" uk-tooltip="title: Thông báo">
        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
            </path>
        </svg>
        <span id="count-display">{{ $count }}</span>
    </a>
    <div uk-drop="mode: click" class="header_dropdown">
        <div class="dropdown_scrollbar">
            <div class="drop_headline">
                <h4>Thông báo</h4>
                <div class="btn_action">
                    <a wire:click="markAsRead" data-tippy-placement="left" title="Đã xem">
                        <ion-icon name="checkbox-outline"></ion-icon>
                    </a>
                </div>
            </div>
            <ul id="notification-list">
                @foreach ($notifications as $noti)
                    <li class="notification-{{ $noti->seen }}">
                        <a href="#">
                            <div class="drop_avatar"> <img
                                    src="{{ asset('clients/assets/images/avatars/avatar-2.jpg') }}" alt="">
                            </div>
                            <div class="drop_text">
                                <p>
                                    {{ $noti->message }}
                                </p>
                                <time> @php
                                    $createdAt = $noti->created_at;
                                    $now = now();
                                    $diffInSeconds = $now->diffInSeconds($createdAt);
                                    $diffInMinutes = $now->diffInMinutes($createdAt);
                                    $diffInHours = $now->diffInHours($createdAt);
                                    $diffInDays = $now->diffInDays($createdAt);
                                @endphp

                                    {{-- Hiển thị thời gian --}}
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
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
