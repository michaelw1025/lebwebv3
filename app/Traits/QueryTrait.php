<?php

namespace App\Traits;

use Carbon\Carbon;

// Models
use App\Employee;

trait QueryTrait
{
    protected function employeeAnniversary($searchMonth, $searchYear)
    {
        // Get the current time
        $timeNow = Carbon::now();
        // If search is submitted set time base on month and year
        $searchDate = Carbon::create($searchYear, $searchMonth, 1, 0);

        // Get all active employoees with a service date month equal to the search month
        $allEmployees = Employee::select(
            'id',
            'first_name',
            'last_name',
            'service_date'
        )->where('status', 1)->whereMonth('service_date', $searchMonth)->orderBy('service_date', 'dsc')->get();

        // Filter out employees who do not have a service date at a five year interval to the search year
        $filteredEmployees = $allEmployees->filter(function($employee) use($searchDate) {
            $yearDiff = $searchDate->copy()->year - $employee->service_date->year;
            if($yearDiff % 5 === 0 && $yearDiff !== 0){
                $employee->year_diff = $yearDiff;
                $employee->load('shift');
                return $employee;
            }
        });
        // Get employee supervisors from helper file
        $this->getEmployeeSupervisors($filteredEmployees);

        return $filteredEmployees;
    }

    // Sets info for the export
    protected function setEmployeeExportInfo($employees)
    {
        foreach($employees as $employee){
            $employee->date_of_service = $employee->service_date->format('m/d/Y');
            foreach($employee->shift as $shift){
                $employee->current_shift = $shift->description;
            }
            foreach($employee->costCenter as $costCenter){
                $employee->current_cost_center = $costCenter->number.' '.$costCenter->extension.' '.$costCenter->description;
            }

            unset($employee->service_date);
            unset($employee->shift);
            unset($employee->costCenter);
        }
        return $employees;
    }

}

