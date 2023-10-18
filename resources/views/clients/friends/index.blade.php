@extends('layouts.clients')
@section('css')

@endsection
@section('content')
<div class="main_content">
    <div class="mcontainer">


        <div class="flex justify-between relative md:mb-4 mb-3">
            <div class="flex-1">
                <h2 class="text-2xl font-semibold"> Bạn bè </h2>
                <nav class="responsive-nav border-b md:m-0 -mx-4">
                    <ul>
                        <li class="active"><a href="#" class="lg:px-2">   Lời mời kết bạn </a></li>
                        <li><a href="#" class="lg:px-2"> Bạn bè </a></li>
                        <li><a href="#" class="lg:px-2"> My group </a></li>
                    </ul>
                </nav>
            </div>
            <a href="create-group.html" class="flex items-center justify-center h-9 lg:px-5 px-2 rounded-md bg-blue-600 text-white space-x-1.5 absolute right-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="md:block hidden"> Create </span>
            </a>
        </div>

        <div class="relative" uk-slider="finite: true">

            

                   @livewire('Clients.Friends.show-add-friends')
                   

                </ul>

               
        </div>

      

        <br>

  



    </div>
</div>
@endsection
@section('js')

@endsection
