<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{



    public function newPatient() {
        return view('appointment.new_patient');
    }


    public function index(){
        return view ('appointment.index');
    }

    public function add(){
        $doctors = Doctor::get();
        $patients= Patient::get();
        return view ('appointment.add', compact('doctors','patients'));


    }

    public function checkoldpatient (Request $r){


        $patient = Patient::where('phone', $r->phone)->first();
        return $patient;


    }


}
