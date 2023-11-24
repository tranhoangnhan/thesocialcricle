<div>
    {{-- <div id="stories"></div> --}}
    <!-- user story -->
    <div class="user_story grid md:grid-cols-5 grid-cols-3 gap-2 lg:-mx-20 relative">
        <a class="col-span-1">
            <div class="single_story">
                {!! getAvatar(
                    auth()->user()->user_id,
                    null,
                    'border-radius:10px;font-size:30px!important;font-family: Arial, Helvetica, sans-serif;
                    background: #2a64e2f5;
                    font-size: 16px;
                    color: #fff;
                    text-align: center;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height:100%;',
                    'h-36 object-cover shadow-sm w-full relative',
                ) !!}
                <div class="story-content position-absolute" style="background-color: #20212269;"
                    uk-toggle="target: #upload_Story">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" class="text-center flex m-auto"
                        style="color: #ffffff;" viewBox="0 0 448 512">
                        <path fill="#ffffff"
                            d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                    </svg>
                    <h4 class="text-center">Tạo tin </h4>
                </div>
            </div>
        </a>

        @if (count($paginatedStories) > 0)
            <div id="stories-container" class="grid md:grid-cols-4 grid-cols-4 gap-2 col-span-2 md:col-span-4">
                @foreach ($paginatedStories as $index => $stories)
                    @php
                        $friendWithStory = $friends->first(function ($friend) use ($stories) {
                            return $friend->user_id == optional($stories['story'])['user_id'];
                        });
                    @endphp

                    @if ($friendWithStory)
                        <div wire:click="changeActivePage({{ $index + $startIndex}})"
                            class="cursor-pointer transition-transform duration-300 ease-out">
                            <div href="#" uk-toggle="target: body ; cls: story-active">
                                <div class="single_story">
                                    <img src="{{$stories['source']}}"
                                        alt="">
                                    <div class="story-avatar">
                                        {!! getAvatar(
                                            $friendWithStory->user_id,
                                            null,
                                            'width: 35px; height: 35px; border-radius: 100%; position: relative; border: 2px solid white;',
                                        ) !!}
                                    </div>
                                    <div class="story-content">
                                        <h6
                                            style="color: white; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-weight: 600;">
                                            {!! getNameC($friendWithStory->user_id) !!}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif


        <span wire:click="prevPage" wire:click.prevent="slideTransition('prev')"
            class="absolute bg-white lg:flex items-center justify-center p-2 rounded-full shadow-md text-xl w-9 z-10 uk-position-center-left -ml-4 hidden">
            <i class="icon-feather-chevron-left"></i>
        </span>

        <span wire:click="nextPage" wire:click.prevent="slideTransition('next')"
            class="absolute bg-white lg:flex items-center justify-center p-2 rounded-full shadow-md text-xl w-9 z-10 uk-position-center-right -mr-4 hidden">
            <i class="icon-feather-chevron-right"></i>
        </span>

    </div>
</div>
