<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Song;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     * List all the songs stored in our Database
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // get all of the songs in the database
        // $songs = Song::all();

        // Get a paginated list of all of the songs in the database 
        // use with BEFORE you get the results;
        // $songs = Song::with(['genre', 'country'])->paginate();

        // This:
        // $songsQuery = Song::query()->with(['genre', 'country']);
        // is the same as:
        $songsQuery = Song::with(['genres', 'country']);

        // check if the genre_id key is on the request (either in $_POST or $_GET)
        if ($request->has('genre_id')) {
            // modify our query to filter down to that specific genre_id
            $genreId = $request->input('genre_id');

            // this shorthand:
            // $songsQuery->whereGenreId($genreId);
            // does the same thing as this long form

            $songsQuery->whereHas('genres', function ($genreQuery) use ($genreId) {
                $genreQuery->where('id', '=', $genreId);
            });
        }

        if ($request->has('country_id')) {
            $songsQuery->where('country_id', '=', $request->input('country_id'));
        }

        if ($request->has('search')) {
            // SELECT * FROM songs WHERE title LIKE '%abc%';
            $search = $request->input('search');
            $songsQuery->where('title', 'LIKE', "%" . $search . "%");
            // $songsQuery->where('title', 'LIKE', "%$search%");
        }

        if ($request->has('country_name')) {
            // when loading the songs from the DB, also check the countries table
            // and see if there is a country for this model (relationship) that matches
            // the extra where statements we're adding
            $countryName = $request->input('country_name');
            $songsQuery->whereHas('country', function ($countryQuery) use ($countryName) {
                $countryQuery->where('name', 'LIKE', '%' . $countryName . '%');
            });
        }

        $songs = $songsQuery->paginate();

        return response()->json($songs);
    }

    /**
     * Show a specific Song
     * 
     * @param int $id 
     * @return \Illuminate\Http\Response 
     */
    public function show(int $id)
    {
        // this:
        // $song = Song::query()->find($id);
        // is the same as:
        $song = Song::find($id);
        // use load AFTER we've gotten a SINGLE model
        // (or loop over a Collection of models and call 'load' for each one)
        $song->load(['genres', 'country']);
        // is the same as calling each one individually:
        // $song->load('genre');
        // $song->load('country');

        return response()->json($song);
    }

    /**
     * Store a new song in the database
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'duration' => 'required|integer',
            'country_id' => 'required|exists:countries,id',
            'genre_ids' => 'array'
        ]);

        $userInput = $request->all();

        // The below is equivalent to:
        // Song::create([
        //     'title' => 'title of the song',
        //     'duration' => '12345',
        //     'genre_id' => 1
        // ]);
        $song = Song::create($userInput);

        if ($request->has('country_id')) {
            $country = Country::findOrFail($request->input('country_id'));

            $song->country()->associate($country);
            $song->save();
        }

        if ($request->has('genre_ids')) {
            $genreIds = $request->input('genre_ids', []);

            $song->genres()->sync($genreIds);
        }

        $song->load(['genres', 'country']);

        return response()->json([
            'message' => 'Successfully created a song!',
            'data' => $song
        ]);
    }

    /**
     * Updates a specific Song with the input the user provides
     * 
     * @param int $id 
     * @param Request $request 
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        $this->validate($request, [
            'title' => 'min:3',
            'duration' => 'integer',
            'country_id' => 'exists:countries,id',
            'genre_ids' => 'array'
        ]);

        $userInput = $request->all();
        $song = Song::find($id);

        // actuallly update the given song
        $success = $song->update($userInput);

        if (! $success) {
            return response()->json([
                'message' => 'Could not update!'
            ]);
        }

        if ($request->has('country_id')) {
            $country = Country::findOrFail($request->input('country_id'));

            $song->country()->associate($country);
            $song->save();
        }

        if ($request->has('genre_ids')) {
            $genreIds = $request->input('genre_ids', []);

            $song->genres()->sync($genreIds);
        }

        $song->load(['genres', 'country']);

        return response()->json([
            'message' => 'Successfully update the song!',
            'data' => $song
        ]);
    }

    /**
     * Delete a specific song
     * 
     * @param int $id 
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $song = Song::find($id);
        $song->delete();

        return response()->json([
            'message' => 'Successfully deleted the song!'
        ]);
    }
}
