<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::resource('/countries', 'CountryController');
Route::resource('/teams', 'TeamController');
Route::resource('/leagues', 'LeagueController');
Route::resource('/leagueTypes', 'LeagueTypeController', ['except' => ['show']]);
Route::resource("games","GameController");
/**
 * Season Model routes
 */
Route::get('/season/create/{game_id}', [ 'as' => 'seasons.store', 'uses' => 'SeasonController@store']);
Route::get('/season/{id}', ['as' => 'seasons.show', 'uses' => 'SeasonController@show']);
Route::delete('/season/{id}', ['as' => 'seasons.destroy', 'uses' => 'SeasonController@destroy']);
Route::get('/season/edit/{id}', ['as' => 'seasons.edit', 'uses' => 'SeasonController@edit']);

Route::put('/winner/store/{season_id}/{league_id}', ['as' => 'winners.store', 'uses' => 'WinnerController@store']);

Route::resource("titles","TitleController");
Route::resource("game_types","GameTypeController");