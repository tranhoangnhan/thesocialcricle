<div>
    <div class="story-prev h-full">
        <div class="story-sidebar uk-animation-slide-left-medium">
            <!-- ... -->
            <div class="story-sidebar-scrollbar hidden xs:hidden sm:hidden md:block" data-simplebar>
                {{-- <!-- Tin của bạn -->
                <h3 class="text-lg font-medium">Tin của bạn</h3>
                <a class="flex space-x-4 items-center hover:bg-gray-100 md:my-2 py-2 rounded-lg hover:text-gray-700"
                    href="#">
                    <svg class="w-12 h-12 p-3 bg-gray-200 rounded-full text-blue-500 ml-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <div class="flex-1">
                        <div class="text-lg font-semibold"> Tạo tin </div>
                        <div class="text-sm -mt-0.5"> Bạn có thể chia sẻ ảnh, video hoặc viết gì đó. </div>
                    </div>
                </a> --}}

                <!-- Tin của bạn bè -->
                <h3 class="text-lg font-medium lg:mt-3 mt-1">Tin</h3>
                <div class="story-users-list overflow-y-scroll h-screen" style="height:500px"
                    uk-switcher="connect: #story_slider ; toggle: > * ; animation: uk-animation-slide-right-medium, uk-animation-slide-left-medium ">
                    @if ($story->count() > 0)
                        @foreach ($story as $index => $stories)
                            @php
                                $friendWithStory = $friends->first(function ($friend) use ($stories) {
                                    return $friend->user_id == optional($stories->story)->user_id;
                                });
                            @endphp

                            @if ($friendWithStory)
                                <a href="#" {!! $activePage == $index ? 'aria-expanded="true" class="uk-active"' : 'aria-expanded="false" class=""' !!}>
                                    <div class="story-media">
                                        {!! getAvatar(
                                            $friendWithStory->user_id,
                                            null,
                                            'width: 100%; height: 100%; position: absolute; -o-object-fit: cover; object-fit: cover; border-radius: 50%; border: solid white 2px;',
                                        ) !!}
                                    </div>
                                    <div class="story-text">
                                        <div
                                            class="story-username"style="color: black; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-weight: 600;">
                                            {!! getNameC($friendWithStory->user_id) !!}</div>
                                        <p>
                                            <span class="story-time">
                                                {{ formatTimeAgo(optional($stories->story)->time, 'select') }}</span>
                                        </p>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="story-content h-screen align-items-center flex justify-center m-auto"
            style="margin: 0 auto;
        align-items: center;
        justify-content: center;
        display: flex;
        max-height: 532px;
        max-width: 299px;
        height: 532px;
        width: 299px;">
            <!-- Story Slider -->
            <ul class="uk-switcher uk-animation-scale-up" id="story_slider">
                @foreach ($story as $index => $stories)
                    <li {!! $activePage == $index ? 'class="relative uk-active"' : 'class="relative"' !!}>
                        @php
                            $friendWithStory = $friends->first(function ($friend) use ($stories) {
                                return $friend->user_id == optional($stories->story)->user_id;
                            });
                        @endphp
                        @if (auth()->user()->user_id == $friendWithStory->user_id)
                            <div class="relative hidden sm:hidden md:flex">
                                <div class="story-trash-icon cursor-pointer sm:hidden md:flex">
                                    <i class="fas fa-trash cursor-pointer"
                                        wire:click="deleteStory({{ optional($stories->story)->story_id }})"></i>
                                </div>
                            </div>
                            <div class="relative flex justify-between md:hidden">
                                <div>
                                    <div class="story-media">
                                        {!! getAvatar(
                                            $friendWithStory->user_id,
                                            null,
                                            'width: 40px; height: 40px; position: absolute; -o-object-fit: cover; object-fit: cover; border-radius: 50%; border: solid white 2px;',
                                        ) !!}
                                    </div>
                                    <div class="story-text ms-5">
                                        <div class="story-username"
                                            style="color: black; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-weight: 600;">
                                            {!! getNameC($friendWithStory->user_id) !!}
                                        </div>
                                        <p>
                                            <span class="story-time">
                                                {{ formatTimeAgo(optional($stories->story)->time, 'select') }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="story-trash-icon cursor-pointer">
                                    <i class="fas fa-trash cursor-pointer"
                                        wire:click="deleteStory({{ optional($stories->story)->story_id }})"></i>
                                </div>
                            </div>
                        @endif


                        <span uk-switcher-item="previous" class="slider-icon is-left"> </span>
                        <span uk-switcher-item="next" class="slider-icon is-right"> </span>
                        <div uk-lightbox>
                            <a href="{{ $stories->source }}" data-alt="Image">
                                @if ($stories->is_photo == 1)
                                    <img src="{{ $stories->source }}" class="story-slider-image object-contain"
                                        data-alt="Image">
                                @else
                                    <video width="299" height="532" id="story-{{ $index }}" class="video-js"
                                        autoplay muted controls>
                                        <source src="{{ $stories->source }}" type="video/mp4" />
                                    </video>
                                @endif

                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>

            <!-- Story Close Button -->
            <span wire:click='closeStory' class="story-btn-close" uk-toggle="target: body ; cls: story-active"
                uk-tooltip="title:Đóng ; pos: left">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </span>
        </div>
    </div>
</div>
