<?php

namespace App\Http\Controllers;

use App\Country;
use App\Game;
use App\League;
use App\Season;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class SeasonController extends Controller
{

    public function store($game_id)
    {

        $seasons_counter = Season::where('game_id', $game_id)->count();
        $startingYear = 2016 + $seasons_counter;
        $endingYear = 2017 + $seasons_counter;

        $season = new Season();

        $season->year = $startingYear ." - ".$endingYear;
        $season->game_id = $game_id;
        $season->save();

        return redirect()->to('/games/'.$game_id);
    }

    public function show($id)
    {
        $season = Season::findOrFail($id);
        $countries = Country::all();

        return view('seasons.show', compact('season', 'countries'));
    }

    public function edit($id)
    {
        $season = Season::findOrFail($id);
        $countries = Country::all();

        return view('seasons.edit', compact('season', 'countries'));
    }

    public function destroy($id)
    {
        $season = Season::findOrFail($id);
        $season->delete();

        return redirect()->to('/games/'.$season->game_id)->with('message', 'Item deleted successfully.');
    }
}
