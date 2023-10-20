@extends('layouts.clients')
@section('css')

@endsection
@section('content')
<div class="main_content">
    <div class="mcontainer">

        <div class="flex justify-between relative md:mb-4 mb-3">
            <div class="flex-1">
                <h2 class="text-2xl font-semibold"> Bạn có thể quan tâm</h2>
                
            </div>
           
        </div>
       
        <div class="relative" uk-slider="finite: true">
            
            <div class="uk-slider-container px-1 py-3">
                <ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-3@s uk-child-width-1-2 uk-grid-small uk-grid">
                    @foreach ($courses as $course)
                    <li>
                        <div>
                            <a href="course-intro.html" class="w-full md:h-36 h-28 overflow-hidden rounded-lg relative inline-block">
                                <img src=" {{$course->banner}}" alt=""  class="w-full h-full absolute inset-0 object-cover">
                                <span  class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                                <img src="{{asset('clients/assets/images/icon-play.svg')}}" class="w-12 h-12 uk-position-center" alt="">
                            </a>
                            <div class="pt-3">
                                <a href="course-intro.html" class="font-semibold line-clamp-2">  {{$course->course_name}} </a>
                                <div class="pt-2">
                                    <a href="#" class="text-sm font-medium">  {{$course->instructor_id}} </a>
                                    <div class="flex space-x-2 items-center text-sm">
                                        
                                        <div class="md:block hidden">·</div>
                                        <div> 156.9K Đã đămg ký</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                   
               
                </ul>

                <a class="absolute bg-white top-16 flex items-center justify-center p-2 -left-4 rounded-full shadow-md text-xl w-9 z-10 dark:bg-gray-800 dark:text-white" href="#" uk-slider-item="previous"> <i class="icon-feather-chevron-left"></i></a>
                <a class="absolute bg-white top-16 flex items-center justify-center p-2 -right-4 rounded-full shadow-md text-xl w-9 z-10 dark:bg-gray-800 dark:text-white" href="#" uk-slider-item="next"> <i class="icon-feather-chevron-right"></i></a>

            </div>
        </div>

        <br> 

        <div class="md:mb-4 mb-3">
            <h2 class="text-2xl font-semibold"> Khóa học của bạn </h2>
            <nav class="responsive-nav border-b md:m-0 -mx-4">
                <ul>
                    <li class="active"><a href="#" class="lg:px-2">   Gợi ý </a></li>
                    <li><a href="#" class="lg:px-2"> Mới nhất </a></li>
                    <li><a href="#" class="lg:px-2"> Lộ trình của bạn </a></li>
                </ul>
            </nav>
        </div>

        <!--  videos  -->

        <div class="divide-y card px-4">
           @livewire('clients.education.index')
        </div> 


    </div>
</div>
@endsection
@section('js')

@endsection
