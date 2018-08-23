<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use carbon\Carbon;
use Excel;
use App\Exports\ExportEmployeeAnniversary;

// Traits
use App\Traits\QueryTrait;
use App\Traits\SupervisorTrait;

// Exports


class ExportController extends Controller
{
    use QueryTrait;
    use SupervisorTrait;

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
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Set month and year from request
        $searchMonth = $request->month;
        $searchYear = $request->year;
        
        // Get employees from query trait
        $employees = $this->employeeAnniversary($searchMonth, $searchYear);

        // Set the employee info for the export
        $employees = $this->setEmployeeExportInfo($employees);

        // Return the export
        return (new ExportEmployeeAnniversary($employees))->download('employees-anniversary-combined-'.Carbon::now()->format('m-d-Y').'.xlsx');

    }
}
