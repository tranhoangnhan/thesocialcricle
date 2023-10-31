@extends('layouts.clients')
@section('customcss')

@endsection
@section('content')

@livewire('clients.video.index',['course'=>$course])

@endsection
@section('js')

@endsection
