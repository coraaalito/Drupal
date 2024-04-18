<?php

namespace App\Http\Controllers;

use App\Exports\TeamsExport;
use App\Models\Call;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

        


class MainController extends Controller
{
    
    public function index()
    {        
        $call = Call::where('active', true)->first();    
        $register = $call? $this->enableRegister($call): false;

        if(!$call)
        {
            return view('public.home', compact('call', 'register'));
        } 

        //fechas de registro de equipos y convocatoria
        $initialRegister = Carbon::parse($call->initial_register)->isoFormat('\\D\\e\\l DD \\d\\e MMMM \\d\\e\\l YYYY');
        $endRegister = Carbon::parse($call->end_register)->isoFormat(' DD \\d\\e MMMM \\d\\e\\l YYYY');
        
        $initialDate = Carbon::parse($call->initial_date)->isoFormat('\\D\\e\\l DD \\d\\e MMMM \\d\\e\\l YYYY');
        $endDate = Carbon::parse($call->end_date)->isoFormat('\\a\\l DD \\d\\e MMMM \\d\\e\\l YYYY');
        $register = $this->enableRegister($call);
    
        return view('public.home', compact('call', 'initialDate', 'endDate', 'register', 'initialRegister', 'endRegister'));
    }

   
  
    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {     
        $call = Call::where('active', true)->first();
        $content = ($slug !== 'convocatoria') ? $call->pages()->where('slug', $slug)->firstorFail()->content : $call->content;
        $title = ($slug !== 'convocatoria') ? $call->pages()->where('slug', $slug)->firstorFail()->title : 'Convocatoria';

        $register = $call? $this->enableRegister($call): false;
        
        return view('public.page', compact('call', 'content', 'title', 'register'));
    }


    public  function enableRegister($call)
    {
        $fechaActual = Carbon::now();
        $initialRegister = Carbon::createFromFormat('Y-m-d', $call->initial_register);
        $endRegister = Carbon::createFromFormat('Y-m-d', $call->end_register)->addDay();
     
        $register = $fechaActual->gte($initialRegister) && $fechaActual->lte($endRegister);
     
        return $register;
    }

    public function register(call $call)
    {        
        $register = $this->enableRegister($call);   

        if(!$register)
        {
            return redirect()->route('home');
        }
     
        return view('public.register', compact('call','register' ));
    }

    public function export()
    {
        return Excel::download(new TeamsExport, 'equipos.xlsx');
    }
    


  
}
