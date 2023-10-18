<div>


    @if (!empty($this->tags))
        <!-- Message Content Inner -->
        <div class="message-content-inner max-h-96 overflow-y-auto">
            @if (count($tags) === 1)
                <div class="flex items-center justify-center flex-col">
                    <div class="message-avatar">

                        {!! getAvatar($user_id) !!}
                    </div>
                    <div class="message-text">{{ getName($user_id) }}</div>
                </div>
            @else
                <div class="flex items-center justify-center flex-col">
                    <div class="message-avatar">
                        <div class="flex -space-x-2">
                            @php
                                $userIds = explode(',', $user_id);
                            @endphp

                            @foreach ($userIds as $userId)
                                @php
                                    $trimmedUserId = trim($userId, '[]');
                                @endphp
                                {!! getAvatar($trimmedUserId) !!}
                            @endforeach
                        </div>
                    </div>
                    <div class="message-text">
                        {{ isset($count) && $count <= 4 ? getNames($user_id) : getNames($user_id) . ' và những người khác.' }}
                    </div>
                </div>
            @endif



            <!-- Time Sign -->
            <div class="message-time-sign">
                <span>28 June, 2020</span>
            </div>

            <div class="message-bubble me">
                <div class="message-bubble-inner">
                    <div class="message-avatar"><img src="assets/images/avatars/avatar-2.jpg" alt=""></div>
                    <div class="message-text">
                        <p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod laoreet.</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="message-bubble">
                <div class="message-bubble-inner">
                    <div class="message-avatar"><img src="assets/images/avatars/avatar-2.jpg" alt=""></div>
                    <div class="message-text">
                        <p>Laoreet. dolore magna imperdiet quod mazim placerat facer possim. 👍</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="message-bubble me">
                <div class="message-bubble-inner">
                    <div class="message-avatar"><img src="assets/images/avatars/avatar-2.jpg" alt=""></div>
                    <div class="message-text">
                        <p>Albuom commodo consequat. 😉</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="message-bubble">
                <div class="message-bubble-inner">
                    <div class="message-avatar"><img src="assets/images/avatars/avatar-2.jpg" alt=""></div>
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
            </div>
        </div>
        <!-- Message Content Inner / End -->






        <!-- Reply Area -->
        <div class="message-reply z-10 d-flex align-items-center">
            <div class="chat-attagement d-flex">
                <a href="#" class="d-flex align-items-center pe-3">
                    <svg class="icon-24" width="18" height="23" viewBox="0 0 18 23" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.00021 21.5V18.3391" stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M9.00021 14.3481V14.3481C6.75611 14.3481 4.9384 12.5218 4.9384 10.2682V5.58095C4.9384 3.32732 6.75611 1.5 9.00021 1.5C11.2433 1.5 13.061 3.32732 13.061 5.58095V10.2682C13.061 12.5218 11.2433 14.3481 9.00021 14.3481Z"
                            stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path d="M17 10.3006C17 14.7394 13.418 18.3383 9 18.3383C4.58093 18.3383 1 14.7394 1 10.3006"
                            stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        </path>
                        <path d="M11.0689 6.25579H13.0585" stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M10.0704 9.59344H13.0605" stroke="currentcolor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>
                </a>
            </div>
            {{-- <span class="emojie"><img src="https://wpkixx.com/html/socimo/images/smiles/happy.png" alt=""></span> --}}
            <form class="relative w-100 flex">
                <div class="uk-button"  style="left: 13px;position: absolute;top: 25%;transform: translateY(-50%);">
                    <div class="uk-inline">
                        <a class="uk-button uk-button-default" type="button" aria-label="Toggle Dropdown"
                            aria-haspopup="true">
                            <span uk-icon="icon:  triangle-down" class="uk-icon">
                                <a class="d-flex align-items-center pe-3">
                                    <svg style="color:#0D6EFD" class="icon-24" width="24" viewBox="0 0 24 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_156_599)">
                                            <path
                                                d="M20.4853 4.01473C18.2188 1.74823 15.2053 0.5 12 0.5C8.79469 0.5 5.78119 1.74823 3.51473 4.01473C1.24819 6.28119 0 9.29469 0 12.5C0 15.7053 1.24819 18.7188 3.51473 20.9853C5.78119 23.2518 8.79469 24.5 12 24.5C15.2053 24.5 18.2188 23.2518 20.4853 20.9853C22.7518 18.7188 24 15.7053 24 12.5C24 9.29469 22.7518 6.28119 20.4853 4.01473ZM12 23.0714C6.17091 23.0714 1.42856 18.3291 1.42856 12.5C1.42856 6.67091 6.17091 1.92856 12 1.92856C17.8291 1.92856 22.5714 6.67091 22.5714 12.5C22.5714 18.3291 17.8291 23.0714 12 23.0714Z"
                                                fill="currentcolor"></path>
                                            <path
                                                d="M9.40398 9.3309C8.23431 8.16114 6.33104 8.16123 5.16136 9.3309C4.88241 9.60981 4.88241 10.0621 5.16136 10.3411C5.44036 10.62 5.89266 10.62 6.17157 10.3411C6.78432 9.72836 7.78126 9.7284 8.39392 10.3411C8.53342 10.4806 8.71618 10.5503 8.89895 10.5503C9.08171 10.5503 9.26457 10.4806 9.40398 10.3411C9.68293 10.0621 9.68293 9.60986 9.40398 9.3309Z"
                                                fill="currentcolor"></path>
                                            <path
                                                d="M18.8384 9.3309C17.6688 8.16123 15.7655 8.16114 14.5958 9.3309C14.3169 9.60981 14.3169 10.0621 14.5958 10.3411C14.8748 10.62 15.3271 10.62 15.606 10.3411C16.2187 9.72836 17.2156 9.72831 17.8284 10.3411C17.9679 10.4806 18.1506 10.5503 18.3334 10.5503C18.5162 10.5503 18.699 10.4806 18.8384 10.3411C19.1174 10.0621 19.1174 9.60986 18.8384 9.3309Z"
                                                fill="currentcolor"></path>
                                            <path
                                                d="M18.3335 13.024H5.6668C5.2723 13.024 4.95251 13.3438 4.95251 13.7383C4.95251 17.6243 8.11409 20.7859 12.0001 20.7859C15.8862 20.7859 19.0477 17.6243 19.0477 13.7383C19.0477 13.3438 18.728 13.024 18.3335 13.024ZM12.0001 19.3573C9.14366 19.3573 6.77816 17.215 6.42626 14.4525H17.574C17.2221 17.215 14.8566 19.3573 12.0001 19.3573Z"
                                                fill="currentcolor"></path>
                                        </g>
                                        <defs>
                                            <clipPath>
                                                <rect width="24" height="24" fill="white" transform="translate(0 0.5)"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </span>
                        </a>
                        <div uk-dropdown="mode: click; target: !.uk-button-group;" class="uk-drop uk-dropdown"
                            style="top: -274px; left: -141.719px; max-width: 1313px;">
                            <ul class="uk-nav uk-dropdown-nav">
                                <li class="uk-active"><a href="#">Active</a></li>
                                <li><a href="#">Item</a></li>
                                <li class="uk-nav-header">Header</li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a href="#">Item</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <textarea cols="1" rows="1" placeholder="Tin nhắn" style="border: 1px solid #0584ec;" class="ps-5"></textarea>
                <button class="button ripple-effect">Gửi</button>
                <!--Emoji!-->
                <div id="dropdownHelper"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-60 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownHelperButton">
                        <li>
                            <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <div class="flex items-center h-5">
                                    <input id="helper-checkbox-1" aria-describedby="helper-checkbox-text-1"
                                        type="checkbox" value=""
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                </div>
                                <div class="ml-2 text-sm">
                                    <label for="helper-checkbox-1"
                                        class="font-medium text-gray-900 dark:text-gray-300">
                                        <div>Enable notifications</div>
                                        <p id="helper-checkbox-text-1"
                                            class="text-xs font-normal text-gray-500 dark:text-gray-300">Some helpful
                                            instruction goes over here.</p>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <div class="flex items-center h-5">
                                    <input id="helper-checkbox-2" aria-describedby="helper-checkbox-text-2"
                                        type="checkbox" value=""
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                </div>
                                <div class="ml-2 text-sm">
                                    <label for="helper-checkbox-2"
                                        class="font-medium text-gray-900 dark:text-gray-300">
                                        <div>Enable 2FA auth</div>
                                        <p id="helper-checkbox-text-2"
                                            class="text-xs font-normal text-gray-500 dark:text-gray-300">Some helpful
                                            instruction goes over here.</p>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <div class="flex items-center h-5">
                                    <input id="helper-checkbox-3" aria-describedby="helper-checkbox-text-3"
                                        type="checkbox" value=""
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                </div>
                                <div class="ml-2 text-sm">
                                    <label for="helper-checkbox-3"
                                        class="font-medium text-gray-900 dark:text-gray-300">
                                        <div>Subscribe newsletter</div>
                                        <p id="helper-checkbox-text-3"
                                            class="text-xs font-normal text-gray-500 dark:text-gray-300">Some helpful
                                            instruction goes over here.</p>
                                    </label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </form>

        </div>
    @endif
    @php $user_id = request()->route('id'); @endphp

    @if (isset($user_id))
        <div class="messages-headline" style="max-height: none">
            <h4> {!! getName($user_id) !!} </h4>
            <a href="#" class="message-action text-red-500"><i class="icon-feather-trash-2"></i>
                <span class="md:inline hidden"> Xóa cuộc trò chuyện</span> </a>
        </div>

        <div class="message-content-scrolbar" data-simplebar>
            <!-- Message Content Inner -->
            <div class="message-content-inner max-h-96 overflow-y-auto">
                <div class="flex items-center justify-center flex-col">
                    <div class="message-avatar">
                        {!! getAvatar($user_id) !!}
                    </div>
                    <div class="message-text">{{ getName($user_id) }}</div>
                </div>

                <!-- Time Sign -->
                <div class="message-time-sign">
                    <span>28 June, 2020</span>
                </div>

                <div class="message-bubble me">
                    <div class="message-bubble-inner">
                        <div class="message-avatar"><img src="assets/images/avatars/avatar-2.jpg" alt="">
                        </div>
                        <div class="message-text">
                            <p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod laoreet.</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="message-bubble">
                    <div class="message-bubble-inner">
                        <div class="message-avatar"><img src="assets/images/avatars/avatar-2.jpg" alt="">
                        </div>
                        <div class="message-text">
                            <p>Laoreet. dolore magna imperdiet quod mazim placerat facer possim. 👍</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="message-bubble me">
                    <div class="message-bubble-inner">
                        <div class="message-avatar"><img src="assets/images/avatars/avatar-2.jpg" alt="">
                        </div>
                        <div class="message-text">
                            <p>Albuom commodo consequat. 😉</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="message-bubble">
                    <div class="message-bubble-inner">
                        <div class="message-avatar"><img src="assets/images/avatars/avatar-2.jpg" alt="">
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
                </div>
            </div>
            <!-- Message Content Inner / End -->

            <!-- Reply Area -->

            <div class="message-reply z-10">
                <textarea cols="1" rows="1" placeholder="Tin nhắn"></textarea>
                <button class="button ripple-effect">Gửi1</button>
            </div>
        </div>
    @endif

</div>
