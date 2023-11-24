<div>
    <div class="flex justify-between items-start relative md:mb-4 mb-3">
        <div class="flex-1">
            <h2 class="text-xl font-bold"> Hình ảnh </h2>
            <nav class="responsive-nav style-2 md:m-0 -mx-4">
                <ul uk-switcher="connect: #albumList;animation: uk-animation-fade; toggle: > *" wire:ignore
                    class=" overflow-y-hidden">
                    <li {!! $selectTabAlbum == 'all' ? 'class="uk-active cursor-point" aria-expanded="true"' : 'class="cursor-point"' !!} wire:ignore>
                        <a wire:click="selectTab('all')"> Tất cả</span>
                        </a>
                    </li>
                    <li {!! $selectTabAlbum == 'recent' ? 'class="uk-active cursor-point" aria-expanded="true"' : 'class="cursor-point"' !!} wire:ignore><a wire:click="selectTab('recent')"> Gần đây </a></li>
                </ul>
            </nav>
        </div>
    </div>

    <ul class="uk-switcher" id="albumList">
        <li {!! $selectTabAlbum == 'all' ? 'class="uk-active cursor-point"' : 'class="cursor-point"' !!}>
            @if (isset($albums))
                <div class="grid md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-3 mt-5">
                    @if (isset($albums))
                        @php $albumAll = json_decode($albums,true) @endphp
                        @foreach ($albumAll['data'] as $row)
                            <div>
                                <div
                                    class="bg-green-400 max-w-full lg:h-44 h-36 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                                    <img src="{{ $row['source'] }}" data-fancybox="album"
                                        class="lazyload w-full h-full absolute object-cover inset-0">
                                    <!-- overly-->
                                    <div
                                        class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            @endif
            @if ($totalAlbum > $perPage[$selectTabAlbum])
                <div class="flex justify-center mt-6">
                    <a wire:click='loadMoreAlbumList'
                        class="cursor-pointer bg-white font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                        Xem thêm ..</a>
                </div>
            @endif
        </li>
        <li {!! $selectTabAlbum == 'recent' ? 'class="uk-active cursor-point"' : 'class="cursor-point"' !!}>
            @if (isset($albums))
                <div class="grid md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-3 mt-5">
                    @if (isset($albums))
                        @php $albumAll = json_decode($albums,true) @endphp
                        @foreach ($albumAll['data'] as $row)
                            <div>
                                <div
                                    class="bg-green-400 max-w-full lg:h-44 h-36 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                                    <img src="{{ $row['source'] }}" data-fancybox="album_recent"
                                        class="lazyload w-full h-full absolute object-cover inset-0">
                                    <!-- overly-->
                                    <div
                                        class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            @endif
            @if ($totalAlbum > $perPage[$selectTabAlbum])
                <div class="flex justify-center mt-6">
                    <a wire:click='loadMoreAlbumList'
                        class="cursor-pointer bg-white font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                        Xem thêm ..</a>
                </div>
            @endif
        </li>
    </ul>




</div>
