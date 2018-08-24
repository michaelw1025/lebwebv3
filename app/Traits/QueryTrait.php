<?php

namespace App\Traits;

use Carbon\Carbon;

// Models
use App\Employee;

trait QueryTrait
{
    protected function getEmployeeAlphabetical($request, $job)
    {
        // Get all employees
        $employees = Employee::select(
            'id',
            'first_name',
            'last_name',
            'ssn',
            'birth_date',
            'hire_date',
            'service_date',
            'address_1',
            'address_2',
            'city',
            'state',
            'zip_code',
            'county'
        )
        ->where('status', 1)->whereHas('job', function($q) use($job) {
            $q->where('description', $job);
        })->with(['shift', 'position'
        ])->orderBy('last_name',  'asc')->orderBy('first_name', 'asc')->get();
        return $employees;
    }

    // Sets employee alphabetical info for the export
    protected function setEmployeeAlphabeticalExportInfo($employees)
    {
        foreach($employees as $employee){
            $employee->date_of_birth = $employee->birth_date->format('m/d/Y');
            $employee->date_of_hire = $employee->hire_date->format('m/d/Y');
            $employee->date_of_service = $employee->service_date->format('m/d/Y');
            foreach($employee->shift as $shift){
                $employee->current_shift = $shift->description;
            }
            foreach($employee->position as $position){
                $employee->current_position = $position->description;
            }
            foreach($employee->costCenter as $costCenter){
                $employee->current_cost_center = $costCenter->number.' '.$costCenter->extension.' '.$costCenter->description;
            }

            unset($employee->birth_date);
            unset($employee->hire_date);
            unset($employee->service_date);
            unset($employee->shift);
            unset($employee->position);
            unset($employee->costCenter);
        }
        return $employees;
    }

    protected function getEmployeeAnniversaryByMonth($searchMonth, $searchYear)
    {
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

        return $filteredEmployees;
    }

    protected function getEmployeeAnniversaryByQuarter($searchQuarter, $searchYear)
    {
        // Set calendar dates for the selected quarter based on year given
        $selectedYear = new Carbon('first day of January '.$searchYear);
        $firstDayOfQuarter = $selectedYear->copy()->addQuarters($searchQuarter - 1)->firstOfQuarter()->toDateTimeString();
        $lastDayOfQuarter = $selectedYear->copy()->addQuarters($searchQuarter - 1)->lastOfQuarter()->endOfDay()->toDateTimeString();

        $allEmployees = Employee::select(
            'id',
            'first_name',
            'last_name',
            'service_date'
        )->where('status', 1)->orderBy('service_date', 'dsc')->get();

        $filteredEmployees = $allEmployees->filter(function($employee) use($searchQuarter, $selectedYear) {
            if($employee->service_date->quarter === $searchQuarter ){
                $yearDiff = $selectedYear->copy()->year - $employee->service_date->year;
                if($yearDiff % 5 === 0 && $yearDiff !== 0){
                    $employee->year_diff = $yearDiff;
                    $employee->load('shift');
                    return $employee;
                }
            }
        });
        return $filteredEmployees;
    }

    // Sets employee anniversary info for the export
    protected function setEmployeeAnniversaryExportInfo($employees)
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

