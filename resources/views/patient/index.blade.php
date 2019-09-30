@extends('main')
@section('content')
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Patients</h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="{{ route('patients.add') }}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Patient</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="patientstable" class="table table-border table-striped custom-table mb-0">
                    <thead>
                    <tr>
                        <th>Fullname</th>
                        {{--                        <th>Lastname</th>--}}
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Phone</th>
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
                    {data: 'fullname', name: 'fullname'},
                    // {data: 'lastName', name: 'lastName'},
                    {data: 'age', name: 'age'},
                    {data: 'gender', name: 'gender'},
                    {data: 'address', name: 'address'},
                    {data: 'phone', name: 'phone'},
                    {
                        "data": function(data) {
                            return '&nbsp;&nbsp;<a style="cursor: pointer; color: red" data-panel-id="'+data.patientId+'"onclick="deletepatient(this)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp; <a style="cursor: pointer; color: deepskyblue" data-panel-id2="'+data.patientId+'"onclick="editpatient(this)"><i class="fa fa-edit" aria-hidden="true"></i></a>';},
                        "orderable": false, "searchable":false, "name":"action" },
                ],
            });
        });
        function editpatient(x)
        {
            // var id = $(x).data('panel-id2');
            var id = $(x).data('panel-id2');
            var url = '{{route("patient.edit", ":id") }}';
            // alert(id);
            var newUrl = url.replace(':id', id);
            window.location.href = newUrl;
            {{--$.ajax({--}}
            {{--    type: "post",--}}
            {{--    url: "{{route('patient.update')}}",--}}
            {{--    data: {id: id},--}}
            {{--    success: function (data) {--}}
            {{--        // alert(data);--}}
            {{--        table.ajax.reload();--}}
            {{--    }--}}
            {{--});--}}
        }
        function deletepatient(x)
        {
            var id = $(x).data('panel-id');
            $.ajax({
                type: "post",
                url: "{{route( 'patient.delete' )}}",
                data: {id: id},
                success: function (data) {
                    // alert(data);
                    table.ajax.reload();
                }
            });
        }
    </script>
@endsection