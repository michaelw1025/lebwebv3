<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

// Models
use App\Employee;
use App\WageProgression;
use App\CostCenter;

// Traits
use App\Traits\SupervisorTrait;
use App\Traits\QueryTrait;
use App\Traits\DateTrait;
use App\Traits\WageTrait;
use App\Traits\CostCenterTrait;
use App\Traits\ReductionTrait;

// Requests
use App\Http\Requests\SearchEmployeeAnniversaryByMonth;
use App\Http\Requests\SearchEmployeeAnniversaryByQuarter;
use App\Http\Requests\SearchEmployeeBirthday;
use App\Http\Requests\SearchEmployeeWageProgression;
use App\Http\Requests\SearchEmployeeCostCenterIndividual;
use App\Http\Requests\SearchEmployeeTurnover;
use App\Http\Requests\SearchEmployeeHireDate;

class QueryController extends Controller
{
    use SupervisorTrait;
    use QueryTrait;
    use DateTrait;
    use WageTrait;
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

    public function employeeAlphabeticalHourly(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all hourly employees from query trait
        $employees = $this->getEmployeeAlphabetical($request, 'hourly');
        // Get employee supervisors from supervisor trait
        foreach($employees as $employee){
            $employee = $this->getEmployeeSupervisors($employee);
        }
        return view('queries.employee-alphabetical-hourly', [
            'employees' => $employees
        ]);
    }

    public function employeeAlphabeticalSalary(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all salary employees from query trait
        $employees = $this->getEmployeeAlphabetical($request, 'salary');
        // Get employee supervisors from supervisor trait
        foreach($employees as $employee){
            $employee = $this->getEmployeeSupervisors($employee);
        }
        return view('queries.employee-alphabetical-salary', [
            'employees' => $employees
        ]);
    }

    public function employeeAnniversaryByMonth(SearchEmployeeAnniversaryByMonth $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Check if search form is being submitted
        if($request->has('anniversary_month') && $request->has('anniversary_year')){
            // Set month and year from request
            $searchMonth = (int)$request->anniversary_month;
            $searchYear = (int)$request->anniversary_year;
            // Get employees from query trait
            $employees = $this->getEmployeeAnniversaryByMonth($searchMonth, $searchYear);
            // Get employee supervisors from supervisor trait
            foreach($employees as $employee){
                $employee = $this->getEmployeeSupervisors($employee);
            }

            return view('queries.employee-anniversary-by-month', [
                'employees' => $employees,
                'month' => $searchMonth,
                'year' => $searchYear
            ]);
        }else{
            // If search is not submitted give a blank form
            return view('queries.employee-anniversary-by-month');
        }
    }

    public function employeeAnniversaryByQuarter(SearchEmployeeAnniversaryByQuarter $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);

