<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Team;

// Requests
use App\Http\Requests\StoreTeam;

class TeamController extends Controller
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
        // Get all teams
        $teams = Team::all();
        return view('team.teams', [
            'teams' => $teams
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
        return view('team.team-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeam $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $team = new Team();
        $team->description = $request->description;
        if($team->save()){
            // If the save was successful
            \Session::flash('status', 'Team created successfully.');
            // Return the show team view
            return redirect()->route('teams.show', ['id' => $team->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while creating the team.  Please contact support for help.');
            // Return back to the create team view
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
        // Get the team to show
        $team = Team::findOrFail($id);
        return view('team.team-show', [
            'team' => $team
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
        // Get the team to edit
        $team = Team::findOrFail($id);
        return view('team.team-edit', [
            'team' => $team
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTeam $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get the team to update
        $team = Team::findOrFail($id);
        $team->description = $request->description;
        if($team->save()){
            // If the save was successful
            \Session::flash('status', 'Team updated successfully.');
            // Return the show team view
            return redirect()->route('teams.show', ['id' => $team->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while updating the team.  Please contact support for help.');
            // Return back to the edit team view
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
        // Get the team to delete
        $team = Team::findOrFail($id);
        if($team->delete()) {
            // If the delete was successful
            \Session::flash('status', 'Team deleted successfully.');
            // Return the show team view
            return redirect()->route('teams.index');
        } else {
            // If the delete was unsuccessful
            \Session::flash('error', 'An error occurred while deleting the team.  Please contact support for help.');
            // Return back to the edit team view
            return redirect()->back()->withInput();
        }
    }
}
