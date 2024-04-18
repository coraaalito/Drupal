<?php

namespace App\Exports;

use App\Models\Call;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class TeamsExport implements FromView, ShouldAutoSize
{
  

    public function view(): View
    {
        $call = Call::where('active', true)->first();
        $teams = Team::where('call_id', $call->id)->get();

        // foreach($teams as $team)
        // {
        //     dd($team->member);
        //     $team->members = $team->member()->get();
        // }
      
        return view('export.team', [
            'teams' => $teams,
            'call' => $call          
        ]);
    }
}
