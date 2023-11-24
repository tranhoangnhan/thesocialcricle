@extends('layouts.clients')
@section('customcss')
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" /> --}}
    <style>
        .input-container {
            flex-grow: 1;
            flex-basis: 50%;
            /* Đảm bảo 2 flex containers cùng hàng */
        }

        .color-chat {
            border: 1px solid rgb(122, 122, 122);
            cursor: pointer;
            display: inline-block;
            height: 25px;
            width: 25px;
            border-radius: 100%;
            margin-right: 5px;
            -webkit-transition: all 0.1s ease;
            transition: all 0.1s ease;
            vertical-align: middle;
        }

        li.un-read-chat {
            font-weight: bold;
        }

        li.un-read-chat::after {
            content: "";
            position: absolute;
            height: 10px;
            width: 10px;
            background-color: #4761ff;
            bottom: 23px;
            right: 20px;
            display: block;
            border-radius: 50%;
        }
    </style>
@endsection
@section('content')
    <div class="main_content">
        <div class="messages-container relative">
            <div class="messages-container-inner" x-data="{ showFind: false, showChat: false }">
                <div class="messages-inbox">
                    <div class="messages-headline">
                        <div class="input-with-icon" hidden>
                            <input id="autocomplete-input" type="text" placeholder="Search">
                            <i class="icon-material-outline-search"></i>
                        </div>
                        <h2 class="text-2xl font-semibold">Nhắn tin</h2>
                        @if (!$show)
                            <span @click="showFind = !showFind"
                                class="absolute icon-feather-edit mr-4 text-xl uk-position-center-right cursor-pointer"></span>
                        @endif
                    </div>
                    <div class="messages-inbox-inner w-100" data-simplebar>
                        <ul>

                            <livewire:clients.conversations.listchat>
                                <template x-if="showFind">
                                    <livewire:clients.conversations.index>
                                </template>
                        </ul>
                    </div>
                </div>


                <div class="message-content">

                    @if ($show)
                        <div>
                            <livewire:clients.conversations.chat :id="$id" />
                        </div>
                    @else
                        @if (empty($id))
                            <div>
                                <template x-if="showFind">
                                    <div class="messages-headline" style="position:relative;max-height: none">
                                        <div class="wrapper relative">
                                            <livewire:clients.conversations.search>
                                        </div>
                                    </div>
                                </template>

                                <template x-if="showFind">
                                    <div>
                                        <livewire:clients.conversations.chat>
                                    </div>
                                </template>
                            </div>
                        @endif
                    @endif

                    @if (!$show)
                        <template x-if="!showFind && !showChat">
                            <div class="hidden md:flex justify-center items-center h-screen">
                                <p class="text-center">Hãy chọn một đoạn chat hoặc bắt đầu cuộc trò chuyện mới</p>
                            </div>
                        </template>
                    @endif

                </div>
            </div>
        </div>


        <audio id="myAudio" src="{{ asset('clients/assets/mp3/press.wav') }}" autoplay="true" muted="muted">
    </div>
