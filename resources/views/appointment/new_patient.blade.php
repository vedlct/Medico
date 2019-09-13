@extends('main')
@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h3 class="page-title">New Patient Form</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div id="message"></div>
            <form enctype="multipart/form-data" id="appointmentAddForm" action="{{ route('appointment.insert') }}" onsubmit="return checkappointtime()" method="post">
                {{ csrf_field() }}
                <div class="row">


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Phone <span class="text-danger">*</span></label>
                            <input class="form-control" required id="phone"name="phone" type="text">

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
                            <input class="form-control" id="patientName" name="patientName" required type="text">

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
                                    <input type="radio" required id="genderFemale" name="gender" value="{{GENDER['Female']}}" class="form-check-input">Female
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
                            <select class="select" name="doctorId"  id="doctorId" class="form-control">
                                <option value="">Select</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{$doctor->doctorId}}">{{$doctor->fkdoctorId}}</option>
                                @endforeach
                            </select>

                        </div>
                        <span id="freetimetext"></span>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Day</label>
                            <select class="select" name="day"  id="day" class="form-control">
                                <option value="">Select day</option>
                                @foreach($days as $day)
                                    <option value="{{$day->fkdoctorId}}">{{$day->day}}</option>
                                @endforeach
                            </select>

                        </div>
                        <span id="freetimetext"></span>
                    </div>
                </div>
                <div class="container">
                    <br><br><br>
                    <div class='col-sm-6'>
                        <div class="form-group">
                            <label for="">Simple Date &amp; Time</label>
                            <div class='input-group date' id='format'>
                                <input type='text' class="form-control"/>
                                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
              </span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">

                </div>


                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary submit-btn" >Create Appointment</button>

                </div>

            </form>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('js')
    <script>
        function validateform() {
            var validator = $("#appointmentAddForm").validate({
                errorClass: 'errors',
                rules: {
                    age : "required",
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

            }else {

                return false;
            }

           // checkappointment();
        }

    </script>


    <script type="text/javascript">
        $(function () {
            $('#format').datetimepicker({
                format:'Y-M-d'
            });
        });
    </script>

    <script type="text/javascript">

        {{--function checkappointment() {--}}
        {{--    $.ajaxSetup({--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--        }--}}
        {{--    });--}}
        {{--    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');--}}

        {{--    --}}{{--$.ajax({--}}
        {{--    --}}{{--    type: "post",--}}
        {{--    --}}{{--    url: "{{route('checkappointment')}}",--}}
        {{--    --}}{{--    data: {phone: phone},--}}
        {{--    --}}{{--    success: function (data){--}}

        {{--    --}}{{--        alert(data);--}}
        {{--    --}}{{--        if(data.start_time <= data.appontment_time && data.end_time >= data.appontment_time){--}}

        {{--    --}}{{--            $('#message').append('<p class ="alert">' +data.appointment_time+' </p>');--}}
        {{--    --}}{{--        }--}}

        {{--    --}}{{--        else{--}}
        {{--    --}}{{--            return ('appointments');--}}
        {{--    --}}{{--        }--}}




        {{--    --}}{{--    }--}}
        {{--    --}}{{--});--}}







        function checkappointtime() {
          var time =   $('#example6').val();
            var doctorId = $('#doctorId').val();



            if (doctorId!=""){



                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


                $.ajax({
                    type: "post",
                    url: "{{route('checkappointmenttime')}}",
                    data: {time: time, doctorId:doctorId},
                    success: function (data){




                           if (data.fkdoctorId == doctorId) {

                              // alert("Doctor is not Free this time");
                               $('#freetimetext').html("Doctor is not Free this time");
                               return false;

                           }else if ((data.trim()=='')){
                               $('#freetimetext').html("Doctor is Free this time");
                           }




                    }
                });

            }else {

                alert("No doctor selected");
                $('#freetimetext').html("");

            }




        }

    </script>





@endsection


