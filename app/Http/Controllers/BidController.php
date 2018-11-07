<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Bid;
use App\Team;
use App\Shift;
use App\Position;
use App\WageTitle;

// Requests
use App\Http\Requests\StoreBid;

class BidController extends Controller
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
        // Get all bids
        $bids = Bid::with([
            'position'
        ])
        ->orderBy('posting_number', 'desc')
        ->get();
        return view('bids.bids', [
            'bids' => $bids
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
        // Get all teams
        $teams = Team::all();
        // Get all shifts
        $shifts = Shift::all();
        // Get all positions
        $positions = Position::all();
        // Get all wage titles with wages
        $wageTitles = WageTitle::with('wageProgression')->get();
        return view('bids.bid-create', [
            'teams' => $teams,
            'shifts' => $shifts,
            'positions' => $positions,
            'wageTitles' => $wageTitles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBid $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $bid = new Bid();
        $bid->posting_number = $request->posting_number;
        $bid->is_active = 1;
        if($request->has('is_posted')){
            $bid->is_posted = 1;
        }else{
            $bid->is_posted = 0;
        }
        $bid->post_date = $request->post_date;
        $bid->pull_date = $request->pull_date;
        $bid->team_id = $request->team_id;
        $bid->position_id = $request->position_id;
        $bid->shift_id = $request->shift_id;
        $bid->number_of_openings = $request->number_of_openings;
        $bid->bid_top_wage_id = $request->bid_top_wage_id;
        $bid->bid_education_top_wage_id = $request->bid_education_top_wage_id;
        if($request->has('education_requirement')){
            $bid->education_requirement = 1;
        }else{
            $bid->education_requirement = 0;
        }
        if($request->has('resume_required')){
            $bid->resume_required = 1;
        }else{
            $bid->resume_required = 0;
        }
        if($request->has('tech_form_required')){
            $bid->tech_form_required = 1;
        }else{
            $bid->tech_form_required = 0;
        }
        $bid->summary = $request->summary;
        $bid->essential_duties_responsibilities = $request->essential_duties_responsibilities;
        $bid->qualifications = $request->qualifications;
        $bid->successful_bidder = $request->successful_bidder;
        $bid->education_experience = $request->education_experience;
        $bid->physical_demands = $request->physical_demands;
        $bid->math_skills = $request->math_skills;
        if($bid->save()){
            // If the save was successful
            \Session::flash('status', 'Bid created successfully.');
            // Return the show bid view
            return redirect()->route('bids.show', ['id' => $bid->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while creating the bid.  Please contact support for help.');
            // Return back to the create bid view
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get the bid to show
        $bid = Bid::with([
            'team',
            'shift',
            'position',
            'bidTopWage',
            'bidEducationTopWage'
        ])->findOrFail($id);
        // return $bid;
        return view('bids.bid-show', [
            'bid' => $bid
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get the bid to edit
        $bid = Bid::findOrFail($id);
        // Get all teams
        $teams = Team::all();
        // Get all shifts
        $shifts = Shift::all();
        // Get all positions
        $positions = Position::all();
        // Get all wage titles with wages
        $wageTitles = WageTitle::with('wageProgression')->get();
        return view('bids.bid-edit', [
            'bid' => $bid,
            'teams' => $teams,
            'shifts' => $shifts,
            'positions' => $positions,
            'wageTitles' => $wageTitles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBid $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get the bid to update
        $bid = Bid::findOrFail($id);
        $bid->posting_number = $request->posting_number;
        if($request->has('is_active')){
            $bid->is_active = 1;
        }else{
            $bid->is_active = 0;
        }
        if($request->has('is_posted')){
            $bid->is_posted = 1;
        }else{
            $bid->is_posted = 0;
        }
        $bid->post_date = $request->post_date;
        $bid->pull_date = $request->pull_date;
        $bid->team_id = $request->team_id;
        $bid->position_id = $request->position_id;
        $bid->shift_id = $request->shift_id;
        $bid->number_of_openings = $request->number_of_openings;
        $bid->bid_top_wage_id = $request->bid_top_wage_id;
        $bid->bid_education_top_wage_id = $request->bid_education_top_wage_id;
        if($request->has('education_requirement')){
            $bid->education_requirement = 1;
        }else{
            $bid->education_requirement = 0;
        }
        if($request->has('resume_required')){
            $bid->resume_required = 1;
        }else{
            $bid->resume_required = 0;
        }
        if($request->has('tech_form_required')){
            $bid->tech_form_required = 1;
        }else{
            $bid->tech_form_required = 0;
        }
        $bid->summary = $request->summary;
        $bid->essential_duties_responsibilities = $request->essential_duties_responsibilities;
        $bid->qualifications = $request->qualifications;
        $bid->successful_bidder = $request->successful_bidder;
        $bid->education_experience = $request->education_experience;
        $bid->physical_demands = $request->physical_demands;
        $bid->math_skills = $request->math_skills;
        if($bid->save()){
            // If the save was successful
            \Session::flash('status', 'Bid updated successfully.');
            // Return the show bid view
            return redirect()->route('bids.show', ['id' => $bid->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while updating the bid.  Please contact support for help.');
            // Return back to the edit bid view
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Bid $bid)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        if($bid->delete()) {
            // If the delete was successful
            \Session::flash('status', 'Bid deleted successfully.');
            // Return the show bid view
            return redirect()->route('bids.index');
        } else {
            // If the delete was unsuccessful
            \Session::flash('error', 'An error occurred while deleting the bid.  Please contact support for help.');
            // Return back to the edit bid view
            return redirect()->back()->withInput();
        }
    }
}
