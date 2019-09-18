<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\WorkingHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Yajra\DataTables\DataTables;

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
            $schedule->start_time = date('H:i ', strtotime($r->start_time));
            $schedule->end_time = date('H:i ', strtotime($r->end_time));
            $schedule ->start_date = date('Y-m-d',strtotime($r->start_date));

            $schedule->save();
        }

        return redirect(route('schedule'));

    }

    public function showSchedule() {
        $scheduleInfo = WorkingHour::select(DB::raw("concat(`doctor`.`firstName`, ' ' , `doctor`.`lastName`) as doctorname , DATE_FORMAT(`start_time`,'%h:%i %p') as start_time, DATE_FORMAT(`end_time`,'%h:%i %p') as end_time, DATE_FORMAT(`start_date`,'%d-%m-%Y') as start_date"), 'working_hourId','fkdoctorId','day')
            ->leftjoin('doctor','fkdoctorId','doctorId')->get();

        $datatables = Datatables::of($scheduleInfo);
        return $datatables -> make(true);
    }

    public function deleteSchedule(Request $request)
    {
        $schedule=WorkingHour::findOrFail($request->id);


        $schedule->delete();
    }

    public function editSchedule(Request $request)
    {
        $schedule=WorkingHour::findOrFail($request->id);
//        $schedule.day = $request->day;

        return view('schedule.edit', compact('schedule'));


//        $schedule->delete();
    }

}
