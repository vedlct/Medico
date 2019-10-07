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
                            <th >Action</th>

                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <meta name="csrf-token" content="{{ csrf_token() }}" />






@endsection
@section('js')
    <script type="application/javascript">
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
                ajax: {
                    url: "{!! route('schedule.datashow') !!}",
                    type: "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                    },
                },
                columns: [

                    {data: 'doctorname', name: 'doctorname'},
                    {data: 'day', name: 'day'},
                    {data: 'start_time', name: 'start_time' },
                    {data: 'end_time', name: 'end_time'},

                    { "data": function(data) {
                            return '&nbsp;&nbsp;<a style="cursor: pointer; color: #4881ecfa" data-panel-id="'+data.working_hourId+'"onclick="deleteSchedule(this)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>&nbsp;&nbsp;<a style="cursor: pointer; color: #4881ecfa" data-panel-id2="'+data.working_hourId+'"onclick="editSchedule(this)"><i class="fa fa-edit" aria-hidden="true"></i></a> ';
                        },
                        "orderable": false, "searchable":false, "name":"action"
                    },

                ],

            });
        });

        function editSchedule(x) {

            var id = $(x).data('panel-id2');
            var url = '{{ route("schedule.edit", ":id") }}';
            //alert(url);
            var newUrl=url.replace(':id', id);
            window.location.href = newUrl;


            {{--$.ajax({--}}
            {{--    type: "post",--}}
            {{--    url: "{{route('schedule.edit')}}",--}}
            {{--    data: {id: id2},--}}
            {{--    success: function (data) {--}}

            {{--        // alert(data);--}}
            {{--        table.ajax.reload();--}}
            {{--    }--}}

            {{--});--}}

        }

        function deleteSchedule(x) {

            var id = $(x).data('panel-id');

            $.confirm({
                title: 'Confirm?',
                content: 'Are you sure want to delete!',
                buttons: {
                    confirm: function () {
                        $.ajax({
                            type: "post",
                            url: "{{route('schedule.delete')}}",
                            data: {id: id},
                            success: function () {

                                $.alert({
                                    title: 'Success!',
                                    content: 'Schedule Deleted.',
                                });
                                table.ajax.reload();
                            }

                        });
                    },
                    cancel: function () {

                    }
                }

            });

        }

    </script>

@endsection
