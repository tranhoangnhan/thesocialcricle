@extends('layouts.course')

@section('content')


@livewire('course.index',['course'=>$course,'enroll'=>$enroll,'slary'=>$slary,'quiz'=>$quiz])



@endsection
