<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Toggle;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Tables\Actions\Action;

 

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Emprende';

    protected static ?string $modelLabel = 'Equipo';

    protected static ?string $pluralModelLabel = 'Equipos';

  

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Datos del equipo')
                    ->description('LLenar los datos correspondientes')              
                    ->schema([
                            Forms\Components\Select::make('category_id')
                                ->label('Categoría')
                                ->relationship('category', 'name')
                                ->required(),    
                            Forms\Components\Select::make('call_id')
                                ->label('Convocatoria')
                                ->relationship('call', 'title')
                                ->required(),  
                            Forms\Components\TextInput::make('name')
                                ->label('Nombre del proyecto')
                                ->required()
                                ->maxLength(255), 
                            FileUpload::make('filename')
                                ->label('Archivo PDF')
                                ->acceptedFileTypes(['application/pdf'])
                                ->downloadable()
                                ->openable(), 
                            Forms\Components\TextInput::make('url_video')     
                                ->url()
                                ->placeholder('https://www.youtube.com/')
                                ->label('URL del video')
                                ->suffixIcon('heroicon-m-globe-alt'),
                            Forms\Components\TextInput::make('url_proyect')     
                                ->url()
                                ->placeholder('https://docs.google.com/')
                                ->label('URL del documento')
                                ->suffixIcon('heroicon-m-globe-alt'),
                            ])                          
                            ->columns(3),  
                            
                Forms\Components\Fieldset::make('Miembros del equipo') 
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
                                TextInput::make('phone')->label('Teléfono')->required(),
                            ])  
                            ->defaultItems(1)
                            ->collapsible()
                            ->grid(2)     
                            ->minItems(1)
                            ->maxItems(5)               
                            ->columns(2),
                      
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([               
                Tables\Columns\TextColumn::make('name')           
                    ->label('Nombre del equipo')                  
                    ->color('purple')
                    ->weight(FontWeight::Bold)
                    ->searchable(),   
                Tables\Columns\TextColumn::make('call.title')
                    ->label('Convocatoria')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoría')
                    ->numeric()
                    ->sortable(),          
                Tables\Columns\TextColumn::make('Lider')
                    ->badge()
                    ->color('pink')
                    ->state(function (Team $record): string {
                    $lider = $record->member->where('lider', true)->first();
                    return $lider ? $lider->name : 'Sin lider';
                }),
             
                Tables\Columns\TextColumn::make('member_count')
                    ->label('Participantes')
                    ->counts('member'),  
               
            ])
            ->filters([                
                    SelectFilter::make('Categoria')
                        ->relationship('category', 'name'),
                    SelectFilter::make('Convocatoria')
                        ->relationship('call', 'title')
                ]) 
                ->persistFiltersInSession()
                ->filtersFormColumns(1)  
                         
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])->headerActions([

                Action::make('Descargar equipos')
                    ->url(route('team.export'))
                    ->openUrlInNewTab()
                    ->color('success')
                    ->icon('heroicon-o-arrow-down-tray')
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }    
}
