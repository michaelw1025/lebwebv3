<?php

namespace App\Traits;

// Models
use App\WageProgressionWageTitle;

trait WageTrait
{
    // Convert wage progression event date from string to date
    protected function setWageEventDate($employee)
    {
        foreach($employee->wageProgression as $employeeWageProgression){
            $employeeWageProgression->pivot->date = $this->setAsDate($employeeWageProgression->pivot->date);
        }
        return $employee;
    }

    // Set employee next wage 
    protected function setEmployeeWages($employees)
    {
        foreach($employees as $employee){
            // Set current wage
            foreach($employee->wageProgressionWageTitle as $employeeWageProgressionWageTitle){
                $employee->current_wage = $employeeWageProgressionWageTitle->amount;
            }
            // Set next wage
            foreach($employee->wageProgression as $employeeWageProgression){
                $nextProgressionID = $employeeWageProgression->id;
            }
            foreach($employee->position as $employeePosition){
                foreach($employeePosition->wageTitle as $employeePositionWageTitle){
                    $wageTitleID = $employeePositionWageTitle->id;
                }
            }
            $nextWageProgression = WageProgressionWageTitle::where([
                ['wage_progression_id', $nextProgressionID],
                ['wage_title_id', $wageTitleID]
            ])->firstOrFail();
            $employee->next_wage = $nextWageProgression['amount'];
        }
        return $employees;
    }

}

