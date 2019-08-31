<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Doctor;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{



    public function newPatient() {
        $doctors = Doctor::get();
        return view ('appointment.new_patient', compact('doctors'));

    }

    public function oldPatient() {
        $doctors = Doctor::get();
        return view ('appointment.old_patient', compact('doctors'));
    }

    public function insert(Request $r)
    {

        // $userType = UserType::where('usertypeName', 'patient')->first();

        $appointment = new Appointment();
        $appointment->firstName = $r->firstName;
        $appointment->lastName = $r->lastName;
        $appointment->age = $r->age;
        $appointment->fkdoctorId = $r->fkdoctorId;
        $appointment->appointment_date = $r->appointment_date;
        $appointment->appointment_time = $r->appointment_time;
        $appointment->phone = $r->phone;



        // $appointment->fkuserId=$user->userId;
//        $appointment->status = $r->status;
        $appointment->save();
        Session::flash('message', 'Appointment Created!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('appointments');
    }


    public function index(){
        return view ('appointment.index');
    }

    public function add(){
        return view ('appointment.add');
    }

    public function checkoldpatient (Request $r){


        $appointment = Patient::where('phone', $r->phone)->first();
        return $appointment;


    }


}
