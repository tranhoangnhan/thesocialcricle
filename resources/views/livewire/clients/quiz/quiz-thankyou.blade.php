<div>
    @extends('layouts.clients')
    @section('css')

    @endsection
    @section('content')
        <header>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <!-- Google-fonts-include -->
            <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;700&family=Oswald:wght@700&display=swap" rel="stylesheet">
            <!-- Bootstrap-css include -->
            <link rel="stylesheet" href="{{asset('clients/assets-thankyou/css/bootstrap.min.css')}}">
            <!-- Main-StyleSheet include -->
            <link rel="stylesheet" href="{{asset('clients/assets-thankyou/css/style.css')}}">
        </header>
        <div>
            <div id="wrapper">
                <div class="container">
                    <div class="row text-center">
                        @foreach($data as $data)
                            @if($data->mark == 'Đạt')
                                <div>
                                    <lord-icon
                                        src="https://cdn.lordicon.com/guqkthkk.json"
                                        trigger="in"
                                        style="width:250px;height:250px">
                                    </lord-icon>
                                </div>
                                <div class="sub_title">
                                    <span>Chúc mừng bạn đã làm bài Quiz thành công!</span>
                                </div>
                                <div class="title pt-1">
                                    <h3>Bạn đã làm đúng {{$count_correct}}/{{$count}} câu</h3>
                                    <h3>Kết quả: {{$data->mark}}</h3>
                                </div>
                            @elseif($data->mark == 'Không đạt')
                                <div>
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nqtddedc.json"
                                        trigger="in"
                                        style="width:250px;height:250px">
                                    </lord-icon>
                                </div>
                                <div class="sub_title">
                                    <span>Chúc mừng bạn đã làm bài Quiz thành công!</span>
                                </div>
                                <div class="title pt-1">
                                    <h3>Bạn đã làm đúng {{$count_correct}}/{{$count}} câu</h3>
                                    <h3>Kết quả: {{$data->mark}}</h3>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
        <script src="{{asset('clients/assets-thankyou/js/bootstrap.min.css')}}"></script>
        <script src="https://cdn.lordicon.com/lordicon-1.2.0.js"></script>
    @endsection

</div>

