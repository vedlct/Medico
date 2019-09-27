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
        // $patient->fkuserId=$user->userId;
//        $patient->status = $r->status;
        $patient->save();
        Session::flash('message', 'New Patient Added!');
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
//        $patient->fkuserId=$user->userId;
        //$patient->status=$r->status;
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
    public function showAllPatientInfo()
    {
        $patientInfo = Patient::select(DB::raw("concat(`patient`.`firstName`, ' ' ,`patient`.`lastName`) as fullname"),DB::raw("CASE WHEN gender = 1 THEN 'Male' WHEN gender = 2 THEN 'Female' END  AS gender"), 'patientId', 'age','address','phone')
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
        $patient=Patient::findOrFail($request->id);
        $patient->delete();
    }
}