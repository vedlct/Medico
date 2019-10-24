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
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Doctor Name</th>
                        <th>Doctor Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>


    <meta name="csrf-token" content="{{ csrf_token() }}" />


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
                        d._token = "{{ csrf_token() }}";
                    },
                },
                columns: [
                    {data: 'patientname', name: 'patientname'},
                    {data: 'age', name: 'appointment.age'},
                    {data: 'phone', name: 'appointment.phone'},
                    {data: 'email', name: 'appointment.email'},
                    {data: 'gender', name: 'appointment.gender'},
                    {data: 'address', name: 'appointment.address'},
                    {data: 'doctorname', name: 'doctorname'},
                    {data: 'status', name: 'appointment.status'},
                    // {data: 'patientName', name: 'appointment.patientName'},
                    {"data": function(data){
                            return '&nbsp;&nbsp;<a style="cursor: pointer; color: #4881ecfa" data-panel-id="'+data.appointmentId+'"onclick="deleteAppointment(this)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';},
                        "orderable": false, "searchable":false, "name":"action" },
                ],

            });
        });


        function deleteAppointment(x)
        {
            var id = $(x).data('panel-id');

            // alert(id);
            $.confirm({
                title: "CONFIRM",
                content: "Are you sure?",
                buttons: {
                    confirm: function() {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('appointment.delete') }}",
                            data: {id: id},
                            success: function(data) {

                                // alert(data);

                                $.alert({
                                    title: "Successful!",
                                    content: "Appointment Deleted."
                                });
                                table.ajax.reload();
                            }

                        });
                    },
                    cancel: function() {

                    }
                }
            });



        }
    </script>




@endsection

