@extends('main')
@section('content')

    <div class="row">
        <div class="col-lg-7 offset-lg-2">
            <h3 class="page-title">Add Appointment </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div action="{{ route('appointment') }}" method="post" onsubmit="return validateForm()">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Patient Type : </label>
                            <div class="col-sm-5 col-8 text-right m-b-20">
                                <a href="{{route('appointment.old')}}" class="btn btn btn-primary btn-rounded float-right"> Old patient</a>
                            </div> &nbsp; &nbsp;

                            <div class="col-sm-5 col-9 text-right m-b-20">
                                <a href="{{route('appointment.new')}}" class="btn btn btn-primary btn-rounded float-right"> New patient</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>










    </form>


    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('js')
    <script  type="text/javascript">
        $(function () {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
            $('#datetimepicker').datetimepicker({
                format: 'LT'
            });
        });
        function validateForm() {
            var x = document.getElementById('firstName').value;
            if (x == "") {
                alert("Name must be filled out");
                return false;
            }
        }
        function checkoldpatient() {
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
                    if (data.trim()=='') {
                        alert("Record not found");
                        // return false;
                    } else {
                        document.getElementById('firstName').value = data.firstName;
                        document.getElementById('lastName').value = data.lastName;
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
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="row">--}}
    {{--                        <div class="col-md-6">--}}
    {{--                            <div class="form-group">--}}
    {{--                                <label>Date</label>--}}
    {{--                                <div class="cal-icon">--}}
    {{--                                    <input type="text" class="form-control datetimepicker">--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-md-6">--}}
    {{--                            <div class="form-group">--}}
    {{--                                <label>Time</label>--}}
    {{--                                <div class="time-icon">--}}
    {{--                                    <input type="text" class="form-control " id="datetimepicker3">--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="row">--}}

    {{--                    </div>--}}
    {{--                    <div class="form-group">--}}
    {{--                        <label>Message</label>--}}
    {{--                        <textarea cols="30" rows="4" class="form-control"></textarea>--}}
    {{--                    </div>--}}

    {{--                    <div class="m-t-20 text-center">--}}
    {{--                        <button class="btn btn-primary submit-btn">Create Appointment</button>--}}

    {{--                    </div>--}}

    {{--                </form>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <meta name="csrf-token" content="{{ csrf_token() }}" />--}}
    {{--@endsection--}}
    {{--@section('js')--}}
    {{--    <script>--}}
    {{--        $(function () {--}}
    {{--            $('#datetimepicker3').datetimepicker({--}}
    {{--                format: 'LT'--}}
    {{--            });--}}
    {{--            $('#datetimepicker').datetimepicker({--}}
    {{--                format: 'LT'--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}
    {{--    <script type="text/javascript">--}}

    {{--        function checkoldpatient() {--}}

    {{--          var phone =   document.getElementById("phone").value ;--}}
    {{--            $.ajaxSetup({--}}
    {{--                headers: {--}}
    {{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--                }--}}
    {{--            });--}}
    {{--            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');--}}

    {{--            $.ajax({--}}
    {{--                type: "post",--}}
    {{--                url: "{{route('checkoldpatient')}}",--}}
    {{--                data: {phone: phone},--}}
    {{--                success: function (data) {--}}

    {{--                    document.getElementById('firstName').value = data.firstName;--}}
    {{--                    document.getElementById('lastName').value = data.lastName;--}}
    {{--                    document.getElementById('age').value = data.age;--}}
    {{--                    document.getElementById('address').value = data.address;--}}
    {{--                    document.getElementById('email').value = data.email;--}}

    {{--                    if (data.gender == 1){--}}
    {{--                        document.getElementById('genderMale').value = 1;--}}
    {{--                        $("#genderMale").prop("checked", true);--}}
    {{--                    }else {--}}
    {{--                        document.getElementById('genderFeMale').value = 2;--}}
    {{--                        $("#genderFeMale").prop("checked", true);--}}

    {{--                    }--}}


    {{--                }--}}

    {{--            });--}}
    {{--        }--}}
    {{--    </script>--}}

@endsection
