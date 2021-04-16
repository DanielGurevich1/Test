@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CREATE NEW STATUS</div>

                <div class="card-body">
                    <form method="POST" action="{{route('status.store')}}">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="status_name" value="{{old('status_name')}}">
                            <small class="form-text text-muted">enter status name</small>
                        </div>


                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
