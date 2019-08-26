@extends('main')

@section('content')

        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Schedule</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{route('schedule.add')}}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Schedule</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="showschedule" class="table table-border table-striped custom-table mb-0">
                        <thead>
                        <tr>
                            <th>Doctor Name</th>
{{--                            <th>Department</th>--}}
                            <th>Available Days</th>
                            <th>Start Time</th>
                            <th>End Time</th>
{{--                            <th>Status</th>--}}
{{--                            <th class="text-right">Action</th>--}}
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

            table = $('#showschedule').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax": {
                    "url": "{!! route('schedule.datashow') !!}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                    },
                },
                columns: [

                    {data: 'doctorname', name: 'doctorname'},
                    {data: 'day', name: 'day'},
                    {data: 'start_time', name: 'start_time' },
                    {data: 'end_time', name: 'end_time'},
                    // {data: 'day', name: 'working_hour.day'},
                    // {data: 'day', name: 'working_hour.day'},

                    // { "data": function(data){
                    //         return '&nbsp;&nbsp;<a style="cursor: pointer; color: #4881ecfa" data-panel-id="'+data.patientId+'"onclick="deletepatient(this)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';},
                    //     "orderable": false, "searchable":false, "name":"action" },
                ],

            });
        });

    </script>

@endsection
