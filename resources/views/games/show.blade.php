@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Seasons of {{$game->name}}
            <a class="btn btn-success pull-right" href="{{ route('seasons.store', $game->id) }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($game->seasons()->count())
                <table class="table table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>YEAR</th>
                        <th>COMPLETED ON</th>
                        <th class="text-right">OPTIONS</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($game->seasons as $season)
                        <tr>
                            <td>{{$season->id}}</td>
                            <td>{{$season->year}}</td>
                            <td>{{$season->created_at}}</td>
                            <td></td>
                            <td class="text-right">
                                <a class="btn btn-xs btn-warning" href="{{ route('seasons.show', $season->id) }}"><i class="glyphicon glyphicon-edit"></i> View</a>
                                <form action="{{ route('seasons.destroy', $season->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--{!! $types->render() !!}--}}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection