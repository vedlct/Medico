<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
class PatientController extends Controller
{
    public function index()
    {

        $patients = Patient::paginate(12);

        return view('patient.index', compact('patients'));
    }

    public function add()
    {

        $patients = Patient::paginate(12);

        return view('patient.add', compact('patients'));
    }

    public function insert(Request $r)
    {

        // $userType = UserType::where('usertypeName', 'patient')->first();

        $patient = new Patient();
        $patient->firstName = $r->firstName;
        $patient->lastName = $r->lastName;
        $patient->age = $r->age;
        $patient->gender = $r->gender;
        $patient->address = $r->address;
        $patient->phone = $r->phone;
        // $patient->fkuserId=$user->userId;
//        $patient->status = $r->status;
        $patient->save();
        Session::flash('message', 'Patient List Created!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('patients');
    }

    public function update(Request $r){
         //$userType=UserType::where('usertypeName','patient')->first();
        $patient=Patient::findOrFail($r->patientId);
        $patient->firstName = $r->firstName;
        $patient->lastName = $r->lastName;
        $patient->age = $r->age;
        $patient->gender = $r->gender;
        $patient->address = $r->address;
        $patient->phone = $r->phone;
        $patient->email = $r->email;
//        $patient->fkuserId=$user->userId;
        //$patient->status=$r->status;

        $patient->save();

        $patient->save();

        Session::flash('message', 'Doctor Updated!');
        Session::flash('alert-class', 'alert-success');

        return back();


    }

    public function edit($id)
    {



        $patient= Patient::findOrFail($id);

        return view('patient.edit',compact('patient'));

    }



    public function showAllPatientInfo()
    {
        $patientInfo = patient::orderBy('patientId', 'ASC');

        $datatables = Datatables::of($patientInfo);
        return $datatables->make(true);
    }



    public function deletepatient(Request $request)
    {
        $patient=Patient::findOrFail($request->id);


         $patient->delete();
    }



}
