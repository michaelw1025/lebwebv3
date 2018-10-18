<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Disciplinary;
use App\CostCenter;
use App\Employee;

// Traits
use App\Traits\DisciplinaryTrait;
use App\Traits\SupervisorTrait;

// Requests
use App\Http\Requests\StoreDisciplinary;

class DisciplinaryController extends Controller
{
    use DisciplinaryTrait;
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
    public function index()
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Not used, disciplinaries are shown through the employee controller using the employee-disciplinary relationship
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
        // Get the employee for the request
        $employee = Employee::findOrFail($request->input('employee'));
        // Get all cost centers
        $costCenters = CostCenter::orderBy('number', 'asc')->orderBy('extension', 'asc')->get();
        // Get all salary employees including OS's from supervisor trait
        $salariedEmployees = $this->getSalariedWithOS();
        return view('employee.disciplinary.disciplinary-create', [
            'costCenters' => $costCenters,
            'salariedEmployees' => $salariedEmployees,
            'employee' => $employee
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDisciplinary $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get the employee for the request
        $employee = Employee::findOrFail($request->input('employee'));
        // Create new disciplinary object
        $disciplinary = new Disciplinary();
        // Set disciplinary attributes
        $disciplinary->type = $request->type;
        $disciplinary->level = $request->level;
        $disciplinary->date = $request->date;
        $disciplinary->cost_center = $request->cost_center;
        $disciplinary->issued_by = $request->issued_by;
        $disciplinary->comments = $request->comments;
        // Save disciplinary
        if($employee->disciplinary()->save($disciplinary)) {
            // If the save was successful
            \Session::flash('status', 'Employee disciplinary created successfully.');
            if($request->has('add_another')){
                // Return to the create disciplinary view
                return redirect()->route('disciplinaries.create', ['employee' => $employee->id]);
            }else{
                // Return the show disciplinary view
                return redirect()->route('disciplinaries.show', ['id' => $disciplinary->id]);
            }
            // Return the show disciplinary view
            return redirect()->route('disciplinaries.show', ['id' => $disciplinary->id]);
        } else {
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while creating the employee disciplinary.  Please contact support for help.');
            // Return back to the create disciplinary view
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
        // Get the requested disciplinary
        $disciplinary = Disciplinary::with('employee')->findOrFail($id);
        // Set disciplinary info
        $this->getDisciplinaryInfo($disciplinary);
        return view('employee.disciplinary.disciplinary-show', [
            'disciplinary' => $disciplinary
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
        $disciplinary = Disciplinary::findOrFail($id);
        $this->getDisciplinaryInfo($disciplinary);
        // Get all cost centers
        $costCenters = CostCenter::orderBy('number', 'asc')->orderBy('extension', 'asc')->get();
        // Get all salary employees including OS's from supervisor trait
        $salariedEmployees = $this->getSalariedWithOS();
        return view('employee.disciplinary.disciplinary-edit', [
            'disciplinary' => $disciplinary,
            'costCenters' => $costCenters,
            'salariedEmployees' =>  $salariedEmployees
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDisciplinary $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get the disciplinary to update
        $disciplinary = Disciplinary::findOrFail($id);
        // Set disciplinary attributes
        $disciplinary->type = $request->type;
        $disciplinary->level = $request->level;
        $disciplinary->date = $request->date;
        $disciplinary->cost_center = $request->cost_center;
        $disciplinary->issued_by = $request->issued_by;
        $disciplinary->comments = $request->comments;
        // Save disciplinary
        if($disciplinary->save()) {
            // If the save was successful
            \Session::flash('status', 'Employee disciplinary updated successfully.');
            // Return the show disciplinary view
            return redirect()->route('disciplinaries.show', ['id' => $disciplinary->id]);
        } else {
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while updating the employee disciplinary.  Please contact support for help.');
            // Return back to the edit disciplinary view
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get the disciplinary to delete
        $disciplinary = Disciplinary::findOrFail($id);
        // Delete the disciplinary
        if($disciplinary->delete()) {
            // If the delete was successful
            \Session::flash('status', 'Employee disciplinary deleted successfully.');
            // Return the show employee view
            return redirect()->route('employees.show', ['id' => $request->input('employee')]);
        } else {
            // If the delete was unsuccessful
            \Session::flash('error', 'An error occurred while deleting the employee disciplinary.  Please contact support for help.');
            // Return back to the edit disciplinary view
            return redirect()->back()->withInput();
        }
    }
}
