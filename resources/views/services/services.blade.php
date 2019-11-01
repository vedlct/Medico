@extends('main')
@section('content')
    <!-- Add Company Modal -->
    <div class="modal" id="addService" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('services.insert') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Service Name</label>
                                    <input class="form-control" type="text" name="name" required>
                                </div>
                            </div>
                        </div>
                        <div class="m-t-20 text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Add Service</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="editModalBody">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Services</h4>
        </div>
        <div class="col-sm-8 col-9 text-right m-b-20">
            <button type="button" class="btn btn btn-primary btn-rounded float-right" data-toggle="modal" data-target="#addService">
                <i class="fa fa-plus"></i> Add Service
            </button>
            {{--<a href="{{route('appointment.add')}}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Service</a>--}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table" id="myTable">
                    <thead>
                    <tr>
                        <th>Service Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--<tr>--}}
                    {{--<td>APT0001</td>--}}
                    {{--<td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> Denise Stevens</td>--}}
                    {{--<td>35</td>--}}
                    {{--<td>Henry Daniels</td>--}}
                    {{--<td>Cardiology</td>--}}
                    {{--<td>30 Dec 2018</td>--}}
                    {{--<td>10:00am - 11:00am</td>--}}
                    {{--<td><span class="custom-badge status-red">Inactive</span></td>--}}
                    {{--<td class="text-right">--}}
                    {{--<div class="dropdown dropdown-action">--}}
                    {{--<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>--}}
                    {{--<div class="dropdown-menu dropdown-menu-right">--}}
                    {{--<a class="dropdown-item" href="edit-appointment.html"><i class="fa fa-pencil m-r-5"></i> Edit</a>--}}
                    {{--<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_appointment"><i class="fa fa-trash-o m-r-5"></i> Delete</a>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                    {{--<td>APT0002</td>--}}
                    {{--<td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> Denise Stevens</td>--}}
                    {{--<td>35</td>--}}
                    {{--<td>Henry Daniels</td>--}}
                    {{--<td>Cardiology</td>--}}
                    {{--<td>30 Dec 2018</td>--}}
                    {{--<td>10:00am - 11:00am</td>--}}
                    {{--<td><span class="custom-badge status-green">Active</span></td>--}}
                    {{--<td class="text-right">--}}
                    {{--<div class="dropdown dropdown-action">--}}
                    {{--<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>--}}
                    {{--<div class="dropdown-menu dropdown-menu-right">--}}
                    {{--<a class="dropdown-item" href="edit-appointment.html"><i class="fa fa-pencil m-r-5"></i> Edit</a>--}}
                    {{--<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_appointment"><i class="fa fa-trash-o m-r-5"></i> Delete</a>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</td>--}}
                    {{--</tr>--}}
                    </tbody>
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
            table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                "ajax": {
                    "url": "{!! route('services.getAllData') !!}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                    },
                },
                columns: [
                    {data: 'servicesName', name: 'servicesName'},
                    {
                        "data": function (data) {
                            return '&nbsp;&nbsp;<a style="cursor: pointer; color: rgba(236,39,50,0.98)" data-panel-id="' + data.servicesId + '" onclick="delete_data(this)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>&nbsp;&nbsp; <a style="cursor: pointer; color: #4881ecfa" data-panel-id2="' + data.servicesId + '" onclick="edit_data(this)"><i class="fa fa-edit" aria-hidden="true"></i></a>';},
                        "orderable": false, "searchable": false, "name": "action"},
                ],
            });
        });
        function edit_data(x) {
            id = $(x).data('panel-id2');
            $.ajax({
                type: 'POST',
                url: "{!! route('service.edit') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'id': id,
                },
                success: function (data) {
                    $('#editModalBody').html(data);
                    $('#editModal').modal('show');
                }
            });
        }
        function delete_data(x) {
            var id = $(x).data('panel-id');
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure want to delete!',
                buttons: {
                    confirm: function () {
                        // delete
                        $.ajax({
                            type: 'POST',
                            url: "{!! route('services.delete') !!}",
                            cache: false,
                            data: {
                                _token: "{{csrf_token()}}",
                                id: id
                            },
                            success: function () {
                                $.alert({
                                    // animationBounce: 2,
                                    title: 'Success!',
                                    content: 'Service Deleted.',
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
