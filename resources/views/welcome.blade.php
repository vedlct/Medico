@extends('main')

@section('content')

    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th, td {
            padding: 5px;
        }

        th {
            text-align: left;
        }


    </style>

    <body onload="makeTableScroll();">


    <div class="row">
        <div class="col-12 col-md-5 col-lg-5 col-xl-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Upcoming Appointments</h4> <a href="{{'appointment'}}"
                                                                                        class="btn btn-primary float-right">View
                        detailed List</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="mytable" style="width: 100%">
                            <thead>
                            <tr>

                                <td>Patient Name</td>
                                <td>Age</td>
                                <td>Doctor Name</td>
                                <td>Phone</td>
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

    </div>

    <div class="row">
        <div class="col-12 col-md-5 col-lg-5 col-xl-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Today doctors schedule</h4> <a href="{{'appointment'}}"
                                                                                        class="btn btn-primary float-right">View
                        detailed List</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="mytable" style="width: 100%">
                            <thead>
                            <tr>

                                <td>Doctors name</td>
                                <td>Start time</td>
                                <td>End time</td>

                            </tr>
                            </thead>

                            <tbody>


                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->doctorname}}</td>
                                    <td>{{$user->start_time}}</td>
                                    <td>{{$user->end_time}}</td>
                                </tr>

                            @endforeach
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </body>

@endsection

@section('js')

    <script type="text/javascript">

        function makeTableScroll() {
            // Constant retrieved from server-side via JSP
            var maxRows = 10;

            var table = document.getElementById('mytable');
            var wrapper = table.parentNode;
            var rowsInTable = table.rows.length;
            var height = 0;
            if (rowsInTable > maxRows) {
                for (var i = 0; i <= maxRows; i++) {
                    height += table.rows[i].clientHeight;
                }
                wrapper.style.height = height + "px";
            }
        }


    </script>





@endsection







