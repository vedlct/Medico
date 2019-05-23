@extends('main')

@section('content')


        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Add Doctor</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form enctype="multipart/form-data" id="doctorAddForm" action="{{route('doctor.insert')}}" onsubmit="return validateform()" method="post" >
                    {{csrf_field()}}
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
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" id="email" name="email" required type="email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Degree </label>
                                <input class="form-control" id="degree" name="degree"  type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Password <span class="text-danger">*</span></label>
                                <input class="form-control" id="password" name="password" required type="password">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Confirm Password <span class="text-danger">*</span></label>
                                <input class="form-control" id="conPassword" name="conPassword" type="password">
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
                        <div class="form-group">
                            <label class="display-block">Status <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" required name="status" id="doctor_active" value="{{USER_STATUS['Active']}}" checked>
                                <label class="form-check-label" for="doctor_active">
                                    Active
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"required  name="status" id="doctor_inactive" value="{{USER_STATUS['Inactive']}}">
                                <label class="form-check-label" for="doctor_inactive">
                                    Inactive
                                </label>
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
                                <input class="form-control" required id="phone"name="phone" type="text">
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
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<label>Short Biography</label>--}}
                        {{--<textarea class="form-control" rows="3" cols="30"></textarea>--}}
                    {{--</div>--}}

                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn">Create Doctor</button>
                    </div>
                </form>
            </div>
        </div>


@endsection
@section('js')
    <script>
        function validateform() {
            var validator = $("#doctorAddForm").validate({
                errorClass: 'errors',
                rules: {
                    password: "required",
                    conPassword: {
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: " Enter Password",
                    confirmpassword: "Enter Confirm Password Same as Password"
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
@endsection