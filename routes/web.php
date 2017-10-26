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
Auth::routes();

Route::get('/', function() {
	return redirect()->route('welcome');
});

Route::get('welcome', function() {

	$db = new mysqli('localhost', 'root','', 'safefocus');
	$database="safefocus";
	$query="SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME=?";
	$stmt = $db->prepare($query);
	$stmt->bind_param('s',$database);
	$stmt->execute();
	$stmt->bind_result($data);
	if($stmt->fetch())
	{
	    if (!Schema::hasTable('migrations')) {
	    	return view('static/welcome');
	    } else {
	    	if (empty(App\Http\Models\Region::get()->first())) {
	    		return view('static/welcome');
	    	}
	    	else {
	    		return redirect('login');
	    	}
	    }
	}
	else
	{
		return view('static/welcome');
	}
	$stmt->close();


})->name('welcome');

Route::get('createdatabase', function () {
    $pdo = new PDO('mysql:host=localhost;dbname=mysql;charset=utf8mb4', 'root', 'safefocus');
    $pdo->exec( 'create database safefocus;');
    return redirect('welcome');
});

Route::get('migratedatabase', function () {
    Artisan::call('migrate:refresh');
    return redirect('welcome');
});

Route::get('seeddatabase', function () {
      Artisan::call('db:seed');
    	return redirect('registration');
});

Route::get('/home', 'HomeController@welcome')->name('home');

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

Route::post('logo/upload', 'HomeController@logo')->name('logo');
