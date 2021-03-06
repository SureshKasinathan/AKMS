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
});

Route::get('/login', function () {
	return view('auth/login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

	Route::get('home', 'Admin\AdminDashboardController@index')->name('home');
	Route::resource('companies', 'CompanyController');
	Route::resource('roles', 'RoleController');
	Route::resource('users', 'UserController');
	Route::resource('groups', 'GroupController');
	Route::resource('clients', 'ClientController');
	Route::resource('contacts', 'ContactController');

});
