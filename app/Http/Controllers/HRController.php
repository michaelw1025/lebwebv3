<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

// Models
use App\Employee;

// Traits
use App\Traits\SupervisorTrait;
use App\Traits\QueryTrait;

// Requests
use App\Http\Requests\SearchEmployeeAnniversaryByMonth;
use App\HTTP\Requests\SearchEmployeeAnniversaryByQuarter;

class HRController extends Controller
{   
    use SupervisorTrait;
    use QueryTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        return view('hr.index');
    }

    public function employeeAlphabeticalHourly(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all hourlyl employees from query trait
        $employees = $this->getEmployeeAlphabeticalHourly($request);
        // Get employee supervisors from helper file
        $employees = $this->getEmployeeSupervisors($employees);
        return view('hr.queries.employee-alphabetical-hourly', [
            'employees' => $employees
        ]);
    }

    public function employeeAnniversaryByMonth(SearchEmployeeAnniversaryByMonth $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);

        // Check if search form is being submitted
        if($request->has('anniversary_month') && $request->has('anniversary_year')){
            // Set month and year from request
            $searchMonth = (int)$request->anniversary_month;
            $searchYear = (int)$request->anniversary_year;
            // Get employees from query trait
            $employees = $this->getEmployeeAnniversaryByMonth($searchMonth, $searchYear);
            // Get employee supervisors from helper file
            $employees = $this->getEmployeeSupervisors($employees);

            return view('hr.queries.employee-anniversary-by-month', [
                'employees' => $employees,
                'month' => $searchMonth,
                'year' => $searchYear
            ]);
        }else{
            // If search is not submitted give a blank form
            return view('hr.queries.employee-anniversary-by-month');
        }
    }

    public function employeeAnniversaryByQuarter(SearchEmployeeAnniversaryByQuarter $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);

        // Check if search form is being submitted
        if($request->has('anniversary_quarter') && $request->has('anniversary_year')){
            // Set quarter and year from request
            $searchQuarter = (int)$request->anniversary_quarter;
            $searchYear = (int)$request->anniversary_year;
            // Get employees from query trait
            $employees = $this->getEmployeeAnniversaryByQuarter($searchQuarter, $searchYear);
            // Get employee supervisors from helper file
            $employees = $this->getEmployeeSupervisors($employees);

            return view('hr.queries.employee-anniversary-by-quarter', [
                'employees' => $employees,
                'quarter' => $searchQuarter,
                'year' => $searchYear
            ]);
        }else{
            // If search is not submitted give a blank form
            return view('hr.queries.employee-anniversary-by-quarter');
        }
    }

    public function employeeSeniority(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employees = Employee::where('status', 1)->with(['job', 'shift', 'position'
        ])->orderBy('hire_date',  'asc')->get();
        // Get employee supervisors from helper file
        $this->getEmployeeSupervisors($employees);
        return view('hr.queries.employee-seniority', [
            'employees' => $employees
        ]);
    }

}
