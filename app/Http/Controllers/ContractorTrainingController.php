<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\ContractorTraining;
use App\Contractor;

// Requests
use App\Http\Requests\StoreContractorTraining;

class ContractorTrainingController extends Controller
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
        // Get the contractor for the request
        $contractor = Contractor::findOrFail($request->input('contractor'));
        return view('contractor-training.contractor-training-create', [
            'contractor' => $contractor
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContractorTraining $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get the contractor for the request
        $contractor = Contractor::findOrFail($request->input('contractor'));
        $contractorTraining = new ContractorTraining();
        $contractorTraining->contractor_employee_name = $request->contractor_employee_name;
        $contractorTraining->training_completion_date = $request->training_completion_date;
        $contractorTraining->re_training_due_date = $request->re_training_due_date;
        $contractorTraining->active = 1;
        if($contractor->contractorTraining()->save($contractorTraining)){
            // If the save was successful
            \Session::flash('status', 'Contractor employee created successfully.');
            // Return the show contractor training view
            return redirect()->route('contractorTrainings.show', ['id' => $contractorTraining->id, 'contractor' => $contractor->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while creating the contractor employee.  Please contact support for help.');
            // Return back to the create contractor training view
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
        // Get the contractor for the request
        $contractor = Contractor::findOrFail($request->input('contractor'));
        // Get the contractor employee for the request
        $contractorTraining = ContractorTraining::findOrFail($id);
        return view('contractor-training.contractor-training-show', [
            'contractor' => $contractor,
            'contractorTraining' => $contractorTraining
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
        // Get the contractor for the request
        $contractor = Contractor::findOrFail($request->input('contractor'));
        // Get the contractor employee to edit
        $contractorTraining = ContractorTraining::findOrFail($id);
        return view('contractor-training.contractor-training-edit', [
            'contractor' => $contractor,
            'contractorTraining' => $contractorTraining
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreContractorTraining $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get the contractor for the request
        $contractor = Contractor::findOrFail($request->input('contractor'));
        // Get the contractor employee to update
        $contractorTraining = ContractorTraining::findOrFail($id);
        $contractorTraining->contractor_employee_name = $request->contractor_employee_name;
        $contractorTraining->training_completion_date = $request->training_completion_date;
        $contractorTraining->re_training_due_date = $request->re_training_due_date;
        $contractorTraining->active = $request->active;
        if($contractor->contractorTraining()->save($contractorTraining)){
            // If the save was successful
            \Session::flash('status', 'Contractor employee updated successfully.');
            // Return the show contractor view
            return redirect()->route('contractors.show', ['id' => $contractor->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while updating the contractor employee.  Please contact support for help.');
            // Return back to the edit contractor training view
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
        // Get the contractor for the request
        $contractor = Contractor::findOrFail($request->input('contractor'));
        // return $contractorTraining;
        if($contractorTraining->delete($id)) {
            // If the delete was successful
            \Session::flash('status', 'Contractor employee deleted successfully.');
            // Return the show contractor view
            return redirect()->route('contractors.show', ['id' => $contractor->id]);
        } else {
            // If the delete was unsuccessful
            \Session::flash('error', 'An error occurred while deleting the contractor employee.  Please contact support for help.');
            // Return back to the edit contractor training view
            return redirect()->back()->withInput();
        }
    }
}
