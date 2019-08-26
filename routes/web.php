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

Route::group(['middleware'=>['auth']],function (){
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    Route::view('admin/login','login');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('doctors','DoctorController@index')->name('doctors');
    Route::view('doctor/add','doctor.add')->name('doctor.add');
    Route::get('doctor/edit/{id}','DoctorController@edit')->name('doctor.edit');
    Route::get('doctor/update/{id}','DoctorController@delete')->name('doctor.delete');

    Route::post('doctor/insert','DoctorController@insert')->name('doctor.insert');
    Route::post('doctor/update','DoctorController@update')->name('doctor.update');


    Route::get('/patient','PatientController@index')->name('patients');
    Route::get('/patient/add','PatientController@add')->name('patients.add');

    Route::post('/patient/insert','PatientController@insert')->name('patient.insert');
    Route::post('/patient/update','PatientController@update')->name('patient.update');
    Route::post('/patientShow','PatientController@showAllPatientInfo')->name('patients.show');

    Route::post('/patient-delete', 'PatientController@deletepatient')->name('patient.delete');

    Route::view('/appointments','appointments')->name('appointments');
    Route::view('appointment/add','appointment.add')->name('appointment.add');


    Route::view('schedule','schedule.index')->name('schedule');
    Route::view('schedule/add','schedule.add')->name('schedule.add');

    Route::view('settings','settings')->name('settings');


    //----------- ServiceController ------------------//
    Route::get ('services',          'ServiceController@service_list')        ->name('services');
    Route::post('services-get-data', 'ServiceController@get_service_list')    ->name('services.getAllData');
    Route::post('services-insert',   'ServiceController@insert_service_list') ->name('services.insert');
    Route::post('services-edit',     'ServiceController@edit_service')        ->name('service.edit');
    Route::post('services-update',   'ServiceController@update_service')      ->name('service.update');
    Route::post('services-delete',   'ServiceController@delete_service')      ->name('services.delete');




});

//----------- appointment Sms ------------------//
Route::get('/daily-AppointmentSms', 'SmsController@dailyAllAppointment')->name('sms.dailyAllAppointment');


