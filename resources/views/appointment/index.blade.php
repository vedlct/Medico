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
                <table id="appointmentTable" class="table table-striped custom-table">
                    <thead>
                    <tr>

                        <th>Patient Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Doctor Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Day</th>
                        <th>Doctor Status</th>
                        <th>Appointment Time</th>
                        <th>Address</th>


                        <th>Action</th>
                    </tr>
                    </thead>

                </table>
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
                    "url": "{!! route('appointment.show') !!}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                    },
                },
                columns: [
                    {data: 'patientname', name: 'patientname'},
                    {data: 'age', name: 'appointment.age'},
                    {data: 'gender', name: 'gender'},
                    {data: 'doctorname', name: 'doctorname'},
                    {data: 'email', name: 'appointment.email'},
                    {data: 'phone', name: 'appointment.phone'},
                    {data: 'day', name: 'appointment.day'},
                    {data: 'status', name: 'status'},
                    {data: 'appointment_time', name: 'appointment.appointment_time'},
                    // {data: 'patientName', name: 'appointment.patientName'},
                    {data: 'address', name: 'appointment.address'},
                    { "data": function(data){
                            return '&nbsp;&nbsp;<a style="cursor: pointer; color: #4881ecfa" data-panel-id="'+data.appointmentId+'"onclick="deleteAppointment(this)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';},
                        "orderable": false, "searchable":false, "name":"action" },
                ],
            });
        });
        function deleteAppointment(x)
        {
            var id = $(x).data('panel-id');
            $.ajax({
                type: "post",
                url: "{{route('appointment.delete')}}",
                data: {id: id},
                success: function (data) {
                    // alert(data);
                    table.ajax.reload();
                }
            });
        }
    </script>




@endsection
