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

//Authentication
Auth::routes();

//**** Index ****//
Route::get('/', '\App\Http\Controllers\DashboardController@showAllData')->name('root');;

//account
Route::get('account/updateAccount', '\App\Http\Controllers\AccountController@showAccount')->name('account');
Route::post('account/updateAccount/{id}', '\App\Http\Controllers\AccountController@update');

//**** Patients ****//
Route::get('patients', '\App\Http\Controllers\PatientsController@showAllData');
Route::get('patients/preview_patient/{id}', '\App\Http\Controllers\PatientsController@show');

Route::get('patients/add_patient', '\App\Http\Controllers\PatientsController@insertPatient');
Route::post('patients/add_patient', '\App\Http\Controllers\PatientsController@store');

Route::get('patients/update_patient/{id}', '\App\Http\Controllers\PatientsController@updatePatient');
Route::post('patients/update_patient/{id}', '\App\Http\Controllers\PatientsController@update');

Route::get('patients/delete_patient/{id}', '\App\Http\Controllers\PatientsController@destroy');

//**** Medications ****//
Route::get('medications', '\App\Http\Controllers\MedicationsController@showAllData');
Route::get('medications/preview_medication/{id}', '\App\Http\Controllers\MedicationsController@show');

Route::get('medications/add_medication', '\App\Http\Controllers\MedicationsController@insertMedication');
Route::post('medications/add_medication', '\App\Http\Controllers\MedicationsController@store');

Route::get('medications/update_medication/{id}', '\App\Http\Controllers\MedicationsController@updateMedication');
Route::post('medications/update_medication/{id}', '\App\Http\Controllers\MedicationsController@update');

Route::get('medications/delete_medication/{id}', '\App\Http\Controllers\MedicationsController@destroy');

//**** Appointments ****//
Route::get('appointments', '\App\Http\Controllers\AppointmentsController@showAllData');
Route::get('appointments/{doc_id}', '\App\Http\Controllers\AppointmentsController@showSpeciality');

Route::post('appointments/add_appointment', '\App\Http\Controllers\AppointmentsController@store');
Route::post('appointments/update_appointment/{id}', '\App\Http\Controllers\AppointmentsController@update');
Route::get('appointments/delete_appointment/{id}', '\App\Http\Controllers\AppointmentsController@destroy');



Route::group(['middleware' => ['auth', 'manager']], function() {

    //**** Planning ****//
    Route::get('planning', '\App\Http\Controllers\AgendasController@showAllData');
    Route::post('planning/add_time', '\App\Http\Controllers\AgendasController@store');
    Route::post('planning/update_time/{id}', '\App\Http\Controllers\AgendasController@update');
    Route::get('planning/delete_time/{id}', '\App\Http\Controllers\AgendasController@destroy');

    //settings
    Route::get('settings/', '\App\Http\Controllers\SettingsController@showSettings');
    Route::get('settings/export', '\App\Http\Controllers\SettingsController@export');
    Route::get('settings/drop', '\App\Http\Controllers\SettingsController@drop');
    Route::post('settings/import', '\App\Http\Controllers\SettingsController@import');

    //**** Doctors ****//
    Route::get('doctors', '\App\Http\Controllers\UsersController@showAllData');
    Route::get('doctors/preview_doctor/{id}', '\App\Http\Controllers\UsersController@show');

    Route::get('doctors/add_doctor', '\App\Http\Controllers\UsersController@insertDoctor');
    Route::post('doctors/add_doctor', '\App\Http\Controllers\UsersController@store');

    Route::get('doctors/update_doctor/{id}', '\App\Http\Controllers\UsersController@updateDoctor');
    Route::post('doctors/update_doctor/{id}', '\App\Http\Controllers\UsersController@update');

    Route::get('doctors/delete_doctor/{id}', '\App\Http\Controllers\UsersController@destroy');

});




Route::group(['middleware' => ['auth', 'doctor']], function() {
    //**** Consultations ****//
    Route::get('consultations/{doc_id}', '\App\Http\Controllers\ConsultationsController@showData');
    Route::get('consultations/preview/{app_id}', '\App\Http\Controllers\ConsultationsController@show');

    Route::post('consultations/add', '\App\Http\Controllers\ConsultationsController@add_cons_redirect');
    Route::get('consultations/add/{app_id}', '\App\Http\Controllers\ConsultationsController@insert_consultation');
    Route::post('consultations/add/{app_id}', '\App\Http\Controllers\ConsultationsController@store');

    Route::get('consultations/edit/{app_id}', '\App\Http\Controllers\ConsultationsController@update_consultation');
    Route::post('consultations/edit/{app_id}', '\App\Http\Controllers\ConsultationsController@update');

    Route::get('consultations/delete/{app_id}', '\App\Http\Controllers\ConsultationsController@destroy');

    //medical reports
    Route::get('medical_records/{doc_id}', '\App\Http\Controllers\ConsultationsController@medicalRecords');
    Route::get('medical_records/patient_History/{app_id}', '\App\Http\Controllers\ConsultationsController@patientHistory');


    //Prescription (crud)
    Route::get('consultations/prescriptions/preview/{app_id}', '\App\Http\Controllers\PrescriptionsController@show');
    Route::get('consultations/prescriptions/print/{app_id}', '\App\Http\Controllers\PrescriptionsController@printPres');

    Route::get('consultations/prescriptions/{app_id}', '\App\Http\Controllers\PrescriptionsController@insert_prescription');
    Route::post('consultations/prescriptions/{app_id}', '\App\Http\Controllers\PrescriptionsController@store');

    Route::get('consultations/prescriptions/deleteMed/{pres_id}/{med_id}', '\App\Http\Controllers\PrescriptionsController@destroyMedic');
    Route::get('consultations/prescriptions/delete/{pres_id}', '\App\Http\Controllers\PrescriptionsController@destroy');

    //Certificate
    Route::get('consultations/certificates/preview/{app_id}', '\App\Http\Controllers\CertificatesController@show');
    Route::get('consultations/certificates/print/{app_id}', '\App\Http\Controllers\CertificatesController@printCert');

    Route::get('consultations/certificates/{cons_id}', '\App\Http\Controllers\CertificatesController@insert_certificate');
    Route::post('consultations/certificates/{cons_id}', '\App\Http\Controllers\CertificatesController@store');
    Route::get('consultations/certificates/delete/{cons_id}', '\App\Http\Controllers\CertificatesController@destroy');

    //history
    Route::get('consultations/history/{app_id}', '\App\Http\Controllers\ConsultationsController@history');

});









