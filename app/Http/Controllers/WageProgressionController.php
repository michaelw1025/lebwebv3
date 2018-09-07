<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\WageProgression;

// Requests
use App\Http\Requests\StoreWageProgression;

class WageProgressionController extends Controller
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
        // Get all wage progressions
        $wageProgressions = WageProgression::all();
        return view('wage-progression.wage-progressions', [
            'wageProgressions' => $wageProgressions
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
        return view('wage-progression.wage-progression-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWageProgression $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
        $wageProgression = new WageProgression();
        $wageProgression->month = $request->month;
        if($wageProgression->save()){
            // If the save was successful
            \Session::flash('status', 'Wage progression created successfully.');
            // Return the show wage progression view
            return redirect()->route('wageProgressions.show', ['id' => $wageProgression->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while creating the wage progression.  Please contact support for help.');
            // Return back to the create wage progression view
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
        // Get wage progression
        $wageProgression = WageProgression::findOrFail($id);
        return view('wage-progression.wage-progression-show', [
            'wageProgression' => $wageProgression
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
        // Get wage progression to edit
        $wageProgression = WageProgression::findOrFail($id);
        return view('wage-progression.wage-progression-edit', [
            'wageProgression' => $wageProgression
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreWageProgression $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
        // Get wage progression to update
        $wageProgression = WageProgression::findOrFail($id);
        $wageProgression->month = $request->month;
        if($wageProgression->save()){
            // If the save was successful
            \Session::flash('status', 'Wage progression updated successfully.');
            // Return the show wage progression view
            return redirect()->route('wageProgressions.show', ['id' => $wageProgression->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while updating the wage progression.  Please contact support for help.');
            // Return back to the edit wage progression view
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
        // Get wage progression to delete
        $wageProgression = WageProgression::findOrFail($id);
        if($wageProgression->delete()) {
            // If the delete was successful
            \Session::flash('status', 'Wage progression deleted successfully.');
            // Return the show wage progression view
            return redirect()->route('wageProgressions.index');
        } else {
            // If the delete was unsuccessful
            \Session::flash('error', 'An error occurred while deleting the wage progression.  Please contact support for help.');
            // Return back to the edit wage progression view
            return redirect()->back()->withInput();
        }
    }
}
