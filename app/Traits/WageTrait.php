<?php

namespace App\Traits;

trait WageTrait
{
    // Convert wage progression event date from string to date
    protected function setWageEventDate($employee)
    {
        foreach($employee->wageProgression as $employeeProgression){
            $employeeProgression->pivot->date = $this->setAsDate($employeeProgression->pivot->date);
        }
    }

}

