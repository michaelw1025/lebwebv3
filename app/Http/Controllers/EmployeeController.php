<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Traits\HelperFunctions;
use App\Http\Requests\StoreEmployee;

class EmployeeController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        if($request->input('type') === 'active') {
            // Set for active employees
            $statusType = 1;
        }elseif($request->input('type') === 'inactive') {
            // Set for inactive employees
            $statusType = 0;
        }else{
            // Default to active
            $statusType = 1;
        }
        // Get requested employees
        $employees = Employee::where('status', $statusType)->orderBy('last_name', 'asc')->get();
        return view('hr.employee.employees', [
            'employees' => $employees,
            'statusType' => $statusType
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        return view('hr.employee.employee-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);

        // if($request->hasFile('photo_link')){
        //     $path = $request->file('photo_link')->store('public');
        //     $link = $request->file('photo_link')->hashName();
            
        // }else{
        //     return('none');
        // }

        return $request;

        $employee - new Employee();
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->middle_initial = $request->middle_initial;
        $employee->maiden_name = $reqeust->maiden_name;
        $employee->nick_name = $request->nick_name;
        $employee->suffix = $request->suffix;
        $employee->ssn = $request->ssn;
        $employee->gender = $request->gender;
        $employee->oracle_number = $reqeust->oracle_number;
        $employee->birth_date = $request->birth_date;
        $employee->hire_date = $request->hire_date;
        $employee->service_date = $request->service_date;
        $employee->address_1 = $request->address_1;
        $employee->address_2 = $request->address_2;
        $employee->city = $request->city;
        $employee->state = $request->state;
        $employee->zip_code = $request->zip_code;
        $employee->county = $request->county;
        $employee->status = 1;
        $employee->rehire = 1;
        $employee->bid_eligible = 1;
        $employee->bid_eligible_date = $request->hire_date;
        $employee->thirty_day_review = 0;
        $employee->sixty_day_review = 0;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        // Get employee
        $employee = Employee::findOrFail($id);
        $this->checkState($employee);
        return view('hr.employee.employee-show', [
            'employee' => $employee
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        // Get employee
        $employee = Employee::findOrFail($id);
        return view('hr.employee.employee-edit', [
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEmployee $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);

        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
    }
}
