<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Traits\HelperFunctions;
use App\Http\Requests\StoreEmployee;
use Illuminate\Support\Facades\Storage;
use App\CostCenter;
use App\Shift;

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
        // Return the employees view
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
        // Get all cost centers
        $costCenters = CostCenter::orderBy('number', 'asc')->orderBy('extension', 'asc')->get();
        // Get all shifts
        $shifts = Shift::all();
        // Return the create employee view
        return view('hr.employee.employee-create', [
            'costCenters' => $costCenters,
            'shifts' => $shifts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployee $request)
    {
        // return $request;
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        // Create a new employee object
        $employee = new Employee();
        // Assign values to employee object
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->middle_initial = $request->middle_initial;
        $employee->maiden_name = $request->maiden_name;
        $employee->nick_name = $request->nick_name;
        $employee->suffix = $request->suffix;
        $employee->ssn = $request->ssn;
        $employee->gender = $request->gender;
        $employee->oracle_number = $request->oracle_number;
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
        // Check if an image is being uploaded
        if($request->hasFile('photo_link')){
            // Store the photo in the public directory
            $path = $request->file('photo_link')->store('public');
            // Get the file name
            $employee->photo_link = $request->file('photo_link')->hashName();
            
        }
        // Save employee
        if($employee->save()) {
            // Sync cost center
            $employee->costCenter()->sync([$request->cost_center]);
            // Sync shift
            $employee->shift()->sync([$request->shift]);
            // If the save was successful
            \Session::flash('status', 'Employee created successfully.');
            // Return the show employee view
            return redirect()->route('employees.show', ['id' => $employee->id]);
        } else {
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while creating the employee.  Please contact support for help.');
            // Return back to the create employee view
            return redirect()->back()->withInput();
        }
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
        $employee = Employee::with(
            'costCenter.employeeStaffManager',
            'costCenter.employeeDayTeamManager',
            'costCenter.employeeNightTeamManager',
            'costCenter.employeeDayTeamLeader',
            'costCenter.employeeNightTeamLeader',
            'shift'
        )->findOrFail($id);
        // Get the full name of the state
        $this->checkState($employee);
        // return $employee;
        // Return the show employee view
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
        // Get employee to edit
        $employee = Employee::with('costCenter')->findOrFail($id);
        // Get the full name of the state
        $this->checkState($employee);
        // Get all cost centers
        $costCenters = CostCenter::orderBy('number', 'asc')->orderBy('extension', 'asc')->get();
        // Get all shifts
        $shifts = Shift::all();
        // Return the edit employee view
        return view('hr.employee.employee-edit', [
            'employee' => $employee,
            'costCenters' => $costCenters,
            'shifts' => $shifts
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

        // return $request;

        // Get the employee to update
        $employee = Employee::findOrFail($id);
        // Set values for the employee
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->middle_initial = $request->middle_initial;
        $employee->maiden_name = $request->maiden_name;
        $employee->nick_name = $request->nick_name;
        $employee->suffix = $request->suffix;
        $employee->ssn = $request->ssn;
        $employee->gender = $request->gender;
        $employee->oracle_number = $request->oracle_number;
        $employee->birth_date = $request->birth_date;
        $employee->hire_date = $request->hire_date;
        $employee->service_date = $request->service_date;
        $employee->address_1 = $request->address_1;
        $employee->address_2 = $request->address_2;
        $employee->city = $request->city;
        $employee->state = $request->state;
        $employee->zip_code = $request->zip_code;
        $employee->county = $request->county;
        $employee->status = $request->status;
        $employee->rehire = $request->rehire;
        $employee->bid_eligible = 1;
        $employee->bid_eligible_date = $request->hire_date;
        // Check if a thirty day review is being set
        if($request->has('thirty_day_review')) {
            $employee->thirty_day_review = 1;
        } else {
            $employee->thirty_day_review = 0;
        }
        // Check if a sixty day review is being set
        if($request->has('sixty_day_review')) {
            $employee->sixty_day_review = 1;
        } else {
            $employee->sixty_day_review = 0;
        }
        // Check if the employee photo is being deleted or updated
        if($request->has('delete_photo_link')) {  // If employee photo is being deleted
            // Delete the photo from the public directory
            \Storage::disk('public')->delete($employee->photo_link);
            // Set the photo link for the employee to null
            $employee->photo_link = null;            
        } elseif ($request->hasFile('photo_link')) {  // If the employee photo is being updated
            // Delete the current photo from the public directory
            \Storage::disk('public')->delete($employee->photo_link);
            // Store the new photo in the public directory
            $path = $request->file('photo_link')->store('public');
            // Set the employee photo link to the new photo name
            $employee->photo_link = $request->file('photo_link')->hashName();
        }

        // return $request;

        // Save employee
        if($employee->save()) {
            // Sync cost center
            $employee->costCenter()->sync([$request->cost_center]);
            // Sync shift
            $employee->shift()->sync([$request->shift]);
            // If the save was successful
            \Session::flash('status', 'Employee updated successfully.');
            // Return the show employee view
            return redirect()->route('employees.show', ['id' => $employee->id]);
        } else {
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while updating the employee.  Please contact support for help.');
            // Return back to the edit employee view
            return redirect()->back()->withInput();
        }
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
        // Do not delete employees, set as inactive instead
    }
}
