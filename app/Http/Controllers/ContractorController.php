<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Contractor;

// Requests
use App\Http\Requests\StoreContractor;

class ContractorController extends Controller
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
        // Get all contractors
        $contractors = Contractor::all();
        return view('contractor.contractors', [
            'contractors' => $contractors
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
        return view('contractor.contractor-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContractor $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $contractor = new Contractor();
        $contractor->contractor_name = $request->contractor_name;
        $contractor->contact_name = $request->contact_name;
        $contractor->contact_email = $request->contact_email;
        $contractor->contact_phone_number = $request->contact_phone_number;
        $contractor->general_liability_insurance_date = $request->general_liability_insurance_date;
        $contractor->work_comp_employment_insurance_date = $request->work_comp_employment_insurance_date;
        if($contractor->save()){
            // If the save was successful
            \Session::flash('status', 'Contractor created successfully.');
            // Return the show contractor view
            return redirect()->route('contractors.show', ['id' => $contractor->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while creating the contractor.  Please contact support for help.');
            // Return back to the create contractor view
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
        // Get the contractor to show
        $contractor = Contractor::with('contractorTraining')->findOrFail($id);
        return view('contractor.contractor-show', [
            'contractor' => $contractor
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
        // Get contractor to edit
        $contractor = Contractor::findOrFail($id);
        return view('contractor.contractor-edit', [
            'contractor' => $contractor
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreContractor $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get the contractor to update
        $contractor = Contractor::findOrFail($id);
        $contractor->contractor_name = $request->contractor_name;
        $contractor->contact_name = $request->contact_name;
        $contractor->contact_email = $request->contact_email;
        $contractor->contact_phone_number = $request->contact_phone_number;
        $contractor->general_liability_insurance_date = $request->general_liability_insurance_date;
        $contractor->work_comp_employment_insurance_date = $request->work_comp_employment_insurance_date;
        if($contractor->save()){
            // If the save was successful
            \Session::flash('status', 'Contractor updated successfully.');
            // Return the show contractor view
            return redirect()->route('contractors.show', ['id' => $contractor->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while updating the contractor.  Please contact support for help.');
            // Return back to the edit contractor view
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
        // Get contractor to delete
        $contractor = Contractor::findOrFail($id);
        // Delete all contractor employees from the contractor_trainings table
        $contractor->contractorTraining()->delete();
        if($contractor->delete()) {
            // If the delete was successful
            \Session::flash('status', 'Contractor deleted successfully.');
            // Return the show contractor view
            return redirect()->route('contractors.index');
        } else {
            // If the delete was unsuccessful
            \Session::flash('error', 'An error occurred while deleting the contractor.  Please contact support for help.');
            // Return back to the edit contractor view
            return redirect()->back()->withInput();
        }
    }
}
