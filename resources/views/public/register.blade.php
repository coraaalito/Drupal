
@extends('public.main')

@section('content')

<div class="container mx-auto w-full p-10 rounded-lg">
    <h1 class="text-center mb-10 font-bold bg-white  border-gray-100 border rounded-lg shadow-2xl text-4xl text-yellow-800 py-5 ">
        Registro de Proyectos</h1>
    @livewire('create-team')
</div>

@endsection