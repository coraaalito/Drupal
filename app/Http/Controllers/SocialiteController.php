<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Filament\Notifications\Notification;
use Throwable;

class SocialiteController extends Controller
{

    public function redirectToProvider()
    {      
        try {
            return Socialite::driver('google')->redirect();

        } catch (Throwable $e) {

            return redirect('/admin');
        }
    }

    /**
     * Obtain the user information from google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();        
            $userExits = User::where('email', $user->email)->first();
          
            if($userExits){
                Auth::login($userExits);
                    
            }else{       
                Notification::make()
                ->title('No se encuentra registrado')
                ->warning()    
                ->color('warning') 
                ->body('Su correo no se encuentra registrado en el sistema, intente con otro correo o contacte al administrador')           
                ->send();                           
            }

            return redirect('/admin'); 
        
        
        } catch (Throwable $e) {
    
            Notification::make()
            ->title('Ha ocurrido un error')
            ->danger()    
            ->color('danger') 
            ->body('No se ha podido iniciar sesión, intente de nuevo o contacte al administrador')           
            ->send(); 

            return redirect('/admin');
        }

    }
}
