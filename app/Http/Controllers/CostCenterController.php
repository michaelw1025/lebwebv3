<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CostCenter;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        // Get all cost centers
        $costCenters = CostCenter::orderBy('number', 'asc')->orderBy('extension', 'asc')
        ->with('employeeStaffManager')->get();
        return $costCenters;
        return view('hr.costCenter.cost-centers', [
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
        $request->user()->authorizeRoles(['admin']);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
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