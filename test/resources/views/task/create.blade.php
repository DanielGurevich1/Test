@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CREATE TASK</div>

                <div class="card-body">

                    <form method="POST" action="{{route('task.store')}}">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="task_name" value="{{old('task_name')}}">
                            <small class="form-text text-muted">enter task name</small>
                        </div>
                        <div class="form-group">
                            <label>Dead-line</label>
                            <input type="text" class="form-control" name="task_completed" value="{{old('task_completed')}}">
                            <small class="form-text text-muted">enter task deadline</small>
                        </div>
                        About: <textarea name="task_about" id="summernote"></textarea>

                        <select name="status_id">
                            @foreach ($statuses as $status)
                            <option value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                        </select>
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">CREATE</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });

</script>

@endsection
