@extends('layouts.clients')
@section('css')

@endsection
@section('content')
    <header>
        <!-- FontAwesome-cdn include -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <!-- Google fonts include -->
        <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
        <!-- Bootstrap-css include -->
        <link rel="stylesheet" href="{{asset('clients/assets-quiz/css/bootstrap.min.css')}}">
        <!-- Animate-css include -->
        <link rel="stylesheet" href="{{asset('clients/assets-quiz/css/animate.min.css')}}">
        <!-- Main-StyleSheet include -->
        <link rel="stylesheet" href="{{asset('clients/assets-quiz/css/style.css')}}">
    </header>
    <div>
        @livewire('clients.quiz.quiz', ['course' => $course])
    </div>
@endsection
@section('js')
    <!-- jQuery-js include -->
    <script src="{{asset('clients/assets-quiz/js/jquery-3.6.0.min.js')}}"></script>
    <!-- Bootstrap-js include -->
    <script src="{{asset('clients/assets-quiz/js/bootstrap.min.js')}}"></script>
    <!-- jQuery-validate-js include -->
    <script src="{{asset('clients/assets-quiz/js/jquery.validate.min.js')}}"></script>
    <!-- Custom-js include -->
    <script src="{{asset('clients/assets-quiz/js/script.js')}}"></script>
@endsection
