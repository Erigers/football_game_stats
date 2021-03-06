<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CountryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$countries = Country::orderBy('id', 'desc')->paginate(10);

		return view('countries.index', compact('countries'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('countries.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$country = new Country();

		$country->name = $request->input("name");
		if(File::exists($request->file('flag'))){
			$file = $request->file('flag');
			$extension = $file->getClientOriginalExtension();
			$filename = md5(str_random(6) . '_' . $file->getFilename()) . ".$extension";
			$file->move(public_path() . '/img/countries', $filename);

			$country->flag = $filename;
		}

		$country->save();

		return redirect()->route('countries.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$country = Country::findOrFail($id);

		return view('countries.show', compact('country'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$country = Country::findOrFail($id);

		return view('countries.edit', compact('country'));
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
		$country = Country::findOrFail($id);

		$country->name = $request->input("name");
		if(File::exists($request->file('flag'))){
			$file = $request->file('flag');
			$extension = $file->getClientOriginalExtension();
			$filename = md5(str_random(6) . '_' . $file->getFilename()) . ".$extension";
			$file->move(public_path() . '/img/countries', $filename);

			$country->flag = $filename;
		}

		$country->save();

		return redirect()->route('countries.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$country = Country::findOrFail($id);
		$country->delete();

		return redirect()->route('countries.index')->with('message', 'Item deleted successfully.');
	}

}
