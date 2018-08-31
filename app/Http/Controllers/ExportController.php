<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use carbon\Carbon;
use Excel;

// Traits
use App\Traits\QueryTrait;
use App\Traits\SupervisorTrait;
use App\Traits\WageTrait;
use App\Traits\DateTrait;
use App\Traits\CostCenterTrait;
use App\Traits\ReductionTrait;

// Exports
use App\Exports\ExportEmployeeAlphabetical;
use App\Exports\ExportEmployeeAnniversary;
use App\Exports\ExportEmployeeBirthday;
use App\Exports\ExportEmployeeWageProgression;
use App\Exports\ExportEmployeeCostCenterAll;
use App\Exports\ExportEmployeeCostCenterIndividual;
use App\Exports\ExportEmployeeReview;
use App\Exports\ExportEmployeeReduction;

use App\Employee;
class ExportController extends Controller
{
    use QueryTrait;
    use SupervisorTrait;
    use WageTrait;
    use DateTrait;
    use CostCenterTrait;
    use ReductionTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function exportEmployeeAlphabeticalHourly(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all hourly employees from query trait
        $employees = $this->getEmployeeAlphabetical($request, 'hourly');
        // Get employee supervisors from supervisor trait
        $employees = $this->getEmployeeSupervisors($employees);
        // Set the employee info for the export
        $employees = $this->setEmployeeAlphabeticalExportInfo($employees);
        return (new ExportEmployeeAlphabetical($employees))->download('employees-alphabetical-hourly-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }

    public function exportEmployeeAlphabeticalSalary(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all salary employees from query trait
        $employees = $this->getEmployeeAlphabetical($request, 'salary');
        // Get employee supervisors from supervisor trait
        $employees = $this->getEmployeeSupervisors($employees);
        // Set the employee info for the export
        $employees = $this->setEmployeeAlphabeticalExportInfo($employees);
        return (new ExportEmployeeAlphabetical($employees))->download('employees-alphabetical-salary-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }

    public function exportEmployeeAnniversaryByMonth(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Set month and year from request
        $searchMonth = $request->month;
        $searchYear = $request->year;
        // Get employees from query trait
        $employees = $this->getEmployeeAnniversaryByMonth($searchMonth, $searchYear);
        // Get employee supervisors from supervisor trait
        $employees = $this->getEmployeeSupervisors($employees);
        // Set the employee info for the export
        $employees = $this->setEmployeeAnniversaryExportInfo($employees);
        // Return the export
        return (new ExportEmployeeAnniversary($employees))->download('employees-anniversary-by-month-'.Carbon::now()->format('m-d-Y').'.xlsx');

    }

    public function exportEmployeeAnniversaryByQuarter(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Set quarter and year from request
        $searchQuarter = (int)$request->quarter;
        $searchYear = (int)$request->year;
        // Get employees from query trait
        $employees = $this->getEmployeeAnniversaryByQuarter($searchQuarter, $searchYear);
        // Get employee supervisors from supervisor trait
        $employees = $this->getEmployeeSupervisors($employees);
        // Set the employee info for the export
        $employees = $this->setEmployeeAnniversaryExportInfo($employees);
        // Return the export
        return (new ExportEmployeeAnniversary($employees))->download('employees-anniversary-by-quarter-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }
    public function exportEmployeeBirthday(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Set month from request
        $searchMonth = (int)$request->month;
        // Get employees from query trait
        $employees = $this->getEmployeeBirthday($searchMonth);
        // Get employee supervisors from supervisor trait
        $employees = $this->getEmployeeSupervisors($employees);
        // Set the employee info for the export
        $employees = $this->setEmployeeBirthdayExportInfo($employees);
        // Return the export
        return (new ExportEmployeeBirthday($employees))->download('employees-birthday-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }

    public function exportEmployeeWageProgression(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Set month and year from request
        $searchMonth = (int)$request->month;
        $searchYear = (int)$request->year;
        // Get employees from query trait
        $employees = $this->getEmployeeWageProgression($searchMonth, $searchYear);
        // Get employee supervisors from supervisor trait
        $employees = $this->getEmployeeSupervisors($employees);
        // Set progression date as date instance in wage trait
        foreach($employees as $employee){
            $this->setWageEventDate($employee);
        }
        // Set employee current and next wage from wage trait
        $employees = $this->setEmployeeWages($employees);
        // Set the employee info for the export
        $employees = $this->setEmployeeWageProgressionExportInfo($employees);
        // Return the export
        return (new ExportEmployeeWageProgression($employees))->download('employees-wage-progression-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }

    public function exportEmployeeCostCenterAll(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all employees from query trait
        $employees = $this->getEmployeeCostCenterAll();
        // Get all cost centers from cost center trait
        $costCenters = $this->getCostCentersAll();
        // Set each cost center's leaders in cost center trait
        $costCenters = $this->setCostCenterLeaders($costCenters);
        // Return the export
        return (new ExportEmployeeCostCenterAll($employees, $costCenters))->download('employees-cost-center-all-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }

    public function exportEmployeeCostCenterIndividual(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Set search cost center from request
        $searchCostCenter = $request->cost_center;
        // Get cost center from query trait
        $searchedCostCenter = $this->getCostCenterIndividual($searchCostCenter);
        // Set each cost center's leaders in cost center trait
        $searchedCostCenter = $this->setCostCenterLeaders($searchedCostCenter);
        // Return the export
        return (new ExportEmployeeCostCenterIndividual($searchedCostCenter))->download('employees-cost-center-individual-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }

    public function exportEmployeeReview(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all employees that need reviews from query trait
        $employees = $this->getEmployeeReview();
        // Get employee supervisors from supervisor trait
        $employees = $this->getEmployeeSupervisors($employees);
        // Return the export
        return (new ExportEmployeeReview($employees))->download('employees-review-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }

    public function exportEmployeeReduction(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all employees with an active reduction from query trait
        $employees = $this->getEmployeeReduction();
        // Get all reduction home and bump cost centers and shifts from reduction trait
        foreach($employees as $employee){
            foreach($employee->reduction as $employeeReduction){
                $this->getReductionInfo($employeeReduction);
            }
        }
        // Return the export
        return (new ExportEmployeeReduction($employees))->download('employees-reduction-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }
}
