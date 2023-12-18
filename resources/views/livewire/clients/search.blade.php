<div>
    <div class="header-search-icon" uk-toggle="target: #wrapper ; cls: show-searchbox"> </div>
    <div style=" width: 600px" class="header_search"><i class="uil-search-alt"></i>
        <form action="{{ url('search') }}" method="post" style="position: relative">
            @csrf
            <input wire:model.live="search" name="query" value="" type="text" class="form-control "
                   placeholder="Tìm kiếm bài viết, bạn bè, và nhiều hơn nữa,..." autocomplete="off" required>
        </form>
        <ul class="list-group list-group-flush" style="position: absolute">
            @if ($search == null)
                <li></li>
            @else
            <div class="mt-3">
                @if (sizeof($friend) > 0)
                    <li class="list-group-item" style="width: 30rem; background-color:  #fff">
                        <label for="">Bạn bè</label>
                        @foreach ($friend as $friend)
                            <a href="{{route('profile',['id' => $friend->user_id])}}">
                            <div class="card" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-2 mt-2 ml-2">
                                        {!! getAvatar($friend->user_id) !!}
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <p class="card-text">{{$friend->user_fullname}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        @endforeach
                    </li>
            @endif
            @if (sizeof($post) > 0)
                        <li class="list-group-item" style="width: 30rem; background-color:  #fff">
                            <label for="">Bài viết</label>
                            @foreach ($post as $post)
                                <div class="card" style="max-width: 540px;">
                                    <div class="row g-0">
                                        <div class="col-md-2 mt-3 ml-2">
                                            <i class="fas fa-search fa-flip-horizontal fa-lg"></i>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <p class="card-text">{{$post->text}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </li>
            @endif
            @if (sizeof($course) > 0)
                            <li class="list-group-item" style="width: 30rem; background-color:  #fff">
                                <label for="">Khoá học</label>
                                @foreach ($course as $course)
                                    <a href="/courses/{{$course->slug}}">
                                    <div class="card" style="max-width: 540px;">
                                        <div class="row g-0">
                                            <div class="col-md-2 mt-2 ml-2">
                                                <img src="{{$course->banner}}" class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <p class="card-text">{{$course->course_name}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                @endforeach
                            </li>
        @endif
            </div>

            @endif
        </ul>
    </div>
</div>
