
<div>
        <div class="row">
            {{--        pop-up-add--}}
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tạo câu hỏi</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit="storeQuestion">
                                @csrf
                                {{--            Câu hỏi--}}
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Câu hỏi:</label>
                                    <input wire:model="question_content" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nhập câu hỏi">
                                </div>
                                <br>
                                {{--            //Câu trả lời--}}
                                <div class="form-group ml-5">
                                    <input style="width: 13px; height: 13px" type="checkbox" wire:model="is_correct1" value="1">
                                    <label for="exampleFormControlTextarea1">A:</label>
                                    <textarea wire:model="awswer_content1" class="form-control" placeholder="Nhập câu trả lời" id="exampleFormControlTextarea1" rows="1"></textarea>
                                </div>
                                <div class="form-group ml-5">
                                    <input style="width: 13px; height: 13px" type="checkbox" wire:model="is_correct2" value="1">
                                    <label for="exampleFormControlTextarea1">B:</label>
                                    <textarea wire:model="awswer_content2" class="form-control" placeholder="Nhập câu trả lời" id="exampleFormControlTextarea1" rows="1"></textarea>
                                </div>
                                <div class="form-group ml-5">
                                    <input style="width: 13px; height: 13px" type="checkbox" wire:model="is_correct3" value="1">
                                    <label for="exampleFormControlTextarea1">C:</label>
                                    <textarea wire:model="awswer_content3" class="form-control" placeholder="Nhập câu trả lời" id="exampleFormControlTextarea1" rows="1"></textarea>
                                </div>
                                <div class="form-group ml-5">
                                    <input style="width: 13px; height: 13px" type="checkbox" wire:model="is_correct4" value="1">
                                    <label for="exampleFormControlTextarea1">D:</label>
                                    <textarea wire:model="awswer_content4" class="form-control" placeholder="Nhập câu trả lời" id="exampleFormControlTextarea1" rows="1"></textarea>
                                </div>
                                <br>
                                <input wire:model="quiz_id" type="hidden" name="quiz_id" value="{{$this->quiz_id = 1}}">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Thêm câu hỏi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{--        pop-up-update--}}
            <div wire:ignore.self id="myExtraLargeModalLabel" class="modal fade create-task" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa câu hỏi</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit="storeQuestion">
                                @csrf
                                {{--            Câu hỏi--}}
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Câu hỏi:</label>
                                    <input wire:model="question_content" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nhập câu hỏi" value="{{$question_content_update}}">
                                </div>
                                <br>
                                {{--            //Câu trả lời--}}
                                <div class="form-group ml-5">
                                    <input style="width: 13px; height: 13px" type="checkbox" wire:model="is_correct1" value="1">
                                    <label for="exampleFormControlTextarea1">A:</label>
                                    <textarea value="{{$answer_content_update}}" wire:model="awswer_content1" class="form-control" placeholder="Nhập câu trả lời" id="exampleFormControlTextarea1" rows="1"></textarea>
                                </div>
                                <div class="form-group ml-5">
                                    <input style="width: 13px; height: 13px" type="checkbox" wire:model="is_correct2" value="1">
                                    <label for="exampleFormControlTextarea1">B:</label>
                                    <textarea wire:model="awswer_content2" class="form-control" placeholder="Nhập câu trả lời" id="exampleFormControlTextarea1" rows="1"></textarea>
                                </div>
                                <div class="form-group ml-5">
                                    <input style="width: 13px; height: 13px" type="checkbox" wire:model="is_correct3" value="1">
                                    <label for="exampleFormControlTextarea1">C:</label>
                                    <textarea wire:model="awswer_content3" class="form-control" placeholder="Nhập câu trả lời" id="exampleFormControlTextarea1" rows="1"></textarea>
                                </div>
                                <div class="form-group ml-5">
                                    <input style="width: 13px; height: 13px" type="checkbox" wire:model="is_correct4" value="1">
                                    <label for="exampleFormControlTextarea1">D:</label>
                                    <textarea wire:model="awswer_content4" class="form-control" placeholder="Nhập câu trả lời" id="exampleFormControlTextarea1" rows="1"></textarea>
                                </div>
                                <br>
                                <input wire:model="quiz_id" type="hidden" name="quiz_id" value="{{$this->quiz_id = 1}}">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Thêm câu hỏi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
        <div class="container">
            <div class="row" style="margin-left: 30px">
                <div class="col-lg-12">
                    <div id="addproduct-accordion" class="custom-accordion">
                        <div class="card">
                            <a href="#addproduct-productinfo-collapse" class="text-dark" data-bs-toggle="collapse"
                               aria-expanded="true" aria-controls="addproduct-productinfo-collapse">
                                <div class="p-4">

                                    Quiz: 1
                                    <span style="float: right" class="mr-2"><button type="button" wire:click="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm câu hỏi</button></span>
                                </div>
                            </a>

                            <div id="addproduct-productinfo-collapse" class="collapse show"
                                 data-bs-parent="#addproduct-accordion">
                                <div class="p-4 border-top">
                                    <form method="POST" action="">
                                        @csrf
                                        <div class="card-body">
                                            @foreach($question as $question)
                                                <div class="card mb-3 ">
                                                    <div class="card-header">Câu {{ $loop->iteration }}: {{ $question->question_content}}
                                                        <span style="float: right" class=""><button type="button" wire:click="delete({{ $question->question_id }})" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete"><i class="fa fa-close"></i>Xoá</button></span>
                                                        <span style="float: right" class="mr-2"><button type="button" wire:click="findupdateId({{$question->question_id}},'{{$question->question_content}}')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myExtraLargeModalLabel">Chỉnh sửa</button></span>
                                                    </div>
                                                    <div class="card-body">
                                                        <input type="hidden" name="questions[{{ $question->question_id }}]" value="">
                                                        @foreach($question->answer as $answer)
                                                            <div class="form">
                                                                @if($answer->is_correct == 1)
                                                                    <input style="float: left" class="form-check-input" type="radio" checked>
                                                                    <label class="form-check-label fw-bold ml-2" for="option-{{ $answer->id }}">
                                                                        {{ $answer->awswer_content }}
                                                                    </label>
                                                                @elseif($answer->is_correct == 0)
                                                                    <input style="float: left" class="form-check-input" type="radio" disabled>
                                                                    <label class="form-check-label ml-2" for="option-{{ $answer->id }}">
                                                                        {{ $answer->awswer_content }}
                                                                    </label>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="form-group d-flex justify-content-center text-center m-auto align-items-center mt-3">
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination">
                                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                                        <li class="page-item"><a class="page-link" href="?page=1">1</a></li>
                                                        <li class="page-item"><a class="page-link" href="?page=2">2</a></li>
                                                        <li class="page-item"><a class="page-link" href="?page=3">3</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                    </ul>
                                                </nav>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col text-end">
                                                    <a href="#" class="btn btn-danger"> <i class="bx bx-x me-1"></i> Xoá quiz </a>
                                                </div> <!-- end col -->
                                            </div> <!-- end row-->
                                        </div>
                                    </form>
                                    <!-- Modal -->
                                    <div wire:ignore.self class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cảnh báo hành động</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true close-btn">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Bạn có chắc chắn muốn xoá không?</p>
                                                    <p>(Điều này sẽ xoá câu hỏi cùng các câu trả lời)</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Không</button>
                                                    <button type="button" wire:click.prevent="deleteconfirm()" class="btn btn-danger close-modal" data-bs-dismiss="modal">Có, tôi muốn xoá</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
</div>

