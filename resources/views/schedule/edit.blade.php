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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Start Time</label>
                            <input name="start_time" type="text" class="form-control" id="datetimepicker3">
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
