<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Termination;
use App\Employee;

// Traits

// Requests
use App\Http\Requests\StoreTermination;

class TerminationController extends Controller
{
    

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
        // Not used, terminations are shown on the show employee page
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
        return view('employee.termination.termination-create', [
            'employee' => $employee
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTermination $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get the employee for the request
        $employee = Employee::findOrFail($request->input('employee'));
        // Create a new termination object
        $termination = new Termination();
        // Set termination attributes
        $termination->type = $request->type;
        $termination->date = $request->date;
        $termination->last_day = $request->last_day;
        $termination->comments = $request->comments;
        // Save termination
        if($employee->termination()->save($termination)) {
            // If the save was successful
            \Session::flash('status', 'Employee termination created successfully.');
            // Return the show termination view
            return redirect()->route('terminations.show', ['id' => $termination->id]);
        } else {
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while creating the employee termination.  Please contact support for help.');
            // Return back to the create termination view
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
        $termination = Termination::with('employee')->findOrFail($id);
        return view('employee.termination.termination-show', [
            'termination' => $termination
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
        $termination = Termination::with('employee')->findOrFail($id);
        return view('employee.termination.termination-edit', [
            'termination' => $termination
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTermination $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get the termination to update
        $termination = Termination::findOrFail($id);
        // Set termination attributes
        $termination->type = $request->type;
        $termination->date = $request->date;
        $termination->last_day = $request->last_day;
        $termination->comments = $request->comments;
        // Save termination
        if($termination->save()) {
            // If the save was successful
            \Session::flash('status', 'Employee termination updated successfully.');
            // Return the show termination view
            return redirect()->route('terminations.show', ['id' => $termination->id]);
        } else {
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while updating the employee termination.  Please contact support for help.');
            // Return back to the edit termination view
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
        // Get the termination to delete
        $termination = Termination::findOrFail($id);
        // Delete the termination
        if($termination->delete()) {
            // If the delete was successful
            \Session::flash('status', 'Employee termination deleted successfully.');
            // Return the show employee view
            return redirect()->route('employees.show', ['id' => $request->input('employee')]);
        } else {
            // If the delete was unsuccessful
            \Session::flash('error', 'An error occurred while deleting the employee termination.  Please contact support for help.');
            // Return back to the edit termination view
            return redirect()->back()->withInput();
        }
    }
}
