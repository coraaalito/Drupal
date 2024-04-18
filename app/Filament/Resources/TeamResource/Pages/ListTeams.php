<?php

namespace App\Filament\Resources\TeamResource\Pages;

use App\Filament\Resources\TeamResource;
use App\Models\Call;
use App\Models\Team;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;

use Illuminate\Database\Eloquent\Builder;

class ListTeams extends ListRecords
{
    protected static string $resource = TeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {        
        $active = Call::where('active', true)->first();
                
        if(!$active){
            return [ 
                'all' => Tab::make('Todos los registros'),                      
             ];
        }

        return [ 
            'all' => Tab::make('Todas'),
            'active' => Tab::make($active->title)
            ->modifyQueryUsing(fn (Builder $query) => $query->where('call_id', $active->id)),         
         ];
    
    }

    
}
