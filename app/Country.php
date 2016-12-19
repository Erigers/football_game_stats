<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table = 'countries';

    public function teams()
    {
        return $this->hasMany('App\Team');
    }

    public function teamCount()
    {
        $count = Team::where('country_id', $this->attributes['id'])->count();

        return $count;
    }

    public function leagues()
    {
        return $this->hasMany('App\League');
    }
}
