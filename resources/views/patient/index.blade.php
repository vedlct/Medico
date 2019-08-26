@extends('main')
@section('content')

    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Patients</h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{route('patients.add')}}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add patient</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="patientstable" class="table table-border table-striped custom-table mb-0">
                    <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th class="text-right">Action</th>
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

            table = $('#patientstable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax": {
                    "url": "{!! route('patients.show') !!}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                    },
                },
                columns: [

                    {data: 'firstName', name: 'patient.firstName'},
                    {data: 'lastName', name: 'patient.lastName'},
                    {data: 'age', name: 'patient.age'},
                    {data: 'gender', name: 'patient.gender'},
                    {data: 'address', name: 'patient.address'},
                    {data: 'phone', name: 'patient.phone'},
                    {data: 'email', name: 'patient.email'},
                    { "data": function(data){
                            return '&nbsp;&nbsp;<a style="cursor: pointer; color: #4881ecfa" data-panel-id="'+data.patientId+'"onclick="deletepatient(this)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';},
                        "orderable": false, "searchable":false, "name":"action" },
                ],

            });
        });


        function deletepatient(x)
        {


            var id = $(x).data('panel-id');


            $.ajax({
                type: "post",
                url: "{{route('patient.delete')}}",
                data: {id: id},
                success: function (data) {

                    // alert(data);
                    table.ajax.reload();
                }

            });

        }
    </script>
    @endsection
