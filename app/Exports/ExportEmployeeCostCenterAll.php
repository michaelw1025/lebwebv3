<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ExportEmployeeCostCenterAll implements FromView, ShouldAutoSize{

    use Exportable;

    public function __construct($costCenters)
    {
        $this->costCenters = $costCenters;
    }

    public function view(): View
    {
        return view('queries.export-tables.cost-center-all', [
            'costCenters' => $this->costCenters
        ]);
    }
    
}