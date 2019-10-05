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

class AppointmentController extends Controller
{



    public function newPatient() {

//        $doctors = Doctor::select('doctorId', 'firstName', 'lastName')->get();
        $doctors = WorkingHour::select('fkdoctorId','doctorId','firstName','lastName')->leftjoin('doctor','fkdoctorId','doctorId')->get();
        $patients =  Patient::get();
        $days = WorkingHour::get();
        return view ('appointment.new_patient', compact('doctors','patients','days'));


    }

    public function oldPatient() {
        $doctors = Doctor::get();
        return view ('appointment.old_patient', compact('doctors'));
    }

    public function insert(Request $r)
    {

        $appointment = new Appointment();
        $appointment->phone = $r->phone;

        $appointment->age = $r->age;
        $appointment->email = $r->email;
        $appointment->gender = $r->gender;
        $appointment->fkpatientId = $r->patientId;
        $appointment->fkdoctorId = $r->doctorId;
        $appointment->address = $r->address;
        $appointment->status = $r->status;
//        $appointment->phone = $r->phone;
        $appointment->save();
        Session::flash('message', 'Appointment Created!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('appointment');
    }

    public function showAppointment() {
        $appointmentInfo = Appointment::select(DB::raw("concat(`patient`.`firstName`, ' ' , `patient`.`lastName`) as patientname , (`doctor`.`firstName`, ' ' , `doctor`.`lastName`) as doctorname") , 'appointment','fkdoctorId','fkpatientId','age','email','phone','address','status')
            ->leftjoin('doctor','fkdoctorId','doctorId')
            ->leftjoin('patient','fkpatientId','patientId')->get();

        $datatables = Datatables::of($appointmentInfo);
        return $datatables->make(true);

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
//        return view('appointment.add', compact('patient'));

        $appointment = Patient::where('phone', $r->phone)->first();
        return $appointment;
    }

    public function checkpatient (Request $r){


        $appointment = Patient::where('patient', $r->patient)->first();
        return $appointment;
    }

    public function checkappointmenttime(Request $r){


            $time = date('H:i ', strtotime($r->time));

            $doctorId = $r->doctorId;
            $appointmenttime = Appointment::
            leftJoin('working_hour','working_hour.fkdoctorId','appointment.fkdoctorId')
                ->where('working_hour.fkdoctorId', $doctorId)
                ->where('appointment.fkdoctorId', $doctorId)
                ->where('appointment_time', $time)
                ->where(function ($query) use($time){
                    $query->where('start_time', '<=', $time)
                        ->Where('end_time', '>=', $time);
                })
                ->first();

            return $appointmenttime;

    }

    public function deleteAppointment(Request $request)
    {
        $appointment=WorkingHour::findOrFail($request->id);



        $appointment->delete();
    }


}
