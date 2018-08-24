<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use carbon\Carbon;
use Excel;

// Traits
use App\Traits\QueryTrait;
use App\Traits\SupervisorTrait;

// Exports
use App\Exports\ExportEmployeeAlphabetical;
use App\Exports\ExportEmployeeAnniversary;
use App\Exports\ExportEmployeeBirthday;

use App\Employee;
class ExportController extends Controller
{
    use QueryTrait;
    use SupervisorTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function exportEmployeeAlphabeticalHourly(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all hourly employees from query trait
        $employees = $this->getEmployeeAlphabetical($request, 'hourly');
        // Get employee supervisors from supervisor trait
        $employees = $this->getEmployeeSupervisors($employees);
        // Set the employee info for the export
        $employees = $this->setEmployeeAlphabeticalExportInfo($employees);
        return (new ExportEmployeeAlphabetical($employees))->download('employees-alphabetical-hourly-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }

    public function exportEmployeeAlphabeticalSalary(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all salary employees from query trait
        $employees = $this->getEmployeeAlphabetical($request, 'salary');
        // Get employee supervisors from supervisor trait
        $employees = $this->getEmployeeSupervisors($employees);
        // Set the employee info for the export
        $employees = $this->setEmployeeAlphabeticalExportInfo($employees);
        return (new ExportEmployeeAlphabetical($employees))->download('employees-alphabetical-salary-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }

    public function exportEmployeeAnniversaryByMonth(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Set month and year from request
        $searchMonth = $request->month;
        $searchYear = $request->year;
        // Get employees from query trait
        $employees = $this->getEmployeeAnniversaryByMonth($searchMonth, $searchYear);
        // Get employee supervisors from supervisor trait
        $employees = $this->getEmployeeSupervisors($employees);
        // Set the employee info for the export
        $employees = $this->setEmployeeAnniversaryExportInfo($employees);
        // Return the export
        return (new ExportEmployeeAnniversary($employees))->download('employees-anniversary-by-month-'.Carbon::now()->format('m-d-Y').'.xlsx');

    }

    public function exportEmployeeAnniversaryByQuarter(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Set quarter and year from request
        $searchQuarter = (int)$request->quarter;
        $searchYear = (int)$request->year;
        // Get employees from query trait
        $employees = $this->getEmployeeAnniversaryByQuarter($searchQuarter, $searchYear);
        // Get employee supervisors from supervisor trait
        $employees = $this->getEmployeeSupervisors($employees);
        // Set the employee info for the export
        $employees = $this->setEmployeeAnniversaryExportInfo($employees);
        // Return the export
        return (new ExportEmployeeAnniversary($employees))->download('employees-anniversary-by-quarter-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }
    public function exportEmployeeBirthday(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Set month from request
        $searchMonth = (int)$request->month;
        // Get employees from query trait
        $employees = $this->getEmployeeBirthday($searchMonth);
        // Get employee supervisors from supervisor trait
        $employees = $this->getEmployeeSupervisors($employees);
        // Set the employee info for the export
        $employees = $this->setEmployeeBirthdayExportInfo($employees);
        // Return the export
        return (new ExportEmployeeBirthday($employees))->download('employees-birthday-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }
}