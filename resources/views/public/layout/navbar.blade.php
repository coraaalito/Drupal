{{-- Navbar --}}
<nav class="fixed top-0 left-0 bg-white w-full shadow z-50  ">
    <div class="container m-auto flex justify-around  items-center text-sky-900 py-3">
       
        {{-- Logo navbar --}}
        <img src="{{$call?$call->getFirstMediaUrl('navbar'):asset('images/division.png')}}" alt="logo navbar" class="w-80 h-auto px-10 ">

        {{-- items navbar --}}
        <ul class="hidden md:flex items-center pr-10 text-lg font-semibold cursor-pointer ">
            <li class="hover:bg-gray-200 py-4 px-6"><a href="{{route('home')}}">Inicio</a></li>      
            @if($call) 
                <li class="hover:bg-gray-200 py-4 px-6 "><a href="/convocatoria">Convocatoria</a></li>
               @foreach ($call->pages as $page) {{-- items dinamicos--}}
               <li class="hover:bg-gray-200 py-4 px-6"><a href="/{{$page->slug}}">{{$page->title}}</a></li>
               @endforeach
            @endif
        </ul>

        {{-- Boton de registrase --}}
        @if($register)       
            <a class="hidden md:flex  rounded-full bg-blue-500 text-white px-5 py-2 hover:bg-indigo-500 text-lg group
            transition ease-in-out delay-150  hover:-translate-y-1 hover:scale-110  duration-200" href="{{route('team.register', $call->id)}}">Registrarse</a>
        @endif
  
      
        {{-- Boton de menu responsive --}}
        <button class="block md:hidden py-3 px-4 mx-2 rounded focus:outline-none hover:gb-gray-200 group">
            <div class="w-5 h-1 bg-gray-600 mb-1"> </div>
            <div class="w-5 h-1 bg-gray-600 mb-1"> </div>
            <div class="w-5 h-1 bg-gray-600"> </div>
            <div class="absolute top-0 -right-full h-screen w-8/12 bg-white border text-sky-900
                     opacity-0 group-focus:right-0 group-focus:opacity-100 transition-all duration-300">
                <ul class="flex flex-col items-center w-full text-base cursor-pointer pt-10">
                    <li class="hover:bg-gray-200 py-4 px-6 w-full"><a href="/">Inicio</a></li>
                    @if($call) 
                        <li class="hover:bg-gray-200 py-4 px-6 w-full"><a href="/convocatoria">Convocatoria</a></li>
                        @foreach ($call->pages as $page) {{-- items dinamicos--}}
                            <li class="hover:bg-gray-200 py-4 px-6"><a href="{{$page->slug}}">{{$page->title}}</a></li>                   
                        @endforeach
                    @endif                
                </ul>
                @if($register) 
                    <div class="mx-5 my-5">
                        <a class="rounded-full bg-blue-500 text-white px-4 py-2 hover:bg-indigo-500"  href="{{route('team.register', $call->id)}}">Registrarse</a>
                    </div>  
                @endif                 
            </div>
        </button>
    </div>      
</nav>
{{-- Fin navbar --}}