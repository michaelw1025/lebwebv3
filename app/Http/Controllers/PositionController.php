<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Position;
use App\Job;
use App\WageTitle;

// Requests
use App\Http\Requests\StorePosition;

class PositionController extends Controller
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
        // Get all positions
        $positions = Position::with(['job', 'wageTitle'])->get();
        return view('position.positions', [
            'positions' => $positions
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
        // Get all jobs
        $jobs = Job::all();
        // Get all wage titles
        $wageTitles = WageTitle::all();
        return view('position.position-create', [
            'jobs' => $jobs,
            'wageTitles' => $wageTitles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePosition $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
        $position = new Position();
        $position->description = $request->description;
        if($position->save()){
            // Sync job
            $position->job()->sync([$request->job]);
            // Sync day wage title
            $position->wageTitle()->sync([$request->wage_title]);
            // If the save was successful
            \Session::flash('status', 'Position created successfully.');
            // Return the show position view
            return redirect()->route('positions.show', ['id' => $position->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while creating the position.  Please contact support for help.');
            // Return back to the create position view
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
        // Get position
        $position = Position::with(['job', 'wageTitle'])->findOrFail($id);
        return view('position.position-show', [
            'position' => $position
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
        // Get position to edit
        $position = Position::with(['job', 'wageTitle'])->findOrFail($id);
        // Get all jobs
        $jobs = Job::all();
        // Get all wage titles
        $wageTitles = WageTitle::all();
        return view('position.position-edit', [
            'position' => $position,
            'jobs' => $jobs,
            'wageTitles' => $wageTitles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePosition $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
        // Get position to update
        $position = Position::findOrFail($id);
        $position->description = $request->description;
        if($position->save()){
            // Sync job
            $position->job()->sync([$request->job]);
            // Sync day wage title
            $position->wageTitle()->sync([$request->wage_title]);
            // If the save was successful
            \Session::flash('status', 'Position updated successfully.');
            // Return the show position view
            return redirect()->route('positions.show', ['id' => $position->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while updating the position.  Please contact support for help.');
            // Return back to the edit position view
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
        // Get position to delete
        $position = Position::findOrFail($id);
        // Unsync job
        $position->job()->sync([]);
        // Unsync day wage title
        $position->wageTitle()->sync([]);
        if($position->delete()) {
            // If the delete was successful
            \Session::flash('status', 'Position deleted successfully.');
            // Return the show position view
            return redirect()->route('positions.index');
        } else {
            // If the delete was unsuccessful
            \Session::flash('error', 'An error occurred while deleting the position.  Please contact support for help.');
            // Return back to the edit position view
            return redirect()->back()->withInput();
        }
    }
}
