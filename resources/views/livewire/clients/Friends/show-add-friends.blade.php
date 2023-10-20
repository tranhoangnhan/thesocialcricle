<div>
    <div class="uk-slider-container px-1 py-3">
        <ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-3@s uk-grid-small uk-grid">

    @foreach ($listFriends as $friend)
    
      <li>
        <div class="card">
            <div class="card-media h-28">
                <div class="card-media-overly"></div>
                <img src=https://technewsdaily.vn/uploads/2021/10/14/Eimi-Fukada-1-696x503.jpg alt="" class="">

                <div class="absolute bg-red-100 font-semibold px-2.5 py-1 rounded-lg text-red-500 text-xs top-2.5 left-2.5"> Lời mời kết bạn </div>
            </div>
            <div class="card-body">
                <a href="timeline-group.html" class="font-semibold text-lg truncate"> {{$friend->user_fullname}} </a>
                @php
                $createdAt = $friend->timeAddFriend;
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
                <div class="flex mt-3.5 space-x-2">
                    <div class="flex items-center -space-x-2 -mt-1">
                        <img alt="Image placeholder" src={{asset('clients/assets/images/avatars/avatar-6.jpg')}} class="border-2 border-white rounded-full w-7">
                        <img alt="Image placeholder" src={{asset('clients/assets/images/avatars/avatar-5.jpg')}} class="border-2 border-white rounded-full w-7">
                    </div>
                    <div class="flex-1 leading-5 text-sm">
                        <div> <strong>Johnson</strong> and 5 freind are members </div>
                    </div>
                </div>

                <div class="flex mt-3.5 space-x-2 text-sm font-medium">
                    <a wire:click.prevent = "addFriends({{$friend->user_one_id}})" class="bg-blue-600 flex flex-1 h-8 items-center justify-center rounded-md text-white capitalize">
                        Chấp nhận
                    </a>
                    <a wire:click.prevent = "removeFriends({{$friend->user_one_id}})" class="bg-gray-200 flex flex-1 h-8 items-center justify-center rounded-md capitalize">
                        Cút
                    </a>
                </div>

            </div>
        </div>
    </li>

    @endforeach
    <a class="absolute bg-white bottom-1/2 flex items-center justify-center p-2 -left-4 rounded-full shadow-md text-xl w-9 z-10 dark:bg-gray-800 dark:text-white" href="#" uk-slider-item="previous"> <i class="icon-feather-chevron-left"></i></a>
    <a class="absolute bg-white bottom-1/2 flex items-center justify-center p-2 -right-4 rounded-full shadow-md text-xl w-9 z-10 dark:bg-gray-800 dark:text-white" href="#" uk-slider-item="next"> <i class="icon-feather-chevron-right"></i></a>

</div>
</div>
