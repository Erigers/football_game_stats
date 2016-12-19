@extends('layout')
@section('header')
<div class="page-header">
        <h1>Leagues / Show #{{$league->id}}</h1>
        <form action="{{ route('leagues.destroy', $league->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('leagues.edit', $league->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
                    <p class="form-control-static">{{$league->id}}</p>
                </div>
                <div class="form-group">
                     <label for="name">NAME</label>
                     <p class="form-control-static">{{$league->name}}</p>
                </div>
                    <div class="form-group">
                     <label for="icon">ICON</label>
                     <p class="form-control-static"><img src="{{asset('img/leagues/'.$league->icon)}}" width="100px" height="auto"></p>
                </div>
                    <div class="form-group">
                     <label for="type">TYPE</label>
                     <p class="form-control-static">{{$league->leagueType->name}}</p>
                </div>
                <div class="form-group">
                    <label for="country">COUNTRY</label>
                    <p class="form-control-static"><img src="{{asset('img/countries/'.$league->country->flag)}}"
                                                        width="100px" height="auto"> {{$league->country->name}}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('leagues.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

        </div>
    </div>

@endsection