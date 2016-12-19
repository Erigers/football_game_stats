@extends('layout')
@section('header')
<div class="page-header">
        <h1>Countries / Show #{{$country->id}}</h1>
        <form action="{{ route('countries.destroy', $country->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('countries.edit', $country->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                <button type="submit" class="btn btn-danger">Delete <i class="glyphicon glyphicon-trash"></i></button>
            </div>
        </form>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$country->id}}</p>
                </div>
                <div class="form-group">
                     <label for="name">NAME</label>
                     <p class="form-control-static">{{$country->name}}</p>
                </div>
                <div class="form-group">
                    <label for="name">Teams Registered</label>
                    <p class="form-control-static">{{$country->teamCount()}}</p>
                </div>
                    <div class="form-group">
                     <label for="icon">Flag</label>
                     <p class="form-control-static"><img src="{{asset('img/countries/'.$country->flag)}}"></p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('countries.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

        </div>
    </div>

@endsection