<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index() {
        return view('appointments');
    }

    public function add() {
        return view('appointment.add');
    }

    public function newPatient() {
        return view('appointment.new_patient');
    }
}
