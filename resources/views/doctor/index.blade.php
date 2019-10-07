@extends('main')

@section('content')

        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Doctors</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{route('doctor.add')}}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Doctor</a>
            </div>
        </div>
        <div class="row doctor-grid">
            @foreach($doctors as $d)

            <div class="col-md-4 col-sm-4  col-lg-3">
                <div class="profile-widget">
                    <div class="doctor-img">
                        @if($d->image != null)

                            <a class="avatar" href="#"><img alt="" src="{{url('public')}}/doctorImages/thumb/{{$d->image}}"></a>
                        @else

                            <a class="avatar" href="#"><img alt="" src="{{url('public')}}/doctorImages/thumb/dummyImage.png"></a>
                        @endif


                    </div>
                    <div class="dropdown profile-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('doctor.edit',['id'=>$d->doctorId])}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                            <a class="dropdown-item" onclick="return confirm('Are you sure?')" href="{{ route('doctor.delete',['id'=>$d->doctorId]) }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                        </div>
                    </div>

                    <h4 class="doctor-name text-ellipsis"><a href="profile.html">{{$d->firstName." ".$d->lastName}}</a></h4>
                    <div class="doc-prof">{{$d->degree}}</div>
                    <div class="doc-prof"><b>Email</b>: {{$d->email}}</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="doc-prof"><b>Phone</b>: {{$d->phone}}</div>
                        </div>
                        <div class="col-md-6">
                            @foreach(USER_STATUS as $key=>$value)
                                @if($value==$d->status)
                                    <div class="doc-prof"><b>Status</b>: {{$key}}</div>
                                @endif
                            @endforeach
                        </div>

                    </div>
                    <div class="user-country">
                        <i class="fa fa-map-marker"></i> {{$d->address}}
                    </div>
                </div>
            </div>
            @endforeach



        </div>



        <div class="row">
            <div class="col-sm-12">
                <div align="center" class="see-all">
                    {{$doctors->links()}}
{{--                    <a class="see-all-btn" href="javascript:void(0);">Load More</a>--}}
                </div>
            </div>
        </div>








@endsection
