@extends('main')
@section('content')

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h3 class="page-title">Add Appointment</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form action="{{ route('appointment.new') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><h3>Patient Type</h3></label>
                                <select class="select">
                                    <option>Select Patient Type</option>
                                    <option><a href="{{ route('appointment.new') }}"></a>New Patient</option>
                                    <option><a href="{{ route('appointments') }}"></a>Old Patient</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input type="submit" value="submit">
                    </div>
                </form>
            </div>
        </div>

@endsection



