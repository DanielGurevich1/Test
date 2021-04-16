@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Task List</h3>
                    <form action="{{route('task.index')}}" method="get" class="form-check">
                        <div class="form-group make-inline">
                            {{-- <h5 style="color:orange;">Select status</h5> --}}
                            <select name="status_id" style="margin:30px;float:left">
                                <option value="0" disabled @if($filterBy==0) selected @endif>Select status</option>

                                @foreach ($statuses as $status)
                                <option value="{{$status->id}}" @if($filterBy==$status->id) selected @endif> {{$status->name}} </option>
                                <small class="form-text text-muted">your choice, please</small>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-check-inline ">
                            <div style="padding:20px;float:left">

                                <label class="form-check">Sort by:</label>

                                <label class="form-check-label" for="sortASC">Name</label>
                                <input type="radio" class="form-check-input" name="sort" value="asc" id="sortASC" @if($sortBy=='asc' ) checked @endif>

                                Completed <input type="radio" class="form-check-input" name="sort" value="desc" id="sortDESC" @if($sortBy=='desc' ) checked @endif>
                            </div>

                            <div class="list-line__buttons" style="padding:20px;float:left">
                                <button type="submit" class="btn btn-info btn-sm">Sort</button>
                                <a href="{{route('task.index')}}" class="btn btn-info btn-sm">Clear sort</a>

                            </div>
                    </form>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($tasks as $task)
                        <li class="list-group-item list-line">
                            <div style="padding:10px;float:left">
                                <h3>{{$task->name}}</h3>
                                <h5>{!!$task->about!!}</h5> {{$task->completed}}<br>
                                Status: {{$task->taskStatus->name}}
                            </div>
                            <div style="padding:15px;float:right">

                                <form method="POST" action="{{route('task.destroy', [$task])}}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">X</button>
                            </div>
                            </form>
                            <div style="padding:15px;float:right">
                                <a href="{{route('task.edit',[$task])}}" class="btn btn-warning btn-sm">EDIT</a>
                            </div>
                            <div style="padding:15px;float:left">
                                <a href="{{route('task.pdf',[$task])}}" class="btn btn-primary btn-sm">PDF</a>
                            </div>

                        </li>
                        @endforeach
                    </ul>
                    <div class="paginator-container">
                        {{$tasks->links()}}

                    </div>



                </div>

            </div>
        </div>
    </div>
</div>
@endsection
