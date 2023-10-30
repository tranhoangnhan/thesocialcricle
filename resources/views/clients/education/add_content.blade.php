@extends('layouts.clients')
@section('css')
    <style>
        .ck-editor__editable {
            /* editing area */
            min-height: 500px;
        }
    </style>
@endsection
@section('content')

@livewire('clients.education.content', ['course' => $course])

@endsection

@section('js')
@endsection
