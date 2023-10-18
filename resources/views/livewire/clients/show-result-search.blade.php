<div>
    <!-- Main Contents -->
    <div class="main_content">
        <div class="mcontainer">

            <div class="lg:flex lg:space-x-10">
                <!-- Sidebar -->
                @if($posts->isEmpty()&&$friend->isEmpty() || $search == "")
                    <div class="lg:w-2/3 w-full">
                        <div class="border-b flex items-center justify-between p-4">
                            <div>
                                <h2 class="text-lg font-semibold">Không tìm thấy kết quả</h2>
                            </div>
                        </div>
                    </div>
                @endif
                @if(sizeof($friend) > 0)
                    <div class="lg:w-2/3 w-full">
                        <div uk-sticky="media @m ; offset:80 ; bottom : true" class="card">


                            <div class="border-b flex items-center justify-between p-4">
                                <div>
                                    <h2 class="text-lg font-semibold">Bạn bè theo từ khoá</h2>
                                </div>
                                <a href="#" class="text-blue-500"> Xem thêm </a>
                            </div>

                            <div class="p-4 -mt-1.5">

                                @foreach($friend as $friend)
                                    <div class="flex items-center space-x-4 rounded-md -mx-2 p-2 hover:bg-gray-50">
                                        <a href="timeline-page.html" href="timeline-page.html"iv class="w-12 h-12 flex-shrink-0 overflow-hidden rounded-full relative">
{{--                                            <img src="assets/images/avatars/avatar-1.jpg" class="absolute w-full h-full inset-0 " alt="">--}}
                                            {!!getAvatar($friend->user_id)!!}
                                        </a>
                                        <div class="flex-1">
                                            <a href="timeline-page.html" class="text-base font-semibold capitalize"> {{$friend->user_fullname}} </a>
                                        </div>
                                        @livewire('Clients.Friends.AddFriend', ['friendData' => $friend], key($friend->user_id))

                                     
                                    </div>
                                @endforeach
                            </div>
                            <a href="#" class="block text-center pb-4 font-medium text-blue-500"> See all </a>
                        </div>
                    </div>
                @endif
            </div>

            <br>
            @if(sizeof($posts) > 0 && $search != "" )
                <div class="lg:w-2/3 w-full">
                    @foreach ($posts as $post)

                        <div class="card lg:mx-0 uk-animation-slide-bottom-small" @if($loop->last) id="last-record" @endif>

                            <!-- post header-->
                            <div class="flex justify-between items-center lg:p-4 p-2.5">
                                <div class="flex flex-1 items-center space-x-4">
                                    <a href="#">
                                        <img src="{{asset($post->user->user_avatar)}}" class="bg-gray-200 border border-white rounded-full w-10 h-10">
                                    </a>
                                    <div class="flex-1 font-semibold capitalize">
                                        <a href="#" class="text-black dark:text-gray-100"> {{$post->user->user_fullname}} </a>
                                        <div class="text-gray-700 flex items-center space-x-2">

                                            @php
                                                $createdAt = $post->created_at;
                                                $now = now();
                                                $diffInSeconds = $now->diffInSeconds($createdAt);
                                                $diffInMinutes = $now->diffInMinutes($createdAt);
                                                $diffInHours = $now->diffInHours($createdAt);
                                                $diffInDays = $now->diffInDays($createdAt);
                                            @endphp

                                            {{-- Hiển thị thời gian --}}
                                            @if ($diffInSeconds < 60)
                                                {{ $diffInSeconds }} giây trước
                                            @elseif ($diffInMinutes < 60)
                                                {{ $diffInMinutes }} phút trước
                                            @elseif ($diffInHours < 24)
                                                {{ $diffInHours }} giờ trước
                                            @else
                                                {{ $diffInDays }} ngày trước
                                            @endif

                                            <ion-icon name="people"></ion-icon></div>
                                    </div>
                                </div>
                                <div>
                                    <a href="#"> <i class="icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i> </a>
                                    <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"
                                         uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small">

                                        <ul class="space-y-1">
                                            <li>
                                                <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                                    <i class="uil-share-alt mr-1"></i> Share
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                                    <i class="uil-edit-alt mr-1"></i>  Edit Post
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                                    <i class="uil-comment-slash mr-1"></i>   Disable comments
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                                    <i class="uil-favorite mr-1"></i>  Add favorites
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="-mx-2 my-2 dark:border-gray-800">
                                            </li>
                                            <li>
                                                <a href="#" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600">
                                                    <i class="uil-trash-alt mr-1"></i>  Delete
                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>

                            <div uk-lightbox>
                                <p class="p-2">{{$post->text}}</p>
                            </div>


                            <div class="p-4 space-y-3">

                                <div class="flex space-x-4 lg:font-bold">
                                    <a wire:click="upLike({{ $post->post_id }})" class="flex items-center space-x-2">
                                        <div class="p-2 rounded-full text-black lg:bg-gray-100 dark:bg-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="22" height="22" class="dark:text-gray-100">
                                                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                            </svg>
                                        </div>
                                        <div>
                                            {{$post->reaction_like_count}}
                                            @if (isset($post->reaction_count) && $post->reaction_count  > 0)
                                                <i class="uil-heart text-red-500">Đã thích</i>
                                            @else
                                                <i class="uil-heart text-red-500">Thích</i>
                                            @endif
                                        </div>
                                    </a>
                                    <a href="#" class="flex items-center space-x-2">
                                        <div class="p-2 rounded-full  text-black lg:bg-gray-100 dark:bg-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="22" height="22" class="dark:text-gray-100">
                                                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div> Comment</div>
                                    </a>
                                    <a href="#" class="flex items-center space-x-2 flex-1 justify-end">
                                        <div class="p-2 rounded-full  text-black lg:bg-gray-100 dark:bg-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="22" height="22" class="dark:text-gray-100">
                                                <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                                            </svg>
                                        </div>
                                        <div> Share</div>
                                    </a>
                                </div>
                                <div class="flex items-center space-x-3 pt-2">
                                    <div class="flex items-center">
                                        <img src="{{asset('clients/assets/images/avatars/avatar-1.jpg')}}" alt="" class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-900">
                                        <img src="{{asset('clients/assets/images/avatars/avatar-4.jpg')}}" alt="" class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-900 -ml-2">
                                        <img src="{{asset('clients/assets/images/avatars/avatar-2.jpg')}}" alt="" class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-900 -ml-2">
                                    </div>
                                    <div class="dark:text-gray-100">
                                        @if ($post->reaction_like_count === 0)
                                            {{-- Nếu bài viết chưa có ai thích, hiển thị thông báo --}}
                                            Hãy là người đầu tiên thích bài viết này!
                                        @elseif ($post->reaction_like_count === 1)
                                            {{-- Nếu chỉ có một người thích bài viết --}}
                                            @if ($post->reaction_count > 0 && $post->reaction[0]->user_id == auth()->user()->user_id)
                                                {{-- Nếu bạn đã thích bài viết, hiển thị thông báo --}}
                                                Bạn đã thích bài viết này.
                                            @else
                                                {{-- Nếu không phải bạn thích, hiển thị thông báo cho người khác --}}
                                                {{$post->reaction_like_count}} người đã thích bài viết này.

                                            @endif
                                        @else
                                            {{-- Nếu có nhiều người đã thích bài viết --}}
                                            @if ($post->reaction_count > 0 && $post->reaction[0]->user_id == auth()->user()->user_id)
                                                {{-- Nếu bạn đã thích bài viết, hiển thị thông báo --}}
                                                Bạn và {{$post->reaction_like_count - 1}} người khác đã thích bài viết này.
                                            @else
                                                {{-- Nếu không phải bạn thích, hiển thị thông báo cho người khác --}}
                                                {{$post->reaction_like_count}} người đã thích bài viết này.
                                            @endif
                                        @endif




                                    </div>
                                </div>

                                <div class="border-t py-4 space-y-4 dark:border-gray-600">

                                    @foreach ( $post->comments as $comment )
                                        <div class="flex">
                                            <div class="w-10 h-10 rounded-full relative flex-shrink-0">
                                                <img src="{{$comment->user_avatar}}" alt="" class="absolute h-full rounded-full w-full">
                                            </div>
                                            <div>
                                                <div class="text-gray-700 py-2 px-3 rounded-md bg-gray-100 relative lg:ml-5 ml-2 lg:mr-12  dark:bg-gray-800 dark:text-gray-100">
                                                    <a href="/profile/{{$comment->user_id}}">{{$comment->user_fullname}}</a>
                                                    <p class="leading-6">{{$comment->text}} </p>
                                                    <div class="absolute w-3 h-3 top-3 -left-1 bg-gray-100 transform rotate-45 dark:bg-gray-800"></div>
                                                </div>
                                                <div class="text-xs flex items-center space-x-3 mt-2 ml-5">
                                                    <a href="#" class="text-red-600"> <i class="uil-heart"></i> Love </a>
                                                    <a href="#"> Replay </a>
                                                    <span>
                            @php
                                $createdAt = $comment->created_at;
                                $now = now();
                                $diffInSeconds = $now->diffInSeconds($createdAt);
                                $diffInMinutes = $now->diffInMinutes($createdAt);
                                $diffInHours = $now->diffInHours($createdAt);
                                $diffInDays = $now->diffInDays($createdAt);
                            @endphp

                                                        {{-- Hiển thị thời gian --}}
                                                        @if ($diffInSeconds < 60)
                                                            {{ $diffInSeconds }}s
                                                        @elseif ($diffInMinutes < 60)
                                                            {{ $diffInMinutes }}m
                                                        @elseif ($diffInHours < 24)
                                                            {{ $diffInHours }}h
                                                        @else
                                                            {{ $diffInDays }}d
                                                        @endif  </span>
                                                    @if($comment->user_id == Auth::user()->user_id)

                                                        <a href="#" class="ml-auto"> <i class="uil-trash-alt"></i> </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>

                                <button wire:click="loadMoreComment({{ $post->post_id }})" class="hover:text-blue-600 hover:underline">  Tải thêm bình luận  </button>








                                <div class="bg-gray-100 rounded-full relative dark:bg-gray-800 border-t">
                                    <form wire:submit="Insertcomment({{$post->post_id}})" >
                                        <input placeholder="Thêm bình luận của bạn" class="bg-transparent max-h-10 shadow-none px-5" wire:model="ContentComment.{{ $post->post_id }}">
                                    </form>
                                    <div class="-m-0.5 absolute bottom-0 flex items-center right-3 text-xl">
                                        <a href="#">
                                            <ion-icon name="happy-outline" class="hover:bg-gray-200 p-1.5 rounded-full"></ion-icon>
                                        </a>
                                        <a href="#">
                                            <ion-icon name="image-outline" class="hover:bg-gray-200 p-1.5 rounded-full"></ion-icon>
                                        </a>
                                        <a href="#">
                                            <ion-icon name="link-outline" class="hover:bg-gray-200 p-1.5 rounded-full"></ion-icon>
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    @endforeach
                    @if($loadAmount >= $totalRecords)



                        <div class="card lg:mx-0 uk-animation-slide-bottom-small">

                        </div>

                        <div class="flex justify-center mt-6">
                            <button wire:click="loadMore" class="bg-white dark:bg-gray-900 font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                                Đang tải thêm</button>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div></div>
