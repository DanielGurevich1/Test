@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">EDIT A TASK</div>

                <div class="card-body">
                    <form method="POST" action="{{route('status.update', [$status->id])}}">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="status_name" value="{{old($status->name, $status->name)}}">
                            <small class="form-text text-muted">enter status name</small>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm">EDIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
