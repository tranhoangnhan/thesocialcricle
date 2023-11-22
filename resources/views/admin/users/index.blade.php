@extends('layouts.admin')
@section('css')

@endsection
@section('content')

            @livewire('admin.users.admin-user')
@endsection
@section('js')
    <!-- form wizard init -->
    <script src="{{asset('admin/assets/js/pages/form-wizard.init.js')}}"></script>
    <script src="https://cdn.lordicon.com/lordicon-1.2.0.js"></script>
@endsection
