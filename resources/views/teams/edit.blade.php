@extends('layout')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Teams / Edit #{{$team->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('name')) has-error @endif">
                       <label for="name-field">Name</label>
                    <input type="text" id="name-field" name="name" class="form-control" value="{{ $team->name }}"/>
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('icon')) has-error @endif">
                       <label for="icon-field"><img src="{{asset('img/teams/'.$team->icon)}}" width="100px" height="auto"></label>
                        <input type="file" name="icon" id="icon-field">
                       @if($errors->has("icon"))
                        <span class="help-block">{{ $errors->first("icon") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('icon')) has-error @endif">
                        <label for="country-field">Country</label>
                        <select name="country_id" id="country-field" class="form-control">
                            @foreach($countries as $country)
                                <option value="{{$country->id}}" {{$country->id == $team->country_id ? 'selected':''}}>{{$country->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has("icon"))
                            <span class="help-block">{{ $errors->first("icon") }}</span>
                        @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('teams.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    $('.date-picker').datepicker({
    });
  </script>
@endsection
