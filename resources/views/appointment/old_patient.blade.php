@extends('main')
@section('content')

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h3 class="page-title">Old Appointment Record</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('appointment.insert') }}" method="post">
                {{ csrf_field() }}

{{--                <div class="form-group">--}}
{{--                    <label>Patient Name<span class="text-danger">*</span></label>--}}
{{--                    <select class="select" name="patientId" id="patientId" class="form-control" required>--}}
{{--                        <option value="">Select</option>--}}
{{--                        @foreach($patients as $patient)--}}
{{--                            <option value="{{$patient->patientId}}"></option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                                                <input class="form-control" id="patientName" name="patientName" required type="text">--}}

{{--                </div>--}}


{{--                <div class="form-group">--}}
{{--                        @foreach($patients as $patient)--}}
{{--                            <input type="hidden" name="{{$patient->patientId}}">--}}
{{--                        @endforeach--}}

{{--                </div>--}}

{{--                <div class="form-group" id="patientHide">--}}
{{--                    <label>Patient Name<span class="text-danger">*</span></label>--}}
{{--                    <select class="select" name="patientId" id="patientId" class="form-control" required>--}}
{{--                        <option value="">Select</option>--}}
{{--                        @foreach($patients as $patient)--}}
{{--                            <option value="{{$patient->patientId}}">{{$patient->firstName." ".$patient->lastName}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}

                <div class="row">


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Search record by phone number<span class="text-danger">*</span></label>

                            <input class="form-control" required id="phone" name="phone" type="text" autocomplete="off">


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
                            <input class="form-control" id="firstName" name="firstName" required type="text" autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" id="lastName" name="lastName" required type="text" readonly>
                        </div>
                    </div>
                    <div>
                        <input class="form-control" required id="patientId" name="patientId" type="hidden">

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Age<span class="text-danger">*</span></label>
                            <input class="form-control" id="age" name="age" required type="text" readonly>

                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group gender-select">
                            <label class="gen-label">Gender: <span class="text-danger">*</span></label>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" required id="genderMale" name="gender"
                                           value="{{GENDER['Male']}}" class="form-check-input" readonly="readonly">Male
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" required id="genderFeMale" name="gender"
                                           value="{{GENDER['Female']}}" class="form-check-input" readonly="readonly">Female
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea rows="5" id="address" name="address" class="form-control" style="resize:none"></textarea>
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
                            <select class="select" name="doctorId" class="form-control">
                                <option>Select</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{$doctor->doctorId}}">{{$doctor->firstName." ".$doctor->lastName}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date</label>

                            <input type="text" class="form-control" name="day" id="mydate">

{{--                            <select class="select" name="day" id="day" class="form-control">--}}
{{--                                <option value="">Select day</option>--}}
{{--                                @foreach($days as $day)--}}
{{--                                    <option value="{{$day->fkdoctorId}}">{{$day->day}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
                        </div>
                        <span id="freetimetext"></span>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Time</label>
                            <input type="text" class="form-control" name="appointment_time" id="appointment_time">
                        </div>
                    </div>
                </div>



                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn">Create Appointment</button>
                </div>

            </form>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection

@section('js')
    <script>
        function DisableMonday(date) {

            var day = date.getDay();
            // If day == 1 then it is MOnday
            if (day == 5) {

                return [false] ;

            } else {

                return [true] ;
            }

        }

        $(function () {
            $("#mydate").datepicker({
                dateFormat: "dd-mm-yy",
                changeYear:true,
                minDate: 0,
                maxDate: '+3M',
                // beforeShowDay: DisableMonday
            });
            // $('#datetimepicker2').datetimepicker({
            //     // format: 'LT'
            //     // dateFormat: 'yy-mm-dd'
            // });
            $('#appointment_time').datetimepicker({
                format: 'LT'
            });
        });
    </script>
    <script type="text/javascript">

        function checkoldpatient() {

            var phone = document.getElementById("phone").value;
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

                    if(data.phone != phone) {
                        $.alert({

                            title: "Sorry!!",
                            content: "Phone Number Not Matched.."
                        });

                        document.getElementById('phone').value = "";

                        document.getElementById('firstName').value = "";
                        document.getElementById('lastName').value = "";
                        document.getElementById('patientId').value = "";
                        document.getElementById('age').value = "";
                        document.getElementById('address').value = "";
                        document.getElementById('email').value = "";
                        document.getElementById('genderMale').checked = false;
                        document.getElementById('genderFeMale').checked = false;
                        // alert("Phone Number Not Matched.");
                    }
                    else {
                        document.getElementById('firstName').value = data.firstName;
                        document.getElementById('lastName').value = data.lastName;
                        document.getElementById('patientId').value = data.patientId;
                        document.getElementById('age').value = data.age;
                        document.getElementById('address').value = data.address;
                        document.getElementById('email').value = data.email;

                        if (data.gender == 1) {
                            document.getElementById('genderMale').value = 1;
                            $("#genderMale").prop("checked", true);
                        } else {
                            document.getElementById('genderFeMale').value = 2;
                            $("#genderFeMale").prop("checked", true);
                        }
                    }


                }

            });
        }
    </script>

    <script>
        function hide(){
            var patient = document.getElementById('patientHide');
            patient.style.visibility = 'hidden';
        }
    </script>

@endsection


