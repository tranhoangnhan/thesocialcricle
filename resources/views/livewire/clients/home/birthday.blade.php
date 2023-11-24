<div x-data="{ isModalOpen: false, upcoming: false }">

    @if ($check)
        <a href="#birthdays" x-on:click="isModalOpen = !isModalOpen">
            <div class="bg-white mb-5 px-4 py-3 rounded-md shadow">
                <h3 class="text-line-through font-semibold mb-1"> Sinh nhật </h3>
                <div class="-mx-2 duration-300 flex hover:bg-gray-50 px-2 py-2 rounded-md">
                    {!! getAvatar($users[$defaultMonth]->first()->user_id, null, 'width: 80px; height: 40px; margin-right: 5px;') !!}
                    {!! birthday($users[$defaultMonth]) !!}
                </div>
            </div>
        </a>
        <!-- birthdays modal -->
        <div id="birthdays" x-show="isModalOpen" x-cloak x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 overflow-y-auto" style="z-index:9999">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true" x-show="isModalOpen" x-cloak
                    x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-300"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    <div class="absolute inset-0 bg-gray-500 opacity-75" style="z-index:9999"></div>
                </div>


                <!-- Modal content -->
                <div x-show="isModalOpen" x-cloak x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 transform translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 transform translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <!-- Modal content goes here -->
                    <div class="p-6">
                        <!-- Your modal content -->
                        <div class="flex items-center space-x-3 mb-10">
                            <ion-icon name="gift"
                                class="text-yellow-500 text-xl bg-yellow-50 p-1 rounded-md" wire:ignore></ion-icon>
                            <div class="text-xl font-semibold"> Sinh nhật - {{ $defaultMonth }}</div>
                            <!-- Close button -->
                            <button x-on:click="isModalOpen = false"
                                class="absolute top-0 right-0 m-4 text-gray-500 hover:text-gray-700">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>

                        <div class="space-y-6">
                            <div class="sm:space-y-8 space-y-6 pb-2">
                                @foreach ($users[$defaultMonth] as $row)
                                    <div class="flex items-center sm:space-x-6 space-x-3">
                                        {!! getAvatar(
                                            $row->user_id,
                                            null,
                                            'font-family: Arial, Helvetica, sans-serif; border-radius: 50%; background: #2a64e2f5;
                                                                                                                                 font-size: 25px; color: #fff; text-align: center; display: flex; justify-content: center;
                                                                                                                                 align-items: center;',
                                            'sm:w-16 sm:h-16 w-14 h-14 rounded-full',
                                        ) !!}
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-3">
                                                <div class="text-base font-semibold">
                                                    <a href="{{ route('profile', ['id' => $row->user_username]) }}">
                                                        {!! getName($row->user_id) !!}
                                                    </a>
                                                </div>
                                                <div class="font-medium text-sm text-gray-400">
                                                    {{ Carbon::parse($row->user_birthday)->format('d-m-Y') }}
                                                    - {{ Carbon::parse($row->user_birthday)->age }} tuổi
                                                </div>
                                            </div>
                                            <div class="relative">
                                                <input type="text" name="" id="" class="with-border"
                                                    placeholder="Gửi lời chúc sinh nhật">
                                                <i
                                                    class="fa-light fa-paper-plane-top absolute right-3 text-2xl top-1/4"></i>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="relative cursor-pointer" x-on:click="upcoming = !upcoming" id="loadNextMonth">
                                <div class="bg-gray-50 rounded-lg px-5 py-4 font-semibold text-base">Tháng sau </div>
                                <i x-show="!upcoming"
                                    class="-translate-y-1/2 absolute icon-feather-chevron-up right-4 text-xl top-1/2 transform text-gray-400"></i>
                                <i x-show="upcoming"
                                    class="-translate-y-1/2 absolute icon-feather-chevron-down right-4 text-xl top-1/2 transform text-gray-400"></i>
                            </div>

                            <div class="mt-2 sm:space-y-8 space-y-6" x-show="upcoming" x-cloak>
                                <h6>Bạn bè sinh nhật tháng {{$currentMonth}}</h6>
                                @if (isset($users[$currentMonth]))
                                    @foreach ($users[$currentMonth] as $row)
                                        <div class="flex items-center sm:space-x-6 space-x-3">
                                            {!! getAvatar(
                                                $row->user_id,
                                                null,
                                                'font-family: Arial, Helvetica, sans-serif; border-radius: 50%; background: #2a64e2f5;
                                                                                                                                         font-size: 25px; color: #fff; text-align: center; display: flex; justify-content: center;
                                                                                                                                         align-items: center;',
                                                'sm:w-16 sm:h-16 w-14 h-14 rounded-full',
                                            ) !!}
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between mb-3">
                                                    <div class="text-base font-semibold">
                                                        <a href="{{ route('profile', ['id' => $row->user_username]) }}">
                                                            {!! getName($row->user_id) !!}
                                                        </a>
                                                    </div>
                                                    <div class="font-medium text-sm text-gray-400">
                                                        {{ Carbon::parse($row->user_birthday)->format('d-m-Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                <div class="flex items-center justify-content-center sm:space-x-6 space-x-3">
                                    <p class="text-center">Không có bạn bè sinh nhật tháng này!</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    @endif
</div>
