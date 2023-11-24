<div>
    <div class="mb-6">
        <h2 class="text-2xl font-semibold"> Cài đặt</h2>
        <nav class="responsive-nav border-b md:m-0 -mx-4 ">
            <ul uk-switcher="connect: #form-type; animation: uk-animation-fade toggle: > *" class="overflow-y-hidden">
                <li {!! $selectTabSetting == 'profile'
                    ? 'class="uk-active cursor-pointer mr-2" aria-expanded="true"'
                    : 'class="cursor-pointer  mr-2"' !!} wire:ignore class="uk-active">
                    <a wire:click="selectTab('profile')" wire:ignore class="lg:px-2 cursor-pointer"> Trang cá nhân</a>
                </li>
                <li {!! $selectTabSetting == 'block'
                    ? 'class="uk-active   mr-2" aria-expanded="true"'
                    : 'class="cursor-pointer  mr-2"' !!} wire:ignore class="uk-active">
                    <a wire:click="selectTab('block')" wire:ignore class="lg:px-2 cursor-pointer"> Chặn </a>
                </li>
                <li {!! $selectTabSetting == 'history'
                    ? 'class="uk-active   mr-2" aria-expanded="true"'
                    : 'class="cursor-pointer  mr-2"' !!} wire:ignore class="uk-active">
                    <a wire:click="selectTab('history')" wire:ignore class="lg:px-2 cursor-pointer"> Lịch sử truy
                        cập</a>
                </li>
                <li {!! $selectTabSetting == 'security'
                    ? 'class="uk-active cursor-pointer mr-2" aria-expanded="true"'
                    : 'class="cursor-pointer  mr-2"' !!} wire:ignore class="uk-active">
                    <a wire:click="selectTab('security')" wire:ignore class="lg:px-2 cursor-pointer"> Bảo mật </a>
                </li>
            </ul>
        </nav>
    </div>
    <div id="form-type" class="uk-switcher">
        <div {!! $selectTabSetting == 'profile'
            ? 'class="uk-active cursor-pointer grid lg:grid-cols-3 mt-12 gap-8"'
            : 'class="cursor-pointer grid lg:grid-cols-3 mt-12 gap-8"' !!}>


            <div>
                <h3 class="text-xl mb-2 font-semibold"> Cấu hình chung</h3>
            </div>
            <div class="bg-white rounded-md lg:shadow-lg shadow col-span-2 lg:p-6 p-4 lg:mx-16">

                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <div>
                            <h4> Online</h4>
                            <div> Nếu bạn tắt online người khác sẽ không thấy bạn đang online </div>
                        </div>
                        <div class="switches-list -mt-8 is-large">
                            <div class="switch-container">
                                <label class="switch"><input type="checkbox"><span class="switch-button"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div {!! $selectTabSetting == 'block'
            ? 'class="uk-active cursor-pointer grid lg:grid-cols-3 mt-1 gap-8"'
            : 'class="cursor-pointer grid lg:grid-cols-3 mt-1 gap-8"' !!}>
            <div class="col-span-3">
                <div class="bg-secondery p-6 rounded-md mt-8 shadow dark:bg-dark2">
                    <div class="flex items-center justify-between text-black dark:text-white">
                        <h3 class="text-lg font-semibold"> Danh sách chặn người dùng </h3>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-3 mt-4">
                        @php $blockAlls = json_decode($block,true);@endphp
                        @if (isset($blockAlls['data']) && $blockAlls['data'] != [])
                            @foreach ($blockAlls['data'] as $row)
                                <div class="side-list-item p-4 box dark:bg-white/5 rounded-2">
                                    <a>
                                        {!! getAvatar($row['user_id'], null, 'width: 2.5rem;height: 2.5rem;border-radius:9999px') !!}
                                    </a>
                                    <div class="flex-1">
                                        <a>
                                            <h4 class="side-list-title"> {!! getName($row['user_id']) !!}</h4>
                                        </a>
                                    </div>
                                    <button wire:click="unblock('{{ encrypt($row['user_id']) }}')"
                                        class="button-icon bg-primary-soft text-primary dark:text-white">
                                        <i class="fa-solid fa-user-unlock w-5 h-5 text-black"></i>
                                    </button>
                                </div>
                            @endforeach
                            @if (isset($totalBlock) && $totalBlock > $perPage[$selectTabSetting])
                                <div class="flex justify-center mt-6 col-span-3">
                                    <a wire:click='loadMoreBlockList'
                                        class="cursor-pointer bg-white font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                                        Xem thêm ..</a>
                                </div>
                            @endif
                        @else
                            <p class="text-center col-span-3">Không có người dùng nào bị chặn!</p>
                        @endif
                    </div>


                </div>
            </div>
        </div>
        <div {!! $selectTabSetting == 'history'
            ? 'class="uk-active cursor-pointer grid lg:grid-cols-3 mt-12 gap-8"'
            : 'class="cursor-pointer grid lg:grid-cols-3 mt-12 gap-8"' !!}>
            <div class="col-span-3">
                <p class="w-100">Hệ thống sẽ lưu lịch sử truy cập trong vòng 7 ngày. Sau 7 ngày sẽ tự động xóa.</p>
                <p class="w-100">Thông tin từ IP có thể không chính xác.</p>
            </div>
            @php $historyAlls = json_decode($history,true);@endphp
            @if (isset($historyAlls['data']) && $historyAlls['data'] != [])
                @foreach ($historyAlls['data'] as $row)
               
                    <div class="bg-white rounded-md lg:shadow-lg shadow col-span-3 lg:p-6 p-4  w-100">
                        <p class="fs-5">{{ Carbon::parse($row['created_at'])->setTimezone('Asia/Ho_Chi_Minh')->format('d-m-Y') }}</p>
                        <p>Đã đăng nhập lúc {{ Carbon::parse($row['created_at'])->setTimezone('Asia/Ho_Chi_Minh')->format('H:s') }}. Với IP:
                            {{ $row['ip'] }} tại {{ $row['city'] }}-{{ $row['country'] }}
                            , trên trình duyệt {{ $row['browser'] }}-{{ $row['os'] }} </p>
                        @if ($row['proxy'])
                            <p class="text-info">Có thể người dùng sử dụng VPN, PROXY</p>
                        @endif
                    </div>
                @endforeach
                @if (isset($totalHistory) && $totalHistory > $perPage[$selectTabSetting])
                    <div class="flex justify-center mt-6 col-span-3">
                        <a wire:click='loadMoreHistoryList'
                            class="cursor-pointer bg-white font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                            Xem thêm ..</a>
                    </div>
                @endif
            @else
                <p class="text-center col-span-3">Không có lịch sử truy cập!</p>
            @endif
        </div>
        <div {!! $selectTabSetting == 'security'
            ? 'class="uk-active cursor-pointer grid lg:grid-cols-3 mt-12 gap-8"'
            : 'class="cursor-pointer grid lg:grid-cols-3 mt-12 gap-8"' !!}>
            <div>
                <h3 class="text-xl mb-2 font-semibold"> Bảo mật 2 lớp</h3>
                <p> Sử dụng ứng dụng Authenticator - Microsoft</p>
            </div>
            <div class="bg-white rounded-md lg:shadow-lg shadow col-span-2 lg:p-6 p-4 lg:mx-16">
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <div>
                            <h4> Bảo mật 2FA</h4>
                            <div> Khi bật, mỗi lần đăng nhập hệ thống sẽ bắt bạn nhập mã OTP để xác thực đăng nhập.
                            </div>
                        </div>
                        <div class="switches-list -mt-8 is-large">
                            <div class="switch-container">
                                <label class="switch"><input type="checkbox" wire:model.live='check_2fa'
                                        {{ auth()->user()->turn_on_2fa == 1 ? 'checked' : '' }}><span
                                        class="switch-button"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    @if ($check_2fa == 1)
                        @if (isset($dataUser_QRCODE))
                            <div class="w-100 text-center">
                                <p>Khóa bí mật<b>
                                        {{ $dataUser_QRCODE->google2fa_secret }}</b></p>
                                <p><i>Vui lòng mở APP <strong>Authenticator</strong> để quét QR này</i></p>
                            </div>
                            <div class="flex justify-center text-center">
                                {!! google2FA_QRCODE($dataUser_QRCODE) !!}
                            </div>
                        @else
                            <div class="w-100 text-center">
                                <p>Khóa bí mật<b>
                                        {{ auth()->user()->google2fa_secret }}</b></p>
                                <p><i>Vui lòng mở APP <strong>Authenticator</strong> để quét QR này</i></p>
                            </div>
                            <div class="flex justify-center text-center">
                                {!! google2FA_QRCODE() !!}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
