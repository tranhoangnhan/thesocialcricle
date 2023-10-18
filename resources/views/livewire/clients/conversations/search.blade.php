<div>
    <!-- livewire/clients/conversations/search.blade.php -->

    <div>
        <div class="relative z-0 flex flex-wrap">
            <div class="flex items-center flex-wrap">
                @foreach ($tags as $tag)
                    <div class="mx-1 my-1 bg-blue-500 text-white px-3 py-1  rounded-full inline-flex items-center">
                        <span class="">{{ $tag['friendFullName'] }}
                            <button wire:click="removeTag('{{ encrypt($tag['friendId']) }}')"
                                class="ml-1 text-xs font-bold">X</button>
                        </span>
                    </div>
                @endforeach
                <div class="flex ml-2">
                    <input type="text" id="floating_standard"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        wire:model.live.debounce.500ms="search" wire:keydown.escape="$set('showdiv', false)"
                        wire:keydown.tab="$set('showdiv', true)" wire:keydown.arrow-down="incrementHighlight"
                        wire:keydown.arrow-up="decrementHighlight" wire:keydown.enter="selectResult"
                        wire:keydown.enter="resetSearch" autocomplete="no" value="" placeholder="Đến " />

                </div>
            </div>
        </div>


        @if ($showdiv && !empty($search))
            <div
                class="user-container absolute mt-3 flex flex-col dark:bg-white-800 bg-gray-100 rounded-lg max-h-60 w-100 overflow-y-auto p-2 z-10">
                @if ($data->isNotEmpty())
                    @foreach ($data as $friend)
                        @php
                            $friendId = auth()->user()->user_id == $friend->user_one_id ? $friend->userTwo->user_id : $friend->userOne->user_id;
                            $friendFullName = $this->getFriendFullName($friendId);
                        @endphp
                        <div wire:click.prevent="add('{{ $friendId }}')"
                            class="flex items-center p-2 {{ in_array($friendFullName, array_column($tags, 'friendFullName')) ? 'bg-green-500 text-white' : 'hover:bg-blue-100 focus:outline-none' }}">
                                {!! getAvatar($friendId) !!}
                            <div class="ml-4">
                                @if (auth()->user()->user_id == $friend->user_one_id)
                                    <p class="text-lg text-gray-600">{!! getName($friend->userTwo->user_id) !!}</p>
                                @elseif (auth()->user()->user_id == $friend->user_two_id)
                                    <p class="text-lg text-gray-600">{!! getName($friend->userOne->user_id) !!}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="flex items-center justify-content-center text-gray-600">Không tìm thấy kết quả!</p>
                @endif
            </div>
        @endif

    </div>


</div>
