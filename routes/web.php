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


//    Route::view('/patients','patients')->name('patients');
//    Route::post('patientShow','PatientController@showAllPatientInfo')->name('patients.show');

    Route::get('/patients','PatientController@index')->name('patients');
    Route::get('/patients/add','PatientController@add')->name('patients.add');
    Route::post('/patients/insert','PatientController@insert')->name('patient.insert');
    Route::post('/patientsShow','PatientController@showAllPatientInfo')->name('patients.show');
    Route::get('/patient-edit/{id}', 'PatientController@editPatient')->name('patient.edit');
    Route::post('/patient/update','PatientController@update')->name('patient.update');
    Route::post('/patient-delete', 'PatientController@deletepatient')->name('patient.delete');






//    Route::get('appointment','AppointmentController@index')->name('appointments');
    Route::get('appointment/add','AppointmentController@add')->name('appointment.add');
    Route::get('appointment/new','AppointmentController@newPatient')->name('appointment.new');
    Route::post('appointment/show','AppointmentController@showAppointment')->name('appointment.show');
    Route::post('appointment/insert','AppointmentController@insert')->name('appointment.insert');
    Route::post('appointment/delete', 'Appointment@deleteAppointment')->name('appointment.delete');

    Route::get('appointment/old','AppointmentController@oldPatient')->name('appointment.old');

    Route::get('/appointment','AppointmentController@index')->name('appointment');
    Route::post('/appointment','AppointmentController@insert')->name('appointment');
     // Route::view('/appointments','appointments')->name('appointments');
    Route::get('/appointment/add','AppointmentController@add')->name('appointment.add');
    Route::get('/appointment/add','AppointmentController@add')->name('appointment.add');
    Route::post('/appointment/new/checkpatient','AppointmentController@checkpatient')->name('checkpatient');
    Route::post('/appointment/checkappointmenttime','AppointmentController@checkappointmenttime')->name('checkappointmenttime');





//    Route::view('schedule','schedule.index')->name('schedule');
//    Route::view('schedule/add', 'schedule.add')->name('schedule.add');
    Route::get('schedule', 'ScheduleController@index')->name('schedule');
    Route::get('schedule/add', 'ScheduleController@add')->name('schedule.add');
    Route::post('schedule/insert', 'ScheduleController@insertdata')->name('schedule.insert');
    Route::post('show-schedule', 'ScheduleController@showSchedule')->name('schedule.datashow');
    Route::post('/schedule-delete', 'ScheduleController@deleteSchedule')->name('schedule.delete');
//    Route::post('/schedule-edit', 'ScheduleController@editSchedule')->name('schedule.edit');
    Route::get('/schedule-edit/{id}', 'ScheduleController@editSchedule')->name('schedule.edit');
    Route::post('/schedule-update', 'ScheduleController@updateSchedule')->name('schedule.update');

    Route::view('settings','settings')->name('settings');


    //----------- ServiceController ------------------//
    Route::get ('services',          'ServiceController@service_list')        ->name('services');
    Route::post('services-get-data', 'ServiceController@get_service_list')    ->name('services.getAllData');
    Route::post('services-insert',   'ServiceController@insert_service_list') ->name('services.insert');
    Route::post('services-edit',     'ServiceController@edit_service')        ->name('service.edit');
    Route::post('services-update',   'ServiceController@update_service')      ->name('service.update');
    Route::post('services-delete',   'ServiceController@delete_service')      ->name('services.delete');


    //----------- appointment ------------------//

    Route::post('/checkpatient', 'AppointmentController@checkoldpatient')->name('checkoldpatient');


});

//----------- appointment Sms ------------------//
Route::get('/daily-AppointmentSms', 'SmsController@dailyAllAppointment')->name('sms.dailyAllAppointment');


