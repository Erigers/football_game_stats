<?php namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\League;
use App\LeagueType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LeagueController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$leagues = League::orderBy('country_id', 'desc')->paginate(20);
		return view('leagues.index', compact('leagues'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$countries = Country::all();
		$types = LeagueType::all();

		return view('leagues.create', compact('countries','types'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$league = new League();

		$league->name = $request->input("name");

		if(File::exists($request->file('icon'))){
			$file = $request->file('icon');
			$extension = $file->getClientOriginalExtension();
			$filename = md5(str_random(6) . '_' . $file->getFilename()) . ".$extension";
			$file->move(public_path() . '/img/leagues', $filename);

			$league->icon = $filename;
		}
        $league->type = $request->input("type");
        $league->country_id = $request->input("country_id");

		$league->save();

		return redirect()->route('leagues.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$league = League::findOrFail($id);

		return view('leagues.show', compact('league'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$league = League::findOrFail($id);
		$types = LeagueType::all();
		$countries = Country::all();

		return view('leagues.edit', compact('league','countries','types'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$league = League::findOrFail($id);

		$league->name = $request->input("name");
		if(File::exists($request->file('icon'))){
			$file = $request->file('icon');
			$extension = $file->getClientOriginalExtension();
			$filename = md5(str_random(6) . '_' . $file->getFilename()) . ".$extension";
			$file->move(public_path() . '/img/leagues', $filename);

			$league->icon = $filename;
		}
        $league->country_id = $request->input("country_id");
        $league->type = $request->input("type");

		$league->save();

		return redirect()->route('leagues.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$league = League::findOrFail($id);
		$league->delete();

		return redirect()->route('leagues.index')->with('message', 'Item deleted successfully.');
	}

}
