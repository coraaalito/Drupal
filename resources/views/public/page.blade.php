
@extends('public.main')

@section('content')
 
 {{-- Contenido --}}
 <section >
    <div class="container mx-auto w-full bg-white lg:p-10 sm:p-0 ">
        <h1 class="text-center mb-10 font-bold text-3xl text-lime-900">{{$title}}</h1>
        {{-- Prose sirve para cambiar el codigo html a diseño de tailwind --}}
        <article class="prose max-w-none m-3 md:px-10 sm:px-0 md:mx-auto sm:text-justify">
            {!!$content!!}
        </article>
    </div>
</section>

@endsection