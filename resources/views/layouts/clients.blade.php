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
    <link rel="stylesheet" href="{{ asset('clients/assets/css/icons.css?v=1') }}">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/uikit.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/assets/css/style.css') }}">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ asset('css/pintura.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css"
        integrity="sha512-7uSoC3grlnRktCWoO4LjHMjotq8gf9XDFQerPuaph+cqR7JC9XKGdvN+UwZMC14aAaBDItdRj3DcSDs4kMWUgg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/basic.min.css"
        integrity="sha512-MeagJSJBgWB9n+Sggsr/vKMRFJWs+OUphiDV7TJiYu+TNQD9RtVJaPDYP8hA/PAjwRnkdvU+NsTncYTKlltgiw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/pintura.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">
    <link rel="stylesheet" href="{{ asset('clients/assets/fontawesome/css/all.min.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        a {
            text-decoration: none !important;
        }

        .with-border-error {
            border: 1px solid #ff0000 !important;
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

        .dropzone {
            background: white;
            border-radius: 5px;
            border: 2px dashed rgb(0, 135, 247);
            border-image: none;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .side-list-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .side-list-title {
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 600;
            --tw-text-opacity: 1;
            color: rgb(0 0 0 / var(--tw-text-opacity));
        }

        .dark\:bg-white\/5 {
            background-color: rgb(0 0 0 / 5%);
        }

        .bg-primary-soft {
            --tw-bg-opacity: 1;
            background-color: #33415026;
        }

        .button-icon {
            display: grid;
            height: 2rem;
            width: 2rem;
            place-items: center;
            border-radius: 9999px;
        }
    </style>
    @yield('customcss')
    @livewireStyles()
</head>

<body>


    <div id="wrapper">

        <!-- Header -->
        @include('clients.blocks.header')

        <!-- sidebar -->
        @include('clients.blocks.sidebar')

        <!-- Main Contents -->
        @yield('content')

    </div>

    @include('clients.blocks.right')

    <!-- For Night mode -->
    <script>
        // Check for existing theme in localStorage and set it
        if ('localStorage' in window) {
            var theme = localStorage.getItem('theme');
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                console.log('add dark');
            } else {
                document.documentElement.classList.remove('dark');
                console.log('remove dark');
            }
        }

        (function(window, document, undefined) {
            'use strict';

            // Feature test
            if (!('localStorage' in window)) return;

            // Get our newly inserted toggle
            var nightMode = document.querySelector('#night-mode');
            if (!nightMode) return;

            // When clicked, toggle night mode on or off
            nightMode.addEventListener('click', function(event) {
                event.preventDefault();
                document.documentElement.classList.toggle('dark');
                if (document.documentElement.classList.contains('dark')) {
                    localStorage.setItem('theme', 'dark');
                    changeLogo('logo-white.png');
                    return;
                } else {
                    localStorage.setItem('theme', 'light');
                    changeLogo('logo-dark.png');
                    return;
                }
            }, false);

            function changeLogo(logoFileName) {
                // Get the logo image element
                var logoElement = document.querySelector('#logo img');

                // Change the image path to logoFileName
                logoElement.src = "{{ asset('clients/assets/images/') }}" + "/" + logoFileName;
            }
        })(window, document);
    </script>


    <!-- Javascript

    ================================================== -->
    <script src="{{ asset('js/app.js?v=1.03') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('clients/assets/js/tippy.all.min.js') }}"></script>
    <script src="{{ asset('clients/assets/js/uikit.js') }}"></script>
    <script src="{{ asset('clients/assets/js/simplebar.js') }}"></script>
    <script src="{{ asset('clients/assets/js/custom.js?v=1.02') }}"></script>
    <script src="{{ asset('clients/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/lib/index.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <script src="//{{ Request::getHost() }}:{{ env('LARAVEL_ECHO_PORT') }}/socket.io/socket.io.js"></script>
    <script src="{{ url('/js/laravel-echo-setup.js') }}"></script>
    <script src="https://unpkg.com/dropzone@5.9.3/dist/dropzone.js"></script>

    <script src="{{ url('/js/pintura.js') }}" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="{{ asset('clients/assets/js/fancybox_vi.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.11/dist/clipboard.min.js"></script>
    <script src="{{ asset('clients/assets/fontawesome/js/all.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"
        integrity="sha512-q583ppKrCRc7N5O0n2nzUiJ+suUv7Et1JGels4bXOaMFQcamPk9HjdUknZuuFjBNs7tsMuadge5k9RzdmO+1GQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div id="loadingOverlay"
        class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-50 loading-overlay"
        style="z-index:999999">
        <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-blue-500"></div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.userId = {{ auth()->user()->user_id }};
            if (document.getElementById('loadingOverlay')) {
                document.getElementById('loadingOverlay').style.display = 'none';
            }
            window.Echo.channel(`laravel_database_loading.${window.userId}`)
                .listen('.AllUsersEvent', (e) => {
                    if (e.status == 'end') {
                        document.getElementById('loadingOverlay').style.display = 'none';
                    } else {
                        document.getElementById('loadingOverlay').style.display = 'flex';
                    }
                });

            var images = document.getElementsByTagName("img");
            var batchSize = 10;
            var currentIndex = 0;
            if (images) {
                function checkImages() {
                    for (var i = currentIndex; i < Math.min(currentIndex + batchSize, images.length); i++) {
                        var image = images[i];
                        if (!image.checked) {
                            image.checked = true; // Đánh dấu ảnh đã kiểm tra
                            image.onerror = function() {
                                this.src =
                                    "https://www.elegantthemes.com/blog/wp-content/uploads/2020/02/000-404.png";
                            };
                        }
                    }
                    currentIndex += batchSize;
                    if (currentIndex < images.length) {
                        setTimeout(checkImages, 100);
                    }
                }
                checkImages();
            }
            //copy
            const shareLinkButton = document.querySelector('#sharelink');
            const shareIcon = document.getElementById('shareIcon');

            if (shareLinkButton) {
                const clipboard = new ClipboardJS(shareLinkButton);

                clipboard.on('success', function(e) {
                    e.clearSelection();
                    shareIcon.setAttribute("name", "checkmark-circle");
                    shareLinkButton.querySelector('span').innerText = "Đã sao chép";

                    setTimeout(function() {
                        shareIcon.setAttribute("name", "arrow-redo-outline");
                        shareLinkButton.querySelector('span').innerText = "Chia sẻ";
                    }, 2000);
                });
            }



            Fancybox.bind("[data-fancybox]", {
                Carousel: {
                    transition: "slide",
                },
                l10n: Fancybox.l10n.vi,
            });
            var chatBox = document.getElementById('conversation');

            function scrollConversation() {
                var chatBox = document.getElementById('conversation');
                if (chatBox) {
                    chatBox.scrollTo({
                        top: chatBox.scrollHeight,
                        behavior: 'smooth'
                    });
                }
            }


            // Hàm tạo thông báo
            function createNotification(title, message) {
                const notification = new Notification(title, {
                    body: message,
                    icon: '{{ asset('clients/assets/images/logo-dark.png') }}', // Đường dẫn đến biểu tượng thông báo
                });

                // Xử lý sự kiện khi thông báo được nhấn
                notification.onclick = function() {
                    window.focus(); // Tập trung vào cửa sổ trình duyệt
                    notification.close(); // Đóng thông báo
                };
            }
            if (chatBox) {
                scrollConversation();
            }
            document.addEventListener('livewire:initialized', () => {
                // Livewire.on('slideTransition', () => {
                //     const tl = gsap.timeline({});
                //     tl.to(item, {
                //         opacity: 1,
                //         duration: 0.5,
                //         ease: "power1.out",
                //         scaleY: 0.9,
                //         scaleX: 0.9
                //     }, index * 0.5); // Thời gian trễ giữa mỗi item
                //     tl.to(item, {
                //         opacity: 1,
                //         duration: 1,
                //         scaleY: 1,
                //         scaleX: 1
                //     }, index * 0.2);
                // });




                var markAsReadMessage = document.getElementById('markAsReadMessage');
                if (markAsReadMessage) {
                    markAsReadMessage.addEventListener('click', function() {
                        Livewire.dispatch('markAsReadMessage');
                    });
                }
                Livewire.on('reloadPage', function() {
                    location.reload();
                });
                if (chatBox) {
                    var chat = document.getElementById('chat');
                    if (chat) {
                        chat.addEventListener('input', function() {
                            setTimeout(() => {
                                scrollConversation();
                            }, 500);
                        });
                    }
                    scrollConversation();
                }
                Livewire.on('chat', (e) => {
                    scrollConversation();
                    setTimeout(() => {
                        scrollConversation();
                    }, 500);
                });


                const channelName = `laravel_database_chat.${window.userId}`;

                const messageSound = new Audio('{{ asset('clients/assets/mp3/tone.wav') }}');

                function playAudio() {
                    messageSound.play();
                }
                window.Echo.channel(channelName)
                    .listen('.MessageEvent', (data) => {
                        if (data.receiverId == window.userId) {
                            Livewire.dispatch('chat');
                            setTimeout(() => {
                                const messageToShow = data.message ? data.message :
                                    'Gửi 1 hình ảnh';
                                playAudio();
                                scrollConversation();
                                if ("Notification" in window) {
                                    if (Notification.permission === "granted") {
                                        createNotification(`Tin nhắn từ ${data.name}`,
                                            `${messageToShow}`);
                                    } else if (Notification.permission !== "denied") {
                                        Notification.requestPermission().then(function(
                                            permission) {
                                            if (permission === "granted") {
                                                createNotification("Tin nhắn mới",
                                                    "Bạn có một tin nhắn mới từ ai đó."
                                                );
                                            }
                                        });
                                    }
                                }
                            }, 500);
                        }
                    });

                window.Echo.channel(`laravel_database_chat_notifications.${window.userId}`)
                    .listen('.AllUsersEvent', (e) => {
                        location.reload();
                    });

                if (document.getElementById('typing-chat')) {
                    const avatarHTML = document.getElementById('typing-chat').getAttribute('data-avatar');
                    let typingIndicatorShown = false;
                    // Lắng nghe sự kiện "đang gõ văn bản"
                    window.Echo.channel(`laravel_database_users_typing_to.${window.userId}`)
                        .listen('.AllUsersEvent', (data) => {
                            if (data.receiverId == window.userId && data.type == 'typing') {
                                const typingIndicatorExists = document.querySelector(
                                    '.message-bubble .typing-indicator');
                                if (data.status == 1 && !typingIndicatorExists) {
                                    const typingIndicator = `
                                    <div class="message-bubble">
                                        <div class="message-bubble-inner">
                                            <div class="message-avatar relative">
                                                ${avatarHTML}
                                            </div>
                                            <div class="message-text">
                                                <!-- Typing Indicator -->
                                                <div class="typing-indicator">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>`;
                                    document.getElementById('typing-chat').insertAdjacentHTML(
                                        'beforeend',
                                        typingIndicator);
                                    setTimeout(() => {
                                        scrollConversation();
                                    }, 500);
                                } else if (data.status == 0 && typingIndicatorExists) {

                                    typingIndicatorExists.parentElement.parentElement.parentElement
                                        .remove();
                                }
                            }
                        });
                }

            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var submitButton = document.getElementById("submit-button");
            var contentInput = document.getElementById("content-input");

            contentInput.addEventListener("input", function() {
                // Kiểm tra nội dung của trường input
                if (contentInput.value.trim() === "") {
                    submitButton.disabled = true; // Nếu trống, tắt nút submit
                } else {
                    submitButton.disabled = false; // Ngược lại, bật nút submit
                }
            });
        });
    </script>

    <script>
        // Lắng nghe sự kiện click trên các liên kết tab
        document.addEventListener("DOMContentLoaded", function() {
            const tabLinks = document.querySelectorAll(".responsive-nav a");

            tabLinks.forEach(function(link) {
                link.addEventListener("click", function(e) {
                    e.preventDefault();
                    // Lấy href của liên kết
                    const tabId = link.getAttribute("href").substring(1);

                    // Gọi hàm để tải dữ liệu tương ứng với tab đã chọn
                    loadTabData(tabId);
                });
            });
        });

        function loadTabData(tabId) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "/load-tab-data?tab=" + tabId, true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const responseData = xhr.responseText;
                    // Cập nhật nội dung trang với dữ liệu nhận được
                    document.getElementById("tab-content").innerHTML = responseData;
                }
            };

            xhr.send();
        }
    </script>

    @yield('js')
    @livewireScripts()
</body>


</html>
