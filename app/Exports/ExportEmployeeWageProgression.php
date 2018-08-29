<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ExportEmployeeWageProgression implements FromCollection, WithHeadings, ShouldAutoSize{

    use Exportable;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    public function collection()
    {
        return $this->employees;
    }

    public function headings(): array
    {
        return[
            'id',
            'First Name',
            'Last Name',
            'MI',
            'SSN',
            'Oracle Number',
            'Team Manager',
            'Team Leader',
            'Current Wage',
            'Next Wage',
            'Hire Date',
            'Next Progression Level',
            'Next Progression Date',
            'Cost Center',
            'Shift',
            'Job',
            'Position'
        ];
    }
    
}