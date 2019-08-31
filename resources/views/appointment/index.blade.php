@extends('main')

@section('content')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Appointments</h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{route('appointment.add')}}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Appointment</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table">
                    <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Patient Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Doctor Name</th>
                        <th>Department</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Phone</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
