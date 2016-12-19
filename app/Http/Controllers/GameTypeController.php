<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GameType;
use Illuminate\Http\Request;

class GameTypeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$game_types = GameType::orderBy('id', 'desc')->paginate(10);

		return view('game_types.index', compact('game_types'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('game_types.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$game_type = new GameType();

		$game_type->name = $request->input("name");

		$game_type->save();

		return redirect()->route('game_types.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$game_type = GameType::findOrFail($id);

		return view('game_types.show', compact('game_type'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$game_type = GameType::findOrFail($id);

		return view('game_types.edit', compact('game_type'));
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
		$game_type = GameType::findOrFail($id);

		$game_type->name = $request->input("name");

		$game_type->save();

		return redirect()->route('game_types.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$game_type = GameType::findOrFail($id);
		$game_type->delete();

		return redirect()->route('game_types.index')->with('message', 'Item deleted successfully.');
	}

}
