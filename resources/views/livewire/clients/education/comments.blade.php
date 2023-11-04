<div>
    <h3 class="mb-8 mt-20 font-semibold text-2xl"> Bình luận({{$count}}) </h3>
    @foreach ($comments as $comment)
    <div class="flex gap-x-4 mb-5 relative">
        <img src="assets/images/avatars/avatar-4.jpg" alt=""
            class="rounded-full shadow w-12 h-12">
        <div>
            <h4 class="text-base m-0">{{$comment->user_fullname}}</h4>
            <span class="text-gray-700 text-sm"> {{$comment->date}} </span>
            <p class="mt-3">
                {{$comment->comment}}
            </p>
        </div>
    </div>
    @endforeach

    <!-- Add comment -->
    <h3 class="mb-8 mt-20 font-semibold text-xl"> Nhận xét khóa học </h3>
    <div class="flex space-x-4 mb-5 relative">
        <img src="assets/images/avatars/avatar-4.jpg" alt=""
            class="rounded-full shadow w-12 h-12">
        <div class="flex-1">
            <div class="grid md:grid-cols-2 gap-4">
                <div class="col-span-2">
                    <textarea wire:model='content' name="" class="p-3" id="" cols="30" rows="6"
                        class="bg-gradient-to-b from-gray-100 to-gray-100"></textarea>
                </div>
                <div class="col-span-2">
                    <button class="btn btn-primary" wire:click='comment()' >Bình luận</button>
                </div>
            </div>
        </div>
    </div>
</div>
