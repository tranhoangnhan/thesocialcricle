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
                                    <div class="text-base font-semibold"> {{$videos->course_name}} </div>
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

                   <h3 class="text-xl font-bold mb-2">Video liên quan</h3>
                   @foreach ($related as $video)
                   <div class="py-2 relative">
                       <a href="video-watch.html" class="w-full h-32 overflow-hidden rounded-lg relative shadow-sm flex-shrink-0 block">
                        <iframe src="{{$video->material_url}}" frameborder="0"
                            uk-video="automute: true" uk-responsive></iframe>
                       </a>
                       <div class="flex-1 pt-3 relative">
                           <a href="video-watch.html" class="line-clamp-2 font-semibold"> {{$video->metarial_name}}  </a>
                           <div class="flex space-x-2 items-center text-sm pt-1">
                               <div> {{$video->created_at}}</div>
                               <div>·</div>
                               <div> {{$video->view}} lượt xem</div>
                           </div>
                       </div>
                    </div>
                   @endforeach


                </div>

            </div>


        </div>
    </div>
</div>
