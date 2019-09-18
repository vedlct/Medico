

@extends('main')


@section('content')

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">Add Schedule</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="{{ route('schedule.insert') }}" method="post" >
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Doctor Name</label>

                                <select class="select" name="doctorId">
                                    <option>Select</option>
                                    @foreach($doctors as $doctor)
                                    <option value="{{$doctor->doctorId}}">{{$doctor->firstName." ".$doctor->lastName}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Available Days</label>
                                <select name="days[]" class="select" multiple="multiple">
                                    <option>Select Days</option>
                                    <option value="Sunday">Sunday</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Time</label>
                                <div class="time-icon">
                                    <input name="start_time" type="text" class="form-control" id="datetimepicker3">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>End Time</label>
                                <div class="time-icon">
                                    <input name="end_time" type="text" class="form-control" id="datetimepicker4">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div>

                        <p>Date: <input type="text" name="start_date" id="datepicker" required></p>

                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea cols="30" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="display-block">Schedule Status</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="product_active" value="option1" checked>
                            <label class="form-check-label" for="product_active">
                                Active
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="product_inactive" value="option2">
                            <label class="form-check-label" for="product_inactive">
                                Inactive
                            </label>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button type="submit" class="btn btn-primary submit-btn">Create Schedule</button>
                    </div>
                </form>
            </div>
        </div>




@endsection

@section('js')
    <script>
        $(function () {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
            $('#datetimepicker4').datetimepicker({
                format: 'LT'
            });
        });
    </script>




    <script>
        $ (document).ready (function() {
            var minDate = new Date();
            var arrDisabledDates = {};
            arrDisabledDates[new Date('09/22/2019')] = new Date('09/22/2019');
            arrDisabledDates[new Date('10/22/2019')] = new Date('10/22/2019');
            arrDisabledDates[new Date('09/25/2019')] = new Date('09/25/2019');
            arrDisabledDates[new Date('10/20/2019')] = new Date('10/20/2019');
            arrDisabledDates[new Date('10/9/2019')] = new Date('10/9/2019');
            arrDisabledDates[new Date('10/14/2019')] = new Date('10/14/2019');
            arrDisabledDates[new Date('12/22/2019')] = new Date('12/22/2019');
            arrDisabledDates[new Date('11/22/2019')] = new Date('11/22/2019');
            // var datesDisabled = new Date();
            $("#datepicker").datepicker({


                minDate: minDate,


                onclose: function (selectedDate) {
                    $('#datepicker').datepicker("option", "minDate", selectedDate);

                },

                beforeShowDay: function (dt) {

                    var bDisable = arrDisabledDates[dt];

                    if (bDisable)

                        return [false, '', ''];

                    else

                        return [true, '', ''];

                }

            });


        });
    </script>

@endsection
