@extends('layouts.clients')
@section('css')

@endsection
@section('content')
<div class="main_content">

        <livewire:clients.quiz.create-quiz/>

</div>
@endsection
@section('js')
    <script>
        $('textarea').each(function () {
            this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
        }).on('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    </script>
@endsection
