<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error 404 </title>
    @vite('resources/css/app.css')
</head>
<body class="bg-stone-600"> 
    <div class="flex justify-center items-center min-h-screen">
        <div class="text-center">
            <h1 class="text-white text-2xl font-semibold">Ops, has ingresado a una ruta que no existe</h1><br>
            <img class="mx-auto md:w-full lg:w-2/4 hover:rotate-180 rounded-full shadow-2xl  m-5" src="{{ asset('images/errors/404.jpg') }}" alt="Error 404"><br><br>
            <a class="transition ease-in-out delay-150 bg-yellow-500 hover:-translate-y-1 hover:scale-110 hover:bg-blue-950 duration-300 
            p-4  rounded-md hover:text-white font-semibold"
               href="{{ route('home') }}">
                Regresar
            </a>
        </div>
    </div>
    
    
</body>
</html>