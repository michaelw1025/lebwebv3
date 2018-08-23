<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SearchEmployeeAnniversary;
use App\Employee;
use App\Traits\HelperFunctions;
use Carbon\Carbon;

class HRController extends Controller
{   
    use HelperFunctions; 

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
        $employees = Employee::where('status', 1)->whereHas('job', function($q) {
            $q->where('description', 'hourly');
        })->with(['shift', 'position'
        ])->orderBy('last_name',  'asc')->orderBy('first_name', 'asc')->get();
        // Get employee supervisors from helper file
        $this->getEmployeeSupervisors($employees);
        return view('hr.queries.employee-alphabetical-hourly', [
            'employees' => $employees
        ]);
    }

    public function employeeAnniversaryCombined(SearchEmployeeAnniversary $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get the current time
        $timeNow = Carbon::now();
        // Check if search form is being submitted
        if($request->has('anniversary_month') && $request->has('anniversary_year')){
            // If search is submitted set time base on month and year
            $searchMonth = (int)$request->anniversary_month;
            $searchYear = (int)$request->anniversary_year;
            $searchDate = Carbon::create($searchYear, $searchMonth, 1, 0);

            // Get all active employoees with a service date month equal to the search month
            $allEmployees = Employee::where('status', 1)->whereMonth('service_date', $searchMonth)->orderBy('service_date', 'dsc')->get();

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

            // $employeeArray = $filteredEmployees->toJson();
            // return $employeeArray;

            return view('hr.queries.employee-anniversary-combined', [
                'employees' => $filteredEmployees,
                'month' => $searchMonth,
                'year' => $searchYear
            ]);
        }else{
            // If search is not submitted give a blank form
            return view('hr.queries.employee-anniversary-combined');
        }
    }

}
