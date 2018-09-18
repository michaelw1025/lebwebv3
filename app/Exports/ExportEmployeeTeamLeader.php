<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ExportEmployeeTeamLeader implements FromView, ShouldAutoSize{

    use Exportable;

    public function __construct($searchTeamLeader, $costCenters)
    {
        $this->searchTeamLeader = $searchTeamLeader;
        $this->costCenters = $costCenters;
    }

    public function view(): View
    {
        return view('queries.export-tables.team-leader', [
            'searchTeamLeader' => $this->searchTeamLeader,
            'costCenters' => $this->costCenters
        ]);
    }
    
}