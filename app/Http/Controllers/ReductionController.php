<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Reduction;
use App\CostCenter;
use App\Shift;
use App\Employee;

// Traits
use App\Traits\ReductionTrait;

// Requests
use App\Http\Requests\StoreReduction;

class ReductionController extends Controller
{
    use ReductionTrait;

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
        // Get all shifts
        $shifts = Shift::all();
        return view('employee.reduction.reduction-create', [
            'costCenters' => $costCenters,
            'shifts' => $shifts,
            'employee' => $employee
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReduction $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get the employee for the request
        $employee = Employee::findOrFail($request->input('employee'));
        // Create a new reduction object
        $reduction = new Reduction();
        // Set the reduction attributes
        $reduction->currently_active = $request->currently_active;
        $reduction->type = $request->type;
        $reduction->displacement = $request->displacement;
        $reduction->date = $request->date;
        $reduction->home_cost_center = $request->home_cost_center;
        if($request->bump_to_cost_center !== null) {
            $reduction->bump_to_cost_center = $request->bump_to_cost_center;
        } else {
            $reduction->bump_to_cost_center = null;
        }
        $reduction->home_shift = $request->home_shift;
        if($request->bump_to_shift !== null) {
            $reduction->bump_to_shift = $request->bump_to_shift;
        } else {
            $reduction->bump_to_shift = null;
        }
        $reduction->fiscal_week = $request->fiscal_week;
        $reduction->fiscal_year = $request->fiscal_year;
        if($request->return_date === null) {
            $reduction->return_date = "01/01/2050";
        } else {
            $reduction->return_date = $request->return_date;
        }
        $reduction->comments = $request->comments;
        // Save reduction
        if($employee->reduction()->save($reduction)) {
            // If the save was successful
            \Session::flash('status', 'Employee reduction created successfully.');
            // Return the show reduction view
            return redirect()->route('reductions.show', ['id' => $reduction->id]);
        } else {
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while creating the employee reduction.  Please contact support for help.');
            // Return back to the create reduction view
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
        // Get the requested reduction
        $reduction = Reduction::with('employee')->findOrFail($id);
        // Get reduction info
        $this->getReductionInfo($reduction);
        return view('employee.reduction.reduction-show', [
            'reduction' => $reduction
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
        // Get the requested reduction
        $reduction = Reduction::with('employee')->findOrFail($id);
        // Get reduction info
        $this->getReductionInfo($reduction);
        // Get all cost centers
        $costCenters = CostCenter::orderBy('number', 'asc')->orderBy('extension', 'asc')->get();
        // Get all shifts
        $shifts = Shift::all();
        return view('employee.reduction.reduction-edit', [
            'reduction' => $reduction,
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
    public function update(StoreReduction $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get the reduction to update
        $reduction = Reduction::findOrFail($id);
        // Set the reduction attributes
        $reduction->currently_active = $request->currently_active;
        $reduction->type = $request->type;
        $reduction->displacement = $request->displacement;
        $reduction->date = $request->date;
        $reduction->home_cost_center = $request->home_cost_center;
        if($request->bump_to_cost_center !== null) {
            $reduction->bump_to_cost_center = $request->bump_to_cost_center;
        } else {
            $reduction->bump_to_cost_center = null;
        }
        $reduction->home_shift = $request->home_shift;
        if($request->bump_to_shift !== null) {
            $reduction->bump_to_shift = $request->bump_to_shift;
        } else {
            $reduction->bump_to_shift = null;
        }
        $reduction->fiscal_week = $request->fiscal_week;
        $reduction->fiscal_year = $request->fiscal_year;
        if($request->return_date === null) {
            $reduction->return_date = "01/01/2050";
        } else {
            $reduction->return_date = $request->return_date;
        }
        $reduction->comments = $request->comments;
        // Save reduction
        if($reduction->save()) {
            // If the save was successful
            \Session::flash('status', 'Employee reduction updated successfully.');
            // Return the show reduction view
            return redirect()->route('reductions.show', ['id' => $reduction->id]);
        } else {
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while updating the employee reduction.  Please contact support for help.');
            // Return back to the edit reduction view
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
        // Get reduction to delete
        $reduction = Reduction::findOrFail($id);
        // Delete the reduction
        if($reduction->delete()) {
            // If the delete was successful
            \Session::flash('status', 'Employee reduction deleted successfully.');
            // Return the show employee view
            return redirect()->route('employees.show', ['id' => $request->input('employee')]);
        } else {
            // If the delete was unsuccessful
            \Session::flash('error', 'An error occurred while deleting the employee reduction.  Please contact support for help.');
            // Return back to the edit reduction view
            return redirect()->back()->withInput();
        }
    }
}
