<div>

    <div class="main_content">
        <div class="mcontainer">

            <div class="lg:flex lg:space-x-10">

                <div class="lg:w-3/4">

                    <div class="embed-video rounded">
                        <iframe width="1280" height="720" src="{{$videos->material_url}}" allowfullscreen></iframe>
                      
                    </div>

                    <div class="py-5 space-y-4">

                        <div>
                            <h1 class="text-2xl font-semibold line-clamp-1"> {{$videos->material_name}} </h1>

                        </div>
                       
                        <div class="md:flex items-center justify-between">
                            <a href="#" class="flex items-center space-x-3">
                                <img src="assets/images/avatars/avatar-2.jpg" alt="" class="w-10 rounded-full">
                                <div class="">
                                    <div class="text-base font-semibold"> {{$this->course->course_name}} </div>
                                    <div class="text-xs"> {{$videos->created_at}} </div>
                                </div>
                            </a>
                            <div class="flex items-center md:pt-0 p-2 mt-3">
                                <p> {{$videos->view}} </p>
                            </div>
                        </div>
                 
                        <hr>
                        <div class="text-lg font-semibold pt-2"> Comments ( 5210 )</div>


                        <div class="my-5">

                            <div class="flex gap-x-4 mb-5 relative">
                                <img src="assets/images/avatars/avatar-4.jpg" alt="" class="rounded-full shadow w-12 h-12">
                                <div>
                                    <h4 class="text-base m-0 font-semibold"> Stella Johnson</h4>
                                    <span class="text-gray-700 text-sm"> 10th June 2021 </span>
                                    <p class="mt-3">
                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam ut laoreet dolore
                                        magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                        ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                                    </p>



                                </div>
                            </div>

                            <div class="flex gap-x-4 mb-5 relative">
                                <img src="assets/images/avatars/avatar-5.jpg" alt="" class="rounded-full shadow w-12 h-12">
                                <div>
                                    <h4 class="text-base m-0 font-semibold">  Adrian Mohani  </h4>
                                    <span class="text-gray-700 text-sm"> 10th April 2021 </span>
                                    <p class="mt-3">
                                         elit, sed diam ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim ipsum dolor sit amet, consectetuer adipiscing elit, sed diam ut laoreet dolore
                                       </p>



                                </div>
                            </div>


                        </div>

                    </div>


                </div>

                <!-- sidebar -->
                <div class="lg:w-1/4 w-full">

                   <h3 class="mb-8 mt-20 font-semibold text-xl" id="curriculum"> Chương trình giảng dạy {{$this->course->course_name}} </h3>
                   <ul class="uk-accordion space-y-3" uk-accordion>
                   @foreach ($sections as $section)
                   <li class="card hover:shadow-md px-6 py-4 rounded-md uk-open">
                    <a class="uk-accordion-title font-semibold text-base" href="#"> {{$section->section_name}} </a>
           

<div class="uk-accordion-content mt-3 -mx-6" aria-hidden="false">
<ul class="course-curriculum-list font-semibold space-y-1">
    @foreach ($sectionVideos[$section->section_id] as $video)
    @if($this->slug_video == $video->slug)
    <a wire:navigate href="/courses/{{$this->course->slug}}/enroll/{{$video->slug}}" class="text-dark" >
    <li class="hover:bg-gray-100 px-3 py-2.5 flex" style="background-color: rgb(161, 158, 158, 0.3);" >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 mr-2">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
            </svg> {{$video->material_name}}


        </li></a>
    @else
    <a wire:navigate href="/courses/{{$this->course->slug}}/enroll/{{$video->slug}}" class="text-dark" >
        <li class="hover:bg-gray-100 px-3 py-2.5 flex">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 mr-2">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                </svg> {{$video->material_name}}
    
    
            </li></a>
    @endif
    @endforeach
</ul>
</div>
</li>
@endforeach



                   


                </div>

            </div>


        </div>
    </div>
    
</div>
