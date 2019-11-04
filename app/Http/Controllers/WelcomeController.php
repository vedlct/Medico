<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Doctor;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class WelcomeController extends Controller

{
   public function index(){
       $welcomePage = Appointment::paginate(5);
       return view('welcome', compact('welcomePage'));
   }
    public function showWelcome()
    {

        $welcomeInfo = Appointment::select(DB::raw("concat(`patient`.`firstName`,' ',`patient`.`lastName`) as patientname"), DB::raw("concat(`doctor`.`firstName`, ' ' , `doctor`.`lastName`) as doctorname"), DB::raw("DATE_FORMAT(`appointment_time`,'%h:%i %p') as appointment_time"), 'fkdoctorId', 'fkpatientId')
            ->leftjoin('doctor', 'fkdoctorId', 'doctorId')
            ->leftjoin('patient', 'fkpatientId', 'patientId')->get();

        $datatables = DataTables::of($welcomeInfo);
        return $datatables->make(true);

    }

}
