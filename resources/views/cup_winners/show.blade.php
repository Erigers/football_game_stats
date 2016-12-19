@extends('layout')
@section('header')
<div class="page-header">
        <h1>CupWinners / Show #{{$cup_winner->id}}</h1>
        <form action="{{ route('cup_winners.destroy', $cup_winner->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('cup_winners.edit', $cup_winner->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
                    <p class="form-control-static"></p>
                </div>
                <div class="form-group">
                     <label for="user_id">USER_ID</label>
                     <p class="form-control-static">{{$cup_winner->user_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="team_id">TEAM_ID</label>
                     <p class="form-control-static">{{$cup_winner->team_id}}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('cup_winners.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

        </div>
    </div>

@endsection