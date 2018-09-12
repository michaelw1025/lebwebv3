<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Notifications\EmployeeCreated;
use Notification;


// Models
use App\CostCenter;
use App\Shift;
use App\Position;
use App\Job;
use App\PhoneNumber;
use App\EmergencyContact;
use App\User;
use App\WageTitle;
use App\WageProgression;
use App\Employee;

// Traits
use App\Traits\DateTrait;
use App\Traits\StateTrait;
use App\Traits\DisciplinaryTrait;
use App\Traits\WageTrait;
use App\Traits\SupervisorTrait;

// Requests
use App\Http\Requests\StoreEmployee;

class EmployeeController extends Controller
{
    use DateTrait;
    use StateTrait;
    use DisciplinaryTrait;
    use WageTrait;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
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
        return view('employee.employees', [
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
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all cost centers
        $costCenters = CostCenter::orderBy('number', 'asc')->orderBy('extension', 'asc')->get();
        // Get all shifts
        $shifts = Shift::all();
        // Get all positions
        $positions = Position::orderBy('description', 'asc')->get();
        // Get all jobs
        $jobs = Job::all();
        // Get all wage titles with their progressions
        $wageTitles = WageTitle::with('wageProgression')->get();
        // Get all wage progressions
        $wageProgressions = WageProgression::orderBy('month', 'asc')->get();
        // Return the create employee view
        return view('employee.employee-create', [
            'costCenters' => $costCenters,
            'shifts' => $shifts,
            'positions' => $positions,
            'jobs' => $jobs,
            'wageTitles' => $wageTitles,
            'wageProgressions' => $wageProgressions
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
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
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
            // Check if any emergency contacts are in the request
            if($request->has('emergency_contact')){
                // Cycle through each emergency contact
                foreach($request->emergency_contact as $requestEmergencyContact) {
                    if($requestEmergencyContact['number'] !== null) {  // If the emergency contact is being added
                        $newEmergencyContact = new EmergencyContact();
                        $newEmergencyContact->number = $requestEmergencyContact['number'];
                        $newEmergencyContact->name = $requestEmergencyContact['name'];
                        // Check if this emergency contact is set as primary
                        if($request->emergency_contact_is_primary === $requestEmergencyContact['number']) {  // If it is primary
                            $newEmergencyContact->is_primary = 1;
                        } else {  // If it is not primary
                            $newEmergencyContact->is_primary = 0;
                        }
                        $employee->emergencyContact()->save($newEmergencyContact);
                    } 
                }
            }
            // Save wage info
            // Sync WageProgressionWageTitle for current wage
            $employee->wageProgressionWageTitle()->sync($request->current_wage);
            // Save wage progression event dates
            $eventsArray = array();
            foreach($request->progression_event as $event) {
                if($event['date'] != null) {
                    $eventDate = $this->setAsDate($event['date']);
                    $eventsArray[$event['id']] = (['date' => $eventDate]);
                }
            }
            $employee->wageProgression()->sync($eventsArray);
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
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get employee
        $employee = Employee::with(
            // 'costCenter.employeeStaffManager',
            // 'costCenter.employeeDayTeamManager',
            // 'costCenter.employeeNightTeamManager',
            // 'costCenter.employeeDayTeamLeader',
            // 'costCenter.employeeNightTeamLeader',
            'shift',
            'position.wageTitle.wageProgression',
            'job',
            'phoneNumber',
            'emergencyContact',
            'disciplinary',
            'termination',
            'reduction',
            'wageProgression',
            'wageProgressionWageTitle'
        )->findOrFail($id);
        // Get employee supervisors from supervisor trait
        $employee = $this->getEmployeeSupervisors($employee);
        // Get the full name of the state
        $this->checkState($employee);
        // Get disciplinary info
        foreach($employee->disciplinary as $disciplinary){
            $this->getDisciplinaryInfo($disciplinary);
        }
        // Convert wage event dates from string to date
        $this->setWageEventDate($employee);
        // Return the show employee view
        return view('employee.employee-show', [
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
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get employee to edit
        $employee = Employee::with(
            'shift',
            'position.wageTitle.wageProgression',
            'job',
            'phoneNumber',
            'emergencyContact',
            'disciplinary', 
            'termination',
            'reduction',
            'wageProgression',
            'wageProgressionWageTitle'
        )->findOrFail($id);
        // Get employee supervisors from supervisor trait
        $employee = $this->getEmployeeSupervisors($employee);
        // Get the full name of the state
        $this->checkState($employee);
        // Get all cost centers
        $costCenters = CostCenter::orderBy('number', 'asc')->orderBy('extension', 'asc')->get();
        // Get all shifts
        $shifts = Shift::all();
        // Get all positions
        $positions = Position::orderBy('description', 'asc')->get();
        // Get all jobs
        $jobs = Job::all();
        // Get disciplinary info
        foreach($employee->disciplinary as $disciplinary){
            $this->getDisciplinaryInfo($disciplinary);
        }
        // Convert wage event dates from string to date
        $this->setWageEventDate($employee);
        // Get all wage titles with their progressions
        $wageTitles = WageTitle::with('wageProgression')->get();
        // Get all wage progressions
        $wageProgressions = WageProgression::orderBy('month', 'asc')->get();
        // Set the employees current wage info
        foreach($employee->wageProgressionWageTitle as $currentWage){
            $employee->current_wage = $currentWage->id;
        }
        // return $wageTitles;
        // Return the edit employee view
        return view('employee.employee-edit', [
            'employee' => $employee,
            'costCenters' => $costCenters,
            'shifts' => $shifts,
            'positions' => $positions,
            'jobs' => $jobs,
            'wageTitles' => $wageTitles,
            'wageProgressions' => $wageProgressions
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
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);

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
            // Save emergency contacts
            // Check if any emergency contacts are in the request
            if($request->has('emergency_contact')){
                // Cycle through each emergency contact
                foreach($request->emergency_contact as $requestEmergencyContact) {
                    // Check if the emergency contact is being deleted, added, or updated
                    if(in_array('delete', $requestEmergencyContact)) {  // If emergency contact is being deleted
                        // Check if the emergency contact is in the database by checking if an id was sent with the request
                        if($requestEmergencyContact['id'] !== null) {  // If an id was given
                            // Get the emergency contact to delete
                            $employee->emergencyContact()->where('id', $requestEmergencyContact['id'])->delete();
                        }
                    } elseif($requestEmergencyContact['id'] === null && $requestEmergencyContact['number'] !== null) {  // If the emergency contact is being added
                        $newEmergencyContact = new EmergencyContact();
                        $newEmergencyContact->number = $requestEmergencyContact['number'];
                        $newEmergencyContact->name = $requestEmergencyContact['name'];
                        // Check if this emergency contact is set as primary
                        if($request->emergency_contact_is_primary === $requestEmergencyContact['number']) {  // If it is primary
                            $newEmergencyContact->is_primary = 1;
                        } else {  // If it is not primary
                            $newEmergencyContact->is_primary = 0;
                        }
                        $employee->emergencyContact()->save($newEmergencyContact);
                    } elseif($requestEmergencyContact['id'] !== null) {  // If the emergency contact is being updated
                        // Update the emergency contact
                        $updateEmergencyContact = EmergencyContact::find($requestEmergencyContact['id']);
                        $updateEmergencyContact->number = $requestEmergencyContact['number'];
                        $updateEmergencyContact->name = $requestEmergencyContact['name'];
                        // Check if this emergency contact is set as primary
                        if($request->emergency_contact_is_primary === $requestEmergencyContact['number']) {  // If it is primary
                            $updateEmergencyContact->is_primary = 1;
                        } else {  // If it is not primary
                            $updateEmergencyContact->is_primary = 0;
                        }
                        $employee->emergencyContact()->save($updateEmergencyContact);
                    }
                }
            }
            // Save wage info
            // Sync WageProgressionWageTitle for current wage
            $employee->wageProgressionWageTitle()->sync($request->current_wage);
            // Save wage progression event dates
            $eventsArray = array();
            foreach($request->progression_event as $event) {
                if($event['date'] != null) {
                    $eventDate = $this->setAsDate($event['date']);
                    $eventsArray[$event['id']] = (['date' => $eventDate]);
                }
            }
            $employee->wageProgression()->sync($eventsArray);

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
