@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Teams
            <a class="btn btn-success pull-right" href="{{ route('teams.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($teams->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NAME</th>
                            <th>Country</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                        if(!isset($_GET['page']) || $_GET['page'] == 1){
                            $counter = 1;
                        }else{
                            $counter = 20*($_GET['page']-1) + 1;
                        }
                    ?>
                        @foreach($teams as $team)
                            <tr>
                                <td>{{$counter}}</td>
                                <td><img src="{{asset('/img/teams/'.$team->icon)}}" width="30px" height="auto"> {{$team->name}}</td>
                                <td><img src="{{asset('img/countries/'.$team->country->flag)}}" width="20px" height="auto"> {{$team->country->name}}</td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('teams.show', $team->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <a class="btn btn-xs btn-warning" href="{{ route('teams.edit', $team->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    <form action="{{ route('teams.destroy', $team->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php $counter++; ?>
                        @endforeach
                    </tbody>
                </table>
                {!! $teams->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection