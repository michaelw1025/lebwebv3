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

route::prefix('admin')->group(function() {
    Route::get('/index', 'AdminController@index')->name('admin.home');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
});
