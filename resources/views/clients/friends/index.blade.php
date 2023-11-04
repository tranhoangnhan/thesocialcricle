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
