<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    //
    protected $table = 'leagues';

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function leagueType()
    {
        return $this->belongsTo('App\LeagueType','type');
    }

    public function seasonWinner($season_id)
    {
        $winner = Winner::where('season_id',$season_id)->where('league_id', $this->attributes['id'])->first();

        return $winner;
    }

    public function teamById($team_id)
    {
        $team = Team::findOrFail($team_id);

        return $team;
    }

    public function europeTeams()
    {
        $teams = Team::orderBy('name', 'asc')->get();

        return $teams;
    }
}
