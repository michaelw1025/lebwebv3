<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use carbon\Carbon;
use Excel;

// Traits
use App\Traits\QueryTrait;
use App\Traits\SupervisorTrait;

// Exports
use App\Exports\ExportEmployeeAlphabeticalHourly;
use App\Exports\ExportEmployeeAnniversaryByMonth;
use App\Exports\ExportEmployeeAnniversaryByQuarter;

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
        // Get all hourlyl employees from query trait
        $employees = $this->getEmployeeAlphabeticalHourly($request);
        // Get employee supervisors from helper file
        $employees = $this->getEmployeeSupervisors($employees);
        // Set the employee info for the export
        $employees = $this->setEmployeeAlphabeticalExportInfo($employees);
        return (new ExportEmployeeAlphabeticalHourly($employees))->download('employees-alphabetical-hourly-'.Carbon::now()->format('m-d-Y').'.xlsx');
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
        // Get employee supervisors from helper file
        $employees = $this->getEmployeeSupervisors($employees);
        // Set the employee info for the export
        $employees = $this->setEmployeeAnniversaryExportInfo($employees);
        // Return the export
        return (new ExportEmployeeAnniversaryByMonth($employees))->download('employees-anniversary-by-month-'.Carbon::now()->format('m-d-Y').'.xlsx');

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
        // Get employee supervisors from helper file
        $employees = $this->getEmployeeSupervisors($employees);
        // Set the employee info for the export
        $employees = $this->setEmployeeAnniversaryExportInfo($employees);
        // Return the export
        return (new ExportEmployeeAnniversaryByQuarter($employees))->download('employees-anniversary-by-quarter-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }
}
