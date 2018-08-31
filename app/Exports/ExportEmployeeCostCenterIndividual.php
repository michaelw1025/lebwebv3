<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ExportEmployeeCostCenterIndividual implements FromView, ShouldAutoSize{

    use Exportable;

    public function __construct($searchedCostCenter)
    {
        $this->searchedCostCenter = $searchedCostCenter;
    }

    public function view(): View
    {
        return view('queries.export-tables.cost-center-individual', [
            'searchedCostCenter' => $this->searchedCostCenter,
        ]);
    }
    
}