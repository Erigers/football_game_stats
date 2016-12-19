<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    //
    protected $table = 'seasons';

    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    public function winners()
    {
        return $this->hasMany('App\Winner');
    }
}
