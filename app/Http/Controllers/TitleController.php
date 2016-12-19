<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Title;
use Illuminate\Http\Request;

class TitleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$titles = Title::orderBy('id', 'desc')->paginate(10);

		return view('titles.index', compact('titles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('titles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$title = new Title();

		$title->name = $request->input("name");
        $title->importance = $request->input("importance");

		$title->save();

		return redirect()->route('titles.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$title = Title::findOrFail($id);

		return view('titles.show', compact('title'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$title = Title::findOrFail($id);

		return view('titles.edit', compact('title'));
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
		$title = Title::findOrFail($id);

		$title->name = $request->input("name");
        $title->importance = $request->input("importance");

		$title->save();

		return redirect()->route('titles.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$title = Title::findOrFail($id);
		$title->delete();

		return redirect()->route('titles.index')->with('message', 'Item deleted successfully.');
	}

}
