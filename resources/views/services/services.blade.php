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
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Service Name</label>
                                    <input class="form-control" type="text" name="name">
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
                        <th class="text-right">Action</th>
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
@endsection

@section('js')

    <script>
        dataTable=  $('#myTable').DataTable({
            rowReorder: {
                selector: 'td:nth-child(0)'
            },
            responsive: true,
            processing: true,
            serverSide: true,
            Filter: true,
            stateSave: true,
            ordering:false,
            type:"POST",
            "ajax":{
                "url": "{!! route('services.getAllData') !!}",
                "type": "POST",
                data:function (d){
                    d._token="{{csrf_token()}}";
                },
            },
            columns: [
                { data: 'servicesName', name: 'services.servicesName' },

                { "data": function(data)
                    {
                        // return '<button class="btn btn-success btn-sm mr-2" data-panel-id="'+data.tenderId+'" onclick="editTender(this)"><i class="far fa-edit"></i>Edit</button>'+
                        //        '<button class="btn btn-danger btn-sm" data-panel-id="'+data.tenderId+'" onclick="deleteTender(this)"><i class="fa fa-trash fa-lg"></i>Delete</button>';
                        //
                        return '<div class="text-right">' +
                            '<div class="dropdown dropdown-action">' +
                                    '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>' +
                                    '<div class="dropdown-menu dropdown-menu-right">' +
                                        '<button style="cursor: pointer;" class="dropdown-item" data-panel-id="'+data.servicesId+'" onclick="edit_data(this)"><i class="fa fa-pencil m-r-5"></i> Edit</button >' +
                                        '<button style="cursor: pointer;" class="dropdown-item" data-panel-id="'+data.servicesId+'" onclick="delete_data(this)"><i class="fa fa-trash-o m-r-5"></i> Delete</button >' +
                                    '</div>' +
                                '</div>'+
                            '</div>';
                    },
                    "orderable": false, "searchable":false, "name":"selected_rows"
                },
            ]
        } );


        function edit_data(x) {
            id = $(x).data('panel-id');

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
            btn = $(x).data('panel-id');
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
                                'id': btn
                            },
                            success: function (data) {
                                $.alert({
                                    animationBounce: 2,
                                    title: 'Success!',
                                    content: 'Service Deleted.',
                                });
                                dataTable.ajax.reload();
                            }
                        });

                    },
                    cancel: function () {

                    },
                }
            });
        }

    </script>

@endsection