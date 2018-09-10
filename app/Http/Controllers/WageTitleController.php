<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\WageTitle;
use App\WageProgression;

// Requests
use App\Http\Requests\StoreWageTitle;

class WageTitleController extends Controller
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
        // Get all wage titles
        $wageTitles = WageTitle::with(['wageProgression'])->get();
        return view('wage-title.wage-titles', [
            'wageTitles' => $wageTitles
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
        // Get all wage progressions
        $wageProgressions = WageProgression::orderBy('month', 'asc')->get();
        return view('wage-title.wage-title-create', [
            'wageProgressions' => $wageProgressions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWageTitle $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
        $wageTitle = new WageTitle();
        $wageTitle->description = $request->description;
        if($wageTitle->save()){
            // Create an array to hold the wage progression sync data
            $wageProgressionArray = array();
            // Sync wage progression months and amounts
            foreach($request->wage_progression as $wageProgression){
                $wageProgressionArray += [$wageProgression['id'] => ['amount' => $wageProgression['amount']]];
            }
            $wageTitle->wageProgression()->sync($wageProgressionArray);
            // If the save was successful
            \Session::flash('status', 'Wage title created successfully.');
            // Return the show wage title view
            return redirect()->route('wageTitles.show', ['id' => $wageTitle->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while creating the wage title.  Please contact support for help.');
            // Return back to the create wage title view
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
        // Get wage title
        $wageTitle = WageTitle::with(['wageProgression'])->findOrFail($id);
        return view('wage-title.wage-title-show', [
            'wageTitle' => $wageTitle
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
        // Get wage title to edit
        $wageTitle = WageTitle::with(['wageProgression'])->findOrFail($id);
        // Get all wage progressions
        $wageProgressions = WageProgression::orderBy('month', 'asc')->get();
        return view('wage-title.wage-title-edit', [
            'wageTitle' => $wageTitle,
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
    public function update(StoreWageTitle $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
        // Get the wage title to update
        $wageTitle = WageTitle::findOrFail($id);
        $wageTitle->description = $request->description;
        if($wageTitle->save()){
            // Create an array to hold the wage progression sync data
            $wageProgressionArray = array();
            // Sync wage progression months and amounts
            foreach($request->wage_progression as $wageProgression){
                $wageProgressionArray += [$wageProgression['id'] => ['amount' => $wageProgression['amount']]];
            }
            $wageTitle->wageProgression()->sync($wageProgressionArray);
            // If the save was successful
            \Session::flash('status', 'Wage title updated successfully.');
            // Return the show wage title view
            return redirect()->route('wageTitles.show', ['id' => $wageTitle->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while updating the wage title.  Please contact support for help.');
            // Return back to the edit wage title view
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
        // Get the wage title to delete
        $wageTitle = WageTitle::findOrFail($id);
        // Unsync all wage progression months and amounts
        $wageTitle->wageProgression()->sync([]);
        if($wageTitle->delete()) {
            // If the delete was successful
            \Session::flash('status', 'Wage title deleted successfully.');
            // Return the show wage title view
            return redirect()->route('wageTitles.index');
        } else {
            // If the delete was unsuccessful
            \Session::flash('error', 'An error occurred while deleting the wage title.  Please contact support for help.');
            // Return back to the edit wage title view
            return redirect()->back()->withInput();
        }
    }
}
