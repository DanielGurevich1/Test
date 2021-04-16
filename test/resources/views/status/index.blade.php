@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 style="padding:15px;float:left;">STATUS LIST</h2>

                    <form action="{{route('status.index')}}" method="get">
                        {{-- <div class="form-group" style="padding:10px;float:right">
                            <h5 style="color:orange;">Sort by </h5>

                        </div> --}}
                        <div class="form-group " style="padding:10px;float:right">
                            <button type="submit" class="btn btn-info">Filter</button>
                        </div>
                        <div class="form-group " style="padding:10px;float:right">

                            <input class="form-check-input" type="radio" name="sort" value="asc" @if($filterBy=='asc' ) checked @endif id="sortBy">
                            <label class="form-check-label" for="sortBy">name</label>

                        </div>
                        <div class="form-group " style="padding:10px;float:right">
                            <input class="form-check-input" type="radio" name="sort" value="desc" @if($filterBy=='asc' ) checked @endif id="sortByDesc">
                            <label class="form-check-label" for="sortByDesc">name</label>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($statuses as $status)
                        <li class="list-group-item list-line">
                            <div class="form-group" style="padding:10px;float:left">
                                <label>
                                    <h3>{{$status->name}}</h3>
                                </label>

                            </div>

                            <div style="padding:10px;float:right">
                                <form method="POST" action="{{route('status.destroy', [$status])}}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">DELETE</button>
                                </form>
                                <div style="padding:10px;float:right">
                                    <a href="{{route('status.edit',[$status])}}" class="btn btn-warning btn-sm">EDIT</a>
                                </div>
                            </div>

                        </li>
                        @endforeach


                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
