<?php

namespace App\Livewire;
 
use App\Models\Team;
use App\Models\Call;
use App\Models\Member;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Set;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;
use Filament\Forms\Form;
use App\Mail\RegisterEmail;

class CreateTeam extends Component implements HasForms
{
    use InteractsWithForms;

    public function render()
    {
        return view('livewire.create-team');
    }

    
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }
    
    public Team $team;

    public function form(Form $form): Form
    {
        return $form
            ->schema([                
           Section::make('Datos del equipo')
                    ->description('LLenar los datos correspondientes.  Los elementos con * son obligatorios')              
                    ->schema([
                            TextInput::make('name')
                                ->label('Nombre del proyecto')
                                ->required()   
                                ->columnSpan(['md' => 1, 'lg' => 2])                        
                                ->maxLength(255), 
                            Select::make('category_id')
                                ->label('Categoría')                       
                                ->relationship(name: 'category', titleAttribute: 'name')                            
                                ->required(),                                               
                            TextInput::make('url_video')     
                                ->url()
                                ->required()
                                ->placeholder('https://www.youtube.com/')
                                ->label('URL del video')
                                ->suffixIcon('heroicon-m-globe-alt'),
                            TextInput::make('url_proyect')     
                                ->url()
                                 ->required()
                                ->placeholder('https://docs.google.com/')
                                ->label('URL del documento')
                                ->suffixIcon('heroicon-m-globe-alt'),
                            FileUpload::make('filename')
                                ->label('Archivo PDF')
                                ->acceptedFileTypes(['application/pdf'])
                                ->downloadable()
                                ->openable(), 
                                
                            ])->columns(3), 
                             

                Section::make('Miembros del equipo')
                    ->description('Elegir un solo lider marcando la casilla correspondiente y agregar a todos los miembros del equipo.')      
                    ->schema([       
                        Repeater::make('member')
                            ->relationship()
                            ->label('Participantes')                 
                            ->schema([                              
                                Toggle::make('lider')
                                    ->inline(false)
                                    ->label('Lider del equipo')                   
                                    ->default(false)
                                    ->required(), 
                                TextInput::make('code')->label('Código'),
                                Select::make('status')
                                    ->label('Estatus universitario')
                                    ->options([
                                        'Trabajador Administrativo ' => 'Trabajador Administrativo', 
                                        'Trabajador Operativo' => 'Trabajador Operativo',  
                                        'Trabajador Académico ' => 'Trabajador Académico',                        
                                        'Estudiante' => 'Estudiante',
                                        'Egresado' => 'Egresado',
                                        'Familiar' => 'Familiar',
                                        'Otro' => 'Otro',
                                    ])
                                    ->required(),
                                TextInput::make('name')->label('Nombre completo')->required(),
                                TextInput::make('email')->label('Correo electrónico')->required()->email(), 
                                TextInput::make('phone')->label('Teléfono')->required()->tel(),
                            ])  
                            ->defaultItems(1)
                            ->collapsible()
                            ->grid(2)     
                            ->minItems(1)
                            ->maxItems(5)               
                            ->columns(2),
                      
                    ])->columns(1),
            ])
            ->statePath('data')
            ->model(Team::class);
    }
    
    //Funcion para crear el equipo
    public function create() 
    {          
        $datos = $this->form->getState();
        $datos['call_id'] = Call::where('active', true)->firstOrFail()->id;

        $team = Team::create($datos);
        $this->form->model($team)->saveRelationships();

        $hasLider = Member::where('lider', true)->where('team_id', $team->id)->first();
        
        //Validar que el equipo tenga un lider
        if(!$hasLider){
            $team->delete();

            Notification::make()
            ->title('Datos incompletos')
            ->warning()    
            ->color('warning') 
            ->body('Tienes que selecionar un lider de equipo')
            ->persistent()
            ->send();

            return redirect()->back();
        }

        $this->email($team); 
        $this->form->fill();       
        $this->notification();

        return redirect()->route('home');
    }


    //Funcion para enviar notificacion
    public function notification(): void
    {  
        Notification::make()
        ->title('Equipo creado')
        ->success()    
        ->color('success') 
        ->body('Se ha enviado un correo electrónico al lider del equipo')
        ->persistent()
        ->send();
    }

    //Funcion para enviar correo
    public function email($team):void
    {         
        $to = Member::where('lider', true)->where('team_id', $team->id)->firstOrFail()->email;     
        $cc = call::where('active', true)->first()->emails;
    
        Mail::to($to)
        ->cc($cc)        
        ->send(new RegisterEmail($this->data));
    }
    
}
