@extends('main')
@section('content')

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h3 class="page-title">Add Appointment </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="{{ route('appointment.new') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Patient Type : </label>
                                <div class="col-sm-5 col-9 text-right m-b-20">
                                    <a href="{{route('appointment.old')}}" class="btn btn btn-primary btn-rounded float-right"> Old patient</a>
                                </div> &nbsp; &nbsp;

                                <div class="col-sm-5 col-9 text-right m-b-20">
                                    <a href="{{route('appointment.new')}}" class="btn btn btn-primary btn-rounded float-right"> New patient</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone <span class="text-danger">*</span></label>
                                <input class="form-control" required id="phone"name="phone" type="text">

                            <button type="button" class="btn btn-success" onclick="checkoldpatient()">check</button>
                            </div>
                        </div>

{{--                        <div class="col-md-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Patient Name</label>--}}
{{--                                <select class="select">--}}
{{--                                    @foreach($patients as $patient)--}}
{{--                                        <option value="{{$patient->patientId}}">{{$patient->firstName." ".$patient->lastName}}</option>--}}
{{--                                    @endforeach--}}

{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input class="form-control" id="firstName" name="firstName" required type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" id="lastName" name="lastName" required type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Age<span class="text-danger">*</span></label>
                                <input class="form-control" id="age" name="age" required type="text">

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group gender-select">
                                <label class="gen-label">Gender: <span class="text-danger">*</span></label>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" required id="genderMale" name="gender" value="{{GENDER['Male']}}" class="form-check-input">Male
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" required id="genderFeMale" name="gender" value="{{GENDER['Female']}}" class="form-check-input">Female
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea rows="5" id="address" name="address" class="form-control "></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" required id="email"name="email" type="text">
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Doctor</label>
{{--                                <select class="select" name="doctorId" class="form-control">--}}
{{--                                    <option>Select</option>--}}
{{--                                    @foreach($doctors as $doctor)--}}
{{--                                        <option value="{{$doctor->doctorId}}">{{$doctor->firstName." ".$doctor->lastName}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Time</label>
                                <div class="time-icon">
                                    <input type="text" class="form-control " id="datetimepicker3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea cols="30" rows="4" class="form-control"></textarea>
                    </div>

                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn">Create Appointment</button>

                    </div>

                </form>
            </div>
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('js')
    <script>
        $(function () {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
            $('#datetimepicker').datetimepicker({
                format: 'LT'
            });
        });
    </script>
    <script type="text/javascript">

        function checkoldpatient() {

          var phone =   document.getElementById("phone").value ;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "post",
                url: "{{route('checkoldpatient')}}",
                data: {phone: phone},
                success: function (data) {

                    document.getElementById('firstName').value = data.firstName;
                    document.getElementById('lastName').value = data.lastName;
                    document.getElementById('age').value = data.age;
                    document.getElementById('address').value = data.address;
                    document.getElementById('email').value = data.email;

                    if (data.gender == 1){
                        document.getElementById('genderMale').value = 1;
                        $("#genderMale").prop("checked", true);
                    }else {
                        document.getElementById('genderFeMale').value = 2;
                        $("#genderFeMale").prop("checked", true);

                    }


                }

            });
        }
    </script>

@endsection


