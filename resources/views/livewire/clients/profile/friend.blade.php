<div>
    <nav class="responsive-nav border-b">
        <ul uk-switcher="connect: #friendList;animation: uk-animation-fade; toggle: > *" wire:ignore
            class=" overflow-y-hidden">
            <li {!! $selectTabFriends == 'all' ? 'class="uk-active cursor-point" aria-expanded="true"' : 'class="cursor-point"' !!} wire:ignore>
                <a class="lg:px-2" wire:click="selectTab('all')"> Tất cả bạn bè <span>
                        {{ countFriend($data->user_id) }}
                    </span></a>
            </li>
            <li {!! $selectTabFriends == 'recent'
                ? 'class="uk-active cursor-point" aria-expanded="true"'
                : 'class="cursor-point"' !!} wire:ignore>
                <a class="lg:px-2" wire:click="selectTab('recent')"> Đã thêm gần đây </a>
            </li>
            <li {!! $selectTabFriends == 'birthday'
                ? 'class="uk-active cursor-point" aria-expanded="true"'
                : 'class="cursor-point"' !!} wire:ignore>
                <a class="lg:px-2" wire:click="selectTab('birthday')" wire:ignore> Sinh nhật </a>
            </li>
            <li {!! $selectTabFriends == 'city' ? 'class="uk-active cursor-point" aria-expanded="true"' : 'class="cursor-point"' !!} wire:ignore>
                <a class="lg:px-2" wire:click="selectTab('city')" wire:ignore> Tỉnh thành phố hiện tại </a>
            </li>
        </ul>
    </nav>
    <ul class="uk-switcher" id="friendList">
        <li {!! $selectTabFriends == 'all' ? 'class="uk-active cursor-point"' : 'class="cursor-point"' !!}>
            @if (isset($friends))
                <div class="grid md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-x-2 gap-y-4 mt-3">
                    @if (isset($friends))
                        @foreach ($friends as $row)
                            <div class="card p-2" wire:key="{{ $row->user_id }}">
                                <a href="{{ route('profile', ['id' => $row->user_username]) }}">
                                    {!! getAvatar(
                                        $row->user_id,
                                        null,
                                        'border-radius:10px;font-size:30px!important;font-family: Arial, Helvetica, sans-serif;
                                                                                                                                                                                    background: #2a64e2f5;
                                                                                                                                                                                    font-size: 16px;
                                                                                                                                                                                    color: #fff;
                                                                                                                                                                                    text-align: center;
                                                                                                                                                                                    display: flex;
                                                                                                                                                                                    justify-content: center;
                                                                                                                                                                                    align-items: center;',
                                        'h-36 object-cover shadow-sm w-full',
                                    ) !!}
                                </a>
                                <div class="pt-3 px-1">
                                    <a href="{{ route('profile', ['id' => $row->user_username]) }}"
                                        class="text-base font-semibold mb-0.5"> {{ $row->user_fullname }} </a>
                                    <p class="font-medium text-sm">
                                        X Theo dõi
                                    </p>

                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>

                @if (countFriend($data->user_id) > $perPage[$selectTabFriends])
                    <div class="flex justify-center mt-6">
                        <a wire:click='loadMoreFriendsList'
                            class="cursor-pointer bg-white font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                            Xem thêm ..</a>
                    </div>
                @endif
            @else
                <p class="text-center my-5">Không có bạn bè</p>
            @endif


        </li>
        <li {!! $selectTabFriends == 'recent' ? 'class="uk-active cursor-point"' : 'class="cursor-point"' !!}>
            @if (isset($friendsReCent))
                <div class="grid md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-x-2 gap-y-4 mt-3">
                    @if (isset($friendsReCent))
                        @foreach ($friendsReCent as $row)
                            <div class="card p-2" wire:key="{{ $row->user_id }}">
                                <a href="{{ route('profile', ['id' => $row->user_username]) }}">
                                    {!! getAvatar(
                                        $row->user_id,
                                        null,
                                        'border-radius:10px;font-size:30px!important;font-family: Arial, Helvetica, sans-serif;
                                                                                                                background: #2a64e2f5;
                                                                                                                font-size: 16px;
                                                                                                                color: #fff;
                                                                                                                text-align: center;
                                                                                                                display: flex;
                                                                                                                justify-content: center;
                                                                                                                align-items: center;',
                                        'h-36 object-cover shadow-sm w-full',
                                    ) !!}
                                </a>
                                <div class="pt-3 px-1">
                                    <a href="{{ route('profile', ['id' => $row->user_username]) }}"
                                        class="text-base font-semibold mb-0.5"> {{ $row->user_fullname }} </a>
                                    <p class="font-medium text-sm">
                                        X Theo dõi
                                    </p>
                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>
                @if (countFriend($data->user_id) > $perPage[$selectTabFriends])
                    <div class="flex justify-center mt-6">
                        <a wire:click='loadMoreFriendsList'
                            class="cursor-pointer bg-white font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                            Xem thêm ..</a>
                    </div>
                @endif
            @else
                <p class="text-center my-5">Không có bạn bè</p>
            @endif
        </li>
        <li {!! $selectTabFriends == 'birthday' ? 'class="uk-active cursor-point"' : 'class="cursor-point"' !!}>
            @if (isset($friendsBirthday))
                <div class="grid md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-x-2 gap-y-4 mt-3">
                    @if (isset($friendsBirthday))
                        @foreach ($friendsBirthday as $row)
                            <div class="card p-2" wire:key="{{ $row->user_id }}">
                                <a href="{{ route('profile', ['id' => $row->user_username]) }}">
                                    {!! getAvatar(
                                        $row->user_id,
                                        null,
                                        'border-radius:10px;font-size:30px!important;font-family: Arial, Helvetica, sans-serif;
                                                                            background: #2a64e2f5;
                                                                            font-size: 16px;
                                                                            color: #fff;
                                                                            text-align: center;
                                                                            display: flex;
                                                                            justify-content: center;
                                                                            align-items: center;',
                                        'h-36 object-cover shadow-sm w-full',
                                    ) !!}
                                </a>
                                <div class="pt-3 px-1">
                                    <a href="{{ route('profile', ['id' => $row->user_username]) }}"
                                        class="text-base font-semibold mb-0.5"> {{ $row->user_fullname }} </a>
                                    <p class="font-medium text-sm">
                                        {{ Carbon::parse($row->user_birthday)->format('d-m-Y') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>
                @if (countFriend($data->user_id) > $perPage[$selectTabFriends])
                    <div class="flex justify-center mt-6">
                        <a wire:click='loadMoreFriendsList'
                            class="cursor-pointer bg-white font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                            Xem thêm ..</a>
                    </div>
                @endif
            @else
                <p class="text-center my-5">Không có bạn bè</p>
            @endif
        </li>
        <li {!! $selectTabFriends == 'city' ? 'class="uk-active cursor-point"' : 'class="cursor-point"' !!}>
            @if (isset($friendsCity))
                <div class="grid md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-x-2 gap-y-4 mt-3">
                    @if (isset($friendsCity))
                        @foreach ($friendsCity as $row)
                            <div class="card p-2" wire:key="{{ $row->user_id }}">
                                <a href="{{ route('profile', ['id' => $row->user_username]) }}">
                                    {!! getAvatar(
                                        $row->user_id,
                                        null,
                                        'border-radius:10px;font-size:30px!important;font-family: Arial, Helvetica, sans-serif;
                                        background: #2a64e2f5;
                                        font-size: 16px;
                                        color: #fff;
                                        text-align: center;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;',
                                        'h-36 object-cover shadow-sm w-full',
                                    ) !!}
                                </a>
                                <div class="pt-3 px-1">
                                    <a href="{{ route('profile', ['id' => $row->user_username]) }}"
                                        class="text-base font-semibold mb-0.5"> {{ $row->user_fullname }} </a>
                                    <p class="font-medium text-sm">
                                        {{ $row->combinedHomeTown }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>
                @if (countFriend($data->user_id) > $perPage[$selectTabFriends])
                    <div class="flex justify-center mt-6">
                        <a wire:click='loadMoreFriendsList'
                            class="cursor-pointer bg-white font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                            Xem thêm ..</a>
                    </div>
                @endif
            @else
                <p class="text-center my-5">Không có bạn bè chung huyện / tỉnh.</p>
            @endif
        </li>
    </ul>
</div>
