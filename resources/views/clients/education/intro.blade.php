@extends('layouts.clients')
@section('css')
@endsection
@section('content')
    <div class="main_content">
        <div class="mcontainer">

            <div class="lg:flex lg:space-x-10">

                <div class="lg:w-3/4 md:p-3 p-2">
                    <div>
                        <div class="space-y-3">
                            <h5 class="uppercase text-sm font-medium text-gray-400"> MÔ TẢ KHÓA HỌC </h5>
                            <h1 class="font-semibold text-3xl">{{ $course->course_name }}</h1>
                            @livewire('clients.education.intro', ['course' => $course])
                        </div>
                        <nav class="responsive-nav border-b md:mx-0 -mx-4 mt-4 text-4xl"
                            uk-sticky="offset:45; cls-active:bg-gray-50">
                            <ul class="space-x-3" uk-scrollspy-nav="closest: li; scroll: true">
                                <li><a href="#Overview" uk-scroll>TỔNG QUAN</a></liclass=>
                                <li><a href="#reviews">BÌNH LUẬN</a></li>
                            </ul>
                        </nav>

                        <div class="lg:mt-9 mt-5">
                            <div id="Overview">
                                <div class="space-y-5">
                                    <div>
                                        <h3 class="font-semibold mb-2 text-xl"> Mô tả </h3>
                                        <p class=""> {{ $course->description }} </p>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold mb-2 text-xl"> Bạn sẽ học được gì </h3>
                                        <ul class="grid md:grid-cols-2">
                                            @foreach (json_decode($course->learn_skill) as $skill)
                                                <li> <i class="uil-check text-xl font-bold mr-2"></i>{{ $skill }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-xl mb-2"> Yêu cầu </h3>
                                        <ul class="list-disc ml-5">
                                            @foreach (json_decode($course->required_skill) as $required)
                                                <li> {{ $required }}</li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>

                                <!-- course Curriculum -->
                                <h3 class="mb-8 mt-20 font-semibold text-xl" id="curriculum"> Chương trình giảng dạy </h3>

                                <ul class="uk-accordion space-y-3" uk-accordion>
                                    @foreach ($sections as $section)
                                        <li class="card hover:shadow-md px-6 py-4 rounded-md uk-open">
                                            <a class="uk-accordion-title font-semibold text-base">
                                                {{ $section->section_name }} </a>
                                            <div class="uk-accordion-content mt-3 -mx-6" aria-hidden="false">
                                                <ul class="course-curriculum-list font-semibold space-y-1">
                                                    @foreach ($section->material as $video)
                                                        <li class="hover:bg-gray-100 px-6 py-2.5 flex">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                fill="currentColor" class="w-6 mr-2">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg> <a
                                                                href="/courses/{{ $video->material_id }}/enroll">{{ $video->material_name }}</a>
                                                            @if ($video->review == 0)
                                                                <a href="#trailer-modal"
                                                                    class="bg-purple-100 border font-semibold ml-2 px-2 py-1 rounded-full text-purple-500 text-xs"
                                                                    uk-toggle> Xem trước </a>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                    @endforeach



                                </ul>

                                <!-- video demo model -->
                                <div id="trailer-modal" uk-modal="" class="uk-modal">
                                    <div class="uk-modal-dialog">
                                        <button class="uk-modal-close-default mt-2 mr-1 uk-icon uk-close" type="button"
                                            uk-close=""><svg width="14" height="14" viewBox="0 0 14 14"
                                                xmlns="http://www.w3.org/2000/svg" data-svg="close-icon">
                                                <line fill="none" stroke="#000" stroke-width="1.1" x1="1"
                                                    y1="1" x2="13" y2="13"></line>
                                                <line fill="none" stroke="#000" stroke-width="1.1" x1="13"
                                                    y1="1" x2="1" y2="13"></line>
                                            </svg></button>
                                        <div class="uk-modal-header">
                                            <h4> Trailer hóa học </h4>
                                        </div>

                                        <div class="embed-video rounded">
                                            <video id="videoElement" height="auto" class="m-auto" controls>
                                                <source src="{{ $review->material_url }}" type="video/mp4">
                                            </video>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- course description -->
                            <div id="reviews">
                                @livewire('clients.education.comments', ['course' => $course])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/4 w-full">

                    <div uk-sticky="offset:100; top:1 ; bottom: true">

                        <h2 class="text-lg font-semibold mb-3"> Khóa học liên quan </h2>
                        <ul>
                            @foreach ($related as $course)
                                <li>
                                    <a href="/courses/{{ $course->slug }}"
                                        class="hover:bg-gray-100 rounded-md p-2 -mx-2 block">
                                        <h3 class="font-medium line-clamp-2">{{ $course->course_name }}</h3>
                                        <div class="flex items-center my-auto text-xs space-x-1.5">
                                            <div> {{ $course->user_fullname }}</div>
                                            <div class="pb-1"> . </div>
                                            <i class="icon-feather-users mr-2"></i>
                                            <div>{{ $course->enroll }}</div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <br>

                    </div>


                </div>

            </div>


        </div>
    </div>
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('trailer-modal');
            var video = document.getElementById('videoElement');

            UIkit.util.on(modal, 'hidden', function() {
                video.pause(); // Pause the video when the modal is closed
            });
        });
    </script>
@endsection
