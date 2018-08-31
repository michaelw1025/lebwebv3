<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/theme', function () {
    return view('theme-test');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function() {
    Route::get('/index', 'AdminController@index')->name('admin.home');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
});

Route::prefix('hr')->group(function() {
    Route::get('/index', 'HRController@index')->name('hr.home');
    Route::resource('costCenters', 'CostCenterController');
    Route::resource('employees', 'EmployeeController');
    Route::resource('shifts', 'ShiftController');
    Route::resource('positions', 'PositionController');
    Route::resource('jobs', 'JobController');
    Route::resource('disciplinaries', 'DisciplinaryController');
    Route::resource('terminations', 'TerminationController');
    Route::resource('reductions', 'ReductionController');
});

Route::prefix('query')->group(function () {
    Route::get('/query-employee-alphabetical-hourly', 'QueryController@employeeAlphabeticalHourly')->name('queries.employee-alphabetical-hourly');
    Route::get('/query-employee-alphabetical-salary', 'QueryController@employeeAlphabeticalSalary')->name('queries.employee-alphabetical-salary');
    Route::get('/query-employee-seniority', 'QueryController@employeeSeniority')->name('queries.employee-seniority');
    Route::get('/query-employee-anniversary-by-month', 'QueryController@employeeAnniversaryByMonth')->name('queries.employee-anniversary-by-month');
    Route::get('/query-employee-anniversary-by-quarter', 'QueryController@employeeAnniversaryByQuarter')->name('queries.employee-anniversary-by-quarter');
    Route::get('/query-employee-birthday', 'QueryController@employeeBirthday')->name('queries.employee-birthday');
    Route::get('/query-employee-wage-progression', 'QueryController@employeeWageProgression')->name('queries.employee-wage-progression');
    Route::get('/query-employee-cost-center-all', 'QueryController@employeeCostCenterAll')->name('queries.employee-cost-center-all');
    Route::get('/query-employee-cost-center-individual', 'QueryController@employeeCostCenterIndividual')->name('queries.employee-cost-center-individual');
    Route::get('/query-employee-disciplinary-all', 'QueryController@employeeDisciplinaryAll')->name('queries.employee-disciplinary-all');
    Route::get('/query-employee-review', 'QueryController@employeeReview')->name('queries.employee-review');
});

Route::prefix('export')->group(function() {
    Route::get('/export-employee-alphabetical-hourly', 'ExportController@exportEmployeeAlphabeticalHourly')->name('export-employee-alphabetical-hourly');
    Route::get('/export-employee-alphabetical-salary', 'ExportController@exportEmployeeAlphabeticalSalary')->name('export-employee-alphabetical-salary');
    Route::get('/export-employee-anniversary-by-month', 'ExportController@exportEmployeeAnniversaryByMonth')->name('export-employee-anniversary-by-month');
    Route::get('/export-employee-anniversary-by-quarter', 'ExportController@exportEmployeeAnniversaryByQuarter')->name('export-employee-anniversary-by-quarter');
    Route::get('/export-employee-birthday', 'ExportController@exportEmployeeBirthday')->name('export-employee-birthday');
    Route::get('/export-employee-wage-progression', 'ExportController@exportEmployeeWageProgression')->name('export-employee-wage-progression');
    Route::get('/export-employee-cost-center-all', 'ExportController@exportEmployeeCostCenterAll')->name('export-employee-cost-center-all');
    Route::get('/export-employee-cost-center-individual', 'ExportController@exportEmployeeCostCenterIndividual')->name('export-employee-cost-center-individual');
    Route::get('/export-employee-disciplinary-all', 'ExportController@exportEmployeeDisciplinaryAll')->name('export-employee-disciplinary-all');
    Route::get('/export-employee-review', 'ExportController@exportEmployeeReview')->name('export-employee-review');
});
