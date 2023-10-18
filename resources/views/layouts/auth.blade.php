<!DOCTYPE html>
<html lang="en" class="bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="{{ asset('clients/assets/images/favicon.png') }}" rel="icon" type="image/png">

    <!-- Basic Page Needs
       ================================================== -->
    <title>SocialCircle</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Socialite is - Professional A unique and beautiful collection of UI elements">

    <!-- icons
   ================================================== -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/icons.css') }}">

    <!-- CSS
   ================================================== -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/uikit.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/assets/css/style.css') }}">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    {{-- <script src="https://cdn.jsdelivr.net/npm/turbolinks@5.2.0/dist/turbolinks.min.js"></script> --}}
    <style>
        input,
        .bootstrap-select.btn-group button {
            background-color: #f3f4f6 !important;
            height: 44px !important;
            box-shadow: none !important;
        }
        a {
            text-decoration: none !important;
        }

        .with-border-error {
            border: 1px solid #ff0000 !important;
        }

        .uk-tooltip {
            display: none;
            position: absolute;
            z-index: 10000;
            box-sizing: boder-box;
            max-width: 250px;
            width: 100;
            padding: 6px 10px;
            background: #e82c2c !important;
            border-radius: 2px;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            border-radius: 4px;
        }

        .fill-red-600 {
            fill: #1c64f2;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999999;
            display: none;
            justify-content: center;
            align-items: center;
        }


        .overlay.active {
            display: flex;
        }

        ion-icon {
            font-size: 22px;
        }

        ::-ms-reveal {
            display: none;
        }
        #profileImage {
            font-family: Arial, Helvetica, sans-serif;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #2a64e2f5;
            font-size: 16px;
            color: #fff;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
     @livewireStyles()
</head>

<body>

    <body class="bg-gray-100">


        <div id="wrapper" class="flex flex-col justify-between h-screen">

            <!-- header-->
            <div class="bg-white py-4 shadow-md dark:bg-gray-800">
                <div class="max-w-6xl mx-auto">


                    <div class="flex items-center lg:justify-between justify-around">

                        <a wire:navigate href="{{ route('home') }}">
                            <img src="{{ asset('clients/assets/images/logo-dark.png') }}" alt="SOCIALCIRCLE" class="w-40">
                        </a>

                        @auth
                        <a href="#">
                            {{-- <img src="https://img.thuthuatphanmem.vn/uploads/2018/09/19/avatar-facebook-chat-4_105604005.jpg" style="width:35px" class="is_avatar" style="width:50px" alt=""> --}}
                            {!! getAvatar(auth()->user()->user_id) !!}
                        </a>
                        <div uk-drop="mode: click;offset:5" class="header_dropdown profile_dropdown">

                            <a href="timeline.html" class="user">
                                <div class="user_avatar">
                                    {{-- <img src="https://img.thuthuatphanmem.vn/uploads/2018/09/19/avatar-facebook-chat-4_105604005.jpg" style="width:35px" alt=""> --}}
                                    {!! getAvatar(auth()->user()->user_id) !!}
                                </div>
                                <div class="user_name">
                                    <div> {{auth()->user()->user_fullname}} </div>
                                    <span> <?='@'?>{{auth()->user()->user_username}}</span>
                                </div>
                            </a>
                            <hr>
                            <a wire:navigate href="{{route('logout')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Đăng xuất
                            </a>


                        </div>

                        @else
                            <div class="capitalize flex font-semibold hidden lg:block my-2 space-x-3 text-center text-sm">
                                <a wire:navigate href="{{ route('home') }}" class="py-3 px-4">Đăng nhập</a>
                            </div>
                        @endauth

                    </div>
                </div>
            </div>

            <!-- Content-->
            @yield('content')

            <!-- Footer -->

            <div class="lg:mb-5 py-5 uk-link-reset" style="background:white;">
                <div
                    class="flex flex-col items-center justify-between lg:flex-row max-w-6xl mx-auto lg:space-y-0 space-y-3">
                    <div class="flex space-x-2 text-gray-700 uppercase">
                        <a href="#"> Về chúng tôi</a>
                        <a href="#"> Hỗ trợ</a>
                        <a href="#"> Điều kiện</a>
                        <a href="#"> Chính sách</a>
                    </div>
                    <p class="capitalize"> © {{ \Carbon\Carbon::now()->format('Y') }} by SocialCircle</p>
                </div>
            </div>
        </div>



        <script>
            // Feature test
            if ('localStorage' in window) {
                var nightMode = localStorage.getItem('gmtNightMode');
                if (nightMode) {
                    document.documentElement.classList.add('dark');
                }
            }

            (function(window, document, undefined) {
                'use strict';

                // Feature test
                if (!('localStorage' in window)) return;

                // Get our newly insert toggle
                var nightMode = document.querySelector('#night-mode');
                if (!nightMode) return;

                // When clicked, toggle night mode on or off
                nightMode.addEventListener('click', function(event) {
                    event.preventDefault();
                    document.documentElement.classList.toggle('dark');
                    if (document.documentElement.classList.contains('dark')) {
                        localStorage.setItem('gmtNightMode', true);
                        changeLogo('logo-white.png');
                        return;
                    } else {
                        localStorage.removeItem('gmtNightMode');
                        changeLogo('logo-dark.png');
                        return;
                    }
                }, false);

                function changeLogo(logoFileName) {
                    // Lấy phần tử hình ảnh logo
                    var logoElement = document.querySelector('#logo img');

                    // Thay đổi đường dẫn hình ảnh thành logoFileName
                    logoElement.src = "{{ asset('clients/assets/images/') }}" + "/" + logoFileName;
                }

            })(window, document);
        </script>


        <!-- Javascript
        ================================================== -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{ asset('clients/assets/js/tippy.all.min.js') }}"></script>
        <script src="{{ asset('clients/assets/js/uikit.js') }}" defer></script>
        <script src="{{ asset('clients/assets/js/simplebar.js') }}"></script>
        <script src="{{ asset('clients/assets/js/custom.js?v=00000000000000000000002') }}"></script>
        <script src="{{ asset('clients/assets/js/bootstrap-select.min.js') }}" data-navigate-track></script>
        <script type="module" src="https://unpkg.com/ionicons@5.2.3/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule="" src="https://unpkg.com/ionicons@5.2.3/dist/ionicons/ionicons.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>
        <!-- ALPINEJS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"
            integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @livewireScripts()
        @yield('js')
    </body>

</html>
