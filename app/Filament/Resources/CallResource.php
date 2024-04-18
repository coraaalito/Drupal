<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CallResource\Pages;
use App\Filament\Resources\CallResource\RelationManagers;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Models\Call;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class CallResource extends Resource
{
    protected static ?string $model = Call::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $modelLabel = 'Convocatoria';

    protected static ?string $pluralModelLabel = 'Convocatorias';

    // protected static ?string $navigationLabel = 'Mis Clientes';

    protected static ?string $navigationGroup = 'Emprende';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Convocatoria')
                    ->schema([
                        Forms\Components\TextInput::make('title')     
                            ->label('Nombre de la convocatoria')
                            ->required()               
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('content')
                            ->label('Contenido')
                            ->required()                          
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('initial_date')
                            ->label('Inicio de la convocatoria')
                            ->required(),
                        Forms\Components\DatePicker::make('end_date')
                            ->label('Fin de la convocatoria')
                            ->required(),
                ])->columns(2),
                Forms\Components\Fieldset::make('Datos adicionales') 
                ->schema([
                  
                    Forms\Components\TagsInput::make('emails')
                        ->label('Correo electrónico de los responsable')                        
                        ->placeholder('academicos@cuc.udg.mx')
                        ->splitKeys(['Tab', ' '])
                        ->required(),                        
                    Forms\Components\DatePicker::make('initial_register')
                        ->label('Inicio de registro de proyectos')
                        ->required(), 
                    Forms\Components\DatePicker::make('end_register')
                        ->label('Fin de registro de proyectos')
                        ->required(), 
                    SpatieMediaLibraryFileUpload::make('main_logo')
                        ->label('Logo de la convocatoria')
                        ->collection('main')
                        ->image(),     
                    SpatieMediaLibraryFileUpload::make('secondary_logo')
                        ->label('Logo secundario')
                        ->collection('secondary')
                        ->image(),      
                    SpatieMediaLibraryFileUpload::make('navbar_logo')
                        ->label('Logo de la barra de navegación')  
                        ->collection('navbar')
                        ->image(),          
                    Toggle::make('active')
                        ->label('Convocatoria activa')
                        ->inline(false)
                        ->default(true)
                        ->required()
                        ->hidden(),  
                    ]) ->columns(3),             
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('title')
                    ->label('Convocatoria')
                    ->searchable()
                    ->weight(FontWeight::Bold)
                    ->color('primary'),
                ToggleColumn::make('active')
                    ->label('Activa'),      
                SpatieMediaLibraryImageColumn::make('main')
                    ->label('Logo')             
                    ->collection('main'),
                   
                Tables\Columns\TextColumn::make('initial_date')
                    ->label('Fecha de inicio')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Fecha de fin')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->sortable(),
                Tables\Columns\TextColumn::make('initial_register')
                    ->label('Registro de proyectos')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('emails')        
                    ->label('Correos de contacto')  
                    ->icon('heroicon-m-envelope')
                    ->badge()
                    ->color('purple')
                    ->separator(',') 
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),             
                
           
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()->color('purple'),
                    EditAction::make()->color('primary'),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
               
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
          
             RelationManagers\PagesRelationManager::class,


        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCalls::route('/'),
            'create' => Pages\CreateCall::route('/create'),
            'edit' => Pages\EditCall::route('/{record}/edit'),
        ];
    }    
}
