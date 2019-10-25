@extends('main')
@section('content')



    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h3 class="page-title">New Patient Form</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div id="message"></div>
            <form enctype="multipart/form-data" id="appointmentAddForm" action="{{ route('appointment.insert') }}"
                  onsubmit="return checkappointtime()" method="post">
                {{ csrf_field() }}
                <div class="row">


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Phone <span class="text-danger">*</span></label>
                            <input class="form-control" required id="phone" name="phone" type="text">

                            {{--                            <button type="button" class="btn btn-success" onclick="checkoldpatient()">check</button>--}}
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
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Patient Name<span class="text-danger">*</span></label>
                            <select class="select" name="patientId" id="patientId" class="form-control" required>
                                <option value="">Select</option>
                                @foreach($patients as $patient)
                                    <option
                                        value="{{$patient->patientId}}">{{$patient->firstName." ".$patient->lastName}}</option>
                                @endforeach
                            </select>
                            {{--                            <input class="form-control" id="patientName" name="patientName" required type="text">--}}

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
                                    <input type="radio" required id="genderMale" name="gender"
                                           value="{{GENDER['Male']}}" class="form-check-input">Male
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" required id="genderFemale" name="gender"
                                           value="{{GENDER['Female']}}" class="form-check-input">Female
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
                            <input class="form-control" required id="email" name="email" type="text">
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Doctor</label>
                            <select class="select" name="doctorId" id="doctorId" class="form-control" required>
                                <option value="">Select</option>
                                @foreach($doctors as $doctor)
                                    <option
                                        value="{{$doctor->doctorId}}">{{$doctor->firstName." ".$doctor->lastName}}</option>
                                @endforeach
                            </select>

                        </div>
                        <span id="freetimetext"></span>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group" style="margin-left: -16px">
                                <label>Date</label>
                                <div>
                                    <input class="form-control" type="text" name="day" id="datepicker" required>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                    <div class="col-sm-3">
                    <div class="form-group" style="margin-left: -16px">
                        <label>Appointment Time</label>
                        <div class="time-icon">
                            <input name="appointment_time" type="text" class="form-control" id="datetimepicker1">
                        </div>
                    </div>
                    </div>
                    </div>
                </div>



                <div class="row">

                </div>


                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary submit-btn">Create Appointment</button>

                </div>

            </form>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection
@section('js')
    <script>
        function validateform() {
            var validator = $("#appointmentAddForm").validate({
                errorClass: 'errors',
                rules: {
                    age: "required",
                },
                highlight: function (element) {
                    $(element).parent().addClass('error')
                },
                unhighlight: function (element) {
                    $(element).parent().removeClass('error')
                }
            });
            if (validator.form()) {
                return true;
            } else {
                return false;
            }
            // checkappointment();
        }
    </script>


    <script>

        var today = new Date();

        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            minDate: today // set the minDate to the today's date
            // you can add other options here
        });
    </script>

    <script>
        $(function () {
            $('#datetimepicker1').datetimepicker({
                format: 'LT'
            });

        });
    </script>






@endsection
