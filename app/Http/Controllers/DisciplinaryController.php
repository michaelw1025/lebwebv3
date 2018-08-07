<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disciplinary;
use App\Traits\HelperFunctions;
use App\CostCenter;
use App\Employee;

class DisciplinaryController extends Controller
{
    use HelperFunctions;

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
    public function index()
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        // Not used, disciplinaries are shown through the employee controller using the employee-disciplinary relationship
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        // Not used, disciplinaries are created through the employee controller using the employee-disciplinary relationship
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        // Not used, disciplinaries are stored through the employee controller using the employee-disciplinary relationship
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
        $request->user()->authorizeRoles(['admin']);
        $disciplinary = Disciplinary::with('employee')->findOrFail($id);
        $this->getDisciplinaryInfo($disciplinary);
        return view('hr.employee.disciplinary.disciplinary-show', [
            'disciplinary' => $disciplinary
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
        $request->user()->authorizeRoles(['admin']);
        $disciplinary = Disciplinary::findOrFail($id);
        $this->getDisciplinaryInfo($disciplinary);
        // Get all cost centers
        $costCenters = CostCenter::orderBy('number', 'asc')->orderBy('extension', 'asc')->get();
        // Get all salaried employees
        $salariedEmployees = Employee::whereHas('job', function($q) {
            $q->where('description', 'salary');
        })->orderBy('last_name', 'asc')->get();
        return view('hr.employee.disciplinary.disciplinary-edit', [
            'disciplinary' => $disciplinary,
            'costCenters' => $costCenters,
            'salariedEmployees' =>  $salariedEmployees
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
        $request->user()->authorizeRoles(['admin']);
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
