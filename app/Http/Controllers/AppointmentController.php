<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Doctor;
use App\Patient;
use App\WorkingHour;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AppointmentController extends Controller
{
    public function newPatient()
    {
//        $doctors = Doctor::select('doctorId', 'firstName', 'lastName')->get();
        $doctors = Doctor::select('doctorId', 'firstName', 'lastName')->get();
        $patients = Patient::get();
        return view('appointment.new_patient', compact('doctors', 'patients'));
    }

    public function oldPatient()
    {
        $patients = Patient::get();
        $days = WorkingHour::get();
        $doctors = WorkingHour::select('fkdoctorId', 'doctorId', 'firstName', 'lastName')->leftjoin('doctor', 'fkdoctorId', 'doctorId')->get();
        return view('appointment.old_patient', compact('doctors', 'days', 'patients'));
    }

    public function insert(Request $r)
    {

        $rules = [

            'phone' => 'phone:BD',
            'age' => 'digits_between:0,200',
            'address' => 'regex:/^[a-zA-Z]+$/u|max:255|',
            'email' => 'email',
            'firstName' => 'regex:/^[a-zA-Z]+$/u|max:255|',
            'lastName' => 'regex:/^[a-zA-Z]+$/u|max:255|',


        ];
        $this->validate($r, $rules);
        $checkday = WorkingHour::where('fkdoctorId', $r->doctorId)
            ->where('day', date('l', strtotime($r->day)))
            ->where('start_time', '<=', date('H:i:p', strtotime($r->appointment_time)))
            ->where('end_time', '>=', date('H:i:p', strtotime($r->appointment_time)))->get();
        // return Response()->json($start[4]);
        if (count($checkday) < 1) {
            Session::flash('message', 'Doctor is not available this day ot this time!');
            Session::flash('message', 'Doctor is not available this day ot this time!!');
            Session::flash('alert-class', 'alert-danger');
            return back();
        } else {
            $appointment = new Appointment();
            $appointment->phone = $r->phone;
            $appointment->age = $r->age;
            $appointment->email = $r->email;
            $appointment->gender = $r->gender;
            $appointment->fkpatientId = $r->patientId;
            $appointment->fkdoctorId = $r->doctorId;
            $appointment->address = $r->address;
            $appointment->day = date('l', strtotime($r->day));
            $appointment->appointment_time = date('H:i', strtotime($r->appointment_time));
            $appointment->status = $r->status;
//        $appointment->phone = $r->phone;
            $appointment->save();
            Session::flash('message', 'Appointment Created!');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('appointment');
        }
    }

    public function showAppointment()
    {
        $appointmentInfo = Appointment::select(DB::raw("concat(`patient`.`firstName`, ' ' , `patient`.`lastName`) as patientname"), DB::raw("concat(`doctor`.`firstName`, ' ' , `doctor`.`lastName`) as doctorname"), DB::raw("CASE WHEN patient.gender = 1 THEN 'Male' WHEN patient.gender = 2 THEN 'Female' END  AS gender"), DB::raw("DATE_FORMAT(`appointment_time`,'%h:%i %p') as appointment_time"), 'fkdoctorId', 'fkpatientId', 'patient.age', 'appointment.email', 'patient.phone', 'patient.address', 'appointment.day', DB::raw("CASE WHEN doctor.status = 0 THEN 'Deleted' WHEN doctor.status = 1 THEN 'Active' WHEN doctor.status = 2 THEN 'Inactive' END  AS status"))
            ->leftjoin('doctor', 'fkdoctorId', 'doctorId')
            ->leftjoin('patient', 'fkpatientId', 'patientId')->get();
        $datatables = Datatables::of($appointmentInfo);
        return $datatables->make(true);
    }

    public function index()
    {
        return view('appointment.index');
    }

    public function add()
    {
        $doctors = Doctor::get();
        $patients = Patient::get();
        return view('appointment.add', compact('doctors', 'patients'));
    }

    public function checkoldpatient(Request $r)
    {
        $patient = Patient::where('phone', $r->phone)->first();
        return $patient;
//        echo $patient;
//        var_dump($patient);
//        return view('appointment.add', compact('patient'));
//        $appointment = Patient::where('phone', $r->phone)->first();
//        return $appointment;
    }

    public function checkpatient(Request $r)
    {
        $appointment = Patient::where('patient', $r->patient)->first();
        return $appointment;
    }

    public function checkappointmenttime(Request $r)
    {
        $time = date('H:i ', strtotime($r->time));
        $doctorId = $r->doctorId;
        $appointmenttime = Appointment::
        leftJoin('working_hour', 'working_hour.fkdoctorId', 'appointment.fkdoctorId')
            ->where('working_hour.fkdoctorId', $doctorId)
            ->where('appointment.fkdoctorId', $doctorId)
            ->where('appointment_time', $time)
            ->where(function ($query) use ($time) {
                $query->where('start_time', '<=', $time)
                    ->Where('end_time', '>=', $time);
            })
            ->first();
        return $appointmenttime;
    }

    public function deleteAppointment(Request $request)
    {
        $appointment = WorkingHour::findOrFail($request->id);
        $appointment->delete();
    }
}
