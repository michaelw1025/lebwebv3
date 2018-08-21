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
    Route::get('/query-employee-alphabetical-hourly', 'HRController@employeeAlphabeticalHourly')->name('hr.queries.employee-alphabetical-hourly');
});
