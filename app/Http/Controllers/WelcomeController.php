<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Doctor;
use App\Patient;
use App\WorkingHour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class WelcomeController extends Controller

{
    public function index(Request $r)
    {
        $users = Appointment::select(DB::raw("concat(`patient`.`firstName`,' ',`patient`.`lastName`) as patientname"), DB::raw("concat(`doctor`.`firstName`, ' ' , `doctor`.`lastName`) as doctorname"), 'fkdoctorId', 'fkpatientId', 'patient.age', 'patient.phone')
            ->leftjoin('doctor', 'fkdoctorId', 'doctorId')
            ->leftjoin('patient', 'fkpatientId', 'patientId')->limit(10)->get();

        $doctorLists = WorkingHour::select(DB::raw("concat(doctor.firstName, ' ' , doctor.lastName) as doctorname , DATE_FORMAT(start_time,'%h:%i %p') as start_time, DATE_FORMAT(end_time,'%h:%i %p') as end_time "), 'working_hourId', 'fkdoctorId', 'day')
        ->leftjoin('doctor', 'fkdoctorId', 'doctorId')
        ->where('day', '=', Carbon::today()->format('l'))->get();


//        $nodoctorLists = WorkingHour::select('working_hourId', 'fkdoctorId', 'day')
//            ->leftjoin('doctor', 'fkdoctorId', 'doctorId')
//            ->where('day', '!=', Carbon::today()->format('l'))->get();

        $showDoctorCounts = Doctor::all()->count();
        $showPatientCounts = Patient::all()->count();

        $messages = ['No doctor is available today'];


        return view('welcome', compact('users', 'doctorLists','showDoctorCounts','showPatientCounts','messages'));


    }


}
