<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeagueType extends Model
{
    protected $table = 'league_types';

    protected $guarded = [];

    public function league()
    {
        return $this->hasOne('App\League');
    }
}
