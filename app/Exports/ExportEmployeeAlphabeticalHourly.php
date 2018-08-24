<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ExportEmployeeAlphabeticalHourly implements FromCollection, WithHeadings{

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
            'SSN',
            'Address',
            'Address Cont',
            'City',
            'State',
            'Zip Code',
            'County',
            'Team Manager',
            'Team Leader',
            'Birth Date',
            'Hire Date',
            'Service Date',
            'Shift',
            'Position',
            'Cost Center',
        ];
    }
    
}