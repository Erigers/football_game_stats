<?php

namespace App\Http\Controllers;

use App\League;
use App\Winner;
use Illuminate\Http\Request;

use App\Http\Requests;

class WinnerController extends Controller
{
    //

    public function store(Request $request, $season_id, $league_id)
    {
        $league = League::findOrFail($league_id);
        $winner = Winner::firstOrNew(['league_id' => $league_id, 'season_id' => $season_id]);
        $winner->league_id = $league_id;
        $winner->season_id = $season_id;

        if($league->type == 1) {
            if($request->input('winning_team') != -1) {
                $winner->winning_team = $request->input('winning_team');
            } else {
                return redirect()->to('/season/edit/'.$season_id);
            }
        } else if($league->type == 2 || $league->type == 5){
            if($request->input('home_team') != -1 && $request->input('away_team') != -1){
                $winner->home_team = $request->input('home_team');
                $winner->away_team = $request->input('away_team');
                $winner->home_score = $request->input('home_score');
                $winner->away_score = $request->input('away_score');

                if($request->input('home_score') == $request->input('away_score')){
                    $winner->home_extra_score = $request->input('home_extra_score');
                    $winner->away_extra_score = $request->input('away_extra_score');

                    if($request->input('home_extra_score') == $request->input('away_extra_score')){
                        $winner->home_penalty_score = $request->input('home_penalty_score');
                        $winner->away_penalty_score = $request->input('away_penalty_score');

                        if($request->input('home_penalty_score') > $request->input('away_penalty_score')){
                            $winner->winning_team = $request->input('home_team');
                        } else {
                            $winner->winning_team = $request->input('away_team');
                        }
                    }else{
                        if($request->input('home_extra_score') > $request->input('away_extra_score')){
                            $winner->winning_team = $request->input('home_team');
                        } else {
                            $winner->winning_team = $request->input('away_team');
                        }
                    }
                } else{
                    if($request->input('home_score') > $request->input('away_score')){
                        $winner->winning_team = $request->input('home_team');
                    }else{
                        $winner->winning_team = $request->input('away_team');
                    }
                }
            } else {
                return redirect()->to('/season/edit/'.$season_id);
            }

        }

        $winner->save();

        return redirect()->to('/season/edit/'.$season_id);
    }
}
