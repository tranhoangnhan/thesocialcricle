@extends('layouts.clients')
@section('customcss')
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" /> --}}
    <style>
        .input-container {
            flex-grow: 1;
            flex-basis: 50%;
            /* Đảm bảo 2 flex containers cùng hàng */
        }
    </style>
    
@endsection
@section('content')
    <div class="main_content">
        <div class="messages-container" x-data="{ showFind: false }">
            <div class="messages-container-inner">
                <div class="messages-inbox">
                    <div class="messages-headline">
                        <div class="input-with-icon" hidden>
                            <input id="autocomplete-input" type="text" placeholder="Search">
                            <i class="icon-material-outline-search"></i>
                        </div>
                        <h2 class="text-2xl font-semibold">Nhắn tin</h2>
                        @if (!$show)
                            <span @click="showFind = !showFind"
                                class="absolute icon-feather-edit mr-4 text-xl uk-position-center-right cursor-pointer"></span>
                        @endif
                    </div>
                    <div class="messages-inbox-inner" data-simplebar>
                        <ul>
                            <template x-if="showFind">
                                <livewire:clients.conversations.index>
                            </template>
                            <livewire:clients.conversations.listchat>
                        </ul>
                    </div>
                </div>


                <div class="message-content">

                    @if ($show)
                        <div>
                            <livewire:clients.conversations.chat :id="$id" />
                        </div>
                    @else
                        <div>
                            <template x-if="showFind">
                                <div class="messages-headline" style="max-height: none">

                                    <div class="wrapper relative">
                                        <livewire:clients.conversations.search>
                                    </div>

                                    {{-- <template x-if="!showFind">
                                <h4> Stella Johnson </h4>
                                <a href="#" class="message-action text-red-500"><i class="icon-feather-trash-2"></i>
                                    <span class="md:inline hidden"> Delete Conversation</span> </a>
                            </template> --}}
                                </div>
                            </template>
                            <template x-if="showFind">
                                <div class="message-content-scrolbar" data-simplebar>
                                    <livewire:clients.conversations.chat>
                                </div>
                            </template>
                        </div>
                    @endif

                    @if (!$show)
                        <template x-if="!showFind">
                            <div class="flex justify-center items-center h-screen">
                                <p class="text-center">Hãy chọn một đoạn chat hoặc bắt đầu cuộc trò chuyện mới</p>
                            </div>
                        </template>
                    @endif

                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script>

    <script></script>
@endsection
