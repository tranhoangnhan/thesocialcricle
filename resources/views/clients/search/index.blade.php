@extends('layouts.clients')
@section('css')

@endsection
@section('content')
    <div>
        <livewire:clients.show-result-search/>
    </div>
@endsection
@section('js')
    <script>
        document.addEventListener('livewire:initialized', () => {
        Livewire.on('search',(e) =>{
            console.log('hi')
        });
        });
    </script>
@endsection
