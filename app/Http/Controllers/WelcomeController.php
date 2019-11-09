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
//        $users = Appointment::select(DB::raw("concat(`patient`.`firstName`,' ',`patient`.`lastName`) as patientname"), DB::raw("concat(`doctor`.`firstName`, ' ' , `doctor`.`lastName`) as doctorname"), 'fkdoctorId', 'fkpatientId', 'patient.age', 'patient.phone')
//            ->leftjoin('doctor', 'fkdoctorId', 'doctorId')
//            ->leftjoin('patient', 'fkpatientId', 'patientId')->get();
//
//        $doctorList = WorkingHour::where('fkdoctorId', $r->doctorId)
//            ->where('day',"==",date('l',strtotime(Carbon::today()->toDateString())));
//        return view('welcome', compact('users','doctorList'));

        $day = Carbon::today()->format('l');

        echo $day;

    }




}
