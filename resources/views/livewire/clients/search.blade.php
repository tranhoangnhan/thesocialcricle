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
                @if (sizeof($friend) > 0)
                    <li class="p-3 mt-2" style="width: 30rem; background-color:  #fff">
                        @foreach ($friend as $friend)
                            <a wire:navigate href="/profile/{{ $friend->user_id }}">
                                <div class="list-name"> {{ $friend->user_fullname }} </div>
                            </a>
                        @endforeach
                    </li>
                @endif
                @if (sizeof($post) > 0)
                    <li class="p-2 mt-2" style="width: 30rem; background-color:  #fff">
                        @foreach ($post as $post)
                            <a href="#">
                                <div class="list-name"> {{ $post->text }} </div>
                            </a>
                        @endforeach
                    </li>
                @endif
            @endif
        </ul>
    </div>
</div>
