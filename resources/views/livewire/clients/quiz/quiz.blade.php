<div>
{{--    <div class="wrapper overflow-hidden">--}}
{{--        <!-- Top content -->--}}
{{--        <div class="container-fluid mt-2">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-6">--}}
{{--                </div>--}}
{{--                <div class="col-sm-6 d-none d-sm-block">--}}
{{--                    <div class="count_box d-flex float-end pt-5 pe-5">--}}
{{--                        <div class="count_clock countdown_timer d-flex align-items-center pe-5 me-3">--}}
{{--                        </div>--}}
{{--                        <!-- <div id="countdown"></div> -->--}}
{{--                        <!-- Step Progress bar -->--}}
{{--                        <div class="count_progress clip-1">--}}
{{--                     <span class="progress-left">--}}
{{--                        <span class="progress_bar"></span>--}}
{{--                     </span>--}}
{{--                            <span class="progress-right">--}}
{{--                        <span class="progress_bar"></span>--}}
{{--                     </span>--}}
{{--                            <div class="progress-value">--}}
{{--                                <div id="value">100%</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="container">--}}
{{--            <form class="multisteps_form bg-white position-relative overflow-hidden" id="wizard" method="" action="" wire:submit="caculated">--}}
{{--                <!------------------------- Step-1 ----------------------------->--}}
{{--                    @foreach($question as $question)--}}
{{--                        <div class="multisteps_form_panel step">--}}
{{--                            <div class="question_title text-center text-uppercase">--}}
{{--                                <h1 class="animate__animated animate__fadeInRight animate_25ms">{{$question->question_content}}</h1>--}}
{{--                            </div>--}}
{{--                            <h1>{{json_encode($get_result)}}</h1>--}}
{{--                            <h1>{{json_encode($list_choice)}}</h1>--}}
{{--                            <div class="question_number text-center text-uppercase text-white">--}}
{{--                                <span class="rounded-pill">Câu hỏi {{$loop->iteration}} / {{$loop->count}}</span>--}}
{{--                            </div>--}}
{{--                            <div class="row pt-5 mt-4 form_items">--}}
{{--                                @foreach($question->answer as $answer)--}}
{{--                                    <div class="col-6">--}}
{{--                                        <input class="form-check-input" name="choice" wire:change.prevent="result({{$question->question_id}}, '{{$answer->awswer_id}}', '{{$answer->is_correct}}')" type="radio" value="{{$answer->is_correct}}">--}}
{{--                                        <p>{{$answer->awswer_content}}</p>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                <!---------- Form Button ---------->--}}
{{--                <div class="form_btn">--}}
{{--                    <button type="button" class="prev_btn position-absolute text-uppercase border-0" id="prevBtn" onclick="nextPrev(-1)"> <span><i class="fas fa-arrow-left"></i></span> Back</button>--}}
{{--                    <button wire:click.prevent="result" type="button" class="next_btn rounded-pill position-absolute text-uppercase text-white" id="nextBtn" onclick="nextPrev(1)">Next</button>--}}
{{--                    <input type="submit" wire:submit="caculated">--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}



    <div class="wrapper">
        <!-- Top content -->
        <div class="container-fluid p-0">
            <div class="logo_area">
                <a href="index.html">
                    <img src="{{asset('clients/assets-quiz/images/logo/logo.png')}}" alt="image_not_found">
                </a>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <form class="form" id="wizard" method="" action="">
                    <!------------------------- Step-1 ----------------------------->
                    @foreach($question as $question)
                        <div class="multisteps_form_panel step">
                            <div class="col-md-6 m-auto">
                                <div class="content_box py-5 ps-5 position-relative">
                                    <!-- Step-progress-bar -->
                                    <div class="step_progress_bar mb-3">
                                        <div class="progress rounded-pill">
                                            <span><i class="far fa-clock"></i></span>
                                            <div class="progress-bar mx-2 rounded-pill" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="question_number text-capitalize">
                                        <span class="text-white">Câu hỏi {{$loop->iteration}} / {{$loop->count}}</span>
                                        <p class="pt-3">------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
                                    </div>
                                    <div class="question_title py-3">
                                        <h1 class="text-white">{{$question->question_content}}</h1>
                                    </div>
                                    <div class="form_items">
                                        <h1>{{json_encode($get_result)}}</h1>
                                        @foreach($question->answer as $answer)
                                            <label for="opt_1" class="step_1 animate__animated animate__fadeInRight animate_25ms position-relative rounded-pill text-start text-white">
                                                {{$answer->awswer_content}}
                                            </label>
                                            <input id="opt_1" type="radio" name="choice" wire:change.prevent="result({{$question->question_id}}, '{{$answer->awswer_id}}', '{{$answer->is_correct}}')" value="{{$answer->is_correct}}">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!------------------------- Form button ----------------------------->
                    <div class="form_btn">
                        <button type="button" class="f_btn rounded-pill prev_btn text-uppercase text-white position-absolute" id="prevBtn" onclick="nextPrev(-1)"> Last Question</button>
                        <button wire:submit.prevent="caculated" type="button" class="f_btn rounded-pill next_btn text-uppercase text-white position-absolute" id="nextBtn"
                                onclick="nextPrev(1)">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
