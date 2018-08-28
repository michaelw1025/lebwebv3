<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

// Models
use App\Employee;
use App\WageProgression;

// Traits
use App\Traits\SupervisorTrait;
use App\Traits\QueryTrait;
use App\Traits\DateTrait;

// Requests
use App\Http\Requests\SearchEmployeeAnniversaryByMonth;
use App\Http\Requests\SearchEmployeeAnniversaryByQuarter;
use App\Http\Requests\SearchEmployeeBirthday;
use App\Http\Requests\SearchEmployeeWageProgression;

class QueryController extends Controller
{
    use SupervisorTrait;
    use QueryTrait;
    use DateTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function employeeAlphabeticalHourly(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all hourly employees from query trait
        $employees = $this->getEmployeeAlphabetical($request, 'hourly');
        // Get employee supervisors from supervisor trait
        $employees = $this->getEmployeeSupervisors($employees);
        return view('queries.employee-alphabetical-hourly', [
            'employees' => $employees
        ]);
    }

    public function employeeAlphabeticalSalary(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all salary employees from query trait
        $employees = $this->getEmployeeAlphabetical($request, 'salary');
        // Get employee supervisors from supervisor trait
        $employees = $this->getEmployeeSupervisors($employees);
        return view('queries.employee-alphabetical-salary', [
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
            // Get employee supervisors from supervisor trait
            $employees = $this->getEmployeeSupervisors($employees);

            return view('queries.employee-anniversary-by-month', [
                'employees' => $employees,
                'month' => $searchMonth,
                'year' => $searchYear
            ]);
        }else{
            // If search is not submitted give a blank form
            return view('queries.employee-anniversary-by-month');
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
            // Get employee supervisors from supervisor trait
            $employees = $this->getEmployeeSupervisors($employees);
            return view('queries.employee-anniversary-by-quarter', [
                'employees' => $employees,
                'quarter' => $searchQuarter,
                'year' => $searchYear
            ]);
        }else{
            // If search is not submitted give a blank form
            return view('queries.employee-anniversary-by-quarter');
        }
    }

    public function employeeSeniority(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employees = Employee::where('status', 1)->with(['job', 'shift', 'position'
        ])->orderBy('hire_date',  'asc')->get();
        // Get employee supervisors from supervisor trait
        $employees = $this->getEmployeeSupervisors($employees);
        return view('queries.employee-seniority', [
            'employees' => $employees
        ]);
    }

    public function employeeBirthday(SearchEmployeeBirthday $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);

        // Check if search form is being submitted
        if($request->has('birthday_month')){
            // Set month from request
            $searchMonth = (int)$request->birthday_month;
            // Get employees from query trait
            $employees = $this->getEmployeeBirthday($searchMonth);
            // Get employee supervisors from supervisor trait
            $employees = $this->getEmployeeSupervisors($employees);
            
            return view('queries.employee-birthday',[
                'employees' => $employees,
                'month' => $searchMonth 
            ]);
        }else{
            // If search is not submitted give a blank form
            return view('queries.employee-birthday');
        }
    }

    public function employeeWageProgression(SearchEmployeeWageProgression $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);

        // Check if search form is being submitted
        if($request->has('wage_progression_month') && $request->has('wage_progression_year')){
            // Set month and year from request
            $searchMonth = (int)$request->wage_progression_month;
            $searchYear = (int)$request->wage_progression_year;
            // Get employees from query trait
            $employees = $this->getEmployeeWageProgression($searchMonth, $searchYear);
            // Get employee supervisors from supervisor trait
            $employees = $this->getEmployeeSupervisors($employees);
            // Get all wage progressions for table
            $wageProgressions = WageProgression::all();
            // Set progression date as date instance in query trait
            $employees = $this->setEmployeeWageProgressionDateAsDate($employees);
            
            // $employees = $this->setEmployeeWageProgressionExportInfo($employees);
            foreach($employees as $employee){
                foreach($employee->wageProgression as $employeeWageProgression){
                    $nextWage = WageProgressionWageTitle::find($employeeWageProgression->id);
                    
                }
            }
            return $employees;
            return view('queries.employee-wage-progression', [
                'employees' => $employees,
                'month' => $searchMonth,
                'year' => $searchYear,
                'wageProgressions' => $wageProgressions
            ]);
        }else{
            // If search is not submitted give a blank form
            return view('queries.employee-wage-progression');
        }

    }
}
