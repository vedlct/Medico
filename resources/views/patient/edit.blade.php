@extends('main')

@section('content')


    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h4 class="page-title">Edit Patient Information</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form enctype="multipart/form-data" id="patientAddForm" action="{{ route('patient.update') }}" onsubmit="return validateform()" method="post" >
                {{csrf_field()}}
                <input type="hidden" name="patientId" id="patientId" value="{{ $patient->patientId }}">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input class="form-control" id="firstName" name="firstName" value="{{ $patient->firstName }}" type="text"  required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" id="lastName" name="lastName" value="{{ $patient->lastName }}"  type="text" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Age<span class="text-danger">*</span></label>
                            <input class="form-control" id="age" name="age" value="{{ $patient->age }}"  type="text">

                        </div>
                    </div>
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">

                    </div>

                    <div class="col-sm-6">
                        <div class="form-group gender-select">
                            <label class="gen-label">Gender: <span class="text-danger">*</span></label>
                            <div class="form-check-inline">
                                <label class="form-check-label">
{{--                                    @if(GENDER['Male'] == 1) {--}}
                                    <input type="radio" required id="genderMale" name="gender" value="{{GENDER['Male']}}" class="form-check-input"
                                            @if($patient->gender == GENDER['Male']){{  'checked' }}@endif>Male
{{--
                                    }
{{--                                    @endif--}}
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" required id="genderFeMale" name="gender" value="{{GENDER['Female']}}" class="form-check-input" {{ $patient->gender == GENDER['Female'] ? 'checked' : '' }}>Female
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea rows="5" id="address" name="address" class="form-control " >{{ $patient->address }}</textarea>
                                </div>
                            </div>
                            {{--<div class="col-sm-6 col-md-6 col-lg-3">--}}
                            {{--<div class="form-group">--}}
                            {{--<label>Country</label>--}}
                            {{--<select class="form-control select">--}}
                            {{--<option>USA</option>--}}
                            {{--<option>United Kingdom</option>--}}
                            {{--</select>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-6 col-md-6 col-lg-3">--}}
                            {{--<div class="form-group">--}}
                            {{--<label>City</label>--}}
                            {{--<input type="text" class="form-control">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-6 col-md-6 col-lg-3">--}}
                            {{--<div class="form-group">--}}
                            {{--<label>State/Province</label>--}}
                            {{--<select class="form-control select">--}}
                            {{--<option>California</option>--}}
                            {{--<option>Alaska</option>--}}
                            {{--<option>Alabama</option>--}}
                            {{--</select>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-6 col-md-6 col-lg-3">--}}
                            {{--<div class="form-group">--}}
                            {{--<label>Postal Code</label>--}}
                            {{--<input type="text" class="form-control">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Phone <span class="text-danger">*</span></label>
                            <input class="form-control" id="phone" type="text" name="phone" value="{{ $patient->phone }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Avatar</label>
                            <div class="profile-upload">
                                <div class="upload-img">
                                    <img alt="" src="{{url('public')}}/assets/img/user.jpg">
                                </div>
                                <div class="upload-input">
                                    <input type="file" id="image" name="image" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" required id="email" name="email" value="{{ $patient->email }}" type="text">
                        </div>
                    </div>
                </div>
                {{--<div class="form-group">--}}
                {{--<label>Short Biography</label>--}}
                {{--<textarea class="form-control" rows="3" cols="30"></textarea>--}}
                {{--</div>--}}

                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn">Update Patient Record</button>
                </div>
            </form>
        </div>
    </div>


@endsection
@section('js')
    <script>




        function validateform() {

            var age = parseInt(document.getElementById('age').value);


            if ( !(age>0 && age<=100) ){
                alert("The age must be a number between 1 and 100");
                return false;
                // break;
            }
            else {
                return true;
            }



            var validator = $("#patientAddForm").validate({
                errorClass: 'errors',
                rules: {
                    age : "required"
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






        }

    </script>

{{--    <script>--}}
{{--        // var age = +document.getElementById('age').value;--}}
{{--        // if (age>100) {--}}
{{--        //     alert("Invalid Age");--}}
{{--        //     return false;--}}
{{--        // }--}}
{{--        // return true;--}}


{{--        --}}


{{--    </script>--}}
@endsection
