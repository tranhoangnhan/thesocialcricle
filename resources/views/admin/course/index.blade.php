@extends('layouts.Admin')
@section('title')
    Danh sách khóa học
@endsection
@section('content')
    @livewire('admin.course.index')
@endsection
@section('js')
    <script src="{{ asset('assets/js/checkbox.js') }}"></script>
@endsection
