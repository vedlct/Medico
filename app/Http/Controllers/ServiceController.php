<?php

namespace App\Http\Controllers;


use App\Services;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Session;

class ServiceController extends Controller
{
    public function service_list(){
        return view('services.services');
    }

    public function get_service_list(){
        $services = Services::all();
        $datatables = DataTables::of($services);
        return $datatables->make(true);
    }

    public function insert_service_list(Request $r){
        $service = new Services();
        $service->servicesName = $r->name;
        $service->save();

        Session::flash('message', 'Service Added!');

        return back();
    }

    public function edit_service(Request $r){
        $service = Services::findOrFail($r->id);
        return view('services.service_edit')->with('service', $service);
    }

    public function update_service(Request $r){
        $service = Services::findOrFail($r->id);
        $service->servicesName = $r->name;
        $service->save();

        Session::flash('message', 'Service Updated!');

        return back();
    }

    public function delete_service(Request $r){
        $service = Services::findOrFail($r->id);
        $service->delete();

        Session::flash('message', 'Service Deleted!');

        return back();
    }

}
