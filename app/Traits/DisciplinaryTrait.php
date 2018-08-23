<?php

namespace App\Traits;

// Models
use App\CostCenter;
use App\Employee;

trait DisciplinaryTrait
{
    // Get disciplinary info
    protected function getDisciplinaryInfo($disciplinary)
    {
            $cc = CostCenter::find($disciplinary->cost_center);
            $disciplinary->cost_center_number = $cc->number.' '.$cc->extension;
            $disciplinary->cost_center_name = $cc->description;
            $issuer = Employee::find($disciplinary->issued_by);
            $disciplinary->issuer_name = $issuer->first_name.' '.$issuer->last_name;
    }

}

