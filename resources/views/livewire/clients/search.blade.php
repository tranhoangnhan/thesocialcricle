<div>

    <div class="header-search-icon" uk-toggle="target: #wrapper ; cls: show-searchbox"> </div>
    <div class="header_search"><i class="uil-search-alt"></i>
        <form action="{{ url('search') }}" method="post" style="position: relative">
            @csrf
            <input wire:model.live="search" name="query" value="" type="text" class="form-control "
                placeholder="Tìm kiếm bạn bè, video, và nhiều hơn nữa,..." autocomplete="off">
        </form>
        <ul style="position: absolute">
            @if ($search == null)
                <li></li>
            @else
            <div class="mt-3">
                @if (sizeof($friend) > 0)
                <li class="p-3" style="width: 30rem; background-color:  #fff">
                    @foreach ($friend as $friend)
                        <a wire:navigate href="/profile/{{ $friend->user_id }}">
                            <div class="list-name p-3"> {{ $friend->user_fullname }} </div>
                        </a>
                    @endforeach
                </li>
            @endif
            @if (sizeof($post) > 0)
                <li class="p-2" style="width: 30rem; background-color:  #fff">
                    @foreach ($post as $post)
                        <a href="#">
                            <div class="list-name p-3"> {{ $post->text }} </div>
                        </a>
                    @endforeach
                </li>
            @endif
            @if (sizeof($course) > 0)
            <li class="p-2" style="width: 30rem; background-color:  #fff">
                @foreach ($course as $course)
                    <a href="/courses/{{$course->slug}}">
                        <div class="list-name p-3"> {{ $course->course_name }} </div>
                    </a>
                @endforeach
            </li>
        @endif
            </div>

            @endif
        </ul>
    </div>
</div>
