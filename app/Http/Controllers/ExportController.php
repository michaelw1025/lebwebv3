<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use carbon\Carbon;
use Excel;

// Models
use App\WageProgression;
use App\Employee;

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
use App\Exports\ExportEmployeeTurnover;
use App\Exports\ExportEmployeeHireDate;
use App\Exports\ExportEmployeeBonusHours;
use App\Exports\ExportEmployeeDisciplinaryAll;
use App\Exports\ExportEmployeeTeamLeader;

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
        foreach($employees as $employee){
            $employee = $this->getEmployeeSupervisors($employee);
        }
        return (new ExportEmployeeAlphabetical($employees))->download('employees-alphabetical-hourly-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }

    public function exportEmployeeAlphabeticalSalary(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all salary employees from query trait
        $employees = $this->getEmployeeAlphabetical($request, 'salary');
        // Get employee supervisors from supervisor trait
        foreach($employees as $employee){
            $employee = $this->getEmployeeSupervisors($employee);
        }
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
        foreach($employees as $employee){
            $employee = $this->getEmployeeSupervisors($employee);
        }
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
        foreach($employees as $employee){
            $employee = $this->getEmployeeSupervisors($employee);
        }
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
        foreach($employees as $employee){
            $employee = $this->getEmployeeSupervisors($employee);
        }
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
        foreach($employees as $employee){
            $employee = $this->getEmployeeSupervisors($employee);
        }
        // Set progression date as date instance in wage trait
        foreach($employees as $employee){
            $this->setWageEventDate($employee);
        }
        // Set employee current and next wage from wage trait
        $employees = $this->setEmployeeWages($employees);
        // Get all wage progressions for table
        $wageProgressions = WageProgression::all();
        return (new ExportEmployeeWageProgression($employees, $wageProgressions))->download('employees-wage-progression-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }

    public function exportEmployeeCostCenterAll(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all cost centers with employees from query trait
        $costCenters = $this->getEmployeeCostCenterAll();
        // Set each cost center's leaders in cost center trait
        foreach($costCenters as $costCenter){
            $costCenter = $this->setCostCenterLeaders($costCenter);
        }
        // Return the export
        return (new ExportEmployeeCostCenterAll($costCenters))->download('employees-cost-center-all-'.Carbon::now()->format('m-d-Y').'.xlsx');
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

    public function exportEmployeeDisciplinaryAll(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all employees with disciplinaries in the past year from query trait
        $employees = $this->getEmployeeDisciplinaryAll();
        // Get disciplinary issued by from query trait
        foreach($employees as $employee){
            $employee = $this->getDisciplinaryIssuedBy($employee);
        }
        // Get employee supervisors from supervisor trait
        foreach($employees as $employee){
            $employee = $this->getEmployeeSupervisors($employee);
        }
        // Return the export
        return (new ExportEmployeeDisciplinaryAll($employees))->download('employees-disciplinary-all-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }

    public function exportEmployeeReview(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all employees that need reviews from query trait
        $employees = $this->getEmployeeReview();
        // Get employee supervisors from supervisor trait
        foreach($employees as $employee){
            $employee = $this->getEmployeeSupervisors($employee);
        }
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

    public function exportEmployeeTurnoverHourly(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Set query for hourly
        $searchJob = 'hourly';
        // Set search start and end date from request
        $startDate = $this->setAsDate($request->start_date);
        $endDate = $this->setAsDate($request->end_date);
        // Get employee turnover from query trait
        $employees = $this->getEmployeeTurnover($searchJob, $startDate, $endDate);
        // Return the export
        return (new ExportEmployeeTurnover($employees))->download('employees-termination-hourly-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }

    public function exportEmployeeTurnoverSalary(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Set query for salary
        $searchJob = 'salary';
        // Set search start and end date from request
        $startDate = $this->setAsDate($request->start_date);
        $endDate = $this->setAsDate($request->end_date);
        // Get employee turnover from query trait
        $employees = $this->getEmployeeTurnover($searchJob, $startDate, $endDate);
        // Return the export
        return (new ExportEmployeeTurnover($employees))->download('employees-termination-salary-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }

    public function exportEmployeeHireDateHourly(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Set query for hourly
        $searchJob = 'hourly';
        // Set search start and end date from request
        $startDate = $this->setAsDate($request->start_date);
        $endDate = $this->setAsDate($request->end_date);
        // Get employees with hire date between search dates from query trait
        $employees = $this->getEmployeeHireDate($searchJob, $startDate, $endDate);
        // Get employee supervisors from supervisor trait
        foreach($employees as $employee){
            $employee = $this->getEmployeeSupervisors($employee);
        }
        // Return the export
        return (new ExportEmployeeHireDate($employees))->download('employees-hire-date-hourly-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }

    public function exportEmployeeHireDateSalary(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Set query for salary
        $searchJob = 'salary';
        // Set search start and end date from request
        $startDate = $this->setAsDate($request->start_date);
        $endDate = $this->setAsDate($request->end_date);
        // Get employees with hire date between search dates from query trait
        $employees = $this->getEmployeeHireDate($searchJob, $startDate, $endDate);
        // Get employee supervisors from supervisor trait
        foreach($employees as $employee){
            $employee = $this->getEmployeeSupervisors($employee);
        }
        // Return the export
        return (new ExportEmployeeHireDate($employees))->download('employees-hire-date-salary-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }

    public function exportEmployeeBonusHours(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all employees who may qualify for bonus hours from query trait
        $employees = $this->getEmployeeBonusHours();
        // Get employee supervisors from supervisor trait
        foreach($employees as $employee){
            $employee = $this->getEmployeeSupervisors($employee);
        }
        // Return the export
        return (new ExportEmployeeBonusHours($employees))->download('employees-bonus-hours-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }

    public function exportEmployeeTeamLeader(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get the desired team leader shift from the request
        $tlShift = (int)$request->shift;
        // Get the desired team leader id from the request
        $tlID = $request->team_leader;
        // Get the team leader for the search
        $searchTeamLeader = Employee::findOrFail($tlID);
        // Get all cost centers for the team leader from the query trait
        $costCenters = $this->getTeamLeaderEmployees($searchTeamLeader->id, $tlShift);
        // Return the export
        // return (new ExportEmployeeTeamLeader($searchTeamLeader, $costCenters))->download('employees-team-leader-'.Carbon::now()->format('m-d-Y').'.xlsx');
        return (new ExportEmployeeTeamLeader($searchTeamLeader, $costCenters))->download('employees-team-leader-'.Carbon::now()->format('m-d-Y').'.xlsx');
    }
}
