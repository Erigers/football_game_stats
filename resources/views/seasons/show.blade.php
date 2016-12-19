@extends('layout')
@section('header')
    <div class="page-header">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Season / {{$season->year}}
            <a class="btn btn-success pull-right" href="{{ route('seasons.edit', $season->id) }}"><i class="glyphicon glyphicon-plus"></i> Add Winners</a>

        </h1>
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
                                <p class="text-center"><strong>Winner:</strong> <br>
                                    @if(isset($league->seasonWinner($season->id)->winning_team))
                                        <img src="{{asset('img/teams/'.$league->teamById($league->seasonWinner($season->id)->winning_team)->icon)}}" alt="">
                                        {{$league->teamById($league->seasonWinner($season->id)->winning_team)->name}}
                                    @endif
                                </p>
                            @elseif($league->type == 2 || $league->type == 5)
                                <p class="text-center"><strong>Final Match:</strong> <br>
                                    @if(isset($league->seasonWinner($season->id)->winning_team))
                                        <img src="{{asset('img/teams/'.$league->teamById($league->seasonWinner($season->id)->home_team)->icon)}}" alt="">
                                        {{$league->teamById($league->seasonWinner($season->id)->home_team)->name}}&nbsp;&nbsp;
                                        <span style="font-size:22px;">{{$league->seasonWinner($season->id)->home_score}}</span>
                                          <strong style="font-size:22px;">-</strong>
                                        <span style="font-size:22px;">{{$league->seasonWinner($season->id)->away_score}}</span>&nbsp;&nbsp;
                                        <img src="{{asset('img/teams/'.$league->teamById($league->seasonWinner($season->id)->away_team)->icon)}}" alt="">
                                        {{$league->teamById($league->seasonWinner($season->id)->away_team)->name}}</p>

                                        @if($league->seasonWinner($season->id)->home_extra_score > -1 && $league->seasonWinner($season->id)->away_extra_score > -1)
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            ET: <span style="font-size:22px;">{{$league->seasonWinner($season->id)->home_extra_score}}</span>
                                            <strong style="font-size:22px;">-</strong>
                                            <span style="font-size:22px;">{{$league->seasonWinner($season->id)->away_extra_score}}</span>
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            @if(isset($league->seasonWinner($season->id)->home_penalty_score) && isset($league->seasonWinner($season->id)->away_penalty_score))
                                                P.K.: <span style="font-size:22px;">{{$league->seasonWinner($season->id)->home_penalty_score}}</span>
                                                <strong style="font-size:22px;">-</strong>
                                                <span style="font-size:22px;">{{$league->seasonWinner($season->id)->away_penalty_score}}</span>
                                            @endif
                                        @endif
                                    @endif

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