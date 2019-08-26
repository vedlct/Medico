<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\WorkingHour;
use Illuminate\Http\Request;
use Session;

class ScheduleController extends Controller
{
    public function index() {
        return view('schedule.index');
    }

    public function add() {
        $doctors = Doctor::select('doctorId', 'firstName', 'lastName')->get();
        return view('schedule.add', compact('doctors'));
    }
    public function insertdata(Request $r ){


        //return $r->days;

        foreach ($r->days as $day){
            $schedule = new WorkingHour();
            $schedule->fkdoctorId = $r->doctorId;
            $schedule->day = $day;
            $schedule->start_time = date('h:i:s', strtotime($r->start_time));
            $schedule->end_time = date('h:i:s', strtotime($r->end_time));
            $schedule->save();
        }

        return redirect(route('schedule'));



    }
}
