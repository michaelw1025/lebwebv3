<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportController extends Controller
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

    public function exportEmployeeAnniversary(Request $request)
    {
        // return (new ExportEmployeeAnniversary($request->exportData));
        // return response()->json(['success' => 'export successful']);
        \Log::info($request->all());
        return response()->json(['success' => 'success']);
    }
}
