<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Job;

// Requests
use App\Http\Requests\StoreJob;

class JobController extends Controller
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
        // Get all jobs
        $jobs = Job::all();
        return view('job.jobs', [
            'jobs' => $jobs
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
        return view('job.job-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJob $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
        $job = new Job();
        $job->description = $request->description;
        if($job->save()){
            // If the save was successful
            \Session::flash('status', 'Job created successfully.');
            // Return the show job view
            return redirect()->route('jobs.show', ['id' => $job->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while creating the job.  Please contact support for help.');
            // Return back to the create job view
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
        // Get the job to show
        $job = Job::findOrFail($id);
        return view('job.job-show', [
            'job' => $job
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
        // Get the job to edit
        $job = Job::findOrFail($id);
        return view('job.job-edit', [
            'job' => $job
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreJob $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser']);
        // Get the job to update
        $job = Job::findOrFail($id);
        $job->description = $request->description;
        if($job->save()){
            // If the save was successful
            \Session::flash('status', 'Job updated successfully.');
            // Return the show job view
            return redirect()->route('jobs.show', ['id' => $job->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while updating the job.  Please contact support for help.');
            // Return back to the edit job view
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
        // Get the job to delete
        $job = Job::findOrFail($id);
        if($job->delete()) {
            // If the delete was successful
            \Session::flash('status', 'Job deleted successfully.');
            // Return the show job view
            return redirect()->route('jobs.index');
        } else {
            // If the delete was unsuccessful
            \Session::flash('error', 'An error occurred while deleting the job.  Please contact support for help.');
            // Return back to the edit job view
            return redirect()->back()->withInput();
        }
    }
}