        // Check if search form is being submitted
        if($request->has('anniversary_quarter') && $request->has('anniversary_year')){
            // Set quarter and year from request
            $searchQuarter = (int)$request->anniversary_quarter;
            $searchYear = (int)$request->anniversary_year;
            // Get employees from query trait
            $employees = $this->getEmployeeAnniversaryByQuarter($searchQuarter, $searchYear);
            // Get employee supervisors from supervisor trait
            foreach($employees as $employee){
                $employee = $this->getEmployeeSupervisors($employee);
            }
            return view('queries.employee-anniversary-by-quarter', [
                'employees' => $employees,
                'quarter' => $searchQuarter,
                'year' => $searchYear
            ]);
        }else{
            // If search is not submitted give a blank form
            return view('queries.employee-anniversary-by-quarter');
        }
    }

    public function employeeSeniority(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        $employees = $this->getEmployeeSeniority();
        // Get employee supervisors from supervisor trait
        foreach($employees as $employee){
            $employee = $this->getEmployeeSupervisors($employee);
        }
        return view('queries.employee-seniority', [
            'employees' => $employees
        ]);
    }

    public function employeeBirthday(SearchEmployeeBirthday $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);

        // Check if search form is being submitted
        if($request->has('birthday_month')){
            // Set month from request
            $searchMonth = (int)$request->birthday_month;
            // Get employees from query trait
            $employees = $this->getEmployeeBirthday($searchMonth);
            // Get employee supervisors from supervisor trait
            foreach($employees as $employee){
                $employee = $this->getEmployeeSupervisors($employee);
            }
            
            return view('queries.employee-birthday',[
                'employees' => $employees,
                'month' => $searchMonth 
            ]);
        }else{
            // If search is not submitted give a blank form
            return view('queries.employee-birthday');
        }
    }

    public function employeeWageProgression(SearchEmployeeWageProgression $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);

        // Check if search form is being submitted
        if($request->has('wage_progression_month') && $request->has('wage_progression_year')){
            // Set month and year from request
            $searchMonth = (int)$request->wage_progression_month;
            $searchYear = (int)$request->wage_progression_year;
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
            // Get all wage progressions for table
            $wageProgressions = WageProgression::all();
            // Set employee current and next wage from wage trait
            $employees = $this->setEmployeeWages($employees);

            return view('queries.employee-wage-progression', [
                'employees' => $employees,
                'month' => $searchMonth,
                'year' => $searchYear,
                'wageProgressions' => $wageProgressions
            ]);
        }else{
            // If search is not submitted give a blank form
            return view('queries.employee-wage-progression');
        }
    }

    public function employeeCostCenterAll(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all cost centers with employees from query trait
        $costCenters = $this->getEmployeeCostCenterAll();
        // Set each cost center's leaders in cost center trait
        foreach($costCenters as $costCenter){
            $costCenter = $this->setCostCenterLeaders($costCenter);
        }
        return view('queries.employee-cost-center-all', [
            // 'employees' => $employees,
            'costCenters' => $costCenters
        ]);
    }

    public function employeeCostCenterIndividual(SearchEmployeeCostCenterIndividual $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all cost centers for search form
        $costCenters = CostCenter::all();
        // Check if search form is being submitted
        if($request->has('cost_center')){
            // Set search cost center from request
            $searchCostCenter = $request->cost_center;
            // Get cost center from query trait
            $searchedCostCenter = $this->getCostCenterIndividual($searchCostCenter);
            // Set each cost center's leaders in cost center trait
            $searchedCostCenter = $this->setCostCenterLeaders($searchedCostCenter);
            // return $searchedCostCenter;
            return view('queries.employee-cost-center-individual', [
                'searchedCostCenter' => $searchedCostCenter,
                'searchCostCenter' => $searchCostCenter,
                'costCenters' => $costCenters
            ]);
        }else{
            // If search is not submitted give a blank form
            return view('queries.employee-cost-center-individual', [
                'costCenters' => $costCenters
            ]);
        }
    }

    public function employeeDisciplinaryAll(Request $request)
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
        return view('queries.employee-disciplinary-all', [
            'employees' => $employees
        ]);
    }

    public function employeeReview(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all employees that need reviews from query trait
        $employees = $this->getEmployeeReview();
        // Get employee supervisors from supervisor trait
        foreach($employees as $employee){
            $employee = $this->getEmployeeSupervisors($employee);
        }
        return view('queries.employee-review', [
            'employees' => $employees
        ]);
    }

    public function employeeReduction(Request $request)
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
        return view('queries.employee-reduction', [
            'employees' => $employees
        ]);
    }

    public function employeeTurnoverHourly(SearchEmployeeTurnover $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Set query for hourly
        $searchJob = 'hourly';
        // Check if search form is being submitted
        if($request->has('start_date') && $request->has('end_date')){
            // Set search start and end date from request
            $startDate = $this->setAsDate($request->start_date);
            $endDate = $this->setAsDate($request->end_date);
            // Get employee turnover from query trait
            $employees = $this->getEmployeeTurnover($searchJob, $startDate, $endDate);
            return view('queries.employee-turnover-hourly', [
                'employees' => $employees,
                'startDate' => $startDate,
                'endDate' => $endDate
            ]);
        }else{
            // If search is not submitted give a blank form
            return view('queries.employee-turnover-hourly');
        }
    }

    public function employeeTurnoverSalary(SearchEmployeeTurnover $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Set query for salary
        $searchJob = 'salary';
        // Check if search form is being submitted
        if($request->has('start_date') && $request->has('end_date')){
            // Set search start and end date from request
            $startDate = $this->setAsDate($request->start_date);
            $endDate = $this->setAsDate($request->end_date);
            // Get employee turnover from query trait
            $employees = $this->getEmployeeTurnover($searchJob, $startDate, $endDate);
            return view('queries.employee-turnover-salary', [
                'employees' => $employees,
                'startDate' => $startDate,
                'endDate' => $endDate
            ]);
        }else{
            // If search is not submitted give a blank form
            return view('queries.employee-turnover-salary');
        }
    }

    public function employeeHireDateHourly(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Set query for hourly
        $searchJob = 'hourly';
        // Check if search form is being submitted
        if($request->has('start_date') && $request->has('end_date')){
            // Set search start and end date from request
            $startDate = $this->setAsDate($request->start_date);
            $endDate = $this->setAsDate($request->end_date);
            // Get employees with hire date between search dates from query trait
            $employees = $this->getEmployeeHireDate($searchJob, $startDate, $endDate);
            // Get employee supervisors from supervisor trait
            foreach($employees as $employee){
                $employee = $this->getEmployeeSupervisors($employee);
            }
            return view('queries.employee-hire-date-hourly',[
                'employees' => $employees,
                'startDate' => $startDate,
                'endDate' => $endDate
            ]);
        }else{
            // If search is not submitted give a blank form
            return view('queries.employee-hire-date-hourly');
        }
    }

    public function employeeHireDateSalary(SearchEmployeeHireDate $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Set query for salary
        $searchJob = 'salary';
        // Check if search form is being submitted
        if($request->has('start_date') && $request->has('end_date')){
            // Set search start and end date from request
            $startDate = $this->setAsDate($request->start_date);
            $endDate = $this->setAsDate($request->end_date);
            // Get employees with hire date between search dates from query trait
            $employees = $this->getEmployeeHireDate($searchJob, $startDate, $endDate);
            // Get employee supervisors from supervisor trait
            foreach($employees as $employee){
                $employee = $this->getEmployeeSupervisors($employee);
            }
            return view('queries.employee-hire-date-salary', [
                'employees' => $employees,
                'startDate' => $startDate,
                'endDate' => $endDate
            ]);
        }else{
            // If search is not submitted give a blank form
            return view('queries.employee-hire-date-salary');
        }
    }

    public function employeeBonusHours(Request $request){
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant']);
        // Get all employees who may qualify for bonus hours from query trait
        $employees = $this->getEmployeeBonusHours();
        // Get employee supervisors from supervisor trait
        foreach($employees as $employee){
            $employee = $this->getEmployeeSupervisors($employee);
        }
        return view('queries.employee-bonus-hours', [
            'employees' => $employees
        ]);

    }
}
