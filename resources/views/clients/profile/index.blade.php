@extends($layout)
@section('customcss')
    <link rel="stylesheet" href="{{ asset('clients/assets/css/icons.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/calendarify@latest/dist/calendarify.min.css" />
    <style>
        ol,
        ul {
            padding-left: 0 !important;
        }
    </style>
@endsection
@section('content')
    <div class="{{ auth()->check() ? 'main_content' : 'container-fluid' }}">
        <div class="{{ auth()->check() ? 'mcontainer' : 'w-full px-3 py-3 mt-3' }}">

            <!-- Profile cover -->
            <div class="profile user-profile">

                <div class="profiles_banner relative">
                    {!! getCover($data->user_id) !!}
                    @auth
                        @if (auth()->user()->user_id == $data->user_id)
                            <div class="profile_action absolute bottom-0 right-0 space-x-1.5 p-3 text-sm z-50 lg:flex">
                                <a uk-toggle="target: #viewCoverProfile" uk-dropdown="pos: right-top;mode:click"
                                    class="cursor-pointer flex items-center justify-center h-8 px-3 rounded-md bg-gray-700 bg-opacity-70 text-white space-x-1.5">
                                    <ion-icon name="create-outline" class="text-xl"></ion-icon>
                                    <span class="hidden md:flex"> Sửa ảnh bìa </span>
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
                <div class="absolute right-0 z-10 uk-card uk-card-body uk-card-default w-48 md:-ml-9 -ml-10"
                    id="viewCoverProfile" hidden>
                    <div class="card card-body">
                        <ul class="list-none p-0 m-0 h-max">
                            @php
                                $check = \DB::table('users')
                                    ->where('user_id', $data->user_id)
                                    ->count(); 
                            @endphp
                            @if (isset($check))
                                <li class="cursor-pointer hover:bg-gray-100 hover:rounded-full px-3 text-left">
                                    Xem ảnh bìa
                                </li>
                            @endif
                            @auth
                                @if (auth()->user()->user_id == $data->user_id)
                                    <li class="cursor-pointer hover:bg-gray-100 hover:rounded-full px-3 text-left"
                                        uk-toggle="target: #change-cover">Thay đổi ảnh bìa</li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                </div>
                @auth
                @if (auth()->user()->user_id == $data->user_id)
                    <div id="change-cover" uk-modal>
                        <div class="uk-modal-dialog">
                            <button class="uk-modal-close-default" type="button" uk-close></button>
                            <div class="uk-modal-header">
                                <h2 class="uk-modal-title text-center">Chọn ảnh bìa</h2>
                            </div>
                            <div class="uk-modal-body flex flex-column">
                                <button uk-toggle="target: #upload_Cover"
                                    class="my-2 flex items-center justify-center h-10 px-5 rounded-md bg-blue-400 text-white space-x-1.5 hover:text-white">
                                    <ion-icon name="add-outline"></ion-icon>
                                    Tải ảnh lên</button>
                                @if (auth()->user()->user_cover)
                                    <pintura-editor src="{{ auth()->user()->user_cover }}"></pintura-editor>
                                    <button id="edit_Cover" data-image-src="{{ auth()->user()->user_cover }}"
                                        class="my-2 flex items-center justify-center h-10 px-5 rounded-md bg-gray-300 text-white space-x-1.5 hover:text-white">
                                        <ion-icon name="pencil-outline"></ion-icon>
                                        Chỉnh sửa hình ảnh</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div id="upload_Cover" uk-modal>
                        <div class="uk-modal-dialog">
                            <button class="uk-modal-close-default" type="button" uk-close></button>
                            <div class="uk-modal-header">
                                <h2 class="uk-modal-title text-center">Tải ảnh bìa lên</h2>
                            </div>
                            <div class="uk-modal-body flex flex-column">
                                <section wire:ignore>
                                    <div class="dropzone" id="uploadCoverProfile">
                                    </div>
                                    <button id="UuploadCoverProfile"
                                        class="mt-3 ml-5 flex items-center justify-center h-10 px-5 rounded-md bg-blue-600 text-white space-x-1.5 hover:text-white">
                                        <span> Đăng ảnh </span>
                                    </button>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div id="upload_Avatar" uk-modal>
                        <div class="uk-modal-dialog">
                            <button class="uk-modal-close-default" type="button" uk-close></button>
                            <div class="uk-modal-header">
                                <h2 class="uk-modal-title text-center">Tải ảnh đại diện lên</h2>
                            </div>
                            <div class="uk-modal-body flex flex-column">
                                @livewire('clients.profile.upload-file')
                            </div>
                        </div>
                    </div>
                @endif
            @endauth

                <div class="profiles_content">
                    <div class="profile_avatar cursor-pointer" uk-toggle="target: #viewProfile"
                        uk-dropdown="pos: right-top;mode:click">
                        <div class="profile_avatar_holder">
                            {!! getAvatar($data->user_id, null, 'width:100%;height:100%;font-size:30px') !!}
                        </div>
                        @auth
                            @if (auth()->user()->user_id == $data->user_id)
                                <div class="icon_change_photo">
                                    <ion-icon name="camera" class="text-xl"></ion-icon>
                                </div>
                            @endif
                        @endauth
                        <div class="uk-card uk-card-body uk-card-default w-60 md:-ml-9 -ml-10" id="viewProfile" hidden>
                            <div class="card card-body">
                                <ul class="list-none p-0 m-0 h-max">
                                    @php
                                        $check = \DB::table('users')
                                            ->where('user_id', $data->user_id)
                                            ->count();
                                    @endphp
                                    @if (isset($check))
                                        <li class="cursor-pointer hover:bg-gray-100 hover:rounded-full px-3 text-left">Xem
                                            ảnh đại diện</li>
                                    @endif
                                    @auth
                                        @if (auth()->user()->user_id == $data->user_id)
                                            <li class="cursor-pointer hover:bg-gray-100 hover:rounded-full px-3 text-left"
                                                uk-toggle="target: #change-avatar">Thay đổi ảnh đại diện</li>
                                        @endif
                                    @endauth
                                </ul>
                            </div>
                        </div>
                        @auth
                            @if (auth()->user()->user_id == $data->user_id)
                                <div id="change-avatar" uk-modal>
                                    <div class="uk-modal-dialog">
                                        <button class="uk-modal-close-default" type="button" uk-close></button>
                                        <div class="uk-modal-header">
                                            <h2 class="uk-modal-title text-center">Chọn ảnh đại diện</h2>
                                        </div>
                                        <div class="uk-modal-body flex flex-column">
                                            <button uk-toggle="target: #upload_Avatar"
                                                class="my-2 flex items-center justify-center h-10 px-5 rounded-md bg-blue-400 text-white space-x-1.5 hover:text-white">
                                                <ion-icon name="add-outline"></ion-icon>
                                                Tải ảnh lên</button>
                                            @if (auth()->user()->user_avatar)
                                                <pintura-editor src="{{ auth()->user()->user_avatar }}"></pintura-editor>
                                                <button id="edit_Avatar" data-image-src="{{ auth()->user()->user_avatar }}"
                                                    class="my-2 flex items-center justify-center h-10 px-5 rounded-md bg-gray-300 text-white space-x-1.5 hover:text-white">
                                                    <ion-icon name="pencil-outline"></ion-icon>
                                                    Chỉnh sửa hình ảnh</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div id="upload_Avatar" uk-modal>
                                    <div class="uk-modal-dialog">
                                        <button class="uk-modal-close-default" type="button" uk-close></button>
                                        <div class="uk-modal-header">
                                            <h2 class="uk-modal-title text-center">Tải ảnh đại diện lên</h2>
                                        </div>
                                        <div class="uk-modal-body flex flex-column">
                                            @livewire('clients.profile.upload-file')
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endauth
                    </div>

                    <div class="profile_info">
                        <h1 class="text-center"> {!! getName($data->user_id, 'width:25px') !!} </h1>
                        <p class="text-center"> {{ $data->user_bio }}</p>
                    </div>

                </div>

                <div class="flex justify-between lg:border-t border-gray-100 flex-col-reverse lg:flex-row pt-2">
                    <nav class="responsive-nav pl-3">
                        <ul uk-switcher="connect: #timeline-tab; animation: uk-animation-fade">
                            <li><a href="#">Bài viết</a></li>
                            <li><a href="#">Giới thiệu</a></li>
                            <li><a href="#">Bạn bè <span>{{ countFriend($data->user_id) }}</span> </a></li>
                            <li><a href="#">Hình ảnh </a></li>
                        </ul>
                    </nav>

                    <!-- button actions -->
                    <div class="flex items-center space-x-1.5 flex-shrink-0 pr-4 mb-2 justify-center order-1 relative">

                        <!-- add story -->
                        <a href="#"
                            class="flex items-center justify-center h-10 px-5 rounded-md bg-blue-600 text-white space-x-1.5 hover:text-white"
                            uk-toggle="target: #create-post-modal">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-5">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span> Đăng bài viết </span>
                        </a>

                        {{-- <!-- search icon -->
                        <a href="#" class="flex items-center justify-center h-10 w-10 rounded-md bg-gray-100"
                            uk-toggle="target: #profile-search;animation: uk-animation-slide-top-small">
                            <ion-icon name="search" class="text-xl"></ion-icon>
                        </a>
                        <!-- search dropdown -->
                        <div class="absolute right-3 bg-white z-10 w-full flex items-center border rounded-md"
                            id="profile-search" hidden>
                            <input type="text" placeholder="Tìm kiếm..." class="flex-1">
                            <ion-icon name="close-outline"
                                class="text-2xl hover:bg-gray-100 p-1 rounded-full mr-2 cursor-pointer"
                                uk-toggle="target: #profile-search;animation: uk-animation-slide-top-small"></ion-icon>
                        </div> --}}

                        <!-- more icon -->
                        <a href="#" class="flex items-center justify-center h-10 w-10 rounded-md bg-gray-100">
                            <ion-icon name="ellipsis-horizontal" class="text-xl"></ion-icon>
                        </a>
                        <!-- more drowpdown -->
                        <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                            uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small; offset:5">
                            <ul class="m-0">
                                <li>

                                    <a id="sharelink"
                                        data-clipboard-text="{{ route('profile', ['id' => $data->user_id]) }}"
                                        class="flex items-center px-3 py-2 hover:bg-gray-100 hover:text-gray-800 rounded-md dark:hover:bg-gray-800
                                        text-primary">
                                        <ion-icon id="shareIcon" name="arrow-redo-outline"
                                            class="pr-2 text-xl"></ion-icon>
                                        <span>Chia sẻ</span>
                                    </a>
                                </li>
                              @livewire('clients.profile.index')
                            </ul>
                        </div>
                    </div>

                </div>

            </div>

            <div class="uk-switcher lg:mt-8 mt-4" id="timeline-tab">
                <!-- Timeline -->
                <div class="md:flex md:space-x-6 ">
                      <!-- create post  -->
                    <div class="space-y-5 flex-shrink-0 md:w-7/12">
                        <div class="card lg:mx-0 p-4" uk-toggle="target: #create-post-modal">
                            <div class="flex space-x-3">
                                {!! getAvatar(
                                    $info->user_id,
                                    null,
                                    'border-radius:10px;font-size:30px!important;font-family: Arial, Helvetica, sans-serif;
                                    background: #2a64e2f5;
                                    font-size: 16px;
                                    color: #fff;
                                    text-align: center;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;',
                                    'w-10 h-10 rounded-full',
                                ) !!}
                                <input placeholder="Có chuỵn gì thì đăng lên" class="bg-gray-100 hover:bg-gray-200 flex-1 h-10 px-6 rounded-full">
                            </div>
                            <div class="grid grid-flow-col pt-3 -mx-1 -mb-1 font-semibold text-sm">
                                 <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer">
                                     <svg class="bg-blue-100 h-9 mr-2 p-1.5 rounded-full text-blue-600 w-9 -my-0.5 hidden lg:block" data-tippy-placement="top" title="Tooltip" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                     Photo/Video
                                 </div>
                                 <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer">
                                     <svg class="bg-green-100 h-9 mr-2 p-1.5 rounded-full text-green-600 w-9 -my-0.5 hidden lg:block" uk-tooltip="title: Messages ; pos: bottom ;offset:7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" title="" aria-expanded="false"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                                     Tag Friend
                                 </div>
                                 <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer">
                                     <svg class="bg-red-100 h-9 mr-2 p-1.5 rounded-full text-red-600 w-9 -my-0.5 hidden lg:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                     Fealing /Activity
                                 </div>
                            </div>
                        </div>



                        <livewire:clients.profile.posts :user_id="$info->user_id" />


                    </div>

                    <!-- Sidebar -->
                    <div class="w-full space-y-6">
                        <div class="widget card p-3">
                            <h4 class="text-lg font-semibold"> Về tôi </h4>
                            <ul class="text-gray-600 space-y-3 mt-3">
                                @if (isset($introduction))
                                    @if (isset($introduction->hometown))
                                        <li class="flex items-center space-x-2">
                                            <ion-icon name="home-sharp"
                                                class="rounded-full bg-gray-200 text-xl p-1 mr-3"></ion-icon>
                                            <strong> {{ $introduction->hometown }} </strong>
                                        </li>
                                    @endif
                                    @if (isset($introduction->location))
                                        <li class="flex items-center space-x-2">
                                            <ion-icon name="globe"
                                                class="rounded-full bg-gray-200 text-xl p-1 mr-3"></ion-icon>
                                            <strong>{{ $introduction->location }} </strong>
                                        </li>
                                    @endif
                                    @if (isset($introduction->marital))
                                        <li class="flex items-center space-x-2">
                                            <ion-icon name="heart-sharp"
                                                class="rounded-full bg-gray-200 text-xl p-1 mr-3"></ion-icon>
                                            <strong>
                                                @if ($introduction->marital == 'single')
                                                    Độc thân
                                                @elseif ($introduction->marital == 'married')
                                                    Đã kết hôn
                                                @elseif ($introduction->marital == 'divorced')
                                                    Đã ly hôn
                                                @elseif ($introduction->marital == 'widowed')
                                                    Góa phụ
                                                @endif
                                            </strong>
                                        </li>
                                    @endif
                                @endif
                                <li class="flex items-center space-x-2">
                                    <ion-icon name="logo-rss"
                                        class="rounded-full bg-gray-200 text-xl p-1 mr-3"></ion-icon>
                                    Theo dõi <strong> 0 người </strong>
                                </li>
                            </ul>
                        </div>

                        {{-- <div class="widget card p-3 border-t">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h4 class="text-lg font-semibold"> Bạn bè </h4>
                                    <p class="text-sm"> {{ countFriend($data->user_id) }}</p>
                                </div>
                                <a href="#" class="text-blue-600 ">Xem tất cả</a>
                            </div>
                            <div class="grid grid-cols-3 gap-3 text-gray-600 font-semibold">
                                <a href="#">
                                    <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2">
                                        <img src="{{ asset('clients/assets/images/avatars/avatar-1.jpg') }}"
                                            alt="" class="w-full h-full object-cover absolute">
                                    </div>
                                    <div class="text-sm truncate"> Dennis Han </div>
                                </a>
                                <a href="#">
                                    <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2">
                                        <img src="{{ asset('clients/assets/images/avatars/avatar-2.jpg') }}"
                                            alt="" class="w-full h-full object-cover absolute">
                                    </div>
                                    <div class="text-sm truncate"> Erica Jones </div>
                                </a>
                                <a href="#">
                                    <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2">
                                        <img src="{{ asset('clients/assets/images/avatars/avatar-3.jpg') }}"
                                            alt="" class="w-full h-full object-cover absolute">
                                    </div>
                                    <div class="text-sm truncate"> Stella Johnson </div>
                                </a>
                                <a href="#">
                                    <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2">
                                        <img src="{{ asset('clients/assets/images/avatars/avatar-4.jpg') }}"
                                            alt="" class="w-full h-full object-cover absolute">
                                    </div>
                                    <div class="text-sm truncate"> Alex Dolgove</div>
                                </a>
                                <a href="#">
                                    <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2">
                                        <img src="{{ asset('clients/assets/images/avatars/avatar-5.jpg') }}"
                                            alt="" class="w-full h-full object-cover absolute">
                                    </div>
                                    <div class="text-sm truncate"> Jonathan Ali </div>
                                </a>
                                <a href="#">
                                    <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2">
                                        <img src="{{ asset('clients/assets/images/avatars/avatar-6.jpg') }}"
                                            alt="" class="w-full h-full object-cover absolute">
                                    </div>
                                    <div class="text-sm truncate"> Erica Han </div>
                                </a>
                            </div>
                            <a href="#" class="button gray mt-3 w-full">Xem tất cả </a>
                        </div> --}}


                    </div>
                </div>
                <div class="card md:p-6 p-2 mx-auto">
                    <h2 class="text-xl font-bold">Giới thiệu</h2>
                    @livewire('clients.profile.info', ['id' => $data->user_id])

                </div>

                <!-- Friends  -->
                <div class="card md:p-6 p-2 mx-auto">
                    <h2 class="text-xl font-bold"> Bạn bè</h2>
                    @livewire('clients.profile.friend', ['data' => $data, 'id' => $data->user_id])
                </div>

                <!-- Photos  -->
                <div class="card md:p-6 p-2 mx-auto">

                    @livewire('clients.profile.album', ['data' => $data, 'id' => $data->user_id])
                </div>


            </div>

        </div>
    </div>
