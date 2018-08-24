<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ExportEmployeeBirthday implements FromCollection, WithHeadings{

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
            'Team Manager',
            'Team Leader',
            'Birth Date',
            'Hire Date',
            'Shift',
            'Cost Center',
            'Job',
            'Position'
        ];
    }
    
}