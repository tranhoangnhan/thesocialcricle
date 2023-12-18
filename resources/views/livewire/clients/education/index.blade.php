<div>
    @foreach ($courses as $course)

    <div class="flex md:space-x-6 space-x-4 md:py-5 py-3 relative">
        <a href="/courses/{{$course->slug}}" class="md:w-64 md:h-40 w-36 h-24 overflow-hidden rounded-lg relative shadow-sm">
             <img src="{{$course->banner}}" alt="" class="w-full h-full absolute inset-0 object-cover">
             <div class="absolute bg-yellow-100 font-semibold px-2.5 py-1 rounded-full text-yellow-500 text-xs top-2.5 left-2.5">
                {{$course->category_name}}
             </div>
            <img src="{{asset('clients/assets/images/icon-play.svg')}}" class="w-12 h-12 uk-position-center" alt="">
        </a>
        <div class="flex-1 space-y-2">

            <a   href="/courses/{{$course->slug}}"class="md:text-xl font-semibold line-clamp-2"> {{$course->course_name}}  </a>
            <p class="leading-6 pr-4 line-clamp-2 md:block hidden"> {{$course->description}} </p>
            <a href="{{route('profile',['id' => auth()->user()->user_id])}}" class="font-semibold block text-sm"> {{$course->user_fullname}}</a>

           <div class="flex items-center justify-between">
            <div class="flex space-x-3 items-center text-sm md:pt-3 font-medium">
                <div> <i class="icon-feather-users mr-2"></i> {{$course->enroll}} người tham gia</div>
            </div>
                @if ($course->enroller==true)
                <a wire:click.prevent='enroll({{$course->course_id}})' class="md:flex items-center justify-center h-9 px-8 rounded-md border hidden bg-gray-100">Hủy Tham gia </a>
                @else
                <a wire:click.prevent='enroll({{$course->course_id}})' class="md:flex items-center justify-center h-9 px-8 rounded-md border hidden bg-gray-100">Tham gia </a>
                @endif

            </div>

        </div>
    </div>

    @endforeach
</div>
