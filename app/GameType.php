<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameType extends Model
{
    //
    protected $table = 'game_types';

    public function game()
    {
        return $this->hasMany('App\Game');
    }
}
