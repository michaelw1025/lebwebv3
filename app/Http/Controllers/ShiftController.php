<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Shift;

// Requests
use App\Http\Requests\StoreShift;

class ShiftController extends Controller
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
        // Get all shifts
        $shifts = Shift::all();
        return view('shift.shifts', [
            'shifts' => $shifts
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
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
        return view('shift.shift-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShift $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
        $shift = new Shift();
        $shift->description = $request->description;
        if($shift->save()){
            // If the save was successful
            \Session::flash('status', 'Shift created successfully.');
            // Return the show shift view
            return redirect()->route('shifts.show', ['id' => $shift->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while creating the shift.  Please contact support for help.');
            // Return back to the create shift view
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
        // Get shift
        $shift = Shift::findOrFail($id);
        return view('shift.shift-show', [
            'shift' => $shift
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
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
        // Get shift to edit
        $shift = Shift::findOrFail($id);
        return view('shift.shift-edit', [
            'shift' => $shift
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
        // Get shift to update
        $shift = Shift::findOrFail($id);
        $shift->description = $request->description;
        if($shift->save()){
            // If the save was successful
            \Session::flash('status', 'Shift updated successfully.');
            // Return the show shift view
            return redirect()->route('shifts.show', ['id' => $shift->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while updating the shift.  Please contact support for help.');
            // Return back to the edit shift view
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
        $request->user()->authorizeRoles(['admin']);
        // Get shift to delete
        $shift = Shift::findOrFail($id);
        if($shift->delete()) {
            // If the delete was successful
            \Session::flash('status', 'Shift deleted successfully.');
            // Return the show shift view
            return redirect()->route('shifts.index');
        } else {
            // If the delete was unsuccessful
            \Session::flash('error', 'An error occurred while deleting the shift.  Please contact support for help.');
            // Return back to the edit shift view
            return redirect()->back()->withInput();
        }
    }
}
