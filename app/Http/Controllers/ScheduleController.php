<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\WorkingHour;
use Carbon\Carbon;
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
            $schedule->save();
        }

        return redirect(route('schedule'));

    }

    public function showSchedule() {
        $scheduleInfo = WorkingHour::select(DB::raw("concat(`doctor`.`firstName`, ' ' , `doctor`.`lastName`) as doctorname , DATE_FORMAT(`start_time`,'%h:%i %p') as start_time, DATE_FORMAT(`end_time`,'%h:%i %p') as end_time "), 'working_hourId','fkdoctorId','day')
            ->leftjoin('doctor','fkdoctorId','doctorId')->get();

        $datatables = Datatables::of($scheduleInfo);
        return $datatables->make(true);
    }

    public function deleteSchedule(Request $request)
    {
        $schedule=WorkingHour::findOrFail($request->id);
//        dd($schedule);
        $schedule->delete();
    }

    public function editSchedule(Request $request)
    {
        $schedule=WorkingHour::findOrFail($request->id);
//        dd($schedule);

        $day=array(
            'Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday');

        return view('schedule.edit', compact('schedule','day'));

    }

    public function updateSchedule(Request $request) {

        $scheduleInfo = WorkingHour::select(DB::raw("concat(`doctor`.`firstName`, ' ' , `doctor`.`lastName`) as doctorname , DATE_FORMAT(`start_time`,'%h:%i %p') as start_time, DATE_FORMAT(`end_time`,'%h:%i %p') as end_time "), 'working_hourId','fkdoctorId','day')
            ->leftjoin('doctor','fkdoctorId','doctorId')->get();
//        $scheduleInfo->save();

        $schedule = WorkingHour::findOrFail($request->working_hourId);
        $schedule->start_time = Carbon::parse($request->start_time)->format('H:i:s');
        $schedule->end_time = Carbon::parse($request->end_time)->format('H:i:s');
        $schedule->day = $request->day;

        $schedule->save();

        return view('schedule.index', compact('schedule','scheduleInfo'));
//        return redirect('schedule', compact('schedule'));

    }

}
