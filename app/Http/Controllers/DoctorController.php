<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\User;
use App\UserType;
use Session;
use Image;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index() {
         $doctors = Doctor::simplePaginate(8);

//         $doctors->withPath('custom/url');

        return view('doctor.index',compact('doctors'));
    }

    public function edit($id) {

        $doctors = Doctor::select('doctor.*','user.password')->leftJoin('user','user.userId','doctor.doctorId')->findOrfail($id);

        return view('doctor.edit',compact('doctors'));
    }

    public function delete($id) {

        $doctor = Doctor::findOrFail($id);
        $doctor->status = USER_STATUS['Deleted'];
        $doctor->save();
//        $doctor->delete();

        $user = User::findOrFail($doctor->fkuserId);
        $user->status = USER_STATUS['Deleted'];
        $user->save();
//        $user->delete();

        Session::flash('message', 'Doctor Deleted!');
        return back();

    }

    public function insert(Request $r) {

        $userType = UserType::where('usertypeName','doctor')->first();

        $user = new User();
        $user->firstName = $r->firstName;
        $user->lastName = $r->lastName;
        $user->email = $r->email;
        $user->phone = $r->phone;
        $user->password = $r->password;
        $user->fkusertypeId = $userType->usertypeId;
        $user->status = $r->status;
        $user->save();

        $doctor = new Doctor();
        $doctor->firstName = $r->firstName;
        $doctor->lastName = $r->lastName;
        $doctor->degree = $r->degree;
        $doctor->email = $r->email;
        $doctor->gender = $r->gender;
        $doctor->phone = $r->phone;
        $doctor->address = $r->address;
        $doctor->fkuserId = $user->userId;
        $doctor->status = $r->status;
        $doctor->save();

        if($r->hasFile('image')) {
            $img = $r->file('image');
            $filename = $doctor->doctorId.'Image'.'.'.$img->getClientOriginalExtension();
            $doctor->image = $filename;
            $location = public_path('doctorImages/'.$filename);
            Image::make($img)->save($location);
            $location2 = public_path('doctorImages/thumb/'.$filename);
            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location2);
        }

        $doctor->save();

        Session::flash('message', 'Doctor Created!');
        Session::flash('alert-class', 'alert-success');

        return redirect('doctors');

    }

    public function update(Request $r) {

            $userType=UserType::where('usertypeName','doctor')->first();



            $doctor=Doctor::findOrFail($r->doctorId);

            $doctor->firstName = $r->firstName;
            $doctor->lastName = $r->lastName;
            $doctor->degree = $r->degree;
            $doctor->email = $r->email;
            $doctor->gender = $r->gender;
            $doctor->phone = $r->phone;
            $doctor->address = $r->address;
//        $doctor->fkuserId=$user->userId;
            $doctor->status = $r->status;

            $doctor->save();

        $user=User::findOrFail($doctor->fkuserId);

        $user->firstName = $r->firstName;
        $user->lastName = $r->lastName;
        $user->email = $r->email;
        $user->phone = $r->phone;
        $user->password = $r->password;
        $user->fkusertypeId = $userType->usertypeId;
        $user->status = $r->status;

        $user->save();


        if($r->hasFile('image')){

            $img = $r->file('image');
            $filename = $doctor->doctorId.'Image'.'.'.$img->getClientOriginalExtension();
            $doctor->image = $filename;
            $location = public_path('doctorImages/'.$filename);
            Image::make($img)->save($location);
            $location2 = public_path('doctorImages/thumb/'.$filename);
            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location2);
        }

        $doctor->save();

        Session::flash('message', 'Doctor Updated!');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('doctors');

    }

}
