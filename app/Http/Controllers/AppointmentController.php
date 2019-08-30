<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Patient;
use Illuminate\Http\Request;

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


    public function index(){
        return view ('appointment.index');
    }

    public function add(){
        return view ('appointment.add');
    }

    public function checkoldpatient (Request $r){


        $patient = Patient::where('phone', $r->phone)->first();
        return $patient;


    }


}
