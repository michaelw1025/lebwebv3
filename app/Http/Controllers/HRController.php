<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\CostCenter;
use App\Traits\HelperFunctions;

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

}