@endsection
@section('js')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/emoji-mart@latest/dist/browser.js"></script> --}}
    {{-- <script>
        var chatBox = document.getElementById('conversation');

        function scrollConversation() {
            var chatBox = document.getElementById('conversation');
            if (chatBox) {
                chatBox.scrollTop = chatBox.scrollHeight;
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
                // Thực hiện hành động khi thông báo được nhấn, ví dụ: mở ứng dụng hoặc trang web liên quan
                window.focus(); // Tập trung vào cửa sổ trình duyệt
                notification.close(); // Đóng thông báo
            };
        }
        if (chatBox) {
            scrollConversation();
        }
        document.addEventListener('livewire:initialized', () => {
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




            // var sendChatButton = document.getElementById('sendChat');
            // if (sendChatButton) {
            //     sendChatButton.addEventListener('click', function() {
            //         var message = document.getElementById('chat').value;
            //         console.log('hi')
            //         Livewire.dispatch('message', {
            //             message
            //         });
            //     });
            // }
            let emojiPickerAdded = false; // Biến để kiểm tra xem đã thêm bảng chọn emoji hay chưa
            let showEmojiPicker = false;
            Livewire.on('chat', (e) => {
                scrollConversation();
            });
            // Livewire.on('emoji', (event) => {
            setTimeout(() => {
                lang = {
                    "search": "Tìm kiếm",
                    "search_no_results_1": "Ôi không!",
                    "search_no_results_2": "Không thể tìm thấy biểu tượng cảm xúc",
                    "pick": "Chọn biểu tượng cảm xúc..",
                    "add_custom": "Thêm biểu tượng cảm xúc",
                    "categories": {
                        "activity": "Hoạt động",
                        "custom": "Chỉnh sửa",
                        "flags": "Cờ",
                        "foods": "Đồ Ăn",
                        "frequent": "Dùng thường xuyên",
                        "nature": "Thiên nhiên",
                        "objects": "Dụng cụ",
                        "people": "Con người",
                        "places": "Địa điểm",
                        "search": "Tìm kiếm",
                        "symbols": "Ký hiệu"
                    },
                    "skins": {
                        "choose": "Chọn tông mặc định",
                        "1": "Mặc định",
                        "2": "Sáng",
                        "3": "Trung bình sáng",
                        "4": "Trung bình",
                        "5": "Trung bình tối",
                        "6": "Tối"
                    }
                }
                const custom = [{
                        id: 'github',
                        name: 'GitHub',
                        emojis: [{
                                id: 'octocat',
                                name: 'Octocat',
                                keywords: ['github'],
                                skins: [{
                                    src: './octocat.png'
                                }],
                            },
                            {
                                id: 'shipit',
                                name: 'Squirrel',
                                keywords: ['github'],
                                skins: [{
                                        src: './shipit-1.png'
                                    }, {
                                        src: './shipit-2.png'
                                    }, {
                                        src: './shipit-3.png'
                                    },
                                    {
                                        src: './shipit-4.png'
                                    }, {
                                        src: './shipit-5.png'
                                    }, {
                                        src: './shipit-6.png'
                                    },
                                ],
                            },
                        ],
                    },
                    {
                        id: 'gifs',
                        name: 'GIFs',
                        emojis: [{
                            id: 'party_parrot',
                            name: 'Party Parrot',
                            keywords: ['dance', 'dancing'],
                            skins: [{
                                src: './party_parrot.gif'
                            }],
                        }, ],
                    },
                ];
                const i18n = lang;
                const previewPosition = "none";
                const emoji_div = document.querySelector('#emoji-div');
                const emojiPickerContainer = document.querySelector('#emoji-picker-container');
                const themex = localStorage.getItem('theme');
                let emojiPicker;
                const pickerOptions = {
                    onEmojiSelect: (emoji) => {
                        const selectedEmoji = emoji.native || emoji.colons;
                        const chatElement = document.querySelector('#chat');
                        if (chatElement) {
                            chatElement.value += selectedEmoji;
                        }
                        console.log(chatElement);
                        showEmojiPicker = false;
                    },
                    i18n,
                    navPosition: "top",
                    previewPosition: "none",
                    theme: themex === 'dark' ? 'dark' : 'light',
                    custom: custom
                };
                emojiPicker = new EmojiMart.Picker(
                    pickerOptions); // Create a new picker
                emoji_div.appendChild(
                    emojiPicker);
                emojiPickerContainer.addEventListener('click', () => {
                    $('#emoji-div').toggle();
                });
                scrollConversation();

            }, 300);
            // });

            window.userId = {{ auth()->user()->user_id }};
            const channelName = `laravel_database_chat.${window.userId}`;

            const messageSound = new Audio('{{ asset('clients/assets/mp3/tone.wav') }}');

            function playAudio() {
                messageSound.play();
            }
            window.Echo.channel(channelName)
                .listen('.MessageEvent', (data) => {
                    console.log(data)
                    if (data.receiverId == window.userId) {
                        Livewire.dispatch('chat');
                        setTimeout(() => {
                            playAudio();
                            scrollConversation();
                            if ("Notification" in window) {
                                if (Notification.permission === "granted") {
                                    createNotification(`Tin nhắn từ ${data.name}`, `${data.message}`);
                                } else if (Notification.permission !== "denied") {
                                    Notification.requestPermission().then(function(permission) {
                                        if (permission === "granted") {
                                            createNotification("Tin nhắn mới",
                                                "Bạn có một tin nhắn mới từ ai đó.");
                                        }
                                    });
                                }
                            }
                        }, 500);
                    }
                });
            const avatarHTML = document.getElementById('typing-chat').getAttribute('data-avatar');
            let typingIndicatorShown = false;
            // Lắng nghe sự kiện "đang gõ văn bản"
            window.Echo.channel(`laravel_database_users_typing_to.${window.userId}`)
                .listen('.AllUsersEvent', (data) => {
                    if (data.receiverId == window.userId && data.type == 'typing') {
                        const typingIndicatorExists = document.querySelector(
                            '.message-bubble .typing-indicator');
                        if (data.status == 1 && !typingIndicatorExists) {
                            console.log('Đang gõ');
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
                            document.getElementById('typing-chat').insertAdjacentHTML('beforeend',
                                typingIndicator);
                            setTimeout(() => {
                                scrollConversation();
                            }, 500);
                        } else if (data.status == 0 && typingIndicatorExists) {
                            console.log('Ngừng gõ');
                            typingIndicatorExists.parentElement.parentElement.parentElement.remove();
                        }
                    }
                });



        });
    </script> --}}
    <script>
        // conversation = document.getElementById('conversation')
        // if (conversation) {
        //     conversation.addEventListener('scroll', checkScrollPosition);

        //     function checkScrollPosition() {
        //         if ((conversation.scrollTop === 0)) {
        //             Livewire.dispatch('loadMoreMessage');
        //             if (Livewire.on('loadMoreMessage')) {
        //                 console.log('đã in')
        //             }
        //             console.log('a')
        //         }
        //     }
        // }

        document.addEventListener('livewire:initialized', () => {

            conversation = document.getElementById('conversation');
            if (conversation) {
                conversation.addEventListener('scroll', checkScrollPosition);

                function checkScrollPosition() {
                    if (conversation.scrollTop === 0 && conversation.scrollHeight > conversation.clientHeight) {
                        Livewire.dispatch('loadMoreMessage');
                    }
                }
            }


            var actionElements = document.querySelectorAll('[data-index], [data-index-qtv], [data-index-unqtv]');
            actionElements.forEach(function(element) {
                element.addEventListener('click', function() {
                    var userId;
                    var type;
                    if (this.hasAttribute('data-kick-userid')) {
                        userId = this.getAttribute('data-kick-userid');
                        type = "kick";
                    } else if (this.hasAttribute('data-qtv-userid')) {
                        userId = this.getAttribute('data-qtv-userid');
                        type = "setAdmin";
                    } else if (this.hasAttribute('data-unqtv-userid')) {
                        userId = this.getAttribute('data-unqtv-userid');
                        type = "setUnAdmin";
                    }
                    if (userId && type) {
                        Livewire.dispatch('change1', {
                            data: userId,
                            type: type
                        });
                    }
                });
            });
        });
    </script>
@endsection
