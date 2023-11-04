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

            <a wire:navigate href="/courses/{{$course->slug}}"class="md:text-xl font-semibold line-clamp-2"> {{$course->course_name}}  </a>
            <p class="leading-6 pr-4 line-clamp-2 md:block hidden"> {{$course->description}} </p>
            <a href="/profile/{{auth()->user()->user_id}}" class="font-semibold block text-sm"> {{$course->user_fullname}}</a>

           <div class="flex items-center justify-between">
                <div class="flex space-x-3 items-center text-sm md:pt-3 font-medium">

                </div>
                @if ($course->enroller==true)
                <a wire:click.prevent='enroll({{$course->course_id}})' class="md:flex items-center justify-center h-9 px-8 rounded-md border hidden bg-gray-100">Hủy Tham gia </a>
                @else
                <a wire:click.prevent='enroll({{$course->course_id}})' class="md:flex items-center justify-center h-9 px-8 rounded-md border hidden bg-gray-100">Tham gia </a>
                @endif

            </div>

            {{-- <div class="absolute top-1 right-0 md:inline hidden"> --}}
                {{-- <a href="#" class="hover:bg-gray-200 p-1.5 inline-block rounded-full" aria-expanded="false">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                 </svg>
                </a>
                <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop uk-drop-bottom-right" uk-drop="mode: hover;pos: top-right" style="left: -188px; top: -12px;">

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

                </div> --}}
            {{-- </div> --}}

        </div>
    </div>

    @endforeach
</div>
