@extends('layouts.admin')
@section('css')

@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            @livewire('admin.users.admin-user')
        </div>
    </div>
@endsection
@section('js')
    <!-- form wizard init -->
    <script src="{{asset('admin/assets/js/pages/form-wizard.init.js')}}"></script>
    <script src="https://cdn.lordicon.com/lordicon-1.2.0.js"></script>
@endsection
