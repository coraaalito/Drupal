<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <meta name="application-name" content="{{ config('app.name') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">


    <title>Emprende</title>
    @filamentStyles
    @vite('resources/css/app.css')


    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
     @include('recaptcha')
</head>

<body class="bg-gray-100 antialiased">
    @livewire('notifications')
    @filamentScripts
    @vite('resources/js/app.js')
    
    {{-- Navbar --}}
    @include('public.layout.navbar')

    {{-- Contenido --}}

    <section class="mt-28 px-4">
        <div class=" first-line:rounded-md bg-white  w-full py-10" style="background-image: url({{ asset('images/background.svg') }});">
            @yield('content')              
        </div>
    </section>
    
    {{-- footer --}}
    @include('public.layout.footer')

</body>
</html>