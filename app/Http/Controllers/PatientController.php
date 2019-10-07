<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $patient->email = $r->email;


        // $patient->fkuserId=$user->userId;
//        $patient->status = $r->status;
        $patient->save();
        Session::flash('message', 'New Patient Added!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('patients');
    }

    public function update(Request $r) {
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

//        $patient->save();


        $patient->patient_customId = getNextOrderNumber();
        $patient->save();

//        return $patient;

        Session::flash('message', 'Patient Rocord Updated!');
        Session::flash('alert-class', 'alert-success');

//        return back();

        return redirect()->route('patients');

    }

    public function editPatient($id)
    {

        $patient= Patient::findOrFail($id);

        return view('patient.edit', compact('patient'));

    }

    public function getNextOrderNumber()
    {
        $patient = new Patient();

        // Get the last created order
        $lastOrder = Patient::orderBy('patient_customId', 'desc')->first();

        if ( ! $lastOrder )
            // We get here if there is no order at all
            // If there is no number set it to 0, which will be 1 at the end.

            $number = 0;
        else
            $number = substr($lastOrder->patient_customId, 3);

        // If we have ORD000001 in the database then we only want the number
        // So the substr returns this 000001

        // Add the string in front and higher up the number.
        // the %05d part makes sure that there are always 6 numbers in the string.
        // so it adds the missing zero's when needed.

        $ord = 'ORD' . sprintf('%06d', intval($number) + 1);
//        return 'ORD' . sprintf('%06d', intval($number) + 1);

        $patient->patient_customId = $ord;
        $patient->save();


//        return $ord;
    }



    public function showAllPatientInfo()
    {

//        $a = getNextOrderNumber();
        $patientInfo = Patient::select(DB::raw("concat(`patient`.`firstName`, ' ' ,`patient`.`lastName`) as fullname"),DB::raw("CASE WHEN gender = 1 THEN 'Male' WHEN gender = 2 THEN 'Female' END  AS gender"), 'patient_customId', 'age','address','phone','email')
            ->orderBy('patientId', 'ASC')
            ->get();

//        $patientInfo = Patient::orderBy('patientId', 'ASC');
//        $patientInfo = Patient::select('patientId');
//        $patientInfo = Patient::select(DB::raw('patientId', 'ASC'))->get();

        $datatables = Datatables::of($patientInfo);
        return $datatables->make(true);
    }



    public function deletepatient(Request $request)
    {
        $patient=Patient::find($request->id);

         $patient->delete();

         Session::flash('message', 'Patient Deleted!');

         return back();

    }



}
