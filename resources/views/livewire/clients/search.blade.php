<div>

    <div class="header-search-icon" uk-toggle="target: #wrapper ; cls: show-searchbox"> </div>
    <div class="header_search"><i class="uil-search-alt"></i>
        <form action="{{url('search')}}" method="post">
            @csrf
            <input wire:model.live="search" name="query" value="" type="text" class="form-control"
                   placeholder="Tìm kiếm bạn bè, video, và nhiều hơn nữa,..." autocomplete="off">
        </form>
        <div uk-drop="mode: click" class="header_search_dropdown">
            <ul>
                @if ($search == "")
                    <li>
                        <a href="#">
                            <div class="list-name"> Nhập từ khoá để tìm kiếm </div>
                        </a>
                    </li>
                @else
                    @if($post->isEmpty()||$friend->isEmpty())
                        <li>
                            <a href="#">
                                <div class="list-name"> Không tìm thấy kết quả </div>
                            </a>
                        </li>
                    @else
                        @if(sizeof($friend) > 0)
                            @foreach($friend as $friend)
                                <li  wire:ignore>
                                    <a href="#">
                                        <div class="list-name"> {{$friend->user_fullname}} </div>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                        @if(sizeof($post) > 0)
                            @foreach($post as $post)
                                <li  wire:ignore>
                                    <a href="#">
                                        <div class="list-name"> {{$post->text}} </div>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    @endif
                @endif
            </ul>
        </div>
    </div>
</div>
