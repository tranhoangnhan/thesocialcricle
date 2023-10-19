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
            <a href="#" class="flex items-center justify-center h-9 lg:px-5 px-2 rounded-md bg-blue-600 text-white space-x-1.5 absolute right-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="md:block hidden"> Create </span>
            </a> 
        </div>
       
        <div class="relative" uk-slider="finite: true">
            
            <div class="uk-slider-container px-1 py-3">
                <ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-3@s uk-child-width-1-2 uk-grid-small uk-grid">
                    <li>
                        <div>
                            <a href="course-intro.html" class="w-full md:h-36 h-28 overflow-hidden rounded-lg relative inline-block">
                                <img src="assets/images/courses/img-1.jpg" alt=""  class="w-full h-full absolute inset-0 object-cover">
                                <span  class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                                <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                            </a>
                            <div class="pt-3">
                                <a href="course-intro.html" class="font-semibold line-clamp-2">  Ultimate Web Designer And Developer Course to Expert </a>
                                <div class="pt-2">
                                    <a href="#" class="text-sm font-medium"> Adrian Mohani  </a>
                                    <div class="flex space-x-2 items-center text-sm">
                                        <div> Advance level</div>
                                        <div class="md:block hidden">·</div>
                                        <div> 156.9K Enrolled</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li> 
                        <div>
                            <a href="course-intro.html" class="w-full md:h-36 h-28 overflow-hidden rounded-lg relative inline-block">
                                <img src="assets/images/courses/img-2.jpg" alt="" class="w-full h-full absolute inset-0 object-cover">
                                <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs">  12:21</span>
                                <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                            </a>
                            <div class="pt-3">
                                <a href="course-intro.html" class="font-semibold line-clamp-2"> Java Programming Masterclass for Software Developers  </a>
                                <div class="pt-2">
                                    <a href="#" class="text-sm font-medium"> Anoundi hellows</a>
                                    <div class="flex space-x-2 items-center text-sm">
                                        <div> Binginner  level</div>
                                        <div class="md:block hidden">·</div>
                                        <div> 156.9K Enrolled</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li> 
                        <div>
                            <a href="course-intro.html" class="w-full md:h-36 h-28 overflow-hidden rounded-lg relative inline-block">
                                <img src="assets/images/courses/img-3.jpg" alt=""
                                    class="w-full h-full absolute inset-0 object-cover">
                                <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                                <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                            </a>
                            <div class="pt-3">
                                <a href="course-intro.html" class="font-semibold line-clamp-2">  Complete Cyber Security Guide For Beginners 2021 </a>
                                <div class="pt-2">
                                    <a href="#" class="text-sm font-medium"> Alia Dolgove </a>
                                    <div class="flex space-x-2 items-center text-sm">
                                        <div> Advance level </div>
                                        <div class="md:block hidden">·</div>
                                        <div> 156.9K Enrolled</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li> 
                        <div>
                            <a href="course-intro.html" class="w-full md:h-36 h-28 overflow-hidden rounded-lg relative inline-block">
                                <img src="assets/images/courses/img-4.jpg" alt=""
                                    class="w-full h-full absolute inset-0 object-cover">
                                <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs">  12:21</span>
                                <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                            </a>
                            <div class="pt-3">
                                <a href="course-intro.html" class="font-semibold line-clamp-2">The Python Mega Course Build 10 Real World Applications</a>
                                <div class="pt-2">
                                    <a href="#" class="text-sm font-medium"> Adrian Mohani </a>
                                    <div class="flex space-x-2 items-center text-sm">
                                        <div> Binginner  level </div>
                                        <div class="md:block hidden">·</div>
                                        <div> 156.9K Enrolled</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li> 
                        <div>
                            <a href="course-intro.html" class="w-full md:h-36 h-28 overflow-hidden rounded-lg relative inline-block">
                                <img src="assets/images/courses/img-5.jpg" alt=""
                                    class="w-full h-full absolute inset-0 object-cover">
                                <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs">  12:21</span>
                                <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                            </a>
                            <div class="pt-3">
                                <a  class="font-semibold line-clamp-2">How to Program Voxel Worlds Like Minecraft with C# in Unity</a>
                                <div class="pt-2">
                                    <a href="#" class="text-sm font-medium"> Anoundi hellows</a>
                                    <div class="flex space-x-2 items-center text-sm">
                                        <div> Advance level </div>
                                        <div class="md:block hidden">·</div>
                                        <div> 156.9K Enrolled</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
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
