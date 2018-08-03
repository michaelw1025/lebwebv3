<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Traits\HelperFunctions;
use App\Http\Requests\StoreEmployee;
use Illuminate\Support\Facades\Storage;
use App\CostCenter;
use App\Shift;
use App\Position;
use App\Job;
use App\PhoneNumber;

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
        // Get all positions
        $positions = Position::all();
        // Get all jobs
        $jobs = Job::all();
        // Return the create employee view
        return view('hr.employee.employee-create', [
            'costCenters' => $costCenters,
            'shifts' => $shifts,
            'positions' => $positions,
            'jobs' => $jobs
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
            // Sync position
            $employee->position()->sync([$request->position]);
            // Sync job
            $employee->job()->sync([$request->job]);
            // Check if any phone numbers are in the request
            if($request->has('phone_number')){
                // Cycle through each phone number
                foreach($request->phone_number as $requestPhoneNumber) {
                    if($requestPhoneNumber['number'] !== null) {  // If the phone number is being added
                        $newPhoneNumber = new PhoneNumber();
                        $newPhoneNumber->number = $requestPhoneNumber['number'];
                        // Check if this phone number is set as primary
                        if($request->phone_number_is_primary === $requestPhoneNumber['number']) {  // If it is primary
                            $newPhoneNumber->is_primary = 1;
                        } else {  // If it is not primary
                            $newPhoneNumber->is_primary = 0;
                        }
                        $employee->phoneNumber()->save($newPhoneNumber);
                    } 
                }
            }
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
            'shift',
            'position',
            'job',
            'phoneNumber'
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
        // Get all positions
        $positions = Position::all();
        // Get all jobs
        $jobs = Job::all();
        // Return the edit employee view
        return view('hr.employee.employee-edit', [
            'employee' => $employee,
            'costCenters' => $costCenters,
            'shifts' => $shifts,
            'positions' => $positions,
            'jobs' => $jobs
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
        // Save employee
        if($employee->save()) {
            // Sync cost center
            $employee->costCenter()->sync([$request->cost_center]);
            // Sync shift
            $employee->shift()->sync([$request->shift]);
            // Sync position
            $employee->position()->sync([$request->position]);
            // Sync job
            $employee->job()->sync([$request->job]);
            // Save phone numbers
            // Check if any phone numbers are in the request
            if($request->has('phone_number')){
                // Cycle through each phone number
                foreach($request->phone_number as $requestPhoneNumber) {
                    // Check if the phone number is being deleted, added, or updated
                    if(in_array('delete', $requestPhoneNumber)) {  // If phone number is being deleted
                        // Check if the phone number is in the database by checking if an id was sent with the request
                        if($requestPhoneNumber['id'] !== null) {  // If an id was given
                            // Get the phone number to delete
                            $employee->phoneNumber()->where('id', $requestPhoneNumber['id'])->delete();
                        }
                    } elseif($requestPhoneNumber['id'] === null && $requestPhoneNumber['number'] !== null) {  // If the phone number is being added
                        $newPhoneNumber = new PhoneNumber();
                        $newPhoneNumber->number = $requestPhoneNumber['number'];
                        // Check if this phone number is set as primary
                        if($request->phone_number_is_primary === $requestPhoneNumber['number']) {  // If it is primary
                            $newPhoneNumber->is_primary = 1;
                        } else {  // If it is not primary
                            $newPhoneNumber->is_primary = 0;
                        }
                        $employee->phoneNumber()->save($newPhoneNumber);
                    } elseif($requestPhoneNumber['id'] !== null) {  // If the phone number is being updated
                        // Update the phone number
                        $updatePhoneNumber = PhoneNumber::find($requestPhoneNumber['id']);
                        $updatePhoneNumber->number = $requestPhoneNumber['number'];
                        // Check if this phone number is set as primary
                        if($request->phone_number_is_primary === $requestPhoneNumber['number']) {  // If it is primary
                            $updatePhoneNumber->is_primary = 1;
                        } else {  // If it is not primary
                            $updatePhoneNumber->is_primary = 0;
                        }
                        $employee->phoneNumber()->save($updatePhoneNumber);
                    }
                }
            }
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
