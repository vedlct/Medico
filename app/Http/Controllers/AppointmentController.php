<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Doctor;
use App\Patient;
use App\WorkingHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AppointmentController extends Controller
{



    public function newPatient() {
        $doctors = Doctor::get();
        return view ('appointment.new_patient', compact('doctors'));

    }

//    public function oldPatient() {
//        $doctors = Doctor::get();
//        return view ('appointment.old_patient', compact('doctors'));
//    }

    public function insert(Request $r)
    {

        $appointment = new Appointment();
        $appointment->firstName = $r->firstName;
        $appointment->lastName = $r->lastName;
        $appointment->age = $r->age;
        $appointment->gender = $r->gender;
        $appointment->fkdoctorId = $r->doctorId;
        $appointment->appointment_date = $r->appointment_date;
        $appointment->appointment_time = date('H:i ', strtotime($r->appointment_time));
        $appointment->phone = $r->phone;

        $appointment->save();
        Session::flash('message', 'Appointment Created!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('appointments');
    }

    public function showAppointment() {
        $appointmentInfo = Appointment::select(DB::raw("concat(`patient`.`firstName`, ' ' , `patient`.`lastName`) as patientname , DATE_FORMAT(`appointment_time`,'%h:%i %p') as appointment_time "), 'appointment','fkdoctorId')
            ->leftjoin('doctor','fkdoctorId','doctorId')->get();

        $datatables = Datatables::of($appointmentInfo);
        return $datatables->make(true);

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

    public function deleteAppointment(Request $request)
    {
        $appointment=WorkingHour::findOrFail($request->id);


        $appointment->delete();
    }


}
