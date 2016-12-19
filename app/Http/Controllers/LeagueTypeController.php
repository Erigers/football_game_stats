<?php

namespace App\Http\Controllers;

use App\LeagueType;
use Illuminate\Http\Request;

use App\Http\Requests;

class LeagueTypeController extends Controller
{
    //
    public function index()
    {
        $types = LeagueType::orderBy('id')->paginate(20);

        return view('leagueTypes.index', compact('types'));
    }

    public function create()
    {
        return view('leagueTypes.create');
    }

    public function store(Request $request)
    {
        $type = new LeagueType();
        $type->name = $request->input('name');
        $type->description = $request->input('description');
        $type->save();

        return redirect()->to('/leagueTypes');
    }

    public function edit($id, Request $request)
    {
        $type = LeagueType::findOrFail($id);

        return view('leagueTypes.edit', compact('type'));
    }

    public function update($id, Request $request)
    {
        $type= LeagueType::findOrFail($id);

        $type->name = $request->input('name');
        $type->description = $request->input('description');

        $type->save();

        return redirect()->to('/leagueTypes');
    }

    public function destroy($id)
    {
        $type = LeagueType::findOrFail($id);

        if($type){
            $type->delete();
        }

        return redirect()->to('/leagueTypes');
    }
}
