<?php

use Illuminate\Support\Facades\Route;

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

//**** Index ****//
Route::get('/', '\App\Http\Controllers\Controller@showAllData');

//**** Patients ****//
Route::get('patients', '\App\Http\Controllers\PatientsController@showAllData');
Route::get('preview_patient/{id}', '\App\Http\Controllers\PatientsController@show');

Route::get('add_patient', '\App\Http\Controllers\PatientsController@insertPatient');
Route::post('add_patient', '\App\Http\Controllers\PatientsController@store');

Route::get('update_patient/{id}', '\App\Http\Controllers\PatientsController@updatePatient');
Route::post('update_patient/{id}', '\App\Http\Controllers\PatientsController@update');

Route::get('delete_patient/{id}', '\App\Http\Controllers\PatientsController@destroy');

//**** Doctors ****//
Route::get('doctors', '\App\Http\Controllers\DoctorsController@showAllData');
Route::get('preview_doctor/{id}', '\App\Http\Controllers\DoctorsController@show');

Route::get('add_doctor', '\App\Http\Controllers\DoctorsController@insertDoctor');
Route::post('add_doctor', '\App\Http\Controllers\DoctorsController@store');

Route::get('update_doctor/{id}', '\App\Http\Controllers\DoctorsController@updateDoctor');
Route::post('update_doctor/{id}', '\App\Http\Controllers\DoctorsController@update');

Route::get('delete_doctor/{id}', '\App\Http\Controllers\DoctorsController@destroy');

//**** Medications ****//
Route::get('medications', '\App\Http\Controllers\MedicationsController@showAllData');
Route::get('preview_medication/{id}', '\App\Http\Controllers\MedicationsController@show');

Route::get('add_medication', '\App\Http\Controllers\MedicationsController@insertMedication');
Route::post('add_medication', '\App\Http\Controllers\MedicationsController@store');

Route::get('update_medication/{id}', '\App\Http\Controllers\MedicationsController@updateMedication');
Route::post('update_medication/{id}', '\App\Http\Controllers\MedicationsController@update');

Route::get('delete_medication/{id}', '\App\Http\Controllers\MedicationsController@destroy');

//**** Planning ****//
Route::get('planning', '\App\Http\Controllers\AgendasController@showAllData');
Route::post('add_time', '\App\Http\Controllers\AgendasController@store');
Route::post('update_time/{id}', '\App\Http\Controllers\AgendasController@update');
Route::get('delete_time/{id}', '\App\Http\Controllers\AgendasController@destroy');



