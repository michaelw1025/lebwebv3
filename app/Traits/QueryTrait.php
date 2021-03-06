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
            'county',
            'bid_eligible'
        )
        ->where('status', 1)->whereHas('job', function($q) use($job) {
            $q->where('description', $job);
        })->with([
            'costCenter.employeeDayTeamManager:first_name,last_name',
            'costCenter.employeeDayTeamLeader:first_name,last_name',
            'costCenter.employeeNightTeamManager:first_name,last_name',
            'costCenter.employeeNightTeamLeader:first_name,last_name',
            'shift',
            'position'
        ])->orderBy('last_name',  'asc')->orderBy('first_name', 'asc')->get();
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
        )->where('status', 1)
        ->whereMonth('service_date', $searchMonth)
        ->with([
            'costCenter.employeeDayTeamManager:first_name,last_name',
            'costCenter.employeeDayTeamLeader:first_name,last_name',
            'costCenter.employeeNightTeamManager:first_name,last_name',
            'costCenter.employeeNightTeamLeader:first_name,last_name',
            'shift'
        ])
        ->orderBy('service_date', 'dsc')
        ->get();

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
        )->where('status', 1)
        ->with([
            'costCenter.employeeDayTeamManager:first_name,last_name',
            'costCenter.employeeDayTeamLeader:first_name,last_name',
            'costCenter.employeeNightTeamManager:first_name,last_name',
            'costCenter.employeeNightTeamLeader:first_name,last_name',
            'shift'
        ])
        ->orderBy('service_date', 'dsc')
        ->get();

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

    protected function getEmployeeSeniority()
    {
        $employees = Employee::where('status', 1)
        ->with([
            'costCenter.employeeDayTeamManager:first_name,last_name',
            'costCenter.employeeDayTeamLeader:first_name,last_name',
            'costCenter.employeeNightTeamManager:first_name,last_name',
            'costCenter.employeeNightTeamLeader:first_name,last_name',
            'job',
            'shift',
            'position'
        ])
        ->orderBy('hire_date',  'asc')
        ->get();
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
        ->with([
            'costCenter.employeeDayTeamManager:first_name,last_name',
            'costCenter.employeeDayTeamLeader:first_name,last_name',
            'costCenter.employeeNightTeamManager:first_name,last_name',
            'costCenter.employeeNightTeamLeader:first_name,last_name',
            'shift',
            'position',
            'job'
        ])
        ->orderBy('birth_date', 'asc')
        ->get();
        return $allEmployees;
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
        ->with([
            'wageProgression' => function($q) use($searchMonth, $searchYear) {
                $q->whereYear('date', $searchYear)->whereMonth('date', $searchMonth);
            },
            'shift',
            'position.wageTitle',
            'job',
            'wageProgressionWageTitle',
            'costCenter.employeeDayTeamManager:first_name,last_name',
            'costCenter.employeeDayTeamLeader:first_name,last_name',
            'costCenter.employeeNightTeamManager:first_name,last_name',
            'costCenter.employeeNightTeamLeader:first_name,last_name',
        ])
        ->whereHas('wageProgression', function($q) use($searchMonth, $searchYear) {
            $q->whereYear('date', $searchYear)->whereMonth('date', $searchMonth);
        })
        ->orderBy('last_name', 'asc')
        ->get();

        return $employees;
    }

    protected function getEmployeeCostCenterAll()
    {
        $costCenters = CostCenter::with([
            'employeeStaffManager',
            'employeeDayTeamManager',
            'employeeNightTeamManager',
            'employeeDayTeamLeader',
            'employeeNightTeamLeader',
            'employee.job',
            'employee.position'
        ])
        ->orderBy('number', 'asc')
        ->orderBy('extension', 'asc')
        ->get();
        return $costCenters;
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
        ->with([
            'disciplinary' => function($q) use($today, $oneYear) {
                $q->whereDate('date', '<=' ,$today)->whereDate('date', '>=', $oneYear);
            },
            'costCenter.employeeDayTeamManager:first_name,last_name',
            'costCenter.employeeDayTeamLeader:first_name,last_name',
            'costCenter.employeeNightTeamManager:first_name,last_name',
            'costCenter.employeeNightTeamLeader:first_name,last_name',
            'shift',
            'position'
        ])
        ->whereHas('disciplinary', function($q) use($today, $oneYear) {
            $q->whereDate('date', '<=' ,$today)->whereDate('date', '>=', $oneYear);
        })
        ->orderBy('last_name', 'asc')
        ->orderBy('first_name', 'asc')
        ->get();
        return $employees;
    }

    protected function getDisciplinaryIssuedBy($employee)
    {
            foreach($employee->disciplinary as $employeeDisciplinary){
                $issuedBy = Employee::find($employeeDisciplinary->issued_by);
                $employeeDisciplinary->issued_by_name = $issuedBy->first_name.' '.$issuedBy->last_name;
            }
        return $employee;
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
        ->with([
            'costCenter.employeeDayTeamManager:first_name,last_name',
            'costCenter.employeeDayTeamLeader:first_name,last_name',
            'costCenter.employeeNightTeamManager:first_name,last_name',
            'costCenter.employeeNightTeamLeader:first_name,last_name',
            'shift'
        ])
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

    protected function getEmployeeTurnover($searchJob, $startDate, $endDate)
    {
        $employees = Employee::select(
            'id',
            'first_name',
            'last_name',
            'hire_date',
            'status'
        )
        ->whereHas('job', function($q) use($searchJob) {
            $q->where('description', $searchJob);
        })
        ->whereHas('termination', function($q) use($startDate, $endDate) {
            $q->whereDate('date', '<=', $endDate)->whereDate('date', '>=', $startDate);
        })
        ->with([
            'termination' => function($q) use($startDate, $endDate) {
                $q->whereDate('date', '<=', $endDate)->whereDate('date', '>=', $startDate);
            },
            'costCenter'
        ])
        ->orderBy('last_name', 'asc')
        ->orderBy('first_name', 'asc')
        ->get();
        return $employees;
    }

    protected function getEmployeeHireDate($searchJob, $startDate, $endDate)
    {
        $employees = Employee::select(
            'id',
            'first_name',
            'last_name',
            'hire_date',
            'status'
        )->whereHas('job', function($q) use($searchJob) {
            $q->where('description', $searchJob);
        })->whereDate('hire_date', '<=', $endDate)
        ->whereDate('hire_date', '>=', $startDate)
        ->with([
            'costCenter.employeeDayTeamManager:first_name,last_name',
            'costCenter.employeeDayTeamLeader:first_name,last_name',
            'costCenter.employeeNightTeamManager:first_name,last_name',
            'costCenter.employeeNightTeamLeader:first_name,last_name',
            'shift'
        ])
        ->orderBy('hire_date', 'asc')
        ->get();
        return $employees;
    }

    protected function getEmployeeBonusHours()
    {
        // Get todays date
        $today = Carbon::now();
        // Get the first day of the previous quarter
        $firstDayOfPreviousQuarter = $today->copy()->subQuarter()->firstOfQuarter();
        // Get the last day of the previous quarter
        $lastDayOfPreviousQuarter = $today->copy()->subQuarter()->lastOfQuarter()->endOfDay();
        // Get 5 year hire date from last day of previous quarter
        $fiveYearHireDate = $firstDayOfPreviousQuarter->copy()->subYears(5);
        // Get85 year hire date from last day of previous quarter
        $eightYearHireDate = $firstDayOfPreviousQuarter->copy()->subYears(8);

        $employees = Employee::select(
            'id',
            'first_name',
            'middle_initial',
            'last_name',
            'hire_date'
        )->where('status', 1)
        ->whereDate('hire_date', '<', $fiveYearHireDate)
        ->whereHas('job', function($q) {
            $q->where('description', 'hourly');
        })->with([
            'disciplinary' => function($q) use($firstDayOfPreviousQuarter,  $lastDayOfPreviousQuarter) {
                $q->whereDate('date', '<=', $lastDayOfPreviousQuarter)->whereDate('date', '>=', $firstDayOfPreviousQuarter);
            },
            'costCenter.employeeDayTeamManager:first_name,last_name',
            'costCenter.employeeDayTeamLeader:first_name,last_name',
            'costCenter.employeeNightTeamManager:first_name,last_name',
            'costCenter.employeeNightTeamLeader:first_name,last_name',
            'shift'
        ])
        ->orderBy('hire_date', 'desc')
        ->get();
        foreach($employees as $employee){
            if($employee->hire_date <= $eightYearHireDate){
                $employee->bonus_years = 8;
            }else{
                $employee->bonus_years = 5;
            }
        }
        return $employees;
    }

    protected function getTeamLeaderEmployees($id, $tlShift)
    {
        if($tlShift === 1){
            $ccShift = 'employeeDayTeamLeader';
            $employeeShift = 'day';
        }elseif($tlShift === 2){
            $ccShift =  'employeeNightTeamLeader';
            $employeeShift = 'night';
        }else{
            $ccShift = 'employeeDayTeamLeader';
            $employeeShift = 'day';
        }

        $costCenters = CostCenter::whereHas($ccShift, function($q) use($id) {
            $q->where('employee_id', $id);
        })
        ->with([
            'employee' => function($q) use($employeeShift) {
                $q->whereHas('shift', function($q) use($employeeShift) {
                    $q->where('description', $employeeShift);
                });
            },
            'employee.shift',
            'employee.job',
            'employee.position'
        ])
        ->get();

        return $costCenters;
    }

}

