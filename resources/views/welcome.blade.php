@extends('main')

@section('content')


    <div class="row">
        <div class="col-12 col-md-6 col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-inline-block">Upcoming Appointments</h4> <a href="appointments.html" class="btn btn-primary float-right">View all</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="appointmentTable" class="table mb-0">
                            <thead class="d-none">
                            <tr>
                                <th>Patient Name</th>
                                <th>Doctor Name</th>
                                <th>Timing</th>
                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection

@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            table = $('#appointmentTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax": {
                    "url": "{!! route('welcome.show') !!}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                    },
                },
                columns: [
                    {data: 'patientname', name: 'patientname'},
                    {data: 'doctorname', name: 'doctorname'},
                    {data: 'appointment_time', name: 'appointment.appointment_time'},
                    // {data: 'patientName', name: 'appointment.patientName'},

                ],
            });
        });
    </script>

@endsection
