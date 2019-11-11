@extends('main')

@section('content')

    <style>
        table, th, td {
            border: 2px;
            border-collapse: collapse;
        }

        th, td {
            padding: 5px;
            border: 2px;
        }

        th, td {
            text-align: left;
            border: 2px;
        }


    </style>

    <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
            <div class="dash-widget">
                <span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
                <div class="dash-widget-info text-right">
                    <h3>{{$showDoctorCounts}}</h3>
                    <span class="widget-title1">Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>


        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
            <div class="dash-widget">
                <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
                <div class="dash-widget-info text-right">
                    <h3>{{$showPatientCounts}}</h3>
                    <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
    </div>




    <div class="row">
        <div class="col-6 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Upcoming Appointments</h4> <a href="{{'appointment'}}"
                                                                                        class="btn btn-primary float-right">View
                        detailed List</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0" id="mytable" style="width: 100%">
                            <thead>
                            <tr>

                                <td><b>Patient Name</b></td>
                                <td><b>Age</b></td>
                                <td><b>Doctor Name</b></td>
                                <td><b>Phone</b></td>
                            </tr>
                            </thead>

                            <tbody>


                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->patientname}}</td>
                                    <td>{{$user->age}}</td>
                                    <td>{{$user->doctorname}}</td>
                                    <td>{{$user->phone}}</td>
                                </tr>

                            @endforeach


                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-6 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Today doctors schedule</h4> <a href="{{'schedule'}}"
                                                                                         class="btn btn-primary float-right">View
                        detailed List</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="mytable" style="width: 100%">
                            <thead>
                            <tr>

                                <td><b>Doctors name</b></td>
                                <td><b>Start time</b></td>
                                <td><b>End time</b></td>

                            </tr>
                            </thead>

                            <tbody>

                            @if(count($doctorLists)>0)

                                @foreach($doctorLists as $doctorList)


                                    <tr>
                                        <td>{{$doctorList->doctorname}}</td>
                                        <td>{{$doctorList->start_time}}</td>
                                        <td>{{$doctorList->end_time}}</td>
                                    </tr>

                                @endforeach

                            @else
                                <td style="text-align: right">{{'No doctors are available today'}}</td>
                            @endif
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection















