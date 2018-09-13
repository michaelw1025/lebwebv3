<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ExportEmployeeAlphabetical implements FromView, ShouldAutoSize{

    use Exportable;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    public function view(): View
    {
        return view('queries.export-tables.alphabetical', [
            'employees' => $this->employees
        ]);
    }
}