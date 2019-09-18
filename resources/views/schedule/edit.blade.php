@extends('main')

@section('content')

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h4 class="page-title">Edit Schedule</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form action="{{ route('schedule.update') }}" method="post" >
                {{ csrf_field() }}
                <input type="hidden" value="{{$schedule->working_hourId}}" id="working_hourId" name="working_hourId">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ $schedule->working_hourId }}</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Start Time</label>
                            <input name="start_time" value="{{ $schedule->start_time }}" type="text" class="form-control" id="datetimepicker3">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>End Time</label>
                            <input name="end_time" value="{{ $schedule->end_time }}" type="text" class="form-control" id="datetimepicker4">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Available Days</label>

{{--                            Month:--}}
                            <select name="day">
                                <option value="">select</option>
                                @foreach($day as $d)

                                    <option @if($d==$schedule->day) selected @endif value="{{$d}}">{{$d}}</option>

                                @endforeach


{{--                                <input name="day" value="{{ $schedule->day }}" type="text" class="form-control" id="datetimepicker5">--}}

                            </select>

                        </div>
                    </div>

                <div class="m-t-20 text-center">
                    <button type="submit" class="btn btn-primary submit-btn">Update Schedule</button>
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


@endsection
