<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    //
    protected $table = 'winners';
    protected $guarded = [];

    public function season()
    {
        return $this->belongsTo('App\Season');
    }

    public function league()
    {
        return $this->belongsto('App\League');
    }
}
