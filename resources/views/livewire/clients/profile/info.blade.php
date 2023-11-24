<div>
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center"
            uk-switcher="connect: #info_profile;animation: uk-animation-fade; toggle: > *">
            <li {!! $selectTabFriends == 'overview'
                ? 'class="uk-active cursor-pointer mr-2" aria-expanded="true"'
                : 'class="cursor-pointer  mr-2"' !!} wire:ignore class="uk-active">
                <a wire:click="selectTab('overview')" wire:ignore class="inline-block p-4 border-b-2 rounded-t-lg">Tất
                    cả</a>
            </li>
            <li {!! $selectTabFriends == 'job'
                ? 'class="uk-active cursor-pointer mr-2" aria-expanded="true"'
                : 'class="cursor-pointer mr-2"' !!} wire:ignore>
                <a wire:click="selectTab('job')" wire:ignore
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                    Công việc</a>
            </li>
            <li {!! $selectTabFriends == 'address'
                ? 'class="uk-active cursor-pointer mr-2" aria-expanded="true"'
                : 'class="cursor-pointer mr-2"' !!} wire:ignore>
                <a wire:click="selectTab('address')" wire:ignore
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Nơi
                    sống</a>
            </li>
            <li {!! $selectTabFriends == 'contact'
                ? 'class="uk-active cursor-pointer mr-2" aria-expanded="true"'
                : 'class="cursor-pointer mr-2"' !!} wire:ignore>
                <a wire:click="selectTab('contact')" wire:ignore
                    class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Liên
                    hệ</a>
            </li>
            @auth
                @if (auth()->user()->user_id == $id)
                    <li {!! $selectTabFriends == 'editProfile'
                        ? 'class="uk-active cursor-pointer mr-2" aria-expanded="true"'
                        : 'class="cursor-pointer mr-2"' !!} wire:ignore>
                        <a wire:click="selectTab('editProfile')" wire:ignore
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Sửa
                            thông tin</a>
                    </li>
                @endif
            @endauth
        </ul>
    </div>
    @auth
        @if (auth()->user()->user_id == $id)
        @endif
    @endauth
    <div id="info_profile" class="uk-switcher">
        <li {!! $selectTabFriends == 'overview'
            ? 'class="uk-active cursor-pointer  p-4 rounded-lg bg-gray-50 dark:bg-gray-800"'
            : 'class="cursor-pointer  p-4 rounded-lg bg-gray-50 dark:bg-gray-800"' !!}>
            <div class="row" wire:ignore>
                @if (isset($user->user_fullname))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <i class="fa-solid fa-signature"></i>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">Họ tên: {{ $user->user_fullname }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($user->user_username))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <ion-icon name="at-outline"></ion-icon>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">{{ $user->user_username }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($info->hometown))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">Sống tại: {{ $info->hometown }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($info->location))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <ion-icon name="location-outline"></ion-icon>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">Đến từ: {{ $info->location }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($info->marital))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <ion-icon name="heart-outline"></ion-icon>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">
                                    @if ($info->marital == 'single')
                                        Độc thân
                                    @elseif ($info->marital == 'married')
                                        Đã kết hôn
                                    @elseif ($info->marital == 'divorced')
                                        Đã ly hôn
                                    @elseif ($info->marital == 'widowed')
                                        Góa phụ
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($user->user_gender))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <ion-icon name="accessibility-outline"></ion-icon>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">{{ $user->user_gender == 0 ? 'Nam' : 'Nữ' }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($user->user_birthday))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <ion-icon name="today-outline"></ion-icon>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">Ngày sinh:
                                    {{ Carbon::parse($user->user_birthday)->format('d-m-Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($user->user_email))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <ion-icon name="mail-outline"></ion-icon>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">{{ $user->user_email }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($user->user_phone))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <ion-icon name="call-outline"></ion-icon>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">{{ $user->user_phone }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($user->user_bio))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <ion-icon name="add-outline"></ion-icon>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">Giới thiệu: {{ $user->user_bio }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($info->website))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <ion-icon name="logo-web-component"></ion-icon>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">Website: {{ $info->website }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($user->university))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <i class="fa-solid fa-4"></i>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">CĐ/ĐH: {{ $user->university }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($user->high_school))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <i class="fa-solid fa-3"></i>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">Cấp 3: {{ $user->high_school }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($user->middle_scholl))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <i class="fa-solid fa-2"></i>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">Cấp 2: {{ $user->middle_scholl }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($user->primary_school))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <i class="fa-solid fa-1"></i>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">Cấp 1: {{ $user->primary_school }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($user->language))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <i class="fa-solid fa-language"></i>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">Ngôn ngữ: {{ $user->language }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($info->job))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <i class="fa-solid fa-briefcase"></i>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">Công việc: {{ $info->job }}</p>
                            </div>
                        </div>
                    </div>
                @endif

        </li>
        <li {!! $selectTabFriends == 'job'
            ? 'class="uk-active cursor-pointer  p-4 rounded-lg bg-gray-50 dark:bg-gray-800"'
            : 'class="cursor-pointer  p-4 rounded-lg bg-gray-50 dark:bg-gray-800"' !!}>
            <div class="row" wire:ignore>
                @if (isset($info->job))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <i class="fa-solid fa-briefcase"></i>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">Công việc: {{ $info->job }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($info->university))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <i class="fa-solid fa-4"></i>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">CĐ/ĐH: {{ $info->university }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($info->high_school))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <i class="fa-solid fa-3"></i>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">Cấp 3: {{ $info->high_school }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($info->middle_school))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <i class="fa-solid fa-2"></i>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">Cấp 2: {{ $info->middle_school }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($info->primary_school))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <i class="fa-solid fa-1"></i>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">Cấp 1: {{ $info->primary_school }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </li>
        <li {!! $selectTabFriends == 'address'
            ? 'class="uk-active cursor-pointer  p-4 rounded-lg bg-gray-50 dark:bg-gray-800"'
            : 'class="cursor-pointer  p-4 rounded-lg bg-gray-50 dark:bg-gray-800"' !!}>
            <div class="row" wire:ignore>
                @if (isset($info->hometown))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">Sống tại: {{ $info->hometown }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($info->location))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <ion-icon name="location-outline"></ion-icon>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">Đến từ: {{ $info->location }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </li>
        <li {!! $selectTabFriends == 'contact'
            ? 'class="uk-active cursor-pointer  p-4 rounded-lg bg-gray-50 dark:bg-gray-800"'
            : 'class="cursor-pointer  p-4 rounded-lg bg-gray-50 dark:bg-gray-800"' !!}>
            <div class="row" wire:ignore>
                @if (isset($user->user_email))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <ion-icon name="mail-outline"></ion-icon>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">{{ $user->user_email }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($user->user_phone))
                    <div class="col-md-6 col-12 mt-3">
                        <div class="flex ms-3">
                            <div class="icon">
                                <ion-icon name="call-outline"></ion-icon>
                            </div>
                            <div class="text w-100 ms-3 ml-3">
                                <p class="mb-0">{{ $user->user_phone }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </li>
        <li {!! $selectTabFriends == 'editProfile'
            ? 'class="uk-active cursor-pointer  p-4 rounded-lg bg-gray-50 dark:bg-gray-800"'
            : 'class="cursor-pointer  p-4 rounded-lg bg-gray-50 dark:bg-gray-800"' !!}>
            @auth
                @if (auth()->user()->user_id == $id)
                    <button uk-toggle="target: #editInfo; animation: uk-animation-fade" style="width:15rem!important"
                        class="m-auto flex items-center justify-center h-10 px-5 rounded-md bg-blue-600 text-white space-x-1.5 hover:text-white">
                        <span> Sửa thông tin </span>
                    </button>
                    <div id="editInfo" class="row card card-body my-3">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="relative w-full my-2">
                                    <div class="me-3 absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fa-solid fa-signature"></i>
                                    </div>
                                    <input type="text" style="padding-left:2.5rem"
                                        class="@error('user_fullname') with-border-error @enderror pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Họ tên" wire:model.live='user_fullname'
                                        @error('user_fullname') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="relative w-full my-2">
                                    <div class="me-3 absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fa-solid fa-at"></i>
                                    </div>
                                    <input type="text" style="padding-left:2.5rem"
                                        class="@error('user_username') with-border-error @enderror pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Tên người dùng" wire:model.live='user_username'
                                        @error('user_username') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="relative w-full my-2">
                                    <div class="me-3 absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <input type="email" style="padding-left:2.5rem"
                                        class="@error('user_email') with-border-error @enderror pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Email" wire:model.live='user_email'
                                        @error('user_email') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="relative w-full my-2">
                                    <div class="me-3 absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <input type="text" style="padding-left:2.5rem"
                                        class="@error('user_phone') with-border-error @enderror pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Số điện thoại" wire:model.live='user_phone'
                                        @error('user_phone') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                </div>
                            </div>
                            <label>Sống tại</label>
                            <div class="col-12 col-md-6  my-2">
                                <select data-province="{{ $selectedProvince }}" wire:ignore id="city"
                                    name="address_province" wire:model="selectedProvince"
                                    class="@error('selectedProvince') with-border-error @enderror bg-white bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    @error('selectedProvince') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                    @if ($selectedProvince)
                                        <option value="{{ $selectedProvince }}" selected>{{ $selectedProvince }}</option>
                                    @else
                                        <option value="">Chọn tỉnh/thành phố</option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-12 col-md-6  my-2">
                                <select wire:ignore id="district" name="address_district" wire:model="selectedDistrict"
                                    class="@error('selectedDistrict') with-border-error @enderror bg-white  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    @error('selectedDistrict') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                    @if ($selectedDistrict)
                                        <option value="{{ $selectedDistrict }}" selected>{{ $selectedDistrict }}</option>
                                    @else
                                        <option value="">Chọn quận/huyện</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-12 col-md-6  my-2">
                                <select wire:ignore id="ward" name="address_ward" wire:model="selectedWard"
                                    class="@error('selectedWard') with-border-error @enderror bg-white bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    @error('selectedWard') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                    @if ($selectedWard)
                                        <option value="{{ $selectedWard }}" selected>{{ $selectedWard }}</option>
                                    @else
                                        <option value="">Chọn xã</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-12 col-md-6  my-2">
                                <input wire:model='detail' type="text"
                                    class="@error('detail') with-border-error @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Số nhà, thôn, xóm"
                                    @error('detail') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                            </div>


                            <label>Quê quán</label>
                            <div class="col-12 col-md-6  my-2">
                                <select data-province1="{{ $selectedProvince1 }}" wire:ignore id="city1"
                                    name="address_province1" wire:model="selectedProvince1"
                                    class="@error('selectedProvince1') with-border-error @enderror bg-white bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    @error('selectedProvince1') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>

                                    @if ($selectedProvince1)
                                        <option value="{{ $selectedProvince1 }}" selected>{{ $selectedProvince1 }}
                                        </option>
                                    @else
                                        <option value="">Chọn tỉnh/thành phố</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-12 col-md-6  my-2">
                                <select wire:ignore id="district1" name="address_district1"
                                    wire:model="selectedDistrict1"
                                    class="@error('selectedDistrict1') with-border-error @enderror bg-white bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    @error('selectedDistrict1') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                    @if ($selectedDistrict1)
                                        <option value="{{ $selectedDistrict1 }}" selected>{{ $selectedDistrict1 }}
                                        </option>
                                    @else
                                        <option value="">Chọn quận/huyện</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-12 col-md-6  my-2">
                                <select wire:ignore id="ward1" name="address_ward1" wire:model="selectedWard1"
                                    class="@error('selectedWard1') with-border-error @enderror bg-white bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    @error('selectedWard1') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                    @if ($selectedWard1)
                                        <option value="{{ $selectedWard1 }}" selected>{{ $selectedWard1 }}</option>
                                    @else
                                        <option value="">Chọn xã/phường</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-12 col-md-6  my-2">
                                <input wire:model='detail1' type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Số nhà, thôn, xóm"
                                    @error('detail1') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                            </div>
                            <div class="col-12 my-2">
                                <label for="university"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cấp 4</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 flex items-center ps-3.5"
                                    style="top:-4px;z-index:999">
                                        <select id="university_type" name="university_type"
                                            class="mt-1 p-2 border rounded-md w-full @error('user_university_type') with-border-error @enderror" wire:model.live='user_university_type'
                                            @error('user_university_type') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                            <option value="1" {{$user_university_type == 1 ? 'selected' : ''}}>Đại học</option>
                                            <option value="2" {{$user_university_type == 2 ? 'selected' : ''}}>Quốc tế</option>
                                            <option value="3" {{$user_university_type == 3 ? 'selected' : ''}}>Cao đẳng</option>
                                            <option value="4" {{$user_university_type == 4 ? 'selected' : ''}}>Cao đẳng nghề</option>
                                        </select>
                                    </div>
                                    <input type="text" id="university"
                                        class=" @error('user_university') with-border-error @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="FPT Polytechnic" style="padding-left:165px" wire:model.live='user_university' @error('user_university') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                </div>
                            </div>
                            <div class="col-12 my-2">
                                <label for="university"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cấp 3</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 flex items-center ps-3.5"
                                    style="top:-4px;z-index:999">
                                        <select id="university_type" name="university_type"
                                            class="mt-1 p-2 border rounded-md w-full">
                                            <option value="1" selected>Phổ thông</option>
                                        </select>
                                    </div>
                                    <input type="text" id="university"
                                        class=" @error('user_highschool') with-border-error @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="FPT Polytechnic" style="padding-left:135px" wire:model.live='user_highschool'
                                        @error('user_highschol') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                </div>
                            </div>
                            <div class="col-12 my-2">
                                <label for="university"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cấp 2</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 flex items-center ps-3.5"
                                    style="top:-4px;z-index:999">
                                        <select id="university_type" name="university_type"
                                            class="mt-1 p-2 border rounded-md w-full">
                                            <option value="1" selected>Trung học</option>
                                        </select>
                                    </div>
                                    <input type="text" id="university"
                                        class=" @error('user_middleschool') with-border-error @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="FPT Polytechnic" style="padding-left:135px"
                                        wire:model.live='user_middleschool' @error('user_middleschool') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                </div>
                            </div>
                            <div class="col-12 my-2">
                                <label for="university"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cấp 1</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 flex items-center ps-3.5"
                                    style="top:-4px;z-index:999">
                                        <select id="university_type" name="university_type"
                                            class="mt-1 p-2 border rounded-md w-full">
                                            <option value="1" selected>Tiểu học</option>
                                        </select>
                                    </div>
                                    <input type="text" id="university"
                                        class=" @error('user_primaryschool') with-border-error @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="FPT Polytechnic" style="padding-left:120px" wire:model.live='user_primaryschool'
                                        @error('user_primaryschool') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="relative w-full my-2">
                                    <div class="me-3 absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fa-solid fa-cake-candles"></i>
                                    </div>
                                    <input type="text" wire:ignore style="padding-left:2.5rem"
                                        class="@error('user_birthday') with-border-error @enderror pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        id="dateRangePickerId" wire:model='user_birthday'
                                        value="{{ Carbon::parse($user_birthday)->format('Y-m-d') }}"
                                        placeholder="17-11-2003"
                                        @error('user_birthday') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="relative w-full my-2">
                                    <div class="me-3 absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fa-solid fa-ring"></i>
                                    </div>
                                    <select wire:model="user_marital"
                                        class="@error('user_marital') with-border-error @enderror bg-white bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        @error('user_marital') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                        @if ($user_marital)
                                            <option value="{{ $user_marital }}" selected hidden>{{ $user_marital }}
                                            </option>
                                        @endif
                                        <option value="" hidden>Chọn trạng thái</option>
                                        <option value="single">Độc thân</option>
                                        <option value="married">Đã kết hôn</option>
                                        <option value="divorced">Đã ly hôn</option>
                                        <option value="widowed">Góa phụ</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="relative w-full my-2">
                                    <div class="me-3 absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fa-solid fa-message"></i>
                                    </div>
                                    <input type="text" style="padding-left:2.5rem"
                                        class="@error('user_bio') with-border-error @enderror pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        wire:model='user_bio' placeholder="Giới thiệu"
                                        @error('user_bio') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="relative w-full my-2">
                                    <div class="me-3 absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fa-solid fa-suitcase"></i>
                                    </div>
                                    <input type="text" style="padding-left:2.5rem"
                                        class="@error('user_job') with-border-error @enderror pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        wire:model='user_job' placeholder="Công việc"
                                        @error('user_job') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="relative w-full my-2">
                                    <div class="me-3 absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fa-solid fa-language"></i>
                                    </div>
                                    <input type="text" style="padding-left:2.5rem"
                                        class="@error('user_language') with-border-error @enderror pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        wire:model='user_language' placeholder="Ngôn ngữ: Tiếng Việt, Tiếng Anh"
                                        @error('user_language') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button id="changeInfoProfile"
                                        class="m-auto flex items-center justify-center h-10 px-5 rounded-md bg-blue-600 text-white space-x-1.5 hover:text-white">Lưu
                                        thay đổi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
        </li>
    </div>
</div>
