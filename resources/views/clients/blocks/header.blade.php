<header>
    <div class="header_wrap">
        <div class="header_inner mcontainer">
            <div class="left_side">

                <span class="slide_menu" uk-toggle="target: #wrapper ; cls: is-collapse is-active">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path d="M3 4h18v2H3V4zm0 7h12v2H3v-2zm0 7h18v2H3v-2z" fill="currentColor"></path>
                    </svg>
                </span>

                <div id="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('clients/assets/images/logo-dark.png') }}" alt="SOCIALCIRCLE" class="logo"
                            id="logo-dark">
                        <img src="{{ asset('clients/assets/images/logo-white.png') }}" alt="SOCIALCIRCLE" class="logo"
                            id="logo-white" style="display: none;">
                    </a>
                </div>

            </div>

            <!-- search icon for mobile -->
            <div>
                @livewire('Clients.Search')
            </div>

            <div class="right_side">

                <div class="header_widgets">

                    @include('clients.notification.index')

                    <!-- Message -->
                    <a href="#" class="is_icon" uk-tooltip="title: Tin nhắn">
                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span>
                            @livewire('clients.home.count-message-unread')
                        </span>
                    </a>
                    <!-- Message -->
                    <div uk-drop="mode: click" class="header_dropdown is_message" class="h-screen">
                        <div class="dropdown_scrollbar overflow-x-hidden" data-simplebar>
                            @livewire('clients.conversations.list-chat', ['type' => 'header'])
                        </div>
                        <a href="{{ route('messages') }}" class="see-all"> Xem tất cả tin nhắn</a>
                    </div>


                    <a href="#">
                        <div class="is-avatar ms-2">
                            {!! getAvatar(auth()->user()->user_id) !!}
                        </div>
                    </a>
                    <div uk-drop="mode: click;offset:5" class="header_dropdown profile_dropdown">
                        <a href="{{ route('profile', ['id' => auth()->user()->user_username]) }}" class="user">
                            <div class="user_avatar">
                                {!! getAvatar(auth()->user()->user_id) !!}
                            </div>
                            <div class="user_name">
                                <div class="d-flex"> {!! getName(auth()->user()->user_id) !!} </div>
                                <span> <?= '@' ?>{{ auth()->user()->user_username }}</span>
                            </div>
                        </a>
                        <hr>

                        <hr>
                        <a href="{{ route('setting') }}">
                            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Cài đặt
                        </a>

                        <a href="{{ route('feedback') }}">
                            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                                <path fill-rule="evenodd"
                                    d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Đóng góp ý kiến
                        </a>

                        <a href="#" id="night-mode" class="btn-night-mode">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                            </svg>
                            Night mode
                            <span class="btn-night-mode-switch">
                                <span class="uk-switch-button"></span>
                            </span>
                        </a>

                        <a href="{{ route('logout') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Đăng xuất
                        </a>


                    </div>

                </div>

            </div>
        </div>
    </div>
</header>
