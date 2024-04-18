
@extends('public.main')

@section('content')

<div class=" justify-between items-center py-20 px-5">
    <div class="mx-auto lg:flex">
        <div class="lg:w-2/3 bg-white flex justify-center p-10 m-3 rounded-full">
            <img src="{{$call?$call->getFirstMediaUrl('main'):asset('images/emprende.png')}}" alt="logo emprende" class="w-lg h-lg  mx-auto">
        </div>
    
        <div class="lg:w-2/3 lg:ml-10 mt-6 lg:mt-0">
           
            <img src="{{$call?$call->getFirstMediaUrl('secondary'):asset('images/cuc_emprende.png')}}" alt="logo secundario" class="w-lg h-lg mx-auto mt-20">
    
            <h3 class="text-xl lg:text-3xl font-semibold text-yellow-900 mt-20 text-center italic   ">
                {!! $call ? 'Fecha límite para  <br><br> postulación de empresas: '.'<br><br> '
                .'<label class="text-xl lg:text-3xl font-semibold text-yellow-600  mt-20 text-center ">'. $endRegister  . '</label>'
                : 'Aun no se ha publicado la convocatoria' !!}
            </h3> 
              
        </div>    
    </div> 
</div>

@endsection