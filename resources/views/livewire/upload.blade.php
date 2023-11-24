@extends('layouts.custom')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
@endsection
@section('content')
    {{-- <form method="POST" action="{{ route('uploadFile') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">Tải lên</button>
    </form> --}}
    <div class="container">
        @livewire('uploadfile')
    </div>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            const player = new Plyr('#player');

            // Expose
            window.player = player;

            // Bind event listener
            function on(selector, type, callback) {
                document.querySelector(selector).addEventListener(type, callback, false);
            }

            // Play
            on('.js-play', 'click', () => {
                player.play();
            });

            // Pause
            on('.js-pause', 'click', () => {
                player.pause();
            });

            // Stop
            on('.js-stop', 'click', () => {
                player.stop();
            });

            // Rewind
            on('.js-rewind', 'click', () => {
                player.rewind();
            });

            // Forward
            on('.js-forward', 'click', () => {
                player.forward();
            });
        });
    </script> --}}
    {{-- <script src="https://vjs.zencdn.net/8.5.2/video.min.js"></script> --}}
@endsection
@section('js')
    <script src="//{{ Request::getHost() }}:{{ env('LARAVEL_ECHO_PORT') }}/socket.io/socket.io.js"></script>
    <script src="{{ url('/js/laravel-echo-setup.js') }}" type="text/javascript"></script>
    <script>
        // window.Echo.channel('fileUploadProgress')
        //     .listen('.fileUploadProgress', (e) => {
        //         // Xử lý sự kiện ở đây
        //         console.log('run');
        //         // Livewire.emit('fileUploadProgress', e.progress);
        //     });
        window.Echo.channel('laravel_database_fileUploadProgress')
            .listen('.MessageEvent', (data) => {
                console.log({
                    progress: data.progress
                })
                Livewire.dispatch('fileUploadProgress', {
                    progress: data.progress
                });

            });
    </script>
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
    <script src="https://cdn.plyr.io/3.6.7/plyr.progressive.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
    <script src="https://cdn.plyr.io/3.6.7/plyr.progressive.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const player = new Plyr('#player');

            // Expose
            window.player = player;

            // Bind event listener
            function on(selector, type, callback) {
                document.querySelector(selector).addEventListener(type, callback, false);
            }

            // Play
            on('.js-play', 'click', () => {
                player.play();
            });

            // Pause
            on('.js-pause', 'click', () => {
                player.pause();
            });

            // Stop
            on('.js-stop', 'click', () => {
                player.stop();
            });

            // Rewind
            on('.js-rewind', 'click', () => {
                player.rewind();
            });

            // Forward
            on('.js-forward', 'click', () => {
                player.forward();
            });
        });
    </script>
@endsection
