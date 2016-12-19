@extends('layout')
@section('header')
    <div class="page-header">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Season / {{$season->year}} Edit
            <a class="btn btn-success pull-right" href="{{ route('seasons.show', $season->id) }}"><i class="glyphicon glyphicon-plus"></i> Back</a>        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @foreach($countries as $country)
                @if($country->leagues->count() > 0)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div style="width:200px; margin:auto;">
                                <img src="{{asset('img/countries/'.$country->flag)}}" width="50px" height="auto"> <strong style="font-size:18px;line-height:200%;">{{$country->name}}</strong>
                            </div>
                        </div>
                        <div class="panel-body">
                            @foreach($country->leagues as $league)
                                <div class="col-md-4">
                                    <p class="text-center" style="border-bottom:1px solid #000; font-size:16px; padding-bottom:5px;height:50px;">
                                        <img src="{{asset('img/leagues/'.$league->icon)}}" height="40px"> {{$league->name}}
                                    </p>
                                    <br>
                                    @if($league->type == 1)
                                        <form action="{{'/winner/store/'.$season->id.'/'.$league->id}}" method="POST">
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <p class="text-center"><strong>Winner:</strong> <br>
                                                   @if(isset($league->seasonWinner($season->id)->winning_team))
                                                    <select name="winning_team">
                                                        @foreach($league->country->teams as $team)
                                                            <option value="{{$team->id}}" {{$team->id == $league->seasonWinner($season->id)->winning_team? 'selected' : ''}}>
                                                                {{$team->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                   @else
                                                    <select name="winning_team">
                                                        <option value="-1">-- Select Winner --</option>
                                                        @foreach($league->country->teams as $team)
                                                            <option value="{{$team->id}}">{{$team->name}}</option>
                                                        @endforeach
                                                    </select>
                                                   @endif
                                            <input type="submit" value="Save">
                                        </form>
                                        </p>
                                    @elseif($league->type == 2)
                                        <form action="{{'/winner/store/'.$season->id.'/'.$league->id}}" method="POST">
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <p class="text-center"><strong>Final Match:</strong> <br>
                                                @if(isset($league->seasonWinner($season->id)->home_team))
                                                    <select name="home_team" style="width:100px;">
                                                        @foreach($league->country->teams as $team)
                                                            <option value="{{$team->id}}" {{$team->id == $league->seasonWinner($season->id)->home_team? 'selected' : ''}}>
                                                                {{$team->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select name="home_team" style="width:100px;">
                                                        <option value="-1">-- Select Home Team --</option>
                                                        @foreach($league->country->teams as $team)
                                                            <option value="{{$team->id}}">{{$team->name}}</option>
                                                        @endforeach
                                                    </select>
                                                @endif

                                                <input type="number" name="home_score" style="width:30px;"
                                                        value="{{isset($league->seasonWinner($season->id)->home_score)? $league->seasonWinner($season->id)->home_score: ''}}">
                                                <input type="number" name="away_score" style="width:30px;"
                                                       value="{{isset($league->seasonWinner($season->id)->away_score)? $league->seasonWinner($season->id)->away_score: ''}}">


                                                @if(isset($league->seasonWinner($season->id)->home_team))
                                                    <select name="away_team" style="width:100px;">
                                                        @foreach($league->country->teams as $team)
                                                            <option value="{{$team->id}}" {{$team->id == $league->seasonWinner($season->id)->away_team? 'selected' : ''}}>
                                                                {{$team->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select name="away_team" style="width:100px;">
                                                        <option value="-1">-- Select Away Team --</option>
                                                        @foreach($league->country->teams as $team)
                                                            <option value="{{$team->id}}">{{$team->name}}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                <br>
                                                <br>
                                                Extra Time <input type="number" name="home_extra_score" style="width:30px;"
                                                       value="{{isset($league->seasonWinner($season->id)->home_extra_score)? $league->seasonWinner($season->id)->home_extra_score: ''}}">
                                                <input type="number" name="away_extra_score" style="width:30px;"
                                                       value="{{isset($league->seasonWinner($season->id)->away_extra_score)? $league->seasonWinner($season->id)->away_extra_score: ''}}">
                                                Extra Time
                                                <br>
                                                <br>
                                                Penalty Score <input type="number" name="home_penalty_score" style="width:30px;"
                                                       value="{{isset($league->seasonWinner($season->id)->home_penalty_score)? $league->seasonWinner($season->id)->home_penalty_score: ''}}">
                                                <input type="number" name="away_penalty_score" style="width:30px;"
                                                       value="{{isset($league->seasonWinner($season->id)->away_penalty_score)? $league->seasonWinner($season->id)->away_penalty_score: ''}}">
                                                Penalty Score
                                                <br>
                                                <br>
                                                <input type="submit" value="Save">
                                        </form>
                                    @elseif($league->type == 5)
                                        <form action="{{'/winner/store/'.$season->id.'/'.$league->id}}" method="POST">
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <p class="text-center"><strong>Final Match:</strong> <br>
                                                @if(isset($league->seasonWinner($season->id)->home_team))
                                                    <select name="home_team" style="width:100px;">
                                                        @foreach($league->europeTeams() as $team)
                                                            <option value="{{$team->id}}" {{$team->id == $league->seasonWinner($season->id)->home_team? 'selected' : ''}}>
                                                                {{$team->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select name="home_team" style="width:100px;">
                                                        <option value="-1">-- Select Home Team --</option>
                                                        @foreach($league->europeTeams() as $team)
                                                            <option value="{{$team->id}}">{{$team->name}}</option>
                                                        @endforeach
                                                    </select>
                                                @endif

                                                <input type="number" name="home_score" style="width:30px;"
                                                       value="{{isset($league->seasonWinner($season->id)->home_score)? $league->seasonWinner($season->id)->home_score: ''}}">
                                                <input type="number" name="away_score" style="width:30px;"
                                                       value="{{isset($league->seasonWinner($season->id)->away_score)? $league->seasonWinner($season->id)->away_score: ''}}">


                                                @if(isset($league->seasonWinner($season->id)->home_team))
                                                    <select name="away_team" style="width:100px;">
                                                        @foreach($league->europeTeams() as $team)
                                                            <option value="{{$team->id}}" {{$team->id == $league->seasonWinner($season->id)->away_team? 'selected' : ''}}>
                                                                {{$team->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select name="away_team" style="width:100px;">
                                                        <option value="-1">-- Select Away Team --</option>
                                                        @foreach($league->europeTeams() as $team)
                                                            <option value="{{$team->id}}">{{$team->name}}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                <br>
                                                <br>
                                                Extra Time <input type="number" name="home_extra_score" style="width:30px;"
                                                                  value="{{isset($league->seasonWinner($season->id)->home_extra_score)? $league->seasonWinner($season->id)->home_extra_score: ''}}">
                                                <input type="number" name="away_extra_score" style="width:30px;"
                                                       value="{{isset($league->seasonWinner($season->id)->away_extra_score)? $league->seasonWinner($season->id)->away_extra_score: ''}}">
                                                Extra Time
                                                <br>
                                                <br>
                                                Penalty Score <input type="number" name="home_penalty_score" style="width:30px;"
                                                                     value="{{isset($league->seasonWinner($season->id)->home_penalty_score)? $league->seasonWinner($season->id)->home_penalty_score: ''}}">
                                                <input type="number" name="away_penalty_score" style="width:30px;"
                                                       value="{{isset($league->seasonWinner($season->id)->away_penalty_score)? $league->seasonWinner($season->id)->away_penalty_score: ''}}">
                                                Penalty Score
                                                <br>
                                                <br>
                                                <input type="submit" value="Save">
                                        </form>
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection