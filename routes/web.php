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
Route::get('patients', '\App\Http\Controllers\PatientsController@search');
Route::get('patients/preview_patient/{id}', '\App\Http\Controllers\PatientsController@show');

Route::get('patients/add_patient', '\App\Http\Controllers\PatientsController@insertPatient');
Route::post('patients/add_patient', '\App\Http\Controllers\PatientsController@store');

Route::get('patients/update_patient/{id}', '\App\Http\Controllers\PatientsController@updatePatient');
Route::post('patients/update_patient/{id}', '\App\Http\Controllers\PatientsController@update');

Route::get('patients/delete_patient/{id}', '\App\Http\Controllers\PatientsController@destroy');

//**** Doctors ****//
Route::get('doctors', '\App\Http\Controllers\DoctorsController@showAllData');
Route::get('doctors', '\App\Http\Controllers\DoctorsController@search');
Route::get('doctors/preview_doctor/{id}', '\App\Http\Controllers\DoctorsController@show');

Route::get('doctors/add_doctor', '\App\Http\Controllers\DoctorsController@insertDoctor');
Route::post('doctors/add_doctor', '\App\Http\Controllers\DoctorsController@store');

Route::get('doctors/update_doctor/{id}', '\App\Http\Controllers\DoctorsController@updateDoctor');
Route::post('doctors/update_doctor/{id}', '\App\Http\Controllers\DoctorsController@update');

Route::get('doctors/delete_doctor/{id}', '\App\Http\Controllers\DoctorsController@destroy');

//**** Specialisations ****//
Route::get('specialisations', '\App\Http\Controllers\SpecialisationsController@showAllData');
Route::get('specialisations', '\App\Http\Controllers\SpecialisationsController@search');

Route::post('specialisations/add_specialisation', '\App\Http\Controllers\SpecialisationsController@store');
Route::post('specialisations/update_specialisation/{id}', '\App\Http\Controllers\SpecialisationsController@update');
Route::get('specialisations/delete_specialisation/{id}', '\App\Http\Controllers\SpecialisationsController@destroy');

//**** Medications ****//
Route::get('medications', '\App\Http\Controllers\MedicationsController@showAllData');
Route::get('medications', '\App\Http\Controllers\MedicationsController@search');
Route::get('medications/preview_medication/{id}', '\App\Http\Controllers\MedicationsController@show');

Route::get('medications/add_medication', '\App\Http\Controllers\MedicationsController@insertMedication');
Route::post('medications/add_medication', '\App\Http\Controllers\MedicationsController@store');

Route::get('medications/update_medication/{id}', '\App\Http\Controllers\MedicationsController@updateMedication');
Route::post('medications/update_medication/{id}', '\App\Http\Controllers\MedicationsController@update');

Route::get('medications/delete_medication/{id}', '\App\Http\Controllers\MedicationsController@destroy');

//**** Planning ****//
Route::get('planning', '\App\Http\Controllers\AgendasController@showAllData');
Route::post('planning/add_time', '\App\Http\Controllers\AgendasController@store');
Route::post('planning/update_time/{id}', '\App\Http\Controllers\AgendasController@update');
Route::get('planning/delete_time/{id}', '\App\Http\Controllers\AgendasController@destroy');

//**** Appointments ****//
Route::get('appointments', '\App\Http\Controllers\AppointmentsController@showAllData');
Route::get('appointments/{doc_id}', '\App\Http\Controllers\AppointmentsController@showSpeciality');

Route::post('appointments/add_appointment', '\App\Http\Controllers\AppointmentsController@store');
Route::post('appointments/update_appointment/{id}', '\App\Http\Controllers\AppointmentsController@update');
Route::get('appointments/delete_appointment/{id}', '\App\Http\Controllers\AppointmentsController@destroy');

//**** Consultations ****//
Route::get('consultations/{doc_id}', '\App\Http\Controllers\ConsultationsController@showData');



