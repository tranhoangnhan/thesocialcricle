{{--<div>--}}
{{--    <div class="wrapper">--}}
{{--        <!-- Top content -->--}}
{{--        <div class="container-fluid p-0">--}}
{{--            <div class="logo_area">--}}
{{--                <a href="index.html">--}}
{{--                    <img src="{{asset('clients/assets-quiz/images/logo/logo.png')}}" alt="image_not_found">--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <form class="form" id="wizard" method="" action="">--}}
{{--                    <!------------------------- Step-1 ----------------------------->--}}
{{--                    @foreach($question as $question)--}}
{{--                        <div class="multisteps_form_panel step">--}}
{{--                            <div class="col-md-6 m-auto">--}}
{{--                                <div class="content_box py-5 ps-5 position-relative">--}}
{{--                                    <!-- Step-progress-bar -->--}}
{{--                                    <div class="step_progress_bar mb-3">--}}
{{--                                        <div class="progress rounded-pill">--}}
{{--                                            <span><i class="far fa-clock"></i></span>--}}
{{--                                            <div class="progress-bar mx-2 rounded-pill" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="question_number text-capitalize">--}}
{{--                                        <span class="text-white">Câu hỏi {{$loop->iteration}} / {{$loop->count}}</span>--}}
{{--                                        <p class="pt-3">------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="question_title py-3">--}}
{{--                                        <h1 class="text-white">{{$question->question_content}}</h1>--}}
{{--                                    </div>--}}
{{--                                    <div class="form_items">--}}
{{--                                        <h1>{{json_encode($get_result)}}</h1>--}}
{{--                                        @foreach($question->answer as $answer)--}}
{{--                                            <label for="opt_1" class="step_1 animate__animated animate__fadeInRight animate_25ms position-relative rounded-pill text-start text-white">--}}
{{--                                                {{$answer->awswer_content}}--}}
{{--                                            </label>--}}
{{--                                            <input id="opt_1" type="radio" name="choice" wire:change.prevent="result({{$question->question_id}}, '{{$answer->awswer_id}}', '{{$answer->is_correct}}')" value="{{$answer->is_correct}}">--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                    <!------------------------- Form button ----------------------------->--}}
{{--                    <div class="form_btn">--}}
{{--                        <button type="button" class="f_btn rounded-pill prev_btn text-uppercase text-white position-absolute" id="prevBtn" onclick="nextPrev(-1)"> Last Question</button>--}}
{{--                        <button wire:submit.prevent="caculated" type="button" class="f_btn rounded-pill next_btn text-uppercase text-white position-absolute" id="nextBtn"--}}
{{--                                onclick="nextPrev(1)">Next</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Quiz: {{$quiz_name->quiz_name}}</h4>
                        <div class="question_number text-center text-uppercase text-white">
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" wire:submit="caculated">
                            @foreach($question as $question)
                                <div class="multisteps_form_panel step">
                                        <h4 class="">Câu hỏi {{$loop->iteration}}: {{$question->question_content}}</h4>
                                    <div class="row form_items">
                                        @foreach($question->answer as $answer)
                                            <div class="col-6">
                                                <input required style="float: left" class="form-check-input mr-2" name="choice{{$question->question_id}}" wire:change.prevent="result({{$question->question_id}}, '{{$answer->awswer_id}}', '{{$answer->is_correct}}')" type="radio"   value="{{$answer->is_correct}}">
                                                <h6>{{$answer->awswer_content}}</h6>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <!-- end row -->
                                <br>
                                @if(count(array($question)) >= 10)
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="?page=1">1</a></li>
                                            <li class="page-item"><a class="page-link" href="?page=2">2</a></li>
                                            <li class="page-item"><a class="page-link" href="?page=3">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                @endif
                                <div style="float: right" class="form_btn">
                                    <button type="submit" class="btn btn-primary">Nộp bài</button>
                                </div>
                        </form>
                        <!-- end form -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
    </div>
</div>
