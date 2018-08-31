<?php

namespace App\Traits;

use Carbon\Carbon;

// Models
use App\Employee;
use App\CostCenter;

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
            $this->setEmployeeDateForExport($employee, 'birth');
            $this->setEmployeeDateForExport($employee, 'hire');
            $this->setEmployeeDateForExport($employee, 'service');
            $this->setEmployeeShiftForExport($employee);
            $this->setEmployeePositionForExport($employee);
            $this->setEmployeeCostCenterForExport($employee);

            unset($employee->birth_date);
            unset($employee->hire_date);
            unset($employee->service_date);
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
            $this->setEmployeeShiftForExport($employee);
            $this->setEmployeeCostCenterForExport($employee);

            unset($employee->service_date);
        }
        return $employees;
    }

    protected function getEmployeeBirthday($searchMonth)
    {
        // Get all active employoees with a birth date month equal to the search month
        $allEmployees = Employee::select(
            'id',
            'first_name',
            'last_name',
            'birth_date',
            'hire_date'
        )->where('status', 1)
        ->whereMonth('birth_date', $searchMonth)
        ->with('shift', 'position', 'job')
        ->orderBy('birth_date', 'asc')
        ->get();
        return $allEmployees;
    }

    protected function setEmployeeBirthdayExportInfo($employees)
    {
        foreach($employees as $employee){
            $employee->date_of_birth = $employee->birth_date->format('m/d/Y');
            $employee->date_of_hire = $employee->hire_date->format('m/d/Y');
            $this->setEmployeeShiftForExport($employee);
            $this->setEmployeeCostCenterForExport($employee);
            $this->setEmployeeJobForExport($employee);
            $this->setEmployeePositionForExport($employee);

            unset($employee->birth_date);
            unset($employee->hire_date);
        }
        return $employees;
    }

    protected function getEmployeeWageProgression($searchMonth, $searchYear)
    {
        $employees = Employee::select(
            'id',
            'first_name',
            'last_name',
            'middle_initial', 
            'ssn',
            'oracle_number',
            'hire_date'
        )
        ->where('status', 1)
        ->with(['wageProgression' => function($q) use($searchMonth, $searchYear) {
            $q->whereYear('date', $searchYear)->whereMonth('date', $searchMonth);
        }, 'shift', 'position.wageTitle', 'job', 'wageProgressionWageTitle'])
        ->whereHas('wageProgression', function($q) use($searchMonth, $searchYear) {
            $q->whereYear('date', $searchYear)->whereMonth('date', $searchMonth);
        })
        ->orderBy('last_name', 'asc')
        ->get();

        return $employees;
    }

    protected function setEmployeeWageProgressionExportInfo($employees)
    {
        foreach($employees as $employee){
            $employee->date_of_hire = $employee->hire_date->format('m/d/Y');
            foreach($employee->wageProgression as $employeeWageProgression){
                // Set progression level
                $employee->progression_level = $employeeWageProgression->month;
                // Set progression date
                $employee->progression_date = $employeeWageProgression->pivot->date->format('m/d/Y');
            }
            $this->setEmployeeCostCenterForExport($employee);
            $this->setEmployeeShiftForExport($employee);
            $this->setEmployeeJobForExport($employee);
            $this->setEmployeePositionForExport($employee);

            unset($employee->hire_date);
            unset($employee->wageProgression);
            unset($employee->wageProgressionWageTitle);
        }
        // Sort in order of progression level
        $sorted = $employees->sortBy('progression_level');
        // Convert the sorted array to a collection for the export 
        return collect($sorted->values()->all());     
    }

    protected function getEmployeeCostCenterAll()
    {
        $employees = Employee::select('id', 'first_name', 'last_name')->where('status', 1)->with(['costCenter', 'job', 'position'])->orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->get();
        return $employees;
    }

    protected function getCostCenterIndividual($searchCostCenter)
    {
        $costCenter = CostCenter::with([
            'employee.job',
            'employee.position',
            'employeeStaffManager',
            'employeeDayTeamManager', 
            'employeeNightTeamManager', 
            'employeeDayTeamLeader',
            'employeeNightTeamLeader'
        ])
        ->findOrFail($searchCostCenter);
        return $costCenter;
    }

    protected function getEmployeeDisciplinaryAll()
    {
        $today = Carbon::today()->toDateTimeString();
        $oneYear = Carbon::today()->subYear()->toDateTimeString();
        $employees = Employee::where('status', 1)
        ->with(['disciplinary' => function($q) use($today, $oneYear) {
            $q->whereDate('date', '<=' ,$today)->whereDate('date', '>=', $oneYear);
        }])
        ->whereHas('disciplinary', function($q) use($today, $oneYear) {
            $q->whereDate('date', '<=' ,$today)->whereDate('date', '>=', $oneYear);
        })
        ->orderBy('last_name', 'asc')
        ->orderBy('first_name', 'asc')
        ->get();
        return $employees;
    }

    protected function getDisciplinaryIssuedBy($employees)
    {
        foreach($employees as $employee){
            foreach($employee->disciplinary as $employeeDisciplinary){
                $issuedBy = Employee::find($employeeDisciplinary->issued_by);
                $employeeDisciplinary->issued_by_name = $issuedBy->first_name.' '.$issuedBy->last_name;
            }
        }
        return $employees;
    }

    protected function getEmployeeReview()
    {
        $employees = Employee::select(
            'id',
            'first_name',
            'last_name',
            'hire_date',
            'thirty_day_review',
            'sixty_day_review'
        )
        ->where('status', 1)
        ->where(function($q) {
            $q->where('thirty_day_review', 0)->orWhere('sixty_day_review', 0);
        })
        ->whereHas('job', function($q) {
            $q->where('description', 'hourly');
        })
        ->with(['costCenter', 'shift'])
        ->orderBy('last_name', 'asc')
        ->orderBy('first_name', 'asc')
        ->get();
        return $employees;
    }

    protected function getEmployeeReduction()
    {
        $employees = Employee::select(
            'id',
            'first_name',
            'last_name',
            'hire_date'
        )
        ->where('status', 1)
        ->with(['reduction' => function($q) {
            $q->where('currently_active', 1);
        }])
        ->whereHas('reduction', function($q) {
            $q->where('currently_active', 1);
        })
        ->get();
        return $employees;
    }









    protected function setEmployeeShiftForExport($employee)
    {
        foreach($employee->shift as $shift){
            $employee->current_shift = $shift->description;
        }
        unset($employee->shift);
        return $employee;
    }
    protected function setEmployeeCostCenterForExport($employee)
    {
        foreach($employee->costCenter as $costCenter){
            $employee->current_cost_center = $costCenter->number.' '.$costCenter->extension.' '.$costCenter->description;
        }
        unset($employee->costCenter);
        return $employee;
    }
    protected function setEmployeePositionForExport($employee)
    {
        foreach($employee->position as $position){
            $employee->current_position = $position->description;
        }
        unset($employee->position);
        return $employee;
    }
    protected function setEmployeeJobForExport($employee)
    {
        foreach($employee->job as $job){
            $employee->current_job = $job->description;
            unset($employee->job);
            return $employee;
        }
    }
    protected function setEmployeeDateForExport($employee, $label)
    {
        $employee['date_of_'.$label] = $employee[$label.'_date']->format('m/d/Y');
        return $employee;
    }

}

