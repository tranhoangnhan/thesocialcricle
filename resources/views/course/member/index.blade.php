@extends('layouts.course')

@section('content')

@livewire('course.member',['course'=>$course])


@endsection
