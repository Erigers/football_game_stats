<?php namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeamController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$teams = Team::orderBy('country_id', 'desc')->paginate(20);

		return view('teams.index', compact('teams'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$countries = Country::all();
		return view('teams.create',compact('countries'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$team = new Team();

		$team->name = $request->input("name");
		if(File::exists($request->file('icon'))){
			$file = $request->file('icon');
			$extension = $file->getClientOriginalExtension();
			$filename = md5(str_random(6) . '_' . $file->getFilename()) . ".$extension";
			$file->move(public_path() . '/img/teams', $filename);

			$team->icon = $filename;
		}
		$team->country_id = $request->input('country_id');

		$team->save();

		return redirect()->route('teams.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$team = Team::findOrFail($id);

		return view('teams.show', compact('team'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$team = Team::findOrFail($id);

		$countries = Country::all();
		return view('teams.edit', compact('team','countries'));
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
		$team = Team::findOrFail($id);

		$team->name = $request->input("name");
		if(File::exists($request->file('icon'))){
			$file = $request->file('icon');
			$extension = $file->getClientOriginalExtension();
			$filename = md5(str_random(6) . '_' . $file->getFilename()) . ".$extension";
			$file->move(public_path() . '/img/teams', $filename);

			$team->icon = $filename;
		}

		$team->country_id = $request->input('country_id');

		$team->save();

		return redirect()->route('teams.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$team = Team::findOrFail($id);
		$team->delete();

		return redirect()->route('teams.index')->with('message', 'Item deleted successfully.');
	}

}
