@extends('layouts.clients')
@section('css')

@endsection
@section('content')
<div class="main_content">
    <div class="mcontainer">

        <!--  Feeds  -->
        <div class="lg:flex lg:space-x-10">
            <div class="lg:w-3/4 lg:px-20 space-y-7">

                <!-- user story -->
                @livewire('clients.story.index')

                <!-- create post -->
                <div class="card lg:mx-0 p-4" uk-toggle="target: #create-post-modal">
                    <div class="flex space-x-3">
                        <img src="{{asset('clients/assets/images/avatars/avatar-2.jpg')}}" class="w-10 h-10 rounded-full">
                        <input placeholder="Đăng bài" class="bg-gray-100 hover:bg-gray-200 flex-1 h-10 px-6 rounded-full">
                    </div>
                    <div class="grid grid-flow-col pt-3 -mx-1 -mb-1 font-semibold text-sm">
                        <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer">
                            <svg class="bg-blue-100 h-9 mr-2 p-1.5 rounded-full text-blue-600 w-9 -my-0.5 hidden lg:block" data-tippy-placement="top" title="Tooltip" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Ảnh/Video
                        </div>
                        <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer">
                            <svg class="bg-green-100 h-9 mr-2 p-1.5 rounded-full text-green-600 w-9 -my-0.5 hidden lg:block" uk-tooltip="title: Messages ; pos: bottom ;offset:7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" title="" aria-expanded="false"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                            Bạn bè
                        </div>
                        <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer">
                            <svg class="bg-red-100 h-9 mr-2 p-1.5 rounded-full text-red-600 w-9 -my-0.5 hidden lg:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                             Trạng thái
                        </div>
                    </div>
                </div>

                @livewire('Clients.Posts.LoadPostController')



            </div>
            {{-- <div class="lg:w-72 w-full">

                <a href="#birthdays" uk-toggle>
                    <div class="bg-white mb-5 px-4 py-3 rounded-md shadow">
                        <h3 class="text-line-through font-semibold mb-1"> Birthdays </h3>
                        <div class="-mx-2 duration-300 flex hover:bg-gray-50 px-2 py-2 rounded-md">
                            <img src="{{asset('clients/assets/images/icons/gift-icon.png')}}" class="w-9 h-9 mr-3" alt="">
                            <p class="line-clamp-2 leading-6"> <strong> Jessica Erica </strong> and <strong> two others </strong>
                                have a birthdays to day .
                            </p>
                        </div>
                    </div>
                </a>

                <h3 class="text-xl font-semibold"> Contacts </h3>

                <div class="" uk-sticky="offset:80">

                    <nav class="responsive-nav border-b extanded mb-2 -mt-2">
                        <ul uk-switcher="connect: #group-details; animation: uk-animation-fade">
                            <li class="uk-active"><a class="active" href="#0">  Friends  <span> 310 </span> </a></li>
                            <li><a href="#0">Groups</a></li>
                        </ul>
                    </nav>

                    <div class="contact-list">




                    </div>


                </div>

            </div> --}}
            <div class="lg:w-72 w-full">

                @livewire('clients.home.birthday')


                <h3 class="text-xl font-semibold"> Liên hệ </h3>

                <div class="" uk-sticky="offset:80">
                    <nav class="responsive-nav border-b extanded mb-2 -mt-2 ">
                        <ul uk-switcher="connect: #group-details; animation: uk-animation-fade"
                            class="overflow-y-hidden">
                            <li class="uk-active"><a class="active" href="#0"> Bạn bè {{countFriend(auth()->user()->user_id)}} </a>
                            </li>
                        </ul>
                    </nav>

                    <div class="contact-list">
                        @livewire('clients.home.list-contact')
                    </div>


                </div>

            </div>
        </div>

    </div>
</div>

@endsection
@section('js')
    <script>
       document.addEventListener('livewire:initialized', () => {
        var loadNextMonth = document.getElementById('loadNextMonth');

        if (loadNextMonth) {
            loadNextMonth.addEventListener('click', function() {
                // Toggle the value of 'upcoming'
                Alpine.store('upcoming', !Alpine.store('upcoming'));

                // You can log the current value if needed
                console.log(Alpine.store('upcoming'));

                // Dispatch Livewire event only if 'upcoming' is true
                if (Alpine.store('upcoming')) {
                    console.log('a');
                    Livewire.dispatch('loadNextMonth_Birthday');
                }
            });
        }
    });
    </script>
@endsection
