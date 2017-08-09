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

Route::get('/', 'PatientController@create')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::resource('users', 'UserController');

Route::get('/registration', 'PatientController@create')->name('registration');

Route::get('/settings', 'HomeController@settings')->name('settings');

Route::resource('services', 'ServiceController');

Route::resource('insurances', 'InsuranceController');

Route::resource('investigations', 'InvestigationController');

Route::resource('treatments', 'TreatmentController');

Route::resource('patients', 'PatientController');

Route::get('/tests', 'TestController@index')->name('test');

Route::post('/patient/release', 'PatientController@release')->name('patient_release');

Route::post('/patient/transactions', 'PatientController@transactions')->name('patient_transactions');

Route::get('/patient/ajaxdistricts', 'PatientController@ajaxdistricts');

Route::get('/reports', 'ReportController@index')->name('reports');

Route::get('/reports/full', 'ReportController@full');

Route::get('/patients/credit/{patient}', 'PatientController@credit')->name('credit');

Route::post('/patients/paycredit', 'PatientController@paycredit')->name('paycredit');