@endsection
@section('js')
    <script src="https://unpkg.com/calendarify@latest/dist/calendarify.iife.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
        integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('clients/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            var changeInfoProfile = document.getElementById('changeInfoProfile');
            if (changeInfoProfile) {
                changeInfoProfile.addEventListener('click', function() {
                    Livewire.dispatch('changeInfoProfile');
                });
            };
        });
        const dateRangePickerEl = document.getElementById('dateRangePickerId');

        if (dateRangePickerEl) {
            const dateRangeValue = dateRangePickerEl.value;
            const now = new Date();
            const options = {
                accentColor: '#0090FC',
                isDark: false,
                zIndex: 9999,
                customClass: ['font-poppins'],
                onChange: (calendarify) => console.log(
                    calendarify),
                quickActions: false,
                startDate: dateRangeValue ? new Date(dateRangeValue) : now,
                locale: {
                    format: "DD-MM-YYYY",
                    lang: {
                        code: 'vn',
                        months: ["T1", "T2", "T3", "T4", "T5", "T6", "T7", "T8", "T9", "T10", "T11", "T12"],
                        weekdays: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                    }
                }
            }
            const calendarify = new Calendarify('#dateRangePickerId', {
                ...options
            })
            calendarify.init()
        }


        const host = "http://127.0.0.1:8000/proxy?url=https://provinces.open-api.vn/api/";

        var callAPI = (api) => {
            return $.get(api)
                .done((response) => {
                    if (response) {
                        renderData(response, "city1");
                        renderData(response, "city");
                    }
                });
        };

        callAPI('http://127.0.0.1:8000/proxy?url=https://provinces.open-api.vn/api/?depth=1');

        var callApiDistrict = (api, targetSelect) => {
            return $.get(api)
                .done((response) => {
                    if (isValidJson(response)) {
                        response = JSON.parse(response);
                    }
                    renderData(response.districts, targetSelect);
                });
        };

        function isValidJson(str) {
            try {
                JSON.parse(str);
                return true;
            } catch (e) {
                return false;
            }
        }

        var callApiWard = (api, targetSelect) => {
            return $.get(api)
                .done((response) => {
                    if (isValidJson(response)) {
                        response = JSON.parse(response);
                    }
                    renderData(response.wards, targetSelect);
                });
        };

        var renderData = (data, select) => {
            let row = '<option disabled value="" hidden>Select</option>';
            if (data && typeof data == 'string') {
                var dataArray = JSON.parse(data);
                if (Array.isArray(dataArray)) {
                    dataArray.sort((a, b) => a.name.localeCompare(b.name));
                    $.each(dataArray, function(index, element) {
                        row += '<option data-id="' + element.code + '" value="' + element.name + '">' +
                            element
                            .name + '</option>';
                    });
                }
            } else {
                $.each(data, function(index, element) {
                    row += '<option data-id="' + element.code + '" value="' + element.name + '">' +
                        element
                        .name +
                        '</option>';
                });
            }
            $("#" + select).html(row);
        };

        $("#city, #city1, #district, #district1, #ward, #ward1").change(function() {
            const selectedId = $(this).find(':selected').data('id');
            const selectName = $(this).attr("id");
            if ((selectName === "city" || selectName === "city1") && selectedId) {
                callApiDistrict(host + "p/" + selectedId + "?depth=2", selectName === "city" ? "district" :
                    "district1");
            } else if ((selectName === "district" || selectName === "district1") && selectedId) {
                callApiWard(host + "d/" + selectedId + "?depth=2", selectName === "district" ? "ward" :
                    "ward1");
            }
        });
    </script>
@endsection
