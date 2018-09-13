<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ExportEmployeeWageProgression implements FromView, ShouldAutoSize{

    use Exportable;

    public function __construct($employees, $wageProgressions)
    {
        $this->employees = $employees;
        $this->wageProgressions = $wageProgressions;
    }

    public function view(): View
    {
        return view('queries.export-tables.wage-progression', [
            'employees' => $this->employees,
            'wageProgressions' => $this->wageProgressions
        ]);
    }
    
}