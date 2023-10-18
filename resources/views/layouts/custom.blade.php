<!DOCTYPE html>
<html lang="en">

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <script src="https://cdn.jsdelivr.net/npm/turbolinks@5.2.0/dist/turbolinks.min.js"></script> --}}
    @yield('custom')
    <style>
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




        .loading {
            width: 100%;
            height: 100%;
            background: #16171d;
            opacity: 0.9;
            z-index: 9999999;
            position: fixed;
        }

        .loading>div {
            width: 60px;
            height: 60px;
            position: absolute;
            left: 50%;
            margin-left: -30px;
            top: 50%;
            margin-top: -30px;
        }


        .loading>div>div {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            background: #2563EB;
            top: 10px;
            left: 10px;
            transform-origin: 20px 20px;
            border-radius: 8px;
            animation: spin-a 2s infinite cubic-bezier(0.5, 0, 0.5, 1);
        }

        .loading>div>.c2 {
            top: 10px;
            left: auto;
            right: 10px;
            transform-origin: -4px 20px;
            animation: spin-b 2s infinite cubic-bezier(0.5, 0, 0.5, 1);
        }

        .loading>div>.c3 {
            top: auto;
            left: auto;
            right: 10px;
            bottom: 10px;
            transform-origin: -4px -4px;
            animation: spin-c 2s infinite cubic-bezier(0.5, 0, 0.5, 1);
        }

        .loading>div>.c4 {
            top: auto;
            bottom: 10px;
            transform-origin: 20px -4px;
            animation: spin-d 2s infinite cubic-bezier(0.5, 0, 0.5, 1);
        }

        @keyframes spin-a {
            0% {
                transform: rotate(90deg);
            }

            0% {
                transform: rotate(90deg);
            }

            50% {
                transform: rotate(180deg);
            }

            75% {
                transform: rotate(270deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes spin-b {
            0% {
                transform: rotate(90deg);
            }

            25% {
                transform: rotate(90deg);
            }

            25% {
                transform: rotate(180deg);
            }

            75% {
                transform: rotate(270deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes spin-c {
            0% {
                transform: rotate(90deg);
            }

            25% {
                transform: rotate(90deg);
            }

            50% {
                transform: rotate(180deg);
            }

            50% {
                transform: rotate(270deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes spin-d {
            0% {
                transform: rotate(90deg);
            }

            25% {
                transform: rotate(90deg);
            }

            50% {
                transform: rotate(180deg);
            }

            75% {
                transform: rotate(270deg);
            }

            75% {
                transform: rotate(360deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }


        .loading>span {
            width: 100px;
            height: 30px;
            position: absolute;
            left: 50%;
            margin-left: -50px;
            top: 50%;
            margin-top: 35px;
            color: #2563EB;
            font-size: 15px;
            text-align: center;
        }
    </style>
    @yield('css')

    @livewireStyles()
</head>

<body>

    {{-- <div class="loading d-none">
        <div>
            <div class="c1"></div>
            <div class="c2"></div>
            <div class="c3"></div>
            <div class="c4"></div>
        </div>
        <span>Đang xử lý</span>
    </div> --}}




    <!-- Main Contents -->
    @yield('content')

    <script>
        (function(window, document, undefined) {
            'use strict';
            if (!('localStorage' in window)) return;
            var nightMode = localStorage.getItem('gmtNightMode');
            if (nightMode) {
                document.documentElement.className += ' night-mode';
            }
        })(window, document);

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
                    return;
                }
                localStorage.removeItem('gmtNightMode');
            }, false);

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"
        integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @livewireScripts()
    @yield('js')
</body>

</html>
