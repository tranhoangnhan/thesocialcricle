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
        <livewire:clients.quiz.quiz-thankyou/>
    </div>
@endsection
@section('js')
    <script src="{{asset('clients/assets-thankyou/js/bootstrap.min.css')}}"></script>
@endsection
