<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\CostCenter;

// Traits
use App\Traits\SupervisorTrait;

// Requests
use App\Http\Requests\StoreCostCenter;

class CostCenterController extends Controller
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

    use SupervisorTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all cost centers
        $costCenters = CostCenter::orderBy('number', 'asc')->orderBy('extension', 'asc')
        ->with([
            'employeeStaffManager:first_name,last_name',
            'employeeDayTeamManager:first_name,last_name',
            'employeeNightTeamManager:first_name,last_name',
            'employeeDayTeamLeader:first_name,last_name',
            'employeeNightTeamLeader:first_name,last_name'
        ])->get();
        return view('cost-center.cost-centers', [
            'costCenters' => $costCenters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCostCenter $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
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
        // Get the cost center to show
        $costCenter = CostCenter::with([
            'employeeStaffManager:first_name,last_name',
            'employeeDayTeamManager:first_name,last_name',
            'employeeNightTeamManager:first_name,last_name',
            'employeeDayTeamLeader:first_name,last_name',
            'employeeNightTeamLeader:first_name,last_name'
        ])->findOrFail($id);
        return view('cost-center.cost-center-show', [
            'costCenter' => $costCenter
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
        // Get cost center to edit
        $costCenter = CostCenter::with([
            'employeeStaffManager:first_name,last_name',
            'employeeDayTeamManager:first_name,last_name',
            'employeeNightTeamManager:first_name,last_name',
            'employeeDayTeamLeader:first_name,last_name',
            'employeeNightTeamLeader:first_name,last_name'
        ])->findOrFail($id);
        // Get supervisors from supervisor trait
        $supervisors = $this->getAllSupervisors();
        return view('cost-center.cost-center-edit', [
            'costCenter' => $costCenter,
            'supervisors' => $supervisors
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCostCenter $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
        // Get cost center to update
        $costCenter = CostCenter::findOrFail($id);
        $costCenter->number = $request->number;
        $costCenter->extension = $request->extension;
        $costCenter->description = $request->description;
        if($costCenter->save()){
            // Sync staff manager
            $costCenter->employeeStaffManager()->sync([$request->staff_manager]);
            // Sync day team manager
            $costCenter->employeeDayTeamManager()->sync([$request->day_team_manager]);
            // Sync night team manager
            $costCenter->employeeNightTeamManager()->sync([$request->night_team_manager]);
            // Sync day team leader
            $costCenter->employeeDayTeamLeader()->sync([$request->day_team_leader]);
            // Sync night team leader
            $costCenter->employeeNightTeamLeader()->sync([$request->night_team_leader]);
            // If the save was successful
            \Session::flash('status', 'Cost center updated successfully.');
            // Return the show cost center view
            return redirect()->route('costCenters.show', ['id' => $costCenter->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while updating the cost center.  Please contact support for help.');
            // Return back to the edit cost center view
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
    }
}
