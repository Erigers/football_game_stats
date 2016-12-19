<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //
    protected $table = 'games';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function seasons()
    {
        return $this->hasMany('App\Season');
    }

    public function gameType()
    {
        return $this->belongsTo('App\GameType');
    }
}
