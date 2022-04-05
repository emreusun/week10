<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// example closure (inline function) route
// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/', [
    'as' => 'home.index',
    'uses' => 'HomeController@index'
]);

// Songs
// GET /api/songs maps to SongController function index, and lists songs
$router->get('/api/songs', [
    'as' => 'api.songs.index',
    'uses' => 'SongController@index'
]);

// GET /api/songs/{id} maps to SongController function show, and shows a specific song
$router->get('/api/songs/{id}', [
    'as' => 'api.songs.show',
    'uses' => 'SongController@show'
]);

// POST /api/songs maps to SongController function store, which creates/stores a new song
$router->post('/api/songs', [
    'as' => 'api.songs.store',
    'uses' => 'SongController@store'
]);

// PATCH /api/songs/{id} maps to SongController function update, which updates a specific song
$router->patch('/api/songs/{id}', [
    'as' => 'api.songs.update',
    'uses' => 'SongController@update'
]);

// DELETE /api/songs/{id} maps to SongController function destroy, which deletes the given song
$router->delete('/api/songs/{id}', [
    'as' => 'api.songs.delete',
    'uses' => 'SongController@destroy'
]);

// Countries

// GET /api/countries
$router->get('/api/countries', [
    'as' => 'api.countries.index',
    'uses' => 'CountryController@index'
]);

// GET /api/countries/{id}
$router->get('/api/countries/{id}', [
    'as' => 'api.countries.show',
    'uses' => 'CountryController@show'
]);