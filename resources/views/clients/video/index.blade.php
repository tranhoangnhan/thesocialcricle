@extends('layouts.clients')
@section('customcss')

@endsection
@section('content')

@livewire('clients.video.index',['course'=>$course,'videos'=>$video])

@endsection
@section('js')

@endsection
