<form method="post" action="{{ route('service.update') }}">
    @csrf
    <input type="hidden" value="{{ $service->servicesId }}" name="id">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Service Name</label>
                <input class="form-control" type="text" name="name" value="{{ $service->servicesName }}">
            </div>
        </div>
    </div>
    <div class="m-t-20 text-center">
        <button type="submit" class="btn btn-primary submit-btn">Update Service</button>
    </div>
</form>

