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

    Route::post('doctor/insert','DoctorController@insert')->name('doctor.insert');
    Route::post('doctor/update','DoctorController@update')->name('doctor.update');


    Route::view('/patients','patients')->name('patients');

    Route::view('/appointments','appointments')->name('appointments');
    Route::view('appointment/add','appointment.add')->name('appointment.add');


    Route::view('schedule','schedule.index')->name('schedule');
    Route::view('schedule/add','schedule.add')->name('schedule.add');

    Route::view('settings','settings')->name('settings');


});


