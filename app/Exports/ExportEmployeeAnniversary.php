<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ExportEmployeeAnniversary implements FromView, ShouldAutoSize{

    use Exportable;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    public function view(): View
    {
        return view('queries.export-tables.anniversary', [
            'employees' => $this->employees
        ]);
    }
    
}